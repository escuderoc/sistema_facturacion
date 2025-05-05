<?php
require_once './modelo/item_modelo.php';
require_once './modelo/proveedor_modelo.php';

$itemModelo = new ItemModelo();
$proveedorModelo = new ProveedorModelo();

$items = $itemModelo->obtenerTodos();
$proveedores = $proveedorModelo->obtenerTodos();
?>

<h2>Gestión de Ítems Facturables</h2>

<form method="POST" action="controlador/item_controlador.php?accion=guardar">
    <input type="text" name="descripcion" placeholder="Descripción" required>
    <input type="number" step="0.01" name="cantidad" placeholder="Cantidad" required>
    <input type="number" step="0.01" name="precio_unitario" placeholder="Precio Unitario" required>

    <select name="id_proveedor" required>
        <option value="">Seleccione proveedor</option>
        <?php foreach ($proveedores as $prov): ?>
            <option value="<?= $prov['id'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Agregar ítem</button>
</form>

<hr>

<table border="1">
    <tr>
        <th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Proveedor</th><th>Acciones</th>
    </tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['descripcion']) ?></td>
            <td><?= $item['cantidad'] ?></td>
            <td>$<?= $item['precio_unitario'] ?></td>
            <td><?= htmlspecialchars($item['proveedor_nombre']) ?></td>
            <td>
                <a href="controlador/item_controlador.php?accion=eliminar&id=<?= $item['id'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
