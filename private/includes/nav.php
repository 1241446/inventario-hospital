<?php
$_u       = function_exists('utilizadorSessao') ? utilizadorSessao() : [];
$_nomeNav = function_exists('sanitizar') ? sanitizar($_u['nomeCompleto'] ?? 'Utilizador') : ($_u['nomeCompleto'] ?? 'Utilizador');
?>
<!-- ─── NAVBAR ─── -->
<header class="bg-dark text-white">
    <div class="container-fluid">
        <div class="row align-items-center py-2 px-3">
            <div class="col-6 d-flex align-items-center gap-3">
                <i class="fa-solid fa-hospital-user" style="color:#4fc3f7;font-size:1.5em;"></i>
                <h3 class="mb-0 fw-bold"><?= APP_NAME ?></h3>
            </div>
            <div class="col-6 text-end">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-user me-2"></i><?= $_nomeNav ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa-solid fa-key me-2"></i>Alterar password
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="<?= APP_BASE ?>/public/logout.php" style="margin:0;">
                                <button type="submit" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
