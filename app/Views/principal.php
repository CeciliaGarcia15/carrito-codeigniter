<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container"> <?php
    /* var_dump(session()->get());
    die(); */
      if(isset($mensaje)){ ?>
          <div class="alert alert-success mess-alert" role="alert">
            <?php echo($mensaje); ?>
          </div>
      <?php }
    ?>
    
   
    <div id="carouselExampleInterval" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <a href="#">
                    <img src="<?php echo base_url(); ?>img/series/kimetsu.png" id="carousel_principal" class="d-block w-100  img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <?php if (session()->get('usuario')) : ?>
                        <button class="btn btn-info btn-enviar btn-lg text-uppercase fw-bolder" >
                                <i class="bi bi-plus"></i>
                                Ver más</button>
                    
                    <?php endif; ?>
                    </div>
                </a>
            </div>

            <div class="carousel-item">
                <a href="#">
                    <img src="<?php echo base_url(); ?>img/series/boruto.png" id="carousel_principal" class="d-block  img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <?php if (session()->get('usuario')) : ?>
                        <button class="btn btn-info btn-enviar btn-lg text-uppercase fw-bolder" >
                                <i class="bi bi-plus"></i>
                                Ver más</button>
                    
                    <?php endif; ?>
                    </div>
                </a>
            </div>
            <div class="carousel-item">
                <a href="#">
                    <img src="<?php echo base_url(); ?>img/series/fairy_tail.png" id="carousel_principal" class="d-block  img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <?php if (session()->get('usuario')) : ?>
                        <button class="btn btn-info btn-enviar btn-lg text-uppercase fw-bolder" >
                                <i class="bi bi-plus"></i>
                                Ver más</button>
                    
                    <?php endif; ?>
                    </div>
                </a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="row p-4 my-2 text-center rounded-3" >
        <h1 class="display-5 fw-bolder">Anime Store</h1>
        <p class="col-md-12 lead">
            Es una tienda con más de 10 años de experiencia en la comercialización de productos con tematica de manga y anime. Ofrecemos una amplia variedad de productos de alta calidad a precios asequibles, como figuras, camisetas, articulos de cosplay y mangas. Participamos en eventos y actividades relacionados con el anime y ofrecemos recomendaciones personalizadas. Únete a nuestra comunidad de fans del anime para una experiencia única y satisfactoria.
        </p>
    </div>

    <div class="row  my-5 pb-5 text-center">
        <?php foreach ($products as $product) : ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-2 ">
                <div class="card text-center bg-transparent">
                    <img src="<?php echo base_url(); ?>img/productos/<?= $product['imagen'];?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-start text-capitalize"><?= $product['producto'];?></h5>
                        <h6 class="text-start fw-bolder">$<?= $product['precio'];?></h6>
                        <p class="text-start fw-bolder">Stock:<?= $product['cantidad'];?> </p>
                        <?php if (session()->get('usuario')) : ?>
                        <a href="<?php echo base_url(); ?>carrito/agregar/<?= $product['id'];?>" class="btn btn-info btn-enviar fw-bolder ">
                                <i class="bi bi-cart-plus"></i>
                                Comprar
                            </a> 
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        
    </div>
    <?= $this->endSection() ?>