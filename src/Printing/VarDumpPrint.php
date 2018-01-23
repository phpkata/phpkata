<?php declare(strict_types=1);

namespace Star\PHPKata\Printing;

use Star\PHPKata\Core\ExecutionResult;
use Star\PHPKata\Core\Step;

final class VarDumpPrint implements Printer
{
    public function printKata(KataDetail $detail)
    {
        var_dump($detail);
    }

    public function printHeader(string $text)
    {
        var_dump($text);
    }

    public function visitResult(ExecutionResult $result)
    {
        var_dump($result);
    }

    public function visitSuccess(Step $step)
    {
        var_dump($step);
    }

    public function visitFailure(Step $step)
    {
        var_dump($step);
    }
}
