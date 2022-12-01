@extends('layouts.home')

@section('title','Tugas Akhir Mahasiswa')

@section('navbar')
@include('layouts.navbar_auth')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('custom-css')
<style>
    .swal-wide{
        width:920px !important;
    }
    .align-justify{
        text-align: justify;
    }
</style>
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tugas Akhir Mahasiswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Tugas Akhir Mahasiswa {{ $proposal->mahasiswa->nama }}</h6>
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
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>File Tugas Akhir</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        @if ($proposal->file_ta == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal->file_ta) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->file_ta)}}</a> </h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Tanggal Sidang TA</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->tanggal_sidang_ta }} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <h5>Lokasi Sidang TA</h5>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                        <h5>: {{ $proposal->lokasi_sidang_ta }} </h5>
                                    </div>
                                </div>
                                @if ($proposal->dosen_penguji_3 != null)
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Dosen Penguji 1</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->dosen_penguji_3->nama }} </h5>
                                        </div>
                                    </div>
                                @endif
                                @if ($proposal->dosen_penguji_4 != null)
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Dosen Penguji 2</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->dosen_penguji_4->nama }} </h5>
                                        </div>
                                    </div>
                                @endif
                                @if ($proposal->status >= 4)
                                    @if ($proposal->status == 6)
                                        <br><hr>
                                        @if ($proposal->status_revisi_ta == 1)
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <h5>File Revisi Tugas Akhir</h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    @if ($proposal->file_ta == null)
                                                        <h5>: </h5>
                                                    @else
                                                        <h5>: <a href="{{ url($proposal->file_ta) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->file_ta)}}</a> </h5>
                                                    @endif
                                                </div>
                                                @if ($proposal[$status] != "OK")
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="/mahasiswa/tugas-akhir/revisi/ok" method="post" enctype="multipart/form-data" class="revisiTA">
                                                                    @csrf
                                                                    <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                                                    <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                                                    <input type="text" class="form-control form-control-user" name="status" value="{{$status}}" hidden/>
                                                                    <button class="btn btn-success btn-user btn-block" onclick="setujuRevisi()" type="button">OK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                    <h5>File Revisi Tugas Akhir</h5>
                                                </div>
                                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                    @if ($proposal[$status] == null)
                                                        <h5>: </h5>
                                                    @else
                                                        <h5>: <a href="{{ url($proposal[$status]) }}" target="_blank">{{str_replace('storage/file/', '', $proposal[$status])}}</a> </h5>
                                                    @endif
                                                </div>
                                            </div>
                                            <form action="/mahasiswa/tugas-akhir/revisi" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>File Tugas Akhir <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                                            <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="upload" accept="application/pdf"/>
                                                            <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                                            <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                                            <input type="text" class="form-control form-control-user" name="status" value="{{$status}}" hidden/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>.</label>
                                                        <button class="btn btn-primary btn-user btn-block">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                    @if ($status_nilai == 1 || $status_nilai == 2)
                                        <hr><br>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <h5>Pomits File</h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    @if ($proposal->pomits == null)
                                                        <h5>: </h5>
                                                    @else
                                                        <h5>: <a href="{{ url($proposal->pomits) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->pomits)}}</a> </h5>
                                                    @endif
                                                </div>
                                                @if ($proposal->status_pomits != 1 && $proposal->pomits != null)
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="/mahasiswa/tugas-akhir/pomits/ok" method="post" enctype="multipart/form-data" class="pomits">
                                                                    @csrf
                                                                    <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                                                    <button class="btn btn-success btn-user btn-block" onclick="setujuPomits()"type="button">OK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                    <h5>Geofisika Journal File</h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                    @if ($proposal->jurnal == null)
                                                        <h5>: </h5>
                                                    @else
                                                        <h5>: <a href="{{ url($proposal->jurnal) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->jurnal)}}</a> </h5>
                                                    @endif
                                                </div>
                                                @if ($proposal->status_jurnal != 1 && $proposal->jurnal != null)
                                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <form action="/mahasiswa/tugas-akhir/jurnal/ok" method="post" enctype="multipart/form-data" class="jurnal">
                                                                    @csrf
                                                                    <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                                                    <button class="btn btn-success btn-user btn-block" onclick="setujuJurnal()"type="button">OK</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    <br><hr>
                                    <div class="row text-center">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <h5>Rubik Nilai</h5>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                            <form action="/mahasiswa/tugas-akhir/soal" method="post" enctype="multipart/form-data" class="soal">
                                                @csrf
                                                <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                                <input type="text" class="form-control form-control-user status_soal" name="status_soal" hidden/>
                                                @if ($proposal->status_soal == 1)
                                                    <button class="btn btn-danger" onclick="batalSoalConfirmation(0)" type="button" style="margin-left: 10px">Batasi Akses Soal</button>
                                                @else
                                                    <button class="btn btn-success" onclick="soalConfirmation(1)" type="button" style="margin-left: 10px">Beri Akses Soal</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <form action="/mahasiswa/tugas-akhir/nilai" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" class="form-control form-control-user" name="id" value="{{$nilai->id}}" hidden/>
                                        <input type="text" class="form-control form-control-user" name="mahasiswa_id" value="{{$proposal->mahasiswa_id}}" hidden/>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>1. Soal </h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geologi->soal}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>Jawaban</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geologi->jawaban}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <a href="/{{$nilai->soal_geologi->image}}"><img src="/{{$nilai->soal_geologi->image}}" alt="" height="100px"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="text" class="form-control form-control-user" name="status" value="{{$status_nilai}}" hidden/>
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai1" value="{{$nilai['geologi_' . $status_nilai]}}"/>
                                            </div>
                                        </div>                                        
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>2. Soal </h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_dasar->soal}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>Jawaban</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_dasar->jawaban}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <a href="/{{$nilai->soal_geofisika_dasar->image}}"><img src="/{{$nilai->soal_geofisika_dasar->image}}" alt="" height="100px"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai2" value="{{$nilai['geofisika_dasar_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>3. Soal </h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_petrofisika->soal}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>Jawaban</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_petrofisika->jawaban}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <a href="/{{$nilai->soal_petrofisika->image}}"><img src="/{{$nilai->soal_petrofisika->image}}" alt="" height="100px"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required  min="0" max="100" class="form-control form-control-user" name="nilai3" value="{{$nilai['petrofisika_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>4. Soal </h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_terapan->soal}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>Jawaban</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_terapan->jawaban}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <a href="/{{$nilai->soal_geofisika_terapan->image}}"><img src="/{{$nilai->soal_geofisika_terapan->image}}" alt="" height="100px"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai4" value="{{$nilai['geofisika_terapan_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>5. Soal </h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_komputasi->soal}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                        <h5>Jawaban</h5>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                        <h5>: {{$nilai->soal_geofisika_komputasi->jawaban}}</h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                        <a href="/{{$nilai->soal_geofisika_komputasi->image}}"><img src="/{{$nilai->soal_geofisika_komputasi->image}}" alt="" height="100px"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai5" value="{{$nilai['geofisika_komputasi_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <h5>6. Presentasi-Penguasaaan Materi (Kognitif) <span style="font-size: 12px;"><a href="#" onclick="indikator6()">Indikator</a></span></h5>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai6" value="{{$nilai['penguasaan_materi_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <h5>7. Presentasi-Cara Komunikasi <span style="font-size: 12px;"><a href="#" onclick="indikator7()">Indikator</a></span></h5>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai7" value="{{$nilai['cara_komunikasi_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <h5>8. Presentasi-Materi PPT <span style="font-size: 12px;"><a href="#" onclick="indikator8()">Indikator</a></span></h5>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai8" value="{{$nilai['materi_ppt_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <h5>9. Laporan <span style="font-size: 12px;"><a href="#" onclick="indikator9()">Indikator</a></span></h5>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai9" value="{{$nilai['laporan_' . $status_nilai]}}"/>
                                            </div>
                                        </div>
                                        <br>
                                        @if ($status_nilai == 1 || $status_nilai == 2)
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h5>10. Nilai Pembimbingan</h5>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <input type="number" required min="0" max="100" class="form-control form-control-user" name="nilai10" value="{{$nilai['nilai_pembimbingan_' . $status_nilai]}}"/>
                                                </div>
                                            </div>
                                            <br>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-2">
                                                <button class="btn btn-primary btn-user btn-block">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/mahasiswa" class="btn btn-secondary">Kembali</a>
                        </div>
                        @if ($proposal->file_ta != null && $proposal->status == 3)
                            <div class="col-md-6">
                                <div class="row">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#setuju" style="margin: 0 10px">
                                        Maju Sidang
                                    </button>
                                    <div class="modal fade" id="setuju" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <form action="/mahasiswa/tugas-akhir/maju-sidang" method="post" class="setuju">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Mengatur Soal</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" value="{{$proposal['mahasiswa_id']}}" name="mahasiswa_id" hidden>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Geologi <span style="color: red; font-size:10px;">* Required</span></label>
                                                                    <select name="geologi" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('geologi') }}">
                                                                        <option disabled selected>Pilih Soal Geologi</option>
                                                                        @foreach($geologis as $geologi)
                                                                        <option value="{{ $geologi->id }}">{{ $geologi->soal }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Geofisika Dasar <span style="color: red; font-size:10px;">* Required</span></label>
                                                                    <select name="geofisika_dasar" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('geologi') }}">
                                                                        <option disabled selected>Pilih Soal Geofisika Dasar</option>
                                                                        @foreach($geofisika_dasars as $geofisika_dasar)
                                                                        <option value="{{ $geofisika_dasar->id }}">{{ $geofisika_dasar->soal }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Petrofisika <span style="color: red; font-size:10px;">* Required</span></label>
                                                                    <select name="petrofisika" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('geologi') }}">
                                                                        <option disabled selected>Pilih Soal Petrofisika</option>
                                                                        @foreach($petrofisikas as $petrofisika)
                                                                        <option value="{{ $petrofisika->id }}">{{ $petrofisika->soal }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Geofisika Terapan <span style="color: red; font-size:10px;">* Required</span></label>
                                                                    <select name="geofisika_terapan" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('geologi') }}">
                                                                        <option disabled selected>Pilih Soal Geofisika Terapan</option>
                                                                        @foreach($geofisika_terapans as $geofisika_terapan)
                                                                        <option value="{{ $geofisika_terapan->id }}">{{ $geofisika_terapan->soal }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Geofisika Komputasi <span style="color: red; font-size:10px;">* Required</span></label>
                                                                    <select name="geofisika_komputasi" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('geologi') }}">
                                                                        <option disabled selected>Pilih Soal Geofisika Komputasi</option>
                                                                        @foreach($geofisika_komputasis as $geofisika_komputasi)
                                                                        <option value="{{ $geofisika_komputasi->id }}">{{ $geofisika_komputasi->soal }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button class="btn btn-success" onclick="setujuConfirmation()" type="button" style="margin-left: 10px">Maju Sidang</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
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
    
    function soalConfirmation() {
        Swal.fire({
            title: 'Are You Sure?',
            text: "Mahasiswa akan dapat melihat soal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".status_soal" ).val(1);
                $( ".soal" ).submit();
            }
        })
    }
    
    function setujuRevisi() {
        Swal.fire({
            title: 'Apakah anda yakin menyetujui revisi TA?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".revisiTA" ).submit();
            }
        })
    }
    
    function setujuPomits() {
        Swal.fire({
            title: 'Apakah anda yakin menyetujui Pomits?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".pomits" ).submit();
            }
        })
    }
    
    function setujuJurnal() {
        Swal.fire({
            title: 'Apakah anda yakin menyetujui Jurnal?',
            text: "You cannot change the data if it has already been saved",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".jurnal" ).submit();
            }
        })
    }
    
    function batalSoalConfirmation() {
        Swal.fire({
            title: 'Are You Sure?',
            text: "Mahasiswa tidak akan dapat melihat soal",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                $( ".status_soal" ).val(0);
                $( ".soal" ).submit();
            }
        })
    }
    
    function indikator6() {
        Swal.fire({
            html: '<div class="align-justify">Indikator Penilaian <br>' + 
                    '86-100 : Mahasiswa menjawab semua (100%) pertanyaan dengan benar, terstruktur dan jelas; mengerti bagaimana menyelesaikan masalah, mampu mempertahankan argumentasi dengan baik, kesalahan kecil dapat muncul sejauh mereka tidak menunjukkan kesalahpahaman konseptual. <br>' +
                    '76-85 : Mahasiswa menjawab 75% pertanyaan pemahaman dengan benar. Siswa memahami konsep utama dan teknik pemecahan masalah, mampu mempertahankan argumentasi dengan baik, tetapi memiliki beberapa kesenjangan kecil namun tidak berpengaruh signifikan dalam penalaran mereka. <br>' +
                    '66-75 : Mahasiswa telah memahami sebagian masalahnya, kurang mampu mempertahankan argumentasi dengan baik; mahasiswa membutuhkan bimbingan dalam beberapa konsep dasar.<br>' +
                    '61-65 : Siswa memiliki pemahaman yang buruk tentang masalah tersebut, tidak produktif, tidak berusaha memecahkan masalah, tidak mampu mempertahankan argumentasi dengan baik.<br>' +
                    '56-60 : Mahasiswa tidak mengerti masalahnya , telah melakukan sesuatu yang sepenuhnya salah.<br>' +
                    '<56 : Tidak Lulus<br>',
            customClass: 'swal-wide',  
        })
    }
    
    function indikator7() {
        Swal.fire({
            html: '<div class="align-justify">Indikator Penilaian : <br>' +
                    '100-86 : Mahasiswa menggunakan Bahasa Indonesia yang ilmiah, jelas dan benar, dapat dipahami, intonasi suara jelas, melihat kepada audience dengan percaya diri. <br>' +
                    '76-85 : Mahasiswa menggunakan Bahasa Indonesia yang ilmiah, jelas dan benar, kurang dapat dipahami, intonasi suara jelas, melihat kepada audience dengan percaya diri. <br>' +
                    '66-75 : Mahasiswa tidak menggunakan Bahasa Indonesia yang ilmiah, kurang dapat dipahami, intonasi suara jelas, melihat kepada audience dengan percaya diri. <br>' +
                    '61-65 : Mahasiswa tidak menggunakan Bahasa Indonesia yang ilmiah, kurang dapat dipahami, intonasi suara tidak jelas, melihat kepada audience dengan percaya diri <br>' +
                    '56-60 : Mahasiswa tidak menggunakan Bahasa Indonesia yang ilmiah, tidak dapat dipahami, intonasi suara tidak jelas, dan tidak percaya diri. <br>' +
                    '<56 : Tidak Lulus<br>',
            customClass: 'swal-wide',  
        })
    }
    
    function indikator8() {
        Swal.fire({
            html: '<div class="align-justify">Indikator Penilaian :<br>' +
                    '86-100 : Tampilan media presentasi menarik, singkat dan jelas (tidak menuliskan narasi dalam presentasi), interaktif, tersusun dengan jelas. <br>' +
                    '76-85 : Tampilan media presentasi menarik, interaktif namun terlalu panjang/ terlalu banyak  <br>' +
                    '66-75 : Tampilan media presentasi cukup menarik, kurang interaktif, memuat sebagian penjelasan yang disampaikan. <br>' +
                    '61-65 : Tampilan media presentasi kurang menarik, monoton dan memuat sebagian penjelasan yang disampaikan. <br>' +
                    '56-60 : Tampilan media presentasi tidak menarik dan tidak jelas <br>' +
                    '<56 : Tidak Lulus<br>',
            customClass: 'swal-wide',  
        })
    }
    
    function indikator9() {
        Swal.fire({
            html: '<div class="align-justify">Indikator Penilaian :<br>' +
                    '86-100 : Format penulisan sudah sesuai dengan panduan, tata bahasa baku dan ilmiah, mudah dipahami, sesuai dengan yang dikutip di dalam naskah TA, referensi yang muktahir dan relevan, dapat diakses, terindeks. <br>' +
                    '76-85 : Format penulisan sudah sesuai dengan panduan, tata bahasa baku dan ilmiah, mudah dipahami, sesuai dengan yang dikutip di dalam naskah TA, referensi kurang muktahir dan relevan, dapat diakses, sebagian terindeks. <br>' +
                    '66-75 : Format penulisan sudah sesuai dengan panduan, tata bahasa kurang baku dan ilmiah, kurang mudah  dipahami, sebagian dikutip di dalam naskah TA, referensi kurang muktahir dan relevan, dapat diakses, sebagian terindeks. <br>' +
                    '61-65 : Format penulisan kurang sesuai dengan panduan, tata bahasa kurang baku dan ilmiah, kurang mudah dipahami, sebagian dikutip di dalam naskah TA, sebagian referensi yang kurang muktahir dan sebagian terindeks. <br>' +
                    '56-60 : Format penulisan tidak baik, tidak baku, tidak jelas, referensi yang tidak muktahir. <br>' +
                    '<56 : Tidak Lulus<br>',
            customClass: 'swal-wide',  
        })
    }

    function validateSize(input) {
        const fileSize = input.files[0].size / 1024 / 1024; // in MiB
        if (fileSize < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'File Size Less Than 1 Mb'
            })
            $(".upload").val(''); //for clearing with Jquery
        }
        else if (fileSize > 4) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'File Size More Than 4 Mb'
            })
            $(".upload").val(''); //for clearing with Jquery
        }
    }
</script>
@endsection