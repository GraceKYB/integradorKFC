<h2>Lista de Roles</h2>
<a href="index.php?controller=Rol&action=crear">Agregar Nuevo Rol</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($roles as $rol) { ?>
    <tr>
        <td><?= htmlspecialchars($rol['rol_id']) ?></td>
        <td><?= htmlspecialchars($rol['rol_nombre']) ?></td>
        <td>
            <a href="index.php?controller=Rol&action=editar&id=<?= htmlspecialchars($rol['rol_id']) ?>">Editar</a> |
            <a href="index.php?controller=Rol&action=eliminar&id=<?= htmlspecialchars($rol['rol_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
