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
        <div class="login">
            <div class="row">
                <div class="col-lg-6 left-panel">
                    <img src="<?= base_url('assets/img/Logokementan.svg') ?>" height="124px" width="120px">
                    <h1>SIMPELDATIN</h1>
                    <h4>Sistem Pelayanan Data dan Informasi Pertanian</h4>
                </div>
                <div class="col-lg-6 right-panel">
                    <div class="mx-auto circle">
                        <i class="fa-solid fa-user fa-3x" style="color: white;"></i>
                    </div>
                    <div id="error">

                    </div>
                    <form>
                        <div>
                            <label for="myEmail" class="label-name">Email</label>
                            <input type="text" name="myEmail" id="myEmail" placeholder="your email address" class="form">
                        </div>
                        <div>
                            <label for="myPassword" class="label-name">Password</label>
                            <input type="password" name="myPassword" id="myPassword" class="form">
                        </div>
                        <div>
                            <label for="confirmPassword" class="label-name">Ulangi Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form">
                        </div>
                        <button type="submit" id="btn-signUp" class="btn-form">Dafta</button>
                    </form>
                    <p>Sudah punya akun ? <a href="<?= base_url('auth/login') ?>">Login</a></p>
                </div>
            </div>
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
            $('#btn-signUp').on('click', function(e) {
                e.preventDefault();

                if ($('#error-message').length > 0) {
                    $('#error-message').remove()
                }

                var email = $('#myEmail').val();
                var password = $('#myPassword').val();
                var conPassword = $('#confirmPassword').val();

                var formData = new FormData();
                formData.append('myEmail', email);
                formData.append('myPassword', password);
                formData.append('confirmPassword', conPassword);

                $.ajax({
                    url: '<?= base_url('auth/registration/register'); ?>',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result === '') {
                            Swal.fire({
                                title: 'Terima Kasih Telah Mendaftar',
                                text: 'Silahkan tekan tombol di bawah untuk melanjutkan ke tahap aktifasi akun',
                                icon: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "<?= base_url('auth/confirmation') ?>";
                                }
                            })
                        } else {
                            var message = '<div class="message" role="alert" id="error-message"> ' + '<p>' + result + '</p>' + '</div > '

                            $('#error').append(message);
                        }
                    }
                })
            });
        })
    </script>
</body>

</html>