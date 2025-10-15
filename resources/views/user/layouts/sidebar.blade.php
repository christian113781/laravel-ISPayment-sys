@php
    $customerActive = request()->routeIs([
        'user.customers',
        'user.customers.transaction',
        'user.customers.plan',
        // add more routes if needed
    ]);

    $vendoActive = request()->routeIs([
        'user.vendos',
        'user.vendos.transaction',
        // add more routes if needed
    ]);

    $expensesActive = request()->routeIs([
        'user.expenses'
    ]);
    $areaActive = request()->routeIs([
        'user.areas'
    ]);

@endphp
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="{{ route('user.dashboard') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20">
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>

        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}">
                        <i class="fas fa-layer-group"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                <li class="nav-item {{ $customerActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#base"
                        aria-expanded="{{ $customerActive ? 'true' : 'false' }}">
                        <i class="fas fa-tag"></i>
                        <p>Customers</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $customerActive ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('user.customers') ? 'active' : '' }}">
                                <a href="{{ route('user.customers') }}">
                                    <span class="sub-item">Manage Customers</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('user.customers.transaction') ? 'active' : '' }}">
                                <a href="{{ route('user.customers.transaction') }}">
                                    <span class="sub-item">Customer Transactions</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('user.customers.plan') ? 'active' : '' }}">
                                <a href="{{ route('user.customers.plan') }}">
                                    <span class="sub-item">Plans</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('components/panels.html') ? 'active' : '' }}">
                                <a href="#">
                                    <span class="sub-item">Reports</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ $vendoActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#vendoMenu"
                        aria-expanded="{{ $vendoActive ? 'true' : 'false' }}">
                        <i class="fas fa-vector-square"></i>
                        <p>Vendo Machines</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $vendoActive ? 'show' : '' }}" id="vendoMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('user.vendos') ? 'active' : '' }}">
                                <a href="{{ route('user.vendos') }}">
                                    <span class="sub-item">Manage Vendos</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('user.vendos.transaction') ? 'active' : '' }}">
                                <a href="{{ route('user.vendos.transaction') }}">
                                    <span class="sub-item">Vendo Transactions</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('user.vendo.reports') ? 'active' : '' }}">
                                <a href="">
                                    <span class="sub-item">Reports</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


{{-- 
                <li class="nav-item ">
                    <a data-bs-toggle="collapse" href="#omada">
                        <i class="fas fa-cloud"></i>
                        <p>Omada Cloud</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="omada">
                        <ul class="nav nav-collapse ">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Manage Omada</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}


                <li class="nav-item {{ $areaActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#areaMenu"
                        aria-expanded="{{ $areaActive ? 'true' : 'false' }}">
                        <i class="fas fa-location-arrow"></i>
                        <p>Area</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $areaActive ? 'show' : '' }}" id="areaMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('user.areas') ? 'active' : '' }}">
                                <a href="{{ route('user.areas') }}">
                                    <span class="sub-item">Manage Areas</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>


                <li class="nav-item {{ $expensesActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#expensesMenu"
                        aria-expanded="{{ $expensesActive ? 'true' : 'false' }}">
                        <i class="fas fa-gas-pump"></i>
                        <p>Expenses</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $expensesActive ? 'show' : '' }}" id="expensesMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('user.expenses') ? 'active' : '' }}">
                                <a href="{{ route('user.expenses') }}">
                                    <span class="sub-item">Manage Expenses</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                

                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables">
                        <i class="fas fa-database"></i>
                        <p>Reports</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="tables/tables.html">
                                    <span class="sub-item">Basic Table</span>
                                </a>
                            </li>
                            <li>
                                <a href="tables/datatables.html">
                                    <span class="sub-item">Datatables</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}


                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="fas fa-user-friends"></i>
                        <p>Cash Advance</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </li> --}}

                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="fas fa-fingerprint"></i>
                        <p>Global LOGS</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="charts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="charts/charts.html">
                                    <span class="sub-item">Chart Js</span>
                                </a>
                            </li>
                            <li>
                                <a href="charts/sparkline.html">
                                    <span class="sub-item">Sparkline</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Maintenance</h4>
                </li>

                {{-- <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="fas fa-user-friends"></i>
                        <p>Settings</p>
                    </a>
                </li> --}}


            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
