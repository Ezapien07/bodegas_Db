
const limpiarModalRestar =()=>{
    $('#txtIdProducto').val("");
    $('#txtCantidadActual').val("");
    $('#txtCantidad').val("");
}


function abrirModalSalida(idProducto, cantidad) {
    // Encuentra el modal por su ID (ajusta el ID según tu HTML)
    var modal = document.getElementById('modalSalida');

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
    $('#modalSalida').modal('show');
}
const validaSalida = () => {
    if ($("#txtCantidad").val() == "" && $("#txtCantidad").val()>0) {
        return "Por favor, indica una cantidad ";
    }
    return true;
};
const restarInventarioProducto = async () => {
    let salida=validaSalida();
    if (salida === true) {
        let idProducto = $("#txtIdProducto").val();
        let cantidad = $("#txtCantidad").val();
        let cantidadActual = $('#txtCantidadActual').val();
        if (cantidadActual <cantidad) {
            swal(
                {
                    type: "error",
                    title: "Error",
                    text: "La cantidad de salida no debe de ser mayor a la actual",
                    confirmButtonText: "OK",
                }
            );
        } else if(cantidadActual>=cantidad) {
            datos = {
                idProducto: idProducto,
                cantidad: cantidad,
                _token: $('input[name="_token"]').val(),
            };
            swal(
                {
                    title: "¿Deseas continuar?",
                    text:
                        "Por favor, confirma que deseas dar salida del inventario del producto ",
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
                        url: "/productos/acciones/salida",
                        method: "POST",
                        data: datos,
                    })
                        .done(function (res) {
                            console.log(res);
                            if (res == "true") {
                                limpiarModalRestar();
                                swal(
                                    {
                                        type: "success",
                                        title: "Correcto",
                                        text: "Se modifico correctamente el registro.",
                                        confirmButtonText: "OK",
                                    },
                                    function () {
                                        location.href = "/salidas";
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
                                        location.href = "/salidas";
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
                                    location.href = "/salidas";
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




