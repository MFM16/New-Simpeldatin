<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Dashboard <strong>Analisis</strong></h1>

            <div class="row">
                <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <?php if ($this->session->tempdata('sub_role')) : ?>
                                                    <h5 class="card-title">Permohonan Masuk</h5>
                                                <?php else : ?>
                                                    <h5 class="card-title">Permohonan</h5>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="book-open"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($this->session->tempdata('sub_role')) : ?>
                                            <h1 class="mt-1 mb-3"><?= $request ?></h1>
                                        <?php else : ?>
                                            <h1 class="mt-1 mb-3"><?= $count ?></h1>
                                        <?php endif ?>
                                        <div class="mb-0">
                                            <span class="text-muted">Sejak tahun ini</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <?php if ($this->session->tempdata('sub_role')) : ?>
                                                    <h5 class="card-title">Permohonan Terlayani</h5>
                                                <?php else : ?>
                                                    <h5 class="card-title">Bantuan</h5>
                                                <?php endif ?>
                                            </div>

                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <?php if ($this->session->tempdata('sub_role')) : ?>
                                                        <i class="align-middle" data-feather="check"></i>
                                                    <?php else : ?>
                                                        <i class="align-middle" data-feather="book"></i>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($this->session->tempdata('sub_role')) : ?>
                                            <h1 class="mt-1 mb-3"><?= $send ?></h1>
                                        <?php else : ?>
                                            <h1 class="mt-1 mb-3"><?= $question ?></h1>
                                        <?php endif ?>
                                        <div class="mb-0">
                                            <span class="text-muted">Sejak tahun ini</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <?php if ($this->session->tempdata('sub_role')) : ?>
                                                    <h5 class="card-title">Permohonan Ditolak</h5>
                                                <?php else : ?>
                                                    <h5 class="card-title">Permohonan Terlayani</h5>
                                                <?php endif ?>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <?php if ($this->session->tempdata('sub_role')) : ?>
                                                        <i class="align-middle" data-feather="x"></i>
                                                    <?php else : ?>
                                                        <i class="align-middle" data-feather="check"></i>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if ($this->session->tempdata('sub_role')) : ?>
                                            <h1 class="mt-1 mb-3"><?= $reject ?></h1>
                                        <?php else : ?>
                                            <h1 class="mt-1 mb-3"><?= $sent ?></h1>
                                        <?php endif ?>
                                        <div class="mb-0">
                                            <span class="text-muted">Sejak tahun ini</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Buat Laporan</h5>
                    </div>
                    <div class="card-body">
                        <form class="d-flex w-100 align-items-center" action="<?= base_url('admin/report/all') ?>" method="post">
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <select name="monthFrom" id="monthFrom" class="form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php $i = 1;
                                    foreach ($bulan as $b) : ?>
                                        <option value="<?= $i ?>"><?= $b ?></option>
                                    <?php $i++;
                                    endforeach ?>
                                </select>
                            </div>
                            <strong>&nbsp;Sampai&nbsp;</strong>
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <select name="monthTo" id="monthTo" class=" form-control">
                                    <option value="">Pilih Bulan</option>
                                    <?php $i = 1;
                                    foreach ($bulan as $b) : ?>
                                        <option value="<?= $i ?>"><?= $b ?></option>
                                    <?php $i++;
                                    endforeach ?>
                                </select>
                            </div>
                            &nbsp;
                            <div class="col-12 col-lg-1 col-xxl-3 d-flex ml-2">
                                <input type="text" name="year" id="year" class="form-control" placeholder="Tahun">
                            </div>
                            &nbsp;
                            <button class="btn btn-primary" id="btn-export" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Grafik Pelayanan Masuk pada Bidang-bidang di Pusdatin Kemtan</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div class="align-self-center chart chart-lg">
                            <canvas id="chartjs-dashboard-bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Sebaran Pengakses Website SIMPELDATIN</h5>
                    </div>
                    <div class="card-body d-flex w-100">
                        <div id='map' style='width: 100%; height: 500px;'></div>
                    </div>
                </div>
            </div>
            <?php if ($this->session->tempdata('role_id') == 1) : ?>
                <div class="col-12 col-lg-6 col-xxl-6 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Penilaian User</h5>
                        </div>
                        <div class="card-body d-flex w-100">
                            <div class="col-12">
                                <div class="align-self-center">
                                    <span class="heading" style="margin-right: 5px;"><strong>Penilaian User</strong></span>
                                    <span class="fas fa-star <?= $rate >= 1 || $rate === 1 ? 'star-checked' : '' ?>"></span>
                                    <span class="fas fa-star <?= $rate >= 2 || $rate === 2 ? 'star-checked' : '' ?>"></span>
                                    <span class="fas fa-star <?= $rate >= 3 || $rate === 3 ? 'star-checked' : '' ?>"></span>
                                    <span class="fas fa-star <?= $rate >= 4 || $rate === 4 ? 'star-checked' : '' ?>"></span>
                                    <span class="fas fa-star <?= $rate >= 5 || $rate === 5 ? 'star-checked' : '' ?>"></span>
                                    <p><?= $rate ?> rata - rata dari <?= $total_data ?> pengguna.</p>
                                    <hr style="border:3px solid #f1f1f1">
                                </div>
                                <div class="col-12" style="height:300px; overflow-y:scroll; overflow-x: hidden;">
                                    <?php foreach ($ratings as $rating) : ?>
                                        <div class="card" style="border: 3px solid #F5F7FB;">
                                            <div class="card-body w-100">
                                                <div class="d-flex">
                                                    <img src="<?= base_url('assets/img/user/LogoKementan.png') ?>" alt="user image" style="border-radius: 50%; width: 100px; height: 80px;">
                                                    <div class="col-12" style="margin-left: 10px;">
                                                        <div class="col-12">
                                                            <h4><strong><?= $rating['name'] ?></strong></h4>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="fas fa-star <?= $rating['rating'] >= 1 || $rating['rating'] === 1 ? 'star-checked' : '' ?>"></span>
                                                            <span class="fas fa-star <?= $rating['rating'] >= 2 || $rating['rating'] === 2 ? 'star-checked' : '' ?>"></span>
                                                            <span class="fas fa-star <?= $rating['rating'] >= 3 || $rating['rating'] === 3 ? 'star-checked' : '' ?>"></span>
                                                            <span class="fas fa-star <?= $rating['rating'] >= 4 || $rating['rating'] === 4 ? 'star-checked' : '' ?>"></span>
                                                            <span class="fas fa-star <?= $rating['rating'] >= 5 || $rating['rating'] === 5 ? 'star-checked' : '' ?>"></span>
                                                        </div>
                                                        <div class="col-10" style=" overflow-wrap: break-word;">
                                                            <p>
                                                                <?= $rating['comment'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
    </main>