<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

final class StringMessage implements Message
{
    /**
     * @var string
     */
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function toString(): string
    {
        return $this->message;
    }
}
