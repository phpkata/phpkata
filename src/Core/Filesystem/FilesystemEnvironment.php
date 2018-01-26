<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Filesystem;

use Star\PHPKata\Core\Execution\StringNamespace;
use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\KataNamespace;

final class FilesystemEnvironment implements ExecutionEnvironment
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * @var string
     */
    private $namespace;

    /**
     * @var string
     */
    private $defaultCode;

    public function __construct(string $basePath, string $namespace, string $defaultCode = '')
    {
        if (! is_dir($basePath)) {
            throw new FileNotFoundException("The directory '{$basePath}' cannot be found.");
        }
        $this->basePath = $basePath;
        $this->namespace = $namespace;
        $this->defaultCode = $defaultCode;
    }

    public function load()
    {
        $main = $this->basePath . DIRECTORY_SEPARATOR . $this->namespace . '.php';
        if (! file_exists($main)) {
            $content = <<<CONTENT
<?php
namespace {$this->namespace};
{$this->defaultCode}
###############################################
# Code before this line should not be changed #
###############################################

// Place code here

CONTENT;
            file_put_contents($main, $content);
        }

        include $main;
    }

    public function getNamespace(): KataNamespace
    {
        return new StringNamespace($this->namespace);
    }
}
