<h2>Editar Sucursal</h2>
<form method="POST" action="index.php?controller=Sucursal&action=editar&id=<?= htmlspecialchars($sucursal['suc_id']) ?>">
    <label for="suc_nombre">Nombre:</label>
    <input type="text" name="suc_nombre" value="<?= htmlspecialchars($sucursal['suc_nombre']) ?>" required><br>
    <label for="suc_direccion">Dirección:</label>
    <input type="text" name="suc_direccion" value="<?= htmlspecialchars($sucursal['suc_direccion']) ?>" required><br>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=Sucursal&action=index">Volver</a>
