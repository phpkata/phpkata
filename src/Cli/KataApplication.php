<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Star\PHPKata\Cli\Adapter\BootingApplication;
use Star\PHPKata\Cli\Adapter\KataLoader;
use Star\PHPKata\Cli\Adapter\LoadConfigurationFile;
use Star\PHPKata\Cli\Adapter\LoadEnvironment;
use Star\PHPKata\Core\Configuration\LoadedConfiguration;
use Star\PHPKata\Core\Event\ConfigurationWasLoaded;
use Star\PHPKata\Core\Event\EnvironmentWasLoaded;
use Star\PHPKata\Core\Event\KataEventStore;
use Star\PHPKata\Core\Model\ApplicationRunner;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataApplicationSubscriber;
use Star\PHPKata\Core\Model\KataRunner;
use Star\PHPKata\Core\Model\PhpKataApplication;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class KataApplication extends Application implements PhpKataApplication
{
    const VERSION = '1.0.0';

    /**
     * @var KataRunner
     */
    private $runner;

    /**
     * @var LoadedConfiguration|null
     */
    private $configuration;

    /**
     * @var EventDispatcherInterface
     */
    private $publisher;

    /**
     * @param string $installDir
     * @param bool $debug
     */
    public function __construct(string $installDir, bool $debug = false)
    {
        parent::__construct('phpkata', self::VERSION);

        $this->setDefinition($this->getDefinition());
        $this->publisher = new EventDispatcher();
        $this->setDispatcher($this->publisher);
        $this->addSubscriber(new LoadConfigurationFile($installDir));
        $this->addSubscriber(new LoadEnvironment($installDir));
        $this->addSubscriber(new KataLoader());
    }

    public function addSubscriber(KataApplicationSubscriber $subscriber)
    {
        $this->publisher->addSubscriber($subscriber);
    }

    public function loadConfiguration(LoadedConfiguration $configuration)
    {
        $this->configuration = $configuration;
        $this->publisher->dispatch(
            KataEventStore::CONFIGURATION_LOADED,
            new ConfigurationWasLoaded($this, $this->configuration)
        );
    }

    public function loadEnvironment(ExecutionEnvironment $environment)
    {
        $this->runner = new ApplicationRunner(self::VERSION, $environment);
        $this->publisher->dispatch(
            KataEventStore::ENVIRONMENT_LOADED,
            new EnvironmentWasLoaded($this, $this->configuration)
        );
    }

    public function addKata(Kata $kata)
    {
        $this->add(new KataCommand($kata, $this->runner));
    }

    public function doRun(InputInterface $input, OutputInterface $output): int
    {
        $this->publisher->dispatch(
            KataEventStore::BEFORE_RUN,
            new BootingApplication($this, $input, $output)
        );

        return parent::doRun($input, $output);
    }

    public function getDefaultInputDefinition(): InputDefinition
    {
        $definition = parent::getDefaultInputDefinition();
        $definition->addOption(
            new InputOption(
                'configuration',
                'c',
                InputOption::VALUE_REQUIRED,
                'The path to a configuration file',
                'phpkata.yml'
            )
        );

        return $definition;
    }
}
