<?php
// Variáveis esperadas (definidas na página antes do include):
// $topbarTitulo   – conteúdo do <h1> (pode incluir ícone HTML)
// $topbarSubtitulo – parágrafo de subtítulo (opcional)
// $topbarAcao     – HTML dos botões/ações à direita (opcional)
?>
<header class="topbar">
    <div class="topbar-left">
        <h1><?= $topbarTitulo ?? $tituloPagina ?? '' ?></h1>
        <?php if (!empty($topbarSubtitulo)): ?>
            <p><?= $topbarSubtitulo ?></p>
        <?php endif; ?>
    </div>
    <?php if (!empty($topbarAcao)): ?>
    <div class="topbar-right">
        <?= $topbarAcao ?>
    </div>
    <?php endif; ?>
</header>
