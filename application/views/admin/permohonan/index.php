<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Buat Laporan Data Khusus</h5>
                    </div>
                    <div class="card-body">
                        <form class="d-flex w-100 align-items-center" action="<?= base_url('admin/report/list') ?>" method="post">
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="start_date" id="start_date" required>
                            </div>
                            <strong>&nbsp;Sampai&nbsp;</strong>
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="end_date" id="end_date" required>
                            </div>
                            <input type="hidden" id="special" name="special" value="1">
                            <?php if ($this->session->tempdata('sub_role') == 3) : ?>
                                <input type="hidden" id="officer_id" name="officer_id" value="<?= $this->session->tempdata('officer') ?>">
                            <?php elseif ($this->session->tempdata('sub_role') == 1) : ?>
                                <input type="hidden" id="sub_field_id" name="sub_field_id" value="<?= $this->session->tempdata('sub_field') ?>">
                            <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                <input type="hidden" id="field_id" name="field_id" value="<?= $this->session->tempdata('field') ?>">
                            <?php endif ?>
                            &nbsp;
                            <button class="btn btn-primary" id="btn-exportSpecial" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Permohonan Data Khusus</h5>
                        <button type="button" data-toggle="modal" data-target="#modalKhusus" class=" btn btn-info btn-sm rounded mt-3"><i class="fa-solid fa-plus"></i>&nbsp;Data Permohonan Khusus
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Instansi</th>
                                <th>Keperluan</th>
                                <th>Pelaksana Tugas</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($specials as $special) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $special['request_date'] ?></td>
                                        <td><?= $special['name'] ?></td>
                                        <td><?= $special['company'] ?></td>
                                        <td>
                                            <?php if ($special['used_for_id'] == 5) : ?>
                                                <?= $special['other_used_for'] ?>
                                            <?php else : ?>
                                                <?= $special['utility_name'] ?>
                                            <?php endif ?>
                                        </td>
                                        <td><?= $special['officer_name'] ?></td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('admin/request/process/') ?><?= $special['request_id'] ?>" class="btn btn-success btn-sm rounded <?php echo ($special['process_state'] == -1 ? 'disabled' : '') ?>">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                            &nbsp;
                                            <button class="btn btn-info btn-sm rounded" type="button" id="btnedit_special" data-id="<?= $special['request_id'] ?>" <?php echo ($special['process_state'] == -1 ? 'disabled' : '') ?>>
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            &nbsp;
                                            <button class="btn btn-danger btn-sm rounded" type="button" id="btn_delete_request" data-id="<?= $special['request_id'] ?>">
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
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Buat Laporan Semua Data</h5>
                    </div>
                    <div class="card-body">
                        <form class="d-flex w-100 align-items-center" action="<?= base_url('admin/report/list') ?>" method="post">
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="start_date" id="start_date" required>
                            </div>
                            <strong>&nbsp;Sampai&nbsp;</strong>
                            <div class="col-12 col-lg-2 col-xxl-3 d-flex">
                                <input class="form-control" type="date" name="end_date" id="end_date" required>
                            </div>
                            <input type="hidden" id="special" name="special" value="0">
                            <?php if ($this->session->tempdata('sub_role') == 3) : ?>
                                <input type="hidden" id="officer_id" name="officer_id" value="<?= $this->session->tempdata('officer') ?>">
                            <?php elseif ($this->session->tempdata('sub_role') == 1) : ?>
                                <input type="hidden" id="sub_field_id" name="sub_field_id" value="<?= $this->session->tempdata('sub_field') ?>">
                            <?php elseif ($this->session->tempdata('sub_role') == 2) : ?>
                                <input type="hidden" id="field_id" name="field_id" value="<?= $this->session->tempdata('field') ?>">
                            <?php endif ?>
                            &nbsp;
                            <button class="btn btn-primary" id="btn-exportGeneral" type="submit">Export</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Seluruh Permohonan Data</h5>
                    </div>
                    <div class="card-body w-100">
                        <table id="myTable" class="display">
                            <thead>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Sub Bidang</th>
                                <th>Dateline</th>
                                <th>Tanggal Terkirim</th>
                                <th>Respon</th>
                                <th>Keperluan</th>
                                <th>Nama Data</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($generals as $general) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $general['request_date'] ?></td>
                                        <td><?= $general['name'] ?></td>
                                        <td><?= $general['sub_field_name'] ?></td>
                                        <?php if ($general['process_state'] == 5) : ?>
                                            <td class="bg-success text-white">
                                                Terkirim
                                            </td>
                                        <?php elseif ($general['process_state'] == -1) : ?>
                                            <td class="bg-danger text-white">
                                                Ditolak
                                            </td>
                                        <?php else : ?>
                                            <?php if ($general['dateline'] == NULL) : ?>
                                                <td class="bg-dark text-white">
                                                    Belum Ditentukan
                                                </td>
                                            <?php else : ?>
                                                <td class="bg-warning text-white">
                                                    <?= $general['dateline'] ?>
                                                </td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <td><?= $general['final_process'] ?></td>
                                        <td> <?= $general['process_name'] ?> </td>
                                        <td>
                                            <?php if ($general['used_for_id'] == 5) : ?>
                                                <?= $general['other_used_for'] ?>
                                            <?php else : ?>
                                                <?= $general['utility_name'] ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?= $general['data_name'] ?>
                                        </td>
                                        <td class="d-flex">
                                            <a href="<?= base_url('admin/request/process/') ?><?= $general['request_id'] ?>" class="btn btn-success btn-sm rounded <?php echo ($general['process_state'] == -1 ? 'disabled' : '') ?>">
                                                <i class="fa-solid fa-envelope"></i>
                                            </a>
                                            &nbsp;
                                            <button class="btn btn-info btn-sm rounded" type="button" id="btnedit_general" data-id="<?= $general['request_id'] ?>" <?php echo ($general['process_state'] == -1 ? 'disabled' : '') ?>>
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            &nbsp;
                                            <button class="btn btn-danger btn-sm rounded" type="button" id="btn_delete_request" data-id="<?= $general['request_id'] ?>">
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
    <div class="modal fade" id="modalPermohonan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Permohonan</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset_permohonan()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error-general"></div>
                        <input type="hidden" id="id-general" name="id-general">
                        <div class="row col-12">
                            <div class="form-grup col-6">
                                <label for="name-general" style="font-weight: bold;" class="form-control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name-general" id="name-general" placeholder="Masukan nama lengkap anda">
                            </div>
                            <div class="form-grup col-6">
                                <label for="company-general" style="font-weight: bold;" class="form-control-label">Instansi</label>
                                <input type="text" class="form-control" name="company-general" id="company-general" placeholder="Masukan nama instansi anda">
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="form-grup col-6">
                                <label for="used-general" style="font-weight: bold;" class="form-control-label">Keperluan</label>
                                <select name="used-general" id="used-general" class="form-control" onchange="setUtility(this)">
                                    <option value="">Pilih Keperluan</option>
                                    <?php foreach ($utilities as $utility) : ?>
                                        <option value="<?= $utility['utility_id'] ?>"><?= $utility['utility_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-grup col-6">
                                <label for="field-general" style="font-weight: bold;" class="form-control-label">Bidang</label>
                                <select name="field-general" id="field-general" class="form-control">
                                    <option value="">Pilih Bidang</option>
                                    <?php foreach ($fields as $field) : ?>
                                        <option value="<?= $field['field_id'] ?>"><?= $field['field_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-grup mt-3" id="other-used">
                            <label for="other-used-general" style="font-weight: bold;" class="form-control-label">Keperluan Lain</label>
                            <input type="text" id="other-used-general" name="other-used-general" class="form-control">
                        </div>
                        <div class="form-grup mt-3">
                            <label for="data-name-general" style="font-weight: bold;" class="form-control-label">Nama Data</label>
                            <textarea class="form-control" name="data-name-general" id="data-name-general" cols="30" rows="3" style="resize: none;"></textarea>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="form-grup col-6">
                                <label for="email-general" style="font-weight: bold;" class="form-control-label">Email</label>
                                <input type="text" class="form-control" name="email-general" id="email-general" placeholder="Masukan alamat email anda" readonly>
                            </div>
                            <div class="form-grup col-6">
                                <label for="phone-general" style="font-weight: bold;" class="form-control-label">No. Telepon / HP</label>
                                <input type="text" class="form-control" name="phone-general" id="phone-general" placeholder="Masukan nomor telepon anda">
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="form-grup col-12">
                                <label for="expired-general" style="font-weight: bold;" class="form-control-label">Dateline</label>
                                <select name="expired-general" id="expired-general" class="form-control">
                                    <option value="">Pilih lamanya waktu pemrosesan</option>
                                    <?php for ($i = 1; $i < 8; $i++) : ?>
                                        <option value="<?= $i ?>"><?= $i ?>&nbsp;Hari</option>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-general" name="btn-general" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalKhusus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Permohonan Khusus</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="reset_khusus()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error-special"></div>
                        <input type="hidden" id="id-special" name="id-special">
                        <div class="row col-12 ">
                            <div class="form-grup col-6">
                                <label for="name-special" style="font-weight: bold;" class="form-control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name-special" id="name-special" placeholder="Masukan nama lengkap anda">
                            </div>
                            <div class="form-grup col-6">
                                <label for="company-special" style="font-weight: bold;" class="form-control-label">Instansi</label>
                                <input type="text" class="form-control" name="company-special" id="company-special" placeholder="Masukan nama instansi anda">
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="form-grup col-6">
                                <label for="used-special" style="font-weight: bold;" class="form-control-label">Keperluan</label>
                                <select name="used-special" id="used-special" class="form-control" onchange="setUtilitySpecial(this)">
                                    <option value="">Pilih Keperluan</option>
                                    <?php foreach ($utilities as $utility) : ?>
                                        <option value="<?= $utility['utility_id'] ?>"><?= $utility['utility_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-grup col-6">
                                <label for="field-special" style="font-weight: bold;" class="form-control-label">Bidang</label>
                                <select name="field-special" id="field-special" class="form-control">
                                    <option value="">Pilih Bidang</option>
                                    <?php foreach ($fields as $field) : ?>
                                        <option value="<?= $field['field_id'] ?>"><?= $field['field_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-grup mt-3" id="other_used_special">
                            <label for="other-used-special" style="font-weight: bold;" class="form-control-label">Keperluan Lain</label>
                            <input type="text" class="form-control" name="otherused-special" id="otherused-special" ;>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="data-name-special" style="font-weight: bold;" class="form-control-label">Nama Data</label>
                            <textarea class="form-control" name="data-name-special" id="data-name-special" cols="30" rows="3" style="resize: none;"></textarea>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="form-grup col-6">
                                <label for="email-special" style="font-weight: bold;" class="form-control-label">Email ( Opsional )</label>
                                <input type="text" class="form-control" name="email-special" id="email-special" placeholder="Masukan alamat email anda">
                            </div>
                            <div class="form-grup col-6">
                                <label for="phone-special" style="font-weight: bold;" class="form-control-label">No. Telepon / HP ( Opsional )</label>
                                <input type="text" class="form-control" name="phone-special" id="phone-special" placeholder="Masukan nomor telepon anda">
                            </div>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="evidence" style="font-weight: bold;" class="form-control-label">Bukti Fisik ( Opsional )</label>
                            <input type="file" class="form-control" name="evidence" id="evidence">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-special" name="btn-special" class="btn btn-primary">Submit</button>
                        <button type="submit" id="btn_edit_special" name="btn_edit_special" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>