<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <h4>
        <i class="bi bi-arrow-left-circle-fill"></i>
        <a href="<?php echo base_url(); ?>" class="link-light">Tienda</a>
    </h4>

    <?php if (empty($cart)) : ?>
        <div class="alert alert-info" role="alert">
            <span>El carrito está vacío.</span>
        </div>
    <?php else : ?>
        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <div class="row">
        <p class="text-end">
            <a  href="<?php echo base_url(); ?>carrito/limpiar" class="btn btn-primary">Vaciar Carrito</a>
        </p>
        </div>
       
        <table class="table text-center" style="color:white;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0;
                foreach ($products as $product) :
                    $total += $product['precio'] * $product['cantidad'];
                ?>
                    <tr>
                        <td><?= $product['id']; ?></td>
                        <td><?= $product['producto']; ?></td>
                        <td>
                            <form action="<?= base_url(); ?>/carrito/actualizar/<?= $product['id']; ?>" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <button type="submit" name="quantity" value="<?= $product['cantidad'] - 1; ?>" class="btn btn-sm btn-outline-danger">-</button>
                                <?= $product['cantidad']; ?>
                                <button type="submit" name="quantity" value="<?= $product['cantidad'] + 1; ?>" class="btn btn-sm btn-outline-success">+</button>
                            </form>
                        </td>
                        <td>$<?= $product['precio']; ?></td>
                        <td>$<?= number_format($product['precio'] * $product['cantidad'], 2); ?></td>
                        <td>
                            <a class="btn btn-danger" href="<?php echo base_url(); ?>/carrito/eliminar/<?= $product['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                
            </tbody>
        </table>
        <p class="text-end fw-bolder fs-3" style="color: white;">TOTAL: $<?= number_format($total, 2); ?></p>
    
            <div class="row">
            <a class="btn btn-success" href="<?php echo base_url(); ?>carrito/agregar-informacion">Comprar</a>
            </div>
            
        
        

        
    <?php endif; ?>

</div>

<?= $this->endSection() ?>