<?php
require_once './modelo/proforma_modelo.php';
$proformaModelo = new ProformaModelo();

$accion = $_GET['accion'] ?? '';

switch ($accion) {
    case 'crear':
        $id_proveedor = $_POST['id_proveedor'];
        $observaciones = $_POST['observaciones'] ?? '';
        $id_proforma = $proformaModelo->crear($id_proveedor, $observaciones);

        if (!empty($_POST['items'])) {
            foreach ($_POST['items'] as $item) {
                $proformaModelo->agregarItem(
                    $id_proforma,
                    $item['id_item'],
                    $item['cantidad'],
                    $item['precio_unitario']
                );
            }
        }

        header("Location: index.php?vista=proformas");
        break;
}
