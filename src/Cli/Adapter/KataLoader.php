<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use Star\PHPKata\Core\Event\EnvironmentWasLoaded;
use Star\PHPKata\Core\Event\KataEventStore;
use Star\PHPKata\Core\Model\KataApplicationSubscriber;

final class KataLoader implements KataApplicationSubscriber
{
    public function loadKatas(EnvironmentWasLoaded $event)
    {
        $application = $event->application();
        $config = $event->configuration();

        foreach ($config->getClasses() as $class) {
            $application->addKata(new $class());
        }
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
            KataEventStore::ENVIRONMENT_LOADED => 'loadKatas',
        ];
    }
}
