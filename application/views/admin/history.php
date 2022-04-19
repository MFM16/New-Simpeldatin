<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Riwayat <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Riwayat <?= ucfirst($sidebar) ?></h5>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($histories as $history) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $history['history_description'] ?></td>
                                        <td><?= $history['created_at'] ?></td>
                                    </tr>
                                <?php $i++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </main>