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
                <div class="panel-heading">Data</div>
                <div class="panel-body">
                    <table id="example" class="table display nowrap table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Gaji Pokok</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no=1; @endphp
                        @foreach ($user as $item => $value) 
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['email']}}</td>
                                <td>{{$value['role']}}</td>
                                <td>Rp. {{number_format($value['salary'])}}</td>
                                <td>{{$value['created_at']}}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" title="Reset Password"  disabled><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger" title="Delete" onclick="delete_user({{$value->id}})"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @php $no++; @endphp
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

        function delete_user(id){
            Swal.fire({
                title: 'Are you sure to delete user?',
                text: "Please check before send",
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Sure!',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: function(){
                    return $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : "/user/"+id,
                            method : "DELETE",
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