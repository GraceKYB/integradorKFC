<h2>Editar Categoría</h2>
<form method="POST" action="index.php?controller=Categoria&action=editar&id=<?= htmlspecialchars($categoria['cat_id']) ?>" enctype="multipart/form-data">
    <label for="cat_nombre">Nombre:</label>
    <input type="text" name="cat_nombre" value="<?= htmlspecialchars($categoria['cat_nombre']) ?>" required><br>
    <label for="cat_imagen">Imagen:</label>
    <input type="file" name="cat_imagen"><br>
    <?php if (!empty($categoria['cat_imagen'])): ?>
        <p>Imagen Actual:</p>
        <img src="data:image/jpeg;base64,<?= htmlspecialchars($categoria['cat_imagen']) ?>" alt="Imagen Actual" width="100"><br>
    <?php endif; ?>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=Categoria&action=index">Volver</a>
