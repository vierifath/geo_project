@extends('layouts.home')

@section('title','Logbook')

@section('navbar')
@include('layouts.navbar_auth')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
    <!-- Custom styles for this page -->
    <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
                        <div class="col-md-6">
                            <div class="row">
                                @if (count($logbooks) != 0)
                                    <form action="/mahasiswa/logbook/setujuAll" method="post" class="setujuAll">
                                        @csrf
                                            <input type="text" value="{{$logbooks[0]['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                    </form>
                                    <button class="btn btn-success" onclick="setujuAllConfirmation()" type="button" style="margin-left: 10px">Setujui Semua</button>
                                @endif
                            </div>
                        </div>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logbooks as $key => $logbook)
                                    <tr>
                                        <td>{{$logbook['created_at']}}</td>
                                        <td>{{$logbook['topik']}}</td>
                                        <td>{{$logbook['komentar']}}</td>
                                        <td>
                                            @if ($logbook['status'] == 0)
                                                <div class="row">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolak{{$logbook['id']}}" style="margin-left: 10px">
                                                        Reject
                                                    </button>
                                                    <div class="modal fade" id="tolak{{$logbook['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="/mahasiswa/logbook/tolak" method="post" class="tolak{{$logbook['id']}}">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Reason for Logbook Rejection</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="text" value="{{$logbook['id']}}" name="id" hidden>
                                                                        <input type="text" value="{{$logbook['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                                                        <textarea name="komentar" cols="45" rows="5">-</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-danger" onclick="tolakConfirmation({{$logbook['id']}})" type="button">Reject</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#setuju{{$logbook['id']}}" style="margin-left: 10px">
                                                        Setuju
                                                    </button>
                                                    <div class="modal fade" id="setuju{{$logbook['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="/mahasiswa/logbook/setuju" method="post" class="setuju{{$logbook['id']}}">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Logbook Comments</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="text" value="{{$logbook['id']}}" name="id" hidden>
                                                                        <input type="text" value="{{$logbook['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                                                        <textarea name="komentar" cols="45" rows="5">-</textarea>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="setujuConfirmation({{$logbook['id']}})" type="button">Accept</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @switch($logbook['status'])
                                                    @case(1)
                                                        <button class="btn btn-danger"> Rejected</button>
                                                        @break
                                                    @case(2)
                                                        <button class="btn btn-success"> Accepted</button>
                                                        @break
                                                    @default
                                                @endswitch
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/mahasiswa" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
    <!-- Page level plugins -->
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/datatables-demo.js')}}"></script>
<script type="text/javascript">
    $("#sidebar-mahasiswa").addClass("active");

    function tolakConfirmation(id) {
        Swal.fire({
            title: 'Are You Sure?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".tolak" + id ).submit();
            }
        })
    }

    function setujuConfirmation(id) {
        Swal.fire({
            title: 'Are You Sure?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".setuju" + id ).submit();
            }
        })
    }
    
    function setujuAllConfirmation() {
        Swal.fire({
            title: 'Are You Sure?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".setujuAll" ).submit();
            }
        })
    }
</script>
@endsection