<?php
namespace data;

class FibonacciSequence {
    function generate(int $position): int {
        $number = 0;
        if ($position > 0) {
            if ($position > 2) {
                $number = 1;
                $previous = 0;
                $current  = 1;
                for ($i = 3; $i <= $position; $i ++) {
                    $number = $current + $previous;
                    $previous = $current;
                    $current = $number;
                }
            } else {
                $number = $position - 1;
            }
        }
        return $number;
    }
}
