<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface Expectation
{
    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return bool
     */
    public function isCompleted(): bool;
}
