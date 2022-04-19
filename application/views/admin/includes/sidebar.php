<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/kemtan.ico">

    <title><?= $judul ?></title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link href="<?= base_url('assets/css/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <?php if ($this->session->tempdata('role_id') == 1 || $this->session->tempdata('role_id') == 2) : ?>
                    <a class="sidebar-brand" href="index.html">
                        <span class="align-middle">Admin Area</span>
                    </a>

                    <ul class="sidebar-nav">
                        <li class="sidebar-header">
                            Home
                        </li>

                        <li class="sidebar-item <?php echo ($sidebar == 'home' ? 'active' : '') ?>">
                            <a class="sidebar-link" href="<?= base_url('admin/admin') ?>">
                                <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-header">
                            Data
                        </li>

                        <li class="sidebar-item <?php echo ($sidebar == 'permohonan' ? 'active' : '') ?>">
                            <a class="sidebar-link" href="<?= base_url('admin/admin/permohonan') ?>">
                                <i class="align-middle" data-feather="book-open"></i> <span class="align-middle">Data Permohonan</span>
                            </a>
                        </li>

                        <?php if ($this->session->tempdata('role_id') == 1) : ?>
                            <li class="sidebar-item <?php echo ($sidebar == 'pegawai' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/pegawai') ?>">
                                    <i class="align-middle" data-feather="users"></i> <span class="align-middle">Data Pegawai</span>
                                </a>
                            </li>

                            <li class="sidebar-item <?php echo ($sidebar == 'bantuan' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/bantuan') ?>">
                                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Data Bantuan</span>
                                </a>
                            </li>

                            <li class="sidebar-item <?php echo ($sidebar == 'survei' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/survei') ?>">
                                    <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Data Survei</span>
                                </a>
                            </li>
                        <?php endif ?>

                        <li class="sidebar-header">
                            Katalog Data
                        </li>

                        <li class="sidebar-item <?php echo ($sidebar == 'list' ? 'active' : '') ?>">
                            <a class="sidebar-link" href="<?= base_url('admin/admin/list') ?>">
                                <i class="align-middle" data-feather="list"></i> <span class="align-middle">List Data</span>
                            </a>
                        </li>

                        <?php if ($this->session->tempdata('role_id') == 1) : ?>
                            <li class="sidebar-header">
                                Kirim Data
                            </li>

                            <li class="sidebar-item <?php echo ($sidebar == 'file' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/kirim') ?>">
                                    <i class="align-middle" data-feather="send"></i> <span class="align-middle">Kirim File</span>
                                </a>
                            </li>

                            <li class="sidebar-header">
                                Riwayat Pemohonan Data
                            </li>

                            <li class="sidebar-item <?php echo ($sidebar == 'pengiriman' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/pengiriman') ?>">
                                    <i class="align-middle" data-feather="send"></i> <span class="align-middle">Riwayat Pengiriman</span>
                                </a>
                            </li>

                            <li class="sidebar-item <?php echo ($sidebar == 'penolakan' ? 'active' : '') ?>">
                                <a class="sidebar-link" href="<?= base_url('admin/admin/penolakan') ?>">
                                    <i class="align-middle" data-feather="x"></i> <span class="align-middle">Riwayat Penolakan</span>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                <?php else : ?>
                    <div class="col-sm-12">
                        <div class="col-12 text-center mt-3">
                            <img src="<?= base_url('') ?>assets/img/user/<?= $this->session->tempdata('photo') ?>" alt="" height="150px" width="150px" style="border-radius: 50%;">
                        </div>
                        <div class="col-12 text-center">
                            <h3 style="font-weight: bold; color: white;">
                                <?= $this->session->tempdata('name') ?>
                            </h3>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <h4 style="font-weight: bold; color: white;">Instansi</h4>
                            <h5 style="font-weight: 300; color: white;"><?= $this->session->tempdata('company') ?></h5>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <h4 style="font-weight: bold; color: white;">Email</h4>
                            <h5 style="font-weight: 300; color: white;"><?= $this->session->tempdata('email') ?></h5>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <h4 style="font-weight: bold; color: white;">No. Telepon / HP</h4>
                            <h5 style="font-weight: 300; color: white;"><?= $this->session->tempdata('phone') ?></h5>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </nav>