--TEST--
Function do return the expected string, Kata completed.
--FILE--
<?php

require_once __DIR__ . '/../autoload.php';

$_SERVER['argv'][0] = 'phpkata';
$_SERVER['argv'][1] = 'hello-world';

$app = new \Star\PHPKata\Cli\KataApplication(__DIR__);
$app->run();

?>
--EXPECTF--
PHPKata %d.%d.%d by Yannick Voyer and contributors.

Kata: Hello world
Description: Write a function that returns the "Hello world" words.

Objectives:
[X] The function named 'helloWorld' exists.
[X] The function named 'helloWorld' returns the expected value 'Hello world'.

You successfully completed the "Hello world" kata.
