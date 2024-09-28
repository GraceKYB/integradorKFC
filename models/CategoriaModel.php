<?php

class CategoriaModel {

    private $conexion;

    public function __construct() {
        // Incluir el archivo de conexión
        require_once 'config/config.php';
        global $conexion;
        // Usar la conexión global definida en conexion.php
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_categoria WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($cat_id) {
        $sql = "SELECT * FROM tbl_categoria WHERE cat_id = :cat_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $rutaImagen) {
        $sql = "INSERT INTO tbl_categoria (cat_nombre, cat_imagen) VALUES (:nombre, :imagen)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':imagen', $rutaImagen);
        return $query->execute();
    }

    public function editar($cat_id, $nombre, $imagen) {
        $sql = "UPDATE tbl_categoria SET cat_nombre = :nombre, cat_imagen = :imagen WHERE cat_id = :cat_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':cat_id', $cat_id);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':imagen', $imagen);
        return $query->execute();
    }

    public function eliminar($cat_id) {
        $sql = "UPDATE tbl_categoria SET estado = 'I' WHERE cat_id = :cat_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
