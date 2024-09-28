<h2>Lista de Sucursales</h2>
<a href="index.php?controller=Sucursal&action=crear">Agregar Nueva Sucursal</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($sucursales as $sucursal) { ?>
    <tr>
        <td><?= htmlspecialchars($sucursal['suc_id']) ?></td>
        <td><?= htmlspecialchars($sucursal['suc_nombre']) ?></td>
        <td><?= htmlspecialchars($sucursal['suc_direccion']) ?></td>
        <td>
            <a href="index.php?controller=Sucursal&action=editar&id=<?= htmlspecialchars($sucursal['suc_id']) ?>">Editar</a> |
            <a href="index.php?controller=Sucursal&action=eliminar&id=<?= htmlspecialchars($sucursal['suc_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
