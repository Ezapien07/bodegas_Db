const limpiarModalAgregar = () => {
    $("#txtNombre").val("");
    $("#txtPrecio").val("");
};
const limpiarModalAumentar =()=>{
    $('#txtIdProducto').val("");
    $('#txtCantidadActual').val("");
    $('#txtCantidad').val("");
}
const guardarProductos = async () => {
    let salida = validarCamposInsumos();
    if (salida === true) {
        let nom = $("#txtNombre").val();
        let precio = $("#txtPrecio").val();
        datos = {
            nombre: nom,
            precio: precio,
            estatus: 1,
            _token: $('input[name="_token"]').val(),
        };
        console.log(datos);
        swal(
            {
                title: "¿Deseas continuar?",
                text: "Por favor, confirma que deseas agregar el producto.",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#4caf50",
                confirmButtonText: "Si, agregar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function () {
                $.ajax({
                    url: "/productos/acciones/agregar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        console.log(res);
                        if (res ==="true") {
                            limpiarModalAgregar();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se agregó correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/productos";
                                }
                            );
                        } else {
                            swal(
                                {
                                    type: "error",
                                    title: "Error",
                                    text: "Ha ocurrido un error al momento de guardar",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/productos";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        console.log(res);
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", salida, "bottom", "right", "", "");
    }
};

const eliminarProductos = (uid) => {
    datos = {
        idProducto: uid,
        _token: $('input[name="_token"]').val(),
    };
    console.log(datos);
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que deseas eliminar el producto. ",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, eliminar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/productos/acciones/eliminar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    console.log(res);
                    if (res == "true") {
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se elimino correctamente el registro.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de procesar tu solicitud",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    console.log(res);
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de procesar tu solicitud",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/productos";
                        }
                    );
                });
        }
    );
};
const activarProductos = (uid) => {
    datos = {
        idProducto: uid,
        _token: $('input[name="_token"]').val(),
    };
    swal(
        {
            title: "¿Deseas continuar?",
            text: "Por favor, confirma que deseas activar el producto. ",
            type: "info",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#4CAF50",
            confirmButtonText: "Si, activar",
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        },
        function () {
            $.ajax({
                url: "/productos/acciones/activar",
                method: "POST",
                data: datos,
            })
                .done(function (res) {
                    console.log(res);
                    if (res == "true") {
                        swal(
                            {
                                type: "success",
                                title: "Correcto",
                                text: "Se elimino correctamente el registro.",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    } else {
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de procesar tu solicitud",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    }
                })
                .fail(function (res) {
                    console.log(res);
                    swal(
                        {
                            type: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al momento de procesar tu solicitud",
                            confirmButtonText: "OK",
                        },
                        function () {
                            location.href = "/productos";
                        }
                    );
                });
        }
    );
};

function abrirModalAumentar(idProducto, cantidad) {
    // Encuentra el modal por su ID (ajusta el ID según tu HTML)
    var modal = document.getElementById('modalAumentar');

    // Encuentra los elementos de input dentro del modal
    var inputIdProducto = modal.querySelector('#txtIdProducto');
    var inputCantidad = modal.querySelector('#txtCantidadActual');
    console.log(idProducto);
    console.log(cantidad);
    $('#txtIdProducto').val(idProducto);
    $('#txtCantidadActual').val(cantidad);
    // Asigna los valores a los inputs
    inputIdProducto.value = idProducto;
    inputCantidad.value = cantidad;

    // Muestra el modal (ajusta según tu framework de modales)
    $('#modalAumentar').modal('show');
}
const aumentarInventarioProducto = async () => {
    let salida = validaAumentar();
    if (salida === true) {
        let idProducto = $("#txtIdProducto").val();
        let cantidad = $("#txtCantidad").val();
        let cantidadActual = $('#txtCantidadActual').val();
        if (cantidadActual >= cantidad) {
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "La cantidad a aumentar debe de ser mayor a la cantidad actual",
                    confirmButtonText: "OK",
                }
            );
        } else if(cantidadActual<cantidad) {
            datos = {
                idProducto: idProducto,
                cantidad: cantidad,
                _token: $('input[name="_token"]').val(),
            };
            swal(
                {
                    title: "¿Deseas continuar?",
                    text:
                        "Por favor, confirma que deseas aumentar el inventario del producto ",
                    type: "info",
                    showCancelButton: true,
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#4caf50",
                    confirmButtonText: "Si, modificar",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                function () {
                    $.ajax({
                        url: "/productos/acciones/aumentar",
                        method: "POST",
                        data: datos,
                    })
                        .done(function (res) {
                            console.log(res);
                            if (res == "true") {
                                limpiarModalAumentar();
                                swal(
                                    {
                                        type: "success",
                                        title: "Correcto",
                                        text: "Se modifico correctamente el registro.",
                                        confirmButtonText: "OK",
                                    },
                                    function () {
                                        location.href = "/productos";
                                    }
                                );
                            } else {
                                swal(
                                    {
                                        type: "error",
                                        title: "Error",
                                        text: "Ha ocurrido un error al momento de guardar",
                                        confirmButtonText: "OK",
                                    },
                                    function () {
                                        location.href = "/productos";
                                    }
                                );
                            }
                        })
                        .fail(function (res) {
                            console.log(res);
                            swal(
                                {
                                    type: "error",
                                    title: "Error",
                                    text: "Ha ocurrido un error al momento de guardar",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/productos";
                                }
                            );
                        });
                }

            );
        }
         else {
            showNotification("bg-red", salida, "bottom", "right", "", "");
        }
    }


};

const modificarProducto = async () => {
    let salida = validarCamposProducto();
    if (salida ===true) {
        let uid = $("#txtIdInsumos").val();
        let desc = $("#txtDescripcionInsumo").val();
        let codi = $("#txtCodigoInsumo").val();
        let nom = $("#txtNombreInsumo").val();
        let minima = $("#txtCantidadMinInsumo").val();
        let consu = document.getElementById("chechInsumoConsumible").checked;
        datos = {
            id: uid,
            nombre: validarCamposLetras(nom),
            descripcion: validarCamposLetras(desc),
            codigo: validarCamposLetras(codi),
            estatus: 1,
            tipo: consu ? true : false,
            cantidad_minima: minima,
            _token: $('input[name="_token"]').val(),
        };
        swal(
            {
                title: "¿Deseas continuar?",
                text:
                    "Por favor, confirma que deseas modificar el insumo " +
                    nom +
                    ". ",
                type: "info",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#4caf50",
                confirmButtonText: "Si, modificar",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function () {
                $.ajax({
                    url: "/productos/acciones/modificar",
                    method: "POST",
                    data: datos,
                })
                    .done(function (res) {
                        console.log(res);
                        if (res == "OK") {
                            limpiarInsumos();
                            swal(
                                {
                                    type: "success",
                                    title: "Correcto",
                                    text: "Se modifico correctamente el registro.",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/productos";
                                }
                            );
                        } else {
                            swal(
                                {
                                    type: "error",
                                    title: "Error",
                                    text: "Ha ocurrido un error al momento de guardar",
                                    confirmButtonText: "OK",
                                },
                                function () {
                                    location.href = "/productos";
                                }
                            );
                        }
                    })
                    .fail(function (res) {
                        console.log(res);
                        swal(
                            {
                                type: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al momento de guardar",
                                confirmButtonText: "OK",
                            },
                            function () {
                                location.href = "/productos";
                            }
                        );
                    });
            }
        );
    } else {
        showNotification("bg-red", salida, "bottom", "right", "", "");
    }
};

const validarCamposInsumos = () => {
    if ($("#txtNombre").val() == "") {
        return "Por favor, indica el nombre. ";
    }
    if ($("#txtPrecio").val() == "" && $("#txtPrecio").val()>0) {
        return "Por favor, indica un precio";
    }
    return true;
};

const validaAumentar = () => {
    if ($("#txtCantidad").val() == "" && $("#txtCantidad").val()>0) {
        return "Por favor, indica una cantidad ";
    }
    return true;
};



