<?php

namespace Star\PHPKata\Core\Execution\PHP;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Definitions\ClassDefinition;
use Star\PHPKata\Core\Definitions\FunctionDefinition;
use Star\PHPKata\Core\Definitions\MethodDefinition;
use Star\PHPKata\Core\Execution\GlobalNamespace;
use Star\PHPKata\Core\Model\ActualValue;

class PHPExecutionRuntimeTest extends TestCase
{
    public function test_it_should_run_the_function()
    {
        $runtime = new PHPExecutionRuntime();
        $value = $runtime->runFunction(
            new FunctionDefinition(new GlobalNamespace(),'count', [[1, 2, 3]])
        );

        $this->assertInstanceOf(ActualValue::class, $value);
        $this->assertSame('3', $value->toString());
    }

    public function test_it_should_run_the_method()
    {
        $runtime = new PHPExecutionRuntime();
        $value = $runtime->runMethod(
            new MethodDefinition(
                new ClassDefinition(new GlobalNamespace(), 'DateTime'),
                'format',
                ['Y-m-d']
            )
        );

        $this->assertInstanceOf(ActualValue::class, $value);
        $this->assertSame(date('Y-m-d'), $value->toString());
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The class with name '\Invalid' do not exists.
     */
    public function test_it_should_throw_exception_when_class_do_not_exists()
    {
        $runtime = new PHPExecutionRuntime();
        $runtime->runMethod(
            new MethodDefinition(
                new ClassDefinition(new GlobalNamespace(), 'Invalid'),
                '',
                []
            )
        );
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The method 'noFound' is not defined on class '\DateTime'.
     */
    public function test_it_should_throw_exception_when_method_do_not_exists()
    {
        $runtime = new PHPExecutionRuntime();
        $runtime->runMethod(
            new MethodDefinition(
                new ClassDefinition(new GlobalNamespace(), 'DateTime'),
                'noFound',
                []
            )
        );
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The method '\DateTime::format()' do not accept '0' argument(s).
     */
    public function test_it_should_throw_exception_when_method_is_missing_arguments()
    {
        $runtime = new PHPExecutionRuntime();
        $runtime->runMethod(
            new MethodDefinition(
                new ClassDefinition(new GlobalNamespace(), 'DateTime'),
                'format',
                []
            )
        );
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The function 'notExists' do not exists.
     */
    public function test_it_should_throw_exception_when_function_do_not_exists()
    {
        $runtime = new PHPExecutionRuntime();
        $runtime->runFunction(
            new FunctionDefinition(
                new GlobalNamespace(),
                'notExists',
                []
            )
        );
    }

    /**
     * @expectedException        \InvalidArgumentException
     * @expectedExceptionMessage The function 'count()' do not accept '0' argument(s).
     */
    public function test_it_should_throw_exception_when_function_is_missing_arguments()
    {
        $runtime = new PHPExecutionRuntime();
        $runtime->runFunction(
            new FunctionDefinition(
                new GlobalNamespace(),
                'count',
                []
            )
        );
    }
}
