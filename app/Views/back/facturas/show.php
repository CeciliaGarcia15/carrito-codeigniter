<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <h4>
        <i class="bi bi-arrow-left-circle-fill"></i>
        <a href="<?php echo base_url(); ?>venta/historial_compras/<?= $usuario['id'] ?>" class="link-light">Historial</a>
    </h4>
    <h1 class="text-center"><?= $title.' '.$factura['id']?> </h1><br>

    <div class="row">
        <div class="col-md-4">
            <h5 class="text-decoration-underline">Información del comprador</h5>
            <h6>Nombre y Apellido: <?= $usuario['apellido'] ?>, <?= $usuario['nombre'] ?></h6>
            <h6>Email: <?= $usuario['email'] ?></h6>
        </div>
        <div class="col-md-4">
            <h5 class="text-decoration-underline">Información de la compra</h5>
            <h6>Fecha: <?= date("d/m/Y H:i:s", strtotime($factura['fecha_compra'])) ?></h6>
            <h6>Provincia: <?= $provincia['provincia'] ?></h6>
            <h6>Ciudad: <?= $envio['ciudad'] ?> </h6>
            <h6>Dirección: <?= $envio['direccion'] ?> </h6>
            <h6>Codigo Postal: <?= $envio['codigo_postal'] ?> </h6>
            <h6>Medio de pago: <?= $envio['forma_pago'] ?> </h6>
        </div>
        <div class="col-md-4">
            <h5 class="text-decoration-underline">Información de la empresa</h5>
            <h6>Empresa: Anime Store</h6>
            <h6>Domicilio: Santa Fé 1025 </h6>
            <h6>Telefono: 3794336765 </h6>
            <h6>Email: anime.store@gmail.com </h6>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        <a class="btn btn-outline-info" href="<?php echo base_url(); ?>factura/pdf/<?= $factura['id']?>"><i class="bi bi-filetype-pdf"></i> Descargar</a>

        </div>
    </div>
    <div class="row">
        <table class="table text-center" style="color:white;">
            <thead>
                <tr>
                    
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($ventas as $venta) : ?>
    <?php
        $producto = null;
        foreach ($productos as $product) {
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
        <div class="row">
        <h3 class="text-end">Total: $<?= $factura['total'] ?> </h3>
        </div>
</div>

<?= $this->endSection() ?>