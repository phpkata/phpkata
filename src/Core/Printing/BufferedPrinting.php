<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Printing;

use Star\PHPKata\Core\Model\ExecutionResult;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Message;
use Star\PHPKata\Core\Model\Printer;
use Star\PHPKata\Core\Model\Expectation;

final class BufferedPrinting implements Printer
{
    /**
     * @var string
     */
    private $display = '';

    public function printKata(KataDetail $detail)
    {
        $this->display .= $detail->name() . $detail->description();
    }

    public function printHeader(string $text)
    {
        $this->display .= $text;
    }

    public function printMessage(Message $message)
    {
        $this->display .= $message->toString();
    }

    public function visitResult(ExecutionResult $result)
    {
    }

    public function visitSuccess(Expectation $expectation)
    {
        $this->display .= $expectation->getMessage();
    }

    public function visitFailure(Expectation $expectation)
    {
        $this->display .= $expectation->getMessage();
    }

    public function getDisplay(): string
    {
        return $this->display;
    }
}
