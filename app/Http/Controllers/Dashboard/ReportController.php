<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\User;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_active'] = "report";

        $tgl_now = '';
        $tgl_end = '';

        if (date('d') <= 15) {
            $tgl_now = date('Y-m-01');
            $tgl_end = date('Y-m-15');
        }else{
            $tgl_now = date('Y-m-16');
            $tgl_end = date('Y-m-t');
        }

        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : $tgl_now;
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : $tgl_end;
        $employee = isset($_GET['employee']) ? $_GET['employee'] : '';

        $model = Transaction::select('*');
        if ($start_date !== '' && $end_date === '') {
            $model = $model->whereDate('created_date', '=', $start_date);
        }
        if ($start_date !== '' && $end_date !== '') {
            $model = $model->whereDate('created_date', '>=', $start_date);
        }
        if ($end_date !== '') {
            $model = $model->whereDate('created_date', '<=', $end_date);
        }
        if ($employee !== '') {
            $model = $model->where(['id_user' => $employee]);
        }

        $model = $model->where(['status_payment' => 'success'])->orderBy('created_date','DESC')->get();

        $model_employee = User::whereIn('role', ['employee', 'admin'])->get();

        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['employee'] = $employee;
        $data['transaction'] = $model;
        $data['list_employee'] = $model_employee;

        return view('dashboard.report.index', $data);
    }

    public function generate_report()
    {
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';
        $employee = isset($_GET['employee']) ? $_GET['employee'] : '';

        // dd('masuk');
        // return Excel::download(new ReportExport, 'Data_user.xlsx');
        // return (new ReportExport)->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);

        $data = User::get()->toArray();
        // return Excel::store('new ReportExport', function($excel) use ($data) {
        //     $excel->sheet('mySheet', function($sheet) use ($data)
        //     {
        //         $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
        //         $sheet->cell('B1', function($cell) {$cell->setValue('Last Name');   });
        //         $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });
        //         if (!empty($data)) {
        //             foreach ($data as $key => $value) {
        //                 $i= $key+2;
        //                 $sheet->cell('A'.$i, $value['firstname']); 
        //                 $sheet->cell('B'.$i, $value['lastname']); 
        //                 $sheet->cell('C'.$i, $value['email']); 
        //             }
        //         }
        //     });
        // });
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
