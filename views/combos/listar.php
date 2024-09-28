<h2>Listar Combos</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($combos as $combo): ?>
        <tr>
            <td><?= htmlspecialchars($combo['com_id']) ?></td>
            <td><?= htmlspecialchars($combo['com_nombre']) ?></td>
            <td><?= htmlspecialchars($combo['com_descripcion']) ?></td>
            <td><?= htmlspecialchars($combo['com_precio']) ?></td>
            <td><img src="data:image/jpeg;base64,<?= htmlspecialchars($combo['com_imagen']) ?>" width="100"></td>
            <td><?= htmlspecialchars($combo['categoria_nombre']) ?></td>
            <td>
                
                <a href="index.php?controller=Combo&action=editar&id=<?= htmlspecialchars($combo['com_id']) ?>">Editar</a>
                <a href="index.php?controller=Combo&action=eliminar&id=<?= htmlspecialchars($combo['com_id']) ?>" onclick="return confirm('¿Estás seguro de eliminar este combo?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php?controller=Combo&action=crear">Crear Nuevo Combo</a>
