@extends('layouts.backend.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Phone Number</h1>
        <div class="row">
            <div class="col-md-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">List</li>
                    <li class="breadcrumb-item active">Phone Number</li>
                </ol>
            </div>
            <div class="col-md-8">
                <span style="float: right;">America/Los_Angeles : {{date("H:i:s")}}</span>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Phone Number
            </div>
            <div class="card-body">
                <form action="/work-phone-number" method="GET">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label">Start Date : </label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ isset($start_date) ? $start_date : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label">End Date : </label>
                                <div class="col-sm-12">
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($end_date) ? $end_date : '' }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12" style="margin: 20px 0px;">
                            <button style="float: right;" class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                        </div> 
                    <hr>
                    </div>
                </form>
                <table id="example" class="table display nowrap table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Phone</th>
                            <th>Car Name</th>
                            <th>Status Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; $checkout = 0; $pending = 0; $success = 0; $refund = 0;?>
                    @foreach ($result_model as $item => $value) 
                        <tr>
                            <td>{{$no}}</td>
                            <td>{{$value['phone']}}</td>
                            <td>{{$value['car_name']}}</td>
                            @if ($value['status_payment'] == "checkout")
                                <td style="background-color: orange; font-weight: bold;">{{$value['status_payment']}}</td>  
                                <?php $checkout++; ?>      
                            @elseif($value['status_payment'] == "pending")
                                <td style="background-color: yellow; font-weight: bold;">{{$value['status_payment']}}</td>  
                                <?php $pending++; ?>
                            @elseif($value['status_payment'] == "success")
                                <td style="background-color: green; font-weight: bold;">{{$value['status_payment']}}</td>  
                                <?php $success++; ?>
                            @elseif($value['status_payment'] == "refund")
                                <td style="background-color: red; font-weight: bold;">{{$value['status_payment']}}</td>  
                                <?php $refund++; ?>
                            @else
                                <td>{{$value['status_payment']}}</td>    
                            @endif
                        </tr>
                    <?php $no++; ?>
                    @endforeach
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Total Number Tlpn.</th>
                                    <td>{{$no-1}}</td>
                                </tr>
                                <tr>
                                    <th>Total Success</th>
                                    <td>{{$success}}</td>
                                </tr>
                                <tr>
                                    <th>Total Refund</th>
                                    <td>{{$refund}}</td>
                                </tr>
                                <tr style="color: red;">
                                    <th>Total</th>
                                    <td>{{($success - $refund)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-8">
                        <span>Catatan Status Payment :</span>
                        <ul>
                            <li><b>Checkout</b> : Sudah menginputkan data kedalam web (belum tentu Checkout)</li>
                            <li><b>Pending</b> : Sudah malakukan Checkout (dalam proses generate Reporting)</li>
                            <li><b>Success</b> : Pembayaran sudah terkonfirmasi dan report sudah terkirim</li>
                            <li><b>Refund</b> : Melakukan pengembalian transaksi (Uang)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "scrollX": true
        } );
    } );
</script>
@endsection