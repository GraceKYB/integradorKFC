<?php

class ComboModel {

    private $conexion;

    public function __construct() {
        require_once 'config/config.php';
        global $conexion;
        $this->conexion = $conexion;
    }

    public function listar() {
        $sql = "SELECT c.*, cat.cat_nombre AS categoria_nombre 
                FROM tbl_combo c 
                INNER JOIN tbl_categoria cat ON c.cat_id = cat.cat_id 
                WHERE c.estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($com_id) {
        $sql = "SELECT c.*, cat.cat_nombre AS categoria_nombre 
                FROM tbl_combo c 
                INNER JOIN tbl_categoria cat ON c.cat_id = cat.cat_id 
                WHERE c.com_id = :com_id AND c.estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':com_id', $com_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerDetallesPorComboId($com_id) {
        $sql = "SELECT prod_id, dc_stock FROM tbl_detalle_combo WHERE com_id = :com_id AND estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->bindParam(':com_id', $com_id, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($nombre, $descripcion, $precio, $imagen, $cat_id, $detalleCombos) {
        try {
            // Iniciar transacción
            $this->conexion->beginTransaction();

            // Insertar combo
            $stmt = $this->conexion->prepare("INSERT INTO tbl_combo (com_nombre, com_descripcion, com_precio, com_imagen, cat_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $descripcion, $precio, $imagen, $cat_id]);

            // Obtener el ID del combo insertado
            $com_id = $this->conexion->lastInsertId();

            // Insertar detalles de los productos en tbl_detalle_combo
            $stmtDetalle = $this->conexion->prepare("INSERT INTO tbl_detalle_combo (prod_id, dc_stock, com_id) VALUES (?, ?, ?)");
            foreach ($detalleCombos as $detalle) {
                $stmtDetalle->execute([$detalle['prod_id'], $detalle['dc_stock'], $com_id]);
            }

            // Confirmar transacción
            $this->conexion->commit();
        } catch (Exception $e) {
            // Revertir cambios en caso de error
            $this->conexion->rollBack();
            throw $e;
        }
    }

    public function editar($id, $nombre, $descripcion, $precio, $imagen, $cat_id, $detalleCombos) {
        try {
            // Iniciar transacción
            $this->conexion->beginTransaction();

            // Actualizar combo
            $stmt = $this->conexion->prepare("UPDATE tbl_combo SET com_nombre = ?, com_descripcion = ?, com_precio = ?, com_imagen = ?, cat_id = ? WHERE com_id = ?");
            $stmt->execute([$nombre, $descripcion, $precio, $imagen, $cat_id, $id]);

            // Eliminar detalles anteriores
            $stmtEliminar = $this->conexion->prepare("DELETE FROM tbl_detalle_combo WHERE com_id = ?");
            $stmtEliminar->execute([$id]);

            // Insertar detalles de los productos en tbl_detalle_combo
            $stmtDetalle = $this->conexion->prepare("INSERT INTO tbl_detalle_combo (prod_id, dc_stock, com_id) VALUES (?, ?, ?)");
            foreach ($detalleCombos as $detalle) {
                $stmtDetalle->execute([$detalle['prod_id'], $detalle['dc_stock'], $id]);
            }

            // Confirmar transacción
            $this->conexion->commit();
        } catch (Exception $e) {
            $this->conexion->rollBack();
            throw $e;
        }
    }

    public function eliminar($com_id) {
        try {
            $this->conexion->beginTransaction();

            // Eliminar combo
            $sqlCombo = "UPDATE tbl_combo SET estado = 'I' WHERE com_id = :com_id";
            $queryCombo = $this->conexion->prepare($sqlCombo);
            $queryCombo->bindParam(':com_id', $com_id, PDO::PARAM_INT);
            $queryCombo->execute();

            // Eliminar detalles del combo
            $sqlDetalle = "UPDATE tbl_detalle_combo SET estado = 'I' WHERE com_id = :com_id";
            $queryDetalle = $this->conexion->prepare($sqlDetalle);
            $queryDetalle->bindParam(':com_id', $com_id, PDO::PARAM_INT);
            $queryDetalle->execute();

            $this->conexion->commit();
            return true;

        } catch (Exception $e) {
            $this->conexion->rollBack();
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    public function listarProductos() {
        $sql = "SELECT prod_id, prod_nombre, prod_descripcion, prod_precio_venta FROM tbl_producto WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function listarCategorias() {
        $sql = "SELECT cat_id, cat_nombre FROM tbl_categoria WHERE estado = 'A'";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obtenerProductoPorId($prod_id) {
        $sql = "SELECT * FROM tbl_producto WHERE prod_id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$prod_id]);
        return $stmt->fetch();
    }   
    

}
?>
