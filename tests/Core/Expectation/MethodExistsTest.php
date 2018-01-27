<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Definitions\ClassDefinition;
use Star\PHPKata\Core\Execution\GlobalNamespace;

final class MethodExistsTest extends TestCase
{
    public function test_it_should_be_completed_when_the_method_exists()
    {
        $object = new MethodExists('format', new ClassDefinition(new GlobalNamespace(), 'DateTime'));
        $this->assertTrue($object->isCompleted());
    }

    public function test_it_should_not_be_completed_when_the_method_do_not_exists()
    {
        $object = new MethodExists('invalid', new ClassDefinition(new GlobalNamespace(), 'DateTime'));
        $this->assertFalse($object->isCompleted());
    }

    public function test_it_should_return_the_message()
    {
        $object = new MethodExists('method', new ClassDefinition(new GlobalNamespace(), 'Object'));
        $this->assertSame("Method 'method' from class 'Object' exists.", $object->getMessage());
    }
}
