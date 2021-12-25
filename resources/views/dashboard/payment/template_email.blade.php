<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>
    <link href="{{asset('backend/asset/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="width: 100%;">
                    <center>
                        <img class="card-img-top" src="https://vehicledata3000.com/public/images/logo7.png" alt="Card image cap" style="width: 130px;">
                    </center>
                    
                    <div class="card-body">
                        <h3 class="card-title" style="text-align: center;"><b>Order has benn completed</b></h3>
                        <h4>List Order :</h4>
                        <table class="table" style="width: 50%" border="1">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Full Report</td>
                                    <td>$28</td>
                                </tr>
                                <tr>
                                    <td>TOTAL</td>
                                    <td>$28</td>
                                </tr>
                            </tbody>
                        </table>
                        <p>Hello, your last order on "VehicleData3000" has been completed.</p>
                        <p>We have sent your report to your email, please check your spam folder in case the email is sent there instead of your inbox.</p>
                        <p>We also attach your report here.</p>
                        <p>if you have any questions you can send a message to cs.vehicledata3000@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
        
    <script src="{{asset('landing1/js/jquery.js')}}"></script>
    <script src="{{asset('backend/asset/js/bootstrap.min.js')}}"></script>
</body>
</html>