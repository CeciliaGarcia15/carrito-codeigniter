<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container mt-2 comerc-container" style="margin-bottom: 90px;">
    <div class="row">
    <h1 class="text-center">Comercialización</h1>
    </div>
    
    <div class="row">
        <div class="col">
            <h5><i class="bi bi-credit-card"></i> Formas de pago:</h5>
            <h6>Aceptamos todos los medios de pago</h6>
            <img src="<?php echo base_url(); ?>img/cards_ships/visa@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/mastercard@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/amex@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/argencard@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/banelco@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/cabal@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/tarjeta-naranja@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/tarjeta-shopping@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/mercadopago@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/pagofacil@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/rapipago@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/paypal@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <h5><i class="bi bi-truck"></i> Formas de envío:</h5>
            <h6>Envios a todo el pais mediante </h6>
            <img src="<?php echo base_url(); ?>img/cards_ships/correo-argentino@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <img src="<?php echo base_url(); ?>img/cards_ships/oca@2x.png" alt="" class="img-fluid" style="width:auto;height: 30px;">
            <br><br>
            <li>
            Envío estándar: El paquete es enviado por Correo Argentino u OCA y llega en un tiempo determinado, dependiendo de la zona y la empresa de envíos utilizada.
            </li>
            <li>Envío express: El paquete es enviado por Correo Argentino u OCA  pero utilizando el servicio de envío rápido, que tiene un costo superior al del envio estandar y generalmente llega en un plazo de 1-2 días hábiles.
            </li>
        </div>
    </div>

    <br>
    <div class="row">
        
        <h5><i class="bi bi-box2"></i> Tipos de entregas:</h5>
        <li>Entrega a domicilio: El paquete es enviado directamente al domicilio del comprador. </li>
        <li>Recogida en tienda: El comprador puede recoger el paquete en el Anime Store mas cercano a su domicilio. (Presione <a class="link-info" href="<?php echo base_url(); ?>contacto">aqui</a>  para ver donde nos encontramos).</li>
    </div>
</div>

<?= $this->endSection() ?>