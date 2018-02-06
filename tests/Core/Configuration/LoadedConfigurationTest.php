<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Configuration;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Execution\GlobalNamespace;
use Star\PHPKata\Core\Execution\StringNamespace;
use Star\PHPKata\Core\Model\Kata;

final class LoadedConfigurationTest extends TestCase
{
    public function test_it_should_return_the_source_dir()
    {
        $configuration = new LoadedConfiguration('path', 'env', [], new GlobalNamespace());
        $this->assertSame('path', $configuration->getSrcDir());
    }

    public function test_it_should_return_the_kata_classes()
    {
        $configuration = new LoadedConfiguration(
            'path',
            'env',
            [
                get_class($this->createMock(Kata::class)),
                get_class($this->createMock(Kata::class)),
            ],
            new GlobalNamespace()
        );
        $this->assertCount(2, $configuration->getClasses());
    }

    /**
     * @expectedException        \Star\PHPKata\Core\Configuration\InvalidConfigurationException
     * @expectedExceptionMessage The provided kata class 'DoNotExistsKata' do not exists.
     */
    public function test_it_should_throw_exception_when_kata_class_do_not_exist()
    {
        new LoadedConfiguration('path', 'env', ['DoNotExistsKata'], new GlobalNamespace());
    }

    /**
     * @expectedException        \Star\PHPKata\Core\Configuration\InvalidConfigurationException
     * @expectedExceptionMessage All provided kata class must implement the Kata interface, 'stdClass' does not.
     */
    public function test_it_should_throw_exception_when_kata_class_is_not_a_kata_class()
    {
        new LoadedConfiguration('path', 'env', ['stdClass'], new GlobalNamespace());
    }

    public function test_it_should_return_the_namespace()
    {
        $configuration = new LoadedConfiguration('path', 'env', [], $n = new StringNamespace('somewhere'));
        $this->assertEquals($n, $configuration->getNamespace());
    }

    public function test_it_should_return_the_environment_key()
    {
        $configuration = new LoadedConfiguration('path', 'env', [], $n = new StringNamespace('somewhere'));
        $this->assertEquals('env', $configuration->getEnvironment());
    }
}
