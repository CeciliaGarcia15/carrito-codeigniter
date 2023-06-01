<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
  <!--TITULO-->
  <h1 class="text-center mb-2"><?= $title ?></h1>

  <!--ALERTA-->
  <?php if (session('mensaje')) { ?>
    <div class="alert alert-danger" role="alert">
      <?php
      echo session('mensaje');
      ?>
    </div>
  <?php } ?>
  <form method="POST" action="<?php echo base_url(); ?>productos/store" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="producto" class="form-label">Producto</label>
      <input type="producto" value="<?= old('producto') ?>" class="form-control" name="producto" placeholder="Ingrese su producto">
    </div>
    <div class="mb-3">
      <label for="precio" class="form-label">Precio</label>
      <input type="precio" value="<?= old('precio') ?>" class="form-control" name="precio" placeholder="Ingrese su precio">
    </div>
    <div class="mb-3">
      <label for="cantidad" class="form-label">Cantidad</label>
      <input type="cantidad" value="<?= old('cantidad') ?>" class="form-control" name="cantidad" placeholder="Ingrese su email">
    </div>
    <div class="mb-3">
      <label for="categoria" class="form-label">Categoría</label>
      <select id="categoria" name="categoria" class="form-select">
        <option value="">Seleccione una categoría a la que pertenece el producto</option>
        <?php foreach ($categorias as $categoria) : ?>
          <option value="<?= $categoria['id']; ?>" <?= (old('categoria') == $categoria['id']) ? 'selected' : ''; ?>>
            <?= $categoria['categoria']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="cantidad" class="form-label">Serie</label>
      <select id="serie" name="serie" class="form-select">
        <option value="">Seleccione la serie a la que pertenece el producto</option>
        <?php foreach ($series as $serie) : ?>
          <option value="<?= $serie['id']; ?>" <?= (old('serie') == $serie['id']) ? 'selected' : ''; ?>>
            <?= $serie['serie']; ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label><br>
      <input type="file" class="form-control-file" name="imagen">
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="<?= base_url('productos') ?>" class="btn btn-info">Cancelar</a>
    </div>
  </form>
</div>
<?= $this->endSection() ?>