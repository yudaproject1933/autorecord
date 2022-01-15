<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link href="{{asset('landing1/css/bootstrap1.min.css')}}" rel="stylesheet" media="screen">
    <link href="{{asset('landing1/css/font-awesome.min.css')}}" rel="stylesheet">
    <script src="{{asset('landing1/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('landing1/js/jquery.js')}}"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap');

        body {
            font-family: 'Maven Pro', sans-serif;
            background-color: #eee
        }

        .card {
            background-color: #fff;
            border: none
        }

        .card .upper {
            padding: 13px
        }

        .fa-check-circle-o {
            color: blue
        }
        small {
            font-size: 8pt;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="upper p-4">
                        <div class="d-flex justify-content-between">
                            <div class="amount"> <span class="text-primary font-weight-bold">Thanks for your order</span>
                                {{-- <h4>$28</h4>  --}}
                                <br>
                                {{-- <small>Thursday,September 24th</small> --}}
                                <small>
                                    @php
                                        $tgl = date('YmdHi');
                                        $datetime = DateTime::createFromFormat('YmdHi', date('YmdHi'));
                                        echo $datetime->format('l').", ".date('Y-M-d');
                                    @endphp 
                                </small>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div class="add"> 
                                    <span class="font-weight-bold d-block">VehicleData3000</span>
                                    <small>{{url('/')}}</small> 
                                </div> 
                                <img src="https://vehicledata3000.com/public/images/logo7.png" width="60" class="rounded-circle">
                            </div>
                        </div>
                        <hr>
                        <div class="delivery">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> 
                                    <i class="fa fa-check-circle-o"></i><span class="ml-2">Full Report</span> 
                                </div> 
                                <span class="font-weight-bold">$28,00</span>
                            </div>
                        </div>
                        <hr>
                        <div class="transaction mt-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> 
                                    <i class="fa fa-check-circle-o"></i><span class="ml-2">Sales Tax</span> 
                                </div> 
                                <span class="font-weight-bold">$0,00</span>
                            </div>
                        </div>
                        <div class="transaction mt-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> 
                                    <i class="fa fa-check-circle-o"></i><span class="ml-2">Shipping Amount</span> 
                                </div> 
                                <span class="font-weight-bold">$0,00</span>
                            </div>
                        </div>
                        <div class="transaction mt-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> 
                                    <i class="fa fa-check-circle-o"></i><span class="ml-2">Insurance Amount</span> 
                                </div> 
                                <span class="font-weight-bold">$0,00</span>
                            </div>
                        </div>
                        <hr>
                        <div class="transaction mt-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center"> 
                                    <span class="ml-2"><b>Total</b></span> 
                                </div> 
                                <span class="font-weight-bold">$28,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="lower bg-primary p-4 py-5 text-white d-flex justify-content-between">
                        <div class="d-flex flex-column"> 
                            <span>Hello, your order in VehicleData300 has been complated.</span> 
                            <small>We have sent your report to your email, please check your spam folder in case the email is sent there instead of your inbox.</small> 
                            <small>We also attach your report here</small>
                            <small>If you have any questions you can send a message to cs.vehicledata3000@gmail.com</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>