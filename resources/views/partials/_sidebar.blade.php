<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-code"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Siakad<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Check Guard: Siswa -->
    @auth('siswa')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-user-graduate"></i>
                <span>Siswa</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Siswa:</h6>
                    <a class="collapse-item" href="absensi-siswa.html">Absensi Siswa</a>
                    <a class="collapse-item" href="nilai-siswa.html">Nilai Siswa</a>
                </div>
            </div>
        </li>
    @endauth

    <!-- Check Guard: Guru -->
    @auth('guru')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGuru"
                aria-expanded="true" aria-controls="collapseGuru">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Manajemen Guru</span>
            </a>
            <div id="collapseGuru" class="collapse" aria-labelledby="headingGuru" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Guru:</h6>
                    <a class="collapse-item" href="{{ route('data-guru.index') }}">Data Guru</a>
                    <a class="collapse-item" href="mata-pelajaran.html">Mata Pelajaran</a>
                </div>
            </div>
        </li>
    @endauth

    <!-- Check Guard: Operator -->
    @auth('operator')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Beranda</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <i class="fas fa-fw fa-user-graduate"></i>
                <span>Manajemen Siswa</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Manajemen Siswa:</h6>
                    <a class="collapse-item" href="{{ route('data-siswa.index') }}">Data Siswa</a>
                    <a class="collapse-item" href="{{ route('pendaftaran-siswa.index') }}">Pendaftaran Siswa Baru</a>
                    <a class="collapse-item" href="{{ route('absensi-siswa.index') }}">Absensi Siswa</a>
                    <a class="collapse-item" href="{{ route('nilai-siswa.index') }}">Nilai Siswa</a>
                    {{-- <a class="collapse-item" href="kelulusan-siswa.html">Kelulusan Siswa</a> --}}
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('daftar-kelas.index') }}">
                <i class="fas fa-fw fa-school"></i>
                <span>Manajemen Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('data-guru.index') }}">
                <i class="fas fa-fw fa-chalkboard-teacher"></i>
                <span>Manajemen Guru</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('data-mapel.index') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Mata Pelajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('data-keuangan-siswa.index') }}">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Keuangan</span>
            </a>
        </li>
        <!-- Common Items (visible for all guards) -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('settings.index') }}">
                <i class="fas fa-fw fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </li>
    @endauth


    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0);"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form> --}}
</ul>
