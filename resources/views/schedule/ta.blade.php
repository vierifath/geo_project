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
        <h1 class="h3 mb-0 text-gray-800">Student Data</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Student Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th hidden>Date</th>
                            <th>Name</th>
                            <th>NRP</th>
                            <th>Status</th>
                            <th>Action</th>
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
                                        @if($mahasiswa->tanggal_sidang_ta == null)
                                            <button class="btn btn-danger">Haven't Set Schedule</button>
                                        @else
                                            <button class="btn btn-success">Already Set Schedule</button>
                                        @endif
                                    </center>
                                </td>
                                <td>
                                    <a href="/sidang/tugas-akhir/{{$mahasiswa->mahasiswa_id}}" class="btn btn-primary">Thesis</a>
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
        $("#sidebar-pengaturan").addClass("active");
        $("#collapseUtilities").addClass("show");
        $("#sidang-tugas-akhir").addClass("active");
    </script>
@endsection