<section id="form">
    <div class="col-lg-12 mb-3">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <h3 style="font-weight: bold; margin-bottom: 34px; text-align: center; color: #42b863;">Cari Nomor Resi</h3>
                <form>
                    <div id="error_receipt" style="margin-bottom: 4px;"></div>
                    <div class="d-flex">
                        <input type="text" class="form-control" name="receipt_number" id="field_receipt" required>
                        <button class="btn btn-info rounded" type="submit" id="btn-receipt" name="btn-receipt"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 mx-auto">
                <div>
                    <h3 style="font-weight: bold; margin-bottom: 25px; text-align: center; color: #42b863;">Form Permintaan Data</h3>
                    <div id="error"> </div>
                    <form>
                        <?= $this->session->tempdata('role_id') ? '' : '<small class="text-danger">* Untuk mengajukan permohonan data, silahkan melakukan login terlebih dahulu</small>' ?>
                        <div class="form-grup">
                            <label for="field_name" class="inpt">Nama Lengkap</label>
                            <?php if (isset($user)) : ?>
                                <input type="text" class="form-control" name="name" id="field_name" value="<?= $user['name'] ?>">
                            <?php else : ?>
                                <input type="text" class="form-control" name="name" id="field_name" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                            <?php endif ?>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="field_job" class="inpt">Pekerjaan</label>
                            <select name="job" id="field_job" class="form-control" onchange="otherJob(this)" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                                <option value="">Pilih pekerjaan</option>
                                <?php foreach ($jobs as $job) : ?>
                                    <?php if (isset($user)) : ?>
                                        <?php if ($user['job_id'] == $job['job_id']) : ?>
                                            <option selected value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                                        <?php endif ?>
                                        <option value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                                    <?php else : ?>
                                        <option value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-grup mt-2" id="other_job_grup">
                            <label for="field_other_job" class="inpt">Pekerjaaan Lain</label>
                            <input type="text" class="form-control" name="other_job" id="field_other_job" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="field_Company" class="inpt">Instansi</label>

                            <?php if (isset($user)) : ?>
                                <input type="text" class="form-control" name="Company" id="field_company" value="<?= $user['company'] ?>">
                            <?php else : ?>
                                <input type="text" class="form-control" name="Company" id="field_company" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                            <?php endif ?>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="field_Company" class="inpt">Jenis Kelamin</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1" value="1" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                                <label class="form-check-label">Laki - laki</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio1" value="2" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                                <label class="form-check-label">Perempuan</label>
                            </div>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="field_phone" class="inpt">Nomor Telepon / HP</label>
                            <?php if (isset($user)) : ?>
                                <input type="text" class="form-control" name="phone" id="field_phone" value="<?= $user['phone_number'] ?>">
                            <?php else : ?>
                                <input type="text" class="form-control" name="phone" id="field_phone" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                            <?php endif ?>
                        </div>
                        <div class="form-grup mt-2">
                            <label for="field_email" class="inpt">Email</label>
                            <?php if (isset($user)) : ?>
                                <input type="text" class="form-control" name="email" id="field_email" value="<?= $user['email'] ?>" readonly>
                            <?php else : ?>
                                <input type="text" class="form-control" name="email" id="field_email" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                            <?php endif ?>
                        </div>
                        <div class="form-grup mt-2 mb-3">
                            <label for="field_used" class="inpt">Digunakan untuk</label>
                            <select name="used" id="field_used" class="form-control" onchange="otherUsed(this)" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                                <option value="">Pilih</option>
                                <?php foreach ($utilities as $utility) : ?>
                                    <option value="<?= $utility['utility_id'] ?>"><?= $utility['utility_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-grup mb-3" id="other_used_grup">
                            <label for="field_other_used" class="inpt">Digunakan untuk lainnya</label>
                            <input type="text" class="form-control" name="other_used" id="field_other_used" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>
                        </div>
                        <div class="form-grup mt-2 mb-3">
                            <label for="field_data_name" class="inpt">Nama Data</label>
                            <textarea name="data_name" id="field_data_name" cols="30" rows="5" class="form-control" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>></textarea>
                        </div>
                        <button id="btn-submit" type="submit" class="btn btn-info rounded" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>Submit</button>
                        <button class="btn btn-secondary rounded" type="reset" <?= $this->session->tempdata('role_id') ? '' : 'disabled' ?>>Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>