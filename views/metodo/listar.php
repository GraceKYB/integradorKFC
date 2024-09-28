<h2>Lista de Métodos de Pago</h2>
<a href="index.php?controller=MetodoPago&action=crear">Agregar Nuevo Método de Pago</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($metodosPago as $metodo) { ?>
    <tr>
        <td><?= htmlspecialchars($metodo['mp_id']) ?></td>
        <td><?= htmlspecialchars($metodo['mp_nombre']) ?></td>
        <td>
            <a href="index.php?controller=MetodoPago&action=editar&id=<?= htmlspecialchars($metodo['mp_id']) ?>">Editar</a> |
            <a href="index.php?controller=MetodoPago&action=eliminar&id=<?= htmlspecialchars($metodo['mp_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
