@extends('layouts.home')

@section('title','Tugas Akhir')

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
        <h1 class="h3 mb-0 text-gray-800">Thesis</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thesis</h6>
                        @if ($proposal->tanggal_sidang_ta != null && $proposal->status == 4)
                            <div class="col-md-6">
                                <div class="row">
                                    <form action="/mahasiswa/tugas-akhir/revisi-status" method="post" class="revisi">
                                        @csrf
                                        <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                    </form>
                                    <button class="btn btn-danger" onclick="tolakConfirmation()" type="button" style="margin-left: 10px">Decline</button>
                                    <form action="/mahasiswa/tugas-akhir/setuju-status" method="post" class="setuju">
                                        @csrf
                                        <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                    </form>
                                    <button class="btn btn-warning" onclick="revisiConfirmation()" type="button" style="margin-left: 10px">Revise</button>
                                    <form action="/mahasiswa/tugas-akhir/tolak-status" method="post" class="tolak">
                                        @csrf
                                        <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                    </form>
                                    <button class="btn btn-success" onclick="setujuConfirmation()" type="button" style="margin-left: 10px">Accept</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        <form action="/sidang/tugas-akhir/update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title <span style="color: red; font-size:10px;">* Required</span></label>
                                        <textarea name="judul" class="form-control form-control-user" required cols="30" rows="3">{{ $proposal->judul }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Knowledge Field <span style="color: red; font-size:10px;">* Required</span></label>
                                        <input type="text" class="form-control form-control-user" name="bidang_ilmu" value="{{$proposal->bidang_ilmu}}" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Methodology <span style="color: red; font-size:10px;">* Required</span></label>
                                    <textarea name="metodologi" class="form-control form-control-user" required cols="30" rows="5">{{ $proposal->metodologi }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Abstract <span style="color: red; font-size:10px;">* Required</span></label>
                                        <textarea name="abstrak" class="form-control form-control-user" required cols="30" rows="5">{{$proposal->abstrak}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Thesis File</label>
                                        <br>
                                        <a href="{{ url($proposal->file) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->file)}}</a>
                                        <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>RMK <span style="color: red; font-size:10px;">* Required</span></label>
                                        <select name="rmk" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('rmk') }}">
                                            <option disabled selected>Choose RMK</option>
                                            @foreach($rmks as $rmk)
                                            <option value="{{ $rmk->id }}" @if ($proposal->rmk_id == $rmk->id) selected @endif>{{ $rmk->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>1st Advisor <span style="color: red; font-size:10px;">* Required</span></label>
                                        <select name="dosen_pembimbing_1" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('dosen_pembimbing_1') }}">
                                            <option disabled selected>Choose 1st Advisor</option>
                                            @foreach($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" @if ($proposal->dosen_pembimbing_1_id == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>2nd Advisor</label>
                                        <select name="dosen_pembimbing_2" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('dosen_pembimbing_2') }}">
                                            <option disabled selected>Choose 2nd Advisor</option>
                                            @foreach($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" @if ($proposal->dosen_pembimbing_2_id == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>External Advisor</label>
                                        <input type="text" class="form-control form-control-user" name="dosen_pembimbing_luar" value="{{$proposal->dosen_pembimbing_luar}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>1st Examiner <span style="color: red; font-size:10px;">* Required</span></label>
                                        <select name="dosen_penguji_3" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('dosen_penguji_3') }}">
                                            <option disabled selected>Choose 1st Examiner</option>
                                            @foreach($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" @if ($proposal->dosen_penguji_3_id == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>2nd Examiner <span style="color: red; font-size:10px;">* Required</span></label>
                                        <select name="dosen_penguji_4" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('dosen_penguji_4') }}">
                                            <option disabled selected>Choose 2nd Examiner</option>
                                            @foreach($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" @if ($proposal->dosen_penguji_4_id == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Proposal Session Date <span style="color: red; font-size:10px;">* Required</span></label>   
                                        <input type='text' class="form-control" id='datetimepicker1' name="tanggal_sidang_ta" value="{{$proposal->tanggal_sidang_ta}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Proposal Session Location <span style="color: red; font-size:10px;">* Required</span></label>   
                                        <input type='text' class="form-control" name="lokasi_sidang_ta" value="{{$proposal->lokasi_sidang_ta}}"/>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block">Edit</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    $("#sidebar-pengaturan").addClass("active");
    $("#collapseUtilities").addClass("show");
    $("#sidang-tugas-akhir").addClass("active");

    $(function () {
        $('#datetimepicker1').daterangepicker({ 
            singleDatePicker: true,
            showDropdowns: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            locale: {
                format: 'DD MMMM YYYY HH:mm'
            }
        });
    });

    function tolakConfirmation() {
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
                $( ".tolak" ).submit();
            }
        })
    }
    
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

    function setujuConfirmation() {
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
                $( ".setuju" ).submit();
            }
        })
    }
</script>
@endsection