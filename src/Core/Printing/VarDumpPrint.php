<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Printing;

use Star\PHPKata\Core\Model\ExecutionResult;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Message;
use Star\PHPKata\Core\Model\Printer;
use Star\PHPKata\Core\Model\Expectation;

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

    public function printMessage(Message $message)
    {
        var_dump($message);
    }

    public function visitResult(ExecutionResult $result)
    {
        var_dump($result);
    }

    public function visitSuccess(Expectation $expectation)
    {
        var_dump($expectation);
    }

    public function visitFailure(Expectation $expectation)
    {
        var_dump($expectation);
    }
}
