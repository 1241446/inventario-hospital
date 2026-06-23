<?php require_once __DIR__ . '/../../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($tituloPagina) ? sanitizar($tituloPagina) . ' | ' : '' ?><?= APP_NAME ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= APP_BASE ?>/assets/favicon.svg">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">

    <!-- CSS personalizado da área privada -->
    <link rel="stylesheet" href="<?= APP_BASE ?>/private/assets/css/private.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/datatables/css/dataTables.min.css">

    <!-- CSS do Flatpickr -->
    <link rel="stylesheet" href="<?= APP_BASE ?>/private/assets/flatpickr/flatpickr.min.css">

    <!-- JS do Flatpickr -->
    <script src="<?= APP_BASE ?>/private/assets/flatpickr/flatpickr.js"></script>
</head>
<body>
