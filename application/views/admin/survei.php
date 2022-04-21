<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Buat Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form class="d-flex w-100 align-items-center" action="<?= base_url('admin/report/survei') ?>" method="post">
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="start_date" id="start_date" required>
                            </div>
                            <strong>&nbsp;Sampai&nbsp;</strong>
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="end_date" id="end_date" required>
                            </div>
                            &nbsp;
                            <button class="btn btn-primary" id="btn-exportSurvei" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Responden</h5>
                    </div>
                    <div class="card-body">
                        <button type="button" data-toggle="modal" data-target="#modalQuestion" class="btn btn-info btn-sm mb-2" style="margin-left: 10px;">Daftar Pertanyaan</button>
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Instansi</th>
                                <th>Email</th>
                                <th>No. Telepon / HP</th>
                                <th>Isi Survei</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($survei as $s) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $s['name'] ?></td>
                                        <td><?= $s['company'] ?></td>
                                        <td><?= $s['email'] ?></td>
                                        <td><?= $s['phone_number'] ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm rounded" type="button" data-id="<?= $s['request_id'] ?>" id="btn-detailSurvei">
                                                <i class="fa-solid fa-eye"></i>
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
    <div class="modal fade" id="modalSurvei" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Isi Survei</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetSurvei()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table">
                        <thead>
                            <th>No</th>
                            <th>Jawaban</th>
                        </thead>
                        <tbody>
                            <?php
                            $abjad = ['a', 'b', 'c'];
                            $no = 1;
                            for ($i = 1; $i < 10; $i++) : ?>
                                <?php for ($j = 0; $j < 3; $j++) : ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td id="<?= $i ?><?= $abjad[$j] ?>"></td>
                                    </tr>
                                <?php $no++;
                                endfor ?>
                            <?php endfor ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary rounded" aria-label="Close" onclick="resetSurvei()">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalQuestion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Daftar Pertanyaan</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table">
                        <thead>
                            <th>No</th>
                            <th>Pertanyaan</th>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($question as $q) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $q['question'] ?></td>
                                </tr>
                            <?php $i++;
                            endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary rounded" aria-label="Close">Close</button>
                </div>
            </div>
        </div>
    </div>