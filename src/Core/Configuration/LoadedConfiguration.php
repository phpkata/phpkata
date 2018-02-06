<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Configuration;

use Star\PHPKata\Core\Model\Kata;
use Star\PHPKata\Core\Model\KataNamespace;

final class LoadedConfiguration
{
    /**
     * @var string
     */
    private $srcDir;

    /**
     * @var string
     */
    private $environment;

    /**
     * @var string[]
     */
    private $kataClasses = [];

    /**
     * @var KataNamespace
     */
    private $namespace;

    /**
     * @param string $srcDir
     * @param string $environment
     * @param array $kataClasses
     * @param KataNamespace $namespace
     */
    public function __construct(
        string $srcDir,
        string $environment,
        array $kataClasses,
        KataNamespace $namespace
    ) {
        $this->srcDir = $srcDir;
        $this->environment = $environment;
        foreach ($kataClasses as $class) {
            $this->addClass($class);
        }
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getSrcDir(): string
    {
        return $this->srcDir;
    }

    /**
     * @return string[]
     */
    public function getClasses(): array 
    {
        return $this->kataClasses;
    }

    private function addClass(string $class)
    {
        if (! class_exists($class)) {
            throw new InvalidConfigurationException(
                sprintf("The provided kata class '%s' do not exists.", $class)
            );
        }

        if (! in_array(Kata::class, class_implements($class))) {
            throw new InvalidConfigurationException(
                sprintf("All provided kata class must implement the Kata interface, '%s' does not.", $class)
            );
        }

        $this->kataClasses[] = $class;
    }

    /**
     * @return KataNamespace
     */
    public function getNamespace(): KataNamespace
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }
}
