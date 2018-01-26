<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface Message
{
    /**
     * @return string
     */
    public function toString(): string;
}
