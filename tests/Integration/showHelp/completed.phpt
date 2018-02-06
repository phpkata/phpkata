--TEST--
Show the help output of the application
--FILE--
<?php

require_once __DIR__ . '/../autoload.php';

$_SERVER['argv'][0] = 'phpkata';
$_SERVER['argv'][1] = '-c=phpkata.yml';

$app = new \Star\PHPKata\Cli\KataApplication(__DIR__);
$app->run();

?>
--EXPECTF--
Loading from configuration: phpkata.yml

phpkata %d.%d.%d

Usage:
  command [options] [arguments]

Options:
  -h, --help                         Display this help message
  -q, --quiet                        Do not output any message
  -V, --version                      Display this application version
      --ansi                         Force ANSI output
      --no-ansi                      Disable ANSI output
  -n, --no-interaction               Do not ask any interactive question
  -c, --configuration=CONFIGURATION  The path to a configuration file [default: "phpkata.yml"]
  -v|vv|vvv, --verbose               Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  fibonacci-sequence  Write a method that returns the sum the two preceding numbers.
  hello-world         Write a function that returns the "Hello world" words.
  help                Displays help for a command
  list                Lists commands

