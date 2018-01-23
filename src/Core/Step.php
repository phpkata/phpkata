<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

interface Step
{
    /**
     * @return string
     */
    public function toString(): string;

    /**
     * @return bool
     */
    public function isCompleted(): bool;
}
