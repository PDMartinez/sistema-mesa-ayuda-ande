

var tabla;

init();

function init(){
    $("#fajaConsumo_form").on("submit",function(e){

        e.preventDefault();//para que no se realice 2 veces la misma accion
        // console.log("Ingresa");
        if(validarConsumo()){

            guardaryeditar(e); 

        }
        
    });
}

function guardaryeditar(e){
    
    var formData = new FormData($("#fajaConsumo_form")[0]);

    // console.log($("#fajaConsumo_form")[0]);
    // return;

    $.ajax({
        url: "../../controller/fajaConsumo.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            // console.log(datos);
            $('#fajaConsumo_form')[0].reset();
            $('#fajaConsumo_id').val("");
            $("#modalmantenimiento").modal('hide');
            $('#fajaConsumo_data').DataTable().ajax.reload();

            swal({
                title: "Exito!",
                text: "Completado Correctamente",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    }); 
}

$(document).ready(function(){

    tabla=$('#fajaConsumo_data').dataTable({
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
            url: '../../controller/fajaConsumo.php?op=listar',
            type : "post",
            dataType : "json",                      
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

function editar(faja_id) {

    // console.log(faja_id);
    // return;
    cargarTarifas();
    $('#fajaConsumo_id').val('');
    $("#cmbFajaConsumo").empty();
    $('#mdltitulo').html('Nuevo Registro');
    $('#fajaConsumo_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    $.post("../../controller/fajaConsumo.php?op=mostrar", {faja_id : faja_id}, function (data) {
        data = JSON.parse(data);

        // console.log(data);
        $('#fajaConsumo_id').val(data.faja_id);
        $('#cmbFajaConsumo').val(data.tar_id).trigger('change');
        $('#consumo_inicial').val(data.consumo_inicial);
        $('#consumo_final').val(data.consumo_final);
        $('#precio').val(data.precio);

    });

    $('#modalmantenimiento').modal('show');

}

function eliminar(faja_id){

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
            $.post("../../controller/fajaConsumo.php?op=eliminar", {faja_id : faja_id}, function (data) {

            }); 

            $('#fajaConsumo_data').DataTable().ajax.reload();   

            swal({
                title: "Exito!",
                text: "Registro Eliminado Correctamente.",
                type: "success",
                confirmButtonClass: "btn-success"
            });
        }
    });

}

$(document).on("click","#btnnuevo", function(){
    // console.log("PRUEBA");
    $('#fajaConsumo_id').val('');
    $("#cmbFajaConsumo").empty();
    $('#mdltitulo').html('Nuevo Registro');
    $('#fajaConsumo_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    cargarTarifas();

});

function cargarTarifas(){

    $.post("../../controller/tarifa.php?op=listarTodo", function (data) {

        data = JSON.parse(data);

        $("#cmbFajaConsumo").append('<option selected value="">--Seleccione una Tarifa--</option>');

        $.each(data, function(id,value){

            $("#cmbFajaConsumo").append('<option value="'+value.tar_id+'">'+value.tar_descrip+'</option>');
            // $('#cmbFajaConsumo').val(value.tar_id).trigger('change');

        });        

    }); 

}

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


function limitDecimalPlaces(e, count) {

  if (e.target.value.indexOf('.') == -1) { return; }
  if ((e.target.value.length - e.target.value.indexOf('.')) > count) {
    e.target.value = parseFloat(e.target.value).toFixed(count);
  }
}

function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

  return true;
}

/*=====================================================
 VALIDAR CONSUMO
======================================================*/

function validarConsumo(){

    if($("#consumo_inicial").val() == ""){

        $("#lectura_ant").val("0");

    }

    if($("#consumo_final").val() == ""){

        $("#lectura_act").val("0");

    }

    if($("#consumo_inicial").val() != "" && $("#consumo_final").val() != ""){

        
        var consumo_inicial = parseInt($("#consumo_inicial").val());
        var consumo_final = parseInt($("#consumo_final").val());

        // console.log(lectura_ant);
        // console.log(lectura_act);

        if(consumo_inicial > consumo_final){

            swal({

                title: "Atención!",
                text: "El consumo inicial no puede ser mayor al consumo final",
                type: "warning",
                confirmButtonClass: "btn-warning"

            });

            return false;

        }else{

            return true;

        }

    }

}
