<?php
// Verificar si existe el combo
if (isset($combo)):
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Combo</title>
    <link rel="stylesheet" href="path_to_your_css_file.css">
</head>
<body>
    <h1>Editar Combo: <?= htmlspecialchars($combo['com_nombre']); ?></h1>
    
    <form action="index.php?controller=Combo&action=editar&id=<?= $combo['com_id']; ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="com_nombre">Nombre del Combo:</label>
            <input type="text" name="com_nombre" id="com_nombre" value="<?= htmlspecialchars($combo['com_nombre']); ?>" required>
        </div>

        <div>
            <label for="cat_id">Categoría:</label>
            <select name="cat_id" id="cat_id" required>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['cat_id']; ?>" <?= $categoria['cat_id'] == $combo['cat_id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($categoria['cat_nombre']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label for="com_imagen">Imagen del Combo:</label><br>
            <!-- Mostrar la imagen existente si existe -->
            <?php if (!empty($combo['com_imagen'])): ?>
                <img src="data:image/jpeg;base64,<?= $combo['com_imagen']; ?>" alt="Imagen Combo" style="max-width: 200px;"/><br>
            <?php endif; ?>
            <input type="file" name="com_imagen" id="com_imagen" accept="image/*">
        </div>

        <h2>Seleccione Productos</h2>
<?php foreach ($productos as $producto): ?>
    <div>
        <input type="checkbox" name="prod_id[]" value="<?= $producto['prod_id']; ?>" 
               <?= in_array($producto['prod_id'], array_column($detalles, 'prod_id')) ? 'checked' : ''; ?>>
        <?= htmlspecialchars($producto['prod_nombre']); ?> - <?= htmlspecialchars($producto['prod_descripcion']); ?> - <?= htmlspecialchars($producto['prod_precio_venta']); ?>$
    </div>
<?php endforeach; ?>

<div>
    <label for="dc_stock">Stock para todos los productos:</label>
    <input type="number" name="dc_stock" id="dc_stock" required>
</div>

<div>
    <input type="submit" value="Actualizar Combo">
</div>
</form>
<?php endif; ?>