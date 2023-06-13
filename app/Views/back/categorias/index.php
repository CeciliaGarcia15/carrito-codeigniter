<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container mt-3">
    <h1 class="text-center mb-2"><?= $title ?></h1>
    <div class="row mb-3">
        <div class="col-4">
            <form class="input-group" method="POST" action="<?php echo base_url(); ?>categorias/search">
                <input type="text" class="form-control"  name="search" placeholder="Ingrese la categoria a buscar">
                <div class="input-group-append">
                    <button class="btn btn-info" type="submit">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-6">
        <?php if(isset($inactivo)) : ?>
                <a href="<?php echo base_url(); ?>categorias">
                <span class="badge" style="background-color:green;">Ver activos</span>
            </a>
           <?php else: ?>
            <a href="<?php echo base_url(); ?>categorias/inactivos">
                <span class="badge" style="background-color:red;">Ver inactivos</span>
            </a>
            <?php endif; ?>
        </div>
        <div class="col-2">
            <a href="<?php echo base_url(); ?>categorias/nuevo" class="btn btn-primary">Nuevo</a>
        </div>
    </div>
    <div class="row mb-3">
        <table class="table" style="color:white; ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Categoria</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria) : ?>
                    <tr>
                        <th><?= $categoria['id'] ?></th>
                       
                        <td><?= ucfirst($categoria['categoria']) ?></td>
                        
                        <td><?php if ($categoria['baja'] == 'NO') : ?>
                                <span class="badge" style="background-color:green;">Activo</span>
                            <?php else : ?>
                                <span class="badge" style="background-color: red;">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url(); ?>categorias/editar/<?= $categoria['id'];?>" class="btn btn-warning">Modificar</a>
                            <a href="<?php echo base_url(); ?>categorias/delete/<?= $categoria['id'];?>" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
        
    </div>
</div>

<?= $this->endSection() ?>