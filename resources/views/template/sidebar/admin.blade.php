<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <div class="sidebar-brand-text mx-3">FTIK USM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fa-solid fa-house"></i>
            <span>Home Page</span></a>
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Menu
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#prodi" aria-expanded="true" aria-controls="prodi">
            <i class="fa-solid fa-circle-check"></i>
            <span>Penilain & Diagram</span></a>
        </a>
        <div id="prodi" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach ($data['p'] as $pr)
                <a class="collapse-item" href="{{ route($pr->kode) }}">{{ $pr->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        @foreach ($data['j'] as $jn)
        <a class="nav-link" href="{{ route($jn->kode) }}">
            @endforeach
            <i class="fa-solid fa-folder"></i>
            <span href="{{ route($jn->kode) }}">Butir Kriteria</span>
        </a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sub-butir" aria-expanded="true" aria-controls="sub-butir">
            <i class="fa-solid fa-folder-tree"></i>
            <span>Sub Butir Kriteria</span>
        </a>
        <div id="sub-butir" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('level2') }}">Level 2 (C1.x)</a>
                <a class="collapse-item" href="{{ route('level3') }}">Level 3 (C1.x.x)</a>
                <a class="collapse-item" href="{{ route('level4') }}">Level 4 (C1.x.x.x)</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#indikator" aria-expanded="true" aria-controls="indikator">
            <i class="fa-solid fa-chart-bar"></i>
            <span>Indikator Penilaian</span></a>
        </a>
        <div id="indikator" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach ($data['j'] as $j)
                <a class="collapse-item" href="{{ route('indikator-' . $j->kode) }}">{{ $j->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#element" aria-expanded="true" aria-controls="element">
            <i class="fa-brands fa-elementor"></i>
            <span>Element & Berkas</span></a>
        </a>
        <div id="element" class="collapse" aria-labelledby="heading1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach ($data['p'] as $pr)
                <a class="collapse-item" href="{{ route('element-' . $pr->kode) }}">{{ $pr->name }}</a>
                @endforeach
            </div>
        </div>
    </li>

    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('berkas') }}">
    <i class="fas fa-fw fa-cog"></i>
    <span>Unggah Berkas</span></a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('berkas') }}">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>Multi Search</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pengaturan" aria-expanded="true" aria-controls="pengaturan">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
        <div id="pengaturan" class="collapse" aria-labelledby="heading2" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('jenjang') }}">Jenjang Pendidikan</a>
                <a class="collapse-item" href="{{ route('prodi') }}">Program Studi</a>
                <a class="collapse-item" href="{{ route('target') }}">Target Pencapaian</a>
                <a class="collapse-item" href="{{ route('users') }}">Tambah User</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>