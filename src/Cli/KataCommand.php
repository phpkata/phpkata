<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Behat\Transliterator\Transliterator;
use Doctrine\Common\Inflector\Inflector;
use Star\PHPKata\Core\Kata;
use Star\PHPKata\Core\KataRunner;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class KataCommand extends Command
{
    /**
     * @var Kata
     */
    private $kata;

    /**
     * @var KataRunner
     */
    private $runner;

    public function __construct(Kata $kata, KataRunner $runner)
    {
        $this->kata = $kata;
        $this->runner = $runner;

        parent::__construct($this->nameOf($kata));
    }

    public function configure()
    {
        $this->setDescription($this->kata->getDetail()->description());
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        return $this->runner->run($this->kata, new ConsoleContext($input, $output));
    }

    /**
     * Return a standardized name for the $kata, based on the class name, without the Kata word.
     *
     * ie. DoSomethingKata => do-something
     *
     * @param Kata $kata
     *
     * @return string
     */
    private function nameOf(Kata $kata): string
    {
        $class = get_class($kata);
        $name = substr($class, strrpos($class, '\\') + 1);
        $name = str_replace('Kata', '', $name);

        return Transliterator::urlize(Inflector::tableize($name));
    }
}
