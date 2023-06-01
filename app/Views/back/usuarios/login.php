<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
  <div class="col-md-6">
    <?php
      if(isset($mensaje)){ ?>
          <div class="alert alert-danger" role="alert">
            <?php echo($mensaje); ?>
          </div>
      <?php }
    ?>
    <?php
      if(isset($message)){ ?>
          <div class="alert alert-success" role="alert">
            <?php echo($message); ?>
          </div>
      <?php }
    ?>
    <form action="<?php echo base_url(); ?>login2" method="POST">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="Ingrese su email">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="pass" class="form-control" id="password" placeholder="Ingrese su contraseña">
      </div>
      <div class="mb-3 text-center">
        <button type="submit" class="btn btn-info btn-enviar">Iniciar sesión</button>
      </div>
      <p class="text-center">¿No tienes una cuenta? <a href="<?php echo base_url(); ?>register">Registrarse</a></p>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
