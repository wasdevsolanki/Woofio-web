<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('vendor.dashboard') }}" class="nav-link {{ Request::is('vendor') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

<!-- QR Code Generate -->
{{--<li class="nav-item">--}}
{{--    <a href="{{ route('vendor.order.create') }}" class="nav-link {{ Request::is('vendor/order-create') ? 'active' : '' }}">--}}
{{--        <i class="nav-icon fa fa-cart-plus" aria-hidden="true"></i>--}}
{{--        <p>New Order</p>--}}
{{--    </a>--}}
{{--</li>--}}

<!-- QR Code Generate -->
{{--<li class="nav-item {{ Request::is('vendor/order/*') ? 'menu-open' : '' }}">--}}
{{--    <a href="#" class="nav-link">--}}
{{--        <i class="nav-icon fa fa-th-list" aria-hidden="true"></i>--}}
{{--        <p>My Orders--}}
{{--            <i class="fas fa-angle-left right"></i>--}}
{{--        </p>--}}
{{--    </a>--}}
{{--    <ul class="nav nav-treeview">--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 'all') }}" class="nav-link {{ Request::is('vendor/order/all') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>All Orders</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 0) }}" class="nav-link {{ Request::is('vendor/order/0') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Pending</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 1) }}" class="nav-link {{ Request::is('vendor/order/1') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Processing</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 2) }}" class="nav-link {{ Request::is('vendor/order/2') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Shipped</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 3) }}" class="nav-link {{ Request::is('vendor/order/3') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Delivered</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 4) }}" class="nav-link {{ Request::is('vendor/order/4') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Canceled</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 5) }}" class="nav-link {{ Request::is('vendor/order/5') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Return</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <!-- <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 6) }}" class="nav-link {{ Request::is('vendor/order/6') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Payment Failed</p>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="nav-item">--}}
{{--            <a href="{{ route('vendor.order', 7) }}" class="nav-link {{ Request::is('vendor/order/7') ? 'active' : '' }}">--}}
{{--                <i class="fa fa-arrow-right nav-icon" aria-hidden="true"></i>--}}
{{--                <p>Delived Failed</p>--}}
{{--            </a>--}}
{{--        </li> -->--}}
{{--    </ul>--}}
{{--</li>--}}


<!-- User Management -->
<li class="nav-item">
    <a href="{{ route('vendor.client') }}" class="nav-link
        {{ Request::is('vendor/client') ? 'active' : '' }}
        {{ Request::is('vendor/client/pets/*') ? 'active' : '' }}
    ">
        <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
        <p>Mis clientes</p>
    </a>
</li>