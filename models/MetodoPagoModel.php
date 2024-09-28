<?php

class MetodoPagoModel {

    private $conexion;

    public function __construct() {
        require_once 'config/config.php';
        global $conexion;
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT * FROM tbl_metodo_pago WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($mp_id) {
        $sql = "SELECT * FROM tbl_metodo_pago WHERE mp_id = :mp_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mp_id', $mp_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre) {
        $sql = "INSERT INTO tbl_metodo_pago (mp_nombre) VALUES (:nombre)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        return $query->execute();
    }

    public function editar($mp_id, $nombre) {
        $sql = "UPDATE tbl_metodo_pago SET mp_nombre = :nombre WHERE mp_id = :mp_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mp_id', $mp_id, PDO::PARAM_INT);
        $query->bindParam(':nombre', $nombre);
        return $query->execute();
    }

    public function eliminar($mp_id) {
        $sql = "UPDATE tbl_metodo_pago SET estado = 'I' WHERE mp_id = :mp_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mp_id', $mp_id, PDO::PARAM_INT);
        return $query->execute();
    }
}
?>
