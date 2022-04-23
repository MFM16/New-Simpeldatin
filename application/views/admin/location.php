<div class="main">
    <?php $this->load->view('admin/includes/navbar') ?>
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Data <strong><?= ucfirst($sidebar) ?></strong></h1>

            <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Lokasi</h5>
                        <button type="button" data-toggle="modal" data-target="#modalLokasi" class=" btn btn-info btn-sm rounded mt-3"><i class="fa-solid fa-plus"></i>&nbsp;Data Lokasi
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                                <th>No</th>
                                <th>BPP</th>
                                <th>Kota</th>
                                <th>Kecamatan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($places as $place) : ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $place['name'] ?></td>
                                        <td><?= $place['city'] ?></td>
                                        <td><?= $place['district'] ?></td>
                                        <td><?= $place['address'] ?></td>
                                        <td class="d-flex">
                                            <button class="btn btn-info btn-sm rounded" type="button" id="btnedit_place" data-id="<?= $place['place_id'] ?>">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                            &nbsp;
                                            <button class="btn btn-danger btn-sm rounded" type="button" id="btn_delete_place" data-id="<?= $place['place_id'] ?>">
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
        </div>
    </main>
    <div class="modal fade" id="modalLokasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><strong>Tambah Data Permohonan Khusus</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetPlace()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-place">
                    <div class="modal-body">
                        <div id="error-place"></div>
                        <input type="hidden" id="id-place" name="id-place">
                        <div class="row col-12 ">
                            <div class="form-grup col-6">
                                <label for="name-place" style="font-weight: bold;" class="form-control-label">Nama</label>
                                <input type="text" class="form-control" name="name-place" id="name-place" placeholder="masukan nama">
                            </div>
                            <div class="form-grup col-6">
                                <label for="city-place" style="font-weight: bold;" class="form-control-label">Kota</label>
                                <input type="text" class="form-control" name="city-place" id="city-place" placeholder="masukan nama kota">
                            </div>
                        </div>
                        <div class="row col-12 ">
                            <div class="form-grup col-6">
                                <label for="district-place" style="font-weight: bold;" class="form-control-label">Kecamatan</label>
                                <input type="text" class="form-control" name="district-place" id="district-place" placeholder="masukan nama kecamatan">
                            </div>
                            <div class="form-grup col-6">
                                <label for="address-place" style="font-weight: bold;" class="form-control-label">Alamat</label>
                                <input type="text" class="form-control" name="address-place" id="address-place" placeholder="masukan alamat">
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="form-grup col-6">
                                <label for="latitude-place" style="font-weight: bold;" class="form-control-label">Latitude</label>
                                <input type="text" class="form-control" name="latitude-place" id="latitude-place" placeholder="masukan kordinat latitude">
                            </div>
                            <div class="form-grup col-6">
                                <label for="longitude-place" style="font-weight: bold;" class="form-control-label">Longitude</label>
                                <input type="text" class="form-control" name="longitude-place" id="longitude-place" placeholder="masukan kordinat longitude">
                            </div>
                        </div>
                        <div class="row col-12 mt-2">
                            <label for="link-place" style="font-weight: bold;" class="form-control-label">Google Maps Link</label>
                            <input type="text" class="form-control" name="link-place" id="link-place" placeholder="Masukan link">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" id="btn-place" name="btn-place" class="btn btn-primary">Submit</button>
                        <button type="submit" id="btn_edit_place" name="btn_edit_place" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>