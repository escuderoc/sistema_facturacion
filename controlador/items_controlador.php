<?php
require_once './modelo/item_modelo.php';
$modelo = new ItemModelo();

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'guardar':
        $modelo->guardar($_POST['descripcion'], $_POST['cantidad'], $_POST['precio_unitario'], $_POST['id_proveedor']);
        header('Location: index.php?vista=items');
        break;
    case 'actualizar':
        $modelo->actualizar($_POST['id'], $_POST['descripcion'], $_POST['cantidad'], $_POST['precio_unitario'], $_POST['id_proveedor']);
        header('Location: index.php?vista=items');
        break;
    case 'eliminar':
        $modelo->eliminar($_GET['id']);
        header('Location: index.php?vista=items');
        break;
}
