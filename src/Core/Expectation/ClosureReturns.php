<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Input\Same;
use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Model\Expectation;
use Star\PHPKata\Core\Model\ResultBuilder;
use Star\PHPKata\Core\Model\StringMessage;

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

    public function evaluate(ResultBuilder $builder)
    {
        $closure = $this->closure;

        $builder->addMatcher(
            new Same(
                $this->expected,
                $closure(),
                new StringMessage($this->message)
            )
        );
    }
}
