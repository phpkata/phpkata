<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ExpectedValue;

final class StringValue implements ExpectedValue
{
    /**
     * @var string
     */
    private $string;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function isSame($value): bool
    {
        return $this->string === $value;
    }

    public function __toString(): string
    {
        return $this->string;
    }
}
