function init(){
   
}

/*=====================================================
  OBTENER PARAMETRO
======================================================*/

$(document).ready(function(){

    var usu_id = getUrlParameter('ID');

    // console.log(usu_id);

    $.post("../../controller/consumo.php?op=grafico", {usu_id:usu_id},function (data) {
            data = JSON.parse(data);

        console.log(data);
        // return;

        new Morris.Line({

          // ID del elemento en el que vamos a dibujar el gráfico.
          element: 'graficoEstadistico',
          // Registros de datos del gráfico: cada entrada en esta matriz corresponde a un punto en el gráfico.
          data: data,
          // El nombre del atributo de registro de datos que contiene valores de x.
          xkey: 'periodo',
          // Una lista de nombres de atributos de registros de datos que contienen valores y.
          ykeys: ['consumo'],
          // Etiquetas para las teclas y: se mostrarán cuando pase el mouse sobre el gráfico.
          labels: ['Consumo kWh'],

          xLabels: 'month'

        });

    });

    // listardetalle(tick_id);

});

/*=====================================================
  FUNCION PARA OBTENER PARAMETRO GET
======================================================*/

var getUrlParameter = function getUrlParameter(sParam) {

    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {

        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }

    }

};

// $(document).on("click","#btnenviar", function(){
//     var tick_id = getUrlParameter('ID');
//     var usu_id = $('#user_idx').val();
//     var tickd_descrip = $('#tickd_descrip').val();

//     if ($('#tickd_descrip').summernote('isEmpty')){
//         swal("Advertencia!", "Falta Descripción", "warning");
//     }else{
//         $.post("../../controller/ticket.php?op=insertdetalle", { tick_id:tick_id,usu_id:usu_id,tickd_descrip:tickd_descrip}, function (data) {
//             listardetalle(tick_id);
//             $('#tickd_descrip').summernote('reset');
//             swal("Correcto!", "Registrado Correctamente", "success");
//         }); 
//     }
// });

// $(document).on("click","#btncerrarticket", function(){
//     swal({
//         title: "HelpDesk",
//         text: "Esta seguro de Cerrar el Ticket?",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonClass: "btn-warning",
//         confirmButtonText: "Si",
//         cancelButtonText: "No",
//         closeOnConfirm: false
//     },
//     function(isConfirm) {
//         if (isConfirm) {
//             var tick_id = getUrlParameter('ID');
//             var usu_id = $('#user_idx').val();
//             $.post("../../controller/ticket.php?op=update", { tick_id : tick_id,usu_id : usu_id }, function (data) {

//             });

//             $.post("../../controller/email.php?op=ticket_cerrado", {tick_id : tick_id}, function (data) {

//             });

//             $.post("../../controller/whatsapp.php?op=w_ticket_cerrado", {tick_id : tick_id}, function (data) {

//             });


//             listardetalle(tick_id);

//             swal({
//                 title: "HelpDesk!",
//                 text: "Ticket Cerrado correctamente.",
//                 type: "success",
//                 confirmButtonClass: "btn-success"
//             });
//         }
//     });
// });

// function listardetalle(tick_id){
//     $.post("../../controller/ticket.php?op=listardetalle", { tick_id : tick_id }, function (data) {
//         $('#lbldetalle').html(data);
//     }); 

//     $.post("../../controller/ticket.php?op=mostrar", { tick_id : tick_id }, function (data) {
//         data = JSON.parse(data);
//         $('#lblestado').html(data.tick_estado);
//         $('#lblnomusuario').html(data.usu_nom +' '+data.usu_ape);
//         $('#lblfechcrea').html(data.fech_crea);

//         $('#lblnomidticket').html("Detalle Ticket - "+data.tick_id);

//         $('#cat_nom').val(data.cat_nom);
//         $('#cats_nom').val(data.cats_nom);
//         $('#tick_titulo').val(data.tick_titulo);
//         $('#tickd_descripusu').summernote ('code',data.tick_descrip);

//         $('#prio_nom').val(data.prio_nom);

//         if (data.tick_estado_texto == "Cerrado"){
//             $('#pnldetalle').hide();
//         }
//     }); 
// }

init();
