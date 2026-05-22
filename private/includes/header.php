<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($tituloPagina) ? sanitizar($tituloPagina) . ' | ' : '' ?><?= APP_NAME ?></title>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet"
          href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">

    <!-- CSS partilhado da área privada -->
    <link rel="stylesheet"
          href="<?= APP_BASE ?>/private/assets/css/private.css">
</head>
<body>
<div class="layout">
