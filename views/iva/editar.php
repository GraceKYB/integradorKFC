<h2>Editar IVA</h2>
<form method="POST" action="index.php?controller=Iva&action=editar&id=<?= htmlspecialchars($iva['iva_id']) ?>">
    <label for="iva_porcentaje">Porcentaje:</label>
    <input type="text" name="iva_porcentaje" value="<?= htmlspecialchars($iva['iva_porcentaje']) ?>" required><br>
    <label for="iva_descripcion">Descripción:</label>
    <input type="text" name="iva_descripcion" value="<?= htmlspecialchars($iva['iva_descripcion']) ?>"><br>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=Iva&action=index">Volver</a>
