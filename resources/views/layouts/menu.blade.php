{{--<li class="nav-item">--}}
{{--    <a href="{{ route('admin') }}" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">--}}
{{--        <i class="nav-icon fas fa-home"></i>--}}
{{--        <p>Dashboard</p>--}}
{{--    </a>--}}
{{--</li>--}}

<!-- Pet List -->
<li class="nav-item">
    <a href="{{ route('admin.allpet') }}" class="nav-link {{ Request::is('admin/allpet') ? 'active' : '' }}">
        <i class="nav-icon fa fa-paw" aria-hidden="true"></i>
        <p>Pet list</p>
    </a>
</li>

<!-- QR Code Generate -->
<li class="nav-item">
    <a href="{{ route('admin.self.order.create') }}" class="nav-link {{ Request::is('admin/self-order') ? 'active' : '' }}">
        <i class="nav-icon fa fa-cubes" aria-hidden="true"></i>
        <p>Self Order</p>
    </a>
</li>

<!-- QR Code Generate -->
<li class="nav-item {{ Request::is('admin/order/*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-shopping-cart" aria-hidden="true"></i>
        <p>Orders
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.order', 'all') }}" class="nav-link {{ Request::is('admin/order/all') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>All Orders</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 0) }}" class="nav-link {{ Request::is('admin/order/0') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Pending</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 1) }}" class="nav-link {{ Request::is('admin/order/1') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Processing</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 2) }}" class="nav-link {{ Request::is('admin/order/2') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Shipped</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 3) }}" class="nav-link {{ Request::is('admin/order/3') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Delivered</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 4) }}" class="nav-link {{ Request::is('admin/order/4') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Canceled</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 5) }}" class="nav-link {{ Request::is('admin/order/5') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Return</p>
            </a>
        </li>
        <!-- <li class="nav-item">
            <a href="{{ route('admin.order', 6) }}" class="nav-link {{ Request::is('admin/order/6') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Payment Failed</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.order', 7) }}" class="nav-link {{ Request::is('admin/order/7') ? 'active' : '' }}">
                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>
                <p>Delived Failed</p>
            </a>
        </li> -->
    </ul>
</li>

<!-- User Management -->
<li class="nav-item">
    <a href="{{ route('admin.user') }}" class="nav-link {{ Request::is('admin/user') ? 'active' : '' }}">
        <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
        <p>Vendors</p>
    </a>
</li>