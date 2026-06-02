<?php
// =====================================================
// MedControl – Nova / Editar Localização
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Nova Localização';
$paginaAtiva  = 'localizacoes';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<div class="page">
    <div class="content-box">
        <form id="novaLocalizacaoForm" method="POST" action="">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nome da Localização *</label>
                    <input type="text" name="nomeLocalizacao" required placeholder="Ex: Bloco Operatório B">
                </div>
                <div class="form-group">
                    <label>Piso</label>
                    <input type="number" name="piso" placeholder="Ex: 2">
                </div>
                <div class="form-group">
                    <label>Ala</label>
                    <input type="text" name="ala" placeholder="Ex: Norte">
                </div>
                <div class="form-group full">
                    <label>Descrição</label>
                    <textarea name="descricao" placeholder="Breve descrição da localização..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= APP_BASE ?>/private/views/localizacoes/lista.php" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Guardar Localização
                </button>
            </div>
        </form>
    </div>
</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    document.getElementById("novaLocalizacaoForm").addEventListener("submit", (e) => {
        e.preventDefault();
        showNotification("Localização registada com sucesso!", "success");
        setTimeout(() => { window.location.href = "lista.php"; }, 1500);
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
