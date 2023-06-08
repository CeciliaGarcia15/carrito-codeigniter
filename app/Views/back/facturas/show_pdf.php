<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Store.</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        table,td,th{
            border: 1px solid #ddd;
            border-collapse: collapse;
            width: 100%;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-2">
        <h4 >Anime Store</h4>
        <h1 style="text-align: center;"><?= $title . ' ' . $factura['id'] ?> </h1>

        <div class="row">
            <div class="col-md-12">
                <h5>Información del comprador</h5>
                <h6>Nombre y Apellido: <?= $usuario['apellido'] ?>, <?= $usuario['nombre'] ?></h6>
                <h6>Email: <?= $usuario['email'] ?></h6>
            </div>
        </div>
        <div class="row">
            <h5>Información de la compra</h5>
            <h6>Fecha: <?= $factura['fecha_compra'] ?></h6>
            <h6>Domicilio: </h6>
            <h6>Medio de pago: </h6>
            <h6>Total: $<?= $factura['total'] ?> </h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ventas as $venta) : ?>
                    <?php
                    $producto = null;
                    foreach ($productos as $product) {
                        /* var_dump($product['id'].' '.$venta['productos_id']);
                        die(); */
                        if ($product['id'] == $venta['productos_id']) {
                            $producto = $product;
                            break;
                        }
                    }

                    if ($producto) {
                        $total = $venta['precio_unitario'] * $venta['cantidad'];
                    ?>
                        <tr>
                            <td><?= $producto['producto']; ?></td>
                            <td><?= $venta['cantidad']; ?></td>
                            <td>$<?= $venta['precio_unitario']; ?></td>
                            <td>$<?= $total; ?></td>
                        </tr>
                    <?php } ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>