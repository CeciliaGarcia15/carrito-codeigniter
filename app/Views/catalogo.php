<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container"> 

    <div class="row mt-5">
        <form class="input-group" method="POST" action="<?php echo base_url(); ?>productos/search/catalogo">
            <input type="text" class="form-control form-control-lg" name="search" placeholder="Buscar por productos">
            <div class="input-group-append">
                <button class="btn btn-info btn-lg" type="submit">Buscar</button>
            </div>
        </form>
    </div>
    <div class="row  my-5 pb-5">
        <div class="col-md-3">
            <h4 class="text-center">Filtros</h4>
            <h5>Categorias</h5>
                <select id="categoria" name="categoria" class="form-select">
                    <?php foreach ($categorias as $categoria) : ?>
                    <option class="text-capitalize" value="<?= $categoria['id']; ?>" <?= (old('categoria') == $categoria['id']) ? 'selected' : ''; ?>>
                        <?= $categoria['categoria']; ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            <h5>Series</h5>
                <select id="serie" name="serie" class="form-select">
                <?php foreach ($series as $serie) : ?>
                <option class="text-capitalize" value="<?= $serie['id']; ?>" <?= (old('serie') == $serie['id']) ? 'selected' : ''; ?>>
                    <?= $serie['serie']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-info">Aplicar filtros</button>
        </div>
        <?php foreach ($products as $product) : ?>
            <div class="col-md-3">
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