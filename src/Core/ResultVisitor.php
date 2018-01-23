<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

interface ResultVisitor
{
    /**
     * @param ExecutionResult $result
     */
    public function visitResult(ExecutionResult $result);

    /**
     * @param Step $step
     */
    public function visitSuccess(Step $step);

    /**
     * @param Step $step
     */
    public function visitFailure(Step $step);
}
