<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface Printer extends ResultVisitor
{
    /**
     * @param KataDetail $detail
     */
    public function printKata(KataDetail $detail);

    /**
     * @param string $text
     */
    public function printHeader(string $text);

    /**
     * @param Message $message
     */
    public function printMessage(Message $message);
}
