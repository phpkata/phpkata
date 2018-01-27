<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use Star\PHPKata\Core\Expectation\AssertionBuilder;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Objective;

final class FibonacciSequenceKata implements Kata
{
    /**
     * @return KataDetail
     */
    public function getDetail(): KataDetail
    {
        return new KataDetail(
            'Fibonacci sequence',
            'Write a method that returns the sum the two preceding numbers.'
        );
    }

    /**
     * @param AssertionBuilder $assert
     *
     * @return Objective
     */
    public function build(AssertionBuilder $assert): Objective
    {
        $class = $assert->classWill('FibonacciSequence');
        $method = $class->haveAMethod('generate');
        $method->willReturnInt(0)->whenInvokedWith(1);
        $method->willReturnInt(1)->whenInvokedWith(2);
        $method->willReturnInt(1)->whenInvokedWith(3);
        $method->willReturnInt(2)->whenInvokedWith(4);
        $method->willReturnInt(3)->whenInvokedWith(5);
        $method->willReturnInt(5)->whenInvokedWith(6);
        $method->willReturnInt(8)->whenInvokedWith(7);
        $method->willReturnInt(13)->whenInvokedWith(8);
        $method->willReturnInt(21)->whenInvokedWith(9);
        $method->willReturnInt(34)->whenInvokedWith(10);
        // todo the performance one should be a (bonus)
        $method->willReturnInt(160500643816367088)->whenInvokedWith(85);
        // todo will throw exception when 0 given (bonus)

        return $assert->buildObjective('REMOVE???');
    }
}
