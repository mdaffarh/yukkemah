{{-- Sweetalert --}}
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>
        @if (View::hasSection('title'))
            Yuk! Kemah - @yield('title')
        @else
            Yuk! Kemah - Dashboard
        @endif
    </title>
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    {{-- template css --}}
    <link rel="stylesheet" href="{{ asset('dashboard-assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">

    {{-- icon --}}
    <link rel="shortcut icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon">

    {{-- datatables & jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Select 2 Bootstrap Styles -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


</head>

<body id="page-top">
    <div id="wrapper">
        @include('sweetalert::alert')
        <nav class="navbar align-items-start sidebar accordion bg-gradient-warning p-0 navbar">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                    href="#">
                    <img src="{{ asset('img/yukkemah.png') }}" alt="" class="img-fluid w-50">
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="{{ Request::is('dashboard') ? 'active' : '' }} nav-link" href="/dashboard">
                            <i class=" fa solid fa-chart-line"></i>
                            <span class="ms-md-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/rentals*') ? 'active' : '' }} nav-link"
                            href="/dashboard/rentals"><i class="  fa solid fa-table"></i><span
                                class="ms-md-2">Penyewaan</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/payments*') ? 'active' : '' }} nav-link"
                            href="/dashboard/payments"><i class="  fa solid fa-money-bill"></i><span
                                class="ms-md-1">Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/reports*') ? 'active' : '' }} nav-link"
                            href="/dashboard/reports"><i class=" fa solid fa-file-pdf"></i><span
                                class="ms-md-2">Report</span>
                        </a>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <a class="{{ Request::is('dashboard/equipments*') ? 'active' : '' }} nav-link"
                            href="/dashboard/equipments">
                            <i class="fa solid fa-toolbox"></i>
                            <span class="ms-md-1">Peralatan</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/users*') ? 'active' : '' }} nav-link"
                            href="/dashboard/users"><i class="fas fa-user"></i><span class="ms-md-2">Pelanggan</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/categories*') ? 'active' : '' }} nav-link"
                            href="/dashboard/categories"><i class="fa solid fa-list"></i><span
                                class="ms-md-2">Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="{{ Request::is('dashboard/brands*') ? 'active' : '' }} nav-link"
                            href="/dashboard/brands"><i class="fa solid fa-certificate"></i><span
                                class="ms-md-2">Merek</span>
                        </a>
                    </li>

                </ul>
                <div class="text-center d-none d-md-inline text-dark"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar static-top navbar-light">
                    {{-- sidebar toggle --}}
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars text-warning"></i></button>
                        {{-- <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-warning py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </form> --}}
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-warning py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="badge bg-danger badge-counter">3+</span><i
                                            class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a
                                            class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i
                                                        class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i
                                                        class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i
                                                        class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your
                                                    account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500"
                                            href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img
                                            class="border rounded-circle img-profile"
                                            src="{{ asset('dashboard-assets/img/avatars/avatar1.jpeg') }}"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item"
                                            href="#"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                @yield('container')
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright Yuk! Kemah © 2024 (Template by Bootstrap
                            Studio)</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dashboard-assets/js/theme.js') }}"></script>
    <script>
        // Select2
        function select2Enabler(selectId) {
            $(document).ready(function() {
                $('.select').select2({
                    dropdownParent: $('#' + selectId),
                    theme: 'bootstrap-5',
                    placeholder: 'Pilih salah satu'
                });
            });
        }

        // Datatables
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true
            });
        });

        // Image Preview
        function previewImage(img, imgPreviewId) {
            const image = document.getElementById(img);
            const imgPreview = document.getElementById(imgPreviewId);
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        // Bootstrap Tooltip
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
    @yield('scripts')
</body>

</html>
