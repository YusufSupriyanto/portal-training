<!DOCTYPE html>
<html lang="en" class="overflow-auto">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title><?= $tittle ?></title>

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://kit.fontawesome.com/90e89a2bd2.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/plugins/fontawesome-free/css/all.min.css">
        <!-- IonIcons -->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url() ?>/AdminLTE/dist/css/adminlte.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
        </script>
        <style>
        body {
            font-size: 15px;
            font-family: calibri;
        }
        </style>
    </head>
    <!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to to the body tag
to get the desired effect
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

    <body class="hold-transition sidebar-mini">
        <?php $page = basename($_SERVER['PHP_SELF']) ?>
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <!-- <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> -->

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Notifications Dropdown Menu -->
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> 4 new messages
                                <span class="float-right text-muted text-sm">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-users mr-2"></i> 8 friend requests
                                <span class="float-right text-muted text-sm">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="fas fa-file mr-2"></i> 3 new reports
                                <span class="float-right text-muted text-sm">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>/logout">Exit
                            <i class="fa fa-fw fa-arrow-circle-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="<?= base_url() ?>/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Portal Training</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?= base_url() . session()->get('image') ?>" class="img-circle elevation-2"
                                alt="User Image">
                        </div>
                        <div class="info">
                            <a href="<?= base_url() ?>/user_profile" class="d-block"><?= session()->get('nama')  ?></a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


                            <li class="nav-item">
                                <a href="<?= base_url() ?>/home_user" class="nav-link  <?php if ($page == 'home_user') : echo 'active';
                                                                                    endif; ?>">
                                    <i class="fa fa-fw  fa-home"></i>
                                    <p>Home</p>
                                </a>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-list"></i>
                                    <p>
                                        List Pengembangan
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/list_training_user" class="nav-link  <?php if ($page == 'list_training_user') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/non_training_user" class="nav-link <?php if ($page == 'non_training_user') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Non Training</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                    <p>
                                        Training
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/data_member" class="nav-link  <?php if ($page == 'data_member') : echo 'active';
                                                                                                endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Form Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/data_member_unplanned" class="nav-link  <?php if ($page == 'data_member_unplanned') : echo 'active';
                                                                                                        endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Form Unplanned Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/status_tna" class="nav-link  <?php if ($page == 'status_tna') : echo 'active';
                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Status Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/status_tna_unplanned" class="nav-link  <?php if ($page == 'status_tna_unplanned') : echo 'active';
                                                                                                        endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Status Training Unplanned</p>
                                        </a>
                                    </li>
                                    <?php if (session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/request_tna" class="nav-link  <?php if ($page == 'request_tna') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Request Training</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/request_unplanned" class="nav-link  <?php if ($page == 'request_unplanned') : echo 'active';
                                                                                                        endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Request Training Unplanned</p>
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Form IDP</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <p>
                                        Schedule Training
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/personal_schedule" class="nav-link  <?php if ($page == 'personal_schedule') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>My Schedule</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/member_schedule" class="nav-link  <?php if ($page == 'member_schedule') : echo 'active';
                                                                                                        endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Schedule</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-calendar"></i>
                                    <p>
                                        Schedule Training Unplanned
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/personal_schedule_unplanned" class="nav-link  <?php if ($page == 'personal_schedule_unplanned') : echo 'active';
                                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>My Schedule</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/member_schedule_unplanned" class="nav-link  <?php if ($page == 'member_schedule_unplanned') : echo 'active';
                                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member Schedule</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-solid fa-file-lines"></i>
                                    <p>
                                        Evaluasi Reaksi
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_reaksi" class="nav-link  <?php if ($page == 'evaluasi_reaksi') : echo 'active';
                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Personal</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_reaksi_unplanned" class="nav-link  <?php if ($page == 'evaluasi_reaksi_unplanned') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Unplanned Personal</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_reaksi_member" class="nav-link  <?php if ($page == 'evaluasi_reaksi_member_unplanned') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Member</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_reaksi_member_unplanned"
                                            class="nav-link  <?php if ($page == 'evaluasi_reaksi_member') : echo 'active';
                                                                                                                endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Unplanned Member</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa-regular fa-file-lines"></i>
                                    <p>
                                        Evaluasi Efektivitas
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_efektifitas_personal" class="nav-link  <?php if ($page == 'evaluasi_efektifitas_personal') : echo 'active';
                                                                                                        endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Personal</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_efektifitas_unplanned_personal"
                                            class="nav-link  <?php if ($page == 'evaluasi_efektifitas_unplanned_personal') : echo 'active';
                                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Unplanned Personal</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_efektifitas" class="nav-link  <?php if ($page == 'evaluasi_efektifitas') : echo 'active';
                                                                                                    endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Member</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/evaluasi_efektifitas_unplanned" class="nav-link  <?php if ($page == 'evaluasi_efektifitas_unplanned') : echo 'active';
                                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Training Unplanned Member</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="fa fa-fw  fa-history"></i>
                                    <p>
                                        History Training
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/personal_history" class="nav-link  <?php if ($page == 'personal_history') : echo 'active';
                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Personal History Training</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php if (session()->get('bagian') == 'KADEPT' || session()->get('bagian') == 'KADIV' || session()->get('bagian') == 'BOD') : ?>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="<?= base_url() ?>/member_history" class="nav-link  <?php if ($page == 'member_history') : echo 'active';
                                                                                            endif; ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Member History Training</p>
                                        </a>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>/contac_us" class="nav-link  <?php if ($page == 'contac_us') : echo 'active';
                                                                            endif; ?>">
                                    <i class="fa fa-fw  fa-phone"></i>
                                    <p>Contact Us</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <?= $this->renderSection('content') ?>
                <div class="content">

                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.0
                </div>
            </footer>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="<?= base_url() ?>/AdminLTE/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="<?= base_url() ?>/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE -->
        <script src="<?= base_url() ?>/AdminLTE/dist/js/adminlte.js"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="<?= base_url() ?>/AdminLTE/plugins/chart.js/Chart.min.js"></script>
        <script src="<?= base_url() ?>/AdminLTE/dist/js/demo.js"></script>
        <script src="<?= base_url() ?>/AdminLTE/dist/js/pages/dashboard3.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url() ?>/sweet/sweetalert2.all.min.js"></script>
        <script src="<?= base_url() ?>/sweet/training.js"></script>
        <script src="<?= base_url() ?>/sweet/setup.js"></script>

        <?= view('asset/request_tna') ?>
    </body>

</html>