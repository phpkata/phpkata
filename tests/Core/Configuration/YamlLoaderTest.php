<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Configuration;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Katas\FibonacciSequenceKata;
use Star\PHPKata\Core\Katas\HelloWorldKata;
use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataNamespace;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException as SymfonyException;

final class YamlLoaderTest extends TestCase
{
    public function test_it_should_create_a_valid_configuration_when_all_options_are_present()
    {
        $classOne = get_class($this->createMock(Kata::class));
        $classTwo = get_class($this->createMock(Kata::class));

        $loader = new YamlLoader(
"
phpkata:
    src_dir: \base\path
    environment: filesystem 
    classes:
        - $classOne
        - $classTwo
"
        );
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertSame('\base\path', $config->getSrcDir());
        $this->assertTrue(in_array($classOne, $config->getClasses()));
        $this->assertTrue(in_array($classTwo, $config->getClasses()));
    }

    public function test_it_should_create_a_configuration_when_no_classes_are_supplied()
    {
        $loader = new YamlLoader(
            '
phpkata:
    src_dir: \base\path
'
        );
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertSame('\base\path', $config->getSrcDir());
    }

    public function test_it_should_load_a_configuration_when_no_node_exists()
    {
        $loader = new YamlLoader('phpkata:');
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertSame('data', $config->getSrcDir());
        $this->assertSame('filesystem', $config->getEnvironment());
        $this->assertNotEmpty($config->getClasses());
        $this->assertSame('data', $config->getNamespace()->toString());
    }

    public function test_it_should_throw_exception_when_class_do_not_exists()
    {
        $loader = new YamlLoader(
            "
phpkata:
    classes:
        - Invalid\Class\Name
"
        );

        $this->expectException(SymfonyException::class);
        $this->expectExceptionMessage(
            'Invalid configuration for path "phpkata.classes.0": Kata class must be a valid class.'
        );
        $loader->createConfiguration();
    }

    public function test_it_should_throw_exception_when_class_do_not_implement_kata_interface()
    {
        $loader = new YamlLoader(
            "
phpkata:
    classes:
        - stdClass
"
        );
        $this->expectException(SymfonyException::class);
        $this->expectExceptionMessage(
            'Invalid configuration for path "phpkata.classes.0": Kata class must implement "Star\PHPKata\Core\Model\Kata" interface.'
        );
        $loader->createConfiguration();
    }

    /**
     * @param string $class
     * @dataProvider provideCoreKatas
     */
    public function test_should_define_core_katas_using_config(string $class)
    {
        $loader = new YamlLoader(
            '
phpkata:
'
        );
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertTrue(in_array($class, $config->getClasses()));
        $this->assertCount(2, $config->getClasses(), 'The core katas count is not as expected');
    }

    public static function provideCoreKatas()
    {
        return [
            [HelloWorldKata::class],
            [FibonacciSequenceKata::class],
        ];
    }

    public function test_should_define_environment_using_config()
    {
        $loader = new YamlLoader(
            '
phpkata:
    environment: in_memory 
'
        );
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertSame('in_memory', $config->getEnvironment());
    }

    public function test_should_define_namespace_using_config()
    {
        $loader = new YamlLoader(
            '
phpkata:
    namespace: name 
'
        );
        $config = $loader->createConfiguration();

        $this->assertInstanceOf(LoadedConfiguration::class, $config);
        $this->assertInstanceOf(KataNamespace::class, $config->getNamespace());
        $this->assertSame('name', $config->getNamespace()->toString());
    }
}
