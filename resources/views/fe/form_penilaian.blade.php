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
                <!-- /top-wizard -->
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
                                            <label for="user_id"><small>YOUR NAME</small></label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="clearfix position-relative mb-3" id="inline-calendar">
                                            <input type="text" name="dates" id="dates" value="{{date('Y-m-d')}}" class="single required"
                                                hidden="hidden">
                                            
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
        

        $('#user_id').select2({
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
    </script>

</body>

</html>
