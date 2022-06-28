@extends('layouts.master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Forms Group Karyawan
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
                        <div class="col-md-3" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Group Karyawan </div>
                                    <h5 class="sc-counter mt-3" id="total"> {{ $group }} </h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <form id="formaddgroup">@csrf
                                <div class="counter-box white r-5 p-3">
                                    <div class="row">
                                        <div class="col-md-6" style="margin-bottom: 10px">
                                            <label for="select_karyawan">PILIH NAMA KARYAWAN</label>
                                            <select name="select_karyawan" id="select_karyawan"
                                                class="form-control"></select>
                                        </div>

                                        <div class="col-md-6" style="margin-bottom: 10px">
                                            <label for="select_group">PILIH GROUP</label>
                                            <select name="select_group" id="select_group" class="form-control"></select>
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 10px">
                                        </div>
                                        <div class="col-md-6" style="margin-bottom: 10px; ">
                                            <input type="submit" id="btnaddgroup" style="float:right"
                                                class="btn btn-success" value="Tambahkan Karyawan Ke Group">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary btn-sm" style="margin-bottom: 20px" data-toggle="modal"
                        data-target="#modaladd">Tambahkan Karyawan Baru</button>
                    {{-- <button class="btn btn-success btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modalimport">Import Data Karyawan</button> --}}
                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table table-responsive">
                                        <div class="card-title">Data Group</div>
                                        <table id="table-data" class="table table-bordered table-hover data-tables">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Group</th>
                                                    <th>Anggota</th>
                                                    <th>Jenis Penilaian</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Group</th>
                                                    <th>Anggota</th>
                                                    <th>Jenis Penilaian</th>
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
                    <h6 class="modal-title text-white" id="exampleModalLabel">GROUP BARU</h6>
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
                                @foreach ($jenis as $item)
                                    <option value="{{ $item->id }}">- {{ $item->nama_jenis }} -</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label form="nama_group">Nama Group </label>
                            <input type="text" class="form-control" id="nama_group" name="nama_group" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="TAMBAH GROUP BARU"
                            id="btnadd" required>
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
                <form action="{{ route('be_import_karyawan') }}" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div id="errList" class="text-uppercase">
                                {{-- ERROR MESSAGE VALIDATION --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label form="jenis_id" style="font-size: 14px" class="text-capitalize">Import Data Karyawan
                            </label><br>
                            <input type="file" class="" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success l-s-1 s-12 text-uppercase"
                            value="IMPORT DATA KARYAWAN" id="btnadd" required>
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
                            <input type="hidden" id="id" name="id">
                            <h5>Kategori : <i id="nama_kategori" class="text-capitalize"></i></h5>
                        </div>
                        <div class="form-group">
                            <code>Yakin menghapus kategori penilaian tersebut dari database ?</code>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger l-s-1 s-12 text-uppercase"
                            value="YA HAPUS! SAYA YAKIN!" id="btndell" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladdgroup" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-success">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Tambahkan Karyawan Ini Ke Group ?</h6>
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
                            <input type="hidden" id="id" name="id">
                            <h5>Kategori : <i id="nama_kategori" class="text-capitalize"></i></h5>
                        </div>
                        <div class="form-group">
                            <code>Yakin menghapus kategori penilaian tersebut dari database ?</code>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger l-s-1 s-12 text-uppercase"
                            value="YA HAPUS! SAYA YAKIN!" id="btndell" required>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalanggota" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content b-0">
                <div class="modal-header r-0 bg-success">
                    <h6 class="modal-title text-white" id="exampleModalLabel">Daftar Anggota</h6>
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
                            <table id="table-anggota" class="table table-bordered table-hover data-tables">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger l-s-1 s-12 text-uppercase"
                            value="YA HAPUS! SAYA YAKIN!" id="btndell" required>
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
                        <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="UPDATE DATA"
                            id="btnedit" required>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            table();
        })

        function table() {
            $('#table-data').DataTable({
                //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('be_index_group') }}',
                },
                columns: [{
                        "width": 10,
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_group',
                        name: 'nama_group'
                    },
                    {
                        data: 'anggota',
                        name: 'anggota'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
                    },
                    {
                        data: 'option',
                        name: 'option'
                    },

                ]
            });
        }


        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('be_store_group') }}",
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
                        $('#btnadd').val('BUAT GROUP BARU');
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

        $('#modalanggota').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            // modal.find('.modal-body #id').val(id);
            
            $.ajax({
                type: 'get',
                url: "/group-list-anggota-group/"+id,
                cache: false,
                contentType: false,
                processData: false,
               
                success: function(response) {
                    if (response.status == 200) {
                        
                        console.log(response);
                        toastr.success(response.message);

                    } else {

                        toastr.error(response.message);
                        
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });

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
            var id = button.data('id')
            var nama_group = button.data('nama_group')
            var modal = $(this)

            modal.find('.modal-header #namagrup').html('TAMBAHKAN KARYAWAN KE GROUP ' + nama_group);
            // $('#table-karyawan').DataTable({
            //     //karena memakai yajra dan template maka di destroy dulu biar ga dobel initialization
            //     destroy: true,
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: '{{ route('be_data_karyawan2') }}',
            //         data: {
            //             id: id,
            //         }
            //     },
            //     columns: [{
            //             "width": 10,
            //             "data": null,
            //             "sortable": false,
            //             render: function(data, type, row, meta) {
            //                 return meta.row + meta.settings._iDisplayStart + 1;
            //             }
            //         },
            //         {
            //             data: 'nama_karyawan',
            //             name: 'nama_karyawan'
            //         },
            //         {
            //             data: 'jabatan',
            //             name: 'jabatan'
            //         },
            //         {
            //             data: 'option',
            //             name: 'option'
            //         },

            //     ]
            // });
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
            }
        });

        $('#formaddgroup').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $('#btnaddgroup').val('Proses Menambah Anggota');
            $.ajax({
                type: 'POST',
                url: "{{ route('be_store_karyawan_group') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddgroup').attr('disabled', 'disabled');
                    $('#btnaddgroup').val('Proses Menambah Anggota');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formaddgroup")[0].reset();
                        var oTable = $('#table-data').dataTable();
                        oTable.fnDraw(false);
                        $('#btnaddgroup').val('Tambah Ke Group');
                        $('#btnaddgroup').attr('disabled', false);
                        table();
                        toastr.success(response.message);
                    } else {
                        $("#formaddgroup")[0].reset();
                        $('#btnaddgroup').val('Tambah Ke Group');
                        $('#btnaddgroup').attr('disabled', false);
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
    </script>

    <script>
        $('#select_karyawan').select2({
            ajax: {
                url: "{{ route('find_karyawan') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#select_group').select2({
            ajax: {
                url: "{{ route('find_group') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama_group,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>
@endsection
