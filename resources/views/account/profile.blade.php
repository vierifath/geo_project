@extends('layouts.home')

@section('title','Profile')

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
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/password/update" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="nama" type="text" class="form-control form-control-user" value="{{ $user->nama }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                @if ($user->role == 1)
                                    <label>NIP</label>
                                @else
                                    <label>NRP</label>
                                @endif
                                <input name="nip" type="text" class="form-control form-control-user" value="{{ $user->nip }}" disabled>
                            </div>
                        </div>
                        @if ($user->role == 1)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>RMK</label>
                                    <input name="rmk" type="text" class="form-control form-control-user" value="{{ $user->rmk->nama }}" disabled>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old Password</label>
                                <input name="id" type="text" class="form-control form-control-user" hidden value="{{$user->id}}" required>
                                <input name="password_lama" type="password" class="form-control form-control-user" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New Password</label>
                                <input name="password_baru" type="password" class="form-control form-control-user" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-user btn-block">Change Password</button>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('custom-js')

@endsection