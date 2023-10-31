<?php

    require_once("../config/conexion.php");
    require_once("../models/Consumo.php");
    require_once("../models/FajaConsumo.php");
    require_once("../models/Descuento.php");

    $consumo = new consumo();
    $fajaConsumo = new FajaConsumo();
    $descuento = new Descuento();

    switch($_GET["op"]){

        case "guardaryeditar":

            // var_dump($_POST["tar_id"]);
            // var_dump($_POST["usu_id"]);
            // var_dump($_POST["periodo_inicial"]);
            // var_dump($_POST["periodo_final"]);
            // var_dump($_POST["lectura_ant"]);
            // var_dump($_POST["lectura_act"]);
            // var_dump($_POST["fecha_crea"]);
            // return;

            if(empty($_POST["cons_id"])){

                $consumo->insert_consumo($_POST["tar_id"], $_POST["usu_id"], $_POST["periodo_inicial"], $_POST["periodo_final"], $_POST["lectura_ant"], $_POST["lectura_act"], $_POST["fecha_crea"]);
            }
            else {

                $consumo->update_consumo($_POST["cons_id"], $_POST["tar_id"], $_POST["usu_id"], $_POST["periodo_inicial"], $_POST["periodo_final"], $_POST["lectura_ant"], $_POST["lectura_act"]);
            }

        break;

        case "listar":

            $datos=$consumo->get_consumo($_POST["usu_id"]);

            // var_dump($datos);

            $data= Array();

            $tarifa=0;
            $desc=0;
            $montoDesc=0;
            $consumoTotal=0;
            $totalPagarDesc=0;

            $c = 1;

            foreach($datos as $row){

                $datosFajaConsumo=$fajaConsumo->get_fajaConsumo_x_foren($row["tar_id"]);

                $consumo = (intval($row["lectura_act"]) - intval($row["lectura_ant"]));

                foreach($datosFajaConsumo as $rowFajaConsumo){

                    if($consumo >= $rowFajaConsumo["consumo_inicial"] && $consumo <= $rowFajaConsumo["consumo_final"]){

                        $tarifa = floatval($rowFajaConsumo["precio"]);
                        $consumoTotal = $tarifa * $consumo;
                        $totalPagarDesc = $consumoTotal;

                    }

                }



                $datosDescuento=$descuento->get_descuento_x_foren($row["tar_id"]);

                // var_dump($datosDescuento);
                // return;

                foreach($datosDescuento as $descuentos){

                    if($consumo >= $descuentos["desde"] && $consumo <= $descuentos["hasta"]){

                        // var_dump(floatval($descuentos["descuento"]));
                        // var_dump($consumoTotal);

                        $desc = floatval($descuentos["descuento"]);
                        $montoDesc = (($desc * $consumoTotal) / 100);
                        $totalPagarDesc = intval($consumoTotal - $montoDesc);

                        // $tarifa = floatval($descuento["precio"]);
                        // $consumoTotal = $tarifa * $consumo;

                        // var_dump(number_format($totalPagarDesc,0,',','.'));

                    }

                }

                $sub_array = array();
                $sub_array[] = $c;
                $sub_array[] = '<button type="button" onClick="editar('.$row["cons_id"].');"  id="'.$row["cons_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["cons_id"].');"  id="'.$row["cons_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $sub_array[] = $row["tar_descrip"];
                // $sub_array[] = $row["usu_nom"]." ".$row["usu_ape"];
                $sub_array[] = date("d/m/Y", strtotime($row["periodo_inicial"]));
                $sub_array[] = date("d/m/Y", strtotime($row["periodo_final"]));
                $sub_array[] = $row["lectura_ant"]." kWh";
                $sub_array[] = $row["lectura_act"]." kWh";

                $sub_array[] = $consumo." kWh";
                $sub_array[] = $tarifa." Gs";
                $sub_array[] = $desc." %";
                $sub_array[] = number_format($montoDesc,0,',','.')." Gs";
                $sub_array[] = number_format($consumoTotal,0,',','.')." Gs";

                $sub_array[] = number_format($totalPagarDesc,0,',','.')." Gs";
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_crea"]));

                // if ($row["est"]=="1"){
                //     $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
                // }else{
                //     $sub_array[] = '<span class="label label-pill label-danger">Inactivo</span>';
                // }

                
                $data[] = $sub_array;
                $c++;

            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;

        case "eliminar":

            $consumo->delete_consumo($_POST["cons_id"]);

        break;

        case "mostrar";

            $datos = $consumo->get_consumo_x_id($_POST["cons_id"]);

            // var_dump($datos);

            if(is_array($datos)==true and count($datos)>0){

                foreach($datos as $row){

                    $output["cons_id"] = $row["cons_id"];
                    $output["tar_id"] = $row["tar_id"];
                    $output["periodo_inicial"] = $row["periodo_inicial"];
                    $output["periodo_final"] = $row["periodo_final"];
                    $output["lectura_ant"] = $row["lectura_ant"];
                    $output["lectura_act"] = $row["lectura_act"];
                    $output["fecha_crea"] = $row["fecha_crea"];

                }

                echo json_encode($output);
            }   

        break;

        case "grafico";
            $datos=$consumo->get_consumo_grafico($_POST["usu_id"]);  
            echo json_encode($datos);
        break;

    }
?>