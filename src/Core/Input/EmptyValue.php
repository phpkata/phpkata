<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ExpectedValue;

final class EmptyValue implements ExpectedValue
{
    public function isSame($value): bool
    {
        return is_null($value);
    }

    public function __toString(): string
    {
        return '';
    }
}
