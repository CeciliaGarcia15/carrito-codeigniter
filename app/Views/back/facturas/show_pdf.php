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
        p{
            font-size: 12px;
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
            <p><strong>Nombre y Apellido:</strong>  <?= $usuario['apellido'] ?>, <?= $usuario['nombre'] ?> &nbsp;&nbsp;&nbsp;&nbsp;<strong>Email:</strong>  <?= $usuario['email'] ?></p>
            </div>
        </div>
        <div class="row">
            <h5>Información de la compra</h5>
            <p>
                <strong>Fecha: </strong>  <?= date("d/m/Y H:i:s", strtotime($factura['fecha_compra'])) ?> &nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Provincia: </strong>  <?= $provincia['provincia'] ?> &nbsp;&nbsp;&nbsp;&nbsp;  
                <strong>Ciudad: </strong>  <?= $envio['ciudad'] ?> 
            </p>
            <p>
                <strong>Dirección: </strong>  <?= $envio['direccion'] ?> &nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Codigo Postal: </strong>  <?= $envio['codigo_postal'] ?> &nbsp;&nbsp;&nbsp;&nbsp;  
                <strong>Medio de pago: </strong> <?= $envio['forma_pago'] ?>
            </p>
        </div>
        <br>
        <div class="row">
        <h5>Información de la empresa</h5>
            <p>
                <strong>Empresa:  </strong>  Anime Store &nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Domicilio: </strong>  Santa Fé 1025  &nbsp;&nbsp;&nbsp;&nbsp;  
                <strong>Telefono:  </strong> 3794336765 &nbsp;&nbsp;&nbsp;&nbsp;
                <strong>Email: </strong> anime.store@gmail.com
            </p>
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
        <h3>Total: $<?= $factura['total'] ?> </h3>
    </div>
</body>

</html>