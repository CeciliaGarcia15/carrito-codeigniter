<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container mt-3">
    <div class="row mb-3">
        <div class="col-4">
            <form class="input-group">
                <input type="text" class="form-control" placeholder="Ingrese el email a buscar">
                <div class="input-group-append">
                    <button class="btn btn-info" type="button">Buscar</button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <a href="">
                <span class="badge" style="background-color:red;">Ver inactivos</span>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table" style="color:white;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre y Apellido</th>
                    <th>Email</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th><?= $user['id'] ?></th>
                        <td><?= ucfirst($user['nombre']) . ' ' . ucfirst($user['apellido']) ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['usuario'] ?></td>
                        <td><?php if ($user['baja'] == 'NO') : ?>
                                <span class="badge" style="background-color:green;">Activo</span>
                            <?php else : ?>
                                <span class="badge" style="background-color: red;">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="" class="btn btn-warning">Modificar</a>
                            <a href="" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>