<?php
// =====================================================
// MedControl – Detalhes do Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Detalhes do Equipamento';
$paginaAtiva  = 'equipamentos';

if (empty($_GET['id_equipamento'])) {
    header('Location: lista.php');
    exit;
}

$idEquipamento = aes_decrypt($_GET['id_equipamento']);
if ($idEquipamento <= 0) {
    header('Location: lista.php');
    exit;
}

$erro_sistema = '';
$equipamento  = null;
$garantias    = [];
$documentos   = [];

try {
    $pdo = get_pdo();

    $stmt = $pdo->prepare("
        SELECT e.*, cat.nomeCategoria, est.nomeEstado, c.nomeCriticidade, l.nomeLocalizacao
          FROM Equipamento e
          JOIN Categoria   cat ON e.idCategoria   = cat.idCategoria
          JOIN Estado      est ON e.idEstado       = est.idEstado
          JOIN Criticidade c   ON e.idCriticidade  = c.idCriticidade
          JOIN Localizacao l   ON e.idLocalizacao  = l.idLocalizacao
         WHERE e.idEquipamento = :id
    ");
    $stmt->bindParam(':id', $idEquipamento, PDO::PARAM_INT);
    $stmt->execute();
    $equipamento = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$equipamento) {
        header('Location: lista.php');
        exit;
    }

    $stmtG = $pdo->prepare("
        SELECT g.*, DATEDIFF(g.dataFim, CURDATE()) AS diasRestantes,
               f.nomeEmpresa AS nomeFornecedor
          FROM Garantia g
          LEFT JOIN Fornecedor f ON g.idFornecedor = f.idFornecedor
         WHERE g.idEquipamento = :id
         ORDER BY g.dataFim DESC
    ");
    $stmtG->bindParam(':id', $idEquipamento, PDO::PARAM_INT);
    $stmtG->execute();
    $garantias = $stmtG->fetchAll(PDO::FETCH_OBJ);

    $stmtD = $pdo->prepare("
        SELECT * FROM Documento WHERE idEquipamento = :id ORDER BY dataUpload DESC
    ");
    $stmtD->bindParam(':id', $idEquipamento, PDO::PARAM_INT);
    $stmtD->execute();
    $documentos = $stmtD->fetchAll(PDO::FETCH_OBJ);

    $pdo = null;
} catch (PDOException $e) {
    $erro_sistema = $e->getMessage();
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<?php if (!empty($erro_sistema)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($erro_sistema) ?></div>
<?php endif; ?>

<div class="page">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            <i class="fa-solid fa-stethoscope me-2"></i>
            <?= htmlspecialchars($equipamento->designacao ?? '') ?>
            <small class="text-muted fs-6 ms-2"><?= htmlspecialchars($equipamento->codigoEquipamento ?? '') ?></small>
        </h4>
        <div class="d-flex gap-2">
            <a href="editar.php?id_equipamento=<?= aes_encrypt($idEquipamento) ?>" class="btn btn-warning btn-sm">
                <i class="fa-solid fa-pen me-1"></i>Editar
            </a>
            <a href="lista.php" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>

    <!-- Identificação -->
    <div class="content-box mb-3">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-circle-info me-1"></i>Identificação
        </h6>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Categoria</div>
                <div><?= htmlspecialchars($equipamento->nomeCategoria ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Marca</div>
                <div><?= htmlspecialchars($equipamento->marca ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Modelo</div>
                <div><?= htmlspecialchars($equipamento->modelo ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Número de Série</div>
                <div><?= htmlspecialchars($equipamento->numeroSerie ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Ano de Fabrico</div>
                <div><?= htmlspecialchars($equipamento->anoFabrico ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Localização</div>
                <div><?= htmlspecialchars($equipamento->nomeLocalizacao ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Estado</div>
                <div><span class="badge bg-success"><?= htmlspecialchars($equipamento->nomeEstado ?? '—') ?></span></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Criticidade</div>
                <div><span class="badge bg-danger"><?= htmlspecialchars($equipamento->nomeCriticidade ?? '—') ?></span></div>
            </div>
            <?php if (!empty($equipamento->observacoes)): ?>
            <div class="col-12">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Observações</div>
                <div><?= htmlspecialchars($equipamento->observacoes) ?></div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Garantias -->
    <div class="content-box mb-3">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-file-contract me-1"></i>Garantias
        </h6>
        <?php if (empty($garantias)): ?>
        <p class="text-muted small">Sem garantias registadas.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>Tipo</th><th>Início</th><th>Fim</th><th>Fornecedor</th><th>Estado</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($garantias as $g):
                        $dias = (int)$g->diasRestantes;
                        if ($dias < 0)       $badge = '<span class="badge bg-danger">Expirada</span>';
                        elseif ($dias <= 30) $badge = '<span class="badge bg-warning text-dark">Expira em ' . $dias . ' dias</span>';
                        else                 $badge = '<span class="badge bg-success">Ativa (' . $dias . ' dias)</span>';
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($g->tipoGarantia ?? '—') ?></td>
                        <td><?= date('d/m/Y', strtotime($g->dataInicio)) ?></td>
                        <td><?= date('d/m/Y', strtotime($g->dataFim)) ?></td>
                        <td><?= htmlspecialchars($g->nomeFornecedor ?? '—') ?></td>
                        <td><?= $badge ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

    <!-- Documentos -->
    <div class="content-box">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-file-pdf me-1"></i>Documentação
        </h6>
        <?php if (empty($documentos)): ?>
        <p class="text-muted small">Sem documentos registados.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered">
                <thead class="table-dark">
                    <tr><th>Nome</th><th>Tipo</th><th>Data Upload</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($documentos as $doc): ?>
                    <tr>
                        <td>
                            <i class="fa-solid fa-file-pdf text-danger me-1"></i>
                            <?= htmlspecialchars($doc->nomeDocumento) ?>
                        </td>
                        <td><?= htmlspecialchars(ucfirst(strtolower($doc->tipoDocumento ?? ''))) ?></td>
                        <td><?= date('d/m/Y', strtotime($doc->dataUpload)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</div><!-- /page -->

<?php $scriptsExtra = ''; ?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
