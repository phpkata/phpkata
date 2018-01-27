<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Definitions\FunctionDefinition;
use Star\PHPKata\Core\Definitions\MethodDefinition;
use Star\PHPKata\Core\Model\ActualValue;

interface ExecutionRuntime
{
    /**
     * @param FunctionDefinition $definition
     *
     * @return ActualValue The value returned by the function
     */
    public function runFunction(FunctionDefinition $definition): ActualValue;

    /**
     * @param MethodDefinition $definition
     *
     * @return ActualValue The value returned by the method
     */
    public function runMethod(MethodDefinition $definition): ActualValue;
}
