<?php
// =====================================================
// MedControl – Lista de Fornecedores
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Fornecedores';
$paginaAtiva  = 'fornecedores';

try {
    $pdo = get_pdo();

    $stmt = $pdo->query("
        SELECT f.idFornecedor, f.nomeEmpresa, f.nif, f.tipoFornecedor,
               f.emailContacto, f.telefoneContacto,
               COUNT(ef.idEquipamento) AS totalEquipamentos
          FROM Fornecedor f
          LEFT JOIN EquipamentoFornecedor ef ON f.idFornecedor = ef.idFornecedor
         GROUP BY f.idFornecedor
         ORDER BY f.nomeEmpresa
    ");
    $fornecedores = $stmt->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
} catch (PDOException $e) {
    $dbErro      = $e->getMessage();
    $fornecedores = [];
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<?php if (!empty($dbErro)): ?>
<div class="alert alert-danger">
    <i class="fa-solid fa-triangle-exclamation me-2"></i>
    Erro na ligação à base de dados: <?= htmlspecialchars($dbErro) ?>
</div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa-solid fa-truck-medical me-2"></i>Fornecedores</h4>
    <a href="<?= APP_BASE ?>/private/views/fornecedores/novo.php" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-1"></i>Novo Fornecedor
    </a>
</div>

<div class="table-responsive">
    <table id="tabelaFornecedores" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>NIF</th>
                <th>Tipo</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Equipamentos</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fornecedores as $forn): ?>
            <tr>
                <td><?= htmlspecialchars($forn->nomeEmpresa) ?></td>
                <td><?= htmlspecialchars($forn->nif) ?></td>
                <td><span class="badge bg-primary"><?= htmlspecialchars(ucfirst(strtolower($forn->tipoFornecedor))) ?></span></td>
                <td><?= htmlspecialchars($forn->emailContacto) ?></td>
                <td><?= htmlspecialchars($forn->telefoneContacto ?? '—') ?></td>
                <td><?= (int)$forn->totalEquipamentos ?></td>
                <td>
                    <a href="<?= APP_BASE ?>/private/views/fornecedores/detalhes.php?id=<?= (int)$forn->idFornecedor ?>"
                       class="btn btn-sm btn-info" title="Ver detalhes">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$scriptsExtra = '
<script>
$(document).ready(function() {
    $("#tabelaFornecedores").DataTable({
        pageLength: 10,
        language: {
            url: "' . APP_BASE . '/private/assets/js/datatables-pt.json"
        }
    });
});
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
