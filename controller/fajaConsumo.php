<?php

    require_once("../config/conexion.php");
    require_once("../models/FajaConsumo.php");

    $fajaConsumo = new FajaConsumo();

    switch($_GET["op"]){

        case "guardaryeditar":

            // var_dump($_POST["tar_id"]);
            // var_dump($_POST["tar_descrip"]);
            // return;

            if(empty($_POST["fajaConsumo_id"])){

                $fajaConsumo->insert_fajaConsumo($_POST["cmbFajaConsumo"], $_POST["consumo_inicial"], $_POST["consumo_final"], $_POST["precio"]);
            }
            else {

                $fajaConsumo->update_fajaConsumo($_POST["fajaConsumo_id"], $_POST["cmbFajaConsumo"], $_POST["consumo_inicial"], $_POST["consumo_final"], $_POST["precio"]);
            }

        break;

        case "listar":

            $datos=$fajaConsumo->get_fajaConsumo();

            // var_dump($datos);

            $data= Array();

            foreach($datos as $row){

                $sub_array = array();
                $sub_array[] = $row["tar_descrip"];
                $sub_array[] = $row["consumo_inicial"]." kWh";
                $sub_array[] = $row["consumo_final"]." kWh";
                $sub_array[] = $row["precio"]." Gs";
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_crea"]));

                if ($row["est"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Inactivo</span>';
                }

                $sub_array[] = '<button type="button" onClick="editar('.$row["faja_id"].');"  id="'.$row["faja_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["faja_id"].');"  id="'.$row["faja_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
                $data[] = $sub_array;

            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);

            echo json_encode($results);

        break;

        case "eliminar":

            $fajaConsumo->delete_fajaConsumo($_POST["faja_id"]);

        break;

        case "mostrar";

            $datos = $fajaConsumo->get_fajaConsumo_x_id($_POST["faja_id"]);

            // var_dump($datos);

            if(is_array($datos)==true and count($datos)>0){

                foreach($datos as $row){

                    $output["faja_id"] = $row["faja_id"];
                    $output["tar_id"] = $row["tar_id"];
                    $output["consumo_inicial"] = $row["consumo_inicial"];
                    $output["consumo_final"] = $row["consumo_final"];
                    $output["precio"] = $row["precio"];
                    $output["fecha_crea"] = $row["fecha_crea"];

                }

                echo json_encode($output);
            }   

        break;

    }
?>