@extends('layouts.home')

@section('title','Dashboard | Admin')

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
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/home" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-2">
                        <label>Odd / Even</label>
                        <select class="form-control select2" style="width: 100%;" name="bulan" required>
                            <option value="gasal" @if ($tahun_ajaran == 'gasal') selected @endif>Odd</option>
                            <option value="genal" @if ($tahun_ajaran == 'genap') selected @endif>Even</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label>Tahun</label>
                        <select class="form-control select2" style="width: 100%;" name="tahun" required>
                            @for ($j = 2021; $j <= $tahun_ini; $j++)
                                <option value="{{$j}}" @if ($tahun == $j) selected @endif>{{$j}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>Advisor</label>
                        <select name="dosen_pembimbing" id="dosen-pembimbing"  class="form-control form-control-user select2" style="width: 100%;">
                            <option disabled selected>Choose Advisor</option>
                            <option value="batal">Cancel</option>
                            @foreach($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label>RMK</label>
                        <select name="rmk" id="rmk"  class="form-control form-control-user select2" style="width: 100%;">
                            <option disabled selected>Choose RMK</option>
                            <option value="batal">Cancel</option>
                            @foreach($rmks as $rmk)
                            <option value="{{ $rmk->id }}">{{ $rmk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Proposal Data</h6>
                </div>
                <div class="col-6">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Download Proposal Recapitulation</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>NRP</th>
                            <th>Title</th>
                            <th>Proposal Status</th>
                            <th>RMK</th>
                            <th>Advisor</th>
                            <th>Examiner</th>
                            <th>Session Date</th>
                            <th>Session Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal as $item)
                            <tr>
                                <td>{{$item->mahasiswa->nama}}</td>
                                <td>{{$item->mahasiswa->nip}}</td>
                                <td>{{$item->judul}}</td>
                                @if ($item->status < 1)
                                    <td>Dalam Ulasan</td>
                                @else
                                    <td>Disetujui</td>
                                @endif
                                <td>{{$item->rmk->nama}}</td>
                                <td>
                                    1. {{$item->dosen_pembimbing_1->nama}}
                                    @if ($item->dosen_pembimbing_2_id != null)
                                        <br>
                                        2. {{$item->dosen_pembimbing_2->nama}}
                                    @endif
                                    @if ($item->dosen_pembimbing_luar != null)
                                        <br>
                                        2. {{$item->dosen_pembimbing_luar_id->nama}}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->dosen_penguji_1_id != null)
                                        1. {{$item->dosen_penguji_1->nama}}
                                    @endif
                                    @if ($item->dosen_penguji_2_id != null)
                                        <br>
                                        2. {{$item->dosen_penguji_2->nama}}
                                    @endif
                                </td>
                                @if ($item->status < 1)
                                    <td>-</td>
                                @else
                                    <td>{{$item->tanggal_sidang_proposal}}</td>
                                @endif
                                @if ($item->status < 1)
                                    <td>-</td>
                                @else
                                    <td>{{$item->lokasi_sidang_proposal}}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-6">
                    <h6 class="m-0 font-weight-bold text-primary">Thesis Data</h6>
                </div>
                <div class="col-6">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Download Thesis Recapitulation</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>NRP</th>
                            <th>Title</th>
                            <th>Thesis Status</th>
                            <th>RMK</th>
                            <th>Advisor</th>
                            <th>Examiner</th>
                            <th>Session Date</th>
                            <th>Session Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposal as $item)
                        @if ($item->status >= 3)
                            <tr>
                                <td>{{$item->mahasiswa->nama}}</td>
                                <td>{{$item->mahasiswa->nip}}</td>
                                <td>{{$item->judul}}</td>
                                @if ($item->status == 3)
                                    @if ($item->file_ta != null)
                                        <td>In Review</td>
                                    @else
                                        <td>Upload Thesis</td>
                                    @endif
                                @elseif($item->status == 4)
                                    <td>Waiting for Session</td>
                                @elseif($item->status == 6)
                                    <td>Thesis Was Revised</td>
                                @elseif($item->status == 7)
                                    <td>Thesis Was Accepted</td>
                                @else
                                    <td>Thesis Was Rejected</td>
                                @endif
                                <td>{{$item->rmk->nama}}</td>
                                <td>
                                    1. {{$item->dosen_pembimbing_1->nama}}
                                    @if ($item->dosen_pembimbing_2_id != null)
                                        <br>
                                        2. {{$item->dosen_pembimbing_2->nama}}
                                    @endif
                                    @if ($item->dosen_pembimbing_luar != null)
                                        <br>
                                        2. {{$item->dosen_pembimbing_luar_id->nama}}
                                    @endif
                                </td>
                                <td>
                                    @if ($item->dosen_penguji_3_id != null)
                                        1. {{$item->dosen_penguji_3->nama}}
                                    @endif
                                    @if ($item->dosen_penguji_4_id != null)
                                        <br>
                                        2. {{$item->dosen_penguji_4->nama}}
                                    @endif
                                </td>
                                @if ($item->tanggal_sidang_ta == null)
                                    <td>-</td>
                                @else
                                    <td>{{$item->tanggal_sidang_ta}}</td>
                                @endif
                                @if ($item->lokasi_sidang_ta == null)
                                    <td>-</td>
                                @else
                                    <td>{{$item->lokasi_sidang_ta}}</td>
                                @endif
                            </tr>
                        @endif
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
        $("#sidebar-dashboard").addClass("active");
        $(document).ready( function () {
            $('#dataTable2').DataTable();
        } );

        $('#dosen-pembimbing').change(function(){
            var selected = $(this).val();
            if (selected == 'batal') {
                $('#dosen-pembimbing').val('');
            }
        })
        $('#rmk').change(function(){
            var selected = $(this).val();
            if (selected == 'batal') {
                $('#rmk').val('');
            }
        })
    </script>
@endsection