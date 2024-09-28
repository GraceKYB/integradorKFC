<h2>Lista de Categorías</h2>
<a href="index.php?controller=Categoria&action=crear">Agregar Nueva Categoría</a>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($categorias as $categoria) { 
        // Asumimos que $categoria['cat_imagen'] ya está en formato base64
        $imagenBase64 = $categoria['cat_imagen'];
        $imagenSrc = "data:image/png;base64," . $imagenBase64; // Asegúrate de usar el tipo MIME correcto si es necesario
    ?>
    <tr>
        <td><?= htmlspecialchars($categoria['cat_id']) ?></td>
        <td><?= htmlspecialchars($categoria['cat_nombre']) ?></td>
        <td>
            <img src="<?= htmlspecialchars($imagenSrc) ?>" width="50" alt="Imagen de Categoría" />
        </td>
        <td>
            <a href="index.php?controller=Categoria&action=editar&id=<?= htmlspecialchars($categoria['cat_id']) ?>">Editar</a> |
            <a href="index.php?controller=Categoria&action=eliminar&id=<?= htmlspecialchars($categoria['cat_id']) ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
</table>
