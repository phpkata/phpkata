<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Steps;

use Star\PHPKata\Core\Step;

final class FunctionExists implements Step
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return "Function with name '{$this->name}' exists.";
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return function_exists($this->name);
    }
}
