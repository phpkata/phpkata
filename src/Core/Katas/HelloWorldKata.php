<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\KataNamespace;
use Star\PHPKata\Core\Model\Objective;
use Star\PHPKata\Core\Expectation\AssertionBuilder;

final class HelloWorldKata implements Kata
{
    public function getDetail(): KataDetail
    {
        return new KataDetail(
            'Hello world',
            'Write a function that returns the "Hello world" words.'
        );
    }

    public function build(AssertionBuilder $assert): Objective
    {
        $function = 'helloWorld';
        $assert->functionWill($function)->exists();
        $assert->functionWill($function)->returnString(
            'Hello world',
            function(KataNamespace $namespace) {
                $function = $namespace->pathOf('helloWorld');

                return $function();
            }
        );

        return $assert->buildObjective('Create a function that returns "Hello world".');
    }
}
