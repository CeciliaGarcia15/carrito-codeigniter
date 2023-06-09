<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <form class="input-group mb-3" method="POST" action="<?= base_url('productos/search/catalogo') ?>">
            <input type="text" class="form-control form-control-lg" name="search" placeholder="Buscar productos">
            <button class="btn btn-info btn-lg" type="submit">Buscar</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center bg-transparent">
                <div class="card-header">
                    <h5>Filtros</h5>
                </div>
                <div class="card-body">
                    <!-- Agrega aquí tus opciones de filtros -->
                    <div class="mb-3">
                        <label for="category">Categoría</label>
                        <form method="POST" action="<?php echo base_url(); ?>catalogo/filtrar">
                        <select id="categoria" name="categoria" class="form-select">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option class="text-capitalize" value="<?= $categoria['id']; ?>" <?= (old('categoria') == $categoria['id']) ? 'selected' : ''; ?>>
                                    <?= $categoria['categoria']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="price">Series</label>
                        <select id="serie" name="serie" class="form-select">
                            <?php foreach ($series as $serie) : ?>
                                <option class="text-capitalize" value="<?= $serie['id']; ?>" <?= (old('serie') == $serie['id']) ? 'selected' : ''; ?>>
                                    <?= $serie['serie']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-info">Filtrar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">


            <div class="row">
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 text-center bg-transparent">
                            <img src="<?= base_url('img/productos/' . $product['imagen']); ?>" class="card-img-top" alt="Producto">
                            <div class="card-body">
                                <h5 class="card-title text-start text-capitalize"><?= $product['producto']; ?></h5>
                                <h6 class="text-start fw-bolder">$<?= $product['precio']; ?></h6>
                                <p class="text-start fw-bolder">Stock:<?= $product['cantidad']; ?> </p>
                                <?php if (session()->get('usuario')) : ?>
                                    <a href="<?= base_url('carrito/agregar/' . $product['id']); ?>" class="btn btn-info btn-enviar fw-bolder">
                                        <i class="bi bi-cart-plus"></i>
                                        Comprar
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>