<?php
// =====================================================
// MedControl – Confirmar Desativação de Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();
verificarPerfil(['ADMINISTRADOR', 'GESTOR', 'TECNICO']);

$tituloPagina = 'Desativar Equipamento';
$paginaAtiva  = 'equipamentos';

$idEncrypted = $_GET['id_equipamento'] ?? null;
$id          = aes_decrypt($idEncrypted);

if (!$id || !is_numeric($id) || $id <= 0) {
    header('Location: lista.php');
    exit;
}

$equipamento  = null;
$erro_sistema = '';

try {
    $pdo  = get_pdo();
    $stmt = $pdo->prepare("SELECT idEquipamento, codigoEquipamento, designacao, marca, modelo FROM Equipamento WHERE idEquipamento = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $equipamento = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$equipamento) {
        header('Location: lista.php');
        exit;
    }
} catch (PDOException $e) {
    $erro_sistema = 'Erro: ' . $e->getMessage();
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<?php if ($erro_sistema): ?>
<div class="alert alert-danger"><?= htmlspecialchars($erro_sistema) ?></div>
<?php else: ?>

<div class="d-flex justify-content-center align-items-center" style="min-height:60vh;">
    <div class="card shadow text-center" style="max-width:420px;width:100%;">
        <div class="card-body p-4">
            <i class="fa-solid fa-triangle-exclamation fa-3x text-warning mb-3"></i>
            <p class="text-muted mb-2">Deseja desativar o equipamento?</p>
            <h4 class="mb-1 fw-bold"><?= htmlspecialchars($equipamento->codigoEquipamento) ?> — <?= htmlspecialchars($equipamento->designacao) ?></h4>
            <p class="text-muted small mb-4"><?= htmlspecialchars($equipamento->marca . ' ' . $equipamento->modelo) ?></p>
            <div class="alert alert-warning py-2 small">
                O equipamento ficará com estado <strong>Abatido</strong> mas permanecerá na base de dados.
            </div>
            <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="lista.php" class="btn btn-secondary px-4">
                    <i class="fa-solid fa-xmark me-2"></i>Não
                </a>
                <a href="confirmar_apagar.php?id_equipamento=<?= urlencode($idEncrypted) ?>" class="btn btn-danger px-4">
                    <i class="fa-solid fa-check me-2"></i>Sim
                </a>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>

<?php $scriptsExtra = ''; ?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
