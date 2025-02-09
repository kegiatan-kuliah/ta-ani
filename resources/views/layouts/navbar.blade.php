<ul class="navbar-nav">
  <li class="nav-item">
    <a class="nav-link" href="./">
      <span class="nav-link-title">Beranda</span>
    </a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
      <span class="nav-link-title">
        Asset
      </span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{ route('group.index') }}" rel="noopener">
        Grup
      </a>
      <a class="dropdown-item" href="{{ route('location.index') }}">
        Lokasi
      </a>
      <a class="dropdown-item" href="{{ route('category.index') }}" rel="noopener">
        Kelompok
      </a>
      <a class="dropdown-item" href="{{ route('asset.index') }}" rel="noopener">
        Katalog
      </a>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('employee.index') }}">
      <span class="nav-link-title">Pegawai</span>
    </a>
  </li>
</ul>