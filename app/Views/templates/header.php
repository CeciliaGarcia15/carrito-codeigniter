<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0cc7ba;">
  <div class="container-fluid">
    <a class="navbar-brand nav-link text-uppercase fw-bolder" href="<?php echo base_url(); ?>">
      <img src="<?php echo base_url(); ?>img/Black & White Minimalist Aesthetic Initials Font Logo2.png" alt="" width="30" height="24">
      Anime store
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav justify-content-center mx-auto mb-2 mb-lg-0">

        <?php if (session()->get('admin')) : ?>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">categorias</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">mensajes</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-capitalize fw-bolder" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= session()->get('admin') ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item text-capitalize" href="<?php echo base_url(); ?>logout">Cerrar sesión</a></li>
            </ul>
          </li>
        <?php elseif (session()->get('usuario')) : ?>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">quienes somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>comercializacion">comercialización</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>contacto">contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>terminos">terminos y usos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-capitalize fw-bolder" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= session()->get('usuario') ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item text-capitalize" href="#">historial de compras</a></li>
              <li><a class="dropdown-item text-capitalize" href="<?php echo base_url(); ?>logout">Cerrar sesión</a></li>
            </ul>
          </li>
          <li class="nav-item position-relative">
            <a href="<?php echo base_url(); ?>carrito" class="nav-link text-capitalize fw-bolder">
              <div class="d-inline-block">
                <i class="bi bi-cart3 custom-icon"></i>
                <span class="badge badge-danger custom-badge">3</span>
              </div>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bold" href="<?php echo base_url(); ?>quienes_somos">quienes somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>comercializacion">comercialización</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>contacto">contacto</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>terminos">terminos y usos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-capitalize fw-bolder" href="<?php echo base_url(); ?>login">Ingresar</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>