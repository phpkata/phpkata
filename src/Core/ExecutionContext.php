<?php declare(strict_types=1);

namespace Star\PHPKata\Core;

use Star\PHPKata\Printing\Printer;

interface ExecutionContext
{
    /**
     * @return Printer
     */
    public function getPrinter(): Printer;
}
