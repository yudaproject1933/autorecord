<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\User;

use Illuminate\Contracts\View\View; //Harus diimport untuk men-convert blade menjadi file excel
use Maatwebsite\Excel\Concerns\FromView; 

class ReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {;
    //     return view('dashboard.report.generate_report', [
    //         'data' => User::where(['role' => 'admin'])->get()
    //     ]);
    // }

    public function view(): View
        {
            return view('dashboard.report.generate_report', [
                'data' => User::where(['role' => 'admin'])->get()
            ]);
        }

    
}
