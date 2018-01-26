<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\KataNamespace;

final class AlwaysInNamespace implements ExecutionEnvironment
{
    /**
     * @var KataNamespace
     */
    private $namespace;

    public function __construct(KataNamespace $namespace)
    {
        $this->namespace = $namespace;
    }

    public function getNamespace(): KataNamespace
    {
        return $this->namespace;
    }

    public function load()
    {
        // do nothing
    }
}
