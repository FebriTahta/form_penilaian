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
                                <div class="counter-title">Jenis Laporan </div>
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
                                            <code> <i class="icon-folder text-blue"></i> Diisi sebanyak {{$item->mengisi->count()}}x</code>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer white">
                                    <a href="/form/{{$item->slug_jenis}}" target="_blank" class="btn btn-xs text-white btn-outline" style="background-color: pink">Link Form</a>
                                    <a href="/karyawan-form-laporan/{{$item->slug_jenis}}" class="btn btn-outline-primary btn-xs">Laporan</a>
                                    @php
                                        $group = App\Models\Group::where('jenis_id', $item->id)->count();
                                    @endphp
                                    @if ($group > 0)
                                    <a href="#" class="btn btn-outline-success btn-xs">Laporan Group</a>
                                    @endif
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
    </script>
@endsection