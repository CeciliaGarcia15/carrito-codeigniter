<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <h4>
        <i class="bi bi-arrow-left-circle-fill"></i>
        <a href="<?php echo base_url(); ?>" class="link-light">Tienda</a>
    </h4>
    <h1>Carrito de Compras</h1>

    <?php if (empty($cart)) : ?>
        <div class="alert alert-info" role="alert">
            <span>El carrito está vacío.</span>
        </div>
    <?php else : ?>
        <table class="table" style="color:white;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id']; ?></td>
                        <td><?= $product['producto']; ?></td>
                        <td><?= $product['cantidad']; ?></td>
                        <td><?= $product['precio']; ?></td>
                        <td><?= $product['precio'] * $product['cantidad']; ?></td>
                        <td>
                            <a href="<?php echo base_url(); ?>/carrito/eliminar/<?= $product['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p>
            <a href="<?php echo base_url(); ?>carrito/limpiar" class="btn btn-primary">Vaciar Carrito</a>
        </p>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>