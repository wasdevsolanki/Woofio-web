<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.allpet') }}" class="brand-link text-center">
        <span class="brand-text fw-semi-bold">Panel de Vendedor</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('vendor.layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
