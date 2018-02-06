<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use Star\PHPKata\Core\Model\PhpKataApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Event triggered while booting the application, before a kata is run.
 */
final class BootingApplication extends Event
{
    /**
     * @var PhpKataApplication
     */
    private $application;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @param PhpKataApplication $application
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function __construct(PhpKataApplication $application, InputInterface $input, OutputInterface $output)
    {
        $this->application = $application;
        $this->input = $input;
        $this->output = $output;
    }

    /**
     * @return PhpKataApplication
     */
    public function application(): PhpKataApplication
    {
        return $this->application;
    }

    /**
     * @return InputInterface
     */
    public function input(): InputInterface
    {
        return $this->input;
    }

    /**
     * @return OutputInterface
     */
    public function output(): OutputInterface
    {
        return $this->output;
    }
}
