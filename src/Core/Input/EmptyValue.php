<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Input;

use Star\PHPKata\Core\Model\ActualValue;
use Star\PHPKata\Core\Model\ExpectedValue;

final class EmptyValue implements ExpectedValue, ActualValue
{
    public function isSame(ActualValue $value): bool
    {
        return empty($value->toString());
    }

    public function __toString(): string
    {
        return '';
    }

    public function toString(): string
    {
        return '';
    }
}
