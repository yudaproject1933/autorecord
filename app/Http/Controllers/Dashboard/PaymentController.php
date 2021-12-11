<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Storage;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['menu_active'] = "transaction";

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
        $status_payment = isset($_GET['status_payment']) ? $_GET['status_payment'] : '';

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
        if ($status_payment !== '') {
            $model = $model->where('status_payment',$status_payment);
        }

        $model = $model->orderBy('created_date','DESC')->get();

        $data['result_model'] = $model;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['status_payment'] = $status_payment;


        return view('dashboard.payment.index1', $data);
    }

    public function upload_docs(Request $request)
    {
        
        if ($request->file('file_docs')) {
            dd('masuk');
        }else{
            dump($request->script_page);
            dump($request->transaction_id);
            dd('sini');
        }
    }

    public function preview_report()
    {
        // $data = ['masuk'];
        // die($data);
        // dd($data);
        return view('dashboard.payment.sample_report');
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
