<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class IzinExport implements FromArray
{
    protected $izinler;
    public function __construct(array $izinler)
    {
        $this->izinler = $izinler;
    }

    public function array(): array
    {
        return $this->izinler;
    }
}
