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
  <form method="POST" action="<?php echo base_url(); ?>categorias/store" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="categoria" class="form-label">Categoria</label>
      <input type="categoria" value="<?= old('categoria') ?>" class="form-control" name="categoria" placeholder="Ingrese su categoria">
    </div>
    
    <div class="mb-3">
      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="<?= base_url('categorias') ?>" class="btn btn-info">Cancelar</a>
    </div>
  </form>
</div>
<?= $this->endSection() ?>