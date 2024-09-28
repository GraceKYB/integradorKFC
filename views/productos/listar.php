<h2>Listado de Productos</h2>
<a href="index.php?controller=Producto&action=crear">Agregar Nuevo Producto</a>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Stock</th>
            <th>Sucursal</th>
            <th>Imagen</th>
            <th>Extra</th>
            <th>Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                
                <td><?= $producto['prod_nombre'] ?></td>
                <td><?= $producto['prod_descripcion'] ?></td>
                <td><?= $producto['prod_precio_compra'] ?></td>
                <td><?= $producto['prod_precio_venta'] ?></td>
                <td><?= $producto['prod_stock'] ?></td>
                <td><?= $producto['suc_nombre'] ?></td>
                <td>
                    <?php if (!empty($producto['prod_imagen'])): ?>
                        <img src="data:image/jpeg;base64,<?= $producto['prod_imagen'] ?>" alt="Imagen del producto" width="100">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
                <td>
                    <?= $producto['prod_extra'] ? 'Sí' : 'No' ?>
                </td>
                <td>
                    
                    <a href="index.php?controller=producto&action=editar&id=<?= $producto['prod_id'] ?>">Editar</a>
                    <a href="index.php?controller=producto&action=eliminar&id=<?= $producto['prod_id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
