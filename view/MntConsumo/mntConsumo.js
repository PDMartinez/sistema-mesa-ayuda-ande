

/*=====================================================
  EVENTO QUE LLAMA A LA FUNCION DE GUARDAR Y EDITAR REGISTRO
======================================================*/

init();

function init(){

    $("#consumo_form").on("submit",function(e){
        // console.log("Ingresa");
        guardaryeditar(e); 
    });

}

/*=====================================================
  GUARDAR Y EDITAR REGISTRO
======================================================*/

function guardaryeditar(e){

    e.preventDefault();//para que no se realice 2 veces la misma accion
    
    var formData = new FormData($("#consumo_form")[0]);

    // console.log($("#consumo_form")[0]);
    // return;

    $.ajax({
        url: "../../controller/consumo.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            // console.log(datos);

            $('#consumo_form')[0].reset();
            $('#cons_id').val("");
            $("#modalmantenimiento").modal('hide');
            $('#consumo_data').DataTable().ajax.reload();

            swal({
                title: "Completado!",
                text: "Completado Correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

/*=====================================================
  LISTAR DATOS EN LA TABLA
======================================================*/

var tabla;

$(document).ready(function(){

    // console.log($("#user_idx").val());
    // return;

    var usu_id = $("#user_idx").val();

    tabla=$('#consumo_data').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [                
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
                ],
        "ajax":{
                url: '../../controller/consumo.php?op=listar',
                type : "post",
                dataType : "json",  
                data:{ usu_id : usu_id },                       
                error: function(e){
                    console.log(e.responseText);    
                }
            },
        "bDestroy": true,
        "responsive": true,
        "bInfo":true,
        "iDisplayLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }     
    }).DataTable();

});

/*=====================================================
  EDITAR REGISTRO
======================================================*/

function editar(cons_id) {

    // console.log(cons_id);
    // return;
    
    $('#cons_id').val('');
    $("#tar_id").empty();
    $('#mdltitulo').html('Editar Registro');
    $('#consumo_form')[0].reset();

    cargarTarifas();

    $('#modalmantenimiento').modal('show');

    $.post("../../controller/consumo.php?op=mostrar", {cons_id : cons_id}, function (data) {
        data = JSON.parse(data);

        // console.log(data);
        $('#cons_id').val(data.cons_id);
        $('#tar_id').val(data.tar_id).trigger('change');
        $('#periodo_inicial').val(data.periodo_inicial);
        $('#periodo_final').val(data.periodo_final);
        $('#lectura_ant').val(data.lectura_ant);
        $('#lectura_act').val(data.lectura_act);
        $('#consumo').val(parseInt(data.lectura_act) - parseInt(data.lectura_ant));
        $('#fecha_crea').val(data.fecha_crea.split(" ", 1));

    });

    $('#modalmantenimiento').modal('show');

}

/*=====================================================
  ELIMINAR REGISTRO
======================================================*/

function eliminar(cons_id){

    // console.log(cons_id);
    // return;

    swal({
        title: "Eliminar",
        text: "Esta seguro de Eliminar el registro?",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Si",
        cancelButtonText: "No",
        closeOnConfirm: false
    },
    function(isConfirm) {

        if (isConfirm) {
            
            $.post("../../controller/consumo.php?op=eliminar", {cons_id : cons_id}, function (data) {

            }); 

            $('#consumo_data').DataTable().ajax.reload();   

            swal({
                title: "Exito!",
                text: "Registro Eliminado Correctamente.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });

}

/*=====================================================
  EVENTO NUEVO
======================================================*/

$(document).on("click","#btnnuevo", function(){
    // console.log("PRUEBA");
    $('#cons_id').val('');
    $("#tar_id").empty();
    // $("#lectura_ant").val("0");
    // $("#lectura_act").val("0");
    $('#mdltitulo').html('Nuevo Registro');
    $('#consumo_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    cargarTarifas();

    agregarFecha();

});

/*=====================================================
  CARGAR TARIFAS
======================================================*/

function cargarTarifas(){

    $.post("../../controller/tarifa.php?op=listarTodo", function (data) {

        data = JSON.parse(data);

        $("#tar_id").append('<option selected value="">--Seleccione una Tarifa--</option>');

        $.each(data, function(id,value){

            $("#tar_id").append('<option value="'+value.tar_id+'">'+value.tar_descrip+'</option>');
            // $('#tar_id').val(value.tar_id).trigger('change');

        });        

    }); 

}

/*=============================================
  GENERAMOS LA FECHA ACTUAL
=============================================*/

function agregarFecha(){

  var now = new Date();

  var day = ("0" + now.getDate()).slice(-2);
  var month = ("0" + (now.getMonth() + 1)).slice(-2);

  var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
  $("#fecha_crea").val(today);

}

/*=====================================================
  EVENTO PARA CALCULAR CONSUMO
======================================================*/

$("#consumo_form").on("keyup keydown change", "input#lectura_ant", function(){

    if($("#lectura_ant").val() == ""){

        $("#lectura_ant").val("0");

    }

    if($("#lectura_act").val() == ""){

        $("#lectura_act").val("0");

    }

    if($("#lectura_ant").val() != "" && $("#lectura_act").val() != ""){

        
        var lectura_ant = parseInt($("#lectura_ant").val());
        var lectura_act = parseInt($("#lectura_act").val());

        // console.log(lectura_ant);
        // console.log(lectura_act);

        if(lectura_act >= lectura_ant){

            $("#consumo").val(lectura_act - lectura_ant);

        }else{

            swal({

                title: "Atención!",
                text: "La lectura anterior no puede ser mayor al actual",
                type: "warning",
                confirmButtonClass: "btn-warning"

            });

            $("#lectura_ant").val($("#lectura_act").val())

        }

    }

});

/*=====================================================
  EVENTO PARA CALCULAR CONSUMO
======================================================*/

$("#consumo_form").on("keyup keydown change", "input#lectura_act", function(){

    if($("#lectura_ant").val() == ""){

        $("#lectura_ant").val("0");

    }

    if($("#lectura_act").val() == ""){

        $("#lectura_act").val("0");

    }

    if($("#lectura_ant").val() != "" && $("#lectura_act").val() != ""){

        
        var lectura_ant = parseInt($("#lectura_ant").val());
        var lectura_act = parseInt($("#lectura_act").val());

        // console.log(lectura_ant);
        // console.log(lectura_act);

        if(lectura_act >= lectura_ant){

            $("#consumo").val(lectura_act - lectura_ant);

        }else{

            swal({

                title: "Atención!",
                text: "La lectura actual no puede ser menor al anterior",
                type: "warning",
                confirmButtonClass: "btn-warning"

            });

            $("#lectura_act").val($("#lectura_ant").val())

        }

    }

});

/*=====================================================
  VALIDAR FECHAS DE PERIODO INICIAL Y FINAL
======================================================*/

$("#periodo_inicial").change(function() {

    if( (new Date($("#periodo_inicial").val()).getTime() > new Date($("#periodo_final").val()).getTime())){
          
        swal({
                
            title: "Atención!",
            text: "El periodo inicial no puede ser mayor al periodo final",
            type: "warning",
            confirmButtonClass: "btn-warning"

        });

        $("#periodo_final").val($("#periodo_inicial").val());

    }

});

/*=====================================================
  VALIDAR FECHAS DE PERIODO INICIAL Y FINAL
======================================================*/

$("#periodo_final").change(function() {

    if( (new Date($("#periodo_inicial").val()).getTime() > new Date($("#periodo_final").val()).getTime())){
          
        swal({
                
            title: "Atención!",
            text: "El periodo final no puede ser menor al periodo inicial",
            type: "warning",
            confirmButtonClass: "btn-warning"

        });

        $("#periodo_final").val($("#periodo_inicial").val());

    }

});

/*=====================================================
  VER ESTADISTICA
======================================================*/

function verEstadistica(usu_id){

    // console.log(usu_id);

    window.location = ('http://localhost/SistemaAyuda/view/Estadistica/?ID='+ usu_id +'');
    // window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

}

/*=====================================================
  VALIDAR SOLO NUMEROS
======================================================*/

function format(input){

    var num = input.value.replace(/\./g,'');

    if(!isNaN(num)){

        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
        input.value = num;

    }
    //-- ALERTA SOLO NUMEROS
    else{

        alert('Solo se permiten numeros');
        input.value = input.value.replace(/[^\d\.]*/g,'');
    }
}
