<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use Star\PHPKata\Core\Configuration\YamlLoader;
use Star\PHPKata\Core\Event\KataEventStore;
use Star\PHPKata\Core\Model\KataApplicationSubscriber;
use Star\PHPKata\Core\Model\PhpKataApplication;
use Symfony\Component\Console\Output\OutputInterface;

final class LoadConfigurationFile implements KataApplicationSubscriber
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param string $installDir
     */
    public function __construct(string $installDir)
    {
        $this->path = $installDir;
    }

    public function load(BootingApplication $event)
    {
        $application = $event->application();
        $output = $event->output();
        $input = $event->input();

        $configFile = $input->getParameterOption(['--configuration', '-c']);
        if ($configFile) {
            if (! $this->tryToLoad($configFile, $application, $output)) {
                throw new \InvalidArgumentException(
                    sprintf('The config file "%s" could not be found.', $configFile)
                );
            }

            return;
        }

        if ($this->tryToLoad('phpkata.yml', $application, $output)) {
            return;
        }

        if ($this->tryToLoad('phpkata.yml.dist', $application, $output)) {
            return;
        }

        $this->loadWithData($application, 'default:');
    }

    private function tryToLoad(string $confFile, PhpKataApplication $application, OutputInterface $output): bool
    {
        $fullPath = $this->path . DIRECTORY_SEPARATOR . $confFile;
        if (file_exists($fullPath)) {
            $data = file_get_contents($fullPath);
            $output->writeln("\nLoading from configuration: " . $confFile . "\n");
            $this->loadWithData($application, $data);

            return (bool) $data;
        }

        return false;
    }

    /**
     * @param PhpKataApplication $application
     * @param string $data
     */
    private function loadWithData(PhpKataApplication $application, string $data)
    {
        $loader = new YamlLoader($data);
        $application->loadConfiguration($loader->createConfiguration());
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KataEventStore::BEFORE_RUN => ['load', 1],
        ];
    }
}
