<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

final class TestCaseRunner
{
    /**
     * @param string $file
     * @param string $code
     *
     * @return int
     */
    public static function run(string $file, string $code = ''): int
    {
        $info = pathinfo($file);
        $kataFolder = str_replace(
            $info['basename'],
            $namespace = $info['filename'],
            realpath($file)
        );
        $mainFile = $kataFolder . DIRECTORY_SEPARATOR . $namespace . '.php';

        if (! file_exists($kataFolder)) {
            mkdir($kataFolder);
        }

        if (! file_exists($mainFile)) {
            @unlink($mainFile);
        }

        $env = new \Star\PHPKata\Core\Filesystem\FilesystemEnvironment(
            $kataFolder,
            $namespace,
            $code
        );
        $app = new \Star\PHPKata\Cli\KataApplication($env);

        return $app->run();
    }

    /**
     * @param string $code
     *
     * @return int
     */
    public static function evaluate(string $code): int
    {
        $env = new \Star\PHPKata\Core\Execution\InMemoryEnvironment(
            new \Star\PHPKata\Core\Execution\RandomNamespace(),
            $code
        );
        $app = new \Star\PHPKata\Cli\KataApplication($env);

        return $app->run();
    }
}
