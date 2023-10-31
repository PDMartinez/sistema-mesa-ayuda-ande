<?php

    class Consumo extends Conectar{

        public function insert_consumo($tar_id, $usu_id, $periodo_inicial, $periodo_final, $lectura_ant, $lectura_act, $fecha_crea){
            
            $conectar= parent::conexion();
            parent::set_names();

            // var_dump($tar_id);
            // var_dump($usu_id);
            // var_dump($periodo_inicial);
            // var_dump($periodo_final);
            // var_dump($lectura_ant);
            // var_dump($lectura_act);
            // var_dump($fecha_crea);
            // return;

            $sql="INSERT INTO tm_consumo (tar_id, usu_id, periodo_inicial, periodo_final, lectura_ant, lectura_act, fecha_crea, est) VALUES (?, ?, ?, ?, ?, ?, now(), '1');";
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $tar_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $periodo_inicial);
            $sql->bindValue(4, $periodo_final);
            $sql->bindValue(5, $lectura_ant);
            $sql->bindValue(6, $lectura_act);

            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function update_consumo($cons_id, $tar_id, $usu_id, $periodo_inicial, $periodo_final, $lectura_ant, $lectura_act){
            
            $conectar= parent::conexion();
            parent::set_names();

            // var_dump($faja_id);
            // var_dump($cmbconsumo);
            // var_dump($consumo_inicial);
            // var_dump($consumo_final);
            // var_dump($precio);
            // return;

            $sql="UPDATE tm_consumo SET tar_id = ?, usu_id = ?, periodo_inicial = ?, periodo_final = ?, lectura_ant = ?, lectura_act = ? WHERE cons_id = ?";
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $tar_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $periodo_inicial);
            $sql->bindValue(4, $periodo_final);
            $sql->bindValue(5, $lectura_ant);
            $sql->bindValue(6, $lectura_act);
            $sql->bindValue(7, $cons_id);

            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function delete_consumo($cons_id){

            // var_dump($cons_id);
            // return;

            $conectar= parent::conexion();
            parent::set_names();

            $sql="UPDATE tm_consumo SET est = '0', fecha_elim = now() WHERE cons_id = ?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cons_id);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function get_consumo($usu_id){

            $conectar= parent::conexion();
            parent::set_names();

            $sql="SELECT c.cons_id, t.tar_id, t.tar_descrip, u.usu_nom, u.usu_ape, c.periodo_inicial, c.periodo_final, c.lectura_ant, c.lectura_act, c.fecha_crea, c.est FROM tm_consumo c INNER JOIN tm_tarifas t ON c.tar_id = t.tar_id INNER JOIN tm_usuario u ON c.usu_id = u.usu_id WHERE C.est = '1' AND c.usu_id = ?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function get_consumo_x_id($cons_id){

            // var_dump($cons_id);
            // return;

            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_consumo WHERE cons_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $cons_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_consumo_grafico($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT periodo_final AS periodo, (lectura_act - lectura_ant) AS consumo FROM tm_consumo WHERE usu_id = ? ORDER BY cons_id";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>