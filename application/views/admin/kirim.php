<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Kirim <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar File Siap Untuk Dikirim</h5>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Tanggal Permohonan</th>
                                <th>Nama</th>
                                <th>Bidang</th>
                                <th>Keperluan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($datas as $data) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $data['request_date'] ?></td>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['field_name'] ?></td>
                                        <td><?= $data['utility_name'] ?></td>
                                        <td>
                                            <button type="button" data-id="<?= $data['request_id'] ?>" id="btn-detail" class="btn btn-success btn-sm rounded" data-id="<?= $data['request_id'] ?>"><i class="fa-solid fa-envelope"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Detail Data</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <input type="hidden" name="email_data" id="email_data">
                        <input type="hidden" name="name_data" id="name_data">
                        <input type="hidden" name="receipt_number_data" id="receipt_number_data">
                        <input type="hidden" name="request_id_data" id="request_id_data">
                        <div class="col-12 d">
                            <table class="table table-borderless" id="sent-table">
                                <tr>
                                    <td><strong>Nama Pemohon</strong></td>
                                    <td>:</td>
                                    <td id="sent-name"></td>
                                </tr>
                                <tr>
                                    <td><strong>Instansi</strong></td>
                                    <td>:</td>
                                    <td id="sent-company"></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>:</td>
                                    <td id="sent-date"></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>:</td>
                                    <td id="sent-email"></td>
                                </tr>
                                <tr>
                                    <td><strong>Keperluan</strong></td>
                                    <td>:</td>
                                    <td id="sent-used"></td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Data</strong></td>
                                    <td>:</td>
                                    <td>
                                        <textarea style="resize: none;" name="data-name" id="data-name" cols="30" rows="4" class="form-control" readonly></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-send" name="btn-send" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>