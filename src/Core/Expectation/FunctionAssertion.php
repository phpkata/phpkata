<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Definitions\FunctionDefinition;
use Star\PHPKata\Core\Execution\ExecutionRuntime;
use Star\PHPKata\Core\Input\StringValue;
use Star\PHPKata\Core\Model\Expectation;

final class FunctionAssertion
{
    /**
     * @var FunctionDefinition
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
     * @param FunctionDefinition $definition
     * @param ExecutionRuntime $runtime
     * @param AssertionBuilder $builder
     */
    public function __construct(FunctionDefinition $definition, ExecutionRuntime $runtime, AssertionBuilder $builder)
    {
        $this->definition = $definition;
        $this->runtime = $runtime;
        $this->builder = $builder;
    }

    public function returnString(string $expected)
    {
        $this->will(
            new ClosureReturns(
                new StringValue($expected),
                function () {
                    return $this->runtime->runFunction($this->definition);
                },
                "The function named '{$this->definition->getName()}' returns the expected value '{$expected}'."
            )
        );
    }

    public function will(Expectation $expectation)
    {
        $this->builder->will($expectation);
    }
}
