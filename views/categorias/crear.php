<h2>Crear Nueva Categoría</h2>
<form method="POST" action="index.php?controller=Categoria&action=crear" enctype="multipart/form-data">
    <label for="cat_nombre">Nombre:</label>
    <input type="text" name="cat_nombre" required><br>
    <label for="cat_imagen">Imagen:</label>
    <input type="file" name="cat_imagen"><br>
    <input type="submit" value="Crear">
</form>
<a href="index.php?controller=Categoria&action=index">Volver</a>
