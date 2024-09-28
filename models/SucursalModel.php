<?php

class SucursalModel {

    private $conexion;

    public function __construct() {
        require_once 'config/config.php';
        global $conexion;
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_sucursal WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($suc_id) {
        $sql = "SELECT * FROM tbl_sucursal WHERE suc_id = :suc_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':suc_id', $suc_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $direccion) {
        $sql = "INSERT INTO tbl_sucursal (suc_nombre, suc_direccion) VALUES (:nombre, :direccion)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':direccion', $direccion);
        return $query->execute();
    }

    public function editar($suc_id, $nombre, $direccion) {
        $sql = "UPDATE tbl_sucursal SET suc_nombre = :nombre, suc_direccion = :direccion WHERE suc_id = :suc_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':suc_id', $suc_id, PDO::PARAM_INT);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':direccion', $direccion);
        return $query->execute();
    }

    public function eliminar($suc_id) {
        $sql = "UPDATE tbl_sucursal SET estado = 'I' WHERE suc_id = :suc_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':suc_id', $suc_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
