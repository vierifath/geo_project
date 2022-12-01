@extends('layouts.home')

@section('title','Dashboard | Mahasiswa')

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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Thesis</h6>
                        @if ($proposal == null)
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Haven't Upload Proposal Yet</button>
                        @else
                            @if ($proposal->status < 3)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Already Upload Proposal</button>
                            @else
                                @if ($proposal->file_ta == null)
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">Haven't Upload Thesis Yet</button>
                                @else
                                    <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Already Upload Thesis</button>
                                @endif
                            @endif
                        @endif
                        @php
                            if ($status > 0 && $status < 5) {
                                $new_month = [' January ', ' February ', ' March ', ' April ', ' May ', ' June ', ' July ', ' August ', ' September ', ' October ', ' November ', ' December '];
                                $old_month = ['/01/', '/02/', '/03/', '/04/', '/05/', '/06/', '/07/', '/08/', '/09/', '/10/', '/11/', '/12/'];

                                $date = str_replace(' - ', '/', $date);

                                $date = explode("/", $date);
                                $date = $date[1] . "/" . $date[0] . "/" . $date[2] . " - " . $date[4] . "/" . $date[3] . "/" . $date[5];

                                for ($i=0; $i < 12; $i++) { 
                                    $date = str_replace($old_month[$i], $new_month[$i], $date);
                                }
                            }
                        @endphp
                        @switch($status)
                            @case(-1)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Admin Haven't Set Schedule Yet</button>
                                @break
                            @case(1)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Proposal Upload Date: {{$date}}</button>
                                @break
                            @case(2)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Proposal Revision Date : {{$date}}</button>
                                @break
                            @case(3)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Thesis Upload Date : {{$date}}</button>
                                @break
                            @case(4)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Thesis Revision Date : {{$date}}</button>
                                @break
                            @case(5)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">Your Thesis Was Rejected!</button>
                                @break
                            @case(6)
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">Pass the Session</button>
                                @break
                            @default
                                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Waiting to Session</button>
                                @break
                        @endswitch
                    </div>
                </div>
                <div class="card-body">
                    @if ($proposal == null)
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="img/undraw_posting_photo.svg" alt="...">
                        </div>
                        <p>Upload Proposal</p>
                        <a href="/proposal">Check Proposal&rarr;</a>
                    @else
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Name</h5>
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
                                            <h5>Thesis Title</h5>
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
                                                        <button class="btn btn-secondary"> Register</button>
                                                    @else
                                                        <button class="btn btn-secondary"> Proposal Seminar</button>
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
                                                    <button class="btn btn-secondary"> Ready to Get Session</button>
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
                                    <br><hr>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Thesis File</h5>
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
                                            <h5>Thesis Session Date</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->tanggal_sidang_ta }} </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <h5>Thesis Session Location</h5>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                            <h5>: {{ $proposal->lokasi_sidang_ta }} </h5>
                                        </div>
                                    </div>
                                    @if ($proposal->dosen_penguji_3 != null)
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <h5>1st Examiner</h5>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <h5>: {{ $proposal->dosen_penguji_3->nama }} </h5>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($proposal->dosen_penguji_4 != null)
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <h5>2nd Examiner</h5>
                                            </div>
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <h5>: {{ $proposal->dosen_penguji_4->nama }} </h5>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($proposal->pomits != null && $proposal->jurnal != null)
                                    <br><hr>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <h5>Pomits File</h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: <a href="{{ url($proposal->pomits) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->pomits)}}</a> </h5>
                                            </div>
                                            @if ($proposal->status_pomits == 1)
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                    <button class="btn btn-success btn-user btn-block">OK</button>
                                                </div>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <h5>Journal File</h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: <a href="{{ url($proposal->jurnal) }}" target="_blank">{{str_replace('storage/file/', '', $proposal->jurnal)}}</a> </h5>
                                            </div>
                                            @if ($proposal->status_jurnal == 1)
                                                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                                    <button class="btn btn-success btn-user btn-block">OK</button>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
<script type="text/javascript">
    $("#sidebar-dashboard").addClass("active");
</script>
@endsection