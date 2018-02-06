<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Configuration\LoadedConfiguration;
use Star\PHPKata\Core\Event\ConfigurationWasLoaded;
use Star\PHPKata\Core\Execution\InMemoryEnvironment;
use Star\PHPKata\Core\Execution\RandomNamespace;
use Star\PHPKata\Core\Filesystem\FileNotFoundException;
use Star\PHPKata\Core\Model\PhpKataApplication;

final class LoadEnvironmentTest extends TestCase
{
    /**
     * @var ConfigurationWasLoaded
     */
    private $event;

    public function setUp()
    {
        $this->event = new ConfigurationWasLoaded(
            $this->createMock(PhpKataApplication::class),
            new LoadedConfiguration('src', 'filesystem', [], new  RandomNamespace())
        );
    }

    public function test_it_should_throw_exception_when_install_dir_do_not_exists()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('The install dir "invalid" cannot be found.');
        new LoadEnvironment('invalid');
    }

    public function test_it_should_create_the_src_dir_when_loading_filesystem_if_folder_not_exists()
    {
        $root = vfsStream::setup('root', null, []);
        $environment = new LoadEnvironment($root->url());

        $this->assertFalse($root->hasChild('src'));
        $environment->loadEnvironment($this->event);
        $this->assertTrue($root->hasChild('src'));
    }

    public function test_it_should_not_create_the_src_dir_when_loading_filesystem_if_folder_already_exists()
    {
        $root = vfsStream::setup('root', null, ['src' => ['test.txt' => '']]);
        $environment = new LoadEnvironment($root->url());

        $this->assertTrue($root->hasChild('src/test.txt'));
        $environment->loadEnvironment($this->event);
        $this->assertTrue($root->hasChild('src/test.txt'));
    }

    public function test_it_should_load_in_memory_environment_when_specified()
    {
        $application = $this->createMock(PhpKataApplication::class);
        $this->event = new ConfigurationWasLoaded(
            $application,
            new LoadedConfiguration('src', 'in_memory', [], new  RandomNamespace())
        );
        $root = vfsStream::setup('root');
        $environment = new LoadEnvironment($root->url());

        $application
            ->expects($this->once())
            ->method('loadEnvironment')
            ->with($this->isInstanceOf(InMemoryEnvironment::class));
        $environment->loadEnvironment($this->event);
    }
}
