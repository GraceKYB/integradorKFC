<h2>Crear Nuevo Margen de Ganancia</h2>
<form method="POST" action="index.php?controller=MargenGanancia&action=crear">
    <label for="mg_porcentaje">Porcentaje:</label>
    <input type="number" step="0.01" name="mg_porcentaje" required><br>
    <label for="mg_descripcion">Descripción:</label>
    <textarea name="mg_descripcion"></textarea><br>
    <input type="submit" value="Crear">
</form>
<a href="index.php?controller=MargenGanancia&action=index">Volver</a>
