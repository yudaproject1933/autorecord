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
                    <form action="{{route('payment.index')}}" method="GET">
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
                                    <label class="col-sm-12 col-form-label">Status Payment : </label>
                                    <div class="col-sm-12">
                                        <select name="status_payment" id="status_payment" class="form-control" >
                                            <option value="">--Pilih--</option>
                                            <option value="checkout" {{ isset($status_payment) && $status_payment == 'checkout' ? 'selected' : '' }}>Checkout</option>
                                            <option value="pending" {{ isset($status_payment) && $status_payment == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="success" {{ isset($status_payment) && $status_payment == 'success' ? 'selected' : '' }}>Success</option>
                                            <option value="refund" {{ isset($status_payment) && $status_payment == 'refund' ? 'selected' : '' }}>Refund</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                                    </div>
                                </div>
                            </div> 
                        <hr>
                        </div>
                    </form>
                </div>
            </div><!-- /.panel-->
            
            
            <div class="panel panel-default">
                <div class="panel-heading">Data</div>
                <div class="panel-body">
                    <table id="example" class="table display nowrap table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Vin</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Link</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($result_model as $item => $value)
                            <tr>
                                <td>
                                    <button class="btn btn-sm btn-danger" title="Generate" onclick="generate({{ $value->id }})"><i class="fa fa-file-code-o"></i></button>
                                    {{-- <button class="btn btn-sm btn-warning" title="Get File"><i class="fa fa-file-alt"></i></button> --}}
                                    <a class="btn btn-sm btn-warning" title="Download Docs" href="https://www.autotrader.com/cars-for-sale/experian?SID=ATCbI8RQrUb0njwc6r&VIN={{$value->vin}}&brand=atc&ps=true" target="_blank"><i class="fa fa fa-file-pdf-o"></i></a>&nbsp;
                                    <button class="btn btn-sm btn-primary" title="Send Email"><i class="fa fa-paper-plane"></i></button>
                                </td>
                                <td>{{$value['vin']}}</td>
                                <td>{{$value['phone']}}</td>
                                <td>{{$value['email']}}</td>
                                <td><a href="{{$value['link']}}" target="_blank">{{$value['link']}}</a></td>
                                <td>{{$value['status_payment']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
    </script>
@endsection