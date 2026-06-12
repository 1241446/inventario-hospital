<?php
$_ativa  = $paginaAtiva ?? '';
$_perfil = $_SESSION['sessao']['tipoUtilizador'] ?? '';

if (!function_exists('sidebarAtiva')) {
    function sidebarAtiva(string $secao, string $ativa): string {
        return $secao === $ativa ? ' active fw-bold' : '';
    }
}
?>
<!-- ─── SIDEBAR ─── -->
<aside class="col-md-3 col-lg-2 bg-secondary text-white p-3 min-vh-100">

    <a href="<?= APP_BASE ?>/private/home.php"
       class="d-flex align-items-center gap-2 text-white text-decoration-none mb-3">
        <i class="fa-solid fa-hospital-user" style="color:#4fc3f7;font-size:1.3em;"></i>
        <strong>Med<span style="color:#4fc3f7;">Control</span></strong>
    </a>

    <p class="text-uppercase text-white-50 small mb-1">Principal</p>
    <nav class="d-flex flex-column mb-2">
        <a href="<?= APP_BASE ?>/private/home.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('dashboard', $_ativa) ?>">
            <i class="fa-solid fa-gauge me-2"></i>Dashboard
        </a>
    </nav>

    <p class="text-uppercase text-white-50 small mb-1">Inventário</p>
    <nav class="d-flex flex-column mb-2">
        <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('equipamentos', $_ativa) ?>">
            <i class="fa-solid fa-stethoscope me-2"></i>Equipamentos
        </a>
        <?php if (in_array($_perfil, ['ADMINISTRADOR', 'GESTOR', 'TECNICO'])): ?>
        <a href="<?= APP_BASE ?>/private/views/localizacoes/lista.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('localizacoes', $_ativa) ?>">
            <i class="fa-solid fa-map-location-dot me-2"></i>Localizações
        </a>
        <?php endif; ?>
        <?php if (in_array($_perfil, ['ADMINISTRADOR', 'GESTOR'])): ?>
        <a href="<?= APP_BASE ?>/private/views/fornecedores/lista.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('fornecedores', $_ativa) ?>">
            <i class="fa-solid fa-truck-medical me-2"></i>Fornecedores
        </a>
        <?php endif; ?>
    </nav>

    <p class="text-uppercase text-white-50 small mb-1">Documentação</p>
    <nav class="d-flex flex-column">
        <a href="<?= APP_BASE ?>/private/views/documentos/lista.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('documentos', $_ativa) ?>">
            <i class="fa-solid fa-file-pdf me-2"></i>Documentos
        </a>
        <a href="<?= APP_BASE ?>/private/views/garantias/lista.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('garantias', $_ativa) ?>">
            <i class="fa-solid fa-file-contract me-2"></i>Garantias
        </a>
        <?php if (in_array($_perfil, ['ADMINISTRADOR', 'GESTOR'])): ?>
        <a href="<?= APP_BASE ?>/private/views/conteudos/gestao.php"
           class="nav-link text-white px-2 py-1 rounded<?= sidebarAtiva('conteudos', $_ativa) ?>">
            <i class="fa-solid fa-newspaper me-2"></i>Conteúdos
        </a>
        <?php endif; ?>
    </nav>

    <?php if ($_perfil): ?>
    <div class="mt-4 pt-3 border-top border-secondary">
        <div class="text-white-50 small mb-1">
            <i class="fa-solid fa-user-circle me-1"></i>
            <?= htmlspecialchars($_SESSION['sessao']['nomeUtilizador'] ?? '') ?>
        </div>
        <div class="badge bg-primary mb-3"><?= htmlspecialchars($_perfil) ?></div>
        <a href="<?= APP_BASE ?>/public/logout.php"
           class="btn btn-outline-light btn-sm w-100">
            <i class="fa-solid fa-right-from-bracket me-1"></i>Sair
        </a>
    </div>
    <?php endif; ?>

</aside>
