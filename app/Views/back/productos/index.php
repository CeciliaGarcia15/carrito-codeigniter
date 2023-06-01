<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container mt-3">
    <h1 class="text-center mb-2"><?= $title ?></h1>
    <div class="row mb-3">
        <div class="col-4">
            <form class="input-group">
                <input type="text" class="form-control" placeholder="Ingrese el email a buscar">
                <div class="input-group-append">
                    <button class="btn btn-info" type="button">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <a href="">
                <span class="badge" style="background-color:red;">Ver inactivos</span>
            </a>
        </div>
        <div class="col-2">
            <a href="<?php echo base_url(); ?>productos/nuevo" class="btn btn-primary">Nuevo</a>
        </div>
    </div>
    <div class="row">
        <table class="table" style="color:white;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <th><?= $product['id'] ?></th>
                        <td>
                            <img class="img-thumbnail" src="<?php echo base_url();?>/img/productos/<?= $product['imagen']; ?>" 
                            width="100" height="50" alt="">
                        </td>
                        <td><?= ucfirst($product['producto']) ?></td>
                        <td><?= $product['precio'] ?></td>
                        <td><?= $product['cantidad'] ?></td>
                        <td><?php if ($product['baja'] == 'NO') : ?>
                                <span class="badge" style="background-color:green;">Activo</span>
                            <?php else : ?>
                                <span class="badge" style="background-color: red;">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>productos/editar/<?= $product['id'];?>" class="btn btn-warning">Modificar</a>
                            <a href="<?php echo base_url(); ?>productos/delete/<?= $product['id'];?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>