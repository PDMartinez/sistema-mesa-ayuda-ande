

var tabla;

init();

function init(){
    $("#descuento_form").on("submit",function(e){
        // console.log("Ingresa");
        guardaryeditar(e); 
    });
}

function guardaryeditar(e){

    e.preventDefault();//para que no se realice 2 veces la misma accion
    
    var formData = new FormData($("#descuento_form")[0]);

    // console.log($("#fajaConsumo_form")[0]);
    // return;

    $.ajax({
        url: "../../controller/descuento.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            // console.log(datos);
            $('#descuento_form')[0].reset();
            $('#desc_id').val("");
            $("#modalmantenimiento").modal('hide');
            $('#descuento_data').DataTable().ajax.reload();

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

    tabla=$('#descuento_data').dataTable({
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
            url: '../../controller/descuento.php?op=listar',
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

function editar(desc_id) {

    // console.log(faja_id);
    // return;
    cargarTarifas();
    $('#desc_id').val('');
    $("#tar_id").empty();
    $('#mdltitulo').html('Nuevo Registro');
    $('#descuento_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    $.post("../../controller/descuento.php?op=mostrar", {desc_id : desc_id}, function (data) {
        data = JSON.parse(data);

        // console.log(data);
        // return;
        $('#desc_id').val(data.desc_id);
        $('#tar_id').val(data.tar_id).trigger('change');
        $('#desde').val(data.desde);
        $('#hasta').val(data.hasta);
        $('#descuento').val(data.descuento);

    });

    $('#modalmantenimiento').modal('show');

}

function eliminar(desc_id){

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
            $.post("../../controller/descuento.php?op=eliminar", {desc_id : desc_id}, function (data) {

            }); 

            $('#descuento_data').DataTable().ajax.reload();   

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
    $('#desc_id').val('');
    $("#tar_id").empty();
    $('#mdltitulo').html('Nuevo Registro');
    $('#descuento_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    cargarTarifas();

});

function cargarTarifas(){

    $.post("../../controller/tarifa.php?op=listarTodo", function (data) {

        data = JSON.parse(data);

        $("#tar_id").append('<option selected value="">--Seleccione una Tarifa--</option>');

        $.each(data, function(id,value){

            $("#tar_id").append('<option value="'+value.tar_id+'">'+value.tar_descrip+'</option>');
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
