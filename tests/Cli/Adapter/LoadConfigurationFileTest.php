<?php declare(strict_types=1);

namespace Star\PHPKata\Cli\Adapter;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Configuration\LoadedConfiguration;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataApplicationSubscriber;
use Star\PHPKata\Core\Model\PhpKataApplication;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

final class LoadConfigurationFileTest extends TestCase
{
    /**
     * @var LoadConfigurationFile
     */
    private $loader;

    /**
     * @var PhpKataApplication
     */
    private $application;

    /**
     * @var vfsStreamDirectory
     */
    private $root;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');
        $this->loader = new LoadConfigurationFile($this->root->url());
        $this->application = new class() implements PhpKataApplication {
            public $config;

            public function addSubscriber(KataApplicationSubscriber $subscriber)
            {
                throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
            }

            public function loadConfiguration(LoadedConfiguration $configuration)
            {
                $this->config = $configuration;
            }

            public function loadEnvironment(ExecutionEnvironment $environment)
            {
                throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
            }

            public function addKata(Kata $kata)
            {
                throw new \RuntimeException('Method ' . __METHOD__ . ' not implemented yet.');
            }
        };
    }

    public function test_it_should_load_using_default_behavior()
    {
        $this->loader->load(
            new BootingApplication(
                $this->application,
                new ArrayInput([]),
                new NullOutput()
            )
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('data', $config->getSrcDir());
    }

    public function test_it_should_load_using_phpkata_yaml_dist_file()
    {
        $this->addFile('phpkata.yml.dist', 'dist');
        $this->loader->load(
            new BootingApplication($this->application, new ArrayInput([]), new NullOutput())
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('dist', $config->getSrcDir());
    }

    public function test_it_should_load_using_phpkata_yaml_file()
    {
        $this->addFile('phpkata.yml', 'base');
        $this->loader->load(
            new BootingApplication($this->application, new ArrayInput([]), new NullOutput())
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('base', $config->getSrcDir());
    }

    public function test_it_should_load_using_phpkata_yaml_file_when_dist_file_present()
    {
        $this->addFile('phpkata.yml', 'base');
        $this->addFile('phpkata.yml.dist', 'dist');
        $this->loader->load(
            new BootingApplication($this->application, new ArrayInput([]), new NullOutput())
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('base', $config->getSrcDir());
    }

    public function test_it_should_load_using_custom_file()
    {
        $this->addFile('custom.yml', 'custom');
        $this->loader->load(
            new BootingApplication(
                $this->application,
                new ArrayInput(
                    [
                        '',
                        '--configuration' => 'custom.yml',
                    ]
                ),
                new NullOutput()
            )
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('custom', $config->getSrcDir());
    }

    public function test_it_should_load_using_custom_file_when_both_phpkata_yml_and_phpkata_dist_files_exists()
    {
        $this->addFile('phpkata.yml', 'base');
        $this->addFile('phpkata.yml.dist', 'dist');
        $this->addFile('custom.yml', 'custom');
        $this->loader->load(
            new BootingApplication(
                $this->application,
                new ArrayInput(
                    [
                        '',
                        '--configuration' => 'custom.yml',
                    ]
                ),
                new NullOutput()
            )
        );
        /**
         * @var LoadedConfiguration $config
         */
        $config = $this->application->config;
        $this->assertSame('custom', $config->getSrcDir());
    }

    public function test_it_should_throw_exception_when_custom_file_do_not_exists()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The config file "custom.yml" could not be found.');
        $this->loader->load(
            new BootingApplication(
                $this->application,
                new ArrayInput(
                    [
                        '',
                        '--configuration' => 'custom.yml',
                    ]
                ),
                new NullOutput()
            )
        );
    }

    /**
     * @param string $name
     * @param string $srcDir
     *
     * @return vfsStreamFile
     */
    private function addFile(string $name, string $srcDir): vfsStreamFile
    {
        $file = new vfsStreamFile($name);
        $file->setContent(
            '
default:
    src_dir: ' . $srcDir
        );
        $this->root->addChild($file);

        return $file;
    }
}
