@extends('layouts.master')

@section('content')

<div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-box"></i>
                        Dashboard
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
                                <div class="counter-title">Karyawan</div>
                                <h5 class="sc-counter mt-3">{{$karyawan}}</h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-mail-envelope-open s-48"></span>
                                </div>
                                <div class="counter-title ">Jenis Form Penilaian</div>
                                <h5 class="sc-counter mt-3">{{$jenis}}</h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 50%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-stop-watch3 s-48"></span>
                                </div>
                                <div class="counter-title">Kategori Penilaian</div>
                                <h5 class="sc-counter mt-3">{{$kategori}}</h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 75%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="counter-box white r-5 p-3">
                            <div class="p-4">
                                <div class="float-right">
                                    <span class="icon icon-inbox-document-text s-48"></span>
                                </div>
                                <div class="counter-title">Poin Penilaian</div>
                                <h5 class="sc-counter mt-3">{{$poin}}</h5>
                            </div>
                            <div class="progress progress-xs r-0">
                                <div class="progress-bar" role="progressbar" style="width: 25%;"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="white p-5 r-5">
                            <div class="card-title">
                                <h5> Sales Overview</h5>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-3">
                                    <div class="my-3 mt-4">
                                        <h5>Sales <span class="red-text">+203.48</span></h5>
                                        <span class="s-24">$2652.07</span>
                                        <p>A short summary of sales report if you want to add here. This could
                                            be useful
                                            for quick view.</p>
                                    </div>
                                    <div class="row no-gutters bg-light r-3 p-2 mt-5">
                                        <div class="col-md-6 b-r p-3">
                                            <h5>Net Sales</h5>
                                            <span>$2351.08 </span>
                                        </div>
                                        <div class="col-md-6 p-3">
                                            <div class="">
                                                <h5>Costs <span class="amber-text">+87.4</span></h5>
                                                <span>$900.09</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9" style="height: 350px">
                                    <canvas data-chart="line" data-dataset="[
                                                    [0, 15, 4, 30, 8, 5, 18],
                                                    [1, 7, 21, 4, 12, 5, 10],
                                        
                                                    ]" data-labels="['A', 'B', 'C', 'D', 'E', 'F']"
                                        data-dataset-options="[
                                                    {   label:'HTML',
                                                        fill: true,
                                                        backgroundColor: 'rgba(50,141,255,.2)',
                                                        borderColor: '#328dff',
                                                        pointBorderColor: '#328dff',
                                                        pointBackgroundColor: '#fff',
                                                        pointBorderWidth: 2,
                                                        borderWidth: 1,
                                                        borderJoinStyle: 'miter',
                                                        pointHoverBackgroundColor: '#328dff',
                                                        pointHoverBorderColor: '#328dff',
                                                        pointHoverBorderWidth: 1,
                                                        pointRadius: 3,
                                                        
                                                    },
                                                    {
                                                        label:'Wordpress',
                                                        fill: false,
                                                        borderDash: [5, 5],
                                                        backgroundColor: 'rgba(87,115,238,.3)',
                                                        borderColor: '#2979ff',
                                                        pointBorderColor: '#2979ff',
                                                        pointBackgroundColor: '#2979ff',
                                                        pointBorderWidth: 2,
                                        
                                                        borderWidth: 1,
                                                        borderJoinStyle: 'miter',
                                                        pointHoverBackgroundColor: '#2979ff',
                                                        pointHoverBorderColor: '#fff',
                                                        pointHoverBorderWidth: 1,
                                                        pointRadius: 3,
                                                        
                                                    }
                                                    ]" data-options="{
                                                            maintainAspectRatio: false,
                                                            legend: {
                                                                display: true
                                                            },
                                                
                                                            scales: {
                                                                xAxes: [{
                                                                    display: true,
                                                                    gridLines: {
                                                                        zeroLineColor: '#eee',
                                                                        color: '#eee',
                                                                    
                                                                        borderDash: [5, 5],
                                                                    }
                                                                }],
                                                                yAxes: [{
                                                                    display: true,
                                                                    gridLines: {
                                                                        zeroLineColor: '#eee',
                                                                        color: '#eee',
                                                                        borderDash: [5, 5],
                                                                    }
                                                                }]
                                                
                                                            },
                                                            elements: {
                                                                line: {
                                                                
                                                                    tension: 0.4,
                                                                    borderWidth: 1
                                                                },
                                                                point: {
                                                                    radius: 2,
                                                                    hitRadius: 10,
                                                                    hoverRadius: 6,
                                                                    borderWidth: 4
                                                                }
                                                            }
                                                        }">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                
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
@endsection