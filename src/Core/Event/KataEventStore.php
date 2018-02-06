<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Event;

final class KataEventStore
{
    /**
     * Event executed before the application is run.
     *
     * @see BootingApplication
     */
    const BEFORE_RUN = 'phpkata.booting_application';

    /**
     * Event executed after the configuration was loaded.
     *
     * Note: The configuration is read only, to override a config you must use a config file.
     *
     * @see ConfigurationWasLoaded
     */
    const CONFIGURATION_LOADED = 'phpkata.configuration_loaded';

    /**
     * Event executed after the environment was loaded.
     *
     * Note: The configuration is read only, to override a config you must use a config file.
     *
     * @see EnvironmentWasLoaded
     */
    const ENVIRONMENT_LOADED = 'phpkata.environment_loaded';
}
