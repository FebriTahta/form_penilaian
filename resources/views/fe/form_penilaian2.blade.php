<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Tilawatipusat">
	<title>{{$jenis->nama_jenis}}</title>
    <meta property="og:title" content="Registrasi"/>
    
    <meta property="og:description" content="Registrasi {{$jenis->nama_jenis}}"/>
    @if ($jenis->img_jenis !== null)
		<meta property="og:image" itemprop="image" content="{{$jenis->img_jenis}}">
	@else
		<meta property="og:image" itemprop="image" content="{{ asset('images/tumbreg.jpeg') }}">
	@endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons-->
    <link rel="shortcut icon" href="{{$jenis->img_thumbnail_jenis}}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('newregis/img/apple-touch-icon-57x57-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('newregis/img/apple-touch-icon-72x72-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('newregis/img/apple-touch-icon-114x114-precomposed.png')}}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('newregis/img/apple-touch-icon-144x144-precomposed.png')}}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{asset('newregis/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('newregis/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('newregis/css/vendors.css')}}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{asset('newregis/css/custom.css')}}" rel="stylesheet">
    <!-- CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{asset('select2-develop/dist/css/select2.css')}}" rel="stylesheet" />
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

@media screen and (max-width: 700px){
  .box{
    width: 90%;
  }
  .popup{
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
                    <a href="index.html"><img src="{{asset('nf_logo.png')}}" alt="" class="img-fluid" style="max-width: 120px"></a>
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
            <img src="{{$jenis->img_jenis}}" style="max-width: 100%" alt="">            

            @if ($penilaian == 0)
                <form action="{{route('submit-form-penilaian')}}" id="wrapped" method="POST">@csrf
                    <input id="website" name="website" type="text" value="">
                    <!-- Leave input above for security protection, read docs for details -->
                    <div id="middle-wizard">
                        <div class="step">
                            <div class="question_title">
                                <p>{{ Carbon\Carbon::parse($tanggal)->isoFormat('D MMMM Y') }}</p>
                                {{-- @if ($karyawan->jenkel == 'L')
                                <p> Ustadz : </p>
                                @else
                                <p> Ustadzah : </p>
                                @endif --}}
                                <p>Mengisi {{$jenis->nama_jenis}} sebagai 
                                    @if ($karyawan->jenkel == 'L') Ustadz @else  Ustadzah @endif</p>
                                <h5 style="text-transform: capitalize"> 
                                    {{$karyawan->nama_karyawan}}
                                </h5>
                                <input type="hidden" name="karyawan_id" value="{{$karyawan->id}}">
                                <input type="hidden" name="jenis_id" value="{{$jenis->id}}">
                                <input type="hidden" name="tanggal" value="{{$tanggal}}">
                            </div>
                        </div>
                        <input type="hidden" id="jenkel" value="{{$karyawan->jenkel}}">
                        {{-- @if ($karyawan->jenkel == 'P')
                            <div class="step">
                                <div class="question_title">
                                    <h5 style="text-transform: capitalize">* Berhalangan *</h5>
                                    
                                    <p>- choose -</p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="list_block">
                                                <ul>
                                                    <li>
                                                        <div class="checkbox_radio_container">
                                                            <input type="radio" id="no1" name="berhalangan" class="required m" value="berhalangan">
                                                            <label class="radio" for="no1"></label>
                                                            <label for="no1" class="wrapper">Berhalangan</label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="checkbox_radio_container">
                                                            <input type="radio" id="no2" name="berhalangan" class="required m" value="-">
                                                            <label class="radio" for="no2"></label>
                                                            <label for="no2" class="wrapper">Tidak</label>
                                                        </div>
                                                    </li>
                                                    <input type="hidden" id="stat" name="keterangan" class="form-control">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                        @foreach ($kategori as $item)
                            <div class="step proses">
                                <div class="question_title">
                                    <h5 style="text-transform: capitalize">* {{$item->nama_kategori}} *</h5>
                                    
                                    <p>- choose -</p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7">
                                            <div class="list_block">
                                                <ul>
                                                    @foreach ($item->poin as $key=>$poins)
                                                    <li>
                                                        <div class="checkbox_radio_container">
                                                            <input type="radio" id="no{{$key}}{{$poins->id}}" name="poins[{{$item->id}}]" class="required" value="{{$poins->id}}">
                                                            <label class="radio" for="no{{$key}}{{$poins->id}}"></label>
                                                            
                                                            <label for="no{{$key}}{{$poins->id}}" class="wrapper">{{$poins->nama_poin}}</label>
                                                            
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- /review_block-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <!-- /Step -->

                        <div class="submit step">
                            <div class="question_title">
                                <h5 style="text-transform: capitalize">* {{$karyawan->nama_karyawan}} *</h5>
                                <p>- Tekan submit untuk mengirim laporan -</p>
                            </div>
                            
                        </div>
                        <!-- /Step -->
                        
                    </div>
                    <!-- /middle-wizard -->

                    <div id="bottom-wizard">
                        <button type="button" name="backward" class="backward btn_1">Kembali</button>
                        <button type="button" name="forward" id="next" class="forward btn_2">Lanjutkan</button>
                        {{-- <button type="submit" class="btn_1" id="btnberhalangan" style="background-color: danger">Submit</button> --}}
                        <button type="submit" class="submit btn_1">Submit</button>
                    </div>
                    <!-- /bottom-wizard -->
                    
                </form>
            @else
            <div class="submit step" style="margin-top: 50px">
                <div class="question_title">
                    <h5 style="text-transform: capitalize">Anda Sudah Mengisi Form Pada Tanggal Tersebut ({{ Carbon\Carbon::parse($tanggal)->isoFormat('D MMMM Y') }})</h5>
                    <p>- Tekan tombol berikut untuk kembali -</p>
                    <a href="/form/{{$jenis->slug_jenis}}" class="btn btn_1" style="margin-top: 20px">Kembali</a>
                </div>
            </div>
            @endif
        </div>
        <!-- /Wizard container -->
    </div>
    <!-- /Container -->

    <footer>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <p>© {{Carbon\Carbon::parse($jenis->created_at)->isoFormat('Y')}} | <a href="#0">{{$jenis->nama_jenis}}</a></p>
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
<script src="{{asset('newregis/js/common_scripts.min.js')}}"></script>
<script src="{{asset('newregis/js/common_functions.js')}}"></script>
<script src="{{asset('newregis/assets/validate.js')}}"></script>

<script src="{{asset('newregis/js/daterangepicker_func.js')}}"></script> 

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('select2-develop/dist/js/select2.js')}}"></script>


<script>
    var jenkel = document.getElementById("jenkel").value;

    if (jenkel == 'P') {

        // document.getElementById("no1").onchange = function(){
        //     console.log("status : ",document.getElementById("no1").value);
        //     var stat = $('#stat').val(document.getElementById("no1").value);
        //     document.getElementById("next").style.display = "none";
        //     document.getElementById("btnberhalangan").style = "";
        //     document.getElementsByClassName("proses").style.display = "none";
        // };

        // document.getElementById("no2").onchange = function(){
        //     console.log("status : ",document.getElementById("no2").value);
        //     var stat = $('#stat').val(document.getElementById("no2").value);
        //     document.getElementById("next").style.display = "";
        //     document.getElementById("btnberhalangan").style.display = "none";
        //     document.getElementsByClassName("proses").style.display = "";
        // };
    }
    

</script>
</body>
</html>