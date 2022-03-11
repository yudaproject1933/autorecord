<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;

use App\Mail\TransactionEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Auth;
use File;

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

        $id_user = Auth::user()->id;
        $role = Auth::user()->role;
        // dd($id_user);

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

        $model = Transaction::select('transaction.*', 'users.name');
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
        }else{
            $model = $model->where('status_payment','!=',"checkout");
        }

        $model = $model->leftJoin('users', 'transaction.id_user', '=', 'users.id');

        if ($role == 'employee') {
            $model = $model->where('id_user',$id_user);
        }
        $model = $model->orderBy('updated_date','DESC')->orderBy('created_date','DESC')->get();
        // $model = $model->orderBy(['created_date' => 'DESC', 'updated_date' => 'DESC'])->get();

        $data['result_model'] = $model;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['status_payment'] = $status_payment;


        return view('dashboard.payment.index1', $data);
    }

    public function upload_docs(Request $request)
    {
        if ($request->file('file_docs')) {
            $model = Transaction::findOrFail($request->transaction_id);

            $file = $request->file('file_docs');
            $name_file = $file->getClientOriginalName();
            $name_file = $model['vin'].'.pdf';
            // dd($name_file);

            $path = Storage::putFileAs('public/report',$file, $name_file);

            $model = Transaction::findOrFail($request->transaction_id);
            $model->update([
                'link' => $path,
                'updated_date' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back();

        }else{
            $data = Transaction::findOrFail($request->transaction_id);
            $vin = $data->vin;
        
            $file_name = $vin.'.blade.php';
            $content_file = $request->script_page.' '.File::get(storage_path('setting_report/setting_report.blade.php'));
            // $dir = Storage::put(storage_path('app/public/report/'.$file_name),$content_file);
            // $dir = Storage::disk('local')->put('app/public/report/'.$file_name, $content_file);
            
            return $content_file;
        }
    }

    public function sendEmail($id)
    {
        $model = Transaction::findOrFail($id);
        $docs = Storage::path('app/public/report/'.$model['vin'].'.pdf');

        // return $docs;
        $details = [
            'title' => 'Mail From Premium Report',
            'body' => 'test send email',
            'link'  => url('/').Storage::url($model['link']),
            'docs_attach' => $docs,
            'docs_name' => '',
            'vin' => $model['vin'],
        ];

        $email = $model->email;
        $kirim = Mail::to($email)->send(new TransactionEmail($details));

        $model->update([
            'status_payment' => 'success',
            'updated_date' => date('Y-m-d H:i:s')
        ]);

        return [
            'success' => true,
            'message' => "Email berhasil dikirim"
        ];
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
