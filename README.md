# phpkata

[![Build Status](https://travis-ci.org/phpkata/phpkata.svg?branch=master)](https://travis-ci.org/phpkata/phpkata)

## Installation

To install the application:

* Clone the project `git clone https://github.com/phpkata/phpkata.git`
* Go at the root of the install folder
* Install using [Composer](https://getcomposer.org/) `composer install`

Running unit tests: `bin/phpunit --testsuite unit`
Running integration tests: `bin/phpunit --testsuite funcitonal`

## Running a Kata

Running a kata can be done using the CLI interface, by exectuting the script `php phpkata <kata-name>`.
Your working folder will be located in the `data` folder. From there, you can hack away.

When you have finished your step, you can execute the command once more, to get more information about what to do next.

Enjoy !!!

## List of all available katas

The application is bundled with pre-packaged [katas](https://github.com/phpkata/phpkata/tree/master/src/Core/Katas).

```
$ php phpkata --help
```

The application can be [customized](https://github.com/phpkata/phpkata/wiki).

[Contributing](https://github.com/phpkata/phpkata/wiki/Contributing)
