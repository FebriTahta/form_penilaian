@extends('layouts.master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Forms Karyawan
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
                                    <div class="counter-title">Data Karyawan </div>
                                    <h5 class="sc-counter mt-3" id="total_kategori">{{$karyawan}}</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- <button class="btn btn-primary btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modaladd">Tambahkan Karyawan Baru</button> --}}
                    <button class="btn btn-success btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modalimport">Import Data Karyawan</button>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table table-responsive">
                                    <div class="card-title">Kategori Penilaian</div>
                                    <table id="table-data" class="table table-bordered table-hover data-tables">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Phone Number</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Phone Number</th>
                                                <th>Option</th>
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

    <div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">DATA BARU</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="formadd" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="jenis_id">Jenis Penilaian </label>
                            <select name="jenis_id" class="form-control text-capitalize" id="jenis_id" required>
                                <option value="">- Pilih Jenis Penilaian -</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label form="nama_kategori">Kategori Penilaian </label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="TAMBAH DATA BARU" id="btnadd" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-success">
                    <h6 class="modal-title text-white" id="exampleModalLabel">DATA BARU</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form action="{{route('be_import_karyawan')}}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="jenis_id" style="font-size: 14px" class="text-capitalize">Import Data Karyawan </label><br>
                            <input type="file" class="" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success l-s-1 s-12 text-uppercase" value="IMPORT DATA KARYAWAN" id="btnadd" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladd2" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-success">
                    <h6 class="modal-title text-white" id="exampleModalLabel">POIN PENILAIAN BARU</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="formadd2" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 class="text-capitalize bold" >Kategori : <span id="nama_kategori"> </span> </h5>
                            <input type="hidden" id="kategori_id" name="kategori_id">
                        </div>

                        <div class="form-group">
                            <label form="nama_poin">Nama Poin Penilaian </label>
                            <input type="text" class="form-control" id="nama_poin" name="nama_poin" required>  
                        </div>

                        <div class="form-group">
                            <label form="besar_poin">Besar Poin Penilaian </label>
                            <input type="number" class="form-control" id="besar_poin" name="besar_poin" required>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="TAMBAH POIN PENILAIAN" id="btnadd2" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaldel" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-danger">
                    <h6 class="modal-title text-white" id="exampleModalLabel">HAPUS DATA</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="formdel" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" >
                            <h5>Kategori : <i id="nama_kategori" class="text-capitalize"></i></h5>
                        </div>
                        <div class="form-group">
                            <code>Yakin menghapus kategori penilaian tersebut dari database ?</code>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger l-s-1 s-12 text-uppercase" value="YA HAPUS! SAYA YAKIN!" id="btndell" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-primary">
                    <h6 class="modal-title text-white" id="exampleModalLabel">UPDATE BARU</h6>
                    <a href="#" data-dismiss="modal" aria-label="Close"
                       class="paper-nav-toggle paper-nav-white active"><i></i></a>
                </div>
                <form id="formedit" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" required>  
                        </div>
                        <div class="form-group">
                            <label form="jenis_id">Jenis Penilaian </label>
                            <select name="jenis_id" class="form-control text-capitalize" id="jenis_id" required>
                                <option value="">- Pilih Jenis Penilaian -</option>
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label form="nama_kategori">Kategori Penilaian </label>
                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>  
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="UPDATE DATA" id="btnedit" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('be_index_karyawan') }}',
                    // data: {
                    //     dari: dari,
                    //     sampai: sampai
                    // }
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
                        data: 'nama_karyawan',
                        name: 'nama_karyawan'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'telp_karyawan',
                        name: 'telp_karyawan'
                    },
                    {
                        data: 'option',
                        name: 'option'
                    },

                ]
            });
        })

        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_store_kategori') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnadd').attr('disabled', 'disabled');
                    $('#btnadd').val('Processing');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formadd")[0].reset();
                        var oTable = $('#table-data').dataTable();
                        oTable.fnDraw(false);
                        $('#btnadd').val('ADD KATEGORI');
                        $('#btnadd').attr('disabled', false);
                        $('#modaladd').modal('hide');
                        $('#total_kategori').html(response.total);
                        toastr.success(response.message);
                    } else {
                        $("#formadd")[0].reset();
                        $('#btnadd').val('Add Product');
                        $('#btnadd').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#formadd2').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_store_poin') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnadd2').attr('disabled', 'disabled');
                    $('#btnadd2').val('Processing');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formadd2")[0].reset();
                        var oTable = $('#table-data').dataTable();
                        oTable.fnDraw(false);
                        $('#btnadd2').val('TAMBAH POIN PENILAIAN');
                        $('#btnadd2').attr('disabled', false);
                        $('#modaladd2').modal('hide');
                        toastr.success(response.message);
                    } else {
                        $("#formadd2")[0].reset();
                        $('#btnadd2').val('TAMBAH POIN PENILAIAN');
                        $('#btnadd2').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#formdel').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_delete_kategori') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btndell').attr('disabled', 'disabled');
                    $('#btndell').val('Processing');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formdel")[0].reset();
                        var oTable = $('#table-data').dataTable();
                        oTable.fnDraw(false);
                        $('#btndell').val('YA HAPUS! SAYA YAKIN!');
                        $('#btndell').attr('disabled', false);
                        $('#modaldel').modal('hide');
                        $('#total_kategori').html(response.total);
                        toastr.warning(response.message);
                    } else {
                        $("#formdel")[0].reset();
                        $('#btndell').val('YA HAPUS! SAYA YAKIN!');
                        $('#btndell').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#formedit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_store_kategori') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnedit').attr('disabled', 'disabled');
                    $('#btnedit').val('Processing');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formedit")[0].reset();
                        var oTable = $('#table-data').dataTable();
                        oTable.fnDraw(false);
                        $('#btnedit').val('UPDATE DATA');
                        $('#btnedit').attr('disabled', false);
                        $('#modaledit').modal('hide');
                        toastr.success(response.message);
                    } else {
                        $("#formedit")[0].reset();
                        $('#btnedit').val('UPDATE DATA');
                        $('#btnedit').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#modaldel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nama_kategori = button.data('nama_kategori')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nama_kategori').html(nama_kategori);
            console.log(nama_kategori);
        })

        $('#modaledit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var jenis_id = button.data('jenis_id')
            var nama_kategori = button.data('nama_kategori')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #jenis_id').val(jenis_id);
            modal.find('.modal-body #nama_kategori').val(nama_kategori);
            console.log(jenis_id);
        })

        $('#modaladd2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var kategori_id = button.data('kategori_id')
            var nama_kategori = button.data('nama_kategori')
            var modal = $(this)
            modal.find('.modal-body #kategori_id').val(kategori_id);
            modal.find('.modal-body #nama_kategori').html(nama_kategori);
            console.log(nama_kategori);
        })
    </script>
@endsection
