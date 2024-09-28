<h2>Crear Nuevo IVA</h2>
<form method="POST" action="index.php?controller=Iva&action=crear">
    <label for="iva_porcentaje">Porcentaje:</label>
    <input type="text" name="iva_porcentaje" required><br>
    <label for="iva_descripcion">Descripción:</label>
    <input type="text" name="iva_descripcion"><br>
    <input type="submit" value="Crear">
</form>
<a href="index.php?controller=Iva&action=index">Volver</a>
