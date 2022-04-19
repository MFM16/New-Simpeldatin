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
            <h3 class="text-white">Halaman Katalog Data</h3>
        </div>
    </nav>
    <div class="col-3" style="margin-top: 20px;">
        <select name="category" id="category" class="form-control" onchange="category(this)">
            <option value="">Semua Data</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="container-fluid p-3">
        <table id="table_list" class="display">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Komoditas Spesifik</th>
                <th>Periode Rilis</th>
                <th>Ketersediaan</th>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($datas as $data) : ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $data['data_name'] ?></td>
                        <td><?= $data['specific_commodity'] ?></td>
                        <td><?= $data['release_period'] ?></td>
                        <td><?= $data['availability'] ?></td>
                    </tr>
                <?php $i++;
                endforeach ?>
            </tbody>
        </table>
    </div>
    <?php $this->load->view('includes/script'); ?>
</body>

</html>