<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <div class="card bg-transparent">
                    <div class="card-header">
                        <h3 class="text-center">Falta de Autorización</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-center">No tienes autorización para acceder a esta página.</p>
                        <div class="text-center">
                            <a class="btn btn-info" href="<?php echo base_url(); ?>">Ir a la Página Principal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>