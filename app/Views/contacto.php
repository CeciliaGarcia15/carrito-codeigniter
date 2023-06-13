<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-3 pb-5">
  <div class="row justify-content-center align-items-center g-2">
    <h1 class="text-center">Contactanos</h1>
  </div>
  <?php if(isset($success)){ ?>
          <div class="alert alert-success mess-alert" role="alert">
            <?php echo($success); ?>
          </div>
      <?php }
    ?>
    <?php if(session()->get('error')){ ?>
          <div class="alert alert-danger mess-alert" role="alert">
            <?php echo session()->get('error') ; ?>
          </div>
      <?php }
    ?>
  <div class="row p-3">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <h5>¡Cualquier consulta que tengas, no dudes en escribirnos!</h5>
      <br>
      <h6><i class="bi bi-shop"></i> Anime Store</h6>
      <h6><i class="bi bi-geo-alt"> </i> Santa Fé 1025</h6>
      <h6><i class="bi bi-telephone"></i> 3794336765</h6>
      <h6><i class="bi bi-envelope"></i> anime.store@gmail.com</h6>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 border border-start p-3">
      <form class="form-floating" method="POST" action="<?php echo base_url(); ?>consultas/store">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
          <?php if(session()->get('email')) : ?>
          <input name="email" type="email" class="form-control" required id="exampleInputEmail1" value="<?= session()->get('email')?>" placeholder="Ingrese su correo electronico" aria-describedby="emailHelp">
          <?php  else :?>
            <input name="email" type="email" class="form-control" required id="exampleInputEmail1"  placeholder="Ingrese su correo electronico" aria-describedby="emailHelp">
        <?php endif?>
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Nombre</label>
          <?php if(session()->get('nombre')) : ?>
          <input  name="nombre" type="text" class="form-control"  required ="exampleInputEmail1" value="<?= session()->get('nombre')?>" placeholder="Ingrese su nombre" aria-describedby="emailHelp">
          <?php  else :?>
          <input  name="nombre" type="text" class="form-control" required id="exampleInputEmail1"  placeholder="Ingrese su nombre" aria-describedby="emailHelp">
          <?php endif?>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Consulta</label>
          <textarea  name="consulta" class="form-control" required placeholder="Ingrese su consulta" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit"   name="enviar" class="btn btn-info btn-enviar" id="enviar">Enviar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d221.2493284671741!2d-58.83066427885097!3d-27.469593864659554!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca05dbce5c7%3A0x73c9c0df4bf3ce41!2sSta.%20F%C3%A9%201025%2C%20W3400CHO%20Corrientes!5e0!3m2!1ses-419!2sar!4v1682306085428!5m2!1ses-419!2sar" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>
  <?= $this->endSection() ?>