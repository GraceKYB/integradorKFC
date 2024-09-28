<form method="POST" enctype="multipart/form-data" action="index.php?controller=producto&action=crear">
    <label for="prod_nombre">Nombre:</label>
    <input type="text" name="prod_nombre" required>

    <label for="prod_descripcion">Descripción:</label>
    <textarea name="prod_descripcion" required></textarea>

    <label for="prod_precio_compra">Precio de Compra:</label>
    <input type="number" step="0.01" name="prod_precio_compra" required>

    <label for="prod_extra">Extra:</label>
    <input type="checkbox" name="prod_extra">

    <label for="prod_stock">Stock:</label>
    <input type="number" name="prod_stock" required>

    <label for="iva_id">IVA:</label>
    <select name="iva_id" required>
        <?php foreach($ivas as $iva): ?>
            <option value="<?= $iva['iva_id'] ?>"><?= $iva['iva_porcentaje'] ?>%</option>
        <?php endforeach; ?>
    </select>

    <label for="mg_id">Margen de Ganancia:</label>
    <select name="mg_id" required>
        <?php foreach($margen_ganancias as $mg): ?>
            <option value="<?= $mg['mg_id'] ?>"><?= $mg['mg_porcentaje'] ?>%</option>
        <?php endforeach; ?>
    </select>

    <label for="suc_id">Sucursal:</label>
    <select name="suc_id" required>
        <?php foreach($sucursales as $sucursal): ?>
            <option value="<?= $sucursal['suc_id'] ?>"><?= $sucursal['suc_nombre'] ?></option>
        <?php endforeach; ?>
    </select>

    <label for="prod_imagen">Imagen:</label>
    <input type="file" name="prod_imagen">

    <input type="submit" value="Crear Producto">
</form>
