<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ActualValue;
use Star\PHPKata\Core\Model\ExpectedValue;

final class IntegerValue implements ExpectedValue, ActualValue
{
    /**
     * @var int
     */
    private $int;

    public function __construct(int $int)
    {
        $this->int = $int;
    }

    public function isSame(ActualValue $value): bool
    {
        return $this->toString() === $value->toString();
    }

    public function __toString(): string
    {
        return strval($this->int);
    }

    public function toString(): string
    {
        return $this->__toString();
    }
}
