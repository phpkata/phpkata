<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use Star\PHPKata\Core\FileNotFoundException;
use Star\PHPKata\Core\Kata;
use Star\PHPKata\Core\KataRunner;
use Star\PHPKata\Katas\HelloWorldKata;
use Symfony\Component\Console\Application;

final class KataApplication extends Application
{
    const VERSION = '1.0.0';

    /**
     * @var KataRunner
     */
    private $runner;

    /**
     * @param string $dataSrc
     * @throws FileNotFoundException
     */
    public function __construct(string $dataSrc)
    {
        parent::__construct('phpkata', self::VERSION);

        $this->runner = new KataRunner($dataSrc);
        $this->addKatas(
            [
                new HelloWorldKata(),
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
