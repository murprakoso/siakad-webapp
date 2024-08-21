 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-code"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Siakad<sup>2</sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('dashboard') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Beranda</span>
         </a>
     </li>

     <!-- Divider -->
     {{-- <hr class="sidebar-divider"> --}}

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
             aria-expanded="true" aria-controls="collapseOne">
             <i class="fas fa-user-graduate"></i>
             <span>Manajemen Siswa</span>
         </a>
         <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Manajemen Siswa:</h6>
                 <a class="collapse-item" href="{{ route('data-siswa.index') }}">Data Siswa</a>
                 <a class="collapse-item" href="pendaftaran-siswa.html">Pendaftaran Siswa Baru</a>
                 <a class="collapse-item" href="absensi-siswa.html">Absensi Siswa</a>
                 <a class="collapse-item" href="nilai-siswa.html">Nilai Siswa</a>
                 <a class="collapse-item" href="kelulusan-siswa.html">Kelulusan Siswa</a>
             </div>
         </div>
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

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas"
             aria-expanded="true" aria-controls="collapseKelas">
             <i class="fas fa-fw fa-school"></i>
             <span>Manajemen Kelas</span>
         </a>
         <div id="collapseKelas" class="collapse" aria-labelledby="headingKelas" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Manajemen Kelas:</h6>
                 <a class="collapse-item" href="{{ route('daftar-kelas.index') }}">Daftar Kelas</a>
                 <a class="collapse-item" href="wali-kelas.html">Wali Kelas</a>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMataPelajaran"
             aria-expanded="true" aria-controls="collapseMataPelajaran">
             <i class="fas fa-fw fa-book"></i>
             <span>Mata Pelajaran</span>
         </a>
         <div id="collapseMataPelajaran" class="collapse" aria-labelledby="headingMataPelajaran"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Mata Pelajaran:</h6>
                 <a class="collapse-item" href="{{ route('data-mapel.index') }}">Daftar Mata Pelajaran</a>
                 <a class="collapse-item" href="penugasan-guru.html">Penugasan Guru</a>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKeuangan"
             aria-expanded="true" aria-controls="collapseKeuangan">
             <i class="fas fa-fw fa-dollar-sign"></i>
             <span>Keuangan</span>
         </a>
         <div id="collapseKeuangan" class="collapse" aria-labelledby="headingKeuangan"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Keuangan:</h6>
                 <a class="collapse-item" href="data-keuangan-siswa.html">Data Keuangan Siswa</a>
                 <a class="collapse-item" href="pembayaran-spp.html">Pembayaran SPP</a>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
             aria-expanded="true" aria-controls="collapseLaporan">
             <i class="fas fa-fw fa-chart-bar"></i>
             <span>Laporan</span>
         </a>
         <div id="collapseLaporan" class="collapse" aria-labelledby="headingLaporan"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Laporan:</h6>
                 <a class="collapse-item" href="laporan-nilai-siswa.html">Laporan Nilai Siswa</a>
                 <a class="collapse-item" href="laporan-absensi.html">Laporan Absensi</a>
                 <a class="collapse-item" href="laporan-keuangan.html">Laporan Keuangan</a>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="{{ route('dashboard') }}">
             <i class="fas fa-fw fa-cog"></i>
             <span>Pengaturan</span>
         </a>
     </li>

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

 </ul>
