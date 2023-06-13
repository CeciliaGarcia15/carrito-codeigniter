<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <h4>
        <i class="bi bi-arrow-left-circle-fill"></i>
        <a href="<?php echo base_url(); ?>/carrito" class="link-light">Carrito</a>
    </h4>
    <h2 class="text-center">Antes de realizar la compra</h2>
    <form  method="POST" action="<?php echo base_url(); ?>envios/store" >
        <div class="row">
            <div class="col-12">
                <h5>Agregar dirección de envio</h5>
                <label for="" class="form-label">Provincia</label>
                <?php if (isset($errors['provincias'])) : ?>
                <br><span class="text-danger"><?= $errors['provincias']; ?></span>
            <?php endif; ?>
                <select class="form-select" name="provincias" id="">
                    <option value="0">Elegir provincia</option>
                    <?php foreach ($provincias as $provincia) : ?>
                        <option value="<?= $provincia['id']; ?>" <?= (old('provincia') == $provincia['id']) ? 'selected' : ''; ?>>
                            <?= $provincia['provincia']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <label class="form-label" for="">Ciudad</label>
                <input  class="form-control" required type="text" name="ciudad" placeholder="Ingrese la ciudad">
                <br>
                <label class="form-label" for="">Dirección</label>
                <input  class="form-control"  required type="text" name="direccion" placeholder="Ingrese la dirección">
                <br>
                <label class="form-label" for="">Codigo Postal</label>
                <input class="form-control" required  type="text" name="codigo" placeholder="Ingrese el codigo postal">
            <br>
                <h5>Forma de pago</h5>
                <select class="form-select" required name="formas_pago" >
                    <option value="Tarjeta de Credito">Tarjeta de Credito</option>
                    <option value="Tarjeta de Debito">Tarjeta de Debito</option>
                    <option value="Mercado Pago">Mercado Pago</option>
                </select>
        </div>
        <br>
        
        <button class="btn btn-success m-2" type="submit">Finalizar compra</button>
        
    </form>
</div>

<?= $this->endSection() ?>