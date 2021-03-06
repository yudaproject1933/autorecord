<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction;
use App\Models\List_task_phone;
use App\Models\Task;
use Auth;

use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('checkout.checkout.index');
    }

    public function transaction($status = '')
    {
        if ($status == 'POST') {
            $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $vin = isset($_POST['vin']) ? $_POST['vin'] : '';
        }else{
            $phone = isset($_GET['phone']) ? $_GET['phone'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';
            $vin = isset($_GET['vin']) ? $_GET['vin'] : '';
        }
        // dd($vin);

        $vehicle = "";
        $model = "";
        $engine = "";
        $made_in = "";
        $type = "";
        $make = "";
        $year = "";
        try {
            $api = file_get_contents("https://api.vinaudit.com/query.php?key=VA_MAIN&callback=VA_OnQueryData&vin=".$vin."&try=0&mode=&rd=0.1393359419048803");
            $rep_json = str_replace(['VA_OnQueryData(',')',';'],"",$api);
            $result = json_decode($rep_json,true);
            if ($result['success']) {
                // dd($result);
                foreach ($result['attributes'] as $key => $value) {
                    if ($key == "Year") {
                        $year = $value;
                    }
                    if ($key == "Make") {
                        $make = $value;
                    }
                    if ($key == "Model") {
                        $model = $value;
                    }
                    if ($key == "Engine") {
                        $engine = $value;
                    }
                    if ($key == "Made In") {
                        $made_in = $value;
                    }
                    if ($key == "Style") {
                        $style = $value;
                    }
                    if ($key == "Type") {
                        $type = $value;
                    }
                }
            }
            

            $api1 = file_get_contents('https://ownershipcost.vinaudit.com/getownershipcost.php?key=VA_DEMO_KEY&vin='.$vin.'&mileage_start=-1&mileage_year=-1&country=');
            $result1 = json_decode($api1,true);
            // dd($result1);
            if ($result1['success']) {
                $vehicle = $result1['vehicle'];
            }
            // dd($result1);
        } catch (\Exception $e) {
            //throw $th;
        }
        
        
        $data['phone'] = $phone;
        $data['email'] = $email;
        $data['vin'] = $vin;

        $data['vehicle'] = $vehicle;
        $data['model'] = $model;
        $data['engine'] = $engine;
        $data['made_in'] = $made_in;
        $data['type'] = $type;
        $data['make'] = $make;
        $data['year'] = $year;

        // dd('masuk');
        if ($status == 'POST') {
            return $data;
        }else{
            return view('checkout.checkout.index', $data);
        }
        
    }

    public function preview(Request $request)
    {
        date_default_timezone_set("America/Los_Angeles");

        $phone = $this->clean_str($request->phone);

        $data = $this->transaction('POST'); //call function transaction
        $car_name = $data['vehicle'];

        $id_user = null;
        $get_id_user = Task::where(['phone' => $phone])->first();
        if ($get_id_user) {
            $id_user = $get_id_user->id_employee;
        }

        $status_payment = "checkout";
        $model = Transaction::where([
            'vin' => $request->vin,
            'phone' => $phone,
            'email' => $request->email,
            'status_payment' => 'checkout',
        ])->first();

        if (!$model) {
            $transaction = Transaction::create([
                'vin' => strtoupper($request->vin),
                'car_name' => $car_name,
                'phone' => $phone,
                'email' => $request->email,
                'status_payment' => $status_payment,
                'id_user' => $id_user,
                'created_date' => date('Y-m-d H:i:s')
            ]);
        }

        
        return view('checkout.checkout.index', $data);
        // dd($data);
    }

    public function contact_us(Request $request){
        $message_send = [
            'name' => $request->name,
            'subject' => $request->subject,
            'email' => $request->email,
            'message_body' => $request->message,
        ];

        $kirim = Mail::send('checkout.contact_us.template', ['body_message' => $message_send], function($message)
                {
                    $message->from('vehicledata3000@gmail.com','Complaint Vehicle Data 3000')
                        ->to('cs.vehicledata3000@gmail.com')
                        ->subject('Complaint');
                });
        
        // return redirect('/');
        return [
            'success' => true,
            'message' => "Email berhasil dikirim"
        ];
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
        $phone = $this->clean_str($request->phone);
        // dd($request->car_name);

        if ($request->status_payment == "pending") {    //sudah bayar
            $model = Transaction::where([
                'vin' => $request->vin,
                'phone' => $phone,
                'email' => $request->email,
                'status_payment' => "checkout",
            ])->first();

            if ($model) {
                $model->update([
                    'status_payment' => $request->status_payment,
                    'updated_date' => date('Y-m-d H:i:s')
                ]);
            }
            
        }else{      //hanya checkout

            $id_user = null;
            $get_id_user = Task::where(['phone' => $phone])->first();
            if ($get_id_user) {
                $id_user = $get_id_user->id_employee;
            }

            // dd($id_user);

            $model = Transaction::where([
                'vin' => $request->vin,
                'phone' => $phone,
                'email' => $request->email,
                'status_payment' => $request->status_payment,
            ])->first();
    
            if (!$model) {
                $transaction = Transaction::create([
                    'vin' => strtoupper($request->vin),
                    'car_name' => $request->car_name,
                    'phone' => $phone,
                    'email' => $request->email,
                    'status_payment' => $request->status_payment,
                    'id_user' => $id_user,
                    'created_date' => date('Y-m-d H:i:s')
                ]);
            }
        }

        
        return [
            'status' => true
        ];
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

    public function clean_str($string) {
        $string = str_replace('-', '', $string); // Replaces all spaces with hyphens.
        $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
