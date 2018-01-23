<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

use Star\PHPKata\Printing\KataDetail;

interface Kata
{
    /**
     * @return KataDetail
     */
    public function getDetail(): KataDetail;

    /**
     * @param ObjectiveBuilder $builder
     *
     * @return Objective
     */
    public function build(ObjectiveBuilder $builder): Objective;
}
