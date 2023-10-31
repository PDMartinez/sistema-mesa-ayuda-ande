<?php

    require_once("../config/conexion.php");
    require_once("../models/Descuento.php");

    $descuento = new Descuento();

    switch($_GET["op"]){

        case "guardaryeditar":

            // var_dump($_POST["tar_id"]);
            // var_dump($_POST["tar_descrip"]);
            // return;

            if(empty($_POST["desc_id"])){

                $descuento->insert_descuento($_POST["tar_id"], $_POST["desde"], $_POST["hasta"], $_POST["descuento"]);
            }
            else {

                $descuento->update_descuento($_POST["desc_id"], $_POST["tar_id"], $_POST["desde"], $_POST["hasta"], $_POST["descuento"]);
            }

        break;

        case "listar":

            $datos=$descuento->get_descuento();

            // var_dump($datos);

            $data= Array();

            foreach($datos as $row){

                $sub_array = array();
                $sub_array[] = $row["tar_descrip"];
                $sub_array[] = $row["desde"]." kWh";
                $sub_array[] = $row["hasta"]." kWh";
                $sub_array[] = $row["descuento"]." %";
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_crea"]));

                if ($row["est"]=="1"){
                    $sub_array[] = '<span class="label label-pill label-success">Activo</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Inactivo</span>';
                }

                $sub_array[] = '<button type="button" onClick="editar('.$row["desc_id"].');"  id="'.$row["desc_id"].'" class="btn btn-inline btn-warning btn-sm ladda-button"><i class="fa fa-edit"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["desc_id"].');"  id="'.$row["desc_id"].'" class="btn btn-inline btn-danger btn-sm ladda-button"><i class="fa fa-trash"></i></button>';
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

            $descuento->delete_descuento($_POST["desc_id"]);

        break;

        case "mostrar";

            $datos=$descuento->get_descuento_x_id($_POST["desc_id"]);

            if(is_array($datos)==true and count($datos)>0){

                foreach($datos as $row){

                    $output["desc_id"] = $row["desc_id"];
                    $output["tar_id"] = $row["tar_id"];
                    $output["desde"] = $row["desde"];
                    $output["hasta"] = $row["hasta"];
                    $output["descuento"] = $row["descuento"];
                    $output["est"] = $row["est"];

                }

                echo json_encode($output);
            }   

        break;

        case "listarTodo";

            $datos=$descuento->get_descuento();
            echo json_encode($datos);  

        break;

    }
?>