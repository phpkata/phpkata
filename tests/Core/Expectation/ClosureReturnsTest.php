<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;
use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Input\IntegerValue;
use Star\PHPKata\Core\Input\EmptyValue;
use Star\PHPKata\Core\Input\StringValue;

final class ClosureReturnsTest extends TestCase
{
    public function test_it_should_return_the_step_description()
    {
        $object = new ClosureReturns(
            'context message',
            new StringValue('value'),
            new GlobalNamespace(),
            function() {}
        );
        $this->assertSame("context message returns the expected value 'value'.", $object->toString());
    }

    public function test_it_should_be_completed_when_closure_returns_expected_value()
    {
        $object = new ClosureReturns(
            '',
            new StringValue('value'),
            new GlobalNamespace(),
            function() { return 'value'; }
        );
        $this->assertTrue($object->isCompleted());
    }

    /**
     * @param ExpectedValue $expected
     * @param mixed $actual
     *
     * @dataProvider providePossibleReturnedValue
     */
    public function test_it_should_be_incomplete_when_return_value_do_not_exactly_match(ExpectedValue $expected, $actual)
    {
        $object = new ClosureReturns(
            '',
            $expected,
            new GlobalNamespace(),
            function() use ($actual) { return $actual; }
        );
        $this->assertFalse($object->isCompleted());
    }

    public static function providePossibleReturnedValue()
    {
        return [
            'different string' => [new StringValue('sting'), 'string'],
            'not same type' => [new IntegerValue(21), '21'],
        ];
    }

    public function test_it_should_format_the_message()
    {
        $object = new ClosureReturns(
            'message',
            new EmptyValue(),
            new GlobalNamespace(),
            function() {}
        );

        $this->assertSame("message returns the expected value ''.", $object->toString());
    }
}
