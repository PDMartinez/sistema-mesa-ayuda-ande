<?php

    require_once("../config/conexion.php");
    require_once("../models/Tarifa.php");

    $tarifa = new Tarifa();

    switch($_GET["op"]){

        case "guardaryeditar":

            // var_dump($_POST["tar_id"]);
            // var_dump($_POST["tar_descrip"]);
            // return;

            if(empty($_POST["tar_id"])){

                $tarifa->insert_tarifa($_POST["tar_descrip"]);
            }
            else {

                $tarifa->update_tarifa($_POST["tar_id"],$_POST["tar_descrip"]);
            }

        break;

        case "listar":

            $datos=$tarifa->get_tarifa();

            // var_dump($datos);

            $data= Array();

            foreach($datos as $row){

                $sub_array = array();
                $sub_array[] = $row["tar_descrip"];
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_crea"]));

                if ($row["est"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Inactivo</span>';
                }

                $sub_array[] = '<button type="button" onClick="editar('.$row["tar_id"].');"  id="'.$row["tar_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["tar_id"].');"  id="'.$row["tar_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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

            $tarifa->delete_tarifa($_POST["tar_id"]);

        break;

        case "mostrar";

            $datos=$tarifa->get_tarifa_x_id($_POST["tar_id"]);

            if(is_array($datos)==true and count($datos)>0){

                foreach($datos as $row){

                    $output["tar_id"] = $row["tar_id"];
                    $output["tar_descrip"] = $row["tar_descrip"];
                    $output["fecha_crea"] = $row["fecha_crea"];
                    $output["est"] = $row["est"];

                }

                echo json_encode($output);
            }   

        break;

        case "listarTodo";

            $datos=$tarifa->get_tarifa();
            echo json_encode($datos);  

        break;

    }
?>