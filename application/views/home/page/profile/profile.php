<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <div class="content">
        <div class="container-fluid p-0 text-center">
            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100 p-3">
                    <div class="photo">
                        <img src="<?= base_url('') ?>assets/img/user/<?= $this->session->tempdata('photo') ?>" alt="" height="200px" width="200px" style="border-radius: 50%;">
                    </div>
                    <div class="col-lg-10 mx-auto">
                        <div id="error">

                        </div>
                        <form>
                            <input type="hidden" id="role-id" name="role-id" value="<?= $this->session->tempdata('role_id') ?>">
                            <div class="form-grup">
                                <label for="name" class="inpt text-white">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="<?= $this->session->tempdata('name') ?>">
                            </div>
                            <div class="form-grup mt-2">
                                <label for="email" class="inpt text-white">Email</label>
                                <input type="text" name="email" id="email" readonly class="form-control" value="<?= $this->session->tempdata('email') ?>">
                            </div>
                            <div class="form-grup mt-2">
                                <label for="phone" class="inpt text-white">Nomor Telepon / HP</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="<?= $this->session->tempdata('phone') ?>" placeholder="Masukan Nomor Telepon / HP">
                            </div>
                            <?php if ($this->session->tempdata('role_id') == 3) : ?>
                                <div class="form-grup mt-2">
                                    <label for="job" class="inpt text-white">Pekerjaan</label>
                                    <?php if ($this->session->tempdata('job_id') != 5) : ?>
                                        <select name="job_id" id="job_id" class="form-control" onchange="otherJob(this)">
                                            <?php foreach ($jobs as $job) : ?>
                                                <?php if ($job['job_id'] == $this->session->tempdata('job_id')) : ?>
                                                    <option selected value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                                                <?php else : ?>
                                                    <option value="<?= $job['job_id'] ?>"><?= $job['job_name'] ?></option>
                                                <?php endif ?>
                                            <?php endforeach ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="text" name="other_job" id="other_job" class="form-control" value="<?= $this->session->tempdata('other_job') ?>">
                                    <?php endif ?>
                                </div>
                                <div class="form-grup mt-2" id="other_job_grup">
                                    <label for="other_job" class="inpt text-white">Pekerjaan Lainnya</label>
                                    <input type="text" name="other_job" id="other_job" class="form-control" value="<?= $this->session->tempdata('other_job') ?>">
                                </div>
                                <div class="form-grup mt-2">
                                    <label for="company" class="inpt text-white">Instansi</label>
                                    <input type="text" name="company" id="company" class="form-control" value="<?= $this->session->tempdata('company') ?>">
                                </div>
                            <?php endif ?>
                            <div class="form-grup mt-2">
                                <label for="company" class="inpt text-white">Ubah Foto</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                            </div>
                            <div class="d-flex justify-content-around mt-3">
                                <button type="sumbit" id="btn-change" class="btn btn-info rounded">Simpan Perubahan</button>
                                <button type="button" data-toggle="modal" data-target="#modalPassword" class="btn btn-secondary rounded">Ubah Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">
                        <div id="error">

                        </div>
                        <input type="hidden" name="role_id_profile" id="role_id_profile" value="<?= $this->session->tempdata('role_id') ?>">
                        <div class="form-grup mt-2">
                            <label for="emailChange" class="form-control-label">Email</label>
                            <input type="text" readonly name="email" id="emailChange" value="<?= $this->session->tempdata('email') ?>" class="form-control">
                        </div>
                        <div class="form-grup mt-2">
                            <label for="password" class="form-control-label">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-grup mt-2">
                            <label for="confirmPassword" class="form-control-label">Ulangi Password Baru</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info rounded" id="btn-password" name="btn-password">Change Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>