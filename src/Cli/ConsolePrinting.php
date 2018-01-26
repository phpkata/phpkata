<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Star\PHPKata\Core\Model\ExecutionResult;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Message;
use Star\PHPKata\Core\Model\Printer;
use Star\PHPKata\Core\Model\Step;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsolePrinting implements Printer
{
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param OutputInterface $output
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    public function printKata(KataDetail $detail)
    {
        $this->output->writeln('');
        $this->output->writeln('Kata: ' . $detail->name());
        $this->output->writeln('Description: ' . $detail->description());
    }

    public function printHeader(string $text)
    {
        $this->output->writeln('');
        $this->output->writeln($text);
    }

    public function printMessage(Message $message)
    {
        $this->output->writeln('');
        $this->output->writeln($message->toString());
    }

    public function visitResult(ExecutionResult $result)
    {
        $this->output->writeln('');
        $this->output->writeln('Objectives:');
    }

    public function visitSuccess(Step $step)
    {
        $this->output->writeln('[X] ' . $step->toString());
    }

    public function visitFailure(Step $step)
    {
        $this->output->writeln('[ ] ' . $step->toString());
    }
}
