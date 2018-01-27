<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Model\KataNamespace;

final class RandomNamespace implements KataNamespace
{
    /**
     * @var KataNamespace
     */
    private $namespace;

    public function __construct()
    {
        $this->namespace = new StringNamespace(uniqid('Random'));
    }

    public function pathOf(string $resource): string
    {
        return $this->namespace->pathOf($resource);
    }

    public function toString(): string
    {
        return $this->namespace->toString();
    }
}
