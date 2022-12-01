@extends('layouts.home')

@section('title','Add Account')

@section('navbar')
@include('layouts.navbar_auth')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')

@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Account</h1>
        @if ($role == 'mahasiswa')
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#revisi" style="margin-left: 10px">
            Excel
        </button>
        <div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="/account/add/template" method="post" class="revisi" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Student Data</h5>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="form-control form-control-user" name="upload" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
                        </div>
                        <div class="modal-footer">
                            <a href="/storage/template-tambah-mahasiswa.xlsx" class="btn btn-primary"> Download Template</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-warning" onclick="revisiConfirmation()" type="button">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/account/add" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="nama" type="text" class="form-control form-control-user" value="{{ old('nama') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control form-control-user" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                @if ($role == 'dosen')
                                    <label>NIP</label>
                                    <input name="role" class="role" type="text" class="form-control form-control-user" value="1" hidden required>
                                @elseif ($role == 'dosen-eksternal')
                                    <label>NIP / ID</label>
                                    <input name="role" class="role" type="text" class="form-control form-control-user" value="3" hidden required>
                                @else
                                    <label>NRP</label>
                                    <input name="role" class="role" type="text" class="form-control form-control-user" value="2" hidden required>
                                @endif
                                <input name="nip" type="text" class="form-control form-control-user" value="{{ old('nip') }}" required>
                            </div>
                        </div>
                        @if ($role == 'dosen')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RMK</label>
                                    <select name="rmk" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('rmk') }}">
                                        <option disabled selected>Choose RMK</option>
                                        @foreach($rmks as $rmk)
                                        <option value="{{ $rmk->id }}">{{ $rmk->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        @if ($role == 'dosen-eksternal')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Institution</label>
                                    <input name="institusi" type="text" class="form-control form-control-user" value="{{ old('institusi') }}" required>
                                </div>
                            </div>
                        @endif
                    </div>
                    <button class="btn btn-primary btn-user btn-block">Add</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('custom-js')
    <script type="text/javascript">
        $("#sidebar-akun").addClass("active");
        $("#collapseTwo").addClass("show");

        function revisiConfirmation() {
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
                    $( ".revisi" ).submit();
                }
            })
        }
    </script>
@endsection