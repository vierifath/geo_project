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
        <h1 class="h3 mb-0 text-gray-800">Edit Account</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/account/update" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="id" type="text" class="form-control form-control-user" value="{{ $user->id }}" required hidden>
                                <input name="nama" type="text" class="form-control form-control-user" value="{{ $user->nama }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control form-control-user" value="{{ $user->email }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>NIP</label>
                                <input name="nip" type="text" class="form-control form-control-user" value="{{ $user->nip }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>RMK</label>
                                <select name="rmk" class="form-control form-control-user select2" style="width: 100%;">
                                    <option disabled selected>Choose RMK</option>
                                    @foreach($rmks as $rmk)
                                    <option value="{{ $rmk->id }}" @if ($rmk->id == $user->rmk_id) selected @endif>{{ $rmk->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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