<?php
// Variável opcional definida em cada página para marcar o item ativo.
// Ex.: $paginaAtiva = 'equipamentos';
$_ativa = $paginaAtiva ?? '';

/**
 * Devolve a classe "active" se a secção da sidebar coincidir com a página ativa.
 */
function sidebarAtiva(string $secao, string $ativa): string
{
    return $secao === $ativa ? ' active' : '';
}

// Dados do utilizador autenticado (podem vir da sessão)
$_u     = utilizadorSessao();
$_nome  = $_u['nomeCompleto'] ?? 'Utilizador';
$_tipo  = $_u['tipoUtilizador'] ?? '';
$_ini   = strtoupper(mb_substr($_nome, 0, 1));
?>

    <!-- ─── SIDEBAR ─── -->
    <aside class="sidebar">

        <a href="<?= APP_BASE ?>/private/home.php" class="sidebar-brand">
            <div class="brand-icon"><i class="fa-solid fa-hospital-user"></i></div>
            Med<span>Control</span>
        </a>

        <p class="sidebar-section">Principal</p>
        <ul class="sidebar-nav">
            <li>
                <a href="<?= APP_BASE ?>/private/home.php"
                   class="<?= sidebarAtiva('dashboard', $_ativa) ?>">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
            </li>
        </ul>

        <p class="sidebar-section">Inventário</p>
        <ul class="sidebar-nav">
            <li>
                <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php"
                   class="<?= sidebarAtiva('equipamentos', $_ativa) ?>">
                    <i class="fa-solid fa-stethoscope"></i> Equipamentos
                </a>
            </li>
            <li>
                <a href="<?= APP_BASE ?>/private/views/localizacoes/lista.php"
                   class="<?= sidebarAtiva('localizacoes', $_ativa) ?>">
                    <i class="fa-solid fa-map-location-dot"></i> Localizações
                </a>
            </li>
            <li>
                <a href="<?= APP_BASE ?>/private/views/fornecedores/lista.php"
                   class="<?= sidebarAtiva('fornecedores', $_ativa) ?>">
                    <i class="fa-solid fa-truck-medical"></i> Fornecedores
                </a>
            </li>
        </ul>

        <p class="sidebar-section">Documentação</p>
        <ul class="sidebar-nav">
            <li>
                <a href="<?= APP_BASE ?>/private/views/documentos/lista.php"
                   class="<?= sidebarAtiva('documentos', $_ativa) ?>">
                    <i class="fa-solid fa-file-pdf"></i> Documentos
                </a>
            </li>
            <li>
                <a href="<?= APP_BASE ?>/private/views/garantias/lista.php"
                   class="<?= sidebarAtiva('garantias', $_ativa) ?>">
                    <i class="fa-solid fa-file-contract"></i> Garantias
                </a>
            </li>
            <li>
                <a href="<?= APP_BASE ?>/private/views/conteudos/gestao.php"
                   class="<?= sidebarAtiva('conteudos', $_ativa) ?>">
                    <i class="fa-solid fa-newspaper"></i> Conteúdos
                </a>
            </li>
        </ul>

        <!-- Utilizador autenticado -->
        <div class="sidebar-user">
            <div class="avatar"><?= sanitizar($_ini) ?></div>
            <div class="sidebar-user-info">
                <p><?= sanitizar($_nome) ?></p>
                <span><?= sanitizar($_tipo) ?></span>
            </div>
            <form method="POST"
                  action="<?= APP_BASE ?>/public/logout.php"
                  style="margin:0;">
                <button type="submit" class="btn-logout" title="Terminar sessão">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>

    </aside>

    <!-- ─── CONTEÚDO PRINCIPAL ─── -->
    <div class="main">
