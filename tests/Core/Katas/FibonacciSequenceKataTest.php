<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use PHPUnit\Framework\TestCase;

final class FibonacciSequenceKataTest extends TestCase
{
    /**
     * @var KataTester
     */
    private $tester;

    public function setUp()
    {
        $this->tester = new KataTester(new FibonacciSequenceKata());
    }

    public function test_it_should_fail_when_class_do_not_exists()
    {
        $result = $this->tester->run('');

        $this->assertFalse($result->isPass());
        $this->assertCount(0, $result->getSuccesses());
        $this->assertCount(1, $result->getErrors());
    }

    public function test_it_should_fail_when_class_do_not_have_method()
    {
        $result = $this->tester->run('class FibonacciSequence {}');

        $this->assertFalse($result->isPass());
        $this->assertCount(1, $result->getSuccesses());
        $this->assertCount(1, $result->getErrors());
    }

    public function test_it_should_fail_when_method_do_not_return_a_number()
    {
        $result = $this->tester->run('class FibonacciSequence { function generate() {} }');

        $this->assertFalse($result->isPass());
        $this->assertCount(2, $result->getSuccesses());
        $this->assertCount(1, $result->getErrors());
    }

    public function test_it_should_fail_when_method_do_not_return_the_expected_number()
    {
        $result = $this->tester->run('class FibonacciSequence { function generate() { return -1; } }');

        $this->assertFalse($result->isPass());
        $this->assertCount(2, $result->getSuccesses());
        $this->assertCount(1, $result->getErrors());
    }

    public function test_it_should_fail_when_method_do_not_return_two_for_the_third_number()
    {
        $result = $this->tester->run(
            '
            class FibonacciSequence {
                function generate(int $position): int
                {
                    if ($position === 1) {
                        return 0;
                    }
                    return 1;
                }
            }'
        );

        $this->assertFalse($result->isPass());
        $this->assertCount(5, $result->getSuccesses());
        $this->assertCount(1, $result->getErrors());
    }
}
