@extends('layouts.home')

@section('title','Data Mahasiswa')

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
        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>Tanggal</th>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td hidden>{{$mahasiswa->created_at}}</td>
                                <td>{{$mahasiswa->mahasiswa->nama}}</td>
                                <td>{{$mahasiswa->mahasiswa->nip}}</td>
                                <td>
                                    <center>
                                        @switch($mahasiswa->status)
                                            @case(0)
                                                <button class="btn btn-secondary"> Registered</button>
                                                @break
                                            @case(1)
                                                <button class="btn btn-danger"> Proposal Was Rejected</button>
                                                @break
                                            @case(2)
                                                <button class="btn btn-warning"> Proposal Was Revised</button>
                                                @break
                                            @case(3)
                                                <button class="btn btn-success"> Proposal OK</button>
                                                @break
                                            @case(4)
                                                <button class="btn btn-secondary"> Maju Sidang</button>
                                                @break
                                            @case(5)
                                                <button class="btn btn-secondary"> Thesis Was Rejected</button>
                                                @break
                                            @case(6)
                                                <button class="btn btn-warning"> Thesis Was Revised</button>
                                                @break
                                            @case(7)
                                                <button class="btn btn-success"> Thesis OK</button>
                                                @break
                                            @default
                                        @endswitch
                                    </center>
                                </td>
                                <td>
                                    <a href="/mahasiswa/proposal/{{$mahasiswa->mahasiswa_id}}" class="btn btn-primary">Proposal</a>
                                    <a href="/mahasiswa/logbook/{{$mahasiswa->mahasiswa_id}}" class="btn btn-info">Logbook</a>
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
        $("#sidebar-mahasiswa").addClass("active");
    </script>
@endsection