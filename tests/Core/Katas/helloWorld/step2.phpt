--TEST--
Function exists
--FILE--
<?php
$_SERVER['argv'][1] = 'hello-world';

require_once __DIR__ . '/../autoload.php';

TestCaseRunner::run(__FILE__, 'function helloWorld() {}');

?>
--EXPECTF--
PHPKata %d.%d.%d by Yannick Voyer and contributors.

Kata: Hello world
Description: Write a function that returns the "Hello world" words.

Objectives:
[X] The function named 'helloWorld' exists.
[ ] The function named 'helloWorld' returns the expected value 'Hello world'.
