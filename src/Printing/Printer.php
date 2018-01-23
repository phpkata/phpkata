<?php declare(strict_types=1);

namespace Star\PHPKata\Printing;

use Star\PHPKata\Core\ResultVisitor;

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
}
