<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a class="text-muted"><strong>Kementrian Pertanian</strong></a> &copy;
                </p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="https://kit.fontawesome.com/acdab83cb6.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/js/app.js') ?>"></script>

<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFyaGFubWF1bGlkaWFuMTYiLCJhIjoiY2wyZTlsNDVnMTc2djNlbGhhbHRsbXQ3OSJ9.5uZyJXUB8qrbxqnmWoSkNg';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [106.823066, -6.296435],
        zoom: 10
    });

    // make a marker for each feature and add it to the map
    const marker = new mapboxgl.Marker()
        .setLngLat([106.823066, -6.296435])
        .addTo(map);

    $.ajax({
        url: '<?= base_url('visitor/getplace') ?>',
        type: 'GET',
        success: function(result) {
            var obj = JSON.parse(result)
            var data = obj.data

            $.each(data, function(key, value) {
                const marker = new mapboxgl.Marker()
                    .setLngLat([value.longitude, value.latitude])
                    .addTo(map);
            })
        }
    })
</script>

<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
        $('#table_list').DataTable()
        $('#myTable').DataTable();
        $('#btn_edit_special').hide();
        $('#btn_edit_place').hide();
        $('#btn-change-data-officer').hide();
        $('#other-used').hide();
        $('#other_used_special').hide();
        $('#other_job_grup').hide()
        $('#btn-editList').hide()

        var fieldId = $('#id_field_dd').val();

        $.ajax({
            url: '<?= base_url('admin/request/subfield/') ?>' + fieldId,
            type: 'GET',
            dataType: 'JSON',
            success: function(result) {
                for (i = 0; i < result.length; i++) {
                    $('#dd_subField').append(new Option(result[i].sub_field_name, result[i].sub_field_id));
                }
            }
        })
        $.ajax({
            url: '<?= base_url('admin/request/officer/') ?>' + fieldId,
            type: 'GET',
            dataType: 'JSON',
            success: function(result) {
                for (i = 0; i < result.length; i++) {
                    $('#dd_officer').append(new Option(result[i].officer_name, result[i].officer_id));
                }
            }
        })
    })

    function resetList() {
        $('#data_name').val('')
        $('#data_category').val('')
        $('#data_source').val('')
        $('#data_specific').val('')
        $('#data_period').val('')
        $('#data_level').val('')
        $('#data_availability').val('')
        $('#data_release').val('')
        $('#data_access').val('')

        $('#btn-editList').hide()
        $('#btn-list').show()
        $('#modalList').modal('hide')
    }

    function resetPlace() {
        $('#form-place').get(0).reset()
        $('#btn_edit_place').hide();
        $('#btn-place').show();
        $('#modalLokasi').modal('hide');
    }

    function otherJob(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 5) {
            $('#other_job_grup').show();
        } else {
            $('#other_job_grup').hide();
        }
    }

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
                        if (result[i].access === null) {
                            var dataTemp = [{
                                number: no,
                                name: result[i].data_name,
                                commodity: result[i].specific_commodity,
                                period: result[i].release_period,
                                available: result[i].availability,
                                access: '',
                                edit: '<button class="btn btn-success btn-sm rounded" type="button" data-id="' + result[i].data_id + '" id="edit-list"> <i class = "fa-solid fa-pencil" > </i> </button>'
                            }]
                        } else {
                            var dataTemp = [{
                                number: no,
                                name: result[i].data_name,
                                commodity: result[i].specific_commodity,
                                period: result[i].release_period,
                                available: result[i].availability,
                                access: '<a href="' + result[i].access + '" target="_blank" class="btn btn-info btn-sm rounded"><i class="fa-solid fa-link"></i></a>',
                                edit: '<button class="btn btn-success btn-sm rounded" type="button" data-id="' + result[i].data_id + '" id="edit-list"> <i class = "fa-solid fa-pencil" > </i> </button>'
                            }]
                        }

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
                            {
                                data: 'access'
                            },
                            {
                                data: 'edit'
                            }
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
                        if (result[i].access === null) {
                            var dataTemp = [{
                                number: no,
                                name: result[i].data_name,
                                commodity: result[i].specific_commodity,
                                period: result[i].release_period,
                                available: result[i].availability,
                                access: '',
                                edit: '<button class="btn btn-success btn-sm rounded" type="button" data-id="' + result[i].data_id + '" id="edit-list"> <i class = "fa-solid fa-pencil" > </i> </button>'
                            }]
                        } else {
                            var dataTemp = [{
                                number: no,
                                name: result[i].data_name,
                                commodity: result[i].specific_commodity,
                                period: result[i].release_period,
                                available: result[i].availability,
                                access: '<a href="' + result[i].access + '" target="_blank" class="btn btn-info btn-sm rounded"><i class="fa-solid fa-link"></i></a>',
                                edit: '<button class="btn btn-success btn-sm rounded" type="button" data-id="' + result[i].data_id + '" id="edit-list"> <i class = "fa-solid fa-pencil" > </i> </button>'
                            }]
                        }

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
                            {
                                data: 'access'
                            },
                            {
                                data: 'edit'
                            }
                        ]
                    });
                }
            })
        }
    }

    function setUtility(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 5) {
            $('#other-used').show();
        } else {
            $('#other-used').hide();
        }
    }

    function setUtilitySpecial(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 5) {
            $('#other-used-special').show();
        } else {
            $('#other-used-special').hide();
        }
    }

    function setRole(val) {
        var index = val.options[val.selectedIndex].value;

        if (index == 'Admin') {
            $('#field-officer').attr('disabled', true)
            $('#sub-field-officer').attr('disabled', true)
            $('#field-officer').val('')
            $('#sub-field-officer').val('')
        } else if (index == 1) {
            $('#field-officer').attr('disabled', true)
            $('#sub-field-officer').removeAttr('disabled')
            $('#field-officer').val('')
            $('#sub-field-officer').val('')
        } else if (index == 2 || index == 3) {
            $('#field-officer').removeAttr('disabled')
            $('#sub-field-officer').attr('disabled', true)
            $('#field-officer').val('')
            $('#sub-field-officer').val('')
        } else {
            $('#field-officer').removeAttr('disabled')
            $('#sub-field-officer').removeAttr('disabled')
        }
    }

    function resetOfficer() {
        $('#name-officer').val('')
        $('#phone-officer').val('')
        $('#email-officer').val('')
        $('#role-officer').val('')
        $('#field-officer').val('')
        $('#sub-field-officer').val('')
        $('#btn-change-data-officer').hide();
        $('#btn-officer').show()
        $('#modalPegawai').modal('hide');
        $('#field-officer').removeAttr('disabled')
        $('#sub-field-officer').removeAttr('disabled')
        $('#email-officer').removeAttr('disabled')
    }

    function reset_permohonan() {
        $('#name-general').val('')
        $('#company-general').val('')
        $('#used-general').val()
        $('#other-used-general').val('')
        $('#field-general').val()
        $('#email-general').val()
        $('#phone-general').val()
        $('#data-name-general').val('')
        $('#expired-general').val('')

        $('#modalPermohonan').modal('hide');
    }

    function reset_khusus() {
        $('#name-special').val('');
        $('#company-special').val('');
        $('#used-special').val('');
        $('#otherused-special').val('')
        $('#field-special').val('');
        $('#email-special').val('');
        $('#phone-special').val('');
        $('#data-name-special').val('');
        $('#evidence-special').val('');
        $('#other_used_special').hide();
        $('#btn-special').show()
        $('#btn_edit_special').hide()

        $('#modalKhusus').modal('hide');
    }

    function reset() {
        $('#modalDetail').modal('hide');
    }

    function resetSurvei() {
        $('#modalSurvei').modal('hide');
    }
</script>
<script>
    $(document).ready(function() {
        $('#btn-officer').on('click', function(e) {
            e.preventDefault();

            if ($('#error-officer-message').length > 0) {
                $('#error-officer-message').remove()
            }

            var name = $('#name-officer').val()
            var phone = $('#phone-officer').val()
            var email = $('#email-officer').val()
            var role = $('#role-officer').val()
            var field = $('#field-officer').val()
            var subField = $('#sub-field-officer').val()

            var formData = new FormData()

            formData.append('name', name)
            formData.append('phone', phone)
            formData.append('email', email)
            formData.append('role', role)
            formData.append('field', field)
            formData.append('subField', subField)

            $.ajax({
                url: '<?= base_url('admin/officer/add') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data Pegawai Berhasil Ditambah',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                resetOfficer()
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-officer-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-officer').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn-delete-officer', 'click', function() {
            var id = $(this).data('id')

            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('admin/officer/delete/') ?>' + id,
                        type: 'GET',
                        success: function(result) {
                            Swal.fire(
                                'Sukses',
                                'Data pegawai berhasil dihapus',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload()
                                }
                            })
                        }
                    })
                }
            })
        })

        $(document).delegate('#btn-edit-officer', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url('admin/officer/getdata/') ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#officer-id').val(result.officer_id)
                    $('#name-officer').val(result.officer_name)
                    $('#phone-officer').val(result.phone_number)
                    $('#email-officer').val(result.email)
                    $('#email-officer').attr('disabled', true)
                    if (result.role_id == 1) {
                        $('#role-officer').val('Admin')
                        $('#field-officer').attr('disabled', true)
                        $('#sub-field-officer').attr('disabled', true)
                        $('#field-officer').val('')
                        $('#sub-field-officer').val('')
                    } else {
                        if (result.sub_role_id == 1) {
                            $('#role-officer').val(result.sub_role_id)
                            $('#field-officer').attr('disabled', true)
                            $('#sub-field-officer').removeAttr('disabled')
                            $('#field-officer').val('')
                            $('#sub-field-officer').val(result.sub_field_id)
                        } else if (result.sub_role_id == 2 || result.sub_role_id == 3) {
                            $('#role-officer').val(result.sub_role_id)
                            $('#field-officer').removeAttr('disabled')
                            $('#sub-field-officer').attr('disabled', true)
                            $('#field-officer').val(result.field_id)
                            $('#sub-field-officer').val('')
                        }
                    }

                    $('#btn-change-data-officer').show()
                    $('#btn-officer').hide()

                    $('#modalPegawai').modal('show');
                }
            })
        })

        $('#btn-change-data-officer').on('click', function(e) {
            e.preventDefault();

            if ($('#error-officer-message').length > 0) {
                $('#error-officer-message').remove()
            }

            var id = $('#officer-id').val()
            var name = $('#name-officer').val()
            var phone = $('#phone-officer').val()
            var email = $('#email-officer').val()
            var role = $('#role-officer').val()
            var field = $('#field-officer').val()
            var subField = $('#sub-field-officer').val()

            var formData = new FormData()

            formData.append('id', id)
            formData.append('name', name)
            formData.append('phone', phone)
            formData.append('email', email)
            formData.append('role', role)
            formData.append('field', field)
            formData.append('subField', subField)

            $.ajax({
                url: '<?= base_url('admin/officer/edit') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data Pegawai Berhasil Diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                resetOfficer()
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-officer-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-officer').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn-delete-bantuan', 'click', function() {
            var id = $(this).data('id')

            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('admin/question/delete/') ?>' + id,
                        type: 'GET',
                        success: function(result) {
                            Swal.fire(
                                'Sukses',
                                'Data bantuan berhasil dihapus',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload()
                                }
                            })
                        }
                    })
                }
            })
        })

        $(document).delegate('#btn-bantuan', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url('admin/question/getdata/') ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#question-name').html(result.name)
                    $('#question-date').html(result.created_at)
                    $('#question-email').html(result.email)
                    $('#question-phone').html(result.phone_number)
                    $('#question-message').val(result.question)

                    $('#modalBantuan').modal('show');
                }
            })
        })

        $('#btn-general').on('click', function(e) {
            e.preventDefault();

            if ($('#error-general-message').length > 0) {
                $('#error-general-message').remove()
            }

            var id = $('#id-general').val()
            var name = $('#name-general').val()
            var company = $('#company-general').val()
            var used = $('#used-general').val()
            var otherUsed = $('#other-used-general').val()
            var field = $('#field-general').val()
            var email = $('#email-general').val()
            var phone = $('#phone-general').val()
            var dataName = $('#data-name-general').val()
            var dateline = $('#expired-general').val()

            var formData = new FormData()

            formData.append('id', id)
            formData.append('name', name)
            formData.append('phone', phone)
            formData.append('email', email)
            formData.append('field', field)
            formData.append('used', used)
            formData.append('otherUsed', otherUsed)
            formData.append('company', company)
            formData.append('dataName', dataName)
            formData.append('dateline', dateline)

            $.ajax({
                url: '<?= base_url('admin/request/updategeneral') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Permohonan Data Berhasil Diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                resetOfficer()
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-general-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-general').append(message);
                    }
                }
            })
        })

        $('#btn-special').on('click', function(e) {
            e.preventDefault();

            if ($('#error-special-message').length > 0) {
                $('#error-special-message').remove()
            }

            var name = $('#name-special').val();
            var company = $('#company-special').val();
            var used = $('#used-special').val();
            var otherUsed = $('#otherused-special').val()
            var field = $('#field-special').val();
            var email = $('#email-special').val();
            var phone = $('#phone-special').val();
            var dataName = $('#data-name-special').val();
            var evidence = $('#evidence').prop('files')[0];

            var formData = new FormData()

            formData.append('name', name)
            formData.append('phone', phone)
            formData.append('email', email)
            formData.append('field', field)
            formData.append('used', used)
            formData.append('otherUsed', otherUsed)
            formData.append('company', company)
            formData.append('dataName', dataName)
            formData.append('evidence', evidence)

            $.ajax({
                url: '<?= base_url('admin/request/savespecial') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Permohonan Data Berhasil Tercatat',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                resetOfficer()
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-special-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-special').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn_delete_request', 'click', function() {
            var id = $(this).data('id')

            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('admin/request/delete/') ?>' + id,
                        type: 'GET',
                        success: function(result) {
                            Swal.fire(
                                'Sukses',
                                'Permohonan Data berhasil Dihapus',
                                'success'
                            ).then((result) => {
                                if (result.value) {
                                    location.reload()
                                }
                            })
                        }
                    })
                }
            })
        })

        $(document).delegate('#btnedit_special', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url('admin/request/getdata/') ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#id-special').val(result.request_id);
                    $('#name-special').val(result.name);
                    $('#company-special').val(result.company);
                    $('#used-special').val(result.used_for_id);
                    if (result.used_for_id == 5) {
                        $('#other_used_special').show();
                    }
                    $('#otherused-special').val(result.other_used_for);
                    $('#field-special').val(result.field_id);
                    $('#email-special').val(result.email);
                    $('#phone-special').val(result.phone_number);
                    $('#data-name-special').val(result.data_name);
                    $('#evidence').val(result.evidence);

                    $('#btn-special').hide()
                    $('#btn_edit_special').show()

                    $('#modalKhusus').modal('show');
                }
            })
        })

        $(document).delegate('#btnedit_general', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url('admin/request/getdata/') ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#id-general').val(result.request_id)
                    $('#name-general').val(result.name);
                    $('#company-general').val(result.company);
                    $('#used-general').val(result.used_for_id);
                    if (result.used_for_id == 5) {
                        $('#other-used').show();
                    }
                    $('#other-used-general').val(result.other_used_for);
                    $('#field-general').val(result.field_id);
                    $('#email-general').val(result.email);
                    $('#phone-general').val(result.phone_number);
                    $('#data-name-general').val(result.data_name);

                    $('#modalPermohonan').modal('show');
                }
            })
        })

        $('#btn-password').on('click', function(e) {
            e.preventDefault()

            if ($('#error-message').length > 0) {
                $('#error-message').remove()
            }

            var roleId = $('#role_id_profile').val()
            var email = $('#emailChange').val()
            var password = $('#password').val()
            var confPassword = $('#confirmPassword').val();

            var formData = new FormData()
            formData.append('email', email)
            formData.append('roleId', roleId)
            formData.append('password', password)
            formData.append('confPassword', confPassword)

            $.ajax({
                url: '<?= base_url('profile/changePassword') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Password anda telah diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = "<?= base_url('auth/login/logout') ?>";
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error').append(message);
                    }
                }
            })
        })

        $('#btn-change').on('click', function(e) {
            e.preventDefault()

            if ($('#error-message').length > 0) {
                $('#error-message').remove()
            }

            var name = $('#name').val()
            var roleId = $('#role-id').val()
            var email = $('#email').val()
            var phone = $('#phone').val()
            var photo = $('#photo').prop('files')[0]
            if (roleId == 3) {
                var jobId = $('#job_id').val()
                var otherJob = $('#other_job').val()
                var company = $('#company').val()
            }

            var formData = new FormData()
            formData.append('role_id', roleId)
            formData.append('name', name)
            formData.append('email', email)
            formData.append('phone', phone)
            formData.append('photo', photo)
            if (roleId == 3) {
                formData.append('job_id', jobId)
                formData.append('other_job', otherJob)
                formData.append('company', company)
            }

            $.ajax({
                url: '<?= base_url('profile/changeProfile') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Profile anda telah diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error').append(message);
                    }
                }
            })
        })

        $('#btn_edit_special').on('click', function(e) {
            e.preventDefault();

            if ($('#error-special-message').length > 0) {
                $('#error-special-message').remove()
            }

            var id = $('#id-special').val();
            var name = $('#name-special').val();
            var company = $('#company-special').val();
            var used = $('#used-special').val();
            var otherUsed = $('#otherused-special').val()
            var field = $('#field-special').val();
            var email = $('#email-special').val();
            var phone = $('#phone-special').val();
            var dataName = $('#data-name-special').val();
            var evidence = $('#evidence').prop('files')[0];

            var formData = new FormData()

            formData.append('id', id)
            formData.append('name', name)
            formData.append('phone', phone)
            formData.append('email', email)
            formData.append('field', field)
            formData.append('used', used)
            formData.append('otherUsed', otherUsed)
            formData.append('company', company)
            formData.append('dataName', dataName)
            formData.append('evidence', evidence)

            $.ajax({
                url: '<?= base_url('admin/request/updatespecial') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Permohonan Data Berhasil Diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                resetOfficer()
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error-special-message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-special').append(message);
                    }
                }
            })
        })

        $('#btn-file').on('click', function(e) {
            e.preventDefault()

            var id = $('#request_id').val()
            var file = $('#file-data').prop('files')[0]

            formData = new FormData()
            formData.append('id', id)
            formData.append('file', file)

            $.ajax({
                url: '<?= base_url('admin/request/upload') ?>',
                data: formData,
                type: 'POST',
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire(
                            'Sukses',
                            'File berhasil diupload',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            'File gagal diupload',
                            'error'
                        )
                    }
                }
            })
        })

        $('#btn-reject').on('click', function(e) {
            e.preventDefault()

            if ($('#error_reject_message').length > 0) {
                $('#error_reject_message').remove()
            }

            var id = $('#request_id').val()
            var name = $('#name').val()
            var receipt = $('#receipt_number').val()
            var reason = $('#reason').val()

            var formData = new FormData()
            formData.append('id', id)
            formData.append('name', name)
            formData.append('receipt', receipt)
            formData.append('reason', reason)

            $.ajax({
                url: '<?= base_url('admin/request/reject') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Permohonan Data Berhasil Ditolak',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error_reject_message"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error_reject').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn-detail', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url('admin/request/getsentdata/') ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#email_data').val(result.email)
                    $('#name_data').val(result.name)
                    $('#receipt_number_data').val(result.receipt_number)
                    $('#request_id_data').val(result.request_id)
                    $('#sent-name').text(result.name)
                    $('#sent-company').text(result.company)
                    $('#sent-date').text(result.request_date)
                    $('#sent-email').text(result.email)
                    $('#data-name').val(result.data_name)
                    if (result.used_for_id == 5) {
                        $('#sent-used').text(result.other_used_for)
                    } else {
                        $('#sent-used').text(result.utility_name)
                    }

                    $.ajax({
                        url: '<?= base_url('admin/request/getfilesdata/') ?>' + id,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(res) {
                            for (i = 0; i < res.length; i++) {
                                var file = '<tr>' +
                                    '<td><strong>File</strong></td>' +
                                    '<td>:</td>' +
                                    '<td>' + res[i].file_name +
                                    '<a href="<?= base_url("request/download/") ?>' + res[i].file_name + '" style="margin-left: 5px;" class="btn btn-sm btn-success rounded" id="btn-download"><i class="fa-solid fa-download"></i></a>' +
                                    '</td>' +
                                    '</tr>'
                                $('#sent-table').append(file)
                            }

                            $('#modalDetail').modal('show');
                        }
                    })
                }
            })
        })

        $('#btn-send').on('click', function(e) {
            e.preventDefault()

            var email = $('#email_data').val()
            var name = $('#name_data').val()
            var receipt = $('#receipt_number_data').val()
            var id = $('#request_id_data').val()

            var formData = new FormData()
            formData.append('email', email)
            formData.append('name', name)
            formData.append('receipt_number', receipt)
            formData.append('id', id)

            $.ajax({
                url: '<?= base_url('admin/request/sent') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Permohonan Data Berhasil Dikirim',
                        icon: 'success'
                    }).then((result) => {
                        if (result.value) {
                            location.reload()
                        }
                    })
                }
            })
        })

        $('#btn-forward').on('click', function(e) {
            e.preventDefault()

            var field = $('#dd_field').val() === undefined ? 0 : $('#dd_field').val()
            var subField = $('#dd_subField').val() === undefined ? 0 : $('#dd_subField').val()
            var officer = $('#dd_officer').val() === undefined ? 0 : $('#dd_officer').val()
            var admin = $('#dd_admin').val() === undefined ? 0 : $('#dd_admin').val()
            var id = $('#id').val()
            var receipt = $('#receipt').val()
            var dataName = $('#data_name').val()
            var utility = $('#utility_name').val()
            var email = $('#data_email').val()

            var formData = new FormData()
            formData.append('field', field)
            formData.append('subField', subField)
            formData.append('officer', officer)
            formData.append('admin', admin)
            formData.append('id', id)
            formData.append('dataName', dataName)
            formData.append('utility', utility)
            formData.append('receipt', receipt)
            formData.append('email', email)

            $.ajax({
                url: '<?= base_url('admin/request/forward') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire(
                            'Sukses',
                            'Permohonan berhasil diteruskan',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            'Permohonan gagal diteruskan',
                            'error'
                        )
                    }
                }
            })
        })

        $('#btn-list').on('click', function(e) {
            e.preventDefault()

            if ($('#error_list').length > 0) {
                $('#error_list').remove()
            }

            formData = new FormData()
            formData.append('data_name', $('#data_name').val())
            formData.append('data_category', $('#data_category').val())
            formData.append('data_source', $('#data_source').val())
            formData.append('data_specific', $('#data_specific').val())
            formData.append('data_period', $('#data_period').val())
            formData.append('data_level', $('#data_level').val())
            formData.append('data_availability', $('#data_availability').val())
            formData.append('data_release', $('#data_release').val())
            formData.append('data_access', $('#data_access').val())

            $.ajax({
                url: '<?= base_url('admin/list_data/insert') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data baru berhasil ditambahkan',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload()
                                resetList()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error_list"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-list').append(message);
                    }
                }
            })
        })

        $(document).delegate('#edit-list', 'click', function() {
            var id = $(this).data('id')

            $.ajax({
                url: '<?= base_url("admin/list_data/get/") ?>' + id,
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#data_id').val(result.data_id)
                    $('#data_name').val(result.data_name)
                    $('#data_category').val(result.category_id)
                    $('#data_source').val(result.data_source)
                    $('#data_specific').val(result.specific_commodity)
                    $('#data_period').val(result.release_period)
                    $('#data_level').val(result.level)
                    $('#data_availability').val(result.availability)
                    $('#data_release').val(result.release_time)
                    $('#data_access').val(result.access)

                    $('#btn-editList').show()
                    $('#btn-list').hide()
                    $('#modalList').modal('show')
                }
            })
        })

        $('#btn-editList').on('click', function(e) {
            e.preventDefault()

            if ($('#error_list').length > 0) {
                $('#error_list').remove()
            }

            formData = new FormData()
            formData.append('data_name', $('#data_name').val())
            formData.append('id', $('#data_id').val())
            formData.append('data_category', $('#data_category').val())
            formData.append('data_source', $('#data_source').val())
            formData.append('data_specific', $('#data_specific').val())
            formData.append('data_period', $('#data_period').val())
            formData.append('data_level', $('#data_level').val())
            formData.append('data_availability', $('#data_availability').val())
            formData.append('data_release', $('#data_release').val())
            formData.append('data_access', $('#data_access').val())

            $.ajax({
                url: '<?= base_url('admin/list_data/update') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result === '') {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Data berhasil diperbaharui',
                            icon: 'success'
                        }).then((result) => {
                            if (result.value) {
                                location.reload()
                                resetList()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error_list"> ' + '<p>' + result + '</p>' + '</div > '

                        $('#error-list').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn-detailSurvei', 'click', function() {

            $.ajax({
                url: '<?= base_url('survei/getsurvei/') ?>' + $(this).data('id'),
                type: 'GET',
                dataType: 'JSON',
                success: function(result) {
                    $('#1a').text(result.first_a)
                    $('#1b').text(result.first_b)
                    $('#1c').text(result.first_c)
                    $('#2a').text(result.second_a)
                    $('#2b').text(result.second_b)
                    $('#2c').text(result.second_c)
                    $('#3a').text(result.third_a)
                    $('#3b').text(result.third_b)
                    $('#3c').text(result.third_c)
                    $('#4a').text(result.forth_a)
                    $('#4b').text(result.forth_b)
                    $('#4c').text(result.forth_c)
                    $('#5a').text(result.fifth_a)
                    $('#5b').text(result.fifth_b)
                    $('#5c').text(result.fifth_c)
                    $('#6a').text(result.sixth_a)
                    $('#6b').text(result.sixth_b)
                    $('#6c').text(result.sixth_c)
                    $('#7a').text(result.seventh_a)
                    $('#7b').text(result.seventh_b)
                    $('#7c').text(result.seventh_c)
                    $('#8a').text(result.eigth_a)
                    $('#8b').text(result.eigth_b)
                    $('#8c').text(result.eigth_c)
                    $('#9a').text(result.ninth_a)
                    $('#9b').text(result.ninth_b)
                    $('#9c').text(result.ninth_c)

                    $('#modalSurvei').modal('show')
                }
            })
        })

        $(document).delegate('#btn_delete_file', 'click', function() {
            $.ajax({
                url: '<?= base_url('admin/request/destroy/') ?>' + $(this).data('id'),
                type: 'GET',
                success: function(result) {
                    var obj = JSON.parse(result)

                    if (obj.status === true) {
                        Swal.fire(
                            'Sukses',
                            'File Berhasil Dihapus',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        Swal.fire(
                            'Gagal',
                            'File Gagal Dihapus',
                            'error'
                        )
                    }
                }
            })
        })

        $('#btn-place').on('click', function(e) {
            e.preventDefault()

            if ($('#error_place').length > 0) {
                $('#error_place').remove()
            }

            var formData = new FormData();
            formData.append('name', $('#name-place').val())
            formData.append('city', $('#city-place').val())
            formData.append('district', $('#district-place').val())
            formData.append('address', $('#address-place').val())
            formData.append('latitude', $('#latitude-place').val())
            formData.append('longitude', $('#longitude-place').val())
            formData.append('link', $('#link-place').val())

            $.ajax({
                url: '<?= base_url('place/insert') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    var obj = JSON.parse(result)
                    if (obj.status === true) {
                        Swal.fire(
                            'Sukses',
                            'Data berhasil ditambahkan',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error_place"> ' + '<p>' + obj.message + '</p>' + '</div > '

                        $('#error-place').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btnedit_place', 'click', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('place/show/') ?>' + id,
                type: 'GET',
                success: function(result) {
                    var obj = JSON.parse(result)
                    var data = obj.data

                    $('#id-place').val(data.place_id)
                    $('#name-place').val(data.name)
                    $('#city-place').val(data.city)
                    $('#district-place').val(data.district)
                    $('#address-place').val(data.address)
                    $('#latitude-place').val(data.latitude)
                    $('#longitude-place').val(data.longitude)
                    $('#link-place').val(data.gmaps_link)

                    $('#btn_edit_place').show()
                    $('#btn-place').hide()

                    $('#modalLokasi').modal('show')
                }
            })
        });

        $('#btn_edit_place').on('click', function(e) {
            e.preventDefault()

            if ($('#error_place').length > 0) {
                $('#error_place').remove()
            }

            var formData = new FormData();
            formData.append('id', $('#id-place').val())
            formData.append('name', $('#name-place').val())
            formData.append('city', $('#city-place').val())
            formData.append('district', $('#district-place').val())
            formData.append('address', $('#address-place').val())
            formData.append('latitude', $('#latitude-place').val())
            formData.append('longitude', $('#longitude-place').val())
            formData.append('link', $('#link-place').val())

            $.ajax({
                url: '<?= base_url('place/edit') ?>',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result) {
                    var obj = JSON.parse(result)
                    if (obj.status === true) {
                        Swal.fire(
                            'Sukses',
                            'Data berhasil Diperbaharui',
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                location.reload()
                            }
                        })
                    } else {
                        var message = '<div class="message" role="alert" id="error_place"> ' + '<p>' + obj.message + '</p>' + '</div > '

                        $('#error-place').append(message);
                    }
                }
            })
        })

        $(document).delegate('#btn_delete_place', 'click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah anda yakin ?',
                text: 'Data akan dihapus',
                icon: 'warning',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url('place/delete/') ?>' + id,
                        type: 'GET',
                        success: function(result) {
                            var obj = JSON.parse(result)
                            if (obj.status === true) {
                                Swal.fire(
                                    'Sukses',
                                    'Data berhasil dihapus',
                                    'success'
                                ).then((result) => {
                                    if (result.value) {
                                        location.reload()
                                    }
                                })
                            } else {
                                Swal.fire(
                                    'Gagal',
                                    'Data gagal dihapus',
                                    'error'
                                )
                            }
                        }
                    })
                }
            })
        });
    })
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Bar chart
        new Chart(document.getElementById("chartjs-dashboard-bar"), {
            type: 'bar',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"],
                datasets: [{
                        label: "Umum",
                        backgroundColor: [
                            '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a', '#33b35a'
                        ],
                        data: [<?= $umum1; ?>, <?= $umum2; ?>, <?= $umum3; ?>, <?= $umum4; ?>, <?= $umum5; ?>, <?= $umum6; ?>, <?= $umum7; ?>, <?= $umum8; ?>, <?= $umum9; ?>, <?= $umum10; ?>, <?= $umum11; ?>, <?= $umum12; ?>],
                        data2: [<?= $umum21; ?>, <?= $umum22; ?>, <?= $umum23; ?>, <?= $umum24; ?>, <?= $umum25; ?>, <?= $umum26; ?>, <?= $umum27; ?>, <?= $umum28; ?>, <?= $umum29; ?>, <?= $umum210; ?>, <?= $umum211; ?>, <?= $umum212; ?>],
                    },
                    {
                        label: "Data Komoditas",
                        backgroundColor: [
                            '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5', '#2882c5'
                        ],
                        data: [<?= $komo1; ?>, <?= $komo2; ?>, <?= $komo3; ?>, <?= $komo4; ?>, <?= $komo5; ?>, <?= $komo6; ?>, <?= $komo7; ?>, <?= $komo8; ?>, <?= $komo9; ?>, <?= $komo10; ?>, <?= $komo11; ?>, <?= $komo12; ?>],
                        data2: [<?= $komo21; ?>, <?= $komo22; ?>, <?= $komo23; ?>, <?= $komo24; ?>, <?= $komo25; ?>, <?= $komo26; ?>, <?= $komo27; ?>, <?= $komo28; ?>, <?= $komo29; ?>, <?= $komo210; ?>, <?= $komo211; ?>, <?= $komo212; ?>],
                    },
                    {
                        label: "Data Non Komoditas",
                        backgroundColor: [
                            '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343', '#ea4343'
                        ],
                        data: [<?= $nonkomo1; ?>, <?= $nonkomo2; ?>, <?= $nonkomo3; ?>, <?= $nonkomo4; ?>, <?= $nonkomo5; ?>, <?= $nonkomo6; ?>, <?= $nonkomo7; ?>, <?= $nonkomo8; ?>, <?= $nonkomo9; ?>, <?= $nonkomo10; ?>, <?= $nonkomo11; ?>, <?= $nonkomo12; ?>],
                        data2: [<?= $nonkomo21; ?>, <?= $nonkomo22; ?>, <?= $nonkomo23; ?>, <?= $nonkomo24; ?>, <?= $nonkomo25; ?>, <?= $nonkomo26; ?>, <?= $nonkomo27; ?>, <?= $nonkomo28; ?>, <?= $nonkomo29; ?>, <?= $nonkomo210; ?>, <?= $nonkomo211; ?>, <?= $nonkomo212; ?>],
                    },
                    {
                        label: "Pengembangan Sistem Informasi",
                        backgroundColor: [
                            '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f', '#b29f9f'
                        ],
                        data: [<?= $si1; ?>, <?= $si2; ?>, <?= $si3; ?>, <?= $si4; ?>, <?= $si5; ?>, <?= $si6; ?>, <?= $si7; ?>, <?= $si8; ?>, <?= $si9; ?>, <?= $si10; ?>, <?= $si11; ?>, <?= $si12; ?>],
                        data2: [<?= $si21; ?>, <?= $si22; ?>, <?= $si23; ?>, <?= $si24; ?>, <?= $si25; ?>, <?= $si26; ?>, <?= $si27; ?>, <?= $si28; ?>, <?= $si29; ?>, <?= $si210; ?>, <?= $si211; ?>, <?= $si212; ?>],
                    }
                ]
            }
        });
    });
</script>

</body>

</html>