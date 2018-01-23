<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Steps;

use Star\PHPKata\Core\Step;

final class ClosureReturns implements Step
{
    /**
     * @var string
     */
    private $expected;

    /**
     * @var \Closure
     */
    private $closure;

    /**
     * @param string $expected todo Wrap in __toString value
     * @param \Closure $closure
     */
    public function __construct(string $expected, \Closure $closure)
    {
        $this->expected = $expected;
        $this->closure = $closure;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return "The callable returns the expected '{$this->expected}'.";
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        $closure = $this->closure;

        return $this->expected === $closure();
    }
}
