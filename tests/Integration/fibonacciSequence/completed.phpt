--TEST--
Show the instruction for the fibonnaci sequence kata
--FILE--
<?php

require_once __DIR__ . '/../autoload.php';

$_SERVER['argv'][0] = 'phpkata';
$_SERVER['argv'][1] = 'fibonacci-sequence';

$app = new \Star\PHPKata\Cli\KataApplication(__DIR__);
$app->run();

?>
--EXPECTF--
PHPKata %d.%d.%d by Yannick Voyer and contributors.

Kata: Fibonacci sequence
Description: Write a method that returns the sum the two preceding numbers.

Objectives:
[X] The class named 'FibonacciSequence' exists.
[X] Method 'generate' from class 'FibonacciSequence' exists.
[X] Method 'generate' returns '0' when given '1' as argument.
[X] Method 'generate' returns '1' when given '2' as argument.
[X] Method 'generate' returns '1' when given '3' as argument.
[X] Method 'generate' returns '2' when given '4' as argument.
[X] Method 'generate' returns '3' when given '5' as argument.
[X] Method 'generate' returns '5' when given '6' as argument.
[X] Method 'generate' returns '8' when given '7' as argument.
[X] Method 'generate' returns '13' when given '8' as argument.
[X] Method 'generate' returns '21' when given '9' as argument.
[X] Method 'generate' returns '34' when given '10' as argument.
[X] Method 'generate' returns '160500643816367088' when given '85' as argument.

You successfully completed the "Fibonacci sequence" kata.
