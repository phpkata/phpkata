<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Definitions\ClassDefinition;
use Star\PHPKata\Core\Definitions\FunctionDefinition;
use Star\PHPKata\Core\Execution\PHP\PHPExecutionRuntime;
use Star\PHPKata\Core\Execution\ExecutionRuntime;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Objective;
use Star\PHPKata\Core\Model\Expectation;

final class AssertionBuilder
{
    /**
     * @var ExecutionEnvironment
     */
    private $environment;

    /**
     * @var ExecutionRuntime
     */
    private $runtime;

    /**
     * @var Expectation[]
     */
    private $list = [];

    /**
     * @param ExecutionEnvironment $environment
     */
    public function __construct(ExecutionEnvironment $environment)
    {
        $this->environment = $environment;
        $this->runtime = new PHPExecutionRuntime();
    }

    /**
     * @param Expectation $expectation
     */
    public function will(Expectation $expectation)
    {
        $this->list[] = $expectation;
    }

    /**
     * @param string $functionName
     *
     * @return FunctionAssertion
     */
    public function functionWill(string $functionName): FunctionAssertion
    {
        $this->will(new FunctionExists($functionName, $this->environment->getNamespace()));

        return new FunctionAssertion(
            new FunctionDefinition($this->environment->getNamespace(), $functionName),
            $this->runtime,
            $this
        );
    }

    /**
     * @param string $className
     *
     * @return ClassAssertion
     */
    public function classWill(string $className): ClassAssertion
    {
        $this->will(new ClassExists($className, $this->environment->getNamespace()));

        return new ClassAssertion(
            new ClassDefinition($this->environment->getNamespace(), $className),
            $this->runtime,
            $this
        );
    }

    /**
     * @param string $hint
     *
     * @return Objective
     */
    public function buildObjective(string $hint): Objective
    {
        return new Objective($hint, $this->list);
    }
}
