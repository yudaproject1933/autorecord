@extends('layouts.backend.main')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Transaction</h1>
        <div class="row">
            <div class="col-md-4">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaction</li>
                    <li class="breadcrumb-item active">Paypal</li>
                </ol>
            </div>
            <div class="col-md-8">
                <span style="float: right;">America/Los_Angeles : {{date("H:i:s")}}</span>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Transaction
            </div>
            <div class="card-body">
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
                        
                        <div class="col-md-12" style="margin: 20px 0px;">
                            <button class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                        </div> 
                    <hr>
                    </div>
                </form>
                <table id="example" class="table display nowrap table-bordered" width="100%">
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
                                <button class="btn btn-sm btn-danger" title="Generate" onclick="generate({{ $value->id }})"><i class="fas fa-file-alt"></i></button>
                                {{-- <button class="btn btn-sm btn-warning" title="Get File"><i class="fas fa-file-alt"></i></button> --}}
                                <a class="btn btn-sm btn-warning" title="Download Docs" href="https://www.autotrader.com/cars-for-sale/experian?SID=ATCbI8RQrUb0njwc6r&VIN={{$value->vin}}&brand=atc&ps=true" target="_blank"><i class="fas fa-file-alt"></i></a>&nbsp;
                                <button class="btn btn-sm btn-primary" title="Send Email"><i class="fas fa-paper-plane"></i></button>
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
        </div>
    </div>
</main>

<div class="modal fade" id="modal-generate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
        </div>
    </div>
</div>
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
</script>
@endsection