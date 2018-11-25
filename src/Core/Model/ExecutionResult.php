<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Webmozart\Assert\Assert;

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

    /**
     * @var Message[]
     */
    private $errorMessages = [];

    /**
     * @var Message[]
     */
    private $successMessages = [];

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

    /**
     * @param array $successes
     * @param array $failures
     *
     * @return ExecutionResult
     *
     * @deprecated Replace with construct
     */
    public static function replaceWithConstruct(array $successes, array $failures)
    {
        $result = new self();
        Assert::allIsInstanceOf($successes, Message::class);
        Assert::allIsInstanceOf($failures, Message::class);
        $result->successMessages = $successes;
        $result->errorMessages = $failures;

        return $result;
    }
}
