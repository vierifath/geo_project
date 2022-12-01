@extends('layouts.home')

@section('title','Account Data')

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

    <input type="text" class="role" value="{{$role}}" hidden>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Account Data</h1>
        <a href="/account/add/{{$role}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add Account</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{$role}} Account Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 35%">Name</th>
                            @if($role == 'dosen')
                                <th>NIP</th>
                            @elseif($role == 'dosen-eksternal')
                                <th>NIP/ID</th>
                            @else
                                <th>NRP</th>    
                            @endif
                            <th>Email</th>
                            @if ($role == 'dosen')
                                <th>RMK</th>
                            @endif
                            @if ($role == 'dosen-eksternal')
                                <th>Institution</th>
                            @endif
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user['nama']}}</td>
                                <td>{{$user['nip']}}</td>
                                <td>{{$user['email']}}</td>
                                @if ($role == 'dosen')
                                    <td>{{$user['rmk']['nama']}}</td>
                                @endif
                                @if ($role == 'dosen-eksternal')
                                    <td>{{$user['institusi']}}</td>
                                @endif
                                <td>
                                    <div class="row">
                                        @if ($role == 'dosen')
                                            <a href="/account/edit/{{$user['id']}}" class="btn btn-warning" style="margin-left: 10px"> Edit</a>
                                        @endif
                                        <form action="/account/hapus" method="post" class="hapus{{$user['id']}}" style="margin-left: 10px">
                                            @csrf
                                            <input type="text" value="{{$user['id']}}" name="id" hidden>
                                            <input type="text" value="{{$role}}" name="role" hidden>
                                            <button class="btn btn-danger" onclick="deleteConfirmation({{$user['id']}})" type="button">Delete</button>
                                        </form>
                                        <form action="/password/reset" method="post" class="reset{{$user['id']}}" style="margin-left: 10px">
                                            @csrf
                                            <input type="text" value="{{$user['id']}}" name="id" hidden>
                                            <button class="btn btn-warning" onclick="resetPassword({{$user['id']}})" type="button">Reset Password</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        $("#sidebar-akun").addClass("active");
        $("#collapseTwo").addClass("show");

        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Are You Sure?',
                text: "Data yang dibuat akan terhapus dan tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancel',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $( ".hapus" + id ).submit();
                }
            })
        }
        
        function resetPassword(id) {
            Swal.fire({
                title: 'Are You Sure?',
                text: "Password akan dirubah menjadi semula.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancel',
                reverseButtons: true
                }).then((result) => {
                if (result.isConfirmed) {
                    $( ".reset" + id).submit();
                }
            })
        }
    </script>
@endsection