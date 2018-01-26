<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

use PHPUnit\Framework\TestCase;
use Star\PHPKata\Core\Katas\NullKata;
use Star\PHPKata\Core\Printing\BufferedPrinting;

final class ApplicationRunnerTest extends TestCase
{
    /**
     * @var ApplicationRunner
     */
    private $runner;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|ExecutionEnvironment
     */
    private $environment;

    public function setUp()
    {
        $this->environment = $this->createMock(ExecutionEnvironment::class);
        $this->runner = new ApplicationRunner('version', $this->environment);
    }

    public function test_it_should_print_the_header_with_version()
    {
        $print = new BufferedPrinting();
        $this->assertSame(0, $this->runner->run(new NullKata(), $print));
        $this->assertContains(
            'PHPKata version by Yannick Voyer and contributors.',
            $print->getDisplay()
        );
    }

    public function test_it_should_print_success_message_when_result_passes()
    {
        $this->runner->run(new NullKata(), $print = new BufferedPrinting());
        $this->assertContains(
            $successMessage = 'You successfully completed the "Stub kata" kata.',
            $print->getDisplay()
        );

        return $successMessage;
    }
}
