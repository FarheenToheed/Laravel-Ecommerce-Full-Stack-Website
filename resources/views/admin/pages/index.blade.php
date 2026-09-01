{{-- @extends('admin.layout.master')
@section('title', 'Dashboard')

@section('main')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder">$53,000</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+55%</span> since yesterday
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Today's Users</p>
                <h5 class="font-weight-bolder">2,300</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+3%</span> since last week
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                <h5 class="font-weight-bolder">+3,462</h5>
                <p class="mb-0">
                  <span class="text-danger text-sm font-weight-bolder">-2%</span> since last quarter
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                <h5 class="font-weight-bolder">$103,430</h5>
                <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                </p>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Sales overview</h6>
          <p class="text-sm mb-0">
            <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">4% more</span> in 2021
          </p>
        </div>
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card card-carousel overflow-hidden h-100 p-0">
        <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
          <div class="carousel-inner border-radius-lg h-100">
            <div class="carousel-item h-100 active" style="background-image: url('../assets/img/carousel-1.jpg'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-camera-compact text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Get started with Argon</h5>
                <p>There's nothing I really wanted to do in life that I wasn't able to get good at.</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-2.jpg'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Faster way to create web pages</h5>
                <p>That's my skill. I'm not really specifically talented at anything except for the ability to learn.</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('../assets/img/carousel-3.jpg'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-trophy text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Share with us your design tips!</h5>
                <p>Don't be afraid to be wrong because you can't learn anything from a compliment.</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <div class="d-flex justify-content-between">
            <h6 class="mb-2">Sales by Country</h6>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center">
            <tbody>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <img src="../assets/img/icons/flags/US.png" alt="US">
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0">Country:</p>
                      <h6 class="text-sm mb-0">United States</h6>
                    </div>
                  </div>
                </td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Sales:</p><h6 class="text-sm mb-0">2500</h6></div></td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Value:</p><h6 class="text-sm mb-0">$230,900</h6></div></td>
                <td><div class="col text-center"><p class="text-xs font-weight-bold mb-0">Bounce:</p><h6 class="text-sm mb-0">29.9%</h6></div></td>
              </tr>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <img src="../assets/img/icons/flags/DE.png" alt="DE">
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0">Country:</p>
                      <h6 class="text-sm mb-0">Germany</h6>
                    </div>
                  </div>
                </td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Sales:</p><h6 class="text-sm mb-0">3.900</h6></div></td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Value:</p><h6 class="text-sm mb-0">$440,000</h6></div></td>
                <td><div class="col text-center"><p class="text-xs font-weight-bold mb-0">Bounce:</p><h6 class="text-sm mb-0">40.22%</h6></div></td>
              </tr>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <img src="../assets/img/icons/flags/GB.png" alt="GB">
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0">Country:</p>
                      <h6 class="text-sm mb-0">Great Britain</h6>
                    </div>
                  </div>
                </td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Sales:</p><h6 class="text-sm mb-0">1.400</h6></div></td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Value:</p><h6 class="text-sm mb-0">$190,700</h6></div></td>
                <td><div class="col text-center"><p class="text-xs font-weight-bold mb-0">Bounce:</p><h6 class="text-sm mb-0">23.44%</h6></div></td>
              </tr>
              <tr>
                <td class="w-30">
                  <div class="d-flex px-2 py-1 align-items-center">
                    <img src="../assets/img/icons/flags/BR.png" alt="BR">
                    <div class="ms-4">
                      <p class="text-xs font-weight-bold mb-0">Country:</p>
                      <h6 class="text-sm mb-0">Brasil</h6>
                    </div>
                  </div>
                </td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Sales:</p><h6 class="text-sm mb-0">562</h6></div></td>
                <td><div class="text-center"><p class="text-xs font-weight-bold mb-0">Value:</p><h6 class="text-sm mb-0">$143,960</h6></div></td>
                <td><div class="col text-center"><p class="text-xs font-weight-bold mb-0">Bounce:</p><h6 class="text-sm mb-0">32.14%</h6></div></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Categories</h6>
        </div>
        <div class="card-body p-3">
          <ul class="list-group">
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-mobile-button text-white opacity-10"></i>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Devices</h6>
                  <span class="text-xs">250 in stock, <span class="font-weight-bold">346+ sold</span></span>
                </div>
              </div>
              <div class="d-flex">
                <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right"></i></button>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-tag text-white opacity-10"></i>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                  <span class="text-xs">123 closed, <span class="font-weight-bold">15 open</span></span>
                </div>
              </div>
              <div class="d-flex">
                <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right"></i></button>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-box-2 text-white opacity-10"></i>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                  <span class="text-xs">1 is active, <span class="font-weight-bold">40 closed</span></span>
                </div>
              </div>
              <div class="d-flex">
                <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right"></i></button>
              </div>
            </li>
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
              <div class="d-flex align-items-center">
                <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-satisfied text-white opacity-10"></i>
                </div>
                <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                  <span class="text-xs font-weight-bold">+ 430</span>
                </div>
              </div>
              <div class="d-flex">
                <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i class="ni ni-bold-right"></i></button>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  var ctx1 = document.getElementById("chart-line").getContext("2d");
  var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);
  gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
  gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
  gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [{
        label: "Mobile apps",
        tension: 0.4,
        borderWidth: 3,
        pointRadius: 0,
        borderColor: "#5e72e4",
        backgroundColor: gradientStroke1,
        fill: true,
        data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        maxBarThickness: 6
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      interaction: { intersect: false, mode: 'index' },
      scales: {
        y: {
          grid: { drawBorder: false, display: true, drawOnChartArea: true, drawTicks: false, borderDash: [5, 5] },
          ticks: { display: true, padding: 10, color: '#fbfbfb', font: { size: 11, family: "Open Sans", style: 'normal', lineHeight: 2 } }
        },
        x: {
          grid: { drawBorder: false, display: false, drawOnChartArea: false, drawTicks: false },
          ticks: { display: true, color: '#ccc', padding: 20, font: { size: 11, family: "Open Sans", style: 'normal', lineHeight: 2 } }
        }
      }
    }
  });
</script>
@endpush --}}


@extends('admin.layout.master')

@section('title', 'Dashboard')

@section('main')

<div class="container-fluid py-4">

    {{-- =========================================================
        TOP STAT CARDS
    ========================================================== --}}

    <div class="row">

        {{-- TOTAL PRODUCTS --}}
        <div class="col-xl-3 col-sm-6 mb-4">
            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Products
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($totalProducts) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    Products in store
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">

                                <i class="ni ni-box-2 text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>


        {{-- TOTAL ORDERS --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Orders
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($totalOrders) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    {{ $thisMonthOrders }} orders this month
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">

                                <i class="ni ni-cart text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL USERS --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Users
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($totalUsers) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    Registered customers
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">

                                <i class="ni ni-single-02 text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL CATEGORIES --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Categories
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($totalCategories) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    Product categories
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">

                                <i class="ni ni-tag text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        SECOND ROW
    ========================================================== --}}

    <div class="row">

        {{-- TOTAL REVENUE --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Total Revenue
                                </p>

                                <h5 class="font-weight-bolder">
                                    Rs. {{ number_format($totalRevenue) }}
                                </h5>

                                <p class="mb-0">

                                    @if($revenuePercentage >= 0)

                                        <span class="text-success text-sm font-weight-bolder">
                                            +{{ number_format($revenuePercentage, 1) }}%
                                        </span>

                                    @else

                                        <span class="text-danger text-sm font-weight-bolder">
                                            {{ number_format($revenuePercentage, 1) }}%
                                        </span>

                                    @endif

                                    <span class="text-sm">
                                        vs last month
                                    </span>

                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">

                                <i class="ni ni-money-coins text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENDING ORDERS --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Pending Orders
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($pendingOrders) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    Need attention
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">

                                <i class="ni ni-time-alarm text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- cancel ORDERS --}}
        <div class="col-xl-3 col-sm-6 mb-4">

            <div class="card h-100">

                <div class="card-body p-3">

                    <div class="row">

                        <div class="col-8">

                            <div class="numbers">

                                <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                    Cancel Orders
                                </p>

                                <h5 class="font-weight-bolder">
                                    {{ number_format($cancelOrders) }}
                                </h5>

                                <p class="mb-0 text-sm">
                                    Need attention
                                </p>

                            </div>

                        </div>

                        <div class="col-4 text-end">

                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">

                                <i class="ni ni-time-alarm text-lg opacity-10"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        SALES GRAPH
    ========================================================== --}}

    <div class="row mt-2">

        <div class="col-lg-8 mb-4">

            <div class="card z-index-2 h-100">

                <div class="card-header pb-0 pt-3 bg-transparent">

                    <h6 class="text-capitalize">
                        Monthly Sales
                    </h6>

                    <p class="text-sm mb-0">

                        <i class="fa fa-check text-success"></i>

                        <span class="font-weight-bold">
                            Delivered Orders
                        </span>

                        — {{ now()->year }}

                    </p>

                </div>


                <div class="card-body p-3">

                    <div class="chart" style="height: 350px;">

                        <canvas id="sales-chart" class="chart-canvas" height="350"></canvas>

                    </div>

                </div>

            </div>

        </div>



        {{-- THIS MONTH REVENUE --}}
        <div class="col-lg-4 mb-4">

            <div class="card h-100">

                <div class="card-header pb-0">

                    <h6>
                        This Month
                    </h6>

                </div>

                <div class="card-body">

                    <div class="mb-4">

                        <p class="text-sm mb-1">
                            Delivered Revenue
                        </p>

                        <h4 class="font-weight-bolder">
                            Rs. {{ number_format($thisMonthRevenue) }}
                        </h4>

                    </div>


                    <div class="mb-4">

                        <p class="text-sm mb-1">
                            Total Orders
                        </p>

                        <h4 class="font-weight-bolder">
                            {{ number_format($thisMonthOrders) }}
                        </h4>

                    </div>


                    <div>

                        <p class="text-sm mb-1">
                            Pending Orders
                        </p>

                        <h4 class="font-weight-bolder">
                            {{ number_format($pendingOrders) }}
                        </h4>

                    </div>
                    <div>

                        <p class="text-sm mb-1">
                            Cancel Orders
                        </p>

                        <h4 class="font-weight-bolder">
                            {{ number_format($cancelOrders) }}
                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        RECENT ORDERS + RECENT USERS
    ========================================================== --}}

    <div class="row">

        {{-- RECENT ORDERS --}}
        <div class="col-lg-8 mb-4">

            <div class="card">

                <div class="card-header pb-0 p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="mb-0">
                            Recent Orders
                        </h6>

                        <a
                            href="{{ route('admin.orderdetails.index') }}"
                            class="btn btn-sm btn-outline-primary mb-0">
                            View All
                        </a>

                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table align-items-center mb-0">

                        <thead>

                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Order
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Customer
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Total
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Date
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($recentOrders as $order)

                                <tr>

                                    <td>

                                        <div class="px-3">

                                            <h6 class="mb-0 text-sm">
                                                #{{ $order->id }}
                                            </h6>

                                        </div>

                                    </td>


                                    <td>

                                        <p class="text-sm font-weight-bold mb-0">

                                            {{ $order->user->name ?? 'Guest' }}

                                        </p>

                                    </td>


                                    <td>

                                        <p class="text-sm font-weight-bold mb-0">

                                            Rs. {{ number_format($order->total) }}

                                        </p>

                                    </td>


                                    <td>

                                        @php

                                            $statusClass = match($order->status) {

                                                'pending' => 'bg-gradient-warning',

                                                'processing' => 'bg-gradient-info',

                                                'confirmed' => 'bg-gradient-primary',

                                                'shipped' => 'bg-gradient-secondary',

                                                'delivered' => 'bg-gradient-success',

                                                'cancelled' => 'bg-gradient-danger',

                                                default => 'bg-gradient-secondary',

                                            };

                                        @endphp


                                        <span class="badge {{ $statusClass }}">

                                            {{ ucfirst($order->status) }}

                                        </span>

                                    </td>


                                    <td>

                                        <p class="text-sm mb-0">

                                            {{ $order->created_at->format('d M, Y') }}

                                        </p>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-4">

                                        No orders found.

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>



        {{-- RECENT USERS --}}
        <div class="col-lg-4 mb-4">

            <div class="card">

                <div class="card-header pb-0 p-3">

                    <h6 class="mb-0">
                        Recent Users
                    </h6>

                </div>


                <div class="card-body p-3">

                    <ul class="list-group">

                        @forelse($recentUsers as $user)

                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">

                                <div class="me-3">

                                    <div class="avatar avatar-sm bg-gradient-primary rounded-circle">

                                        <span class="text-white text-sm">

                                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}

                                        </span>

                                    </div>

                                </div>


                                <div class="d-flex flex-column">

                                    <h6 class="mb-1 text-sm">

                                        {{ $user->name ?? 'User' }}

                                    </h6>

                                    <span class="text-xs">

                                        {{ $user->email }}

                                    </span>

                                </div>

                            </li>

                        @empty

                            <li class="list-group-item border-0 text-center">

                                No users found.

                            </li>

                        @endforelse

                    </ul>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        LOW STOCK PRODUCTS
    ========================================================== --}}

    <div class="row">

        <div class="col-12 mb-4">

            <div class="card">

                <div class="card-header pb-0 p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h6 class="mb-1">
                                Low Stock Products
                            </h6>

                            <p class="text-sm mb-0">
                                Products with 10 or fewer items
                            </p>

                        </div>

                        <a
                            href="{{ route('admin.product.index') }}"
                            class="btn btn-sm btn-outline-primary mb-0">
                            View Products
                        </a>

                    </div>

                </div>


                <div class="table-responsive">

                    <table class="table align-items-center mb-0">

                        <thead>

                            <tr>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Product
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    SKU
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Category
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Stock
                                </th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Status
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($lowStockProducts as $product)

                                <tr>

                                    <td>

                                        <div class="d-flex px-3 py-1">

                                            <div class="d-flex flex-column justify-content-center">

                                                <h6 class="mb-0 text-sm">

                                                    {{ $product->name }}

                                                </h6>

                                            </div>

                                        </div>

                                    </td>


                                    <td>

                                        <p class="text-sm font-weight-bold mb-0">

                                            {{ $product->sku }}

                                        </p>

                                    </td>


                                    <td>

                                        <p class="text-sm mb-0">

                                            {{ $product->sub_category->category->name ?? '-' }}

                                        </p>

                                    </td>


                                    <td>

                                        @if($product->stock <= 3)

                                            <span class="badge bg-gradient-danger">

                                                {{ $product->stock }} left

                                            </span>

                                        @elseif($product->stock <= 10)

                                            <span class="badge bg-gradient-warning">

                                                {{ $product->stock }} left

                                            </span>

                                        @else

                                            <span class="badge bg-gradient-success">

                                                {{ $product->stock }}

                                            </span>

                                        @endif

                                    </td>


                                    <td>

                                        @if($product->status === 'active')

                                            <span class="badge bg-gradient-success">

                                                Active

                                            </span>

                                        @else

                                            <span class="badge bg-gradient-secondary">

                                                Inactive

                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-4">

                                        <p class="mb-0 text-sm text-success">

                                            All products have sufficient stock.

                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



{{-- =============================================================
     CHART
============================================================= --}}

@push('js')

<script>

document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("sales-chart");

    if (!canvas) {
        return;
    }

    const ctx = canvas.getContext("2d");


    /*
    |--------------------------------------------------------------------------
    | GRADIENT
    |--------------------------------------------------------------------------
    */

    const gradient = ctx.createLinearGradient(0, 300, 0, 50);

    gradient.addColorStop(1, 'rgba(94, 114, 228, 0.25)');
    gradient.addColorStop(0.2, 'rgba(94, 114, 228, 0.05)');
    gradient.addColorStop(0, 'rgba(94, 114, 228, 0)');


    /*
    |--------------------------------------------------------------------------
    | SALES CHART
    |--------------------------------------------------------------------------
    */

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: @json($salesLabels),

            datasets: [

                {

                    label: 'Sales',

                    data: @json($salesData),

                    tension: 0.4,

                    borderWidth: 3,

                    pointRadius: 4,

                    pointHoverRadius: 6,

                    borderColor: '#5e72e4',

                    backgroundColor: gradient,

                    fill: true

                }

            ]

        },


        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {

                intersect: false,

                mode: 'index'

            },


            plugins: {

                legend: {

                    display: false

                },


                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return 'Rs. ' + Number(context.raw).toLocaleString();

                        }

                    }

                }

            },


            scales: {

                y: {

                    beginAtZero: true,

                    grid: {

                        drawBorder: false,

                        borderDash: [5, 5]

                    },

                    ticks: {

                        padding: 10,

                        callback: function(value) {

                            return 'Rs. ' + Number(value).toLocaleString();

                        }

                    }

                },


                x: {

                    grid: {

                        display: false

                    },

                    ticks: {

                        padding: 10

                    }

                }

            }

        }

    });

});

</script>

@endpush