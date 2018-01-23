<?php declare(strict_types=1);

namespace Star\PHPKata\Printing;

use Star\PHPKata\Core\ExecutionResult;
use Star\PHPKata\Core\Step;
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

    /**
     * @param KataDetail $detail
     */
    public function printKata(KataDetail $detail)
    {
        $this->output->writeln('');
        $this->output->writeln('Kata: ' . $detail->name());
        $this->output->writeln('Description: ' . $detail->description());
    }

    /**
     * @param string $text
     */
    public function printHeader(string $text)
    {
        $this->output->writeln('');
        $this->output->writeln($text);
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
