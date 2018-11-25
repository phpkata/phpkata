<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\Message;

interface ValueMatcher
{
    /**
     * Returns whether the expression evaluates to the expected value
     *
     * @return bool
     */
    public function evaluate(): bool;

    /**
     * @return Message
     */
    public function message(): Message;
}
