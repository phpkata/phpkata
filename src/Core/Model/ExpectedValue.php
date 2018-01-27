<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface ExpectedValue
{
    /**
     * Whether the $value is strict equal (===)
     *
     * @param ActualValue $value
     *
     * @return bool
     */
    public function isSame(ActualValue $value): bool;

    /**
     * The string representation of the value
     *
     * @return string
     */
    public function __toString(): string;
}
