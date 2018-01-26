<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Katas\HelloWorldKata;
use Star\PHPKata\Core\Katas\NullKata;
use Star\PHPKata\Core\Model\KataRunner;

final class KataCommandTest extends TestCase
{
    /**
     * @var KataRunner|\PHPUnit_Framework_MockObject_MockObject
     */
    private $runner;

    public function setUp()
    {
        $this->runner = $this->createMock(KataRunner::class);
    }

    public function test_it_should_register_a_command_with_class_name_of_kata()
    {
        $command = new KataCommand(new NullKata(), $this->runner);
        $this->assertSame('null', $command->getName());
    }

    public function test_it_should_remove_the_kata_term_from_command_name()
    {
        $command = new KataCommand(new HelloWorldKata(), $this->runner);
        $this->assertSame('hello-world', $command->getName());
    }

    public function test_it_should_use_the_kata_description_as_command_description()
    {
        $command = new KataCommand(new NullKata(), $this->runner);
        $this->assertSame('Null kata', $command->getDescription());
    }
}
