@extends('layouts.home')

@section('title','A')

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
        <h1 class="h3 mb-0 text-gray-800">Add RMK</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/rmk/add" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name</label>
                                <input name="nama" type="text" class="form-control form-control-user" value="{{ old('nama') }}" required>
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
    <!-- Page level plugins -->
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/datatables-demo.js')}}"></script>

    <script type="text/javascript">
        $("#sidebar-rmk").addClass("active");

    </script>
@endsection