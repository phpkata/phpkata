<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use PHPUnit\Framework\TestCase;

final class ObjectiveTest extends TestCase
{
    /**
     * @var Objective
     */
    private $objective;

    public function setUp()
    {
        $this->objective = new Objective('hint', []);
    }

    public function test_it_should_do_return_result()
    {
        $this->assertInstanceOf(ExecutionResult::class, $this->objective->run());
    }
}
