<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\KataNamespace;
use Star\PHPKata\Core\Model\Expectation;

final class FunctionExists implements Expectation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var KataNamespace
     */
    private $namespace;

    public function __construct(string $name, KataNamespace $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function getMessage(): string
    {
        return "The function named '{$this->name}' exists.";
    }

    public function isCompleted(): bool
    {
        return function_exists($this->namespace->pathOf($this->name));
    }
}
