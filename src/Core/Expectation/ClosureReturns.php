<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Model\KataNamespace;
use Star\PHPKata\Core\Model\Step;

final class ClosureReturns implements Step
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
     * @var KataNamespace
     */
    private $namespace;

    /**
     * @var \Closure
     */
    private $closure;

    public function __construct(
        string $message,
        ExpectedValue $expected,
        KataNamespace $namespace,
        \Closure $closure
    ) {
        $this->message = $message;
        $this->expected = $expected;
        $this->namespace = $namespace;
        $this->closure = $closure;
    }

    public function toString(): string
    {
        return $this->message . " returns the expected value '{$this->expected}'.";
    }

    public function isCompleted(): bool
    {
        $closure = $this->closure;

        return $this->expected->isSame($closure($this->namespace));
    }
}
