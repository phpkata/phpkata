<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Configuration;

interface ConfigurationLoader
{
    /**
     * @return LoadedConfiguration
     */
    public function createConfiguration(): LoadedConfiguration;
}
