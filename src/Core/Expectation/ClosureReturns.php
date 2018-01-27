<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Model\Expectation;

final class ClosureReturns implements Expectation
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var ExpectedValue
     */
    private $expected;

    /**
     * @var \Closure
     */
    private $closure;

    public function __construct(ExpectedValue $expected, \Closure $closure, string $message)
    {
        $this->message = $message;
        $this->expected = $expected;
        $this->closure = $closure;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function isCompleted(): bool
    {
        $closure = $this->closure;

        return $this->expected->isSame($closure());
    }
}
