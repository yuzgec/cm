<?php

namespace App\Exports;

use App\Models\Puantaj;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Meatwebsite\Excel\Concerns\FromQuery;

class PuantajExport implements FromArray
{
    protected $puantaj;
    public function __construct(array $puantaj)
    {
        $this->puantaj = $puantaj;
    }
    public function array(): array
    {
        return $this->puantaj;
    }

}
