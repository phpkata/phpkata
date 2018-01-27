<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Model\KataNamespace;

final class GlobalNamespace implements KataNamespace
{
    public function pathOf(string $resource): string
    {
        return '\\' . $resource;
    }

    public function toString(): string
    {
        return '';
    }
}
