<?php declare(strict_types=1);

namespace Star\PHPKata\Core\Model;

interface KataRunner
{
    public function run(Kata $kata, Printer $printer): int;
}
