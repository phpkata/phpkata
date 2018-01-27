<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

final class MethodDefinition
{
    /**
     * @var ClassDefinition
     */
    private $class;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments = [];

    public function __construct(ClassDefinition $class, string $name, array $arguments = [])
    {
        $this->class = $class;
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function setArguments(array $arguments): self
    {
        return new self($this->class, $this->name, $arguments);
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getFullyQualifiedClassName(): string
    {
        return $this->class->getFullyQualifiedClassName();
    }

    public function getFullyQualifiedMethodName(): string
    {
        return $this->class->getFullyQualifiedClassName() . '::' . $this->name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
