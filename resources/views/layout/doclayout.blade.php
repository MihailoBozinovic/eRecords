<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eKarton | @yield('title')</title>
    <link rel="icon" href="{{ asset('img/notes-medical-solid.svg') }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <a href="{{ route('home.doctor') }}" class="navbar-brand mx-4 mb-3">
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
                    <a href="{{ route('home.doctor') }}" class="nav-item nav-link {{Request::is('doctor/početna')?'active':''}}"><i class="fa-solid fa-house me-2"></i>Početna</a>
                    <a href="{{ route('newPatient.doctor') }}" class="nav-item nav-link {{Request::is('doctor/noviPacijent')?'active':''}}"><i class="fa-solid fa-user-plus me-2"></i>Novi pacijent</a>
                    <a href="{{ route('pacijenti.doctor') }}" class="nav-item nav-link {{Request::is('doctor/mojiPacijenti')?'active':''}}"><i class="fa-solid fa-border-all me-2"></i>Moji pacijenti</a>
                    <a href="#" class="nav-item nav-link "><i class="fa-solid fa-earth-europe me-2"></i>Svi pacijenti</a>
                    <a href="{{ route('poruke.doctor') }}" class="nav-item nav-link {{Request::is('doctor/poruke')?'active':''}}"><i class="fa-solid fa-message me-2"></i>Poruke</a>
                    <a href="{{ route('screenixPocetna.doctor') }}" class="nav-item nav-link {{Request::is('doctor/screenix/početna')?'active':''}}"><i class="fa-solid fa-otter me-2"></i>ScreenIX</a>

                </div>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa-solid fa-hand-holding-medical me-2"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Poruke</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider" />
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider" />
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider" />
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                            <span class="d-none d-lg-inline-flex">{{ $data->name }} {{ $data->surname }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ route('vasProfil.doctor') }}" class="dropdown-item">Moj profil</a>
                            <a href="{{ route('logout') }}" class="dropdown-item">Odjavi se</a>
                        </div>
                    </div>
                </div>
            </nav>
            @if(Session::has('success'))
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center;">
                            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('success')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(Session::has('fail'))
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('fail')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/5s9r6mysn49h8w7n90rruye8a05z4af8uec0ub6erug0df1i/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#email',
            language: 'hr',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ]
        });
    </script>
    <script src="{{ asset('lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('js_built_in/main.js') }}"></script>
    <script src="{{ asset('js_built_in/doctor.js') }}"></script>
    <script src="{{ asset('js_built_in/progressbar.js') }}"></script>
    <script src="{{ asset('js_built_in/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js_built_in/select2.full.min.js') }}"></script>
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
    <script type="text/javascript">
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
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
                        3, 4, 5, 6
                    ]
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },

            });
            var mere = $('#mere').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2, 3, 4, 5, 6, 7, 8
                    ]
                }],
                order: [9, 'asc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var anamneze = $('#anamneze').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1,
                    ]
                }],
                order: [1, 'asc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var terapijeTabela = $('#terapijeTabela').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2, 3, 4, 5
                    ]
                }],
                order: [6, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var slikeTabela = $('#slike').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2,
                    ]
                }],
                order: [2, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var nalazi = $('#nalazi').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2,
                    ]
                }],
                order: [2, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var pacijentiSrce = $('#pacijentiSrce').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2, 3
                    ]
                }],
                order: [0, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
            var izvestaji = $('#srceIzvestaji').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [
                        0, 1, 2, 3, 4
                    ]
                }],
                order: [5, 'desc'],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.2/i18n/sr-SP.json'
                },
            });
        });
    </script>
    <script type="text/javascript">
        $('#search_lekovi').on('keypress', function() {
            var value = $(this).val();
            $.ajax({
                type: 'GET',
                url: "/doctor/search_lekovi",
                data: {
                    'search_lekovi': value
                },
                dataType: 'json',
                success: function(data) {
                    var lekoviBody = document.getElementById('lekovi_body');
                    setTimeout(() => {
                        lekoviBody.innerHTML = data['lekovi'];
                        $('#alert1').hide();
                    }, 4000);
                }
            });
        })
    </script>
    <script type="text/javascript">
        function dodajLek(x) {
            $('#button' + x).prop('disabled', true);
            $('#zavrsi').prop('disabled', false);
            $('#alert2').hide();
            var naziv = $("#button" + x).attr("data-naziv");
            var oblik_doza = $("#button" + x).attr("data-oblik");
            var dozvola = $("#button" + x).attr("data-dozvola");

            $("#terapija_body").append(
                '<tr>' +
                '<td>' +
                naziv +
                '</td>' +
                '<td>' +
                oblik_doza +
                '</td>' +
                '<td>' +
                dozvola +
                '</td>' +
                '<td>' +
                '<input hidden type="number" value="' + x + '" name="terapija[' + x + '][id_leka]"/>' +
                '<div class="form-floating mb-3">' +
                '<input class="form-control" placeholder="Količina" id="kolicina' + x + '" type="text" name="terapija[' + x + '][kolicina]" />' +
                '<label for="floatingInput">Količina</label>' +
                '</div>' +
                '</td>' +
                '<td>' +
                '<div class="form-floating mb-3">' +
                '<input class="form-control" placeholder="Period" id="period' + x + '" type="text" name="terapija[' + x + '][period]" />' +
                '<label for="floatingInput">Period</label>' +
                '</div>' +
                '</td>' +
                '</tr>'
            );
        }
    </script>
    <script type="text/javascript">
        <?php if (isset($rizik)) { ?>
            var rizik = <?php echo $rizik; ?>;
            let circularProgress = document.querySelector(".circular-progress");
            let progressValue = document.querySelector(".progress-value");
            <?php if (!empty($rizik)) { ?>
                var progressStartValue = 0;
                var progressEndValue = <?php echo $rizik; ?>;
                var speed = 100;
            <?php } else { ?>
                var progressStartValue = -1,
                    progressEndValue = 0,
                    speed = 100;
            <?php } ?>
            var progress = setInterval(() => {
                progressStartValue++;
                progressValue.textContent = `${progressStartValue}%`
                circularProgress.style.background = `conic-gradient(#009cff ${progressStartValue * 3.6}deg, #fff 0deg)`
                if (progressStartValue == progressEndValue) {
                    clearInterval(progress);
                }
            }, speed);
        <?php } ?>

        <?php if (isset($rizik1DC)) { ?>
            var rizik = <?php echo $rizik1DC->korak1; ?>;
            let circularProgress = document.querySelector(".circular-progress");
            let progressValue = document.querySelector(".progress-value");
            <?php if (!empty($rizik1DC)) { ?>
                var progressStartValue = 0;
                var progressEndValue = <?php echo $rizik1DC->korak1; ?>;
                var speed = 100;
            <?php } else { ?>
                var progressStartValue = -1,
                    progressEndValue = 0,
                    speed = 100;
            <?php } ?>
            var progress = setInterval(() => {
                progressStartValue++;
                progressValue.textContent = `${progressStartValue}%`
                circularProgress.style.background = `conic-gradient(#009cff ${progressStartValue * 3.6}deg, #fff 0deg)`
                if (progressStartValue == progressEndValue) {
                    clearInterval(progress);
                }
            }, speed);
        <?php } ?>

        <?php if (isset($ekg)) { ?>
            <?php if ($rizikEkg >= 0) { ?>
                var rizik1 = <?php echo $rizikEkg; ?>;
                let circularProgress1 = document.querySelector(".circular-progress");
                let progressValue1 = document.querySelector(".progress-value");
                <?php if (!empty($rizikEkg)) { ?>
                    var progressStartValue1 = 0;
                    var progressEndValue1 = <?php echo $rizikEkg; ?>;
                    var speed = 100;
                <?php } else { ?>
                    var progressStartValue1 = -1,
                        progressEndValue1 = 0,
                        speed = 100;
                <?php } ?>
                var progress1 = setInterval(() => {
                    progressStartValue1++;
                    progressValue1.textContent = `${progressStartValue1}%`
                    circularProgress1.style.background = `conic-gradient(#009cff ${progressStartValue1 * 3.6}deg, #fff 0deg)`
                    if (progressStartValue1 == progressEndValue1) {
                        clearInterval(progress1);
                    }
                }, speed);
            <?php } ?>
        <?php } ?>
    </script>

    <script type="text/javascript">
        <?php
        if (isset($rizikNavike)) {
            if ($rizikNavike->korak3_1 != 0 && isset($rizikNavike)) { ?>
                var bar1 = new ProgressBar.Line("#navikeRizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar1.animate(<?php echo $rizikNavike->korak3_1 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($rizikPosao)) {
            if ($rizikPosao->korak3_2 != 0) { ?>
                var bar2 = new ProgressBar.Line("#posaoRizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar2.animate(<?php echo $rizikPosao->korak3_2 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($rizikPorodica)) {
            if ($rizikPorodica->korak3_3 != 0) { ?>
                var bar3 = new ProgressBar.Line("#porodicaRizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar3.animate(<?php echo $rizikPorodica->korak3_3 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($rizikHrana)) {
            if ($rizikHrana->korak3_4 != 0) { ?>
                var bar4 = new ProgressBar.Line("#hranaRizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikHrana->korak3_4 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter1)) {
            if ($rizikF1 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter1Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF1 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter2)) {
            if ($rizikF2 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter2Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF2 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter3)) {
            if ($rizikF3 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter3Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF3 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter4)) {
            if ($rizikF4 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter4Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF4 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter5)) {
            if ($rizikF5 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter5Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF5 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter6)) {
            if ($rizikF6 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter6Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF6 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter7)) {
            if ($rizikF7 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter7Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF7 / 100; ?>);
        <?php }
        } ?>

        <?php
        if (isset($filter8)) {
            if ($rizikF8 != 0) { ?>
                var bar4 = new ProgressBar.Line("#filter8Rizik", {
                    strokeWidth: 4,
                    easing: 'easeInOut',
                    duration: 4000,
                    color: '#000',
                    trailColor: '#eee',
                    trailWidth: 1,
                    svgStyle: {
                        width: '100%',
                        height: '100%'
                    },
                    from: {
                        color: '#3CB043'
                    },
                    to: {
                        color: '#ED6A5A'
                    },
                    step: (state, bar) => {
                        bar.path.setAttribute('stroke', state.color);
                        bar.setText(Math.round(bar.value() * 100) + ' %');
                    }
                });
                bar4.animate(<?php echo $rizikF8 / 100; ?>);
        <?php }
        } ?>
    </script>

    <script type="text/javascript">
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        ucitajChatLekar();
    </script>

    <script type="text/javascript">
        <?php if (isset($risks)) { ?>
            const labels = <?php echo $risks ?>;
            const rizik1 = <?php echo $rizik; ?>;
            const rizik2 = 55;
            const data1 = {
                labels: labels,
                datasets: [{
                        label: 'Rizik',
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                        ],
                        data: [rizik1, null],
                        fill: true,
                    },
                    {
                        label: 'Rizik posle ispravki',
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                        ],
                        data: [null, rizik2],
                    },
                ]
            };
            const config = {
                type: 'bar',
                data: data1,
                options: {
                    skipNull: true,
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                }
            };
            const myChart = new Chart(
                document.getElementById('myChart1'),
                config
            );
        <?php } ?>
        <?php if (isset($hNiz)) { ?>
            const labels2 = <?php echo $hrana ?>;
            const data2 = {
                labels: labels2,
                datasets: [{
                        label: 'Vaša potrošnja',
                        fill: true,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgb(255, 99, 132)',
                        pointBackgroundColor: 'rgb(255, 99, 132)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(255, 99, 132)',
                        data: <?php echo $hNiz; ?>,
                    },
                    {
                        label: 'Zdrava potrošnja',
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        pointBackgroundColor: 'rgb(54, 162, 235)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgb(54, 162, 235)',
                        data: [1, 2, 1, 1, 5, 4, 2],
                    },
                ]
            };

            const config2 = {
                type: 'radar',
                data: data2,
                options: {
                    responsive: true,
                    maintainAspectRadio: true,
                    scaleOverride: true,
                    scaleSteps: 1,
                    scaleStepWidth: 20,
                    scaleStartValue: 100,
                    elements: {
                        line: {
                            borderWidth: 3
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                display: false,
                            },
                            suggestedMin: 0,
                            suggestedMax: 7,
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                }
            };
            const radarChart = new Chart(
                document.getElementById('myChart2'),
                config2
            );
        <?php } ?>
    </script>

    <script type="text/javascript">
        function provera1(that) {
            if (that.value == "1" || that.value == "2" || that.value == "3") {
                document.getElementById("p1").style.display = "block";
            } else {
                document.getElementById("p1").style.display = "none";
            }
        }

        function provera2(that) {
            if (that.value == "2" || that.value == "3") {
                document.getElementById("p2").style.display = "block";
            } else {
                document.getElementById("p2").style.display = "none";
            }
        }

        function provera3(that) {
            if (that.value == "3" || that.value == "4" || that.value == "5") {
                document.getElementById("p3").style.display = "block";
            } else {
                document.getElementById("p3").style.display = "none";
            }
        }

        function provera4(that) {
            if (that.value == "2" || that.value == "3") {
                document.getElementById("p4").style.display = "block";
            } else if (that.value == "") {

            } else {
                document.getElementById("p4").style.display = "none";
            }
        }

        function provera5(that) {
            if (that.value == "2" || that.value == "3" || that.value == "4") {
                document.getElementById("p5").style.display = "block";
            } else {
                document.getElementById("p5").style.display = "none";
            }
        }

        function provera6(that) {
            if (that.value == "1" || that.value == "2") {
                document.getElementById("p6").style.display = "block";
            } else {
                document.getElementById("p6").style.display = "none";
            }
        }

        function provera7(that) {
            if (that.value == "2" || that.value == "3" || that.value == "4") {
                document.getElementById("p7").style.display = "block";
            } else {
                document.getElementById("p7").style.display = "none";
            }
        }

        function provera8(that) {
            if (that.value == "0" || that.value == "1") {
                document.getElementById("p8").style.display = "block";
            } else if (that.value == "") {

            } else {
                document.getElementById("p8").style.display = "none";
            }
        }
    </script>
</body>

</html>