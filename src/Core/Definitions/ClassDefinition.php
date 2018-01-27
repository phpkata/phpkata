<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

use Star\PHPKata\Core\Model\KataNamespace;

final class ClassDefinition
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
     * @param KataNamespace $namespace
     * @param string $name
     */
    public function __construct(KataNamespace $namespace, string $name)
    {
        $this->namespace = $namespace;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFullyQualifiedClassName(): string
    {
        return $this->namespace->pathOf($this->name);
    }
}
