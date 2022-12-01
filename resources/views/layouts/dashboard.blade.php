@extends('layouts.home')

@section('title','Dashboard')

@section('navbar')
@include('layouts.navbar')
@endsection

@section('custom-css')
    <!-- Custom styles for this page -->
    <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">News</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        @foreach ($beritas as $item)
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">{{$item->judul}}</h6>
                    </div>
                    <div class="card-body">
                        <p>{{$item->deskripsi}} </p>
                        @if (isset($item->berkas))
                            <center><a href="{{ url($item['berkas']) }}" target="_blank"><img src="/img/file-img.png" alt="" height="100px;"></a></center>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('custom-js')
    <!-- Page level plugins -->
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/datatables-demo.js')}}"></script>
@endsection