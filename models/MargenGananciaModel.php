<?php

class MargenGananciaModel {

    private $conexion;

    public function __construct() {
        // Incluir el archivo de conexión
        require_once 'config/config.php';
        global $conexion;
        // Usar la conexión global definida en conexion.php
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_margen_ganancia WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($mg_id) {
        $sql = "SELECT * FROM tbl_margen_ganancia WHERE mg_id = :mg_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mg_id', $mg_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($porcentaje, $descripcion) {
        $sql = "INSERT INTO tbl_margen_ganancia (mg_porcentaje, mg_descripcion) VALUES (:porcentaje, :descripcion)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':porcentaje', $porcentaje);
        $query->bindParam(':descripcion', $descripcion);
        return $query->execute();
    }

    public function editar($mg_id, $porcentaje, $descripcion) {
        $sql = "UPDATE tbl_margen_ganancia SET mg_porcentaje = :porcentaje, mg_descripcion = :descripcion WHERE mg_id = :mg_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mg_id', $mg_id);
        $query->bindParam(':porcentaje', $porcentaje);
        $query->bindParam(':descripcion', $descripcion);
        return $query->execute();
    }

    public function eliminar($mg_id) {
        $sql = "UPDATE tbl_margen_ganancia SET estado = 'I' WHERE mg_id = :mg_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mg_id', $mg_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
