<?php
require_once '../modelo/item_modelo.php';
$modelo = new ItemModelo();
$items = $modelo->obtenerPorProveedor($_GET['id']);
header('Content-Type: application/json');
echo json_encode($items);
