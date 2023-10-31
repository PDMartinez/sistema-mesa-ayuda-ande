<?php

    class Tarifa extends Conectar{

        public function insert_tarifa($tar_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_tarifas (tar_descrip, est) VALUES (?, '1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_descrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_tarifa($tar_id, $tar_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tarifas SET tar_descrip = ? WHERE tar_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_descrip);
            $sql->bindValue(2, $tar_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_tarifa($tar_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_tarifas SET est = '0', fecha_elim = now() WHERE tar_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_tarifa(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tarifas WHERE est = '1'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_tarifa_x_id($tar_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_tarifas WHERE tar_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>