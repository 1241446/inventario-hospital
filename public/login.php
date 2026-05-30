<?php
// =====================================================
// MedControl - Página de Login
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';
require_once __DIR__ . '/../private/includes/sessao.php';

start_session();

// Se já estiver autenticado, redireciona para o dashboard
if (check_session()) {
    redirecionar(APP_URL . '/private/home.php');
}

// --------------------------------------------------------------------
// RECOLHA DE MENSAGENS TEMPORÁRIAS DA SESSÃO
// --------------------------------------------------------------------
$validation_errors = [];
if (!empty($_SESSION['validation_errors'])) {
    $validation_errors = $_SESSION['validation_errors'];
    unset($_SESSION['validation_errors']);
}

$server_error = '';
if (!empty($_SESSION['server_error'])) {
    $server_error = $_SESSION['server_error'];
    unset($_SESSION['server_error']);
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/1241446.css">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="text-center mb-4">
                <i class="fa-solid fa-hospital-user fa-3x" style="color:#1565c0;"></i>
                <h2 class="mt-2 fw-bold" style="color:#0a2540;">Med<span style="color:#1565c0;"><?= APP_NAME ?></span></h2>
                <p class="text-muted small">Sistema de Gestão de Inventário Hospitalar</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h5 class="card-title mb-4 text-center">Acesso à Área Reservada</h5>

                    <!-- APRESENTAÇÃO DE MENSAGENS DE ERRO -->
                    <?php if (!empty($validation_errors)) : ?>
                        <div class="alert alert-danger p-2 text-center">
                            <?php foreach ($validation_errors as $error) : ?>
                                <div><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($server_error)) : ?>
                        <div class="alert alert-danger p-2 text-center">
                            <div><?= htmlspecialchars($server_error) ?></div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="../private/processa_login.php" novalidate>

                        <div class="mb-3">
                            <label for="text_username" class="form-label fw-semibold">
                                <i class="fa-solid fa-user me-1"></i> Utilizador
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="text_username"
                                name="text_username"
                                placeholder="Nome de utilizador"
                                required
                                autofocus
                            >
                        </div>

                        <div class="mb-4">
                            <label for="text_password" class="form-label fw-semibold">
                                <i class="fa-solid fa-lock me-1"></i> Password
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="text_password"
                                name="text_password"
                                placeholder="Password"
                                required
                            >
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-3">
                <a href="index.php" class="text-decoration-none">
                    <i class="fa-solid fa-arrow-left me-1"></i>Voltar ao site
                </a>
            </p>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
