@extends('layouts.home')

@section('title','Comprehensive Question Bank ')

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
        <h1 class="h3 mb-0 text-gray-800">Comprehensive Question Bank</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Geologi</h6>
                        @if (Auth::user()->institusi == null)
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal1"><i class="fas fa-plus fa-sm text-white-50"></i> Add Geologi Question</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Lecture Subject</th>
                                    <th style="width: 25%">Question</th>
                                    <th style="width: 25%">Answer</th>
                                    <th style="width: 15%">File</th>
                                    @if (Auth::user()->institusi == null)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geologis as $geologi)
                                    <tr>
                                        <td>{{$geologi['MataKuliah']['nama']}}</td>
                                        <td>{{$geologi['soal']}}</td>
                                        <td>{{$geologi['jawaban']}}</td>
                                        <td> <center>@if ($geologi['image'] != null) <a href="/{{$geologi['image']}}">{{$geologi['image']}}</a>@endif</center></td>
                                        @if (Auth::user()->institusi == null)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$geologi['id']}}" style="margin: 0 10px">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="edit{{$geologi['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            @if (Auth::user()->role == 0)  
                                                                <form action="/admin-question/update" method="post" enctype="multipart/form-data" class="edit{{$geologi['id']}}">
                                                            @else
                                                                <form action="/soal/update" method="post" enctype="multipart/form-data" class="edit{{$geologi['id']}}">
                                                            @endif
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                                                                        <option disabled selected>Choose Lecture Subject</option>
                                                                                        @foreach($mata_kuliahs as $mata_kuliah)
                                                                                        <option value="{{ $mata_kuliah->id }}" @if ($mata_kuliah->id == $geologi->mata_kuliah_id) selected @endif>{{ $mata_kuliah->nama }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5">{{$geologi['soal']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5">{{$geologi['jawaban']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>File</label>
                                                                                    <input type="file" class="form-control form-control-user upload" name="upload"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" value="{{$geologi['id']}}" name="id" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="editConfirmation({{$geologi['id']}})" type="button">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 0)  
                                                        <form action="/admin-question/delete" method="post" class="delete{{$geologi['id']}}">
                                                    @else
                                                        <form action="/soal/delete" method="post" class="delete{{$geologi['id']}}">
                                                    @endif
                                                        @csrf
                                                        <input type="text" value="{{$geologi['id']}}" name="id" hidden>
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$geologi['id']}})" type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Geofisika Dasar</h6>
                        @if (Auth::user()->institusi == null)
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal2"><i class="fas fa-plus fa-sm text-white-50"></i> Add Geofisika Dasar Question</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Lecture Subject</th>
                                    <th style="width: 25%">Question</th>
                                    <th style="width: 25%">Answer</th>
                                    <th style="width: 15%">File</th>
                                    @if (Auth::user()->institusi == null)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geofisika_dasars as $geofisika_dasar)
                                    <tr>
                                        <td>{{$geofisika_dasar['MataKuliah']['nama']}}</td>
                                        <td>{{$geofisika_dasar['soal']}}</td>
                                        <td>{{$geofisika_dasar['jawaban']}}</td>
                                        <td> <center>@if ($geofisika_dasar['image'] != null) <a href="/{{$geofisika_dasar['image']}}">{{$geofisika_dasar['image']}}</a>@endif</center></td>
                                        @if (Auth::user()->institusi == null)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$geofisika_dasar['id']}}" style="margin: 0 10px">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="edit{{$geofisika_dasar['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            @if (Auth::user()->role == 0)  
                                                                <form action="/admin-question/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_dasar['id']}}">
                                                            @else
                                                                <form action="/soal/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_dasar['id']}}">
                                                            @endif
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                                                                        <option disabled selected>Choose Lecture Subject</option>
                                                                                        @foreach($mata_kuliahs as $mata_kuliah)
                                                                                        <option value="{{ $mata_kuliah->id }}" @if ($mata_kuliah->id == $geofisika_dasar->mata_kuliah_id) selected @endif>{{ $mata_kuliah->nama }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_dasar['soal']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_dasar['jawaban']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>File</label>
                                                                                    <input type="file" class="form-control form-control-user upload" name="upload"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" value="{{$geofisika_dasar['id']}}" name="id" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="editConfirmation({{$geofisika_dasar['id']}})" type="button">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 0)  
                                                        <form action="/admin-question/delete" method="post" class="delete{{$geofisika_dasar['id']}}">
                                                    @else
                                                        <form action="/soal/delete" method="post" class="delete{{$geofisika_dasar['id']}}">
                                                    @endif
                                                        @csrf
                                                        <input type="text" value="{{$geofisika_dasar['id']}}" name="id" hidden>
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$geofisika_dasar['id']}})" type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Petrofisika</h6>
                        @if (Auth::user()->institusi == null)
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal3"><i class="fas fa-plus fa-sm text-white-50"></i> Add Petrofisika Question</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Lecture Subject</th>
                                    <th style="width: 25%">Question</th>
                                    <th style="width: 25%">Answer</th>
                                    <th style="width: 15%">File</th>
                                    @if (Auth::user()->institusi == null)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petrofisikas as $petrofisika)
                                    <tr>
                                        <td>{{$petrofisika['MataKuliah']['nama']}}</td>
                                        <td>{{$petrofisika['soal']}}</td>
                                        <td>{{$petrofisika['jawaban']}}</td>
                                        <td> <center>@if ($petrofisika['image'] != null) <a href="/{{$petrofisika['image']}}">{{$petrofisika['image']}}</a>@endif</center></td>
                                        @if (Auth::user()->institusi == null)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$petrofisika['id']}}" style="margin: 0 10px">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="edit{{$petrofisika['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            @if (Auth::user()->role == 0)  
                                                                <form action="/admin-question/update" method="post" enctype="multipart/form-data" class="edit{{$petrofisika['id']}}">
                                                            @else
                                                                <form action="/soal/update" method="post" enctype="multipart/form-data" class="edit{{$petrofisika['id']}}">
                                                            @endif
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                                                                        <option disabled selected>Choose Lecture Subject</option>
                                                                                        @foreach($mata_kuliahs as $mata_kuliah)
                                                                                        <option value="{{ $mata_kuliah->id }}" @if ($mata_kuliah->id == $petrofisika->mata_kuliah_id) selected @endif>{{ $mata_kuliah->nama }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5">{{$petrofisika['soal']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5">{{$petrofisika['jawaban']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>File</label>
                                                                                    <input type="file" class="form-control form-control-user upload" name="upload"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" value="{{$petrofisika['id']}}" name="id" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="editConfirmation({{$petrofisika['id']}})" type="button">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 0)  
                                                        <form action="/admin-question/delete" method="post" class="delete{{$petrofisika['id']}}">
                                                    @else
                                                        <form action="/soal/delete" method="post" class="delete{{$petrofisika['id']}}">
                                                    @endif
                                                        @csrf
                                                        <input type="text" value="{{$petrofisika['id']}}" name="id" hidden>
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$petrofisika['id']}})" type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Geofisika Terapan</h6>
                        @if (Auth::user()->institusi == null)
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal4"><i class="fas fa-plus fa-sm text-white-50"></i> Add Geofisika Terapan Question</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable4" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Lecture Subject</th>
                                    <th style="width: 25%">Question</th>
                                    <th style="width: 25%">Answer</th>
                                    <th style="width: 15%">File</th>
                                    @if (Auth::user()->institusi == null)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geofisika_terapans as $geofisika_terapan)
                                    <tr>
                                        <td>{{$geofisika_terapan['MataKuliah']['nama']}}</td>
                                        <td>{{$geofisika_terapan['soal']}}</td>
                                        <td>{{$geofisika_terapan['jawaban']}}</td>
                                        <td> <center>@if ($geofisika_terapan['image'] != null) <a href="/{{$geofisika_terapan['image']}}">{{$geofisika_terapan['image']}}</a>@endif</center></td>
                                        @if (Auth::user()->institusi == null)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$geofisika_terapan['id']}}" style="margin: 0 10px">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="edit{{$geofisika_terapan['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            @if (Auth::user()->role == 0)  
                                                                <form action="/admin-question/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_terapan['id']}}">
                                                            @else
                                                                <form action="/soal/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_terapan['id']}}">
                                                            @endif
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                                                                        <option disabled selected>Choose Lecture Subject</option>
                                                                                        @foreach($mata_kuliahs as $mata_kuliah)
                                                                                        <option value="{{ $mata_kuliah->id }}" @if ($mata_kuliah->id == $geofisika_terapan->mata_kuliah_id) selected @endif>{{ $mata_kuliah->nama }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_terapan['soal']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_terapan['jawaban']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>File</label>
                                                                                    <input type="file" class="form-control form-control-user upload" name="upload"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" value="{{$geofisika_terapan['id']}}" name="id" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="editConfirmation({{$geofisika_terapan['id']}})" type="button">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 0)  
                                                        <form action="/admin-question/delete" method="post" class="delete{{$geofisika_terapan['id']}}">
                                                    @else
                                                        <form action="/soal/delete" method="post" class="delete{{$geofisika_terapan['id']}}">
                                                    @endif
                                                        @csrf
                                                        <input type="text" value="{{$geofisika_terapan['id']}}" name="id" hidden>
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$geofisika_terapan['id']}})" type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Geofisika Komputasi</h6>
                        @if (Auth::user()->institusi == null)
                            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#myModal5"><i class="fas fa-plus fa-sm text-white-50"></i> Add Geofisika Komputasi Question</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 15%">Lecture Subject</th>
                                    <th style="width: 25%">Question</th>
                                    <th style="width: 25%">Answer</th>
                                    <th style="width: 15%">File</th>
                                    @if (Auth::user()->institusi == null)
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($geofisika_komputasis as $geofisika_komputasi)
                                    <tr>
                                        <td>{{$geofisika_komputasi['MataKuliah']['nama']}}</td>
                                        <td>{{$geofisika_komputasi['soal']}}</td>
                                        <td>{{$geofisika_komputasi['jawaban']}}</td>
                                        <td> <center>@if ($geofisika_komputasi['image'] != null) <a href="/{{$geofisika_komputasi['image']}}">{{$geofisika_komputasi['image']}}</a>@endif</center></td>
                                        @if (Auth::user()->institusi == null)
                                            <td>
                                                <div class="row">
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit{{$geofisika_komputasi['id']}}" style="margin: 0 10px">
                                                        Edit
                                                    </button>
                                                    <div class="modal fade" id="edit{{$geofisika_komputasi['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            @if (Auth::user()->role == 0)  
                                                                <form action="/admin-question/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_komputasi['id']}}">
                                                            @else
                                                                <form action="/soal/update" method="post" enctype="multipart/form-data" class="edit{{$geofisika_komputasi['id']}}">
                                                            @endif
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                                                                        <option disabled selected>Choose Lecture Subject</option>
                                                                                        @foreach($mata_kuliahs as $mata_kuliah)
                                                                                        <option value="{{ $mata_kuliah->id }}" @if ($mata_kuliah->id == $geofisika_komputasi->mata_kuliah_id) selected @endif>{{ $mata_kuliah->nama }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_komputasi['soal']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                                                                    <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5">{{$geofisika_komputasi['jawaban']}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label>File</label>
                                                                                    <input type="file" class="form-control form-control-user upload" name="upload"/>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" value="{{$geofisika_komputasi['id']}}" name="id" hidden>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button class="btn btn-success" onclick="editConfirmation({{$geofisika_komputasi['id']}})" type="button">Edit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    @if (Auth::user()->role == 0)  
                                                        <form action="/admin-question/delete" method="post" class="delete{{$geofisika_komputasi['id']}}">
                                                    @else
                                                        <form action="/soal/delete" method="post" class="delete{{$geofisika_komputasi['id']}}">
                                                    @endif
                                                        @csrf
                                                        <input type="text" value="{{$geofisika_komputasi['id']}}" name="id" hidden>
                                                        <button class="btn btn-danger" onclick="deleteConfirmation({{$geofisika_komputasi['id']}})" type="button">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
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
        <h4 class="modal-title">Add Geologi Question</h4>
      </div>
      @if (Auth::user()->role == 0)  
        <form action="/admin-question/add" method="post" enctype="multipart/form-data">  
      @else
        <form action="/soal/add" method="post" enctype="multipart/form-data">  
      @endif
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                    <option disabled selected>Choose Lecture Subject</option>
                                    @foreach($mata_kuliahs as $mata_kuliah)
                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                <input type="text" value="geologi" name="jenis" hidden>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control form-control-user upload" name="upload"/>
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
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Geofisika Dasar Question</h4>
      </div>
      @if (Auth::user()->role == 0)  
        <form action="/admin-question/add" method="post" enctype="multipart/form-data">  
      @else
        <form action="/soal/add" method="post" enctype="multipart/form-data">  
      @endif
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                    <option disabled selected>Choose Lecture Subject</option>
                                    @foreach($mata_kuliahs as $mata_kuliah)
                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                <input type="text" value="geofisika_dasar" name="jenis" hidden>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control form-control-user upload" name="upload"/>
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
<div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Petrofisika Question</h4>
      </div>
      @if (Auth::user()->role == 0)  
        <form action="/admin-question/add" method="post" enctype="multipart/form-data">  
      @else
        <form action="/soal/add" method="post" enctype="multipart/form-data">  
      @endif
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                    <option disabled selected>Choose Lecture Subject</option>
                                    @foreach($mata_kuliahs as $mata_kuliah)
                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                <input type="text" value="petrofisika" name="jenis" hidden>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control form-control-user upload" name="upload"/>
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
<div id="myModal4" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Geofisika Terapan Question</h4>
      </div>
      @if (Auth::user()->role == 0)  
        <form action="/admin-question/add" method="post" enctype="multipart/form-data">  
      @else
        <form action="/soal/add" method="post" enctype="multipart/form-data">  
      @endif
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                    <option disabled selected>Choose Lecture Subject</option>
                                    @foreach($mata_kuliahs as $mata_kuliah)
                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                <input type="text" value="geofisika_terapan" name="jenis" hidden>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control form-control-user upload" name="upload"/>
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
<div id="myModal5" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Geofisika Komputasi Question</h4>
      </div>
      @if (Auth::user()->role == 0)  
        <form action="/admin-question/add" method="post" enctype="multipart/form-data">  
      @else
        <form action="/soal/add" method="post" enctype="multipart/form-data">  
      @endif
          @csrf
            <div class="modal-body">
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Lecture Subject <span style="color: red; font-size:10px;">* Required</span></label>
                                <select name="mata_kuliah" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('mata_kuliah') }}">
                                    <option disabled selected>Choose Lecture Subject</option>
                                    @foreach($mata_kuliahs as $mata_kuliah)
                                    <option value="{{ $mata_kuliah->id }}">{{ $mata_kuliah->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Question <span style="color: red; font-size:10px;">* Required</span></label>
                                <input type="text" value="geofisika_komputasi" name="jenis" hidden>
                                <textarea name="topik" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Answer <span style="color: red; font-size:10px;">* Required</span></label>
                                <textarea name="jawaban" class="form-control form-control-user" required cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control form-control-user upload" name="upload"/>
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
    $("#sidebar-soal").addClass("active");

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
        $('#dataTable2').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
        $('#dataTable3').DataTable({
            "autoWidth": true,
            "ordering": true,
        });
        $('#dataTable4').DataTable({
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