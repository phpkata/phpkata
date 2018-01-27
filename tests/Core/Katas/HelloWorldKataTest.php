<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use PHPUnit\Framework\TestCase;

final class HelloWorldKataTest extends TestCase
{
    /**
     * @var KataTester
     */
    private $tester;

    public function setUp()
    {
        $this->tester = new KataTester(new HelloWorldKata());
    }

    public function test_it_should_not_pass_when_function_is_undefined()
    {
        $result = $this->tester->run('');
        $this->assertFalse($result->isPass());
        $this->assertCount(1, $result->getErrors());
        $this->assertCount(0, $result->getSuccesses());
    }

    public function test_it_should_not_pass_when_function_not_returning_a_string()
    {
        $result = $this->tester->run('function helloWorld() {}');

        $this->assertFalse($result->isPass());
        $this->assertCount(1, $result->getErrors());
        $this->assertCount(1, $result->getSuccesses());
    }

    public function test_it_should_not_pass_when_function_is_returning_invalid_string()
    {
        $result = $this->tester->run('function helloWorld() {}');

        $this->assertFalse($result->isPass());
        $this->assertCount(1, $result->getErrors());
        $this->assertCount(1, $result->getSuccesses());
    }

    public function test_it_should_pass_when_function_is_returning_valid_string()
    {
        $result = $this->tester->run('function helloWorld() { return "Hello world"; }');

        $this->assertTrue($result->isPass());
        $this->assertCount(0, $result->getErrors());
        $this->assertCount(2, $result->getSuccesses());
    }
}
