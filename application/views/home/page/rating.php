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
        <div class="rating">
            <img src="<?= base_url() ?>assets/img/Logokementan.svg" height="124px" width="120px">
            <h3 style="font-weight: bolder; color: white;">Bagaimana Kepuasan Anda Terhadap Layanan SIMPELDATIN Yang Kami Berikan</h3>
            <h5 style="font-weight: 500; color: white;">Penilaian anda membuat pelayanan kami menjadi lebih baik</h5>
            <form>
                <input type="hidden" name="id" id="id" value="<?= $this->uri->segment('3') ?>">
                <div class="col">
                    <div class="col">
                        <span id="1" class="fas fa-star star-checked"></span>
                        <span id="2" class="fas fa-star star-checked"></span>
                        <span id="3" class="fas fa-star"></span>
                        <span id="4" class="fas fa-star"></span>
                        <span id="5" class="fas fa-star"></span>
                    </div>
                    <div class="col text-left"><label class="form-control-label mt-3 mb-3 text-white"> Komentar dan Review : </label>
                        <div class="col" style="height:70px; width:250px; overflow-y: scroll;">
                            <?php foreach ($comments as $comment) : ?>
                                <div class="form-check mr-3">
                                    <input class="form-check-input" type="checkbox" value="<?= $comment['default_comment'] ?>" name="comment" />
                                    <label class="form-check-label text-white" for="comment"><?= $comment['default_comment'] ?></label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col mt-3">
                        <textarea name="comment_description" id="description" cols="30" rows="2" style="resize: none;" class="form-control"></textarea>
                    </div>
                    <div class="col text-left mt-2">
                        <button type="submit" class="btn btn-primary" id="save" name="save">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $this->load->view('includes/script'); ?>
    <script>
        function deleteStar() {
            for (i = 1; i < 6; i++) {
                $('#' + i).removeClass('star-checked')
            }
        }

        function addStar(star) {
            for (i = 1; i < star; i++) {
                $('#' + i).addClass('star-checked')
            }
        }

        var rate = 2

        $(document).ready(function() {
            $('#1').on('click', function() {
                deleteStar()
                addStar(2)
                rate = 1
            })

            $('#2').on('click', function() {
                deleteStar()
                addStar(3)
                rate = 2
            })

            $('#3').on('click', function() {
                deleteStar()
                addStar(4)
                rate = 3
            })

            $('#4').on('click', function() {
                deleteStar()
                addStar(5)
                rate = 4
            })

            $('#5').on('click', function() {
                deleteStar()
                addStar(6)
                rate = 5
            })

            $('#save').on('click', function(e) {
                e.preventDefault()

                var comments = []
                $.each($("input[name='comment']:checked"), function() {
                    comments.push($(this).val())
                });

                var id = $('#id').val()
                var description = $('#description').val()
                var rating = rate

                var formData = new FormData()
                formData.append('id', id)
                formData.append('description', description)
                formData.append('rating', rating)
                formData.append('comments', comments)

                $.ajax({
                    url: '<?= base_url('rating/add') ?>',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(result) {
                        if (result === 'success') {
                            Swal.fire({
                                title: 'Penilaian Berhasil',
                                text: 'Terimakasi, telah memberikan penilaian',
                                icon: 'success'
                            }).then((result) => {
                                if (result.value) {
                                    window.location.href = "<?= base_url('auth/login') ?>"
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Penilaian Gagal',
                                text: result,
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