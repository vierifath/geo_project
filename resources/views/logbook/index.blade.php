@extends('layouts.home')

@section('title','Logbook')

@section('navbar')
@include('layouts.navbar_auth')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
  <link rel="stylesheet" href="{{url('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
    <!-- Custom styles for this page -->
    <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <style>
        @font-face{font-family:'Glyphicons Halflings';src:url('../fonts/glyphicons-halflings-regular.eot');src:url('../fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'),url('../fonts/glyphicons-halflings-regular.woff') format('woff'),url('../fonts/glyphicons-halflings-regular.ttf') format('truetype'),url('../fonts/glyphicons-halflings-regular.svg#glyphicons-halflingsregular') format('svg');}.glyphicon{position:relative;top:1px;display:inline-block;font-family:'Glyphicons Halflings';font-style:normal;font-weight:normal;line-height:1;-webkit-font-smoothing:antialiased;}
.glyphicon-chevron-left:before{content:"\e079";}
.glyphicon-chevron-right:before{content:"\e080";}
.glyphicon-chevron-up:before{content:"\e113";}
.glyphicon-chevron-down:before{content:"\e114";}
    </style>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Logbook</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Logbook</h6>
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus fa-sm text-white-50"></i> Add Logbook</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Topic</th>
                                    <th>Comentar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logbooks as $logbook)
                                    <tr>
                                        <td>{{$logbook['created_at']}}</td>
                                        <td>{{$logbook['topik']}}</td>
                                        <td>{{$logbook['komentar']}}</td>
                                        <td>
                                            @switch($logbook['status'])
                                                @case(0)
                                                    <button class="btn btn-secondary"> In Review</button>
                                                    @break
                                                @case(1)
                                                    <button class="btn btn-danger"> Rejected</button>
                                                    @break
                                                @case(2)
                                                    <button class="btn btn-success"> Accepted</button>
                                                    @break
                                                @default
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Logbook</h4>
      </div>
      <form action="/logbook/add" method="post" enctype="multipart/form-data">
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Time</label>   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input id="datetimepicker12" name="waktu" hidden>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Topic</label>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-user">Add</button>
            </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('custom-js')
  <script type="text/javascript" src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('bower_components/moment/min/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{url('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/datatables-demo.js')}}"></script>
<script type="text/javascript">
    $("#sidebar-logbook").addClass("active");

    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Are You Sure?',
            text: "All data created by user will be deleted and cannot be restored",",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $( ".hapus" + id).submit();
            }
        })
    }
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker12').datetimepicker({ 
            inline: true,
            sideBySide: true,
            format: 'DD/MM/YYYY HH:mm',
        });
    });
</script>
@endsection