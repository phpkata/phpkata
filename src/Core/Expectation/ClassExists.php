<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\Expectation;
use Star\PHPKata\Core\Model\KataNamespace;

final class ClassExists implements Expectation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var KataNamespace
     */
    private $namespace;

    /**
     * @param string $name
     * @param KataNamespace $namespace
     */
    public function __construct(string $name, KataNamespace $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return "The class named '{$this->name}' exists.";
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return class_exists($this->namespace->pathOf($this->name));
    }
}
