<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tilawatipusat">
    <title>{{ $jenis->nama_jenis }}</title>
    <meta property="og:title" content="Registrasi" />

    <meta property="og:description" content="Registrasi {{ $jenis->nama_jenis }}" />
    @if ($jenis->img_thumbnail_jenis !== null)
        <meta property="og:image" itemprop="image" content="{{ $jenis->img_thumbnail_jenis }}">
    @else
        <meta property="og:image" itemprop="image" content="{{ asset('images/tumbreg.jpeg') }}">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ $jenis->img_thumbnail_jenis }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
        href="{{ asset('newregis/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
        href="{{ asset('newregis/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
        href="{{ asset('newregis/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
        href="{{ asset('newregis/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('newregis/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('newregis/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('newregis/css/vendors.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('newregis/css/custom.css') }}" rel="stylesheet">


    <!-- CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('select2-develop/dist/css/select2.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{asset('src/css/miri-ui-kit-free.css')}}"> --}}
    <!-- Script -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <style>
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }

        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 720px;
            max-width: 90%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }

        .popup .close {
            position: absolute;
            top: 10px;
            right: 20px;
            transition: all 200ms;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        .popup .close:hover {
            color: #06D85F;
        }

        .popup .content {
            max-height: 70%;
            overflow: auto;
        }

        @media screen and (max-width: 700px) {
            .box {
                width: 90%;
            }

            .popup {
                width: 90%;
            }
        }

    </style>
</head>

<body class="bg_color_gray">

    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->
    <div id="loader_form">
        <div data-loader="circle-side-2"></div>
    </div><!-- /loader_form -->

    <div class="min-vh-100 d-flex flex-column">

        <header>
            <div class="container-fluid">
                <div class="row d-flex align-items-center">

                    <div class="col-12 text-center">
                        <a href="index.html"><img src="{{ asset('nf_logo.png') }}" alt="" class="img-fluid"
                                style="max-width: 120px"></a>
                    </div>

                </div>
            </div>
            <!-- /container -->
        </header>
        <!-- /header -->

        <div class="container-fluid d-flex flex-column my-auto">
            <div id="wizard_container">
                <div id="top-wizard">
                    <div id="progressbar"></div>
                </div>
                @if ($jenis->tipe !== 'kuisioner')
                    <form action="{{ route('form_penilaian') }}" id="wrapped" method="POST">@csrf
                        <input id="website" name="website" type="text" value="">
                        <!-- Leave input above for security protection, read docs for details -->
                        <img src="{{ $jenis->img_jenis }}" style="max-width: 100%" alt="">
                        <input type="hidden" name="slug_jenis" value="{{ $jenis->slug_jenis }}">
                        <div id="middle-wizard">

                            <div class="submit step">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-10">
                                            
                                            
                                            <div class="mb-4 form-floating">
                                                <select name="user_id" data-width="100%" id="user_id"
                                                    class="form-control required" style="font-size: 12px">
                                                    <option value=""></option>
                                                </select>
                                                <label for="user_id"><small>Nama Karyawan * (Wajib Diisi)</small></label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3" id="inline-calendar">
                                                @if ($jenis->slug_jenis !== 'penilaian-kinerja-sdm-nurul-falah')
                                                    <input type="text" name="dates" id="dates" value="{{date('Y-m-d')}}" class="single required"
                                                    hidden="hidden">
                                                @else
                                                    <input type="hidden" name="dates" value="{{date('Y-m-d')}}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /Step -->
                        </div>
                        <!-- /middle-wizard -->

                        <div id="bottom-wizard">
                            <button type="submit" class="btn btn_2">Lanjutkan</button>
                        </div>
                        <!-- /bottom-wizard -->
                    </form>
                @else
                    <form action="{{ route('form_survey') }}" id="wrapped" method="POST">@csrf
                        <input id="website" name="website" type="text" value="">
                        <!-- Leave input above for security protection, read docs for details -->
                        <img src="{{ $jenis->img_jenis }}" style="max-width: 100%" alt="">
                        <input type="hidden" name="slug_jenis" value="{{ $jenis->slug_jenis }}">
                        <div id="middle-wizard">
                            <div class="step proses">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="mb-4 form-floating">
                                            <select name="cabang_id" data-width="100%" id="cabang_id"
                                                class="form-control required" style="font-size: 12px">
                                                <option value=""></option>
                                            </select>
                                            <label for="cabang_id"><small>Asal Cabang (* Wajib Diisi)</small></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step proses">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="nama_lembaga" style="margin-bottom: 10px;"><small>Nama Lembaga (* Wajib Diisi)</small></label>
                                                <input type="text" name="nama_lembaga" class="form-control required" required>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3">
                                                <label for="dusun" style="margin-bottom: 10px;"><small>Dusun </small></label>
                                                <input type="text" name="dusun" class="form-control " >
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3">
                                                <label for="desa" style="margin-bottom: 10px;"><small>Desa </small></label>
                                                <input type="text" name="desa" class="form-control " >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <!-- /Step -->
                            <div class="step proses">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="kecamatan_id" style="margin-bottom: 10px;"><small>Kecamatan (* Wajib Diisi)</small></label>
                                                <select name="kecamatan_id" data-width="100%" id="kecamatan_id"
                                                    class="form-control required" style="font-size: 12px" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <p id="detail_daerah"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <div class="step proses">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="nama_santri" style="margin-bottom: 10px">Nama Santri (* Wajib Diisi)</label>
                                                <input type="text" class="form-control required" id="nama_santri" name="nama_santri" required>
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="tempat_lahir_santri" style="margin-bottom: 10px">Tempat Lahir Santri (* Wajib Diisi)</label>
                                                <select name="tempat_lahir_santri" data-width="100%" id="tempat_lahir_santri"
                                                    class="form-control required" style="font-size: 12px" required>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="tanggallahir_santri" style="margin-bottom: 10px">Tanggal Lahir Santri (* Wajib Diisi)</label>
                                                <input type="date" class="form-control required" name="tanggallahir_santri" id="tanggallahir_santri" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /row -->
                            </div>
                            <div class="step proses">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="nama_ayah">Nama Ayah</label>
                                                <input type="text" name="nama_ayah" id="nama_ayah" class="form-control " >
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="hp_ayah">No Telp Ayah</label>
                                                <input type="number" name="hp_ayah" id="hp_ayah" class="form-control " >
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="nama_ibu">Nama Ibu</label>
                                                <input type="text" name="nama_ibu" id="nama_ibu" class="form-control " >
                                            </div>
                                            <div class="clearfix position-relative mb-3" >
                                                <label for="hp_ibu">No Telp Ibu</label>
                                                <input type="text" name="hp_ibu" id="hp_ibu" class="form-control " >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit step">
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <h5>Pastikan Semua Data Anda Benar Sebelum Menekan Tombol Submit</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /middle-wizard -->
                        @if ($jenis->tipe == 'kuisioner')
                        <div id="bottom-wizard">
                            <button type="button" name="backward" class="backward btn_1">Kembali</button>
                            <button type="button" name="forward" id="next" class="forward btn_2">Lanjutkan</button>
                            <button type="submit" class="submit btn_1">Submit</button>
                        </div>
                        @else
                        <div id="bottom-wizard">
                            <button type="submit" class="btn btn_2">Lanjutkan</button>
                        </div>
                        @endif
                        
                        <!-- /bottom-wizard -->
                    </form>
                @endif
            </div>
            <!-- /Wizard container -->
        </div>
        <!-- /Container -->

        <footer>
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <p>© {{ Carbon\Carbon::parse($jenis->created_at)->isoFormat('Y') }} | <a
                                href="#0">{{ $jenis->nama_jenis }}</a></p>
                    </div>
                </div>
                <!-- /Row -->
            </div>
            <!-- /Container -->
        </footer>
        <!-- /Footer -->
    </div>
    <!-- /flex-column -->



    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('newregis/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('newregis/js/common_functions.js') }}"></script>
    <script src="{{ asset('newregis/assets/validate.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('select2-develop/dist/js/select2.js') }}"></script>

    <script src="{{ asset('newregis/js/daterangepicker_func.js') }}"></script>
    <script src="{{ asset('date2/dist/mc-calendar.min.js') }}"></script>
    <script>
        

        $('#cabang_id').select2({
            ajax: {
                url: "{{ route('find_cabang') }}",
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

        $('#kecamatan_id').select2({
            ajax: {
                url: "{{ route('find_kecamatan') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id,
                            }
                        })
                    };
                    
                    
                },
                cache: true
            }
        });

        $('#kecamatan_id').on('change', function(){
            var kecamatan_id = this.value;
            $.ajax ({
                url: "/find-daerah/"+kecamatan_id,
                dataType: 'json',
                delay: 250,
                success:function(data) {
                    $('#detail_daerah').html(data);
                },
                cache: true
            });
        });

        $('#tempat_lahir_santri').select2({
            ajax: {
                url: "{{ route('find_kabupaten') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.nama,
                                id: item.id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

    </script>

</body>

</html>
