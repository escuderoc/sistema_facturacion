<?php
require_once 'config/db.php';

class ProformaModelo {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function crear($id_proveedor, $observaciones = '') {
        $sql = "INSERT INTO proformas (id_proveedor, fecha_creacion, estado, observaciones) VALUES (?, CURDATE(), 'pendiente', ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_proveedor, $observaciones]);
        return $this->db->lastInsertId();
    }

    public function agregarItem($id_proforma, $id_item, $cantidad, $precio_unitario) {
        $sql = "INSERT INTO proforma_items (id_proforma, id_item, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_proforma, $id_item, $cantidad, $precio_unitario]);
    }

    public function obtenerTodas() {
        $sql = "SELECT p.*, pr.nombre AS proveedor_nombre 
                FROM proformas p 
                JOIN proveedores pr ON p.id_proveedor = pr.id";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id_proforma) {
        $sql = "SELECT * FROM proformas WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_proforma]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerItems($id_proforma) {
        $sql = "SELECT pi.*, i.descripcion 
                FROM proforma_items pi 
                JOIN items i ON pi.id_item = i.id 
                WHERE pi.id_proforma=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_proforma]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
