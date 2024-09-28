<?php

class ProductoModel {

    private $conexion;

    public function __construct() {
        require_once 'config/config.php';
        global $conexion;
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT p.*, i.iva_porcentaje, m.mg_porcentaje, s.suc_nombre 
                FROM tbl_producto p
                LEFT JOIN tbl_iva i ON p.iva_id = i.iva_id
                LEFT JOIN tbl_margen_ganancia m ON p.mg_id = m.mg_id
                LEFT JOIN tbl_sucursal s ON p.suc_id = s.suc_id
                WHERE p.estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($prod_id) {
        $sql = "SELECT * FROM tbl_producto WHERE prod_id = :prod_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $descripcion, $precio_compra, $extra, $stock, $iva_id, $mg_id, $suc_id, $imagen) {
        // Obtener porcentajes de IVA y margen de ganancia
        $iva = $this->obtenerIvaPorId($iva_id);
        $mg = $this->obtenerMargenGananciaPorId($mg_id);

        // Calcular precio de venta
        $precio_venta = ($precio_compra * $mg['mg_porcentaje']) + ($precio_compra * $iva['iva_porcentaje']) + $precio_compra;

        $sql = "INSERT INTO tbl_producto 
                (prod_nombre, prod_descripcion, prod_precio_compra, prod_precio_venta, prod_extra, prod_stock, iva_id, mg_id, suc_id, prod_imagen) 
                VALUES (:nombre, :descripcion, :precio_compra, :precio_venta, :extra, :stock, :iva_id, :mg_id, :suc_id, :imagen)";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio_compra', $precio_compra);
        $query->bindParam(':precio_venta', $precio_venta);
        $query->bindParam(':extra', $extra, PDO::PARAM_INT);
        $query->bindParam(':stock', $stock, PDO::PARAM_INT);
        $query->bindParam(':iva_id', $iva_id, PDO::PARAM_INT);
        $query->bindParam(':mg_id', $mg_id, PDO::PARAM_INT);
        $query->bindParam(':suc_id', $suc_id, PDO::PARAM_INT);
        $query->bindParam(':imagen', $imagen);
        return $query->execute();
    }

    public function editar($prod_id, $nombre, $descripcion, $precio_compra, $extra, $stock, $iva_id, $mg_id, $suc_id, $imagen) {
        // Obtener porcentajes de IVA y margen de ganancia
        $iva = $this->obtenerIvaPorId($iva_id);
        $mg = $this->obtenerMargenGananciaPorId($mg_id);

        // Calcular precio de venta
        $precio_venta = ($precio_compra * $mg['mg_porcentaje']) + ($precio_compra * $iva['iva_porcentaje']) + $precio_compra;

        $sql = "UPDATE tbl_producto 
                SET prod_nombre = :nombre, prod_descripcion = :descripcion, 
                    prod_precio_compra = :precio_compra, prod_precio_venta = :precio_venta, 
                    prod_extra = :extra, prod_stock = :stock, iva_id = :iva_id, 
                    mg_id = :mg_id, suc_id = :suc_id, prod_imagen = :imagen
                WHERE prod_id = :prod_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':precio_compra', $precio_compra);
        $query->bindParam(':precio_venta', $precio_venta);
        $query->bindParam(':extra', $extra, PDO::PARAM_INT);
        $query->bindParam(':stock', $stock, PDO::PARAM_INT);
        $query->bindParam(':iva_id', $iva_id, PDO::PARAM_INT);
        $query->bindParam(':mg_id', $mg_id, PDO::PARAM_INT);
        $query->bindParam(':suc_id', $suc_id, PDO::PARAM_INT);
        $query->bindParam(':imagen', $imagen);
        return $query->execute();
    }

    public function eliminar($prod_id) {
        $sql = "UPDATE tbl_producto SET estado = 'I' WHERE prod_id = :prod_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':prod_id', $prod_id, PDO::PARAM_INT);
        return $query->execute();
    }

    // Métodos adicionales para obtener datos de IVA y Margen de Ganancia
    public function obtenerIvaPorId($iva_id) {
        $sql = "SELECT iva_porcentaje FROM tbl_iva WHERE iva_id = :iva_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':iva_id', $iva_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerMargenGananciaPorId($mg_id) {
        $sql = "SELECT mg_porcentaje FROM tbl_margen_ganancia WHERE mg_id = :mg_id";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':mg_id', $mg_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerSucursales() {
        $sql = "SELECT suc_id, suc_nombre FROM tbl_sucursal WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerIvas() {
        $sql = "SELECT iva_id, iva_porcentaje FROM tbl_iva WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMargenGanancias() {
        $sql = "SELECT mg_id, mg_porcentaje FROM tbl_margen_ganancia WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
