@extends('layouts.master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Daerah Provinsi Indonesia
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav responsive-tab nav-material nav-material-white" id="v-pills-tab">
                        <li>
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">
                                <i class="icon icon-home2"></i>Today</a>
                        </li>
                    </ul>
                    <a class="btn-fab absolute fab-right-bottom btn-primary" data-toggle="control-sidebar">
                        <i class="icon icon-menu"></i>
                    </a>
                </div>
            </div>
        </header>
        <hr>
        
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
                                    <div class="counter-title">Total Provinsi </div>
                                    <h5 class="sc-counter mt-3" id="total_kategori">{{$provinsi}}</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modalimport">Import Provinsi</button>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table table-responsive">
                                    <div class="card-title">Provinsi Indonesia</div>
                                    <table id="table-data" class="table table-bordered table-hover data-tables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                
                                                <th>Nama Provinsi</th>
                                                <th>Jumlah Kabupaten</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                
                                                <th>Nama Provinsi</th>
                                                <th>Jumlah Kabupaten</th>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
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
                                            <input class="form-control form-control-lg datePicker" placeholder="Date From"
                                                type="text">
                                        </div>
                                        <div class="form-group has-icon"><i class="icon-calendar"></i>
                                            <input class="form-control form-control-lg datePicker" placeholder="Date TO"
                                                type="text">
                                        </div>
                                        <input class="btn btn-success btn-lg btn-block" value="Get Data" type="submit">
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

    <div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-success">
                    <h6 class="modal-title text-white" id="exampleModalLabel">DATA BARU</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form action="{{route('be.provinsi.import')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="jenis_id" style="font-size: 14px" class="text-capitalize">Import Data Provinsi </label><br>
                            <input type="file" class="" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success l-s-1 s-12 text-uppercase" value="IMPORT DATA PROVINSI" id="btnadd" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
@endsection

@section('script')
    <script>
        
        $(document).ready(function() {
            var s_jenis = $('#s_jenis').val();
            console.log(s_jenis);
            $('#table-data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('be.provinsi.page')}}",
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
                        data: 'nama_provinsi',
                        name: 'nama_provinsi'
                    },
                    {
                        data: 'jumlah_kabupaten',
                        name: 'jumlah_kabupaten'
                    },
                ]
            });
        })

       

        
    </script>
@endsection
