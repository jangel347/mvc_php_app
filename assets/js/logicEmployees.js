window.onload = () => {
    // Swal.fire({
    //     title: 'SweetAlert2 + Bootstrap 4',
    // })
}
let type_form = 1;
let id_employee = null;
function openModalEmployee(option, id = null) {
    type_form = option;
    if (option == 1) {
        $('#modalEditTitle').text('Add new employee');
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
}

function cleanForm(id) {
    $('#' + id)[0].reset();
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