<?php declare(strict_types=1);

namespace Star\PHPKata\Printing;

use Star\PHPKata\Core\ExecutionResult;
use Star\PHPKata\Core\Step;

final class BufferedPrinting implements Printer
{
    /**
     * @var string
     */
    private $display = '';

    /**
     * @param KataDetail $detail
     */
    public function printKata(KataDetail $detail)
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * @param string $text
     */
    public function printHeader(string $text)
    {
        $this->display .= $text;
    }

    public function visitResult(ExecutionResult $result)
    {
    }

    public function visitSuccess(Step $step)
    {
        $this->display .= $step->toString();
    }

    public function visitFailure(Step $step)
    {
        $this->display .= $step->toString();
    }

    public function getDisplay(): string
    {
        return $this->display;
    }
}
