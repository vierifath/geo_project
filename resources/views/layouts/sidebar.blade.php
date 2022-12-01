<section class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
            <div class="sidebar-brand-text mx-3">Thesis</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item" id="sidebar-dashboard">
            <a class="nav-link" href="/home">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        @switch(Auth::user()->role)
        @case('0')
        <li class="nav-item" id="sidebar-soal">
            <a class="nav-link" href="/admin-question">
                <i class="fas fa-book fa-fw"></i>
                <span>Comprehensive Question Bank</span></a>
        </li>
        <!-- Nav Item - Charts -->
        <li class="nav-item" id="sidebar-rmk">
            <a class="nav-link" href="/rmk">
                <i class="fas fa-folder fa-fw"></i>
                <span>RMK</span></a>
        </li>
        <li class="nav-item" id="sidebar-mata-kuliah">
            <a class="nav-link" href="/admin-lecture-subject">
                <i class="fas fa-folder fa-fw"></i>
                <span>Lecture Subject</span></a>
        </li>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item" id="sidebar-akun">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-users"></i>
                <span>Account</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" id="akun-dosen" href="/account/dosen">Lecturer</a>
                    <a class="collapse-item" id="akun-mahasiswa" href="/account/mahasiswa">Student</a>
                    <a class="collapse-item" id="akun-dosen-luar" href="/account/dosen-eksternal">External Lecturer</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item" id="sidebar-pengaturan">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Setting</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" id="jadwal" href="/schedule">Schedule</a>
                    <a class="collapse-item" id="sidang-proposal" href="/sidang/proposal">Proposal Session</a>
                    <a class="collapse-item" id="sidang-tugas-akhir" href="/sidang/tugas-akhir">Thesis Session</a>
                    <a class="collapse-item" id="berita" href="/news">News</a>
                </div>
            </div>
        </li>

        @break
        @case('1')

        <li class="nav-item" id="sidebar-mahasiswa">
            <a class="nav-link" href="/mahasiswa">
                <i class="fas fa-users fa-fw"></i>
                <span>Student</span></a>
        </li>
        <li class="nav-item" id="sidebar-soal">
            <a class="nav-link" href="/question">
                <i class="fas fa-book fa-fw"></i>
                <span>Comprehensive Question Bank</span></a>
        </li>

        @break

        @case('2')

        <!-- Nav Item - Charts -->
        <li class="nav-item" id="sidebar-proposal">
            <a class="nav-link" href="/proposal">
                <i class="fas fa-file fa-fw"></i>
                <span>Proposal</span></a>
        </li>
        <li class="nav-item" id="sidebar-ta">
            <a class="nav-link" href="/tugas-akhir">
                <i class="fas fa-file fa-fw"></i>
                <span>Thesis</span></a>
        </li>
        <li class="nav-item" id="sidebar-logbook">
            <a class="nav-link" href="/logbook">
                <i class="fas fa-book fa-fw"></i>
                <span>Logbook</span></a>
        </li>
        @break
        @endswitch

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
        
    </ul>
    <!-- End of Sidebar -->
</section>