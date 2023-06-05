<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <h1 class="text-center mb-2"><?= $title ?></h1>
    <form method="POST" action="<?php echo base_url(); ?>categorias/update" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $categoria['id']; ?>">
    <div class="mb-3">
        <label for="categoria" class="form-label">categoria</label>
        <input type="text" value="<?= $categoria['categoria'];?>" class="form-control" name="categoria" placeholder="Ingrese su categoria">
      </div>
      <div class="mb-3">
        <button type="submit" class="btn btn-warning">Actualizar</button>
        <a href="<?= base_url('categorias') ?>" class="btn btn-info">Cancelar</a>
      </div>
    </form>
</div>
<?= $this->endSection() ?>