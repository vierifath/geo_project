@extends('layouts.home')

@section('title','Proposal')

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
        <h1 class="h3 mb-0 text-gray-800">Proposal</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        @if($proposal != null)
                            @if($proposal->status >= 3)
                                <h6 class="m-0 font-weight-bold text-primary">Thesis Proposal Was Accepted</h6>
                            @elseif ($status == 1)
                                <h6 class="m-0 font-weight-bold text-primary">Upload Thesis Proposal</h6>
                            @elseif($status == 2)
                                <h6 class="m-0 font-weight-bold text-primary">Revise Thesis Proposal</h6>
                            @else
                                <h6 class="m-0 font-weight-bold text-primary">Thesis Proposal</h6>
                            @endif
                        @else
                            @if ($status == 1)
                                <h6 class="m-0 font-weight-bold text-primary">Upload Thesis Proposal</h6>
                            @elseif($status == 2)
                                <h6 class="m-0 font-weight-bold text-primary">Revise Thesis Proposal</h6>
                            @else
                                <h6 class="m-0 font-weight-bold text-primary">Thesis Proposal</h6>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div>
                        @if ($proposal == null)
                            @if ($status < 1)
                                <div class="text-center">
                                    <h1>Not yet time to upload proposals</h1>
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                                </div>
                            @else
                                <form action="/proposal/add" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title <span style="color: red; font-size:10px;">* Required</span></label>
                                                <textarea name="judul" class="form-control form-control-user" value="{{ old('nama') }}" required cols="30" rows="3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Knowledge Field <span style="color: red; font-size:10px;">* Required</span></label>
                                                <input type="text" class="form-control form-control-user" name="bidang_ilmu" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Methodology <span style="color: red; font-size:10px;">* Required</span></label>
                                                <textarea name="metodologi" class="form-control form-control-user" value="{{ old('nama') }}" required cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Abstract <span style="color: red; font-size:10px;">* Required</span></label>
                                                <textarea name="abstrak" class="form-control form-control-user" value="{{ old('nama') }}" required cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Proposal File <span style="color: red; font-size:10px;">* Required | File: PDF, Size: 1Mb - 4Mb</span></label>
                                                <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="upload" accept="application/pdf" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>RMK <span style="color: red; font-size:10px;">* Required</span></label>
                                                <select name="rmk" class="form-control form-control-user select2" style="width: 100%;" value="{{ old('rmk') }}">
                                                    <option disabled selected>Choose RMK</option>
                                                    @foreach($rmks as $rmk)
                                                    <option value="{{ $rmk->id }}">{{ $rmk->nama }}</option>
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
                                                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>2nd Advisor</label>
                                                <select name="dosen_pembimbing_2" id="dosen-pembimbing-2"  class="form-control form-control-user select2" style="width: 100%;" value="{{ old('dosen_pembimbing_2') }}">
                                                    <option disabled selected>Choose 2nd Advisor</option>
                                                    <option value="batal">Cancel</option>
                                                    @foreach($dosens as $dosen)
                                                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>External Advisor</label>
                                                <select name="dosen_pembimbing_luar" class="form-control form-control-user select2" id="dosen-pembimbing-3" style="width: 100%;" value="{{ old('dosen_pembimbing_luar') }}">
                                                    <option disabled selected>Choose External Advisor</option>
                                                    <option value="batal">Cancel</option>
                                                    @foreach($dosen_luars as $dosen)
                                                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">Add</button>
                                </form>
                            @endif
                        @else
                            @if (($status == 1 || $status == 2) && ($proposal->status == 0 || $proposal->status == 2))
                                <form action="/proposal/update" method="post" enctype="multipart/form-data">
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
                                                <label>Thesis Proposal File <span style="color: red; font-size:10px;">* Required | File: PDF, Size: 1Mb - 4Mb</span></label>
                                                <input type="file" onchange="validateSize(this)" class="form-control form-control-user upload" name="upload" accept="application/pdf"/>
                                                <input type="text" class="form-control form-control-user" name="id" value="{{$proposal->id}}" hidden/>
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
                                                <select name="dosen_pembimbing_2" class="form-control form-control-user select2" id="dosen-pembimbing-2" style="width: 100%;" value="{{ old('dosen_pembimbing_2') }}">
                                                    <option disabled selected>Choose 2nd Advisor</option>
                                                    <option value="batal">Cancel</option>
                                                    @foreach($dosens as $dosen)
                                                    <option value="{{ $dosen->id }}" @if ($proposal->dosen_pembimbing_2_id == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>External Advisor</label>
                                                <select name="dosen_pembimbing_luar" class="form-control form-control-user select2" id="dosen-pembimbing-3" style="width: 100%;" value="{{ old('dosen_pembimbing_2') }}">
                                                    <option disabled selected>Choose External Advisor</option>
                                                    <option value="batal">Cancel</option>
                                                    @foreach($dosen_luars as $dosen)
                                                    <option value="{{ $dosen->id }}" @if ($proposal->dosen_pembimbing_luar == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">Edit</button>
                                </form>
                            @else
                                <div class="text-center">
                                    @if ($proposal->status == 1)
                                        <h1>Your Proposal Was Rejected!</h1>
                                    @else
                                        <h1>Proposal Upload Time Has Expired</h1>
                                    @endif
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                    src="img/undraw_posting_photo.svg" alt="...">
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('custom-js')
<script type="text/javascript">
    $("#sidebar-proposal").addClass("active");

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

    $('#dosen-pembimbing-2').change(function(){
        var selected = $(this).val();
        if (selected == 'batal') {
            $('#dosen-pembimbing-2').val('');
        }
    })
    
    $('#dosen-pembimbing-3').change(function(){
        var selected = $(this).val();
        if (selected == 'batal') {
            $('#dosen-pembimbing-3').val('');
        }
    })
</script>
@endsection