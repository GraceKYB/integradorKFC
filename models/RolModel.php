<?php

class RolModel {

    private $conexion;

    public function __construct() {
        // Incluir el archivo de conexión
        require_once 'config/config.php';
        global $conexion;
        // Usar la conexión global definida en conexion.php
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_rol WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($rol_id) {
        $sql = "SELECT * FROM tbl_rol WHERE rol_id = :rol_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre) {
        $sql = "INSERT INTO tbl_rol (rol_nombre) VALUES (:nombre)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        return $query->execute();
    }

    public function editar($rol_id, $nombre) {
        $sql = "UPDATE tbl_rol SET rol_nombre = :nombre WHERE rol_id = :rol_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
        $query->bindParam(':nombre', $nombre);
        return $query->execute();
    }

    public function eliminar($rol_id) {
        $sql = "UPDATE tbl_rol SET estado = 'I' WHERE rol_id = :rol_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':rol_id', $rol_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
