<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Model\KataNamespace;

final class StringNamespace implements KataNamespace
{
    /**
     * @var string
     */
    private $namespace;

    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    public function pathOf(string $resource): string
    {
        return $this->namespace . '\\' . $resource;
    }
}
