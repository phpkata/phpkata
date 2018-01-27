<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Definitions;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;

final class ClassDefinitionTest extends TestCase
{
    /**
     * @var ClassDefinition
     */
    private $definition;

    public function setUp()
    {
        $this->definition = new ClassDefinition(new GlobalNamespace(), 'stdClass');
    }

    public function test_it_should_have_a_name()
    {
        $this->assertSame('stdClass', $this->definition->getName());
    }

    public function test_it_should_name_a_fully_qualified_class_name()
    {
        $this->assertSame('\stdClass', $this->definition->getFullyQualifiedClassName());
    }
}
