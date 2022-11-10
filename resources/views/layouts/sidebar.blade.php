<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/basic/favicon.ico')}}" type="image/x-icon">
    <title>Forms Panel</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link href="{{ asset('select2-develop/dist/css/select2.css') }}" rel="stylesheet" />

    @yield('style')
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }

    </style>
    
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
        (function(w, d, u) {
            w.readyQ = [];
            w.bindReadyQ = [];

            function p(x, y) {
                if (x == "ready") {
                    w.bindReadyQ.push(y);
                } else {
                    w.readyQ.push(x);
                }
            };
            var a = {
                ready: p,
                bind: p
            };
            w.$ = w.jQuery = function(f) {
                if (f === d || f === u) {
                    return a
                } else {
                    p(f)
                }
            }
        })(window, document)
    </script>
    
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
            <section class="sidebar">
                <div class="w-80px mt-3 mb-3 ml-3">
                    <img src="{{asset('nf_logo.png')}}" alt="">
                </div>
                <div class="relative">
                    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                        aria-controls="userSettingsCollapse"
                        class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                        <i class="icon icon-cogs"></i>
                    </a>
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="{{asset('assets/img/dummy/u2.png')}}" alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1">{{auth()->user()->name}}</h6>
                                <a href="#"><i class="icon-circle text-primary blink"></i> {{auth()->user()->role}}</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="collapse multi-collapse" id="userSettingsCollapse">
                            <div class="list-group mt-3 shadow">
                                <a href="#" class="list-group-item list-group-item-action"><i
                                        class="mr-2 icon-security text-purple"></i>Change Password</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header"><strong>PENILAIAN PEGAWAI</strong></li>
                    <li class="treeview"><a href="/">
                            <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
                        </a>

                    </li>

                    <li class="header light mt-3"><strong>DATA MASTER</strong></li>
                    <li class="treeview"><a href="#">
                            <i class="icon icon-dialpad blue-text  s-18"></i>
                            <span>Group & Karyawan</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{route('be_index_group')}}">
                                    <i class="icon icon-group light-blue-text s-14"></i>
                                    <span>Group</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('be_index_karyawan')}}">
                                    <i class="icon icon-user light-blue-text s-14"></i> <span>&nbsp; Karyawan</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview ">
                        <a href="#">
                            <i class="icon icon-wpforms light-green-text s-18 "></i> <span>&nbsp;Forms & Poin Penilaian</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            
                            <li><a href="{{route('be_index_jenis')}}"><i
                                class="icon icon-burst_mode light-green-text"></i>Jenis Penilaian</a>
                            </li>

                            <li><a href="{{route('be_index_kategori')}}"><i
                                        class="icon icon-burst_mode light-green-text"></i>Kategori Penilaian</a>
                            </li>
                            
                            <li><a href="#"><i
                                        class="icon  icon-one-finger-click light-green-text"></i>Poin Penilaian</a>
                            </li>
                           
                        </ul>
                    </li>

                    <li class="treeview ">
                        <a href="#">
                            <i class="icon icon-bubble_chart pink-text s-18 "></i> <span>&nbsp;Geografis Indonesia</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            
                            <li><a href="{{route('be.provinsi.page')}}"><i
                                class="icon icon-bubble_chart pink-text"></i>Provinsi</a>
                            </li>

                            <li><a href="{{route('be.kabupaten.page')}}"><i
                                        class="icon icon-bubble_chart pink-text"></i>Kabupaten / Kota</a>
                            </li>
                            
                            <li><a href="{{route('be.kecamatan.page')}}"><i
                                        class="icon  icon-bubble_chart pink-text"></i>Kecamatan</a>
                            </li>
                            <li><a href="{{route('be.kelurahan.page')}}"><i
                                        class="icon  icon-bubble_chart pink-text"></i>Kelurahan / Desa</a>
                            </li>
                        </ul>
                    </li>

                    <li class="treeview"><a href="#">
                            <i class="icon icon-bar-chart2 pink-text s-18"></i>
                            <span>Laporan</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{route('be_laporan_detail')}}"><i
                                        class="icon icon-area-chart pink-text s-14"></i><span>Laporan Pegawai</span></a>
                            </li>
                            {{-- <li>
                                <a href=""><i
                                        class="icon icon-bubble_chart pink-text s-14"></i>Per Bulan / Waktu Tertentu</a>
                            </li> --}}
                        </ul>
                    </li>

                </ul>
            </section>
        </aside>
        <!--Sidebar End-->
