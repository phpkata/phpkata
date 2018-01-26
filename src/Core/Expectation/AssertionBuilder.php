<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Objective;
use Star\PHPKata\Core\Model\Step;

final class AssertionBuilder
{
    /**
     * @var ExecutionEnvironment
     */
    private $environment;

    /**
     * @var Step[]
     */
    private $list = [];

    /**
     * @param ExecutionEnvironment $environment
     */
    public function __construct(ExecutionEnvironment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * @param Step $expectation
     */
    public function will(Step $expectation)
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
        return new FunctionAssertion($this->environment, $functionName, $this);
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
