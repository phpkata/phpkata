<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Printing\BufferedPrinting;

final class ExecutionResultTest extends TestCase
{
    /**
     * @var ExecutionResult
     */
    private $result;

    public function setUp()
    {
        $this->result = new ExecutionResult();
    }

    public function test_it_should_print_nothing_when_no_steps_added()
    {
        $buffer = new BufferedPrinting();
        $this->assertSame('', $buffer->getDisplay());
        $this->result->acceptResultVisitor($buffer);
        $this->assertSame('', $buffer->getDisplay());
    }

    public function test_it_should_print_the_not_completed_steps()
    {
        $buffer = new BufferedPrinting();
        $this->assertSame('', $buffer->getDisplay());

        $step = new StubExpectation('My description', false);
        $this->result->addError($step);
        $this->result->acceptResultVisitor($buffer);

        $this->assertContains('My description', $buffer->getDisplay());
    }

    public function test_it_should_print_the_completed_steps()
    {
        $buffer = new BufferedPrinting();
        $this->assertSame('', $buffer->getDisplay());

        $step = new StubExpectation('My description', true);
        $this->result->addSuccess($step);
        $this->result->acceptResultVisitor($buffer);

        $this->assertContains('My description', $buffer->getDisplay());
    }

    public function test_it_should_pass_when_no_errors_are_found()
    {
        $this->assertTrue($this->result->isPass());
    }

    public function test_it_should_pass_when_errors_are_found()
    {
        $this->result->addError(new StubExpectation('', false));
        $this->assertFalse($this->result->isPass());
    }
}

final class StubExpectation implements Expectation {
    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $completed;

    /**
     * @param string $description
     * @param bool $completed
     */
    public function __construct(string $description, bool $completed)
    {
        $this->description = $description;
        $this->completed = $completed;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed;
    }

    /**
     * @param ResultBuilder $builder
     */
    public function evaluate(ResultBuilder $builder)
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
