@extends('layouts.master')

@section('content')

<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-box"></i>
                        LAPORAN JENIS FORM PENILAIAN
                    </h4>
                </div>
            </div>
            <div class="row">
                <ul class="nav responsive-tab nav-material nav-material-white" id="v-pills-tab">
                    <li>
                        <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">
                            <i class="icon icon-home2"></i>Today</a>
                    </li>
                    {{-- <li>
                        <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3"><i
                                class="icon icon-security"></i>Change Password</a>
                    </li> --}}
                </ul>
                <a class="btn-fab absolute fab-right-bottom btn-primary" data-toggle="control-sidebar">
                    <i class="icon icon-menu"></i>
                </a>
            </div>
        </div>
    </header>
    <div class="container-fluid relative animatedParent animateOnce">
        <div class="tab-content pb-3" id="v-pills-tabContent">
            <!--Today Tab Start-->
            <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                <div class="row my-3">
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-note-list text-light-blue s-48"></span>
                                </div>
                                <div class="counter-title">Total Laporan </div>
                                <h5 class="sc-counter mt-3">{{$total_laporan}}</h5>
                                <input type="hidden" id="slug_jenis" value="{{$jenis->slug_jenis}}">
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                
                            </div>
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table table-responsive">
                                    <div class="card-title" style="margin-left: 15px">Tabel Laporan {{$jenis->nama_jenis}}</div>
                                    <div class="card-title" style="margin-left: 15px; margin-right: 15px;"><input type="month" id="bulan" value="{{date('Y-m')}}" class="form-control"></div>
                                    <table id="table-data" class="table table-bordered table-hover data-tables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jabatan</th>
                                                <th>Karyawan</th>
                                                <th>Pengisian</th>
                                                <th>Total Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Jabatan</th>
                                                <th>Karyawan</th>
                                                <th>Pengisian</th>
                                                <th>Total Score</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <!--Today Tab End-->
            <div class="tab-pane animated fadeInUpShort" id="v-pills-3">
                <div class="row">
                    <div class="col-md-4 mx-md-auto m-5">
                        <div class="card no-b shadow">
                            <div class="card-body p-4">
                                <div>
                                    <i class="icon-calendar-check-o s-48 text-primary"></i>
                                    <code class="p-t-b-20">Hey Soldier welcome back signin now there is lot
                                        of new stuff
                                        waiting
                                        for you</code>
                                </div>
                                <form action="dashboard2.html">
                                    <div class="form-group has-icon"><i class="icon-calendar"></i>
                                        <input class="form-control form-control-lg datePicker"
                                            placeholder="Date From" type="text">
                                    </div>
                                    <div class="form-group has-icon"><i class="icon-calendar"></i>
                                        <input class="form-control form-control-lg datePicker"
                                            placeholder="Date TO" type="text">
                                    </div>
                                    <input class="btn btn-success btn-lg btn-block" value="Get Data"
                                        type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Yesterday Tab Start-->
        </div>
    </div>
</div>
<!-- Right Sidebar -->

{{-- modal --}}



@endsection

@section('script')
    <script>
      $(document).ready(function() {
            var slug = $('#slug_jenis').val();
            var bulan= $('#bulan').val();
            console.log(bulan);
            $('#table-data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/karyawan-form-laporan/'+slug,
                    data: {
                        bulan: bulan
                    }
                },
                columns: [
                    {
                        "width": 10,
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'karyawan',
                        name: 'karyawan'
                    },
                    {
                        data: 'pengisian',
                        name: 'pengisian'
                    },
                    
                    {
                        data: 'score',
                        name: 'score'
                    },
                    
                ]
            });
        })

        $('#bulan').on('change', function() {
            var bulan = this.value;
            if (bulan == '') {
                var slug = $('#slug_jenis').val();
                var bulan= $('#bulan').val();
                console.log(bulan);
                $('#table-data').DataTable({
                    //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/karyawan-form-laporan/'+slug,
                    },
                    columns: [
                        {
                            "width": 10,
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan'
                        },
                        {
                            data: 'pengisian',
                            name: 'pengisian'
                        },
                        
                        {
                            data: 'score',
                            name: 'score'
                        },
                        
                    ]
                });
            }else{
                var slug = $('#slug_jenis').val();
                var bulan= $('#bulan').val();
                console.log(bulan);
                $('#table-data').DataTable({
                    //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/karyawan-form-laporan/'+slug,
                        data: {
                            bulan: bulan
                        }
                    },
                    columns: [
                        {
                            "width": 10,
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'jabatan',
                            name: 'jabatan'
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan'
                        },
                        {
                            data: 'pengisian',
                            name: 'pengisian'
                        },
                        
                        {
                            data: 'score',
                            name: 'score'
                        },
                        
                    ]
                });
            }
            
        });
    </script>
@endsection