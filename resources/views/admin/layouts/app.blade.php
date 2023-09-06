<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/admin/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('/admin/plugins/toastr/toastr.min.css')}}">
	  <link rel="stylesheet" href="{{asset('assets/custom.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{asset('/admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'menu-open' : '' }} ">
                          <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                              Dashboard
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                              <a href="{{route('admin.dashboard')}}" class="nav-link {{ request()->routeIs('admin.dashboard')? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                              </a>
                            </li>
                          </ul>
                      </li>
                      <!--Start Miscellaneous Modules -->
                      <li class="nav-item {{ request()->routeIs('customer.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('estimates.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('admin.work_orders.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('purchase-orders.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('job-category.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('job-sub-category.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('job-priority.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('job-source.index') ? 'menu-open' : '' }}
                        {{ request()->routeIs('technicians.index') ? 'menu-open' : '' }} ">
                          <a href="#" class="nav-link nav-dropdown-toggle
                          {{ request()->routeIs('customer.index') ? 'active' : '' }}
                          {{ request()->routeIs('estimates.index') ? 'active' : '' }}
                          {{ request()->routeIs('admin.work_orders.index') ? 'active' : '' }}
                          {{ request()->routeIs('purchase-orders.index') ? 'active' : '' }}
                          {{ request()->routeIs('job-category.index') ? 'active' : '' }}
                          {{ request()->routeIs('job-sub-category.index') ? 'active' : '' }}
                          {{ request()->routeIs('job-priority.index') ? 'active' : '' }}
                          {{ request()->routeIs('job-source.index') ? 'active' : '' }}
                          {{ request()->routeIs('technicians.index') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                              My Workroom
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{route('customer.index')}}" class="nav-link {{ request()->routeIs('customer.index')? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('estimates.index')}}" class="nav-link {{ request()->routeIs('estimates.index')? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Estimates</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('admin.work_orders.index')}}" class="nav-link {{ request()->routeIs('admin.work_orders.index')? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Work Order List</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{route('purchase-orders.index')}}" class="nav-link {{ request()->routeIs('purchase-orders.index')? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Order</p>
                              </a>
                            </li>
                            <li class="nav-item">
                              <a href="{{ route('inventory.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventory</p>
                              </a>
                            </li>
                              <li class="nav-item">
                                <a href="{{route('job-category.index')}}" class="nav-link {{ request()->routeIs('job-category.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Job Category</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('job-sub-category.index')}}" class="nav-link {{ request()->routeIs('job-sub-category.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Job Sub Category</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('job-priority.index')}}" class="nav-link {{ request()->routeIs('job-priority.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Job Priority</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{route('job-source.index')}}" class="nav-link {{ request()->routeIs('job-source.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Job Source</p>
                                </a>
                              </li>
                          </ul>
                      </li>
                      <!--End Miscellaneous Modules -->
                      <!--Start Jobs/Scheduling Modules -->
                      <li class="nav-item
                    {{ request()->routeIs('job.index') ? 'menu-open' : '' }}
                    {{ request()->routeIs('today.job.schedule') ? 'menu-open' : '' }}
                    {{ request()->routeIs('today.job.next.48.hours') ? 'menu-open' : '' }}
                    {{ request()->routeIs('job.needing.scheduling') ? 'menu-open' : '' }}
                    {{ request()->routeIs('jobs.in.progress') ? 'menu-open' : '' }}
                    {{ request()->routeIs('jobs.complete') ? 'menu-open' : '' }}
                      ">
                          <a href="#" class="nav-link nav-dropdown-toggle
                    {{ request()->routeIs('job.index') ? 'active' : '' }}
                    {{ request()->routeIs('today.job.schedule') ? 'active' : '' }}
                    {{ request()->routeIs('today.job.next.48.hours') ? 'active' : '' }}
                    {{ request()->routeIs('job.needing.scheduling') ? 'active' : '' }}
                    {{ request()->routeIs('jobs.in.progress') ? 'active' : '' }}
                    {{ request()->routeIs('jobs.complete') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                              Jobs
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">
                              <li class="nav-item">
                                <a href="{{route('job.index')}}" class="nav-link {{ request()->routeIs('job.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Job List</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('today.job.schedule') }}" class="nav-link {{ request()->routeIs('today.job.schedule')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Today's Schedule</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('today.job.next.48.hours') }}" class="nav-link {{ request()->routeIs('today.job.next.48.hours')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Within 48 hours</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('job.needing.scheduling') }}" class="nav-link {{ request()->routeIs('job.needing.scheduling')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Unscheduled</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('jobs.in.progress') }}" class="nav-link {{ request()->routeIs('jobs.in.progress')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>In-progress</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="{{ route('jobs.complete') }}" class="nav-link {{ request()->routeIs('jobs.complete')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Completed</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ready to be invoiced</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p style="font-size: 15px;">Jobs per Account Manager</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Jobs per region</p>
                                </a>
                              </li>

                          </ul>
                      </li>
                      <!--Start Jobs/Scheduling Modules -->
                      <!--Start Operations Modules -->
                      <li class="nav-item ">
                          <a href="#" class="nav-link nav-dropdown-toggle ">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                              Operations
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                          <ul class="nav nav-treeview">

                          <li class="nav-item">
                              <a href="#" class="nav-link nav-dropdown-toggle ">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                Inspections
                                  <i class="fas fa-plus right"></i>
                                </p>
                              </a>
                              <ul class="nav nav-treeview">
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account Manager</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Location</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="{{route('inspection.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Inspection Sheet</p>
                                  </a>
                                </li>
                              </ul>
                          </li>

                          <li class="nav-item">
                                <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                  Checklist
                                    <i class="fas fa-plus right"></i>
                                  </p>
                                </a>
                              <ul class="nav nav-treeview">
                                <li class="nav-item">
                                  <a href="{{route('checklist.index')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Overall Checklist</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Finalized</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>location</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Account Manager</p>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Field Member</p>
                                  </a>
                                </li>
                              </ul>
                          </li>


                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Problem Reporting</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Tasks</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Messages</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Mood reporting</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p style="font-size: 15px;">Emp-Vendor performance</p>
                                </a>
                              </li>

                          </ul>
                      </li>
                      <!--Start Operations Modules -->
                      <!--Start Accounting Modules -->
                      <li class="nav-item {{ request()->routeIs('pages.index') ? 'menu-open' : '' }} {{ request()->routeIs('sections.index') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link nav-dropdown-toggle ">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                            Accounting
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item">
                            <a href="{{ route('invoice.index') }}" class="nav-link {{ request()->routeIs('job.index')? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Create invoice</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Invoice dashboard</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Unpaid Invoices</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Paid Invoices</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Recurring Invoices</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Past due invoices</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Total bill for this month</p>
                            </a>
                          </li>
                          <li class="nav-item">
                            <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Total bill for this year</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      @can('pages-list')
                      <li class="nav-item {{ request()->routeIs('pages.index') ? 'menu-open' : '' }} {{ request()->routeIs('sections.index') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('pages.index') ? 'active' : '' }} {{ request()->routeIs('sections.index') ? 'active' : '' }}">
                          <i class="nav-icon fas fa-table"></i>
                          <p>
                            Manage Pages
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview">
                          @can('pages-list')

                          <li class="nav-item">
                            <a href="{{route('pages.index')}}" class="nav-link {{ request()->routeIs('pages.index')? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>List Pages</p>
                            </a>
                          </li>
                          @endcan

                          <li class="nav-item">
                            <a href="{{route('sections.index')}}" class="nav-link {{ request()->routeIs('sections.index')? 'active' : '' }}">
                              <i class="far fa-circle nav-icon"></i>
                              <p>List Section</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      @endcan
                      <!--Start Accounting Modules -->
                      <li class="nav-item {{ request()->routeIs('roles.index') ? 'menu-open' : '' }} {{ request()->routeIs('users.index') ? 'menu-open' : '' }}{{ request()->routeIs('users.create') ? 'menu-open' : '' }}{{ request()->routeIs('permission.index') ? 'menu-open' : '' }}{{ request()->routeIs('permission.create') ? 'menu-open' : '' }}">
                          <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('roles.index') ? 'active' : '' }} {{ request()->routeIs('users.index') ? 'active' : '' }}{{ request()->routeIs('users.create') ? 'active' : '' }}{{ request()->routeIs('permission.index') ? 'active' : '' }}{{ request()->routeIs('permission.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                              Users
                              <i class="fas fa-angle-left right"></i>
                            </p>
                          </a>
                        <ul class="nav nav-treeview">
                          <li class="nav-item {{ request()->routeIs('roles.index') ? 'menu-open' : '' }} ">
                              @can('role-list')
                                <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                  <i class="nav-icon fas fa-table"></i>
                                  <p>
                                    Manage Roles
                                    <i class="fas fa-plus right"></i>
                                  </p>
                                </a>
                              @endcan
                              <ul class="nav nav-treeview">
                                @can('role-list')
                                <li class="nav-item">
                                  <a href="{{route('roles.index')}}" class="nav-link {{ request()->routeIs('roles.index')? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Roles</p>
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
                          </li>
                          @can('user-list')
                          <li class="nav-item {{ request()->routeIs('users.index') ? 'menu-open' : '' }} {{ request()->routeIs('users.create') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('users.index') ? 'active' : '' }} {{ request()->routeIs('users.create') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-table"></i>
                              <p>
                                Manage Users
                                <i class="fas fa-plus right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('user-list')
                                <li class="nav-item">
                                  <a href="{{route('users.index')}}" class="nav-link {{ request()->routeIs('users.index')? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Users</p>
                                  </a>
                                </li>
                                @endcan
                                @can('user-create')
                                <li class="nav-item">
                                  <a href="{{route('users.create')}}" class="nav-link {{ request()->routeIs('users.create')? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Users</p>
                                  </a>
                                </li>
                                @endcan
                            </ul>
                          </li>
                          @endcan
                          @can('permission-list')
                          <li class="nav-item {{ request()->routeIs('permission.index') ? 'menu-open' : '' }} {{ request()->routeIs('permission.create') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('permission.index') ? 'active' : '' }} {{ request()->routeIs('permission.create') ? 'active' : '' }}">
                              <i class="nav-icon fas fa-table"></i>
                              <p>
                                Manage Permissions
                                <i class="fas fa-plus right"></i>
                              </p>
                            </a>
                            <ul class="nav nav-treeview">
                              @can('permission-list')
                              <li class="nav-item">
                                <a href="{{route('permission.index')}}" class="nav-link {{ request()->routeIs('permission.index')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>List Permissions</p>
                                </a>
                              </li>
                              @endcan
                              @can('permission-create')
                              <li class="nav-item">
                                <a href="{{route('permission.create')}}" class="nav-link {{ request()->routeIs('permission.create')? 'active' : '' }}">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Add Permission</p>
                                </a>
                              </li>
                              @endcan
                            </ul>
                          </li>
                          @endcan
                          <li class="nav-item">
                            <a href="#" class="nav-link {{ request()->routeIs('job.index')? 'active' : '' }}">
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
                            <a href="#" class="nav-link">
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
                  @can('general_setting')
                  <li class="nav-item {{ request()->routeIs('general_setting.index') ? 'menu-open' : '' }} ">
                    <a href="#" class="nav-link nav-dropdown-toggle {{ request()->routeIs('general_setting.index') ? 'active' : '' }}">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Manage General Setting
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{route('general_setting.index')}}" class="nav-link {{ request()->routeIs('general_setting.index')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>General Setting</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  @endcan
                  <li class="nav-item {{ request()->routeIs('change_password') ? 'menu-open' : '' }} {{ request()->routeIs('change_password') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link nav-dropdown-toggle  {{ request()->routeIs('profile.index') ? 'active' : '' }} {{ request()->routeIs('change_password') ? 'menu-open' : '' }}">
                      <i class="nav-icon fas fa-table"></i>
                      <p>
                        Account Setting
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">

                      <!-- @can('permission-list') -->
                      <li class="nav-item">
                        <a href="{{route('profile.index')}}" class="nav-link {{ request()->routeIs('profile.index')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Profile</p>
                        </a>
                      </li>

                      <!-- @endcan -->
                      <li class="nav-item">
                        <a href="{{route('change_password')}}" class="nav-link {{ request()->routeIs('change_password')? 'active' : '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Change Password</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="{{url('/logout')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Logout</p>
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
    <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="{{asset('/admin/plugins/jquery/jquery.min.js')}}"></script>

<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('/admin/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/admin/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('/admin/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('/admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/admin/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/admin/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}"></script>
<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>
<script src="{{asset('js/style.js')}}"></script>

<!-- geo Location -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDqnUWO38RJMjRlwsY1imxqB1WI8ZWsU3M"></script>

<!-- Toastr -->
<script src="{{asset('/admin/plugins/toastr/toastr.min.js')}}"></script>
<script>
@if(session('success'))
  toastr.success("{{session('success')}}");
@endif
@if(session('error'))
  toastr.error("{{session('error')}}")
@endif
@if($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{$error}}")
    @endforeach
@endif
</script>

<!-- Change password -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
    $('.validatedForm').validate({
        rules : {
            password : {
                minlength : 8
            },
            password_confirmation : {
                minlength : 8,
                equalTo : "#password"
            }
        }
});

</script>



<!-- DataTables  & Plugins -->
<script src="{{asset('/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>



<script>
$(function () {
  $('#summernote').summernote();
  $('#summernote1').summernote();

  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": true,
    "buttons": ["csv", "excel", "pdf", "print"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });
});

var searchInput = 'search_input';
$(document).ready(function () {
  // alert('saad');
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
        componentRestrictions: {
          country: "PK"
        }
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        // alert(near_place.geometry);
        debugger
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();
	  });
});

</script>


</body>
</html>
