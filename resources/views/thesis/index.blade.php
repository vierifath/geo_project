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
                        @if($proposal != null)
                            @if($proposal->status == 7)
                                <h6 class="m-0 font-weight-bold text-primary">Thesis Was Accepted</h6>
                            @elseif ($status == 3)
                                <h6 class="m-0 font-weight-bold text-primary">Upload Thesis</h6>
                            @elseif($status == 4)
                                <h6 class="m-0 font-weight-bold text-primary">Revise Thesis</h6>
                            @else
                                <h6 class="m-0 font-weight-bold text-primary">Thesis</h6>
                            @endif
                        @else
                            @if ($status == 3)
                                <h6 class="m-0 font-weight-bold text-primary">Upload Thesis</h6>
                            @elseif($status == 4)
                                <h6 class="m-0 font-weight-bold text-primary">Revise Thesis</h6>
                            @else
                                <h6 class="m-0 font-weight-bold text-primary">Thesis</h6>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if (($status == 3 || $status == 4) && ($proposal->status == 3 || $proposal->status == 6))
                            @if ($proposal->status == 6)
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Revised File {{$proposal->dosen_pembimbing_1->nama}}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        @if ($proposal['revisi_dosen_pembimbing_1'] == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal['revisi_dosen_pembimbing_1']) }}" target="_blank">{{str_replace('storage/file/', '', $proposal['revisi_dosen_pembimbing_1'])}}</a> </h5>
                                        @endif
                                    </div>
                                    @if ($proposal['dosen_pembimbing_2_id'] != null)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Revised File {{$proposal->dosen_pembimbing_2->nama}}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        @if ($proposal['revisi_dosen_pembimbing_2'] == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal['revisi_dosen_pembimbing_2']) }}" target="_blank">{{str_replace('storage/file/', '', $proposal['revisi_dosen_pembimbing_2'])}}</a> </h5>
                                        @endif
                                    </div>
                                    @endif
                                    @if ($proposal['dosen_pembimbing_luar'] != null)
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Revised File {{$proposal->dosen_pembimbing_luar_id->nama}}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        @if ($proposal['revisi_dosen_luar'] == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal['revisi_dosen_luar']) }}" target="_blank">{{str_replace('storage/file/', '', $proposal['revisi_dosen_luar'])}}</a> </h5>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Revised File {{$proposal->dosen_penguji_1->nama}}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        @if ($proposal['revisi_dosen_penguji_1'] == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal['revisi_dosen_penguji_1']) }}" target="_blank">{{str_replace('storage/file/', '', $proposal['revisi_dosen_penguji_1'])}}</a> </h5>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Revised File {{$proposal->dosen_penguji_2->nama}}</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        @if ($proposal['revisi_dosen_penguji_2'] == null)
                                            <h5>: </h5>
                                        @else
                                            <h5>: <a href="{{ url($proposal['revisi_dosen_penguji_2']) }}" target="_blank">{{str_replace('storage/file/', '', $proposal['revisi_dosen_penguji_2'])}}</a> </h5>
                                        @endif
                                    </div>
                                </div>
                                <hr><br>
                            @endif
                            <form action="/tugas-akhir/update" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Thesis File <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                            <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="upload" accept="application/pdf"/>
                                            <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                        </div>
                                    </div>
                                </div>
                                @if ($proposal->status == 6)    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Geofisika Journal File <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                                <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="jurnal" accept="application/pdf"/>
                                                <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pomits File <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                                <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="pomits" accept="application/pdf"/>
                                                <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button class="btn btn-primary btn-user btn-block">Edit</button>
                            </form>
                        @else
                            @if ($proposal == null || $proposal->status != 7 || ($proposal->status_jurnal == 1 && $proposal->status_pomits == 1))    
                                <div class="text-center">
                            @else
                                <div>
                            @endif
                                @if ($proposal != null && $proposal->status_soal == 1)
                                 <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <h5>1. Question </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: {{$nilai->soal_geologi->soal}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <a href="/{{$nilai->soal_geologi->image}}"><img src="/{{$nilai->soal_geologi->image}}" alt="" height="100px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                        
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <h5>2. Question </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: {{$nilai->soal_geofisika_dasar->soal}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <a href="/{{$nilai->soal_geofisika_dasar->image}}"><img src="/{{$nilai->soal_geofisika_dasar->image}}" alt="" height="100px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <h5>3. Question </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: {{$nilai->soal_petrofisika->soal}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <a href="/{{$nilai->soal_petrofisika->image}}"><img src="/{{$nilai->soal_petrofisika->image}}" alt="" height="100px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <h5>4. Question </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: {{$nilai->soal_geofisika_terapan->soal}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <a href="/{{$nilai->soal_geofisika_terapan->image}}"><img src="/{{$nilai->soal_geofisika_terapan->image}}" alt="" height="100px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                <h5>5. Question </h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <h5>: {{$nilai->soal_geofisika_komputasi->soal}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                <a href="/{{$nilai->soal_geofisika_komputasi->image}}"><img src="/{{$nilai->soal_geofisika_komputasi->image}}" alt="" height="100px"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($proposal == null || ($proposal != null && (($status != 0 && $status < 3) || $proposal->status == 0)))
                                    <h1>Not Yet Time to Upload Thesis</h1>
                                @else
                                    @if ($proposal != null && $proposal->status == 5)
                                        <h1>Your Proposal Was Rejected!</h1>
                                    @elseif($proposal != null && $proposal->status == 7 && $proposal->status_jurnal != 1 && $proposal->status_pomits != 1)
                                    <form action="/tugas-akhir/update" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Geofisika Journal File <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                                    <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="jurnal" accept="application/pdf"/>
                                                    <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pomits File <span style="color: red; font-size:10px;">File: PDF, Size: 1Mb - 4Mb</span></label>
                                                    <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="pomits" accept="application/pdf"/>
                                                    <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">Edit</button>
                                    </form>
                                    @else
                                        <h1>Thesis Upload Time Has Expired</h1>
                                    @endif
                                @endif
                                @if (($proposal == null || ($proposal->status != 7 || ($proposal->status_jurnal == 1 && $proposal->status_pomits == 1)) && $proposal->status_soal != 1))    
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                                @endif
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
    $("#sidebar-ta").addClass("active");

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