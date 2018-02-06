<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Configuration;

use Star\PHPKata\Core\Execution\StringNamespace;
use Star\PHPKata\Core\Katas\FibonacciSequenceKata;
use Star\PHPKata\Core\Katas\HelloWorldKata;
use Star\PHPKata\Core\Model\Kata;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

final class YamlLoader implements ConfigurationLoader
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param string $ymlString
     */
    public function __construct(string $ymlString)
    {
        $this->string = $ymlString;
    }

    public function createConfiguration(): LoadedConfiguration
    {
        $builder = new TreeBuilder();
        $builder->root('phpkata')
            ->children()
                ->scalarNode('src_dir')
                    ->defaultValue('data')
                ->end()
                ->scalarNode('namespace')
                    ->defaultValue('data')
                ->end()
                ->scalarNode('environment')
                    ->defaultValue('filesystem')
                ->end()
                ->arrayNode('classes')
                    ->scalarPrototype()
                        ->validate()->ifTrue(
                            function (string $class) {
                                return ! class_exists($class);
                            }
                        )->thenInvalid('Kata class must be a valid class.')->end()
                        ->validate()->ifTrue(
                            function (string $class) {
                                $implements = class_implements($class);
                                return ! in_array(Kata::class, $implements);
                            }
                        )->thenInvalid(
                            sprintf('Kata class must implement "%s" interface.', Kata::class)
                        )->end()
                    ->end()
                ->end()
            ->end();

        $dumper = new Processor();
        $config = $dumper->process($builder->buildTree(), Yaml::parse($this->string));

        return new LoadedConfiguration(
            $config['src_dir'],
            $config['environment'],
            array_merge($this->getCoreKata(), $config['classes']),
            new StringNamespace($config['namespace'])
        );
    }

    private function getCoreKata(): array
    {
        return [
            HelloWorldKata::class,
            FibonacciSequenceKata::class,
        ];
    }
}
