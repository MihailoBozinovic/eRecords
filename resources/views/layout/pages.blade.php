<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eKarton | @yield('title')</title>
    <link rel="icon" href="{{ asset('img/notes-medical-solid.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://file.myfontastic.com/FiF4U2ZokpPfSoZ6HyML94/icons.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css_built_in/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css_built_in/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="{{ route('home.admin') }}" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary">
                        <i class="fa-solid fa-hand-holding-medical me-2"></i>
                        eKarton
                    </h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{asset('img/user.png')}}" alt="" style="width: 40px; height: 40px" />
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ $data->name }} {{ $data->surname }}</h6>
                        <span>{{ $data->role }}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ route('home.admin') }}" class="nav-item nav-link {{Request::is('admin/početna')?'active':''}}"><i class="fa-solid fa-house me-2"></i>Početna</a>
                    <a href="{{ route('lekari.admin') }}" class="nav-item nav-link {{Request::is('admin/lekari')?'active':''}}"><i class="fa-solid fa-user-doctor me-2"></i>Pregled lekara</a>
                    <a href="{{ route('pacijenti.admin') }}" class="nav-item nav-link {{Request::is('admin/pacijenti')?'active':''}}"><i class="fa-solid fa-hospital-user me-2"></i>Pregled pacijenata</a>
                    <a href="{{ route('analitika.admin') }}" class="nav-item nav-link {{Request::is('admin/analitika')?'active':''}}"><i class="fa-solid fa-chart-pie me-2"></i>Analitika</a>
                    <a href="{{ route('klinika.admin') }}" class="nav-item nav-link {{Request::is('admin/klinika')?'active':''}}"><i class="fa-solid fa-house-chimney-medical me-2"></i>Klinika</a>
                    <a href="{{ route('kalendar.admin') }}" class="nav-item nav-link {{Request::is('admin/kalendar')?'active':''}}"><i class="fa-solid fa-calendar-days me-2"></i>Kalendar</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                            <span class="d-none d-lg-inline-flex">{{ $data->name }} {{ $data->surname }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Moj profil</a>
                            <a href="{{ route('logout') }}" class="dropdown-item">Odjavi se</a>
                        </div>
                    </div>
                </div>
            </nav>
            @if(Session::has('success'))
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center;">
                        <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('fail'))
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                        <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            @endif
            <!-- Navbar End -->

            @yield('content')

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">eKarton</a>, Sva prava zadržana.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa-solid fa-chevron-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('js_built_in/main.js') }}"></script>
    <script src="{{ asset('js_built_in/srce.js') }}"></script>
    <script src="{{ asset('js_built_in/select2.full.min.js') }}"></script>
    <script src="{{ asset('js_built_in/jquery.counterup.min.js') }}"></script>
    <!-- DODATNE SKRIPTE -->
    <script src="https://kit.fontawesome.com/cea0ae7111.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/sr.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/sr.js"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $('.counter').counterUp({
            delay: 20,
            time: 3000
        });

        $("#datum_rodjenja").flatpickr({
            dateFormat: "d.m.Y.",
            "locale": "sr",
        });

        $("#tezina, #visina").keyup(function() {
            update();
        });

        function update() {
            var a = $('#tezina').val();
            var b = $('#visina').val();

            var c = a / ((b / 100) * (b / 100));
            c = c.toFixed(2);
            $("#bmi").val(c);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var pacijenti = $('#pacijenti').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        3
                    ]
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                }
            });

            var lekari = $('#lekari').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 2
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });

            var terminiLekara = $('#tabela_termina').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2, 3
                    ]
                }],
                order: [4, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            $("#lekari_list").select2({
                theme: "classic"
            });
        });
    </script>
</body>

</html>