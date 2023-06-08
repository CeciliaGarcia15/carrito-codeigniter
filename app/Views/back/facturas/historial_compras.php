<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <h4>
        <i class="bi bi-arrow-left-circle-fill"></i>
        <a href="<?php echo base_url(); ?>" class="link-light">Tienda</a>
    </h4>
    <h1 class="text-center mb-5"><?= $title ?></h1>

                <?php $total = 0;
                foreach ($facturas as $factura) :
                ?>
                <div class="card border-light mb-3" style="margin-bottom:10px; background-color: #1c1f1e;">
                    <div class="card-header border-light">
                     <?=date("d/m/Y H:i:s", strtotime($factura['fecha_compra'])) ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Factura N° <?= $factura['id']?></h5>
                        <a href="<?php echo base_url(); ?>factura/ver/<?=$factura['id'] ?>" class="btn btn-info btn-enviar fw-bolder">Ver mas info</a>
                    </div>
                </div>
                <?php endforeach; ?>

</div>

<?= $this->endSection() ?>