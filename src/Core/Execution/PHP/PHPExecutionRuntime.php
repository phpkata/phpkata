<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution\PHP;

use Star\PHPKata\Core\Definitions\FunctionDefinition;
use Star\PHPKata\Core\Definitions\MethodDefinition;
use Star\PHPKata\Core\Execution\ExecutionRuntime;
use Star\PHPKata\Core\Input\EmptyValue;
use Star\PHPKata\Core\Input\IntegerValue;
use Star\PHPKata\Core\Input\StringValue;
use Star\PHPKata\Core\Model\ActualValue;

final class PHPExecutionRuntime implements ExecutionRuntime
{
    /**
     * @param FunctionDefinition $definition
     *
     * @return ActualValue The value returned by the function
     */
    public function runFunction(FunctionDefinition $definition): ActualValue
    {
        $name = $definition->getName();
        $fqn = $definition->getFullyQualifiedName();
        $arguments = $definition->getArguments();

        if (! function_exists($fqn)) {
            throw new \InvalidArgumentException("The function '{$name}' do not exists.");
        }

        $reflection = new \ReflectionFunction($fqn);
        $count = count($arguments);
        if ($count < $reflection->getNumberOfRequiredParameters()) {
            throw new \InvalidArgumentException("The function '{$name}()' do not accept '{$count}' argument(s).");
        }

        return $this->transformValue(call_user_func_array($fqn, $arguments));
    }

    /**
     * @param MethodDefinition $definition
     *
     * @return ActualValue The value returned by the method
     */
    public function runMethod(MethodDefinition $definition): ActualValue
    {
        $fqcn = $definition->getFullyQualifiedClassName();
        $method = $definition->getName();
        $arguments = $definition->getArguments();
        $fqmn = $definition->getFullyQualifiedMethodName();

        if (! class_exists($fqcn)) {
            throw new \InvalidArgumentException("The class with name '{$fqcn}' do not exists.");
        }

        $object = new $fqcn();
        if (! method_exists($object, $method)) {
            throw new \InvalidArgumentException(
                "The method '{$method}' is not defined on class '{$fqcn}'."
            );
        }

        $reflection = new \ReflectionClass($object);
        $methodRef = $reflection->getMethod($method);
        $count = count($arguments);
        if ($count < $methodRef->getNumberOfRequiredParameters()) {
            throw new \InvalidArgumentException("The method '{$fqmn}()' do not accept '{$count}' argument(s).");
        }

        return $this->transformValue(call_user_func_array([$object, $method], $arguments));
    }

    /**
     * @param mixed $actual
     *
     * @return ActualValue
     */
    private function transformValue($actual): ActualValue
    {
        if (is_null($actual)) {
            return new EmptyValue();
        }

        if (is_numeric($actual)) {
            return new IntegerValue($actual);
        }

        return new StringValue($actual);
    }
}
