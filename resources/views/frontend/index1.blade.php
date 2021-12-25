@extends('layouts.frontend1.main')
@section('form_head')
    <!-- /.parallax full screen background image -->
    <div class="fullscreen landing parallax" style="background-image:url({{asset('landing1/images/slider-3.jpg')}})" data-img-width="2000" data-img-height="1333" data-diff="100">

        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">

                        <!-- /.logo -->
                        <div class="logo wow fadeInDown"> <a href=""><img src="{{asset('images/logo7.png')}}" alt="logo" style="width: 120px; height: 100px;"></a></div>

                        <!-- /.main title -->
                        <h1 class="wow fadeInLeft">
                            Get Vehicle History You Can Trust
                        </h1>

                        <!-- /.header paragraph -->
                        <div class="landing-text wow fadeInUp">
                            <p>If you have plans to sell, trade or want to know about your car. Our service can estimate the value of your vehicle, based on distance traveled or vehicle history</p>
                        </div>				  

                        <!-- /.header button -->
                        <div class="head-btn wow fadeInLeft">
                            <a href="#feature" class="btn-primary">Features</a>
                            <a href="#download" class="btn-default">Download</a>
                        </div>



                    </div> 

                    <!-- /.signup form -->
                    <div class="col-md-5">

                        <div class="signup-header wow fadeInUp">
                            <h3 class="form-title text-center">GET YOUR REPORT NOW!</h3>
                            <form class="form-header" action="/preview" role="form" method="POST" id="#">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control input-lg" name="phone" id="phone" type="text" placeholder="Phone" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" name="email" id="email" type="email" placeholder="Email address" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control input-lg" name="vin" id="vin" type="text" placeholder="VIN" maxlength="17" minlength="17" required style="text-transform:uppercase">
                                </div>
                                {{-- <div class="form-group">
                                    <input class="form-control input-lg" name="millage" id="millage" type="text" placeholder="Millage" required>
                                </div> --}}
                                <div class="form-group last">
                                    <button class="btn btn-warning btn-block btn-lg" onclick="transaction()">Check Vin</button>
                                </div>
                                <p class="privacy text-center">We will not share your email. Read our <a href="">privacy policy</a>.</p>
                                <p></p>
                            </form>
                        </div>				

                    </div>
                </div>
            </div> 
        </div> 
    </div>
@endsection


@section('content')
    @include('layouts.frontend1.isi_content')
@endsection

@section('js')

<script>
    function transaction()
    {
        var vin = $('#vin').val();
        if (vin != '') {
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url : "/transaction/"+vin,
            //     method : "GET",
            //     contentType: "application/json",
            //     dataType: "json",
            //     success : function (res) {
                    
            //     },
            //     error:function (xhr) {  
            //     }
            // });
        }
    }
    function contact_us() {
        var name = $('#name').val();
        var subject = $('#subject').val();
        var email = $('#email').val();
        var message = $('#message').val();

        if (name != '' && subject != '' && email != '' && message != '' ) {
            var data = {
                name : name,
                subject : subject,
                email :email,
                message : message
            };
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : "/checkout/contact_us",
                method : "POST",
                data: JSON.stringify(data),
                contentType: "application/json",
                dataType: "json",
                success : function (res) {
                    if (res.success) {
                        Swal.fire(
                            'Good job!',
                            'Thank you, we will contact you via email soon!',
                            'success'
                        );
                    }
                },
                error:function (xhr) {  
                }
            });
        }
    }
</script>
@endsection