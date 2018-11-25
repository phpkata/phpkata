<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Katas;

use Star\PHPKata\Core\Expectation\AssertionBuilder;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataDetail;
use Star\PHPKata\Core\Model\Objective;

final class OptionalRequirementKata implements Kata
{
    /**
     * @return KataDetail
     */
    public function getDetail(): KataDetail
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }

    /**
     * @param AssertionBuilder $assert
     *
     * @return Objective
     */
    public function build(AssertionBuilder $assert): Objective
    {
        throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
    }
}
