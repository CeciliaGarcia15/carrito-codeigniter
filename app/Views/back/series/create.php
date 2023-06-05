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
  <form method="POST" action="<?php echo base_url(); ?>series/store" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="serie" class="form-label">Serie</label>
      <input type="serie" value="<?= old('serie') ?>" class="form-control" name="serie" placeholder="Ingrese su serie">
    </div>
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label><br>
      <input type="file" class="form-control-file" name="imagen">
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="<?= base_url('series') ?>" class="btn btn-info">Cancelar</a>
    </div>
  </form>
</div>
<?= $this->endSection() ?>