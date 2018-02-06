<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Star\PHPKata\Core\Configuration\LoadedConfiguration;

interface PhpKataApplication
{
    /**
     * From here you can hook into the system.
     *
     * @param KataApplicationSubscriber $subscriber
     */
    public function addSubscriber(KataApplicationSubscriber $subscriber);

    /**
     * @param LoadedConfiguration $configuration
     */
    public function loadConfiguration(LoadedConfiguration $configuration);

    /**
     * @param ExecutionEnvironment $environment
     */
    public function loadEnvironment(ExecutionEnvironment $environment);

    /**
     * @param Kata $kata
     */
    public function addKata(Kata $kata);
}
