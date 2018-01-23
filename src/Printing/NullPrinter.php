<?php declare(strict_types=1);

namespace Star\PHPKata\Printing;

use Star\PHPKata\Core\ExecutionResult;
use Star\PHPKata\Core\Step;

final class NullPrinter implements Printer
{
    public function printKata(KataDetail $detail)
    {
        // do nothing
    }

    public function printHeader(string $text)
    {
        // do nothing
    }

    public function visitResult(ExecutionResult $result)
    {
        // do nothing
    }

    public function visitSuccess(Step $step)
    {
        // do nothing
    }

    public function visitFailure(Step $step)
    {
        // do nothing
    }
}
