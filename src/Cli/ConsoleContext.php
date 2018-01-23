<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Star\PHPKata\Core\ExecutionContext;
use Star\PHPKata\Printing\ConsolePrinting;
use Star\PHPKata\Printing\Printer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class ConsoleContext implements ExecutionContext
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return Printer
     */
    public function getPrinter(): Printer
    {
        return new ConsolePrinting($this->output);
    }
}
