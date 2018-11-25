<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ActualValue;
use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Model\Message;

final class Same implements ValueMatcher
{
    /**
     * @var ExpectedValue
     */
    private $expected;

    /**
     * @var ActualValue
     */
    private $actual;

    /**
     * @var Message
     */
    private $message;

    public function __construct(ExpectedValue $expected, ActualValue $actual, Message $message)
    {
        $this->expected = $expected;
        $this->actual = $actual;
        $this->message = $message;
    }

    public function evaluate(): bool
    {
        return $this->expected->__toString() === $this->actual->toString();
    }

    public function message(): Message
    {
        return $this->message;
    }
}
