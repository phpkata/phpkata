<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Model\ActualValue;
use Star\PHPKata\Core\Model\ExpectedValue;
use Star\PHPKata\Core\Input\IntegerValue;
use Star\PHPKata\Core\Input\EmptyValue;
use Star\PHPKata\Core\Input\StringValue;

final class ClosureReturnsTest extends TestCase
{
    public function test_it_should_return_the_message()
    {
        $object = new ClosureReturns(
            new StringValue('value'),
            function() {},
            'context message'
        );
        $this->assertSame("context message", $object->getMessage());
    }

    public function test_it_should_be_completed_when_closure_returns_expected_value()
    {
        $object = new ClosureReturns(
            new StringValue('value'),
            function() { return new StringValue('value'); },
            ''
        );
        $this->assertTrue($object->isCompleted());
    }

    /**
     * @param ExpectedValue $expected
     * @param ActualValue $actual
     *
     * @dataProvider providePossibleReturnedValue
     */
    public function test_it_should_be_incomplete_when_return_value_do_not_exactly_match(ExpectedValue $expected, ActualValue $actual)
    {
        $object = new ClosureReturns(
            $expected,
            function() use ($actual) { return $actual; },
            ''
        );
        $this->assertFalse($object->isCompleted());
    }

    public static function providePossibleReturnedValue()
    {
        return [
            'different string value' => [new StringValue('sting'), new StringValue('string')],
            'int and string are not same' => [new IntegerValue(21), new StringValue('string')],
        ];
    }
}
