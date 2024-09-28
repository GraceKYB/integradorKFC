<form action="index.php?controller=Combo&action=crear" method="POST" enctype="multipart/form-data">
    <label for="com_nombre">Nombre del Combo:</label>
    <input type="text" name="com_nombre" required><br>

    <label for="cat_id">Categoría:</label>
    <select name="cat_id">
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['cat_id'] ?>"><?= $categoria['cat_nombre'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label for="com_imagen">Imagen del Combo:</label>
    <input type="file" name="com_imagen" accept="image/*" required><br>

    <label for="prod_id[]">Seleccione Productos:</label><br>
    <?php foreach ($productos as $producto): ?>
        <input type="checkbox" name="prod_id[]" value="<?= $producto['prod_id'] ?>">
        <?= $producto['prod_nombre'] ?> (<?= $producto['prod_descripcion'] ?>) - <?= $producto['prod_precio_venta'] ?><br>
    <?php endforeach; ?>
    <br>

    <label for="dc_stock">Stock para los productos seleccionados:</label>
    <input type="number" name="dc_stock" required min="1"><br>

    <button type="submit">Crear Combo</button>
</form>
