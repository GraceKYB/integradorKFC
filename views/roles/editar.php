<h2>Editar Rol</h2>
<form method="POST" action="index.php?controller=Rol&action=editar&id=<?= htmlspecialchars($rol['rol_id']) ?>">
    <label for="rol_nombre">Nombre:</label>
    <input type="text" name="rol_nombre" value="<?= htmlspecialchars($rol['rol_nombre']) ?>" required><br>
    <input type="submit" value="Guardar Cambios">
</form>
<a href="index.php?controller=Rol&action=index">Volver</a>
