<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;
use Star\PHPKata\Core\Execution\StringNamespace;

final class FunctionExistsTest extends TestCase
{
    public function test_it_should_be_completed_if_function_exists()
    {
        $object = new FunctionExists(
            'existingFunction',
            new StringNamespace(__NAMESPACE__)
        );
        $this->assertTrue($object->isCompleted());
    }

    public function test_it_should_be_incomplete_if_function_do_not_exists_in_namespace()
    {
        $object = new FunctionExists(
            'existingFunction',
            new GlobalNamespace()
        );
        $this->assertFalse($object->isCompleted());
    }

    public function test_it_should_return_the_step_description()
    {
        $object = new FunctionExists(
            'fct',
            new StringNamespace(__NAMESPACE__)
        );
        $this->assertSame("The function named 'fct' exists.", $object->getMessage());
    }

    public function test_it_should_be_completed_if_global_function_exists()
    {
        $object = new FunctionExists(
            'count',
            new GlobalNamespace()
        );
        $this->assertTrue($object->isCompleted());
    }
}

function existingFunction() {};
