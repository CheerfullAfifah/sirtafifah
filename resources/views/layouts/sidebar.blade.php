<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon">
      <i class="fas fa-home"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Warga<span style="font-weight:300;">Kita</span></div>
  </a>

  <hr class="sidebar-divider my-0">

  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  @if (auth()->user()->isAdmin())
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Administrasi</div>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('warga') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>Data Warga</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('rumah') }}">
        <i class="fas fa-fw fa-house-user"></i>
        <span>Data Rumah</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('ipl') }}">
        <i class="fas fa-fw fa-file-invoice-dollar"></i>
        <span>Billing IPL</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('pembayaran') }}">
        <i class="fas fa-fw fa-money-check-alt"></i>
        <span>Verifikasi Pembayaran</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('surat') }}">
        <i class="fas fa-fw fa-envelope-open-text"></i>
        <span>Pengajuan Surat</span></a>
    </li>

    <hr class="sidebar-divider">
    <div class="sidebar-heading">Dokumen RT</div>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('berita-acara') }}">
        <i class="fas fa-fw fa-file-signature"></i>
        <span>Berita Acara</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('surat-undangan') }}">
        <i class="fas fa-fw fa-envelope"></i>
        <span>Surat Undangan</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('surat-keluar') }}">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Surat Keluar</span></a>
    </li>
  @else
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Layanan Warga</div>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('ipl.tagihan-saya') }}">
        <i class="fas fa-fw fa-file-invoice-dollar"></i>
        <span>Tagihan IPL</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('surat.create') }}">
        <i class="fas fa-fw fa-file-alt"></i>
        <span>Ajukan Surat</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('surat') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>Status Pengajuan</span></a>
    </li>
  @endif

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
