<?php

    class FajaConsumo extends Conectar{

        public function insert_fajaConsumo($cmbFajaConsumo, $consumo_inicial, $consumo_final, $precio){
            
            $conectar= parent::conexion();
            parent::set_names();

            // var_dump($cmbFajaConsumo);
            // var_dump($cmbFajaConsumo);
            // var_dump($consumo_inicial);
            // var_dump($consumo_final);
            // var_dump($precio);
            // return;

            $sql="INSERT INTO tm_fajaconsumo (tar_id, consumo_inicial, consumo_final, precio, fecha_crea, est) VALUES (?, ?, ?, ?, now(), '1');";
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $cmbFajaConsumo);
            $sql->bindValue(2, $consumo_inicial);
            $sql->bindValue(3, $consumo_final);
            $sql->bindValue(4, $precio);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function update_fajaConsumo($faja_id, $cmbFajaConsumo, $consumo_inicial, $consumo_final, $precio){
            
            $conectar= parent::conexion();
            parent::set_names();

            // var_dump($faja_id);
            // var_dump($cmbFajaConsumo);
            // var_dump($consumo_inicial);
            // var_dump($consumo_final);
            // var_dump($precio);
            // return;

            $sql="UPDATE tm_fajaconsumo SET tar_id = ?, consumo_inicial = ?, consumo_final = ?, precio = ? WHERE faja_id = ?";
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $cmbFajaConsumo);
            $sql->bindValue(2, $consumo_inicial);
            $sql->bindValue(3, $consumo_final);
            $sql->bindValue(4, $precio);
            $sql->bindValue(5, $faja_id);

            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function delete_fajaConsumo($faja_id){

            $conectar= parent::conexion();
            parent::set_names();

            $sql="UPDATE tm_fajaconsumo SET est = '0', fecha_elim = now() WHERE faja_id = ?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $faja_id);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function get_fajaConsumo(){

            $conectar= parent::conexion();
            parent::set_names();

            $sql="SELECT t.tar_descrip,fc.faja_id, fc.consumo_inicial, fc.consumo_final, fc.precio, fc.fecha_crea, fc.est FROM tm_fajaconsumo fc INNER JOIN tm_tarifas t ON fc.tar_id = t.tar_id WHERE fc.est = '1' ORDER BY faja_id";

            $sql=$conectar->prepare($sql);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function get_fajaConsumo_x_id($faja_id){

            // var_dump($faja_id);
            // return;

            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_fajaconsumo WHERE faja_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $faja_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

        public function get_fajaConsumo_x_foren($tar_id){

            // var_dump($faja_id);
            // return;

            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_fajaconsumo WHERE tar_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }

    }
?>