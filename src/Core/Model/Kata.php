<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use Star\PHPKata\Core\Expectation\AssertionBuilder;

interface Kata
{
    /**
     * @return KataDetail
     */
    public function getDetail(): KataDetail;

    /**
     * @param AssertionBuilder $assert
     *
     * @return Objective
     */
    public function build(AssertionBuilder $assert): Objective;
}
