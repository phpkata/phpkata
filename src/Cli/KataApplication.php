<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Star\PHPKata\Core\Katas\FibonacciSequenceKata;
use Star\PHPKata\Core\Katas\HelloWorldKata;
use Star\PHPKata\Core\Model\ApplicationRunner;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataRunner;
use Symfony\Component\Console\Application;

final class KataApplication extends Application
{
    const VERSION = '1.0.0';

    /**
     * @var KataRunner
     */
    private $runner;

    /**
     * @param ExecutionEnvironment $environment
     */
    public function __construct(ExecutionEnvironment $environment)
    {
        parent::__construct('phpkata', self::VERSION);

        $this->runner = new ApplicationRunner(self::VERSION, $environment);
        $this->addKatas(
            [
                new HelloWorldKata(),
                new FibonacciSequenceKata(),
            ]
        );
    }

    /**
     * @param Kata[] $katas
     */
    private function addKatas(array $katas) {
        foreach ($katas as $kata) {
            $this->addKata($kata);
        }
    }

    /**
     * @param Kata $kata
     */
    private function addKata(Kata $kata)
    {
        $this->add(new KataCommand($kata, $this->runner));
    }
}
