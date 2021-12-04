window.onload = () => {
    // Swal.fire({
    //     title: 'SweetAlert2 + Bootstrap 4',
    // })
}
let type_form = 1;
let id_area = null;
function openModalArea(option, id = null) {
    id_area = id;
    type_form = option;
    if (option == 1) {
        $('#modalEditTitle').text('Add a new area');
        $('#modalEdit').modal('show');
        $('#tableEmployees').hide();
        cleanForm('formArea')
    } else {
        cleanForm('formArea')
        Swal.fire({
            title: 'Loading info!',
            html: "Wait!, please. Area's information is comming.",
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
                        'function': 'get_area',
                        'id': id,
                    },
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response)
                        $('#nameInput').val(response.data.name);
                        var index = 1;
                        var text = '';
                        for (var item in response.data.employees) {
                            const employee = response.data.employees[item];
                            text += ` 
                            <tr>
                                <td>${index}</td>
                                <td>${employee['name']}</td>
                                <td>${employee['genre'] == 'm' ? 'man' : 'woman'}</td>
                            </tr > `;
                            index++;
                        }
                        console.log(text);
                        $('#tableEmployeesContent').html(text);
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            },
        }).then((result) => {
            $('#modalEditTitle').text('Edit area');
            $('#modalEdit').modal('show');
            $('#tableEmployees').show();
        })

    }

}

function saveArea() {
    if (type_form == 1) {
        $.ajax({
            type: 'POST',
            url: "../api.php",
            data: {
                'action_type': C_API,
                'function': 'insert_area',
                'name': $('#nameInput').val(),
            }
        }).done((response) => {
            response = JSON.parse(response);
            if (response.status == 'OK') {
                Swal.fire({
                    icon: 'success',
                    title: '¡The area has been created succesfully!',
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
                'function': 'update_area',
                'id': id_area,
                'name': $('#nameInput').val(),
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
    $('#tableEmployeesContent').html('');
}

function deleteArea(id) {
    Swal.fire({
        title: 'Are you sure to delete the area?',
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
                    'function': 'delete_area',
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