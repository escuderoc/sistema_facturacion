<?php
require_once 'conexion.php';

class ItemModelo {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::conectar();
    }

    public function obtenerTodos() {
        $sql = "SELECT i.*, p.nombre AS proveedor_nombre 
                FROM items i 
                JOIN proveedores p ON i.id_proveedor = p.id";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($descripcion, $cantidad, $precio_unitario, $id_proveedor) {
        $sql = "INSERT INTO items (descripcion, cantidad, precio_unitario, id_proveedor, fecha_carga)
                VALUES (?, ?, ?, ?, CURDATE())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$descripcion, $cantidad, $precio_unitario, $id_proveedor]);
    }

    public function actualizar($id, $descripcion, $cantidad, $precio_unitario, $id_proveedor) {
        $sql = "UPDATE items SET descripcion=?, cantidad=?, precio_unitario=?, id_proveedor=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$descripcion, $cantidad, $precio_unitario, $id_proveedor, $id]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM items WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM items WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Método para obtener ítems por proveedor
    public function obtenerPorProveedor($id_proveedor) {
        $sql = "SELECT * FROM items WHERE id_proveedor = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id_proveedor]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
