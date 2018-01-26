<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Objective;
use Star\PHPKata\Core\Expectation\AssertionBuilder;

final class NullKata implements Kata
{
    public function getDetail(): KataDetail
    {
        return new KataDetail('Stub kata', 'Null kata');
    }

    public function build(AssertionBuilder $assert): Objective
    {
        return $assert->buildObjective('No Objectives');
    }
}
