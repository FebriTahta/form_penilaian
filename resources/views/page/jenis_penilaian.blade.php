@extends('layouts.master')

@section('content')

<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-box"></i>
                        Forms Jenis Penilaian
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
                                <div class="counter-title">Jenis Penilaian </div>
                                <h5 class="sc-counter mt-3">{{$total_jenis}}</h5>
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
                    <button class="btn btn-primary btn-sm" style="margin-bottom: 20px" data-toggle="modal" data-target="#modaladd">Tambahkan Jenis Penilaian Baru</button>
                    <div class="row">
                        @foreach ($jenis as $item)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header  white">
                                    <strong class="text-capitalize"> {{$item->nama_jenis}} </strong>
                                    <p><strong>Thumbnail : 
                                    @if ($item->img_thumbnail_jenis !== null)
                                        <span class="text-success">Ok</span>
                                    @else
                                        <span class="text-danger">Kosong</span>
                                    @endif    
                                    </strong></p>
                                </div>
                                <div class="card-body p-0">
                                    <!-- Big Heading -->
                                    <div class="text-center bg-light b-b p-3">
                                        <img src="{{$item->img_jenis}}" style="max-width: 100%" alt="">                                        
                                    </div>
                                    <ul class="list-group list-group-flush no-b">
                                        <li class="list-group-item">
                                            <i class="icon-settings text-blue"></i> {{$item->kategori->count()}} Kategori Penilaian
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer white">
                                    <a href="/form/{{$item->slug_jenis}}" target="_blank" class="btn btn-xs text-white btn-outline" style="background-color: pink">Link Form</a>
                                    <a href="/kategori-form-penilaian/{{$item->slug_jenis}}" class="btn btn-outline-success btn-xs">Selengkapnya</a>
                                    <a href="#" class="btn btn-outline-primary btn-xs" data-toggle="modal" data-id="{{$item->id}}" data-nama_jenis="{{$item->nama_jenis}}" 
                                        data-img_jenis="{{$item->img_jenis}}" data-img_thumbnail_jenis="{{$item->img_thumbnail_jenis}}"
                                        data-target="#modaledit">Update</a>
                                    <a href="#" class="btn btn-outline-danger btn-xs">Hapus</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content b-0">
            <div class="modal-header r-0 bg-primary">
                <h6 class="modal-title text-white" id="exampleModalLabel">DATA BARU</h6>
                <a href="#" data-dismiss="modal" aria-label="Close"
                   class="paper-nav-toggle paper-nav-white active"><i></i></a>
            </div>
            <form id="formadd" method="POST" enctype="multipart/form-data" action="{{route('be_store_jenis')}}">@csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label form="nama_jenis">Jenis Penilaian Karyawan </label>
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" required>  
                    </div>
                    <div class="form-group">
                        <code form="nama_jenis">Image Flyer Forms </code><br>
                        <input type="file" class="" id="img_jenis" name="img_jenis" required>  
                    </div>
                    <div class="form-group">
                        <img  src=""  id="preview" class="img-thumbnail">
                    </div>
                    <div class="form-group">
                        <code form="nama_jenis">Image Thumbnail </code><br>
                        <input type="file" class="" id="img_thumbnail_jenis" name="img_thumbnail_jenis" required>  
                    </div>
                    <div class="form-group">
                        <img  src=""  id="preview2" class="img-thumbnail">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary l-s-1 s-12 text-uppercase" value="TAMBAH DATA BARU" id="btnadd" required>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modalCreateMessage">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content b-0">
            <div class="modal-header r-0 bg-primary">
                <h6 class="modal-title text-white" id="exampleModalLabel">UPDATE DATA</h6>
                <a href="#" data-dismiss="modal" aria-label="Close"
                   class="paper-nav-toggle paper-nav-white active"><i></i></a>
            </div>
            <form id="formedit" method="POST" enctype="multipart/form-data" action="{{route('be_update_jenis')}}">@csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label form="nama_jenis">Jenis Penilaian Karyawan </label>
                        <input type="hidden" id="id" name="id">
                        <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" required>  
                    </div>
                    <div class="form-group">
                        <code form="nama_jenis">Image Flyer Forms </code><br>
                        <input type="file" class="" id="img_jenis2" name="img_jenis" >  
                    </div>
                    <div class="form-group">
                        <img  src=""  id="preview_e" class="img-thumbnail">
                    </div>
                    <div class="form-group">
                        <code form="nama_jenis">Image Thumbnail </code><br>
                        <input type="file" class="" id="img_thumbnail_jenis2" name="img_thumbnail_jenis" >  
                    </div>
                    <div class="form-group">
                        <img  src=""  id="preview2_e" class="img-thumbnail">
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
        $('#img_jenis').change(function(e) {
            var fileName = e.target.files[0].name;
            // $("#img_thumbnail_jenis").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $('#img_thumbnail_jenis').change(function(e) {
            var fileName = e.target.files[0].name;
            // $("#img_thumbnail_jenis").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview2").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });

        $('#img_jenis2').change(function(e) {
            var fileName = e.target.files[0].name;
            // $("#img_thumbnail_jenis").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview_e").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });
        $('#img_thumbnail_jenis2').change(function(e) {
            var fileName = e.target.files[0].name;
            // $("#img_thumbnail_jenis").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {   
            // get loaded data and render thumbnail.
            document.getElementById("preview2_e").src = e.target.result;
            };
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        });



        
        $('#modaledit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nama_jenis = button.data('nama_jenis')
            var img_jenis = button.data('img_jenis')
            var img_thumbnail_jenis = button.data('img_thumbnail_jenis')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #nama_jenis').val(nama_jenis);
            modal.find('.modal-body #preview_e').attr("src", img_jenis);
            modal.find('.modal-body #preview2_e').attr("src", img_thumbnail_jenis);
            console.log(img_thumbnail_jenis);
        })
    </script>
@endsection