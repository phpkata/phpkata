--TEST--
Show the first step of the kata when no code is written
--FILE--
<?php
$_SERVER['argv'][1] = 'hello-world';

require_once __DIR__ . '/../autoload.php';

TestCaseRunner::run(__FILE__);

?>
--EXPECTF--
PHPKata %d.%d.%d by Yannick Voyer and contributors.

Kata: Hello world
Description: Write a function that returns the "Hello world" words.

Objectives:
[ ] The function named 'helloWorld' exists.
