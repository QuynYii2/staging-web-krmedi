@extends('layouts.admin')
@section('title')
    {{ __('home.Dashboard') }}
@endsection
@section('main-content')
    <div class="pagetitle">
        <h1>{{ __('home.Dashboard') }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">{{ __('home.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ __('home.Dashboard') }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">

                    @if($isAdmin)
                        <!-- Products Card -->
                        <div class="col-xxl-3 col-xl-12">
                            <div class="card info-card product-medicine-card">

                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>{{ __('home.Filter') }}</h6>
                                        </li>

                                        <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                        <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                    </ul>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">{{ __('home.Product Medicine') }} <span>| {{ __('home.Today') }}</span></h5>

                                    <a href="{{ route('view.admin.home.medicine.list') }}" class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-journal-medical"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $number }} </h6>
                                            <span class="text-muted small pt-2 ps-1">Products need to be approved</span>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- End Products Card -->
                    @endif

                    <!-- Sales Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ __('home.Sales') }} <span>| {{ __('home.Today') }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>145</h6>
                                        <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">{{ __('home.increase') }}</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ __('home.Revenue') }} <span>| {{ __('home.This Month') }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>$3,264</h6>
                                        <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">{{ __('home.increase') }}</span>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-3 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ __('home.Customers') }} <span>| {{ __('home.This Year') }}</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1244</h6>
                                        <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">{{ __('home.decrease') }}</span>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- End Customers Card -->

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ __('home.Reports') }} <span>/{{ __('home.Today') }}</span></h5>

                                <!-- Line Chart -->
                                <div id="reportsChart"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                        new ApexCharts(document.querySelector("#reportsChart"), {
                                            series: [{
                                                name: 'Sales',
                                                data: [31, 40, 28, 51, 42, 82, 56],
                                            }, {
                                                name: 'Revenue',
                                                data: [11, 32, 45, 32, 34, 52, 41]
                                            }, {
                                                name: 'Customers',
                                                data: [15, 11, 32, 18, 9, 24, 11]
                                            }],
                                            chart: {
                                                height: 350,
                                                type: 'area',
                                                toolbar: {
                                                    show: false
                                                },
                                            },
                                            markers: {
                                                size: 4
                                            },
                                            colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                            fill: {
                                                type: "gradient",
                                                gradient: {
                                                    shadeIntensity: 1,
                                                    opacityFrom: 0.3,
                                                    opacityTo: 0.4,
                                                    stops: [0, 90, 100]
                                                }
                                            },
                                            dataLabels: {
                                                enabled: false
                                            },
                                            stroke: {
                                                curve: 'smooth',
                                                width: 2
                                            },
                                            xaxis: {
                                                type: 'datetime',
                                                categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
                                            },
                                            tooltip: {
                                                x: {
                                                    format: 'dd/MM/yy HH:mm'
                                                },
                                            }
                                        }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                            </div>

                        </div>
                    </div>
                    <!-- End Reports -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ __('home.Recent Sales ') }}<span>| {{ __('home.Today') }}</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('home.Customers') }}</th>
                                        <th scope="col">{{ __('home.Product') }}</th>
                                        <th scope="col">{{ __('home.Price') }}</th>
                                        <th scope="col">{{ __('home.Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><a href="#">#2457</a></th>
                                        <td>Brandon Jacob</td>
                                        <td><a href="#" class="text-primary">At praesentium minu</a></td>
                                        <td>$64</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2147</a></th>
                                        <td>Bridie Kessler</td>
                                        <td><a href="#" class="text-primary">Blanditiis dolor omnis similique</a></td>
                                        <td>$47</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2049</a></th>
                                        <td>Ashleigh Langosh</td>
                                        <td><a href="#" class="text-primary">At recusandae consectetur</a></td>
                                        <td>$147</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td>Angus Grady</td>
                                        <td><a href="#" class="text-primar">Ut voluptatem id earum et</a></td>
                                        <td>$67</td>
                                        <td><span class="badge bg-danger">Rejected</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#">#2644</a></th>
                                        <td>Raheem Lehner</td>
                                        <td><a href="#" class="text-primary">Sunt similique distinctio</a></td>
                                        <td>$165</td>
                                        <td><span class="badge bg-success">Approved</span></td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>{{ __('home.Filter') }}</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">{{ __('home.Today') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Month') }}</a></li>
                                    <li><a class="dropdown-item" href="#">{{ __('home.This Year') }}</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">{{ __('home.Top Selling') }} <span>| {{ __('home.Today') }}</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('home.Preview') }}</th>
                                        <th scope="col">{{ __('home.Product') }}</th>
                                        <th scope="col">{{ __('home.Price') }}</th>
                                        <th scope="col">{{ __('home.Sold') }}</th>
                                        <th scope="col">{{ __('home.Revenue') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row"><a href="#"><img loading="lazy" src="assets/img/product-1.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Ut inventore ipsa voluptas nulla</a></td>
                                        <td>$64</td>
                                        <td class="fw-bold">124</td>
                                        <td>$5,828</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img loading="lazy" src="assets/img/product-2.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Exercitationem similique doloremque</a></td>
                                        <td>$46</td>
                                        <td class="fw-bold">98</td>
                                        <td>$4,508</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img loading="lazy" src="assets/img/product-3.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Doloribus nisi exercitationem</a></td>
                                        <td>$59</td>
                                        <td class="fw-bold">74</td>
                                        <td>$4,366</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img loading="lazy" src="assets/img/product-4.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Officiis quaerat sint rerum error</a></td>
                                        <td>$32</td>
                                        <td class="fw-bold">63</td>
                                        <td>$2,016</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"><a href="#"><img loading="lazy" src="assets/img/product-5.jpg" alt=""></a></th>
                                        <td><a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a></td>
                                        <td>$79</td>
                                        <td class="fw-bold">41</td>
                                        <td>$3,239</td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div>
                    <!-- End Top Selling -->

                </div>
            </div>
        </div>
    </section>
@endsection