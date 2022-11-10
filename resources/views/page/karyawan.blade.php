@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@endsection

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
                                    <h5 class="sc-counter mt-3" id="total">{{$karyawan}}</h5>
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
                    <button class="btn btn-primary btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modaladd">Tambah Karyawan Baru</button>
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
                            <label form="nama_karyawan">Nama Karyawan </label>
                            <input type="text" name="nama_karyawan" class="form-control" id="nama_karyawan">
                        </div>
                        <div class="form-group">
                            <label form="telp_karyawan">Telp Karyawan </label>
                            <input type="text" name="telp_karyawan" class="form-control" id="telp_karyawan">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label form="tempatlahir_karyawan">Tempat Lahir</label>
                                    <input type="text" name="tempatlahir_karyawan" class="form-control" id="tempatlahir_karyawan">
                                </div>
                                <div class="col-md-6 col-6">
                                    <label form="tanggallahir_karyawan">Tanggal Lahir </label>
                                    <input type="date" placeholder="tahun-bulan-tanggal" class="form-control" id="tanggallahir_karyawan" name="tanggallahir_karyawan">  
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="alamat_karyawan">Alamat </label>
                            <textarea name="alamat_karyawan" id="alamat_karyawan" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label form="jenkel">Jenis Kelamin </label>
                                    <select name="jenkel" class="form-control" id="jenkel" required>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-6">
                                    <label form="jabatan">Jabatan </label>
                                    <select name="jabatan_id" class="form-control" id="jabatan" required>
                                       @foreach ($jabatan as $item)
                                           <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
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
                            <input type="text" id="id" name="id" >
                            <h5>Nama Karyawan : <i id="nama_karyawan" class="text-capitalize"></i></h5>
                        </div>
                        <div class="form-group">
                            <code>Yakin menghapus Karyawan tersebut dari database ?</code>
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
                            <input type="hidden" name="id" class="form-control" id="id">
                            <label form="nama_karyawan">Nama Karyawan </label>
                            <input type="text" name="nama_karyawan" class="form-control" id="nama_karyawan">
                        </div>
                        <div class="form-group">
                            <label form="telp_karyawan">Telp Karyawan </label>
                            <input type="text" name="telp_karyawan" class="form-control" id="telp_karyawan">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label form="tempatlahir_karyawan">Tempat Lahir</label>
                                    <input type="text" name="tempatlahir_karyawan" class="form-control" id="tempatlahir_karyawan">
                                </div>
                                <div class="col-md-6 col-6">
                                    <label form="tanggallahir_karyawan">Tanggal Lahir </label>
                                    <input type="text" class="form-control" id="tanggallahir_karyawan" name="tanggallahir_karyawan">  
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="alamat_karyawan">Alamat </label>
                            <textarea name="alamat_karyawan" id="alamat_karyawan" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <label form="jenkel">Jenis Kelamin </label>
                                    <select name="jenkel" class="form-control" id="jenkel" required>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-6">
                                    <label form="jabatan_id">Jabatan </label>
                                    <select name="jabatan_id" class="form-control" id="jabatan_id" required>
                                       @foreach ($jabatan as $item)
                                           <option value="{{$item->id}}">{{$item->nama_jabatan}}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
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
                url: "{{ route('be_store_karyawan') }}",
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
                        $('#btnadd').val('ADD KARYAWAN');
                        $('#btnadd').attr('disabled', false);
                        $('#modaladd').modal('hide');
                        $('#total').html(response.total);
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

        $('#formdel').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_delete_karyawan') }}",
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
                        $('#total').html(response.total);
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
                url: "{{ route('be_update_karyawan') }}",
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
            var nama_karyawan = button.data('nama_karyawan')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nama_karyawan').html(nama_karyawan);
            console.log(nama_karyawan);
        })

        $('#modaledit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var jabatan_id = button.data('jabatan_id')
            var nama_karyawan = button.data('nama_karyawan')
            var telp_karyawan = button.data('telp_karyawan')
            var tempatlahir_karyawan = button.data('tempatlahir_karyawan')
            var tanggallahir_karyawan = button.data('tanggallahir_karyawan')
            var alamat_karyawan = button.data('alamat_karyawan')
            var jenkel = button.data('jenkel')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #jabatan_id').val(jabatan_id);
            modal.find('.modal-body #nama_karyawan').val(nama_karyawan);
            modal.find('.modal-body #telp_karyawan').val(telp_karyawan);
            modal.find('.modal-body #tempatlahir_karyawan').val(tempatlahir_karyawan);
            modal.find('.modal-body #tanggallahir_karyawan').val(tanggallahir_karyawan);
            modal.find('.modal-body #alamat_karyawan').val(alamat_karyawan);
            modal.find('.modal-body #jenkel').val(jenkel);
            console.log(nama_karyawan);
        })

        
    </script>
@endsection
