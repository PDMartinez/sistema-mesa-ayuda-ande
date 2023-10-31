

var tabla;

init();

function init(){
    $("#tarifa_form").on("submit",function(e){
        guardaryeditar(e); 
    });
}

function guardaryeditar(e){

    e.preventDefault();//para que no se realice 2 veces la misma accion
    
    var formData = new FormData($("#tarifa_form")[0]);

    // console.log($("#tarifa_form")[0]);
    // return;

    $.ajax({
        url: "../../controller/tarifa.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

            console.log(datos);
            $('#tarifa_form')[0].reset();
            $('#tar_id').val("");
            $("#modalmantenimiento").modal('hide');
            $('#tarifa_data').DataTable().ajax.reload();

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

    tabla=$('#tarifa_data').dataTable({
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
            url: '../../controller/tarifa.php?op=listar',
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

function editar(tar_id) {
    
    $('#mdltitulo').html('Editar Registro');
    $('#tarifa_form')[0].reset();
    $('#modalmantenimiento').modal('show');

    $.post("../../controller/tarifa.php?op=mostrar", {tar_id : tar_id}, function (data) {
        data = JSON.parse(data);

        // console.log(data);
        $('#tar_descrip').val(data.tar_descrip);
        $('#tar_id').val(data.tar_id);
        // $('#rol_id').val(data.rol_id).trigger('change');

    }); 

    $('#modalmantenimiento').modal('show');

}

function eliminar(tar_id){

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
            $.post("../../controller/tarifa.php?op=eliminar", {tar_id : tar_id}, function (data) {

            }); 

            $('#tarifa_data').DataTable().ajax.reload();   

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
    // $('#usu_id').val('');
    $('#mdltitulo').html('Nuevo Registro');
    $('#tarifa_form')[0].reset();
    $('#modalmantenimiento').modal('show');
});
