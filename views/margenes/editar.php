<h2>Editar Margen de Ganancia</h2>
<form method="POST" action="index.php?controller=MargenGanancia&action=editar&id=<?= htmlspecialchars($margen['mg_id']) ?>">
    <label for="mg_porcentaje">Porcentaje:</label>
    <input type="number" step="0.01" name="mg_porcentaje" value="<?= htmlspecialchars($margen['mg_porcentaje']) ?>" required><br>
    <label for="mg_descripcion">Descripción:</label>
    <textarea name="mg_descripcion"><?= htmlspecialchars($margen['mg_descripcion']) ?></textarea><br>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=MargenGanancia&action=index">Volver</a>
