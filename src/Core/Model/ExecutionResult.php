<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

final class ExecutionResult
{
    /**
     * @var Step[]
     */
    private $errors = [];

    /**
     * @var Step[]
     */
    private $successes = [];

    public function addError(Step $step)
    {
        $this->errors[] = $step;
    }

    public function addSuccess(Step $step)
    {
        $this->successes[] = $step;
    }

    public function isPass(): bool
    {
        return count($this->errors) === 0;
    }

    public function acceptResultVisitor(ResultVisitor $visitor) {
        $visitor->visitResult($this);
        foreach ($this->successes as $success) {
            $visitor->visitSuccess($success);
        }

        foreach ($this->errors as $error) {
            $visitor->visitFailure($error);
        }
    }
}
