@extends('user.layouts.app')

@section('dashboard')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Customers</p>
                                        <h4 class="card-title">{{ $totalCustomers }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Customer Monthly Income</p>
                                        <h4 class="card-title">{{ number_format($currentCustomerMonthIncome, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-vector-square"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Vendos</p>
                                       <h4 class="card-title">{{ $totalVendos }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Vendo Monthly Income</p>
                                          <h4 class="card-title">{{ number_format($currentVendoMonthIncome, 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row row-card-no-pd mt--2">
                <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6><b>Total Incomes</b></h6>
                                    <p class="text-muted">All Customers Value</p>
                                </div>
                                <h4 class="text-info fw-bold">  <h4 class="card-title">{{ number_format($totalCustomerSales, 2) }}</h4>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-info w-75" role="progressbar" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Change</p>
                                <p class="text-muted mb-0">75%</p>
                            </div>
                        </div>
                    </div>
                </div>




                <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6><b>Total Harvest</b></h6>
                                    <p class="text-muted">All Vendo Value</p>
                                </div>
                                <h4 class="text-info fw-bold">  <h4 class="card-title">{{ number_format($totalVendoSales, 2) }}</h4>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success w-25" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Change</p>
                                <p class="text-muted mb-0">25%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6><b>Total Expenses</b></h6>
                                    <p class="text-muted">All Expenses Value</p>
                                </div>
                                <h4 class="text-info fw-bold">  <h4 class="card-title">{{ number_format($totalExpensesSales, 2) }}</h4>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-danger w-50" role="progressbar" aria-valuenow="50"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Change</p>
                                <p class="text-muted mb-0">50%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6><b>Omada Cloud</b></h6>
                                    <p class="text-muted">All Omada Cloud Value</p>
                                </div>
                                <h4 class="text-secondary fw-bold">12</h4>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-secondary w-25" role="progressbar" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <p class="text-muted mb-0">Change</p>
                                <p class="text-muted mb-0">25%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Total Income Diagram</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="multipleLineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @push('dashboard')
            <script>
                multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');

                    var myMultipleLineChart = new Chart(multipleLineChart, {
                        type: 'line',
                        data: {
                            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                            datasets: [{
                                label: "Customers",
                                borderColor: "#1d7af3",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#1d7af3",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 3,
                                data: @json($customerMonthlySales)
                            }, {
                                label: "Vendos",
                                borderColor: "#f3545d",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#f3545d",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 3,
                                data: @json($vendoMonthlySales)

                        },{
                                label: "Expenses",
                                borderColor: "#FFAE42",
                                pointBorderColor: "#FFF",
                                pointBackgroundColor: "#FFAE42",
                                pointBorderWidth: 2,
                                pointHoverRadius: 4,
                                pointHoverBorderWidth: 1,
                                pointRadius: 4,
                                backgroundColor: 'transparent',
                                fill: true,
                                borderWidth: 3,
                                data: @json($expensesMonthlySales)
                            }]
                        },
                        
                        
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            legend: {
                                position: 'top',
                            },
                            tooltips: {
                                bodySpacing: 4,
                                mode: "nearest",
                                intersect: 0,
                                position: "nearest",
                                xPadding: 10,
                                yPadding: 10,
                                caretPadding: 10
                            },
                            layout: {
                                padding: {
                                    left: 15,
                                    right: 15,
                                    top: 15,
                                    bottom: 15
                                }
                            }
                        }
                    });
            </script>
        @endpush
    @endsection
