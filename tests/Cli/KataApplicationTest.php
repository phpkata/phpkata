<?php declare(strict_types=1);

namespace Star\PHPKata\Cli;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\ApplicationTester;

final class KataApplicationTest extends TestCase
{
    public function test_it_should_load_the_application_without_config()
    {
        $tester = $this->getTester(['data' => []]);
        $this->assertSame(0, $tester->run([]));
    }

    public function test_it_should_load_the_application_from_the_phpkata_yml_dist_file()
    {
        $yaml = '
default:
    src_dir: base
';
        $tester = $this->getTester(['phpkata.yml.dist' => $yaml, 'base' => []]);
        $this->assertSame(0, $tester->run([]));
    }

    public function test_it_should_load_the_application_from_the_phpkata_yml_file()
    {
        $yamlOne = '
default:
    src_dir: one
';
        $yamlTwo = '
default:
    src_dir: two
';
        $tester = $this->getTester(
            [
                'phpkata.yml.dist' => $yamlOne,
                'phpkata.yml' => $yamlTwo,
                'two' => [],
            ]
        );
        $this->assertSame(0, $tester->run([]));
    }

    public function test_it_should_load_the_application_from_specified_path()
    {
        $yaml = '
default:
    src_dir: fromOtherPath
';
        $tester = $this->getTester(
            [
                'some.path.of_config.yml' => $yaml,
                'fromOtherPath' => [],
            ]
        );
        $this->assertSame(0, $tester->run(['-c' => 'some.path.of_config.yml']));
    }

    public function test_it_should_output_a_warning_when_a_config_error_occurs()
    {
        $yaml = '
default:
    classes:
        - stdClass
';
        $tester = $this->getTester(
            [
                'phpkata.yml' => $yaml,
                'data' => [],
            ]
        );
        $this->assertSame(1, $tester->run([]));
        $this->assertContains(
            'Invalid configuration for path "phpkata.classes.0":',
            $tester->getDisplay()
        );
        $this->assertContains(
            'Kata class must implement "Star\PHPKata\Core\Model\Kata" interface.',
            $tester->getDisplay()
        );
    }

    /**
     * @param array $structure
     *
     * @return ApplicationTester
     */
    protected function getTester(array $structure): ApplicationTester
    {
        $root = vfsStream::setup('root', null, $structure);
        $application = new KataApplication($root->url());
        $application->setAutoExit(false);
        $tester = new ApplicationTester($application);

        return $tester;
    }
}
