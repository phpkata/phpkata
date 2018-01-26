<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Input\StringValue;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Step;

final class FunctionAssertion
{
    /**
     * @var ExecutionEnvironment
     */
    private $environment;

    /**
     * @var string
     */
    private $name;

    /**
     * @var AssertionBuilder
     */
    private $builder;

    /**
     * @param ExecutionEnvironment $environment
     * @param string $name
     * @param AssertionBuilder $builder
     */
    public function __construct(ExecutionEnvironment $environment, $name, AssertionBuilder $builder)
    {
        $this->environment = $environment;
        $this->name = $name;
        $this->builder = $builder;
    }

    public function exists()
    {
        $this->will(new FunctionExists($this->name, $this->environment->getNamespace()));
    }

    public function returnString(string $string, \Closure $closure)
    {
        $this->will(
            new ClosureReturns(
                "The function named '{$this->name}'",
                new StringValue($string),
                $this->environment->getNamespace(),
                $closure
            )
        );
    }

    public function acceptArguments()
    {
        // todo funct get args
    }

    public function will(Step $expectation)
    {
        $this->builder->will($expectation);
    }
}
