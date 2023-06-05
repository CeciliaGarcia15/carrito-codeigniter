<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center mb-2"><?= $title ?></h1>
    <form method="POST" action="<?php echo base_url(); ?>series/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $serie['id']; ?>">
    <div class="mb-3">
        <label for="serie" class="form-label">Serie</label>
        <input type="text" value="<?= $serie['serie'];?>" class="form-control" name="serie" placeholder="Ingrese su serie">
      </div>
      <div class="mb-3">
        <label for="imagen" class="form-label">Imagen</label><br>
        <img class="img-thumbnail" src="<?php echo base_url();?>/img/series/<?= $serie['imagen']; ?>" 
                            width="100" alt=""><br><br>
        <input type="file" class="form-control-file" name="imagen">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="<?= base_url('series') ?>" class="btn btn-info">Cancelar</a>
      </div>
    </form>
</div>
<?= $this->endSection() ?>