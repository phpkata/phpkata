--TEST--
Show the step descriptions of a kata when no code is written
--FILE--
<?php
$_SERVER['argv'][1] = 'hello-world';

@unlink(__DIR__ . '/main.php');

require_once __DIR__ . '/../../../vendor/autoload.php';

$runner = new \Star\PHPKata\Cli\KataApplication(__DIR__);
$runner->run();
?>
--EXPECTF--
PHPKata %d.%d.%d by Yannick Voyer and contributors.

Kata: Hello World
Description: Write a function that returns the "Hello world" words.

Objectives:
[ ] Function with name 'helloWorld' exists.
