<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once('templates/head.php') ?>
</head>

<body>
    <?php require_once('templates/header.php') ?>
    <?= $this->renderSection('content') ?>
    <?php require_once('templates/footer.php') ?>

    <?php require_once('templates/scripts.php') ?>
</body>

</html>