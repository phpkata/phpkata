<?php declare(strict_types=1);

namespace Star\PHPKata\Katas;

use Star\PHPKata\Core\Kata;
use Star\PHPKata\Core\Objective;
use Star\PHPKata\Core\ObjectiveBuilder;
use Star\PHPKata\Printing\KataDetail;

final class HelloWorldKata implements Kata
{
    /**
     * @return KataDetail
     */
    public function getDetail(): KataDetail
    {
        return new KataDetail(
            'Hello World',
            'Write a function that returns the "Hello world" words.'
        );
    }

    /**
     * @param ObjectiveBuilder $builder
     *
     * @return Objective
     */
    public function build(ObjectiveBuilder $builder): Objective
    {
        $builder->functionExists('helloWorld');
        $builder->closureReturns(
            'Hello world',
            function () {
                return \helloWorld();
            }
        );

        return $builder->buildObjective('Create a function that returns "Hello world".');
    }
}
