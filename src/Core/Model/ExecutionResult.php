<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

final class ExecutionResult
{
    /**
     * @var Expectation[]
     */
    private $errors = [];

    /**
     * @var Expectation[]
     */
    private $successes = [];

    public function addError(Expectation $expectation)
    {
        $this->errors[] = $expectation;
    }

    public function addSuccess(Expectation $expectation)
    {
        $this->successes[] = $expectation;
    }

    public function isPass(): bool
    {
        return count($this->errors) === 0;
    }

    public function getErrors(): array
    {
        return array_map(
            function (Expectation $expectation) {
                return $expectation->getMessage();
            },
            $this->errors
        );
    }

    public function getSuccesses(): array
    {
        return array_map(
            function (Expectation $expectation) {
                return $expectation->getMessage();
            },
            $this->successes
        );
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
