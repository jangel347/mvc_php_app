let type_form = 1;
let id_employee = null;
let employee_jobs = [];
function openModalEmployee(option, id = null) {
    validateButton()
    employee_jobs = [];
    type_form = option;
    if (option == 1) {
        $('#modalEditTitle').text('Add a new employee');
        $('#modalEdit').modal('show');
        cleanForm('formEmployee')
    } else {
        cleanForm('formEmployee')
        Swal.fire({
            title: 'Loading info!',
            html: "Wait!, please. Employee's information is comming.",
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false,
            closeOnConfirm: false,
            allowOutsideClick: false,
            didOpen: () => {
                $.ajax({
                    type: 'POST',
                    url: "../api.php",
                    data: {
                        'action_type': C_API,
                        'function': 'get_employee',
                        'employee_id': id,
                    },
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response)
                        $('#nameInput').val(response.data.name);
                        $("input[name=\"genreInput\"][value = '" + response.data.genre + "']").prop("checked", true);
                        $('#areaInput').val(response.data.area_id);
                        id_employee = response.data.id;
                        loadJobs(response.data.jobs);
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            },
        }).then((result) => {
            $('#modalEditTitle').text('Edit employee');
            $('#modalEdit').modal('show');
        })

    }

}

function loadJobs(jobs) {
    employee_jobs = [];
    for (var job in jobs) {
        $('#cbxJob' + jobs[job]['id']).prop('checked', true);
        employee_jobs.push(jobs[job]['id']);
    }
}

function saveEmployee() {
    if (type_form == 1) {
        $.ajax({
            type: 'POST',
            url: "../api.php",
            data: {
                'action_type': C_API,
                'function': 'insert_employee',
                'name': $('#nameInput').val(),
                'genre': $('input[name="genreInput"]:checked').val(),
                'area_id': $('#areaInput').val(),
                'jobs': employee_jobs
            }
        }).done((response) => {
            response = JSON.parse(response);
            if (response.status == 'OK') {
                Swal.fire({
                    icon: 'success',
                    title: '¡The employee has been created succesfully!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '¡Something is wrong, try again!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            console.log(response)
        });
    } else {
        $.ajax({
            type: 'POST',
            url: "../api.php",
            data: {
                'action_type': C_API,
                'function': 'update_employee',
                'id': id_employee,
                'name': $('#nameInput').val(),
                'genre': $('input[name="genreInput"]:checked').val(),
                'area_id': $('#areaInput').val(),
                'jobs': employee_jobs
            }
        }).done((response) => {
            response = JSON.parse(response);
            if (response.status == 'OK') {
                Swal.fire({
                    icon: 'success',
                    title: '¡The changes have been applied succesfully!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    location.reload();
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '¡Something is wrong, try again!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
            console.log(response)
        });
        validateButton()
    }
}

function cleanForm(id) {
    $('#' + id)[0].reset();
    validateButton()
}

function deleteEmployee(id) {
    Swal.fire({
        title: 'Are you sure to delete the employee?',
        showDenyButton: true,
        confirmButtonText: 'Yes, delete',
        denyButtonText: `No, cancel`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: "../api.php",
                data: {
                    'action_type': C_API,
                    'function': 'delete_employee',
                    'id': id
                }
            }).done((response) => {
                response = JSON.parse(response);
                if (response.status == 'OK') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡The changes have been applied succesfully!',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: '¡Something is wrong, try again!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
                console.log(response)
            });
        }
    });
}

function addId(id) {
    if (employee_jobs.indexOf(id) == -1) {
        employee_jobs.push(id);
    } else {
        removeItemFromArr(id, employee_jobs)
    }
    validateButton()
}

function removeItemFromArr(item, list) {
    var i = list.indexOf(item);
    list.splice(i, 1);
}

function validateButton() {
    if ($('#nameInput').val().trim() != ''
        && $('input[name="genreInput"]:checked').val().trim() != ''
        && $('#areaInput').val().trim() != '' && employee_jobs.length > 0) {
        $("#btnSave").prop('disabled', false);
    } else {
        $("#btnSave").prop('disabled', true);
    }
}