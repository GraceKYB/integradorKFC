<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Pedidos y Detalles</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu CSS si lo tienes -->
</head>
<body>
    <h1>Listado de Pedidos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Pedido</th>
                <th>Cliente ID</th>
                <th>Sucursal ID</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Total</th>
                <th>Medio de Pago ID</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pedido['pedido_id']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['cliente_id']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['suc_id']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['pedido_fecha']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['pedido_estado']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['pedido_total']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['mp_id']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['estado']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1>Listado de Detalle de Pedidos</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID Detalle</th>
                <th>ID Pedido</th>
                <th>Tipo</th>
                <th>ID Item</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Estado</th>
                <th>ID Combo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detallePedidos as $detallePedido): ?>
                <tr>
                    <td><?php echo htmlspecialchars($detallePedido['dp_id']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['pedido_id']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['dp_tipo']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['dp_item_id']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['dp_cantidad']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['dp_precio']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['dp_total']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['estado']); ?></td>
                    <td><?php echo htmlspecialchars($detallePedido['com_id']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
