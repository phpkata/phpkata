<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

use Star\PHPKata\Cli\KataApplication;

final class KataRunner
{
    /**
     * @var string
     */
    private $basePath;

    public function __construct(string $basePath)
    {
        if (! is_dir($basePath)) {
            throw new FileNotFoundException("The directory '{$basePath}' cannot be found.");
        }

        $this->basePath = $basePath;
    }

    public function run(Kata $kata, ExecutionContext $context): int
    {
        $printer = $context->getPrinter();
        $printer->printHeader(
            sprintf(
                "PHPKata %s by Yannick Voyer and contributors.",
                KataApplication::VERSION
            )
        );

        $printer->printKata($kata->getDetail());

        $this->setupEnvironment();
        $objective = $kata->build($builder = new ObjectiveBuilder());

        $result = $objective->run();
        $result->acceptResultVisitor($printer);

        return 0;
    }

    private function setupEnvironment()
    {
        $main = $this->basePath . DIRECTORY_SEPARATOR . 'main.php';
        if (! file_exists($main)) {
            $content = <<<CONTENT
<?php
// Place your code here

CONTENT;
            file_put_contents($main, $content);
        }

        include $main;
    }
}
