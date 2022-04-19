<footer class="footer" style="background-color: black; padding-top: 20px; padding-bottom: 20px;">
    <div class="row mx-auto" style="color: white;">
        <div class="col-lg-6 mb-5">
            <div class="row">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-building fa-2x"></i>
                </div>
                <div class="com-sm-11">
                    <h5 style="font-weight: bold;"><?= $profile['location'] ?></h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-map-location-dot fa-2x"></i>
                </div>
                <div class="com-sm-11">
                    <h5 style="font-weight: bold;"><?= $profile['address'] ?></h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-phone fa-2x"></i>
                </div>
                <div class="com-sm-11">
                    <h5 style="font-weight: bold;"><?= $profile['phone_number'] ?></h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-fax fa-2x"></i>
                </div>
                <div class="com-sm-11">
                    <h5 style="font-weight: bold;"> <?= $profile['fax'] ?></h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-envelope-circle-check fa-2x"></i>
                </div>
                <div class="com-sm-11 mr-2">
                    <h5 style="font-weight: bold;"><?= $profile['email'] ?></h5>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-1 mr-2">
                    <i class="fa-solid fa-clock fa-2x"></i>
                </div>
                <div class="com-sm-11">
                    <h5 style="font-weight: bold;"><?= $profile['operational_hour'] ?></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-5 pl-5">
            <h3 class="custom" style="font-weight: 600;">Punya pertanyaan ?</h3>
            <div id="question"> </div>
            <form class="mt-3">
                <div class="form-grup">
                    <label for="name-label" class="form-control-label">Nama</label>
                    <?php if (isset($user)) : ?>
                        <input type="text" class="form-control" name="name" id="name-question" value="<?= $user['name'] ?>">
                    <?php else : ?>
                        <input type="text" class="form-control" name="name" id="name-question">
                    <?php endif ?>
                </div>
                <div class="form-grup">
                    <label for="email-label" class="form-control-label">Email</label>
                    <?php if (isset($user)) : ?>
                        <input type="text" class="form-control" name="email" id="email-question" value="<?= $user['email'] ?>" readonly>
                    <?php else : ?>
                        <input type="text" class="form-control" name="email" id="email-question">
                    <?php endif ?>
                </div>
                <div class="form-grup">
                    <label for="phone-label" class="form-control-label">No. Telepon / HP</label>
                    <?php if (isset($user)) : ?>
                        <input type="text" class="form-control" name="phone" id="phone-question" value="<?= $user['phone_number'] ?>" readonly>
                    <?php else : ?>
                        <input type="text" class="form-control" name="phone" id="phone-question">
                    <?php endif ?>
                </div>
                <div class="form-grup">
                    <label for="question" class="form-control-label">Pertanyaan</label>
                    <textarea style="resize: none;" name="field-question" id="field-question" cols="10" rows="4" class="form-control"></textarea>
                </div>
                <button type="submit" name="btn-question" id="btn-question" class="btn btn-success rounded mt-3">Kirim</button>
            </form>
        </div>
    </div>
</footer>


<?php $this->load->view('includes/script') ?>
</body>

</html>