<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, resize=none">
    <title><?= $judul ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/kemtan.ico">
    <?php $this->load->view('includes/style') ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #42B863;">
        <div class=" col d-flex align-items-center">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('assets/img/Logokementan.svg') ?>" width="50" height="50" class="d-inline-block align-top" alt="">
            </a>
            <h3 class="text-white">Halaman Pencarian Resi</h3>
        </div>
        <a href="<?= base_url() ?>"><i class="fa-solid fa-arrow-left-long fa-2x" style="color: #ffffff"></i></a>
    </nav>
    <div class="container-fluid mt-5">
        <div class="col-6 mx-auto">
            <h4 style="font-weight: bold; margin-bottom: 34px; text-align: center; color: #42b863;">Cari Nomor Resi</h4>
            <form>
                <div id="error_receipt" style="margin-bottom: 4px;"></div>
                <div class="d-flex">
                    <input type="text" class="form-control" name="receipt_number" id="field_receipt" required>
                    <button class="btn btn-info rounded" type="submit" id="btn-receipt" name="btn-receipt"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="col-12">
                <div class="checkout-wrap col-md-12 col-sm-12 col-xs-12 pull-right">
                    <ul class="checkout-bar">
                        <li class="<?php if ($data['process_state'] == 0) {
                                        echo "active";
                                        $status = 'Permohonan Diterima';
                                    } elseif ($data['process_state'] > 0) {
                                        echo "visited";
                                    } ?>"><a href="#">Permohonan Diterima</a></li>

                        <li class="<?php if ($data['process_state'] == 1) {
                                        echo "active";
                                        $status = 'Verifikasi';
                                    } elseif ($data['process_state'] > 1) {
                                        echo "visited";
                                    } ?>"><a style="margin : auto;" href="#">Verifikasi</a></li>

                        <li class="<?php if ($data['process_state'] == 2) {
                                        echo "active";
                                        $status = 'Proses';
                                    } elseif ($data['process_state'] > 2) {
                                        echo "visited";
                                    } ?>"><a style="margin : auto;" href="#">Proses</a></li>

                        <li class="<?php if ($data['process_state'] == 3) {
                                        echo "active";
                                        $status = 'Unggah Berkas';
                                    } elseif ($data['process_state'] > 3) {
                                        echo "visited";
                                    } ?>"><a style="margin : auto;" href="#">Unggah Berkas</a></li>

                        <li class="<?php if ($data['process_state'] == 4) {
                                        echo "active";
                                        $status = 'Kirim Berkas';
                                    } elseif ($data['process_state'] > 4) {
                                        echo "visited";
                                    } ?>"><a style="margin : auto;" href="#">Kirim Berkas</a></li>

                        <li class="<?php if ($data['process_state'] == 5) {
                                        echo "finished";
                                        $status = 'Permohonan Selesai, Silahkan Isi Survey Terlebih Dahulu !';
                                    } elseif ($data['process_state'] > 5) {
                                        echo "visited";
                                    } ?>"><a href="#">Permohonan Selesai, Silahkan Isi Survey Terlebih Dahulu !</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="margin-top: 23%;">
            <div class="col-6">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Nomor Resi</strong></td>
                        <td>:</td>
                        <td><?= $data['receipt_number'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>:</td>
                        <td><?= $data['name'] ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>:</td>
                        <td><?= $status ?></td>
                    </tr>
                </table>
            </div>
            <?php if ($data['survey_status'] == 1) : ?>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <th>No.</th>
                            <th>Nama File</th>
                            <th>Link Unduh</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php
                            $date = $expired['expired_date'];
                            $detail = explode('-', $date);

                            $exp = mktime(0, 0, 0, $detail[1], $detail[2], $detail[0]);
                            $now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

                            $expired = $exp - $now;
                            ?>
                            <?php $i = 1;
                            foreach ($files as $file) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $file['file_name'] ?></td>
                                    <td>
                                        <a class="btn btn-info rounded btn-sm <?= $expired <= 0 ? 'disabled' : '' ?>" href="<?= base_url('request/download/') ?><?= $file['file_name'] ?>"><i class="fa-solid fa-download"></i></a>
                                    </td>
                                    <td>
                                        <?= $expired <= 0 ? '<p class="text-danger">File Anda Kadaluarsa</p>' : 'File Dapat Diunduh Sampai Tanggal <strong>' . $date . '</strong>' ?>
                                    </td>
                                </tr>
                            <?php $i++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php endif ?>
            <?php if ($data['survey_status'] == NULL && $data['process_state'] == 5) : ?>
                <div class="col-4" style="margin-bottom: 10px;">
                    <a href="<?= base_url('survei/form/') ?><?= $data['request_id'] ?>/<?= $data['receipt_number'] ?>/<?= $data['sub_field_id'] ?>" class="btn btn-info rounded">
                        Survey Kepuasan
                    </a>
                </div>
            <?php endif ?>
        </div>
    </div>
    <?php $this->load->view('includes/script'); ?>
</body>

</html>