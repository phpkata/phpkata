<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\KataNamespace;

final class NullEnvironment implements ExecutionEnvironment
{
    public function getNamespace(): KataNamespace
    {
        return new GlobalNamespace();
    }

    public function load()
    {
        // do nothing
    }
}
