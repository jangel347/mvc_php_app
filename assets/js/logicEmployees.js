window.onload = () => {
    // Swal.fire({
    //     title: 'SweetAlert2 + Bootstrap 4',
    // })
}
let type_form = 1;
function openModalEmployee(option, id = null) {
    type_form = option;
    if (option == 1) {
        $('#modalEditTitle').text('Add new employee');
        $('#modalEdit').modal('show');
        cleanForm('formEmployee')
    } else {
        cleanForm('formEmployee')
        $.ajax({
            url: "../../api.php",
            data: {

            },
            success: function (result) {
                $("#div1").html(result);
            }
        });
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
                    url: "../api.php",
                    data: {
                        'action_type': C_API,
                        'function': 'insert_employee',
                        'name': $('#nameInput').val(),
                        'genre': $('#genreInput').val(),
                        'area_id': $('#areaInput').val(),
                    },
                    success: function (result) {
                        console.log(result)
                    }
                });
                $('#modalEditTitle').text('Edit employee');
                $('#modalEdit').modal('show');
            },
        }).then((result) => {

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
            console.log(response)
        });
    }
}

function cleanForm(id) {
    $('#' + id)[0].reset();
}

function addEmployee() {

}