<?php

    class Descuento extends Conectar{

        public function insert_descuento($tar_id, $desde, $hasta, $descuento){

            $conectar= parent::conexion();
            parent::set_names();

            $sql="INSERT INTO tm_descuento (tar_id, desde, hasta, descuento, fecha_crea, est) VALUES (?, ?, ?, ?, now(), '1');";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->bindValue(2, $desde);
            $sql->bindValue(3, $hasta);
            $sql->bindValue(4, $descuento);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function update_descuento($desc_id, $tar_id, $desde, $hasta, $descuento){

            $conectar= parent::conexion();
            parent::set_names();

            $sql="UPDATE tm_descuento SET tar_id = ?, desde = ?, hasta = ?, descuento = ? WHERE desc_id = ?";

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->bindValue(2, $desde);
            $sql->bindValue(3, $hasta);
            $sql->bindValue(4, $descuento);
            $sql->bindValue(5, $desc_id);
            $sql->execute();

            return $resultado=$sql->fetchAll();

        }

        public function delete_descuento($desc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_descuento SET est = '0', fecha_elim = now() WHERE desc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $desc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_descuento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT d.desc_id, t.tar_descrip, d.desde, d.hasta, d.descuento, d.fecha_crea, d.est FROM tm_descuento d INNER JOIN tm_tarifas t ON d.tar_id = t.tar_id WHERE d.est = '1'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_descuento_x_id($desc_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_descuento WHERE desc_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $desc_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_descuento_x_foren($tar_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_descuento WHERE tar_id = ? AND est = '1'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tar_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>