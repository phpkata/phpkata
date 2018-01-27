<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ActualValue;
use Star\PHPKata\Core\Model\ExpectedValue;

final class StringValue implements ExpectedValue, ActualValue
{
    /**
     * @var string
     */
    private $string;

    public function __construct(string $string)
    {
        $this->string = $string;
    }

    public function isSame(ActualValue $value): bool
    {
        return $this->toString() === $value->toString();
    }

    public function __toString(): string
    {
        return $this->string;
    }

    public function toString(): string
    {
        return $this->string;
    }
}
