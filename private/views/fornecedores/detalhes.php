<?php
// =====================================================
// MedControl – Detalhes do Fornecedor
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();
verificarPerfil(['ADMINISTRADOR', 'GESTOR']);

$tituloPagina = 'Detalhes do Fornecedor';
$paginaAtiva  = 'fornecedores';

if (empty($_GET['id'])) {
    header('Location: lista.php');
    exit;
}

$idFornecedor = (int)$_GET['id'];
$erro_sistema = '';
$fornecedor   = null;
$equipamentos = [];

try {
    $pdo = get_pdo();

    $stmt = $pdo->prepare("
        SELECT f.*, p.nomePais
          FROM Fornecedor f
          LEFT JOIN Pais p ON f.idPais = p.idPais
         WHERE f.idFornecedor = :id
    ");
    $stmt->bindParam(':id', $idFornecedor, PDO::PARAM_INT);
    $stmt->execute();
    $fornecedor = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$fornecedor) {
        header('Location: lista.php');
        exit;
    }

    $stmtEq = $pdo->prepare("
        SELECT e.codigoEquipamento, e.designacao, est.nomeEstado, l.nomeLocalizacao
          FROM EquipamentoFornecedor ef
          JOIN Equipamento e   ON ef.idEquipamento = e.idEquipamento
          JOIN Estado est      ON e.idEstado        = est.idEstado
          JOIN Localizacao l   ON e.idLocalizacao   = l.idLocalizacao
         WHERE ef.idFornecedor = :id
         ORDER BY e.codigoEquipamento
    ");
    $stmtEq->bindParam(':id', $idFornecedor, PDO::PARAM_INT);
    $stmtEq->execute();
    $equipamentos = $stmtEq->fetchAll(PDO::FETCH_OBJ);

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
        <h4 class="mb-0"><i class="fa-solid fa-truck-medical me-2"></i><?= htmlspecialchars($fornecedor->nomeEmpresa ?? '') ?></h4>
        <a href="lista.php" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <!-- Informações Gerais -->
    <div class="content-box mb-3">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-building me-1"></i>Informações Gerais
        </h6>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">NIF</div>
                <div><?= htmlspecialchars($fornecedor->nif ?? '—') ?></div>
            </div>
            <div class="col-md-4">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Tipo</div>
                <div><span class="badge bg-primary"><?= htmlspecialchars(ucfirst(strtolower($fornecedor->tipoFornecedor ?? ''))) ?></span></div>
            </div>
            <div class="col-md-4">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">País</div>
                <div><?= htmlspecialchars($fornecedor->nomePais ?? '—') ?></div>
            </div>
            <div class="col-md-4">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Website</div>
                <div><?= htmlspecialchars($fornecedor->website ?? '—') ?></div>
            </div>
            <div class="col-md-8">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Morada</div>
                <div><?= htmlspecialchars($fornecedor->morada ?? '—') ?></div>
            </div>
        </div>
    </div>

    <!-- Contacto -->
    <div class="content-box mb-3">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-address-card me-1"></i>Contacto Principal
        </h6>
        <div class="row g-3">
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Nome</div>
                <div><?= htmlspecialchars($fornecedor->nomeContacto ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Cargo</div>
                <div><?= htmlspecialchars($fornecedor->cargoContacto ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Telefone</div>
                <div><?= htmlspecialchars($fornecedor->telefoneContacto ?? '—') ?></div>
            </div>
            <div class="col-md-3">
                <div class="small text-muted fw-bold text-uppercase" style="font-size:0.72em;">Email</div>
                <div><?= htmlspecialchars($fornecedor->emailContacto ?? '—') ?></div>
            </div>
        </div>
    </div>

    <!-- Equipamentos Associados -->
    <div class="content-box">
        <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:0.78em;letter-spacing:.05em;">
            <i class="fa-solid fa-stethoscope me-1"></i>Equipamentos Associados
        </h6>
        <?php if (empty($equipamentos)): ?>
        <p class="text-muted small">Nenhum equipamento associado a este fornecedor.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Designação</th>
                        <th>Estado</th>
                        <th>Localização</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipamentos as $eq): ?>
                    <tr>
                        <td><?= htmlspecialchars($eq->codigoEquipamento) ?></td>
                        <td><?= htmlspecialchars($eq->designacao) ?></td>
                        <td><?= htmlspecialchars($eq->nomeEstado) ?></td>
                        <td><?= htmlspecialchars($eq->nomeLocalizacao) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>

</div><!-- /page -->

<?php
$scriptsExtra = '';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
