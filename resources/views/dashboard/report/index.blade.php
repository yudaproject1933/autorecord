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
                        
                        <div class="col-md-12" style="margin: 20px 0px;">
                            <button class="btn btn-warning"><i class="fa fa-search"></i> Filter</button>
                            <button style="float: right;" class="btn btn-primary" onclick="upload_number(); return false;"><i class="fas fa-upload"></i> Upload List</button>
                        </div> 
                    <hr>
                    </div>
                </form>
            <form action="" method="post">
                <table id="example" class="table display nowrap table-bordered display select" width="100%">
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="select_all" value="1" id="example-select-all"></th>
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
                            <td>{{$value->user['name']}}</td>
                        </tr>
                    <?php $no++; ?>
                    @endforeach
                    </tbody>
                </table>
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
        </div>
    </div>
</main>

<div class="modal fade" id="modal-upload-number" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable({
            "scrollX": true,
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                }
            }],
            // 'order': [[1, 'asc']]
        });

        // Handle click on "Select all" control
        $('#example-select-all').on('click', function(){
            // Get all rows with search applied
            var rows = table.rows({ 'search': 'applied' }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        // Handle click on checkbox to set state of "Select all" control
        $('#example tbody').on('change', 'input[type="checkbox"]', function(){
            // If checkbox is not checked
            if(!this.checked){
                var el = $('#example-select-all').get(0);
                // If "Select all" control is checked and has 'indeterminate' property
                if(el && el.checked && ('indeterminate' in el)){
                    // Set visual state of "Select all" control
                    // as 'indeterminate'
                    el.indeterminate = true;
                }
            }
        });

        // Handle form submission event
        $('#frm-example').on('submit', function(e){
            var form = this;

            // Iterate over all checkboxes in the table
            table.$('input[type="checkbox"]').each(function(){
                // If checkbox doesn't exist in DOM
                if(!$.contains(document, this)){
                    // If checkbox is checked
                    if(this.checked){
                    // Create a hidden element
                    $(form).append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', this.name)
                            .val(this.value)
                    );
                    }
                }
            });
        });

    } );

    function upload_number(){
        $('#modal-upload-number').modal('toggle')
    }
</script>
@endsection