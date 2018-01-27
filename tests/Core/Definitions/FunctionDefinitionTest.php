<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;

final class FunctionDefinitionTest extends TestCase
{
    /**
     * @var FunctionDefinition
     */
    private $definition;

    public function setUp()
    {
        $this->definition = new FunctionDefinition(new GlobalNamespace(), 'name', []);
    }

    public function test_it_should_have_a_name()
    {
        $this->assertSame('name', $this->definition->getName());
    }

    public function test_it_should_have_a_fully_qualified_name()
    {
        $this->assertSame('\name', $this->definition->getFullyQualifiedName());
    }

    public function test_it_should_have_a_namespace()
    {
        $this->assertSame('', $this->definition->getNamespace()->toString());
    }

    public function test_it_should_have_arguments()
    {
        $this->assertEquals([], $this->definition->getArguments());
    }
}
