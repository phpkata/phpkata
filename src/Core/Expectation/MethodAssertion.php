<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Definitions\MethodDefinition;
use Star\PHPKata\Core\Execution\ExecutionRuntime;
use Star\PHPKata\Core\Input\IntegerValue;
use Star\PHPKata\Core\Model\ExpectedValue;

final class MethodAssertion
{
    /**
     * @var MethodDefinition
     */
    private $definition;

    /**
     * @var ExecutionRuntime
     */
    private $runtime;

    /**
     * @var AssertionBuilder
     */
    private $builder;

    /**
     * @var ExpectedValue|null
     */
    private $expected;

    /**
     * @param MethodDefinition $definition
     * @param ExecutionRuntime $runtime
     * @param AssertionBuilder $builder
     */
    public function __construct(
        MethodDefinition $definition,
        ExecutionRuntime $runtime,
        AssertionBuilder $builder
    ) {
        $this->definition = $definition;
        $this->runtime = $runtime;
        $this->builder = $builder;
        $this->expected = null;
    }

    public function willReturnInt(int $expected): self
    {
        $this->expected = new IntegerValue($expected);

        return $this;
    }

    /**
     * @param array ...$args
     */
    public function whenInvokedWith(... $args)
    {
        $definition = $this->definition->setArguments($args);

        if ($this->expected instanceof ExpectedValue) {
            $this->builder->will(
                new ClosureReturns(
                    $this->expected,
                    function () use ($definition) {
                        return $this->runtime->runMethod($definition);
                    },
                    sprintf(
                        "Method '%s' returns '%s' when given '%s' as argument.",
                        $definition->getName(),
                        $this->expected->__toString(),
                        implode(', ', $definition->getArguments())
                    )
                )
            );
        } else {
            throw new \RuntimeException(__METHOD__ . ' with no return value is not implemented yet.');
        }
    }
}
