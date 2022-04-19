<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/kemtan.ico">
    <?php $this->load->view('includes/style') ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #42B863;">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url('assets/img/Logokementan.svg') ?>" width="50" height="50" class="d-inline-block align-top" alt="">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <?php if ($this->session->tempdata('role_id')) : ?>
                <?php if ($this->session->tempdata('role_id') == 3) : ?>
                    <a href="<?= base_url('profile') ?>"><img src="<?= base_url() ?>assets/img/user/<?= $this->session->tempdata('photo') ?>" width="50" height="50" style="border-radius: 50%;" class="d-inline-block align-top" alt=""></a>
                <?php else : ?>
                    <a style="font-weight: bold;" class="btn text-white" href="<?= base_url('auth/login') ?>">Login</a>
                <?php endif ?>
            <?php else : ?>
                <a style="font-weight: bold;" class="btn text-white" href="<?= base_url('auth/login') ?>">Login</a>
            <?php endif ?>
        </div>
    </nav>