@extends('layouts.home')

@section('title','Schedule')

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
        <h1 class="h3 mb-0 text-gray-800">Schedule</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-12 mb-6">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Schedule</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/schedule/update" method="post">
                        @csrf
                        @php
                            if ($config['waktu_upload_proposal'] != null && $config['waktu_upload_akhir'] != null && $config['waktu_revisi_proposal'] != null && $config['waktu_revisi_akhir'] != null && $config['waktu_sidang_proposal'] != null && $config['waktu_sidang_akhir'] != null) {
                                $new_month = [' January ', ' February ', ' March ', ' April ', ' May ', ' June ', ' July ', ' August ', ' September ', ' October ', ' November ', ' December '];
                                $old_month = ['/01/', '/02/', '/03/', '/04/', '/05/', '/06/', '/07/', '/08/', '/09/', '/10/', '/11/', '/12/'];

                                $config['waktu_upload_proposal'] = str_replace(' - ', '/', $config['waktu_upload_proposal']);
                                $config['waktu_upload_akhir'] = str_replace(' - ', '/', $config['waktu_upload_akhir']);
                                $config['waktu_revisi_proposal'] = str_replace(' - ', '/', $config['waktu_revisi_proposal']);
                                $config['waktu_revisi_akhir'] = str_replace(' - ', '/', $config['waktu_revisi_akhir']);
                                $config['waktu_sidang_proposal'] = str_replace(' - ', '/', $config['waktu_sidang_proposal']);
                                $config['waktu_sidang_akhir'] = str_replace(' - ', '/', $config['waktu_sidang_akhir']);

                                $waktu_upload_proposal = explode("/", $config['waktu_upload_proposal']);
                                $config['waktu_upload_proposal'] = $waktu_upload_proposal[1] . "/" . $waktu_upload_proposal[0] . "/" . $waktu_upload_proposal[2] . " - " . $waktu_upload_proposal[4] . "/" . $waktu_upload_proposal[3] . "/" . $waktu_upload_proposal[5];
                                $waktu_upload_akhir = explode("/", $config['waktu_upload_akhir']);
                                $config['waktu_upload_akhir'] = $waktu_upload_akhir[1] . "/" . $waktu_upload_akhir[0] . "/" . $waktu_upload_akhir[2] . " - " . $waktu_upload_akhir[4] . "/" . $waktu_upload_akhir[3] . "/" . $waktu_upload_akhir[5];
                                $waktu_revisi_proposal = explode("/", $config['waktu_revisi_proposal']);
                                $config['waktu_revisi_proposal'] = $waktu_revisi_proposal[1] . "/" . $waktu_revisi_proposal[0] . "/" . $waktu_revisi_proposal[2] . " - " . $waktu_revisi_proposal[4] . "/" . $waktu_revisi_proposal[3] . "/" . $waktu_revisi_proposal[5];
                                $waktu_revisi_akhir = explode("/", $config['waktu_revisi_akhir']);
                                $config['waktu_revisi_akhir'] = $waktu_revisi_akhir[1] . "/" . $waktu_revisi_akhir[0] . "/" . $waktu_revisi_akhir[2] . " - " . $waktu_revisi_akhir[4] . "/" . $waktu_revisi_akhir[3] . "/" . $waktu_revisi_akhir[5];
                                $waktu_sidang_proposal = explode("/", $config['waktu_sidang_proposal']);
                                $config['waktu_sidang_proposal'] = $waktu_sidang_proposal[1] . "/" . $waktu_sidang_proposal[0] . "/" . $waktu_sidang_proposal[2] . " - " . $waktu_sidang_proposal[4] . "/" . $waktu_sidang_proposal[3] . "/" . $waktu_sidang_proposal[5];
                                $waktu_sidang_akhir = explode("/", $config['waktu_sidang_akhir']);
                                $config['waktu_sidang_akhir'] = $waktu_sidang_akhir[1] . "/" . $waktu_sidang_akhir[0] . "/" . $waktu_sidang_akhir[2] . " - " . $waktu_sidang_akhir[4] . "/" . $waktu_sidang_akhir[3] . "/" . $waktu_sidang_akhir[5];

                                for ($i=0; $i < 12; $i++) { 
                                    $config['waktu_upload_proposal'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_upload_proposal']);
                                    $config['waktu_upload_akhir'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_upload_akhir']);
                                    $config['waktu_revisi_proposal'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_revisi_proposal']);
                                    $config['waktu_revisi_akhir'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_revisi_akhir']);
                                    $config['waktu_sidang_proposal'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_sidang_proposal']);
                                    $config['waktu_sidang_akhir'] = str_replace($old_month[$i], $new_month[$i], $config['waktu_sidang_akhir']);
                                }
                            }
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="m-0 font-weight-bold text-primary">Proposal</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Proposal</label>   
                                    <input type='text' class="form-control" id='datetimepicker1' name="waktu_upload_proposal" value="{{$config['waktu_upload_proposal']}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Revised Proposal</label>   
                                    <input type='text' class="form-control" id='datetimepicker2' name="waktu_revisi_proposal" value="{{$config['waktu_revisi_proposal']}}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <h6 class="m-0 font-weight-bold text-primary">Thesis</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Upload Thesis</label>   
                                    <input type='text' class="form-control" id='datetimepicker3' name="waktu_upload_akhir" value="{{$config['waktu_upload_akhir']}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Upload Thesis Revised</label>   
                                    <input type='text' class="form-control" id='datetimepicker4' name="waktu_revisi_akhir" value="{{$config['waktu_revisi_akhir']}}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <h6 class="m-0 font-weight-bold text-primary">Session</h6>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Proposal Session</label>   
                                    <input type='text' class="form-control" id='datetimepicker5' name="waktu_sidang_proposal" value="{{$config['waktu_sidang_proposal']}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Thesis Session</label>   
                                    <input type='text' class="form-control" id='datetimepicker6' name="waktu_sidang_akhir" value="{{$config['waktu_sidang_akhir']}}"/>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-user btn-block">Edit</button>
                    </form>
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
    $("#jadwal").addClass("active");
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
        $('#datetimepicker2').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
        $('#datetimepicker3').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
        $('#datetimepicker4').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
        $('#datetimepicker5').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
        $('#datetimepicker6').daterangepicker({ 
            locale: {
                format: 'DD MMMM YYYY'
            },
            opens: 'left',
        });
    });
</script>
@endsection