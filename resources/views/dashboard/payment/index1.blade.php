@extends('layouts.backend.main1')
@section('content')
@php
$display = '';
    if (Auth::user()->role != 'admin') {
        $display = 'style="display:none" ';
    } 
    // dd($display);   
@endphp

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
                                <th <?=$display?> >Action</th>
                                <th>Vin</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Car Name</th>
                                <th <?=$display?> >Employee</th>
                                <th <?=$display?> >Link</th>
                                <th>Status</th>
                                <th>Create Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($result_model as $item => $value)
                        @php $path = Storage::url($value['link']); @endphp
                            <tr>
                                <td <?=$display?> >
                                    <a class="btn btn-sm btn-warning" title="Download Docs" href="https://www.autotrader.com/cars-for-sale/experian?SID=ATCbI8RQrUb0njwc6r&VIN={{$value->vin}}&brand=atc&ps=true" target="_blank"><i class="fa fa fa-file-pdf-o"></i></a>
                                    <button class="btn btn-sm btn-danger" title="Generate" onclick="generate({{ $value->id }})"><i class="fa fa-file-code-o"></i></button>&nbsp;
                                    {{-- <button class="btn btn-sm btn-warning" title="Get File"><i class="fa fa-file-alt"></i></button> --}}
                                    <button class="btn btn-sm btn-primary" title="Send Email" onclick="SendEmail({{$value->id}})"><i class="fa fa-paper-plane"></i></button>
                                </td>
                                @if ($value['status_payment'] == "pending")
                                    <td style="background-color: yellow; font-weight: bold;">{{$value['vin']}}</td>
                                @else
                                    <td>{{$value['vin']}}</td>
                                @endif
                                <td>{{$value['phone']}}</td>
                                <td>{{$value['email']}}</td>
                                <td>{{$value['car_name']}}</td>
                                <td <?=$display?>>{{$value['name']}}</td>
                                <td <?=$display?> >
                                    {{-- <a href="{{$path}}" target="_blank">{{is_null($value['link']) ? '' : $path}}</a> --}}
                                    {{-- <a href="{{url('/')."/storage/app/".$value['link']}}" target="_blank">{{is_null($value['link']) ? '' : url('/')."/storage/app/".$value['link']}}</a> --}}
                                    <a href="{{url('/')."/storage/app/".$value['link']}}" target="_blank">{{is_null($value['link']) ? '' : 'See Report'}}</a>
                                </td>
                                <td>{{$value['status_payment']}}</td>
                                <td>{{$value['created_date']}}</td>
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

<div class="modal fade" id="modal-generate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Generate & Upload Report</h5>
        </div>
    <form class="form-group" method="POST" action="/payment/upload_docs" enctype="multipart/form-data" id="form-docs">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="transaction_id" id="transaction_id">
            <div class="mb-3">
                <label for="message-text" class="col-form-label">File:</label>
                <input type="file" name="file_docs" class="form-control">
                </div>
            <div class="mb-3">
                <label for="message-text" class="col-form-label">Script Docs:</label>
                <textarea class="form-control" name="script_page" id="message-text" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "scrollX": true
            } );
        } );

        function generate(id){
            $('#transaction_id').val(id);
            $('#modal-generate').modal('toggle')
        }

        function SendEmail(id){
            Swal.fire({
                title: 'Are you sure to send Email?',
                text: "Please check before send",
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Send!',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: function(){
                    return $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : "/sendEmail/"+id,
                            method : "GET",
                            contentType: "application/json",
                            dataType: "json",
                            success : function (res) {
                                if (res.success) {
                                    Swal.fire({
                                        title: 'Berhasil',
                                        text: res.message,
                                        icon: 'success',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'oke'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }else{
                                                location.reload();
                                            }
                                    });
                                }else{
                                    Swal.fire({
                                        title: 'Gagal',
                                        text: "Gagal send email",
                                        icon: 'error',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'oke'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                location.reload();
                                            }else{
                                                location.reload();
                                            }
                                    });
                                }
                            },
                            error:function (xhr) {  
                            }
                        });
                }
            });
        }
    </script>
@endsection