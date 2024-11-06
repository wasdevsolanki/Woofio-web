<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<!-- Pet List -->
<li class="nav-item">
    <a href="{{ route('admin.allpet') }}" class="nav-link {{ Request::is('admin/allpet') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th-list"></i>
        <p>Pet list</p>
    </a>
</li>

