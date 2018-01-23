<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

use Webmozart\Assert\Assert;

final class Objective
{
    /**
     * @var string
     */
    private $hint;

    /**
     * @var Step[]
     */
    private $steps;

    public function __construct(string $hint, array $steps)
    {
        Assert::allIsInstanceOf($steps, Step::class);
        $this->hint = $hint;
        $this->steps = $steps;
    }

    /**
     * @return ExecutionResult
     */
    public function run(): ExecutionResult
    {
        $result = new ExecutionResult();
        foreach ($this->steps as $step) {
            if ($step->isCompleted()) {
                $result->addSuccess($step);
            } else {
                $result->addError($step);
                break;
            }
        }

        return $result;
    }
}
