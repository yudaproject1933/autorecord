<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\List_phone_number;
use App\Models\User;

class Report implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function view(): View
        {
            //export adalah file export.blade.php yang ada di folder views
            return view('export', [
                //data adalah value yang akan kita gunakan pada blade nanti
                //User::all() mengambil seluruh data user dan disimpan pada variabel data
                'data' => User::get()
            ]);
        }
}
