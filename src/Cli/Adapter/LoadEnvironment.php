<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use Star\PHPKata\Core\Event\ConfigurationWasLoaded;
use Star\PHPKata\Core\Event\KataEventStore;
use Star\PHPKata\Core\Execution\InMemoryEnvironment;
use Star\PHPKata\Core\Filesystem\FileNotFoundException;
use Star\PHPKata\Core\Filesystem\FilesystemEnvironment;
use Star\PHPKata\Core\Model\KataApplicationSubscriber;

final class LoadEnvironment implements KataApplicationSubscriber
{
    /**
     * @var string
     */
    private $installDir;

    /**
     * @param string $installDir
     * @throws FileNotFoundException
     */
    public function __construct(string $installDir)
    {
        if (! is_dir($installDir)) {
            throw new FileNotFoundException(
                sprintf('The install dir "%s" cannot be found.', $installDir)
            );
        }
        $this->installDir = $installDir;
    }

    public function loadEnvironment(ConfigurationWasLoaded $event)
    {
        $configuration = $event->configuration();
        $application = $event->application();

        $env = new InMemoryEnvironment($configuration->getNamespace(), '');
        if ('filesystem' === $configuration->getEnvironment()) {
            $srcDir = $this->installDir . DIRECTORY_SEPARATOR . $configuration->getSrcDir();
            if (! is_dir($srcDir)) {
                mkdir($srcDir);
            }

            $env = new FilesystemEnvironment($srcDir, $configuration->getNamespace());
        }

        $application->loadEnvironment($env);
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
            KataEventStore::CONFIGURATION_LOADED => ['loadEnvironment', 1],
        ];
    }
}
