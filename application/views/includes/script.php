<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/acdab83cb6.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function otherJob(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 5) {
            $('#other_job_grup').show();
        } else {
            $('#other_job_grup').hide();
        }
    }

    function otherUsed(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 5) {
            $('#other_used_grup').show();
        } else {
            $('#other_used_grup').hide();
        }
    }
    $(document).ready(function() {
        $('#other_job_grup').hide();
        $('#other_used_grup').hide();
        $('#table_id').DataTable();
        $('#table_list').DataTable()

        // $.getJSON("https://api.ipgeolocation.io/ipgeo?apiKey=9aa8b83909084d2280096230d861dae9", function(response) {
        //     var data = new FormData();
        //     data.append('ip', response.ip)
        //     data.append('city', response.city)

        //     $.ajax({
        //         url: '<?= base_url('visitor/insert') ?>',
        //         type: 'POST',
        //         data: data,
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         success: function(result) {
        //             var data = new FormData();
        //             data.append('city', response.city)
        //             $.ajax({
        //                 url: '<?= base_url('visitor/email'); ?>',
        //                 type: 'POST',
        //                 data: data,
        //                 processData: false,
        //                 contentType: false,
        //                 cache: false,
        //                 success: function(result) {
        //                     console.log(JSON.parse(result));
        //                 }
        //             })
        //         }
        //     })
        // });

        $('#btn-submit').on('click', function(e) {
            e.preventDefault();

            if ($('#error-message').length > 0) {
                $('#error-message').remove()
            }

            var name = $('#field_name').val();
            var job = $('#field_job').val();
            var otherJob = $('#field_other_job').val();
            var company = $('#field_company').val();
            var gender = $("input[name='radio1']:checked").val();
            var phone = $('#field_phone').val();
            var email = $('#field_email').val();
            var used = $('#field_used').val();
            var otherUsed = $('#field_other_used').val();
            var dataName = $('#field_data_name').val();

            var formData = new FormData();

            formData.append('name', name);
            formData.append('job', job);
            formData.append('otherJob', otherJob);
            formData.append('company', company);
            formData.append('gender', gender);
            formData.append('phone', phone);
            formData.append('email', email);
            formData.append('used', used);
            formData.append('otherUsed', otherUsed);
            formData.append('dataName', dataName);

            $.ajax({
                url: '<?= base_url('request/save') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result == '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Selamat, permintaan anda berhasil tercatat. Silahkan periksa email anda',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error').append(message);
                    }
                }
            });
        });

        $('#btn-question').on('click', function(e) {
            e.preventDefault()

            if ($('#error').length > 0) {
                $('#error').remove()
            }

            var email = $('#email-question').val();
            var name = $('#name-question').val();
            var phone = $('#phone-question').val();
            var question = $('#field-question').val();

            console.log(email, name, phone, question)

            var formData = new FormData();

            formData.append('name', name)
            formData.append('email', email)
            formData.append('phone', phone)
            formData.append('question', question)

            $.ajax({
                url: '<?= base_url('home/question') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Pertanyaan Anda Sukses Terecatat',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload()
                                $('#field-question').val('');
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error"> ' + '<p>' + result + '</p>' + '</div> '

                        $('#question').append(message);
                    }
                }
            })
        })

        $('#btn-receipt').on('click', function(e) {
            e.preventDefault()

            if ($('#error-receipt').length > 0) {
                $('#error-receipt').remove()
            }

            var receipt = $('#field_receipt').val() === '' ? 'Kosong' : $('#field_receipt').val()

            $.ajax({
                url: '<?= base_url('request/searchreceipt/') ?>' + receipt,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    if (result === null) {
                        console.log(result)
                        var message = '<div class="message" role="alert" id="error-receipt"><p> Data Tidak Ditemukan</p></div > '

                        $('#error_receipt').append(message);
                    } else {
                        console.log(result)
                        window.location.href = "<?= base_url('request/receipt/') ?>" + result.request_id + '/' + result.receipt_number
                    }
                }
            })
        })

        $('#btn-survei').on('click', function(e) {
            e.preventDefault()

            var id = $('#id').val()
            var receipt = $('#receipt').val()
            formData = new FormData()
            formData.append('1a', $("input[name='1a']:checked").val())
            formData.append('1b', $("input[name='1b']:checked").val())
            formData.append('1c', $('#1c').val())
            formData.append('2a', $("input[name='2a']:checked").val())
            formData.append('2b', $("input[name='2b']:checked").val())
            formData.append('2c', $('#2c').val())
            formData.append('3a', $("input[name='3a']:checked").val())
            formData.append('3b', $("input[name='3b']:checked").val())
            formData.append('3c', $('#3c').val())
            formData.append('4a', $("input[name='4a']:checked").val())
            formData.append('4b', $("input[name='4b']:checked").val())
            formData.append('4c', $('#4c').val())
            formData.append('5a', $("input[name='5a']:checked").val())
            formData.append('5b', $("input[name='5b']:checked").val())
            formData.append('5c', $('#5c').val())
            formData.append('6a', $("input[name='6a']:checked").val())
            formData.append('6b', $("input[name='6b']:checked").val())
            formData.append('6c', $('#6c').val())
            formData.append('7a', $("input[name='7a']:checked").val())
            formData.append('7b', $("input[name='7b']:checked").val())
            formData.append('7c', $('#7c').val())
            formData.append('8a', $("input[name='8a']:checked").val())
            formData.append('8b', $("input[name='8b']:checked").val())
            formData.append('8c', $('#8c').val())
            formData.append('9a', $("input[name='9a']:checked").val())
            formData.append('9b', $("input[name='9b']:checked").val())
            formData.append('9c', $('#9c').val())
            formData.append('all', $('#all').val())
            formData.append('id', $('#id').val())
            formData.append('sub_field', $('#sub_field').val())

            $.ajax({
                url: '<?= base_url('survei/add') ?>',
                type: 'POSt',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result === 'sukses') {
                        Swal.fire(
                            'Sukses',
                            'Jawaban survei berhasil terkirim',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                window.location.href = "<?= base_url('request/receipt/') ?>" + id + '/' + receipt
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            'Jawaban survei gagal terkirim',
                            'error'
                        )
                    }
                }
            })
        })
    });

    function category(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == '') {
            $('#table_list').DataTable().clear().destroy()
            $.ajax({
                url: '<?= base_url('data/get') ?>',
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    var data = []
                    var no = 1
                    for (i = 0; i < result.length; i++) {
                        var dataTemp = [{
                            number: no,
                            name: result[i].data_name,
                            commodity: result[i].specific_commodity,
                            period: result[i].release_period,
                            available: result[i].availability
                        }]

                        var temp = data.concat(dataTemp)
                        var data = temp

                        no++
                    }

                    console.log(data)

                    $('#table_list').DataTable({
                        data: data,
                        columns: [{
                                data: 'number'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'commodity'
                            },
                            {
                                data: 'period'
                            },
                            {
                                data: 'available'
                            },
                        ]
                    });
                }
            })
        } else {
            $('#table_list').DataTable().clear().destroy()
            $.ajax({
                url: '<?= base_url('data/getdatabycategoryid/') ?>' + index,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    var data = []
                    var no = 1
                    for (i = 0; i < result.length; i++) {
                        var dataTemp = [{
                            number: no,
                            name: result[i].data_name,
                            commodity: result[i].specific_commodity,
                            period: result[i].release_period,
                            available: result[i].availability
                        }]

                        var temp = data.concat(dataTemp)
                        var data = temp

                        no++
                    }

                    console.log(data)

                    $('#table_list').DataTable({
                        data: data,
                        columns: [{
                                data: 'number'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'commodity'
                            },
                            {
                                data: 'period'
                            },
                            {
                                data: 'available'
                            }
                        ]
                    });
                }
            })
        }
    }
</script>