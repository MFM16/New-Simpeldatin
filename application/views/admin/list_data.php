<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Katalog Data</h5>
                        <a href="#modalList" data-toggle="modal" data-target="#modalList" class="btn btn-info btn-sm rounded mt-3"><i class="fa-solid fa-plus"></i>&nbsp;List Data</a>
                    </div>
                    <div class="card-body">
                        <div class="col-3" style="margin-bottom: 5px;">
                            <select name="category" id="category" class="form-control" onchange="category(this)">
                                <option value="">Semua Data</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <table id="table_list" class="display">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Komoditas Spesifik</th>
                                <th>Periode Rilis</th>
                                <th>Ketersediaan</th>
                                <th>Akses</th>
                                <th>Aksi</th>
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
                                        <td>
                                            <?php if ($data['access'] != '') : ?>
                                                <a href="<?= $data['access'] ?>" target="_blank" class="btn btn-info btn-sm rounded">
                                                    <i class="fa-solid fa-link"></i>
                                                </a>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-success btn-sm rounded" type="button" data-id="<?= $data['data_id'] ?>" id="edit-list">
                                                <i class="fa-solid fa-pencil"></i>
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
    <div class="modal fade" id="modalList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Baru</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetList()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error-list"></div>
                        <input type="hidden" name="data_id" id="data_id">
                        <div class="col-12 d-flex">
                            <div class="form-grup col-6">
                                <label for="data_name" class="form-control-label">Nama Data</label>
                                <input type="text" name="data_name" id="data_name" class="form-control">
                            </div>
                            <div class="form-grup col-6" style="margin-left: 5px;">
                                <label for="data_category" class="form-control-label">Kategori Data</label>
                                <select name="data_category" id="data_category" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex" style="margin-top: 6px;">
                            <div class="form-grup col-6">
                                <label for="data_source" class="form-control-label">Sumber Data</label>
                                <input type="text" name="data_source" id="data_source" class="form-control">
                            </div>
                            <div class="form-grup col-6" style="margin-left: 5px;">
                                <div class="form-grup">
                                    <label for="data_specific" class="form-control-label">Nama Spefifik Komoditas</label>
                                    <input type="text" name="data_specific" id="data_specific" class="form-control">
                                </div>
                                <small class="text-danger">contoh : Padi, Kopi dll</small>
                            </div>
                        </div>
                        <div class="col-12 d-flex" style="margin-top: 6px;">
                            <div class="form-grup col-6">
                                <label for="data_level" class="form-control-label">Level Data</label>
                                <input type="text" name="data_level" id="data_level" class="form-control">
                            </div>
                            <div class="form-grup col-6" style="margin-left: 5px;">
                                <label for="data_availablity" class="form-control-label">Ketersediaan Data</label>
                                <input type="text" name="data_availability" id="data_availability" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 d-flex" style="margin-top: 6px;">
                            <div class="form-grup col-6">
                                <label for="data_release" class="form-control-label">Waktu Rilis</label>
                                <input type="text" name="data_release" id="data_release" class="form-control">
                            </div>
                            <div class="form-grup col-6" style="margin-left: 5px;">
                                <label for="data_period" class="form-control-label">Periode Rilis</label>
                                <input type="text" name="data_period" id="data_period" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 d-flex" style="margin-top: 6px;">
                            <div class="form-grup col-12" style="margin-left: 5px;">
                                <label for="data_access" class="form-control-label">Link Akses</label>
                                <input type="text" name="data_access" id="data_access" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-list" name="btn-list" class="btn btn-info">Submit</button>
                        <button type="submit" id="btn-editList" name="btn-editList" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>