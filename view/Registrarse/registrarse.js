

var tabla;

init();

function init(){

    $("#registrarse_form").on("submit",function(e){

        e.preventDefault();//para que no se realice 2 veces la misma accion

        if($("#usu_pass").val() == $("#usu_passrep").val()){

            consultaryguardar(e); 

        }else{

            swal({
                title: "Atención!",
                text: "La contraseñas no coinciden",
                type: "warning",
                confirmButtonClass: "btn-warning"
            });

        }
        
    });
}

function consultaryguardar(e){

    var correo = $("#usu_correo").val();

    // console.log($("#usu_correo").val());
    // return;

    $.post("../../controller/usuario.php?op=verificarCorreo", {correo : correo}, function (data) {

        if(data != ""){

            data = JSON.parse(data);

            swal({
                title: "Atención!",
                text: "El usuario '" + data.usu_correo + "' ya está registrado.",
                type: "warning",
                confirmButtonClass: "btn-warning"
            });
            // swal("Atención", "El usuario " + data.usu_correo + "ya está registrado.", "success");

        }else{

            // console.log("NO HAY REGISTROS");

            swal({
                title: "Guardar",
                text: "Esta seguro de Guardar el registro?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: false
            }, function(isConfirm) {

                if (isConfirm) {

                    var formData = new FormData($("#registrarse_form")[0]);

                    $.ajax({
                        url: "../../controller/usuario.php?op=guardaryeditar",
                        type: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(datos){

                            console.log(datos);
                            $('#registrarse_form')[0].reset();

                            swal({
                                title: "Completado!",
                                text: "Completado Correctamente",
                                type: "success",
                                confirmButtonClass: "btn-success"
                            });
                        }
                    }); 

                }

            })

        }
        
        // $('#tar_descrip').val(data.tar_descrip);
        // $('#tar_id').val(data.tar_id);

    }); 
    
}


$(document).on("click","#btnnuevo", function(){
    // console.log("PRUEBA");
    // $('#usu_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#tarifa_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});
