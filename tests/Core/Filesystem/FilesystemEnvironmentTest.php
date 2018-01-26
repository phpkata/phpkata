<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Filesystem;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

/**
 * @runTestsInSeparateProcesses
 */
final class FilesystemEnvironmentTest extends TestCase
{
    /**
     * @expectedException        \Star\PHPKata\Core\Filesystem\FileNotFoundException
     * @expectedExceptionMessage The directory 'not-found' cannot be found.
     */
    public function test_it_should_throw_exception_when_base_path_not_found()
    {
        new FilesystemEnvironment('not-found', 'namespace');
    }

    /**
     * @var string $code
     * @dataProvider provideGeneratedCode
     */
    public function test_it_should_generate_template_when_template_not_exists(string $code)
    {
        $root = vfsStream::setup();
        $this->assertFalse($root->hasChild('main.php'));

        $runner = new FilesystemEnvironment($root->url(), 'main');
        $runner->load();

        $this->assertTrue($root->hasChild('main.php'));
        $main = $root->getChild('main.php');
        $this->assertContains($code, $main->getContent());
    }

    public static function provideGeneratedCode()
    {
        return [
            'Should generate php tag' => ['<?php'],
            'Should generate hint on where to put code' => ['// Place code here'],
            'Should generate warning not to change previous code' => ['# Code before this line should not be changed #'],
            'Should generate namespace based on file name' => ['namespace main;'],
        ];
    }

    public function test_it_should_not_replace_template_when_template_exists()
    {
        $root = vfsStream::setup('root', null, ['main.php' => '<?php //data']);
        $this->assertTrue($root->hasChild('main.php'));

        $runner = new FilesystemEnvironment($root->url(), 'main');
        $runner->load();

        $this->assertTrue($root->hasChild('main.php'));
        $main = $root->getChild('main.php');
        $this->assertContains('<?php //data', $main->getContent());
    }

    public function test_it_should_allow_to_include_a_function_multiple_time_using_namespace()
    {
        $root = vfsStream::setup();

        $runnerOne = new FilesystemEnvironment($root->url(), 'main1', 'function methodOne() {}');
        $runnerTwo = new FilesystemEnvironment($root->url(), 'main2', 'function methodOne() {}');

        $runnerOne->load();
        $runnerTwo->load();

        $this->assertTrue(function_exists('\main1\methodOne'), 'Function should be namespaced');
        $this->assertTrue(function_exists('\main2\methodOne'), 'Function should be namespaced');
    }
}
