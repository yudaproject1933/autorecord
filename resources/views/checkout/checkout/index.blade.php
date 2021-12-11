@extends('layouts.frontend1.main')

@section('content')
<style>
    .detail-vehicle{
        border: 3px solid;
        border-radius: 5px;
        padding: 10px;
    }
    .detail-vehicle p{
        padding: 0;
    }
</style>
    <br>
    <div id="head">
        <div class="container">
            <div class="row">
                <h3><i class="fa fa-check-circle"></i> Report Found!</h3>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="detail-vehicle">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="{{asset('landing1/images/car.png')}}" alt=""><br>
                                        <p><b>Make : </b>{{$make}}</p>
                                        <p><b>Year : </b>{{$year}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>{{$vehicle}}</h4>
                                        <p><b>VIN : </b>{{$vin}}</p>
                                        <p><b>Model : </b>{{$model}}</p>
                                        <p><b>Engine : </b>{{$engine}}</p>
                                        <p><b>Made In : </b>{{$made_in}}</p>
                                        <p><b>Type : </b>{{$type}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12" style="margin-top: 40px;">
                            <div class="col-md-4">
                                <img src="{{asset('images/refund-money.png')}}" alt="" style="width: 100%; height: 150px;">
                                <span>100% Save Your Money More</span>
                            </div>
                            <div class="col-md-4">
                                <img src="{{asset('images/user-shield.png')}}" alt="" style="width: 100%; height: 150px;">
                                <span>Your Information is Secure</span>
                            </div>
                            <div class="col-md-4">
                                <img src="{{asset('images/money-back.jpg')}}" alt="" style="width: 100%; height: 150px;">
                                <span>100% Safe and Secure</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{-- <h3></h3> --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Full Report</td>
                                <td>x1</td>
                                <td>$28</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Sub Total</td>
                                <td></td>
                                <td style="font-weight: bold">$28</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Total</td>
                                <td></td>
                                <td style="font-weight: bold">$28</td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-warning btn-block btn-lg" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Payment</button>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="card card-body">
                                    <br>
                                    <h4>Continue below to buy Full Report with PayPal</h4>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="checkout-phone" id="checkout-phone" type="text" placeholder="Phone" required value="{{isset($phone) ? $phone : ''}}">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="checkout-email" id="checkout-email" type="email" placeholder="Email address" required value="{{isset($email) ? $email : ''}}">
                                    </div>
                                    <span><i class="fa fa-exclamation-circle"></i> We will send a report to your email, make sure the email is correct!</span>
                                    <hr style="margin: 10px 0px;">
                                    <input type="checkbox" onclick="form_done()" id="checkout-check" disabled>&nbsp;<label for="checkout-check"> Please confirm, if the data you entered is correct</label>
                                    <button class="btn btn-warning btn-block btn-lg" id="checkout-payment" disabled>PayPal</button>
                                    <span>By continuing to PayPal, you agree to our <a href="#" style="text-decoration: underline;">Terms of Service.</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>			  
        </div>
    </div>
    
    @include('layouts.frontend1.isi_content')
@endsection

@section('js')
<script>
    $( document ).ready(function() {
        var email = $('#checkout-email').val();
        var phone = $('#checkout-phone').val();
        if (email != '' && validateEmail(email) && phone != '') {
            $('#checkout-check').prop('disabled',false);
        }

        
        $("#checkout-phone").keyup(function() {
            var email = $('#checkout-email').val();
            var phone = $('#checkout-phone').val();
            if (phone != '' && email != '') {
                $('#checkout-check').prop('disabled',false);
            }else{
                $('#checkout-check').prop('disabled',true);
            }
        });
        $("#checkout-email").keyup(function() {
            var email = $('#checkout-email').val();
            var phone = $('#checkout-phone').val();
            if (email != '' && validateEmail(this.value) && phone != '') {
                $('#checkout-check').prop('disabled',false);
            }else{
                $('#checkout-check').prop('disabled',true);
            }
        });
    }); 
    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) {
            return false;
        } else {
            return true;
        }
    }
    function form_done() {
        var vin = '<?=$vin?>';
        var phone = $('#checkout-phone').val();
        var email = $('#checkout-email').val();

        if (vin != '' && phone != '' && email != '' && $('#checkout-check').is(':checked') ) {
            $('#checkout-payment').prop('disabled',false);
            var data = {
                vin : vin,
                phone : phone,
                email :email,
                status_payment : "checkout"
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : "{{ route('checkout.store') }}",
                method : "POST",
                data: JSON.stringify(data),
                contentType: "application/json",
                dataType: "json",
                success : function (res) {
                    if (res.success) {
                        
                    }
                },
                error:function (xhr) {  
                }
            });
        }else{
            $('#checkout-payment').prop('disabled',true);
        }
    }
</script>    
@endsection
