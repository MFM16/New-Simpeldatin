<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Buat Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form class="d-flex w-100 align-items-center" action="<?= base_url('admin/report/question') ?>" method="post">
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="start_date" id="start_date" required>
                            </div>
                            <strong>&nbsp;Sampai&nbsp;</strong>
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="end_date" id="end_date" required>
                            </div>
                            &nbsp;
                            <button class="btn btn-primary" id="btn-exportQuestion" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Bantuan</h5>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telepon / HP</th>
                                <th>Pesan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($questions as $question) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $question['created_at'] ?></td>
                                        <td><?= $question['name'] ?></td>
                                        <td><?= $question['email'] ?></td>
                                        <td><?= $question['phone_number'] ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-success btn-sm rounded" id="btn-bantuan" data-id="<?= $question['question_id'] ?>">
                                                <i class="fa-solid fa-envelope"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger btn-sm rounded" id="btn-delete-bantuan" data-id="<?= $question['question_id'] ?>">
                                                <i class="fa-solid fa-trash"></i>
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
    <div class="modal fade" id="modalBantuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Detail Pertanyaan</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="col-12 d">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>:</td>
                                    <td id="question-name"></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>:</td>
                                    <td id="question-date"></td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>:</td>
                                    <td id="question-email"></td>
                                </tr>
                                <tr>
                                    <td><strong>No. telepon / HP</strong></td>
                                    <td>:</td>
                                    <td id="question-phone"></td>
                                </tr>
                                <tr>
                                    <td><strong>Pesan</strong></td>
                                    <td>:</td>
                                    <td>
                                        <textarea style="resize: none;" name="bantuan" id="question-message" cols="30" rows="4" class="form-control" readonly></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>