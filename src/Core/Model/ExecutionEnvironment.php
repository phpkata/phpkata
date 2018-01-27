<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface ExecutionEnvironment
{
    /**
     * @return KataNamespace
     * @deprecated Todo find a way to execute code in env
     */
    public function getNamespace(): KataNamespace;

    /**
     * Load the necessary resource for the environment
     */
    public function load();
}
