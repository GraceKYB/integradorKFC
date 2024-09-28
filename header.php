<!DOCTYPE html>
<html>
<head>
    <title>Mi Aplicación</title>
    <style>
        /* Estilos simples para el menú */
        ul.menu {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #f2f2f2;
            border-bottom: 1px solid #ddd;
        }
        ul.menu li {
            display: inline;
            margin-right: 10px;
        }
        ul.menu li a {
            text-decoration: none;
            color: #333;
            padding: 10px 20px;
            display: inline-block;
        }
        ul.menu li a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <ul class="menu">
        <li><a href="index.php?controller=Categoria&action=index">Lista Categorías</a></li>
        <li><a href="index.php?controller=Combo&action=index">Lista Combos</a></li>
        <li><a href="index.php?controller=Iva&action=index">Iva</a></li>
        <li><a href="index.php?controller=MargenGanancia&action=index">Margen Ganancia</a></li>
        <li><a href="index.php?controller=Producto&action=index">Producto</a></li>
        <li><a href="index.php?controller=MetodoPago&action=index">Metodo de pago</a></li>
        <li><a href="index.php?controller=Sucursal&action=index">Sucursales</a></li>
        <li><a href="index.php?controller=Rol&action=index">Roles</a></li>
        <li><a href="index.php?controller=Pedido&action=index">Pedidos</a></li>
    </ul>
