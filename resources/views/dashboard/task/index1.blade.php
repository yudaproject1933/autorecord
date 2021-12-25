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
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">Filter :</div>
                        <div class="col-md-6"><p style="float: right;">{{date('Y-m-d H:i:s')}}</p></div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{route('task.index')}}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Start Date : </label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ isset($start_date) ? $start_date : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">End Date : </label>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ isset($end_date) ? $end_date : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Offset : </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="offset" name="offset" value="{{ isset($offset) ? $offset : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Limit : </label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="limit" name="limit" value="{{ isset($limit) ? $limit : '' }}">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="margin-top: 20px;">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                                        <button style="float: right;" class="btn btn-primary" onclick="upload_number(); return false;"><i class="fa fa-upload"></i> Upload List</button>
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
                    <form action="{{route('task.store')}}" method="POST" enctype="multipart/form-data" id="frm-example">
                        @csrf
                        <table id="example" class="table display nowrap table-bordered display select" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No</th>
                                    <th>Phone</th>
                                    <th>Car Name</th>
                                    <th>Status Payment</th>
                                    <th>Assign To</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no = 1; $checkout = 0; $pending = 0; $success = 0; $refund = 0;?>
                            @foreach ($result_model as $item => $value) 
                                <tr>
                                    <td>{{$value['id']}}</td>
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
                                    <td>{{is_null($value->user['name']) ? '' : $value->user['name']}}</td>
                                </tr>
                            <?php $no++; ?>
                            @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">Assign To : </label>
                                    <div class="col-sm-12">
                                        <select name="assign_to" id="assign_to" class="form-control" required>
                                            {{-- <option value="">--Pilih--</option> --}}
                                        @foreach ($list_employee as $item => $value)
                                            <option value="{{$value['id']}}">{{$value['name']}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-12 col-form-label">&nbsp;</label>
                                    <div class="col-sm-12">
                                        <button class="btn btn-warning"><i class="fa fa-tasks"></i> Assign To</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </form>
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
            </div><!-- /.panel-->
        </div><!-- /.col-->
        <div class="col-sm-12">
            <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
        </div>
    </div><!-- /.row -->
</div><!--/.main-->

<div class="modal fade" id="modal-upload-number" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Number</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <form class="form-group" method="POST" action="/upload-list-phone-number" enctype="multipart/form-data" id="form-docs">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">File:</label>
                        <input type="file" name="file_list_number" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        Catatan :
                        <ul>
                            <li>Data berupa file excel</li>
                        </ul>
                    </div>
                </div>
                
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
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
            var table = $('#example').DataTable({
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                        'selectRow': true
                        }
                    }
                ],
                'select': {
                    'style': 'multi'
                },
                'order': [[1, 'asc']]
            });


            // Handle form submission event
            $('#frm-example').on('submit', function(e){
                var form = this;

                var rows_selected = table.column(0).checkboxes.selected();

                // Iterate over all selected checkboxes
                $.each(rows_selected, function(index, rowId){
                    // Create a hidden element
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', 'id_number[]')
                            .val(rowId)
                    );
                });
            });

        } );

        function upload_number(){
            $('#modal-upload-number').modal('toggle')
        }
    </script>
@endsection