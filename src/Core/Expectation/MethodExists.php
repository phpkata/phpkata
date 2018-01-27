<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Definitions\ClassDefinition;
use Star\PHPKata\Core\Model\Expectation;

final class MethodExists implements Expectation
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ClassDefinition
     */
    private $definition;

    /**
     * @param string $name
     * @param ClassDefinition $definition
     */
    public function __construct(string $name, ClassDefinition $definition)
    {
        $this->name = $name;
        $this->definition = $definition;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return "Method '{$this->name}' from class '{$this->definition->getName()}' exists.";
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return method_exists($this->definition->getFullyQualifiedClassName(), $this->name);
    }
}
