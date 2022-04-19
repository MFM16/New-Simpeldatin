<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-3 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Pegawai</h5>
                        <a href="#modalPegawai" data-toggle="modal" data-target="#modalPegawai" class="btn btn-info btn-sm rounded mt-3"><i class="fa-solid fa-plus"></i>&nbsp;Data Pegawai</a>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>Nama Pegawai</th>
                                <th>Email</th>
                                <th>No. Telepon / HP</th>
                                <th>Jabatan</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($officers as $officer) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $officer['officer_name'] ?></td>
                                        <td><?= $officer['email'] ?></td>
                                        <td><?= $officer['phone_number'] ?></td>
                                        <td>
                                            <?php if ($officer['role_id'] == 2) : ?>
                                                <?php if ($officer['sub_field_id'] == NULL) : ?>
                                                    <?= $officer['sub_role_name'] ?>&nbsp;<?= $officer['field_name'] ?>
                                                <?php else : ?>
                                                    <?= $officer['sub_role_name'] ?>&nbsp;<?= $officer['sub_field_name'] ?>
                                                <?php endif ?>
                                            <?php else : ?>
                                                <?= $officer['role_name'] ?>
                                            <?php endif ?>
                                        </td>
                                        <td class="d-flex">
                                            <button data-id="<?= $officer['officer_id'] ?>" class="btn btn-info btn-sm rounded" type="button" id="btn-edit-officer"><i class="fa-solid fa-pencil"></i></button>
                                            &nbsp;
                                            <button type="button" data-id="<?= $officer['officer_id'] ?>" class="btn btn-danger btn-sm rounded" id="btn-delete-officer"><i class="fa-solid fa-trash"></i></button>
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
    <div class="modal fade" id="modalPegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Pegawai</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetOfficer()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error-officer">

                        </div>
                        <div class="row col-12 mt-4">
                            <input type="hidden" name="officer-id" id="officer-id">
                            <div class="form-grup col-6">
                                <label for="name-officer" style="font-weight: bold;" class="form-control-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="name-officer" id="name-officer" placeholder="Masukan nama lengkap" autocomplete="off">
                            </div>
                            <div class="form-grup col-6">
                                <label for="phone-officer" style="font-weight: bold;" class="form-control-label">No. Telepon / HP</label>
                                <input type="text" class="form-control" name="phone-officer" id="phone-officer" placeholder="Masukan nomor telepon" autocomplete="off">
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="form-grup col-6">
                                <label for="email-officer" style="font-weight: bold;" class="form-control-label">Email</label>
                                <input type="text" class="form-control" name="email-officer" id="email-officer" placeholder="Masukan alamat email" autocomplete="off">
                            </div>
                            <div class="form-grup col-6">
                                <label for="role-officer" style="font-weight: bold;" class="form-control-label">Role</label>
                                <select name="role-officer" id="role-officer" class="form-control" onchange="setRole(this)">
                                    <option value="">Pilih Role</option>
                                    <?php foreach ($roles as $role) : ?>
                                        <option value="Admin"><?= $role['role_name'] ?></option>
                                    <?php endforeach ?>
                                    <?php foreach ($sub_roles as $sub_role) : ?>
                                        <option value="<?= $sub_role['sub_role_id'] ?>"><?= $sub_role['sub_role_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="form-grup col-6">
                                <label for="field-officer" style="font-weight: bold;" class="form-control-label">Bidang</label>
                                <select name="field-officer" id="field-officer" class="form-control">
                                    <option value="">Pilih Bidang</option>
                                    <?php foreach ($fields as $field) : ?>
                                        <option value="<?= $field['field_id'] ?>"><?= $field['field_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-grup col-6">
                                <label for="sub-field-officer" style="font-weight: bold;" class="form-control-label">Sub Bidang</label>
                                <select name="sub-field-officer" id="sub-field-officer" class="form-control">
                                    <option value="">Pilih Sub Bidang</option>d
                                    <?php foreach ($sub_fields as $sub_field) : ?>
                                        <option value="<?= $sub_field['sub_field_id'] ?>"><?= $sub_field['sub_field_name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-officer" name="btn-officer" class="btn btn-info">Submit</button>
                        <button type="submit" id="btn-change-data-officer" name="btn-change-data-officer" class="btn btn-info">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>