<?php
require_once '../modelo/proveedor_modelo.php';
$modelo = new ProveedorModelo();
$proveedores = $modelo->obtenerTodos();
?>

<h2>Gestión de Proveedores</h2>

<form method="POST" action="controlador/proveedor_controlador.php?accion=guardar">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="cuit" placeholder="CUIT">
    <input type="text" name="contacto" placeholder="Contacto">
    <button type="submit">Agregar</button>
</form>

<hr>

<table border="1">
    <tr>
        <th>Nombre</th><th>CUIT</th><th>Contacto</th><th>Acciones</th>
    </tr>
    <?php foreach ($proveedores as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nombre']) ?></td>
            <td><?= htmlspecialchars($p['cuit']) ?></td>
            <td><?= htmlspecialchars($p['contacto']) ?></td>
            <td>
                <a href="controlador/proveedor_controlador.php?accion=eliminar&id=<?= $p['id'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
