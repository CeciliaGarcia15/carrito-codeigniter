<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center mb-2"><?= $title ?></h1>
    <form method="POST" action="<?php echo base_url(); ?>productos/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $producto['id']; ?>">
    <div class="mb-3">
        <label for="producto" class="form-label">Producto</label>
        <input type="text" value="<?= $producto['producto'];?>" class="form-control" name="producto" placeholder="Ingrese su producto">
      </div>
      <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="text" value="<?= $producto['precio'];?>" class="form-control" name="precio" placeholder="Ingrese su precio">
      </div>
      <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="cantidad" value="<?= $producto['cantidad'];?>" class="form-control" name="cantidad" placeholder="Ingrese su email">
      </div>
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label><br>
        <img class="img-thumbnail" src="<?php echo base_url();?>/img/productos/<?= $producto['imagen']; ?>" 
                            width="100" alt=""><br><br>
        <input type="file" class="form-control-file" name="imagen">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="<?= base_url('productos') ?>" class="btn btn-info">Cancelar</a>
      </div>
    </form>
</div>
<?= $this->endSection() ?>