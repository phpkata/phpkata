<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use Symfony\Component\Console\Tester\ApplicationTester;

final class EnvironmentTester
{
    /**
     * @var vfsStreamDirectory
     */
    private $root;

    /**
     * @var KataApplication
     */
    private $application;

    /**
     * @var ApplicationTester
     */
    private $tester;

    public function __construct(string $content)
    {
        $this->root = vfsStream::setup(
            'root',
            null,
            [
                'main.php' => '<?php ' . $content,
            ]
        );
        $this->application = new KataApplication($this->root->url());
        $this->application->setAutoExit(false);
        $this->tester = new ApplicationTester($this->application);
    }

    public function execute(string $command, array $options = []): int
    {
        return $this->tester->run(
            array_merge(
                [
                    'command' => $command,
                ],
                $options
            )
        );
    }

    public function getDisplay(): string
    {
        return $this->tester->getDisplay();
    }
}
