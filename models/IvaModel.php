<?php

class IvaModel {

    private $conexion;

    public function __construct() {
        // Incluir el archivo de conexión
        require_once 'config/config.php';
        global $conexion;
        // Usar la conexión global definida en conexion.php
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_iva WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($iva_id) {
        $sql = "SELECT * FROM tbl_iva WHERE iva_id = :iva_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':iva_id', $iva_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($iva_porcentaje, $iva_descripcion) {
        $sql = "INSERT INTO tbl_iva (iva_porcentaje, iva_descripcion) VALUES (:iva_porcentaje, :iva_descripcion)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':iva_porcentaje', $iva_porcentaje);
        $query->bindParam(':iva_descripcion', $iva_descripcion);
        return $query->execute();
    }

    public function editar($iva_id, $iva_porcentaje, $iva_descripcion) {
        $sql = "UPDATE tbl_iva SET iva_porcentaje = :iva_porcentaje, iva_descripcion = :iva_descripcion WHERE iva_id = :iva_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':iva_id', $iva_id);
        $query->bindParam(':iva_porcentaje', $iva_porcentaje);
        $query->bindParam(':iva_descripcion', $iva_descripcion);
        return $query->execute();
    }

    public function eliminar($iva_id) {
        $sql = "UPDATE tbl_iva SET estado = 'I' WHERE iva_id = :iva_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':iva_id', $iva_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
