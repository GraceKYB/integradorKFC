<h2>Crear Nueva Sucursal</h2>
<form method="POST" action="index.php?controller=Sucursal&action=crear">
    <label for="suc_nombre">Nombre:</label>
    <input type="text" name="suc_nombre" required><br>
    <label for="suc_direccion">Dirección:</label>
    <input type="text" name="suc_direccion" required><br>
    <input type="submit" value="Crear">
</form>
<a href="index.php?controller=Sucursal&action=index">Volver</a>
