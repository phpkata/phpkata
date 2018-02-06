<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Event;

use Star\PHPKata\Core\Configuration\LoadedConfiguration;
use Star\PHPKata\Core\Model\PhpKataApplication;
use Symfony\Component\EventDispatcher\Event;

final class EnvironmentWasLoaded extends Event
{
    /**
     * @var PhpKataApplication
     */
    private $application;

    /**
     * @var LoadedConfiguration
     */
    private $configuration;

    /**
     * @param PhpKataApplication $application
     * @param LoadedConfiguration $configuration
     */
    public function __construct(PhpKataApplication $application, LoadedConfiguration $configuration)
    {
        $this->application = $application;
        $this->configuration = $configuration;
    }

    /**
     * @return PhpKataApplication
     */
    public function application(): PhpKataApplication
    {
        return $this->application;
    }

    /**
     * @return LoadedConfiguration
     */
    public function configuration(): LoadedConfiguration
    {
        return $this->configuration;
    }
}
