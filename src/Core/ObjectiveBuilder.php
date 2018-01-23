<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

use Star\PHPKata\Core\Steps\ClosureReturns;
use Star\PHPKata\Core\Steps\FunctionExists;

final class ObjectiveBuilder
{
    /**
     * @var Step[]
     */
    private $list = [];

    /**
     * @param string $expected
     * @param \Closure $closure
     */
    public function closureReturns(string $expected, \Closure $closure)
    {
        $this->list[] = new ClosureReturns($expected, $closure);
    }

    public function functionExists(string $functionName)
    {
        $this->list[] = new FunctionExists($functionName);
    }

    /**
     * @param string $hint
     *
     * @return Objective
     */
    public function buildObjective(string $hint): Objective
    {
        return new Objective($hint, $this->list);
    }
}
