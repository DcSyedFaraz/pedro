<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        const pusher = new Pusher('6783ea165c58d9b1b6c3', {
            cluster: 'ap2',
            encrypted: true
        });
        const channel = pusher.subscribe('post-liked');
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    @yield('links')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <!-- Language Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        @if (app()->getLocale() == 'en')
                            <img src="{{ asset('assets/imgs/united-states.png') }}" alt="United States Flag"
                                width="32" height="auto">
                        @elseif (app()->getLocale() == 'es')
                            <img src="{{ asset('assets/imgs/flag.png') }}" alt="Spain Flag" width="32"
                                height="auto">
                        @endif
                        <span class="badge badge-success navbar-badge">{{ app()->getLocale() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <span class="dropdown-item dropdown-header">Select Language</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('lang.switch', 'en') }}" class="dropdown-item my-2 text-wrap ">
                            <img src="{{ asset('assets/imgs/united-states.png') }}" alt="United States Flag"
                                width="32" height="auto"> English
                            @if (app()->getLocale() == 'en')
                                <span class="float-right text-muted text-sm"><strong>Selected</strong></span>
                            @endif
                        </a>
                        <a href="{{ route('lang.switch', 'es') }}" class="dropdown-item my-2 text-wrap ">
                            <img src="{{ asset('assets/imgs/flag.png') }}" alt="Spain Flag" width="32"
                                height="auto"> Spanish
                            @if (app()->getLocale() == 'es')
                                <span class="float-right text-muted text-sm"><strong>Selected</strong></span>
                            @endif
                        </a>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="far fa-bell"></i>
                        <span
                            class="badge badge-danger navbar-badge">{{ auth()->user()->unreadnotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <span class="dropdown-item dropdown-header">{{ auth()->user()->unreadnotifications->count() }}
                            UnRead Notifications</span>
                        <div class="dropdown-divider"></div>
                        @foreach (auth()->user()->unreadnotifications as $notifications)
                            <a href="{{ route('markasread', $notifications->id) }}"
                                class="dropdown-item my-2 text-wrap ">
                                <i class="fas fa-envelope mr-2"></i> {{ $notifications->data['name'] }}

                                @if (isset($notifications->data['message']))
                                    {{ $notifications->data['message'] }}

                                    <!-- Check if 'response' is present in the message and display the button -->
                                    @if (strpos($notifications->data['message'], 'response') !== false)
                                        <a href="{{ route('location') }}"
                                            class="btn btn-success ml-1 btn-sm float-left">view reponse</a>
                                    @endif
                                @endif

                                <span
                                    class="float-right text-muted text-sm">{{ $notifications->created_at->diffForHumans() }}</span>
                            </a>

                            {{-- <hr> --}}
                            {{-- <div class="dropdown-divider "></div> --}}
                        @endforeach
                        <a href="{{ route('allNotification') }}" class="dropdown-item dropdown-footer">See All
                            Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 ">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('/admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Dashboard</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'menu-open' : '' }} ">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Dashboard
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--Start Miscellaneous Modules -->
                        <li
                            class="nav-item {{ request()->routeIs('customer.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('estimates.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('work_orders.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('purchase-orders.*') ? 'menu-open' : '' }}

                            {{ request()->routeIs('inventory.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('technicians.*') ? 'menu-open' : '' }} ">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle
                                {{ request()->routeIs('customer.*') ? 'active' : '' }}
                                {{ request()->routeIs('estimates.*') ? 'active' : '' }}
                                {{ request()->routeIs('work_orders.*') ? 'active' : '' }}
                                {{ request()->routeIs('purchase-orders.*') ? 'active' : '' }}

                                {{ request()->routeIs('inventory.*') ? 'active' : '' }}

                                {{ request()->routeIs('technicians.*') ? 'active' : '' }} ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.my_workroom') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('customer.index') }}"
                                        class="nav-link {{ request()->routeIs('customer.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.customer') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('technicians.index') }}"
                                        class="nav-link {{ request()->routeIs('technicians.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage {{ __('admin/layout/app.technicians') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('estimates.index') }}"
                                        class="nav-link {{ request()->routeIs('estimates.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.estimates') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('work_orders.index') }}"
                                        class="nav-link {{ request()->routeIs('work_orders.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.work_orders') }} List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('purchase-orders.index') }}"
                                        class="nav-link {{ request()->routeIs('purchase-orders.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.purchase_orders') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('inventory.index') }}"
                                        class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.inventory') }}</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--End Miscellaneous Modules -->
                        <li
                            class="nav-item
                            {{ request()->routeIs('job.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('today.job.schedule') ? 'menu-open' : '' }}
                            {{ request()->routeIs('today.job.next.48.hours') ? 'menu-open' : '' }}
                            {{ request()->routeIs('job.needing.scheduling') ? 'menu-open' : '' }}
                            {{ request()->routeIs('jobs.in.progress') ? 'menu-open' : '' }}
                            {{ request()->routeIs('jobs.complete') ? 'menu-open' : '' }}
                            {{ request()->routeIs('jobperregion.index') ? 'menu-open' : '' }}
                            {{ request()->routeIs('jobpermanager.index') ? 'menu-open' : '' }}
                            {{ request()->routeIs('readyinvoice.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('location.index') ? 'menu-open' : '' }}

                             ">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle
                            {{ request()->routeIs('job.*') ? 'active' : '' }}
                            {{ request()->routeIs('today.job.schedule') ? 'active' : '' }}
                            {{ request()->routeIs('today.job.next.48.hours') ? 'active' : '' }}
                            {{ request()->routeIs('job.needing.scheduling') ? 'active' : '' }}
                            {{ request()->routeIs('jobs.in.progress') ? 'active' : '' }}
                            {{ request()->routeIs('jobs.complete') ? 'active' : '' }}
                            {{ request()->routeIs('jobperregion.index') ? 'active' : '' }}
                            {{ request()->routeIs('jobpermanager.index') ? 'active' : '' }}
                            {{ request()->routeIs('readyinvoice.*') ? 'active' : '' }}
                            {{ request()->routeIs('location.index') ? 'active' : '' }}

                            {{ request()->routeIs('ins_category.index') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.jobs') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('job.index') }}"
                                        class="nav-link {{ request()->routeIs('job.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.job_list') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('location.index') }}"
                                        class="nav-link {{ request()->routeIs('location.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.assign_checklist') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('today.job.schedule') }}"
                                        class="nav-link {{ request()->routeIs('today.job.schedule') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.today_schedule') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('today.job.next.48.hours') }}"
                                        class="nav-link {{ request()->routeIs('today.job.next.48.hours') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.within_48_hours') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('job.needing.scheduling') }}"
                                        class="nav-link {{ request()->routeIs('job.needing.scheduling') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.unscheduled') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jobs.in.progress') }}"
                                        class="nav-link {{ request()->routeIs('jobs.in.progress') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.in_progress') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jobs.complete') }}"
                                        class="nav-link {{ request()->routeIs('jobs.complete') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.completed') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('readyinvoice.index') }}"
                                        class="nav-link {{ request()->routeIs('readyinvoice.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.ready_to_be_invoiced') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jobpermanager.index') }}"
                                        class="nav-link {{ request()->routeIs('jobpermanager.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size: 15px;">
                                            {{ __('admin/layout/app.jobs_per_account_manager') }}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jobperregion.index') }}"
                                        class="nav-link {{ request()->routeIs('jobperregion.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.jobs_per_region') }}</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--Start Operations Modules -->
                        <li
                            class="nav-item
                             {{ request()->routeIs('task.index') ? 'menu-open' : '' }}
                             {{ request()->routeIs('problem.*') ? 'menu-open' : '' }}
                             {{ request()->routeIs('finalized') ? 'menu-open' : '' }}
                             {{ request()->routeIs('location') ? 'menu-open' : '' }}
                             {{ request()->routeIs('adminresponse') ? 'menu-open' : '' }}
                             {{ request()->routeIs('checklists.create') ? 'menu-open' : '' }}
                             {{ request()->routeIs('moodreport.index') ? 'menu-open' : '' }}
                             {{ request()->routeIs('managers.index') ? 'menu-open' : '' }}
                             ">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle
                                {{ request()->routeIs('task.index') ? 'active' : '' }}
                                {{ request()->routeIs('problem.*') ? 'active' : '' }}
                                {{ request()->routeIs('finalized') ? 'active' : '' }}
                                {{ request()->routeIs('location') ? 'active' : '' }}
                                {{ request()->routeIs('adminresponse') ? 'active' : '' }}
                                {{ request()->routeIs('checklists.create') ? 'active' : '' }}
                                {{ request()->routeIs('moodreport.index') ? 'active' : '' }}
                                {{ request()->routeIs('managers.index') ? 'active' : '' }}
                                ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.operations') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li
                                    class="nav-item {{ request()->routeIs('checklists.create') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link nav-dropdown-toggle {{ request()->routeIs('checklists.create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>
                                            {{ __('admin/layout/app.inspections') }} <i
                                                class="fas fa-plus right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.account_managers') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.location') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('checklists.create') }}"
                                                class="nav-link {{ request()->routeIs('checklists.create') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.inspection_sheet') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li
                                    class="nav-item
                          {{ request()->routeIs('finalized') ? 'menu-open' : '' }}
                          {{ request()->routeIs('location') ? 'menu-open' : '' }}
                          {{ request()->routeIs('adminresponse') ? 'menu-open' : '' }}
                          {{ request()->routeIs('managers.index') ? 'menu-open' : '' }}
                          ">
                                    <a href="#"
                                        class="nav-link nav-dropdown-toggle
                                {{ request()->routeIs('roles.index') ? 'active' : '' }}
                                {{ request()->routeIs('finalized') ? 'active' : '' }}
                                {{ request()->routeIs('location') ? 'active' : '' }}
                                {{ request()->routeIs('adminresponse') ? 'active' : '' }}
                                {{ request()->routeIs('managers.index') ? 'active' : '' }}
                                ">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>
                                            Checklist
                                            <i class="fas fa-plus right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('checklist.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.overall_checklist') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('finalized') }}"
                                                class="nav-link {{ request()->routeIs('finalized') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.finalized') }}</p>
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="{{ route('location') }}"
                                                class="nav-link {{ request()->routeIs('location') ? 'active' : '' }} {{ request()->routeIs('adminresponse') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.location') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('managers.index') }}"
                                                class="nav-link {{ request()->routeIs('managers.index') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.account_managers') }}
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>{{ __('admin/layout/app.field_employees') }}
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                <li class="nav-item">
                                    <a href="{{ route('problem.index') }}"
                                        class="nav-link {{ request()->routeIs('problem.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.problem_reporting') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('task.index') }}"
                                        class="nav-link {{ request()->routeIs('task.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.tasks') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Messages</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('moodreport.index') }}"
                                        class="nav-link {{ request()->routeIs('moodreport.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.mood_reporting') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p style="font-size: 15px;">
                                            {{ __('admin/layout/app.emp_vendor_performance') }}
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!--Start Operations Modules -->
                        <!--Start Accounting Modules -->
                        <li
                            class="nav-item
                            {{ request()->routeIs('pages.index') ? 'menu-open' : '' }}
                            {{ request()->routeIs('invoice.*') ? 'menu-open' : '' }}
                            {{ request()->routeIs('sections.index') ? 'menu-open' : '' }}
                            ">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle
                                {{ request()->routeIs('invoice.*') ? 'active' : '' }}
                                ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.accounting') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item">
                                    <a href="{{ route('invoice.create') }}"
                                        class="nav-link {{ request()->routeIs('invoice.create') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create invoice</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ route('invoice.index') }}"
                                        class="nav-link {{ request()->routeIs('invoice.*') ? 'active' : '' }} ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.invoice_dashboard') }}
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!--Start Accounting Modules -->
                        <li
                            class="nav-item {{ request()->routeIs('roles.index') ? 'menu-open' : '' }} {{ request()->routeIs('users.index') ? 'menu-open' : '' }}{{ request()->routeIs('users.create') ? 'menu-open' : '' }}{{ request()->routeIs('permission.index') ? 'menu-open' : '' }}{{ request()->routeIs('permission.create') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle {{ request()->routeIs('roles.index') ? 'active' : '' }} {{ request()->routeIs('users.index') ? 'active' : '' }}{{ request()->routeIs('users.create') ? 'active' : '' }}{{ request()->routeIs('permission.index') ? 'active' : '' }}{{ request()->routeIs('permission.create') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.users') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item {{ request()->routeIs('roles.index') ? 'menu-open' : '' }} ">
                                    @can('role-list')
                                        <a href="#"
                                            class="nav-link nav-dropdown-toggle {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-table"></i>
                                            <p>
                                                {{ __('admin/layout/app.emp_vendor_performance') }} Manage Roles
                                                <i class="fas fa-plus right"></i>
                                            </p>
                                        </a>
                                    @endcan
                                    <ul class="nav nav-treeview">
                                        @can('role-list')
                                            <li class="nav-item">
                                                <a href="{{ route('roles.index') }}"
                                                    class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ __('admin/layout/app.emp_vendor_performance') }}List Roles</p>
                                                </a>
                                            </li>
                                        @endcan

                                        @can('role-create')
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Add Role</p>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li> --}}
                                <li
                                    class="nav-item {{ request()->routeIs('users.index') ? 'menu-open' : '' }} {{ request()->routeIs('users.create') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link nav-dropdown-toggle {{ request()->routeIs('users.index') ? 'active' : '' }} {{ request()->routeIs('users.create') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-table"></i>
                                        <p>
                                            {{ __('admin/layout/app.manage_users') }}

                                            <i class="fas fa-plus right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}"
                                                class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>List {{ __('admin/layout/app.users') }}</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('users.create') }}"
                                                class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Add {{ __('admin/layout/app.users') }}</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- @can('permission-list')
                                    <li
                                        class="nav-item {{ request()->routeIs('permission.index') ? 'menu-open' : '' }} {{ request()->routeIs('permission.create') ? 'menu-open' : '' }}">
                                        <a href="#"
                                            class="nav-link nav-dropdown-toggle {{ request()->routeIs('permission.index') ? 'active' : '' }} {{ request()->routeIs('permission.create') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-table"></i>
                                            <p>
                                                Manage Permissions
                                                <i class="fas fa-plus right"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @can('permission-list')
                                                <li class="nav-item">
                                                    <a href="{{ route('permission.index') }}"
                                                        class="nav-link {{ request()->routeIs('permission.index') ? 'active' : '' }}">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>List Permissions</p>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can('permission-create')
                                                <li class="nav-item">
                                                    <a href="{{ route('permission.create') }}"
                                                        class="nav-link {{ request()->routeIs('permission.create') ? 'active' : '' }}">
                                                        <i class="far fa-circle nav-icon"></i>
                                                        <p>Add Permission</p>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </li>
                                @endcan --}}
                                <li class="nav-item">
                                    <a href="#" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clients</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Vendors</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Field employees</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Account Managers</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Office Administrators</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Owner</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->routeIs(['job-category.*', 'job-sub-category.*', 'job-priority.*', 'job-source.*'])
                                ? 'menu-open'
                                : '' }}">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle {{ request()->routeIs(['job-category.*', 'job-sub-category.*', 'job-priority.*', 'job-source.*'])
                                    ? 'active'
                                    : '' }}">



                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.job_settings') }}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('job-category.index') }}"
                                        class="nav-link {{ request()->routeIs('job-category.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.job_category') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('job-sub-category.index') }}"
                                        class="nav-link {{ request()->routeIs('job-sub-category.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.job_sub_category') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('job-priority.index') }}"
                                        class="nav-link {{ request()->routeIs('job-priority.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.job_priority') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('job-source.index') }}"
                                        class="nav-link {{ request()->routeIs('job-source.*') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.job_source') }}
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="nav-item {{ request()->routeIs('change_password') ? 'menu-open' : '' }} {{ request()->routeIs('change_password') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle  {{ request()->routeIs('profile.index') ? 'active' : '' }} {{ request()->routeIs('change_password') ? 'menu-open' : '' }}">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.account_setting') }}

                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('profile.index') }}"
                                        class="nav-link {{ request()->routeIs('profile.index') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.profile') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('change_password') }}"
                                        class="nav-link {{ request()->routeIs('change_password') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{ __('admin/layout/app.change_password') }}
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item {{ request()->routeIs('*.attendance') ? 'menu-open' : '' }}">
                            <a href="#"
                                class="nav-link nav-dropdown-toggle  {{ request()->routeIs('*.attendance') ? 'active' : '' }} ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    {{ __('admin/layout/app.attendance') }}

                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('manager.attendance') }}"
                                        class="nav-link {{ request()->routeIs('manager.attendance') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon text-success"></i>
                                        <p>{{ __('admin/layout/app.manager_attendance') }}
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('vendors.attendance') }}"
                                        class="nav-link {{ request()->routeIs('vendors.attendance') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon text-success"></i>
                                        <p>{{ __('admin/layout/app.vendors_attendance') }}
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('estimate_requests.index') }}"
                                class="nav-link {{ request()->routeIs('estimate_requests.*') ? 'active' : '' }} ">
                                <i class="far fa-calendar-alt nav-icon text-warning"></i>
                                <p>{{ __('admin/layout/app.estimate_request') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supply.index') }}"
                                class="nav-link {{ request()->routeIs('supply.*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon text-success"></i>
                                <p>{{ __('admin/layout/app.supply_request') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/logout') }}" class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon text-danger"></i>
                                <p>{{ __('admin/layout/app.logout') }}</p>
                            </a>
                        </li>
                        <!-- </ul> -->
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022-{{ now()->year }} <a href="#">Pedro</a>.</strong>
            All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('/admin/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('/admin/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
    {{-- <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script> --}}
    <script src="{{ asset('js/style.js') }}"></script>

    <!-- geo Location -->


    <!-- Toastr -->
    <script src="{{ asset('admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        // toastr.info("{{ auth()->user()->id }}");

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}")
        @endif
        @if (session('info'))
            toastr.info("{{ session('info') }}")
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

    <!-- Change password -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript">
    </script>
    <script type="text/javascript">
        $('.validatedForm').validate({
            rules: {
                password: {
                    minlength: 8
                },
                password_confirmation: {
                    minlength: 8,
                    equalTo: "#password"
                }
            }
        });
    </script>



    <!-- DataTables  & Plugins -->
    <script src="{{ asset('/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>





    <script>
        $(function() {
            $('#summernote').summernote();
            $('#summernote1').summernote();

            $("#example1").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": true,
                "rowReorder": true,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        // toastr.success('dasd');
        channel.bind('status.liked', function(data) {
            if (data) {
                const eventData = JSON.stringify(data);
                const message = eventData.message;
                alert(JSON.stringify(data));
                toastr.success(JSON.stringify(data.message));
                console.log(eventData);
            } else {
                console.log('some');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#showDescription').change(function() {
                if ($(this).is(':checked')) {
                    $('#descriptionContainer').fadeIn('slow');
                } else {
                    $('#descriptionContainer').fadeOut('slow');
                }
            });
            $('#showBill').change(function() {
                if ($(this).is(':checked')) {
                    $('#BillContainer').fadeIn('slow');
                } else {
                    $('#BillContainer').fadeOut('slow');
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
