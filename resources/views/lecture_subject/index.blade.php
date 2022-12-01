@extends('layouts.home')

@section('title','Mata Kuliah')

@section('navbar')
@include('layouts.navbar_auth')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
    <link href="{{url('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lecture Subject</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Lecture Subject</h6>
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal1"><i class="fas fa-plus fa-sm text-white-50"></i> Add Lecture Subject</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 80%">Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mata_kuliahs as $mata_kuliah)
                                    <tr>
                                        <td>{{$mata_kuliah['nama']}}</td>
                                        <td>
                                            <div class="row">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$mata_kuliah['id']}}" style="margin: 0 10px">
                                                    Edit
                                                </button>
                                                <div class="modal fade" id="edit{{$mata_kuliah['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form action="/admin-lecture-subject/update" method="post" class="edit{{$mata_kuliah['id']}}">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Lecture Subject</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label>Lecture Subject</label>
                                                                    <input type="text" value="{{$mata_kuliah['id']}}" name="id" hidden>
                                                                    <input type="text" class="form-control form-control-user" value="{{$mata_kuliah['nama']}}" name="nama">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-success" onclick="editConfirmation({{$mata_kuliah['id']}})" type="button">Edit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <form action="/admin-lecture-subject/delete" method="post" class="delete{{$mata_kuliah['id']}}">
                                                    @csrf
                                                    <input type="text" value="{{$mata_kuliah['id']}}" name="id" hidden>
                                                    <button class="btn btn-danger" onclick="deleteConfirmation({{$mata_kuliah['id']}})" type="button">Delete</button>
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

        </div>
    </div>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Lecture Subject</h4>
      </div>
      <form action="/admin-lecture-subject/add" method="post" enctype="multipart/form-data">
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject</label>
                                <input type="text" class="form-control form-control-user" name="nama">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-user" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-user">Add</button>
            </div>
        </form>
    </div>

  </div>
</div>
@endsection

@section('custom-js')
  <script type="text/javascript" src="{{url('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <script type="text/javascript" src="{{url('bower_components/moment/min/moment.min.js')}}"></script>
    <!-- Page level plugins -->
    <script src="{{url('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('js/demo/datatables-demo.js')}}"></script>
<script type="text/javascript">
    $("#sidebar-mata-kuliah").addClass("active");

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
                $( ".delete" + id ).submit();
            }
        })
    }

    $(document).ready(function() {
        $('#dataTable1').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
    });

    function editConfirmation(id) {
        Swal.fire({
            title: 'Are You Sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                $( ".edit" + id).submit();
            }
        })
    }
</script>
@endsection