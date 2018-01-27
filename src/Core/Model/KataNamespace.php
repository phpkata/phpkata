<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface KataNamespace
{
    /**
     * Returns the full path for a resource.
     *
     * @param string $resource
     *
     * @return string
     */
    public function pathOf(string $resource): string;

    /**
     * Return the path definition for the namespace.
     *
     * @return string
     */
    public function toString(): string;
}
