<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface Step // todo rename to Expectation
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
