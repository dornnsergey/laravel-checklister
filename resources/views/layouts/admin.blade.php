<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{--<link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link font-weight-bolder" href="{{ route('consultation') }}">
                    Get Consultation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('welcome') }}">
                    <i class="text-primary fas fa-question"></i>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-user-tie"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0;">
                    <span
                        class="dropdown-item dropdown-header bg-gray-light font-weight-bold font-italic">Account</span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    @admin
                    <li class="nav-header text-lg">Manage checklists</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.groups.create') }}">
                            <i class="nav-icon fas fa-plus"></i>
                            <p class="text-info">New checklist group</p>
                        </a>
                    </li>
                    @foreach($groups as $group)
                        <li class="nav-item bg-gradient-gray-dark">
                            <a class="nav-link" href="">
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    {{ $group->name }}
                                </p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                @foreach($group->checklists as $checklist)
                                    <li class="nav-item">
                                        <a href="{{ route('admin.groups.checklists.show', [$group, $checklist]) }}"
                                           class="nav-link" style="padding-left: 2rem">
                                            <i class="fas fa-list-alt nav-icon"></i>
                                            <p class="font-weight-light">{{ $checklist->name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                                <li class="nav-item">
                                    <a href="{{ route('admin.groups.checklists.create', $group->id) }}"
                                       class="nav-link">
                                        <i class="far fa-copy nav-icon"></i>
                                        <p class="text-info font-weight-light">New checklist</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.groups.edit', $group) }}" class="nav-link">
                                        <i class="fas fa-edit nav-icon"></i>
                                        <p class="text-info font-weight-light">Edit group</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                    <li class="nav-header text-lg">Pages</li>
                    @foreach(\App\Models\Page::all() as $page)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.pages.edit', $page) }}">
                                <i class="nav-icon fas fa-file"></i>
                                <p>{{ $page->title }}</p>
                            </a>
                        </li>
                    @endforeach
                    <li class="nav-header text-lg">Manage Data</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}">
                            <i class="nav-icon fas fa-house-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    @else
                        @foreach($groups as $group)
                            <li class="nav-item bg-gradient-gray-dark">
                                <a class="nav-link" href="">
                                    <i class="nav-icon fas fa-folder-open"></i>
                                    <small>
                                        {{ $group->name }}
                                    </small>
                                    @if($group->is_new)
                                        <small><span class="badge badge-primary float-right ">NEW</span></small>
                                    @elseif($group->is_updated)
                                        <small><span class="badge badge-primary float-right ">UPD</span></small>
                                    @else
                                        <i class="right fas fa-angle-left"></i>
                                    @endif
                                </a>
                                <ul class="nav nav-treeview">
                                    @foreach($group->checklists as $checklist)
                                        <li class="nav-item">
                                            <a href="{{ route('user.checklists.show', [$checklist]) }}"
                                               class="nav-link" style="padding-left: 1.3rem">
                                                <i class="fas fa-list-alt nav-icon"></i>
                                                <small>
                                                    {{ $checklist->name }}
                                                    @if($checklist->is_new)
                                                        <span class="badge badge-primary float-right">NEW</span>
                                                    @elseif($checklist->is_updated)
                                                        <span class="badge badge-primary float-right">UPD</span>
                                                    @endif
                                                </small>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        @endadmin
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/classic/ckeditor.js"></script>
@yield('scripts')
</body>
</html>
