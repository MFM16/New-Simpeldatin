<section id="catalog" class="mb-5">
    <div class="col-lg-12">
        <h2 style="text-align: center; font-weight: bold; margin-bottom: 35px">
            Katalog Data
        </h2>
        <table class="table table-borderless">
            <thead>
                <th class="bg-success text-white" style="border-radius: 50px; text-align: center; width: 50%; font-size: 23px;">Nama Data</th>
                <th class="bg-warning text-white" style="border-radius: 50px; text-align: center; width: 50%; font-size: 23px;">Data yang Tersedia</th>
            </thead>
            <tbody>
                <?php foreach ($datas as $data) : ?>
                    <tr>
                        <td style="font-weight: bold; font-size: 20px;"><?= $data['data_name'] ?></td>
                        <td style="font-weight: bold; font-size: 20px;"><?= $data['availability'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <a href="<?= base_url('catalog') ?>" class="text-success" style="font-weight: bold;">Lihat selengkapnya ...</a>
    </div>
</section>