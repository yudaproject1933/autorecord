<?php

namespace App\Exports;

use App\Models\List_phone_number;
use Maatwebsite\Excel\Concerns\FromCollection;

class List_phone_numberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return List_phone_number::all();
    }
}
