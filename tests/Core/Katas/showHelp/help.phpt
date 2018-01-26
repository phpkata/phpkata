--TEST--
Show the help output of the application
--FILE--
<?php

require_once __DIR__ . '/../autoload.php';

TestCaseRunner::run(__FILE__);

?>
--EXPECTF--
phpkata %d.%d.%d

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  hello-world  Write a function that returns the "Hello world" words.
  help         Displays help for a command
  list         Lists commands

