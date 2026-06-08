<?php
// --------------------------------------------------------------------
// VERIFICAÇÃO DE SESSÃO
// --------------------------------------------------------------------
// Verifica se a sessão ainda não foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão
}

// Verifica se o utilizador está autenticado
if (!isset($_SESSION['utilizador'])) {
    // Se não estiver autenticado, redireciona para o formulário de login
    header('Location: ' . APP_BASE . '/public/login.php');
    exit; // Encerra o script
}

// A partir daqui, o utilizador está autenticado
// Podemos usar livremente os dados da sessão
$nome    = $_SESSION['utilizador'];
$_titulo = isset($tituloPagina) ? htmlspecialchars($tituloPagina) : APP_NAME;
?>
<!-- ─── NAVBAR ─── -->
<header class="bg-dark text-white">
    <div class="container-fluid">
        <div class="row align-items-center py-2 px-3">
            <div class="col-6 d-flex align-items-center gap-3">
                <i class="fa-solid fa-hospital-user" style="color:#4fc3f7;font-size:1.5em;"></i>
                <div>
                    <h3 class="mb-0 fw-bold lh-1"><?= APP_NAME ?></h3>
                    <small class="text-white-50"><?= $_titulo ?></small>
                </div>
            </div>
            <div class="col-6 text-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user me-2"></i><?= htmlspecialchars($nome) ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-key me-2"></i>Alterar password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="<?= APP_BASE ?>/public/logout.php">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
