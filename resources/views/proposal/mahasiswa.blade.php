@extends('layouts.home')

@section('title','Proposal Tugas Akhir Mahasiswa')

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
        <h1 class="h3 mb-0 text-gray-800">Proposal Tugas Akhir Mahasiswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Proposal Tugas Akhir Mahasiswa {{ $proposal->mahasiswa->nama }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header">
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Nama</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->mahasiswa->nama }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>NRP</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->mahasiswa->nip }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Judul TA</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->judul }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Knowledge Field</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->bidang_ilmu }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Methodology</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->metodologi }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Abstract</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->abstrak }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>1st Advisor</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->dosen_pembimbing_1->nama }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>2nd Advisor</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        @if ($proposal->dosen_pembimbing_2)
                                            <h5>: {{ $proposal->dosen_pembimbing_2->nama }} </h5>
                                        @else
                                            <h5>: - </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>External Advisor </h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        @if ($proposal->dosen_pembimbing_luar_id)
                                            <h5>: {{ $proposal->dosen_pembimbing_luar_id->nama }}</h5>
                                        @else
                                            <h5>: - </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>RMK</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->rmk->nama }} </h5>
                                    </div>
                                </div>                         
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Status</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">: 
                                        @switch($proposal->status)
                                            @case(0)
                                                @if ($proposal->tanggal_sidang_proposal == null)
                                                    <button class="btn btn-secondary"> Registered</button>
                                                @else
                                                    <button class="btn btn-secondary"> Seminar</button>
                                                @endif
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
                                    </div>
                                </div>
                                @if ($proposal->status == 2)
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Revision Detail</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->status_teks }} </h5>
                                        </div>
                                    </div>
                                @endif
                                <br><hr>
                                <div class="row">
                                    @if ($proposal->revisi_proposal_dosen_pembimbing_1 != null)
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>1st Advisor Proposal Revision</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: <a href="{{ url($proposal->revisi_proposal_dosen_pembimbing_1) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->revisi_proposal_dosen_pembimbing_1)}}</a> </h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($proposal->revisi_proposal_dosen_pembimbing_2 != null)
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>2nd Advisor Proposal Revision</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: <a href="{{ url($proposal->revisi_proposal_dosen_pembimbing_2) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->revisi_proposal_dosen_pembimbing_2)}}</a> </h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($proposal->revisi_proposal_dosen_luar != null)
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>1st Advisor Proposal Revision</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: <a href="{{ url($proposal->revisi_proposal_dosen_luar) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->revisi_proposal_dosen_luar)}}</a> </h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($proposal->revisi_proposal_dosen_penguji_1 != null)
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>1st Examiner Proposal Revision</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: <a href="{{ url($proposal->revisi_proposal_dosen_penguji_1) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->revisi_proposal_dosen_penguji_1)}}</a> </h5>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($proposal->revisi_proposal_dosen_penguji_2 != null)
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>2nd Examiner Proposal Revision</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: <a href="{{ url($proposal->revisi_proposal_dosen_penguji_2) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->revisi_proposal_dosen_penguji_2)}}</a> </h5>
                                        </div>
                                    @endif
                                </div>
                                <br><hr>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Proposal File</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: <a href="{{ url($proposal->file) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->file)}}</a> </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Proposal Session Date</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->tanggal_sidang_proposal }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Proposal Session Location</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->lokasi_sidang_proposal }} </h5>
                                    </div>
                                </div>
                                @if ($proposal->dosen_penguji_1 != null)
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>1st Examiner</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->dosen_penguji_1->nama }} </h5>
                                        </div>
                                    </div>
                                @endif
                                @if ($proposal->dosen_penguji_2 != null)
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>2nd Examiner</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->dosen_penguji_2->nama }} </h5>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/mahasiswa" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#revisi" style="margin-left: 10px">
                                    Upload Revision
                                </button>
                                <div class="modal fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="/mahasiswa/proposal/revisi" method="post" class="revisi" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Revision Detail</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                                    <div class="form-group">
                                                        <label>Proposal Revision File <span style="color: red; font-size:10px;">* Required | File: PDF, Size: 1Mb - 4Mb</span></label>
                                                        <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" required name="upload" accept="application/pdf" />
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-warning" onclick="revisiConfirmation()" type="button">Revise</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <form action="/mahasiswa/proposal/setuju" method="post" class="setuju">
                                    @csrf
                                    <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                </form>
                                @if ($proposal->status != 3)
                                    <button class="btn btn-success" onclick="setujuConfirmation()" type="button" style="margin-left: 10px">Accept</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
<script type="text/javascript">
    $("#sidebar-mahasiswa").addClass("active");


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