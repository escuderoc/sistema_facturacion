<?php
require_once './modelo/item_modelo.php';
require_once './modelo/proveedor_modelo.php';
require_once './modelo/proforma_modelo.php';

$itemModelo = new ItemModelo();
$proveedorModelo = new ProveedorModelo();
$proformaModelo = new ProformaModelo();

$proveedores = $proveedorModelo->obtenerTodos();
$proformas = $proformaModelo->obtenerTodas();
?>

<h2>Crear Nueva Proforma</h2>

<form method="POST" action="controlador/proforma_controlador.php?accion=crear">
    <label>Proveedor:</label>
    <select name="id_proveedor" id="id_proveedor" required>
        <option value="">Seleccione</option>
        <?php foreach ($proveedores as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
        <?php endforeach; ?>
    </select>

    <br><label>Observaciones:</label>
    <textarea name="observaciones"></textarea>

    <div id="contenedor-items"></div>

    <button type="submit">Crear Proforma</button>
</form>

<hr>

<h2>Proformas existentes</h2>
<table border="1">
    <tr>
        <th>ID</th><th>Proveedor</th><th>Estado</th><th>Fecha</th><th>Acciones</th>
    </tr>
    <?php foreach ($proformas as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['proveedor_nombre']) ?></td>
            <td><?= $p['estado'] ?></td>
            <td><?= $p['fecha_creacion'] ?></td>
            <td><a href="#">Ver</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
document.getElementById('id_proveedor').addEventListener('change', function () {
    const id = this.value;
    fetch('ajax/items_por_proveedor.php?id=' + id)
        .then(res => res.json())
        .then(data => {
            let contenedor = document.getElementById('contenedor-items');
            contenedor.innerHTML = '';
            data.forEach(item => {
                contenedor.innerHTML += `
                    <div>
                        <input type="checkbox" name="items[]" value="${item.id}">
                        ${item.descripcion} - Cant: 
                        <input type="number" name="items[${item.id}][cantidad]" value="1" min="1"> 
                        Precio: 
                        <input type="number" step="0.01" name="items[${item.id}][precio_unitario]" value="${item.precio_unitario}">
                        <input type="hidden" name="items[${item.id}][id_item]" value="${item.id}">
                    </div>`;
            });
        });
});
</script>
