<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Execution;

use Star\PHPKata\Core\Model\ExecutionEnvironment;
use Star\PHPKata\Core\Model\KataNamespace;

final class InMemoryEnvironment implements ExecutionEnvironment
{
    /**
     * @var KataNamespace
     */
    private $namespace;

    /**
     * @var string
     */
    private $code;

    /**
     * @param KataNamespace $namespace
     * @param string $code
     */
    public function __construct(KataNamespace $namespace, string $code)
    {
        $this->namespace = $namespace;
        $this->code = $code;
    }

    /**
     * @return KataNamespace
     */
    public function getNamespace(): KataNamespace
    {
        return $this->namespace;
    }

    /**
     * Load the necessary resource for the environment
     */
    public function load()
    {
        // todo Catch exception to handle flow. function(int some arg) {} when giving "" or array)
        $code = sprintf('namespace %s; %s', $this->namespace->toString(), $this->code);

        eval($code); // Eval is safe here, since the eval construct can't be called using user input.
    }
}
