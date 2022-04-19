<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/kemtan.ico">
    <title><?= $judul ?></title>
    <?php $this->load->view('includes/style') ?>
</head>

<body>
    <div class="container-login">
        <div class="confirmation">
            <img src="<?= base_url() ?>assets/img/Logokementan.svg" height="124px" width="120px">
            <h1>Silahkan aktifkan akun anda dengan menekan tombol di Bawah ini</h1>
            <form>
                <input type="hidden" name="confirmation_code" id="confirmation-code" value="<?= $this->uri->segment(4) ?>">
                <button type="submit" id="btn-activate" class="btn-activate">Aktifkan</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/acdab83cb6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#btn-activate').on('click', function(e) {
                e.preventDefault();

                var confirmation_code = $('#confirmation-code').val();
                var formData = new FormData();
                formData.append('confirmation_code', confirmation_code);

                $.ajax({
                    url: '<?= base_url('auth/confirmation/activate') ?>',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        if (result === 'success') {
                            Swal.fire({
                                title: 'Aktifasi Berhasil',
                                text: 'Selamat, proses aktifasi akun anda berhasil',
                                icon: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "<?= base_url('auth/login') ?>"
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Aktifasi gagal',
                                text: 'Maaf, proses aktifasi akun anda gagal',
                                icon: 'error'
                            })
                        }
                    }
                });
            })
        })
    </script>
</body>

</html>