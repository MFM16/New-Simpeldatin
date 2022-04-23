<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <div class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Riwayat <strong>Data</strong></h1>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Riwayat Permintaan Data</h5>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Tanggal Permohonan</th>
                                <th>Nama Data</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($histories as $history) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $history['created_at'] ?></td>
                                        <td><?= $history['data_name'] ?></td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>