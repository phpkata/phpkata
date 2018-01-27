<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

use Star\PHPKata\Core\Model\KataNamespace;

final class FunctionDefinition
{
    /**
     * @var KataNamespace
     */
    private $namespace;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $arguments;

    public function __construct(KataNamespace $namespace, string $name, array $arguments = [])
    {
        $this->namespace = $namespace;
        $this->name = $name;
        $this->arguments = $arguments;
    }

    public function getNamespace(): KataNamespace
    {
        return $this->namespace;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getFullyQualifiedName(): string
    {
        return $this->namespace->pathOf($this->name);
    }
}
