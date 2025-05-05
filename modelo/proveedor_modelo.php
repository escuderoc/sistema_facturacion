<?php

require_once 'conexion.php';

class ProveedorModelo{
    private $conn;

    public function __construct(){
        $this->conn = Conexion::conectar();
    }
    public function obtenerTodos(){
        $sql = "SELECT * FROM proveedores";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    public function crearProveedor($nombre, $cuit, $contacto){
        $sql = "INSERT INTO proveedores (nombre, cuit, contacto) VALUE (?,?,?)";
        $stmt = $this ->conn->prepare($sql);
        return $stmt->execute([$nombre,$cuit,$contacto]);
    }
    public function actualizarProveedor($id,$nombre,$cuit,$contacto){
        $sql = "UPDATE proveedores SET nombre =?, cuit=?, contacto=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nombre,$cuit,$contacto,$id]);
    }
    public function eliminarProveedor($id) {
        $sql = "DELETE FROM proveedores WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
    public function obtenerProveedorPorId($id) {
        $sql = "SELECT * FROM proveedores WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}