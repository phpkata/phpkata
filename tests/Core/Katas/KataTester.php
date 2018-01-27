<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use Star\PHPKata\Core\Execution\InMemoryEnvironment;
use Star\PHPKata\Core\Execution\RandomNamespace;
use Star\PHPKata\Core\Expectation\AssertionBuilder;
use Star\PHPKata\Core\Model\Kata;

final class KataTester
{
    /**
     * @var Kata
     */
    private $kata;

    /**
     * @param Kata $kata
     */
    public function __construct(Kata $kata)
    {
        $this->kata = $kata;
    }

    /**
     * @param string $code The string of code to execute.
     *
     * @return \Star\PHPKata\Core\Model\ExecutionResult
     */
    public function run(string $code)
    {
        $namespace = new RandomNamespace();
        $environment = new InMemoryEnvironment($namespace, $code);
        $objective = $this->kata->build(new AssertionBuilder($environment));
        $environment->load();
        $result = $objective->run();

        return $result;
    }
}
