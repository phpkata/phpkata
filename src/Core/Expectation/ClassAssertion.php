<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Definitions\ClassDefinition;
use Star\PHPKata\Core\Definitions\MethodDefinition;
use Star\PHPKata\Core\Execution\ExecutionRuntime;

final class ClassAssertion
{
    /**
     * @var ClassDefinition
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
     * @param ClassDefinition $definition
     * @param ExecutionRuntime $runtime
     * @param AssertionBuilder $builder
     */
    public function __construct(ClassDefinition $definition, ExecutionRuntime $runtime, AssertionBuilder $builder)
    {
        $this->definition = $definition;
        $this->runtime = $runtime;
        $this->builder = $builder;
    }

    public function haveAMethod($name): MethodAssertion
    {
        $this->builder->will(new MethodExists($name, $this->definition));

        return new MethodAssertion(
            new MethodDefinition($this->definition, $name),
            $this->runtime,
            $this->builder
        );
    }
}
