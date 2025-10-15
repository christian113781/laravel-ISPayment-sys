@php
    $customerActive = request()->routeIs([
        'admin.customers',
        'admin.customers.transaction',
        'admin.customers.plan',
        // add more routes if needed
    ]);

    $vendoActive = request()->routeIs([
        'admin.vendos',
        'admin.vendos.transaction',
        // add more routes if needed
    ]);

    $expensesActive = request()->routeIs([
        'admin.expenses'
    ]);
    $areaActive = request()->routeIs([
        'admin.areas'
    ]);
     $omadaActive = request()->routeIs([
        'admin.omada.manage'
    ]);
    $employeeActive = request()->routeIs([
        'admin.employees',
        'admin.employees.cashAdvance'
    ]);

@endphp
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="{{ route('admin.dashboard') }}" class="logo">
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
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
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
                            <li class="{{ request()->routeIs('admin.customers') ? 'active' : '' }}">
                                <a href="{{ route('admin.customers') }}">
                                    <span class="sub-item">Manage Customers</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.customers.transaction') ? 'active' : '' }}">
                                <a href="{{ route('admin.customers.transaction') }}">
                                    <span class="sub-item">Customer Transactions</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.customers.plan') ? 'active' : '' }}">
                                <a href="{{ route('admin.customers.plan') }}">
                                    <span class="sub-item">Plans</span>
                                </a>
                            </li>
                            {{-- <li class="{{ request()->routeIs('components/panels.html') ? 'active' : '' }}">
                                <a href="#">
                                    <span class="sub-item">Reports</span>
                                </a>
                            </li> --}}
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
                            <li class="{{ request()->routeIs('admin.vendos') ? 'active' : '' }}">
                                <a href="{{ route('admin.vendos') }}">
                                    <span class="sub-item">Manage Vendos</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.vendos.transaction') ? 'active' : '' }}">
                                <a href="{{ route('admin.vendos.transaction') }}">
                                    <span class="sub-item">Vendo Transactions</span>
                                </a>
                            </li>
                            {{-- <li class="{{ request()->routeIs('admin.vendo.reports') ? 'active' : '' }}">
                                <a href="">
                                    <span class="sub-item">Reports</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>



        


                <li class="nav-item {{ $omadaActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#omadaMenu"
                        aria-expanded="{{ $omadaActive ? 'true' : 'false' }}">
                        <i class="fas fa-cloud"></i>
                        <p>Omada Cloud</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $omadaActive ? 'show' : '' }}" id="omadaMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.omada.manage') ? 'active' : '' }}">
                                <a href="{{ route('admin.omada.manage') }}">
                                    <span class="sub-item">Manage Omada</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>


                <li class="nav-item {{ $areaActive ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#areaMenu"
                        aria-expanded="{{ $areaActive ? 'true' : 'false' }}">
                        <i class="fas fa-location-arrow"></i>
                        <p>Area</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ $areaActive ? 'show' : '' }}" id="areaMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.areas') ? 'active' : '' }}">
                                <a href="{{ route('admin.areas') }}">
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
                            <li class="{{ request()->routeIs('admin.expenses') ? 'active' : '' }}">
                                <a href="{{ route('admin.expenses') }}">
                                    <span class="sub-item">Manage Expenses</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item {{ $employeeActive ? 'active': '' }}">
                    <a data-bs-toggle="collapse" href="#employeeMenu"
                        aria-expanded="{{ $employeeActive ?  'true' : 'flase'  }}">
                    <i class="fas fa-user-friends"></i>
                    <p>Employees</p>
                    <span class="caret"></span>
                     </a>
                    <div class="collapse {{ $employeeActive ? 'show' : '' }}" id="employeeMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ request()->routeIs('admin.employees') ? 'active' : '' }}">
                                <a href="{{ route('admin.employees') }}">
                                <span class="sub-item">Manage Employee</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.employees.cashAdvance') ? 'active' : '' }}">
                                <a href="{{ route('admin.employees.cashadvance') }}">
                                <span class="sub-item">Cash Advance</span>
                                </a>
                            </li>
                    </div>
                </li>


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

                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#charts">
                        <i class="fas fa-sliders-h"></i>
                        <p>Settings</p>
                    </a>
                </li>


            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
