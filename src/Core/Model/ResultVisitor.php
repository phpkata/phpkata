<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface ResultVisitor
{
    /**
     * @param ExecutionResult $result
     */
    public function visitResult(ExecutionResult $result);

    /**
     * @param Expectation $expectation
     */
    public function visitSuccess(Expectation $expectation);

    /**
     * @param Expectation $expectation
     */
    public function visitFailure(Expectation $expectation);
}
