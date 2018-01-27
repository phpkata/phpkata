<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;

final class MethodDefinitionTest extends TestCase
{
    /**
     * @var MethodDefinition
     */
    private $definition;

    public function setUp()
    {
        $this->definition = new MethodDefinition(
            new ClassDefinition(new GlobalNamespace(), 'class'),
            'method',
            []
        );
    }

    public function test_it_should_have_a_name()
    {
        $this->assertSame('method', $this->definition->getName());
    }

    public function test_it_should_return_the_fully_qualified_class_name()
    {
        $this->assertSame('\class', $this->definition->getFullyQualifiedClassName());
    }

    public function test_it_should_return_the_fully_qualified_method_name()
    {
        $this->assertSame('\class::method', $this->definition->getFullyQualifiedMethodName());
    }

    public function test_it_should_have_a_arguments()
    {
        $this->assertEquals([], $this->definition->getArguments());
    }

    public function test_should_be_immutable_when_setting_arguments()
    {
        $this->assertEquals([], $this->definition->getArguments());
        $newDefinition = $this->definition->setArguments([1, 2, 3]);
        $this->assertEquals([], $this->definition->getArguments());
        $this->assertEquals([1, 2, 3], $newDefinition->getArguments());
    }
}
