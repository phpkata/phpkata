<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\ApplicationTester;

/**
 * @runTestsInSeparateProcesses
 */
final class KataApplicationTest extends TestCase
{
    /**
     * @expectedException        \Star\PHPKata\Core\FileNotFoundException
     * @expectedExceptionMessage The directory 'not-found' cannot be found.
     */
    public function test_it_should_throw_exception_when_base_path_not_found()
    {
        new KataApplication('not-found');
    }

    public function test_it_should_generate_main_template_when_template_not_exists()
    {
        $root = vfsStream::setup();
        $this->assertFalse($root->hasChild('main.php'));

        $application = new KataApplication($root->url());
        $application->setAutoExit(false);
        $tester = new ApplicationTester($application);
        $this->assertSame(0, $tester->run(['hello-world']));

        $this->assertTrue($root->hasChild('main.php'));
        $main = $root->getChild('main.php');
        $this->assertContains('<?php', $main->getContent());
        $this->assertContains('// Place your code here', $main->getContent());
    }

    public function test_it_should_fail_when_function_not_exists()
    {
        $tester = new EnvironmentTester('');
        $this->assertSame(0, $tester->execute('hello-world'));
    }

    public function test_it_should_fail_when_returned_value_not_same()
    {
        $tester = new EnvironmentTester(
            'function helloWorld() { return "wrong"; }'
        );
        $this->assertSame(0, $tester->execute('hello-world'));
    }

    public function test_it_should_succeed_when_returned_expected_value()
    {
        $tester = new EnvironmentTester(
            'function helloWorld() { return "Hello world"; }'
        );
        $this->assertSame(0, $tester->execute('hello-world'));
    }
}
