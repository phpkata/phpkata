<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Printing;

use Star\PHPKata\Core\Model\ExecutionResult;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Message;
use Star\PHPKata\Core\Model\Printer;
use Star\PHPKata\Core\Model\Expectation;

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

    public function printMessage(Message $message)
    {
        // do nothing
    }

    public function visitResult(ExecutionResult $result)
    {
        // do nothing
    }

    public function visitSuccess(Expectation $expectation)
    {
        // do nothing
    }

    public function visitFailure(Expectation $expectation)
    {
        // do nothing
    }
}
