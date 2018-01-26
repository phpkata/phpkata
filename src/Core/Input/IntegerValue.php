<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ExpectedValue;

final class IntegerValue implements ExpectedValue
{
    /**
     * @var int
     */
    private $int;

    public function __construct(int $int)
    {
        $this->int = $int;
    }

    public function isSame($value): bool
    {
        return $this->int === $value;
    }

    public function __toString(): string
    {
        return strval($this->int);
    }
}
