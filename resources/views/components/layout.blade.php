<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{ $title }} - Certainty Factor Sawit</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @if (Request::is('consultation'))
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endif
    <link rel="icon" href="{{ asset('img/kaiadmin/favicon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="blue2">
                    <a href="/" class="logo text-white fw-bold fs-3">
                        {{-- <img src="{{ asset('img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                            height="20" /> --}}
                        Diagnosa
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>

            <x-sidebar></x-sidebar>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="blue">
                        <a href="/" class="logo">
                            <img src="{{ asset('img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <x-navbar></x-navbar>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <ul class="breadcrumbs ms-0 ps-3 mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">{{ $title }}</a>
                            </li>
                        </ul>
                    </div>

                    {{ $slot }}
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        Copyright &copy; 2024, Certainty Factor
                    </div>
                </div>
            </footer>
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('js/kaiadmin.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    @if (Request::is('consultation'))
        <script src="{{ asset('js/script-consultation.js') }}"></script>
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    swal({
                        title: "Hapus Data?",
                        text: "Data yang telah dihapus tidak akan bisa dikembalikan!",
                        icon: "warning",
                        buttons: {
                            confirm: {
                                text: "Yes, delete it!",
                                className: "btn btn-success",
                            },
                            cancel: {
                                visible: true,
                                className: "btn btn-danger",
                            },
                        },
                    }).then((Delete) => {
                        if (Delete) {
                            this.submit();
                        } else {
                            swal.close();
                        }
                    });
                });
            });

            document.getElementById('logoutBtn').addEventListener('submit', function(e) {
                e.preventDefault();

                swal({
                    title: "Keluar?",
                    text: "Terimakasih telah menggunakan sistem ini",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: "Logout",
                            className: "btn btn-success",
                        },
                        cancel: {
                            visible: true,
                            className: "btn btn-danger",
                        },
                    },
                }).then((Delete) => {
                    if (Delete) {
                        this.submit();
                    } else {
                        swal.close();
                    }
                });
            });
        });
    </script>

    @session('alert')
        <script>
            swal("{{ session('title') }}", "{{ session('alert') }}", {
                icon: "{{ session('type') }}",
                buttons: {
                    confirm: {
                        className: "btn btn-{{ session('type') }}",
                    },
                },
            });
        </script>
    @endsession

</body>

</html>
