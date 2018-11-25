<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\Message;

final class BooleanMatcher implements ValueMatcher
{
    /**
     * @var bool
     */
    private $expected;

    /**
     * @var mixed
     */
    private $actual;

    /**
     * @var Message
     */
    private $message;

    /**
     * @param bool $expected
     * @param mixed $actual
     * @param Message $message
     */
    public function __construct(bool $expected, $actual, Message $message)
    {
        $this->expected = $expected;
        $this->actual = $actual;
        $this->message = $message;
    }

    public function evaluate(): bool
    {
        return $this->expected === $this->actual;
    }

    public function message(): Message
    {
        return $this->message;
    }
}
