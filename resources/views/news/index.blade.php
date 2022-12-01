@extends('layouts.home')

@section('title','News Data')

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
        <h1 class="h3 mb-0 text-gray-800">News</h1>
        <a href="/news/add/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Add News</a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">News Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beritas as $berita)
                            <tr>
                                <td>{{$berita['judul']}}</td>
                                <td>{{$berita['deskripsi']}}</td>
                                @if (isset($berita['berkas']))
                                    <td><center><a href="{{ url($berita['berkas']) }}" target="_blank"><img src="/img/file-img.png" alt="" height="100px;"></a></center></td>
                                @else
                                    <td></td>
                                @endif
                                <td>
                                    <form action="/news/hapus" method="post" class="hapus{{$berita['id']}}">
                                        @csrf
                                        <input type="text" value="{{$berita['id']}}" name="id" hidden>
                                        {{-- <a href="/news/edit/{{$berita['id']}}" class="btn btn-warning">Edit</a> --}}
                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$berita['id']}})" type="button">Delete</button>
                                    </form>
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
        $("#sidebar-berita").addClass("active");

        function deleteConfirmation(id) {
            Swal.fire({
                title: 'Are You Sure?',
                text: "All data created by user will be deleted and cannot be restored",
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
    </script>
@endsection