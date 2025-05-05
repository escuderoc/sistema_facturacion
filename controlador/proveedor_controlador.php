<?php
require_once '../modelo/proveedor_modelo.php';
$modelo = new ProveedorModelo();

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'guardar':
        $modelo->crearProveedor($_POST['nombre'], $_POST['cuit'], $_POST['contacto']);
        header('Location: index.php?vista=proveedores');
        break;
    case 'actualizar':
        $modelo->actualizarProveedor($_POST['id'], $_POST['nombre'], $_POST['cuit'], $_POST['contacto']);
        header('Location: index.php?vista=proveedores');
        break;
    case 'eliminar':
        $modelo->eliminarProveedor($_GET['id']);
        header('Location: index.php?vista=proveedores');
        break;
}
