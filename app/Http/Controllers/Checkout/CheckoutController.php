<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Auth;

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
        $status_payment = "checkout";
        $id_user = Auth::check() ? Auth::user()->id : null;

        $model = Transaction::where([
            'vin' => $request->vin,
            'phone' => $phone,
            'email' => $request->email,
            'status_payment' => 'checkout',
        ])->first();

        if (!$model) {
            $transaction = Transaction::create([
                'vin' => strtoupper($request->vin),
                'phone' => $phone,
                'email' => $request->email,
                'status_payment' => $status_payment,
                'id_user' => $id_user,
                'created_date' => date('Y-m-d H:i:s')
            ]);
        }

        $data = $this->transaction('POST');
        return view('checkout.checkout.index', $data);
        // dd($data);
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
        date_default_timezone_set("America/Los_Angeles");

        $phone = $this->clean_str($request->phone);

        $model = Transaction::where([
            'vin' => $request->vin,
            'phone' => $phone,
            'email' => $request->email,
        ])->first();

        if (!$model) {
            $transaction = Transaction::create([
                'vin' => strtoupper($request->vin),
                'phone' => $phone,
                'email' => $request->email,
                'status_payment' => $request->status_payment,
                'created_date' => date('Y-m-d H:i:s')
            ]);
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
