<h2>Editar Método de Pago</h2>
<form method="POST" action="index.php?controller=MetodoPago&action=editar&id=<?= htmlspecialchars($metodoPago['mp_id']) ?>">
    <label for="mp_nombre">Nombre:</label>
    <input type="text" name="mp_nombre" value="<?= htmlspecialchars($metodoPago['mp_nombre']) ?>" required><br>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=MetodoPago&action=index">Volver</a>
