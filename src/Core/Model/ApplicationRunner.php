<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Star\PHPKata\Core\Expectation\AssertionBuilder;

final class ApplicationRunner implements KataRunner
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var ExecutionEnvironment
     */
    private $environment;

    public function __construct(string $version, ExecutionEnvironment $environment)
    {
        $this->version = $version;
        $this->environment = $environment;
    }

    public function run(Kata $kata, Printer $printer): int
    {
        $printer->printHeader(
            sprintf(
                "PHPKata %s by Yannick Voyer and contributors.",
                $this->version
            )
        );

        $printer->printKata($kata->getDetail());

        $this->environment->load();
        $objective = $kata->build($builder = new AssertionBuilder($this->environment));

        $result = $objective->run();
        $result->acceptResultVisitor($printer);

        if ($result->isPass()) {
            $printer->printMessage(
                new StringMessage(
                    sprintf('You successfully completed the "%s" kata.', $kata->getDetail()->name())
                )
            );
        }

        return 0;
    }
}
