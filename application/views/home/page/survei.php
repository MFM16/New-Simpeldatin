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
        <h3 class="text-white">Halaman Survei Kepuasan</h3>
    </nav>
    <div class="container-fluid">
        <h3 class="mt-3">Survey Kepuasan Pengguna</h3>
        <form>
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <div class="card">
                        <div class="card-header rounded-top" style=" background-color: #292929; color : white;">Survey Kepuasan</div>
                        <div class="card-body">
                            <label for="1a"><strong>1a. Bagaimana tingkat kepuasan Anda terhadap kemudahan persyaratan administrasi (surat pengantar/permohonan/keterangan, formulir isian, dan dokumen pendukung lainnya yang diperlukan) dalam mengajukan permohonan layanan :</strong></label>
                            <label><input type="radio" name="1a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="1a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="1a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="1a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="1b"><strong>1b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="1b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="1b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="1b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="1b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="1c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="1c"><br><br>

                            <label for="2a"><strong>2a. Bagaimana tingkat kepuasan Anda terhadap kemudahan alur proses pelayanan </strong></label><br>
                            <label><input type="radio" name="2a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="2a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="2a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="2a" value="Sangat Puas"> Sangat Puas</label><br>
                            name
                            <label for="2b"><strong>2b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="2b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="2b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="2b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="2b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="2c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="2c"><br><br>

                            <label for="3a"><strong>3a. Bagaimana tingkat kepuasan Anda terhadap kecepatan waktu dalam memberikan pelayanan : </strong></label><br>
                            <label><input type="radio" name="3a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="3a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="3a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="3a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="3b"><strong>3b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="3b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="3b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="3b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="3b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="3c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="3c"><br><br>

                            <label for="4a"><strong>4a. Bagaimana tingkat kepuasan Anda terhadap pelayanan yang diberikan tanpa dipungut biaya/tarif : </strong></label><br>
                            <label><input type="radio" name="4a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="4a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="4a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="4a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="4b"><strong>4b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="4b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="4b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="4b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="4b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="4c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="4c"><br><br>

                            <label for="5a"><strong>5a. Bagaimana tingkat kepuasan Anda terhadap jenis layanan yang kami berikan dengan yang Anda butuhkan : </strong></label><br>
                            <label><input type="radio" name="5a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="5a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="5a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="5a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="5b"><strong>5b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="5b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="5b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="5b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="5b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="5c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="5c"><br><br>

                            <label for="6a"><strong>6a. Bagaimana tingkat kepuasan Anda terhadap kompetensi/kemampuan petugas dalam memberikan pelayanan :</strong></label><br>
                            <label><input type="radio" name="6a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="6a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="6a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="6a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="6b"><strong>6b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="6b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="6b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="6b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="6b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="6c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="6c"><br><br>

                            <label for="7a"><strong>7a. Bagaimana tingkat kepuasan Anda terhadap perilaku petugas dalam memberikan pelayanan terkait kesopanan dan keramahan :</strong></label><br>
                            <label><input type="radio" name="7a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="7a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="7a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="7a" value="Sangat Puas"> Sangat Puas</label><br>
                            name
                            <label for="7b"><strong>7b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="7b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="7b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="7b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="7b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="7c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="7c"><br><br>

                            <label for="8a"><strong>8a. Bagaimana tingkat kepuasan Anda terhadap sarana dan prasarana yang tersedia :</strong></label><br>
                            <label><input type="radio" name="8a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="8a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="8a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="8a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="8b"><strong>8b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="8b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="8b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="8b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="8b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="8c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="8c"><br><br>

                            <label for="9a"><strong>9a. Jika ada pengaduan terkait Layanan Pusdatin, bagaimana tingkat kepuasan Anda terhadap penanganan pengaduan yang sesuai dengan kewenangan Pusdatin Pertanian :</strong></label><br>
                            <label><input type="radio" name="9a" value="Tidak Puas" required> Tidak Puas</label><br>
                            <label><input type="radio" name="9a" value="Kurang Puas"> Kurang Puas</label><br>
                            <label><input type="radio" name="9a" value="Puas"> Puas</label><br>
                            <label><input type="radio" name="9a" value="Sangat Puas"> Sangat Puas</label><br>

                            <label for="9b"><strong>9b. Bagaimana tingkat kepentingan pelayanan ini menurut Anda :</strong></label><br>
                            <label><input type="radio" name="9b" value="Tidak Penting" required> Tidak Penting</label><br>
                            <label><input type="radio" name="9b" value="Kurang Penting"> Kurang Penting</label><br>
                            <label><input type="radio" name="9b" value="Penting"> Penting</label><br>
                            <label><input type="radio" name="9b" value="Sangat Penting"> Sangat Penting</label><br>

                            <label for="9c"><strong>Saran atau Masukan :</strong></label><br>
                            <input type="text" class="form-control" id="9c"><br><br>

                            <input type="hidden" name="id" id="id" value="<?= $id ?>">
                            <input type="hidden" name="receipt" id="receipt" value="<?= $receipt_number ?>">
                            <input type="hidden" name="sub_field" id="sub_field" value="<?= $sub_field ?>">

                            <button class="btn btn-info rounded" type="submit" id="btn-survei">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php $this->load->view('includes/script'); ?>
</body>

</html>