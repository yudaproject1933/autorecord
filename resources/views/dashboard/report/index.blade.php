@extends('layouts.backend.main1')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active" style="text-transform: capitalize;">{{$menu_active}}</li>
        </ol>
    </div><!--/.row-->
    
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" style="text-transform: capitalize;">{{$menu_active}}</h1>
        </div>
    </div><!--/.row-->
            
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Filter</div>
                <div class="panel-body">
                    <form action="{{route('report.index')}}" method="GET">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Employee : </label>
                                    <div class="col-sm-12">
                                        <select name="employee" id="employee" class="form-control">
                                            <option value="">--Pilih--</option>
                                        @foreach ($list_employee as $item => $value)
                                            <option value="{{$value['id']}}" {{ isset($employee) && $employee == $value['id'] ? 'selected' : '' }}>{{$value['name']}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                                        <button style="float: right;" class="btn btn-primary" onclick="download_report(); return false;"><i class="fa fa-download"></i> Download Report</button>
                                    </div>
                                </div>
                            </div> 
                        <hr>
                        </div>
                    </form>
                </div>
            </div><!-- /.panel-->
        </div>
        
        
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data</div>
                <div class="panel-body">
                    <table id="example" class="table display nowrap table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>VIN</th>
                                <th>Phone</th>
                                <th>Car Name</th>
                                <th>Email</th>
                                <th>Status Payment</th>
                                <th>Checkout</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; $checkout = 0; $pending = 0; $success = 0; $refund = 0;?>
                        @foreach ($transaction as $item => $value) 
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$value['vin']}}</td>
                                <td>{{$value['phone']}}</td>
                                <td>{{$value['car_name']}}</td>
                                <td>{{$value['email']}}</td>
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
                                <td>{{$value['updated_date']}}</td>
                            </tr>
                        @php $no++; @endphp
                        @endforeach
                        </tbody>
                    </table>



                    <hr>
                    <h3>Report</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table">
                                <tbody>
                                    {{-- <tr>
                                        <th>Total Number Tlpn.</th>
                                        <td>{{$no-1}}</td>
                                    </tr> --}}
                                    <tr>
                                        <th>Total Success</th>
                                        <td>{{$success}}</td>
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
                                {{-- <li><b>Refund</b> : Melakukan pengembalian transaksi (Uang)</li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.panel-->
        </div><!-- /.col-->
        
        <div class="col-sm-12">
            <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
        </div>
    </div><!-- /.row -->
</div><!--/.main-->

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true
            } );
        } );

        function download_report(){
            alert('masuk');
        }
    </script>
@endsection