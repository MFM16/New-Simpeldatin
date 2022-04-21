<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <div class="d-flex justify-content-between align-item-center">
                <h1 class="h3 mb-3">Detail <strong><?= ucfirst($sidebar) ?></strong></h1>
                <a href="<?= base_url('admin/admin/permohonan') ?>"><i class="fa-solid fa-arrow-left-long fa-2x" style="color: #000000"></i></a>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Nomor Resi</strong></td>
                                                <td>:</td>
                                                <td><?= $user['receipt_number'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Permohonan</strong></td>
                                                <td>:</td>
                                                <td><?= $user['request_date'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Nama Pemohon</strong></td>
                                                <td>:</td>
                                                <td><?= $user['name'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email</strong></td>
                                                <td>:</td>
                                                <td><?= $user['email'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Keperluan</strong></td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($user['used_for_id'] == 5) : ?>
                                                    <?= $user['other_used_for'] ?>
                                                <?php else : ?>
                                                    <?= $user['utility_name'] ?>
                                                <?php endif ?>
                                            </td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Instansi</strong></td>
                                            <td>:</td>
                                            <td><?= $user['company'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama Data</strong></td>
                                            <td>:</td>
                                            <td>
                                                <textarea style="resize: none;" readonly cols="30" rows="3" class="form-control"><?= $user['data_name'] ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Upload File</strong></td>
                                            <td>:</td>
                                            <td>
                                                <form class="col-sm-12 d-flex justify-content-start">
                                                    <div class="col-sm-6">
                                                        <input type="hidden" name="request_id" id="request_id" value="<?= $user['request_id'] ?>">
                                                        <input type="file" class="form-control" name="file-data" id="file-data" required>
                                                    </div>
                                                    <div class="col-sm-6" style="margin-left: 3px;">
                                                        <button type="submit" id="btn-file" name="btn-file" class="btn btn-info rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>><i class="fa-solid fa-circle-arrow-up"></i></button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php if (!empty($files)) : ?>
                                            <?php $i = 1;
                                            foreach ($files as $file) : ?>
                                                <tr class="align-item-center">
                                                    <td>File <?= $i ?></td>
                                                    <td>:</td>
                                                    <td class="col-sm-12 d-flex justify-content-start align-item-center">
                                                        <div class="col-sm-10 d-flex justify-content-start align-item-center">
                                                            <?= $file['file_name'] ?>
                                                        </div>
                                                        <div class="col-sm-2 d-flex" style="margin-left: 3px;">
                                                            <a class="btn btn-success rounded btn-sm" href="<?= base_url('request/download/') ?><?= $file['file_name'] ?>"><i class="fa-solid fa-download"></i></a>

                                                            <a class="btn btn-danger rounded btn-sm" style="margin-left: 10px;" data-id="<?= $file['file_id'] ?>" id="btn_delete_file"><i class="fa-solid fa-trash"></i></a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php $i++;
                                            endforeach ?>
                                        <?php endif ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="card">
                                    <div class="card-head" style="padding-left: 10px; padding-top: 6px;">
                                        <div class="card-title">
                                            <strong>Teruskan Permohonan</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <input type="hidden" name="id_field_dd" id="id_field_dd" value="<?= $user['field_id'] ?>">
                                            <input type="hidden" name="receipt" id="receipt" value="<?= $user['receipt_number'] ?>">
                                            <input type="hidden" name="data_name" id="data_name" value="<?= $user['data_name'] ?>">
                                            <input type="hidden" name="data_email" id="data_email" value="<?= $user['email'] ?>">
                                            <?php if ($user['used_for_id'] == 5) : ?>
                                                <input type="hidden" name="utility_name" id="utility_name" value="<?= $user['other_used_for'] ?>">
                                            <?php else : ?>
                                                <input type="hidden" name="utility_name" id="utility_name" value="<?= $user['utility_name'] ?>">
                                            <?php endif ?>

                                            <table class="table table-borderless">
                                                <tr>
                                                    <?php if ($user['field_id'] != NULL) : ?>
                                                        <td><strong>Bidang</strong></td>
                                                        <td>:</td>
                                                        <td><?= $user['field_name'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <?php if ($user['sub_field_id'] != NULL) : ?>
                                                        <td><strong>Sub Bidang</strong></td>
                                                        <td>:</td>
                                                        <td><?= $user['sub_field_name'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <?php if ($user['officer_id'] != NULL) : ?>
                                                        <td><strong>Pelaksana Tugas</strong></td>
                                                        <td>:</td>
                                                        <td><?= $user['officer_name'] ?></td>
                                                    <?php endif ?>
                                                </tr>
                                                <tr>
                                                    <?php if ($user['process_state'] == 4) : ?>
                                                        <td><strong>Admin</strong></td>
                                                        <td>:</td>
                                                        <td>Admin</td>
                                                    <?php endif ?>
                                                </tr>
                                                <?php if ($user['process_state'] != 4) : ?>
                                                    <tr>
                                                        <td>
                                                            <?php if ($this->session->tempdata('role_id') == 1) : ?>
                                                                <?php if ($user['process_state'] == 0) : ?>
                                                                    <strong>Pilih Bidang</strong>
                                                                <?php endif ?>
                                                            <?php elseif ($this->session->tempdata('role_id') == 2) : ?>
                                                                <?php if ($this->session->tempdata('sub_role') == 1) : ?>
                                                                    <?php if ($user['process_state'] == 2) : ?>
                                                                        <strong>Pilih Pelaksana Tugas</strong>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                                                    <?php if ($user['process_state'] == 1) : ?>
                                                                        <strong>Pilih Sub Bidang</strong>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 3) : ?>
                                                                    <?php if ($user['process_state'] == 3) : ?>
                                                                        <strong>Pilih Admin</strong>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($this->session->tempdata('role_id') == 1) : ?>
                                                                <?php if ($user['process_state'] == 0) : ?>
                                                                    :
                                                                <?php endif ?>
                                                            <?php elseif ($this->session->tempdata('role_id') == 2) : ?>
                                                                <?php if ($this->session->tempdata('sub_role') == 1) : ?>
                                                                    <?php if ($user['process_state'] == 2) : ?>
                                                                        :
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                                                    <?php if ($user['process_state'] == 1) : ?>
                                                                        :
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 3) : ?>
                                                                    <?php if ($user['process_state'] == 3) : ?>
                                                                        :
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                        </td>
                                                        <td class="d-flex justify-content-start">
                                                            <input type="hidden" name="id" id="id" value="<?= $user['request_id'] ?>">

                                                            <?php if ($this->session->tempdata('role_id') == 1) : ?>
                                                                <?php if ($user['process_state'] == 0) : ?>
                                                                    <select name="field" id="dd_field" class="form-control">
                                                                        <option value="">Pilih Bidang</option>
                                                                        <?php foreach ($fields as $field) : ?>
                                                                            <option value="<?= $field['field_id'] ?>"><?= $field['field_name'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            <?php elseif ($this->session->tempdata('role_id') == 2) : ?>
                                                                <?php if ($this->session->tempdata('sub_role') == 1) : ?>
                                                                    <?php if ($user['process_state'] == 2) : ?>
                                                                        <select name="officer" class="form-control" id="dd_officer">
                                                                            <option value="">Pilih Petugas Pelaksana</option>
                                                                        </select>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                                                    <?php if ($user['process_state'] == 1) : ?>
                                                                        <select name="sub_field" class="form-control" id="dd_subField">
                                                                            <option value="">Pilih Sub Bidang</option>
                                                                        </select>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 3) : ?>
                                                                    <select name="admin" id="dd_admin" class="form-control">
                                                                        <option value="">Pilih Admin</option>
                                                                        <?php foreach ($admins as $admin) : ?>
                                                                            <option value="<?= $admin['officer_id'] ?>"><?= $admin['officer_name'] ?></option>
                                                                        <?php endforeach ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            <?php endif ?>

                                                            <?php if ($this->session->tempdata('role_id') == 1) : ?>
                                                                <?php if ($user['process_state'] == 0) : ?>
                                                                    <Button type="submit" id="btn-forward" name="btn-forward" class="btn btn-info rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>><i class="fa-solid  fa-circle-right"></i></Button>
                                                                <?php endif ?>
                                                            <?php elseif ($this->session->tempdata('role_id') == 2) : ?>
                                                                <?php if ($this->session->tempdata('sub_role') == 1) : ?>
                                                                    <?php if ($user['process_state'] == 2) : ?>
                                                                        <Button type="submit" id="btn-forward" name="btn-forward" class="btn btn-info rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>><i class="fa-solid  fa-circle-right"></i></Button>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                                                    <?php if ($user['process_state'] == 1) : ?>
                                                                        <Button type="submit" id="btn-forward" name="btn-forward" class="btn btn-info rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>><i class="fa-solid  fa-circle-right"></i></Button>
                                                                    <?php endif ?>
                                                                <?php elseif ($this->session->tempdata('sub_role') == 3) : ?>
                                                                    <?php if ($user['process_state'] == 3) : ?>
                                                                        <Button type="submit" id="btn-forward" name="btn-forward" class="btn btn-info rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>><i class="fa-solid  fa-circle-right"></i></Button>
                                                                    <?php endif ?>
                                                                <?php endif ?>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="card">
                                    <div class="card-head" style="padding-left: 10px; padding-top: 6px;">
                                        <div class="card-title">
                                            <strong>Data Tidak Dapat Dipublikasikan</strong>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="text-center">
                                                    <button type="button" data-toggle="modal" data-target="#modalTolak" class=" btn btn-danger btn-sm rounded" <?php echo ($user['process_state'] == -1 ? 'disabled' : '') ?>>Tolak Permohonan Data </button>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Permohonan Khusus</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error_reject"></div>
                        <div class="form-grup d-flex">
                            <label for="reason" class="form-control-label"><strong>Tuliskan Alasan Penolakan</strong></label>
                        </div>
                        <input type="hidden" name="request_id" id="request_id" value="<?= $user['request_id'] ?>">
                        <input type="hidden" name="name" id="name" value="<?= $user['name'] ?>">
                        <input type="hidden" name="receipt_number" id="receipt_number" value="<?= $user['receipt_number'] ?>">
                        <textarea name="reason" id="reason" cols="30" rows="5" class="form-control mt-3" style="resize: none;"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-reject" name="btn-reject" class="btn btn-danger">Tolak Permohonan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>