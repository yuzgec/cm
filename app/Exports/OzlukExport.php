<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Meatwebsite\Excel\Concerns\FromQuery;

class OzlukExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $users;
    public function __construct(array $users)
    {
        $this->users = $users;
    }
    public function array(): array
    {
        return $this->users;
    }
}
