$(document).ready(function() {

    // Users
    postRequest();
    getCities();
    getRoles();

    // Profile
    getProfileData();

    //Cities
    // getAllCities();


    $('#labelText').html('Inactivo');
    $('#flexSwitchCheckStatus').attr('value', '0');
    $('#flexRadioFemale').val('F');
    $('#flexRadioFemale').attr('checked', true);

    $('#flexRadioMale').val('M');

    $('#passwordInput').removeClass('d-none');
    $('#campoEscondido').val('0');

    // Roles
    getRolesPost();
    
    if(document.getElementById('flexSwitchCheckRoleStatus').checked == false) {
        $('#labelRoleText').html('Inactivo');
        $('#labelRoleText').addClass('error-text');
        $('#flexSwitchCheckRoleStatus').attr('value', '0');
    } 

    titleTabs('Empleados');


    
    // Cities
    if (document.getElementById('flexSwitchCheckCountry').checked  == false) {
        $('#labelCityText').css('color', '#FF0000');
        $('#labelCityText').html('Inactivo');
        $('#flexSwitchCheckCountry').attr('value', '0');
    } else {
        $('#labelCityText').css('color', '#000000');
        $('#labelCityText').html('Activo');
        $('#flexSwitchCheckCountry').attr('value', '1');
    }

});


function editUSer(id) {

    typeProcess(2);
    
    let data = new FormData();
    data.append('id', id);

    axios.post(`/editUser`, data)
    .then(function (response) {
        console.log(response);

        $('#passwordInput').addClass('d-none');

        $('#nameInput').val(response.data[0].name);
        $('#lastNamesInput').val(response.data[0].last_name);
        $('#phoneInput').val(response.data[0].phone);
        $('#emailInput').val(response.data[0].email);
        $('#addressInput').val(response.data[0].address);
        $('#neightborInput').val(response.data[0].neightboarhood);

        if (response.data[0].sex == 'M') {
            $('#flexRadioMale').attr('checked', true);
            $('#flexRadioFemale').attr('checked', false);    
        } else {
            $('#flexRadioFemale').attr('checked', true);
            $('#flexRadioMale').attr('checked', false);   
        }

        if (response.data[0].status == "1") {
            $('#flexSwitchCheckStatus').attr('checked', true)
            $('#flexSwitchCheckStatus').append('Activo');
        } else {
            $('#flexSwitchCheckStatus').attr('checked', false);
            $('#flexSwitchCheckStatus').append('Inactivo');
        }

        $('#cities').val(response.data[0].city_id);
        $('#roles').val(response.data[0].role_id);

        $('#campoEscondido').val(response.data[0].id);

    })
    .catch(function (error) {
        console.log(error);
    });
}


function deleteUser(id) {
    console.log(id);

    Swal.fire({
        title: 'Eliminar Usuarios',
        text: "¿Quiere usted de verdad eliminar a este usuario?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrelo!'
      }).then((result) => {
        if (result.isConfirmed) {

            let data = new FormData();
            data.append('id', id);

            axios.post(`/deleteUser`, data)
            .then(function (response) {
                console.log(response); 
                Swal.fire(
                  'Borrado!',
                  'El usuario fue borrado exitosamente.',
                  'success'
                )
            })
            .catch(function (error) {
                console.log(error);
            });
        }
      })
}


function typeProcess(type, id='0') {
    
    switch (type) {
        case 1:
            reseatFields();
            $('#processUser').attr('action', 'storeUsers');
            $('#passwordInput').removeClass('d-none');
            $('#ModalUserLabel').html('Crear Usuarios');
            $('#submitButton').html('Guardar');
            break;

        case 2:
            $('#ModalUser').modal('show');
            $('#processUser').attr('action', 'updateUsers');
            $('#ModalUserLabel').html('Editar Usuarios');
            $('#submitButton').html('Editar');
            break;

        case 3:
            console.log(id);
            $('#passwordModal').modal('show');
            $('#userId').val(id);
            break;
    }

}



function postRequest() {

    let data = {};

    axios.post(`/getUsers`, data)
    .then(function (response) {
        response.data.forEach(element => {
            localStorage.setItem('id', JSON.stringify(element.id));
            let bodyTable = `
                <tr class="text-center">
                    <th class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.name} ${element.last_name}</th>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.address}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.neightboarhood}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.phone}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.email}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.roles.name}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.sex == 'M' ? 'Masculino' : 'Femenino'}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.cities[0].name}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.status  == '1' ? 'Activo' : 'Inactivo'}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">
                        <i class="fa-regular fa-pen-to-square cursor-pointer" onclick="editUSer(${element.id})"></i>
                        <i class="fa-solid fa-trash cursor-pointer" onclick="deleteUser(${element.id})"></i>
                    </td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">
                        <button type="button" class="btn btn-warning" onclick="typeProcess(3, ${element.id})">Cambiar</button>
                    </td>
                </tr>
            `; 
            $('#userRegisters').append(bodyTable);
        });
    })
    .catch(function (error) {
        console.log(error);
    });

}

function getCities() {

    let data = {};

    axios.post(`/getCities`, data)
    .then(function (response) {
        
        response.data.forEach(element => {
            let optionsCities = `
                <option value="${element.id}" class="font-parking24">${element.name}</option>
            `; 
            $('#cities').append(optionsCities);
        });

    })
    .catch(function (error) {
        console.log(error);
    });

}

function getRoles() {

    let data = {};

    axios.post(`/getRoles`, data)
    .then(function (response) {
        
        response.data.forEach(element => {
            let optionsRoles = `
                <option value="${element.id}" class="font-parking24">${element.name}</option>
            `; 
            $('#roles').append(optionsRoles);
        });

    })
    .catch(function (error) {
        console.log(error);
    });

}


function changeText() {

    if (document.getElementById('flexSwitchCheckStatus').checked) {
        $('#flexSwitchCheckStatus').attr('value', '1');
        $('#labelText').html(document.getElementById('flexSwitchCheckStatus').checked == true ? 'Activo' : 'Inactivo');
    } else {
        $('#flexSwitchCheckStatus').attr('value', '0');
        $('#labelText').html(document.getElementById('flexSwitchCheckStatus').checked == false ? 'Inactivo' : 'Activo');
    }

}


function setValueGenre() {
    $('#flexRadioMale').val('M');
    $('#flexRadioFemale').val('F');
}


function reseatFields(tipo) {

    if (tipo == 1) {

        $('#nameInput').val('');
        $('#lastNamesInput').val('');
        $('#phoneInput').val('');
        $('#emailInput').val('');
        $('#addressInput').val('');
        $('#neightborInput').val('');
        $('#neightborInput').val('');
        $('#flexRadioFemale').attr('checked', true);
        $('#flexSwitchCheckStatus').attr('checked', false);
        $('#exampleInputPassword1').val('');
        $('#cities').val('0');
        $('#roles').val('0');
        
    } else {

        $('#RoleInput').val('');
        $('#flexSwitchCheckRoleStatus').attr('checked', false);

    }

}


function changePassword() {
    let data = new FormData();
    data.append('passwordNew', document.getElementById('passwordInputNew').value);
    data.append('userId', document.getElementById('userId').value);

    axios.post(`/change`, data)
    .then(function (response) {

        Swal.fire( 'Actualizado!', `${response.data}`, 'success' );
       setTimeout(() => {
           location.reload();
       }, 4000); 

    })
    .catch(function (error) {
        console.log(error);
    });
}



function getRolesPost() {

    let data = {};

    axios.post(`/roles`, data)
    .then(function (response) {
        response.data.forEach(element => {
            let bodyRoleTable = `
                <tr class="text-center">
                    <th class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.id}</th>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.name}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">${element.status  == '1' ? 'Activo' : 'Inactivo'}</td>
                    <td class="col-12 col-sm-8 col-md-6 col-lg-4 col-xl-4">
                        <i class="fa-regular fa-pen-to-square cursor-pointer" onclick="typeProcessRoles(2, ${element.id});"></i>
                        <i class="fa-solid fa-trash cursor-pointer" onclick="deleteRoles(${element.id})"></i>
                    </td>
                </tr>
            `; 
            $('#roleTable').append(bodyRoleTable);
        });
    })
    .catch(function (error) {
        console.log(error);
    });

}


function typeProcessRoles(type, id = '0') {

    switch (type) {
        case 1:
            $('#ModalRolesLabel').html('Crear Roles');
            $('#roleSubmitButton').html('Crear');
            $('#processRole').attr('action', 'createRole');    
            break;

        case 2:
            updateRoles(id);
            $('#rolId').val(id);
            $('#ModalRolesLabel').html('Editar Roles');
            $('#roleSubmitButton').html('Editar');
            $('#processRole').attr('action', 'editRole');
            $('#ModalRoles').modal('show');    
            break;
    
        default:
            break;
    }

}



function changeRoleState() {

    if (document.getElementById('flexSwitchCheckRoleStatus').checked == true) {
        $('#labelRoleText').html('Activo');
        $('#labelRoleText').removeClass('error-text');
        $('#flexSwitchCheckRoleStatus').attr('value', '1');
    } else {
        $('#labelRoleText').html('Inactivo');
        $('#labelRoleText').addClass('error-text');
        $('#flexSwitchCheckRoleStatus').attr('value', '0');
    }

}


function updateRoles(id) {
    let data = new FormData();
    data.append('id', id);

    axios.post(`/editRoles`, data)
    .then(function (response) {
        $('#RoleInput').val(response.data[0].name);
        response.data[0].status == '1' ? $('#flexSwitchCheckRoleStatus').attr('checked', true) : $('#flexSwitchCheckRoleStatus').attr('checked', false); 
        response.data[0].status == '1' ? $('#labelRoleText').html('Activo') : $('#labelRoleText').html('Inactivo'); 
    })
    .catch(function (error) {
        console.log(error);
    });
}


function titleTabs(type) {
    $('#titleTab').html(`Lista de ${type} Parking24`);
}


function deleteRoles(id) {
    Swal.fire({
        title: 'Eliminar Usuarios',
        text: "¿Desea eliminar este rol?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Borrelo!'
      }).then((result) => {
        if (result.isConfirmed) {

            let data = new FormData();
            data.append('id', id);

            axios.post(`/deleteRole`, data)
            .then(function (response) {

                Swal.fire( 'Borrado!'   , 'El rol fue borrado exitosamente.', 'success' );
                setTimeout(() => {
                    location.reload();
                }, 4000); 

            })
            .catch(function (error) {
                Swal.fire(
                  'No puede',
                  'No se puede borrar este rol porque ya esta asignado a algún usuario',
                  'error'
                )
            });
        }
    })
}


/* Profiles */
function getProfileData() {

    let data = {};

    axios.post(`/getProfile`, data)
    .then(function (response) {
        let status = response.data[0].status == '1' ? 'Activo' : 'Inactivo';

        $('#titleUser').html(`${response.data[0].name} ${response.data[0].last_name}`);
        $('#statusUser').html(`${status}`);
        $('#names').val(`${response.data[0].name}`);
        $('#lastNames').html(`${response.data[0].last_name}`);
        $('#email').val(`${response.data[0].name} ${response.data[0].email}`);
        $('#address').val(`${response.data[0].name} ${response.data[0].address}`);
        $('#city').val(`${response.data[0].cities[0].name}`);
        $('#phone').val(`${response.data[0].cities[0].phone}`);
        $('#neighboard').val(`${response.data[0].neightboarhood}`);
        $('#role').val(`${response.data[0].roles.name}`);
    })
    .catch(function (error) {
        console.log(error);
    });
    
}


//cities
function getAllCities() {

    let data = {};

    axios.post(`/getCities`, data)
    .then(function (response) {
        console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });

}


function typeProcess(type) {
    switch (type) {
        case 1:
            reseatFields();
            $('#processCities').attr('action', 'storeCity')
            $('#ModalCitiesLabel').html('Crear Ciudades');
            $('#citiesSubmitButton').html('Crear Ciudad');
            $('#ModalCities').modal('show');
            break;
    }
}


function reseatFields() {
    $('#cityInput').val('');
    $('#countryInput').val('0');
    $('#flexSwitchCheckCountry').attr('checked', false);
}

function changeStatus() {
    if (document.getElementById('flexSwitchCheckCountry').checked == true) {
        $('#labelCityText').css('color', '#000000');
        $('#labelCityText').html('Activo');   
        $('#flexSwitchCheckCountry').attr('value', '1');
    } else {
        $('#labelCityText').css('color', '#FF0000');
        $('#labelCityText').html('Inactivo');
        $('#flexSwitchCheckCountry').attr('value', '0');
    }
}


