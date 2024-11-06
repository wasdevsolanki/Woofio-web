<title>Woofio</title>
<link rel="icon" type="image/png" href="/images/bg/logo-favicon.png">
<x-laravel-ui-adminlte::adminlte-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/front/css/custom.css">

    <!-- Bootstrap JS (Popper.js is required by Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{route('home')}}" class="navbar-brand">
                    <img src="/images/bg/petlogo.png" alt="No" class="brand-image img-circle ">
                    <span class="brand-text font-weight-light">Localizador Woofio</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        @if(Auth::user())

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <strong>{{ ucwords(Auth::user()->name) }}</strong>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('profile.edit')}}">Editar Perfil</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link btn btn-sm border"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <span class="nav-link">
                                    <a class="btn btn-sm btn-primary" href="{{ route('login')}}">Login</a>
                                </span>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ asset('front/js/verify_user.js')}}"></script>

    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "ordering": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "zeroRecords": "Mostrando 0 a 0 de 0 registros",
                    "infoEmpty": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente",
                    },
                    "zeroRecords": "Mostrando 0 a 0 de 0 registros",
                    "infoEmpty": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros"
                }
            });
        });

    </script>
    @stack('post_script')
    </body>
</x-laravel-ui-adminlte::adminlte-layout>
