<h2>Lista de Márgenes de Ganancia</h2>
<a href="index.php?controller=MargenGanancia&action=crear">Agregar Nuevo Margen</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Porcentaje</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($margenes as $margen) { ?>
    <tr>
        <td><?= htmlspecialchars($margen['mg_id']) ?></td>
        <td><?= htmlspecialchars($margen['mg_porcentaje']) ?></td>
        <td><?= htmlspecialchars($margen['mg_descripcion']) ?></td>
        <td>
            <a href="index.php?controller=MargenGanancia&action=editar&id=<?= htmlspecialchars($margen['mg_id']) ?>">Editar</a> |
            <a href="index.php?controller=MargenGanancia&action=eliminar&id=<?= htmlspecialchars($margen['mg_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
