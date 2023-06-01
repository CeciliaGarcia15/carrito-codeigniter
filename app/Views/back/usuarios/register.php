<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="col-md-6">
    <form action="<?php echo base_url(); ?>usuarios/store" method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="nombre" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
      </div>
      <div class="mb-3">
        <label for="apellido" class="form-label">Apellido</label>
        <input type="apellido" class="form-control" id="apellido" name="apellido" placeholder="Ingrese su apellido">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
      </div>
      <div class="mb-3">
        <label for="user" class="form-label">Usuario</label>
        <input type="user" class="form-control" id="user" name="user" placeholder="Ingrese su usuario">
      </div>
      <div class="mb-3 text-center">
        <button type="submit" class="btn btn-info btn-enviar">Registrarse</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
