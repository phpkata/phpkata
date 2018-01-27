<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Expectation;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;
use Star\PHPKata\Core\Execution\StringNamespace;

final class ClassExistsTest extends TestCase
{
    public function test_it_should_be_completed_when_global_class_exists()
    {
        $object = new ClassExists('stdClass', new GlobalNamespace());
        $this->assertTrue($object->isCompleted());
    }

    public function test_it_should_be_completed_when_class_exists_in_namespace()
    {
        $object = new ClassExists('ClassExistsTest', new StringNamespace(__NAMESPACE__));
        $this->assertTrue($object->isCompleted());
    }

    public function test_it_should_not_be_completed_when_class_do_not_exists_in_namespace()
    {
        $object = new ClassExists('ClassExistsTest', new GlobalNamespace());
        $this->assertFalse($object->isCompleted());
    }

    public function test_it_should_return_the_string_message()
    {
        $object = new ClassExists('stdClass', new GlobalNamespace());
        $this->assertSame("The class named 'stdClass' exists.", $object->getMessage());
    }
}
