<h2>Lista de IVA</h2>
<a href="index.php?controller=Iva&action=crear">Agregar Nuevo IVA</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Porcentaje</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($ivas as $iva) { ?>
    <tr>
        <td><?= htmlspecialchars($iva['iva_id']) ?></td>
        <td><?= htmlspecialchars($iva['iva_porcentaje']) ?></td>
        <td><?= htmlspecialchars($iva['iva_descripcion']) ?></td>
        <td>
            <a href="index.php?controller=Iva&action=editar&id=<?= htmlspecialchars($iva['iva_id']) ?>">Editar</a> |
            <a href="index.php?controller=Iva&action=eliminar&id=<?= htmlspecialchars($iva['iva_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
