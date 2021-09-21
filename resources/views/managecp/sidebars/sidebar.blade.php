<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets') }}/img/pemkabdairi.png" alt="AdminLTE Logo" class="brand-image">
        <span class="brand-text font-weight-light">Admin Bansos Dairi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image my-auto">
                <img src="{{asset('managecp')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{session('full_name')}}</a>
                <div class="status_level">{{session('level_user')}}</div>
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
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-header">Master Data</li>
                @if(auth()->user()->usergroupid=='1')
                <li class="nav-item">
                    <a href="{{route('penerimalist')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Penerima
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('agenlist')}}" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Agen
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('desalist')}}" class="nav-link">
                        <i class="nav-icon fas fa-city"></i>
                        <p>
                            Desa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('jenisbantuanlist')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Jenis Bantuan
                            <!-- <span class="badge badge-info right">1</span> -->
                        </p>
                    </a>
                </li>
                <br>
                <li class="nav-header">Perlu Persetujuan</li>
                <li class="nav-item">
                    <a href="{{route('setujuibaranglist')}}" class="nav-link">
                        <i class="nav-icon fas fa-vote-yea"></i>
                        <p>
                            Barang
                            <!-- <span class="badge badge-info right">1</span> -->
                        </p>
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a href="{{route('baranglist')}}" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-header">Proses</li>
                <li class="nav-item">
                    <a href="{{route('penyaluranlist')}}" class="nav-link">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                            Penyaluran
                        </p>
                    </a>
                </li>
                @endif

                <br>
                <li class="nav-item">
                    <a href="/logout" class="nav-link btn-logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>