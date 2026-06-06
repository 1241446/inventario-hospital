<?php
// =====================================================
// MedControl – Lista de Garantias
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Garantias';
$paginaAtiva  = 'garantias';

try {
    $pdo = get_pdo();

    $garantias = $pdo->query("
        SELECT g.idGarantia, g.tipoGarantia,
               g.dataInicio, g.dataFim,
               DATEDIFF(g.dataFim, CURDATE()) AS diasRestantes,
               e.codigoEquipamento, e.designacao
          FROM Garantia g
          JOIN Equipamento e ON g.idEquipamento = e.idEquipamento
         ORDER BY g.dataFim ASC
    ")->fetchAll(PDO::FETCH_OBJ);

    $totalAtivas    = 0;
    $totalExpirando = 0;
    $totalExpiradas = 0;
    foreach ($garantias as $g) {
        if ($g->diasRestantes < 0)  $totalExpiradas++;
        elseif ($g->diasRestantes <= 30) $totalExpirando++;
        else $totalAtivas++;
    }

    $pdo = null;
} catch (PDOException $e) {
    $dbErro    = $e->getMessage();
    $garantias = [];
    $totalAtivas = $totalExpirando = $totalExpiradas = 0;
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

<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card border-start border-success border-4 shadow-sm">
            <div class="card-body">
                <div class="fw-bold fs-3 text-success"><?= $totalAtivas ?></div>
                <div class="text-muted small">Garantias Ativas</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-start border-warning border-4 shadow-sm">
            <div class="card-body">
                <div class="fw-bold fs-3 text-warning"><?= $totalExpirando ?></div>
                <div class="text-muted small">Vencimento Próximo (30 dias)</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-start border-danger border-4 shadow-sm">
            <div class="card-body">
                <div class="fw-bold fs-3 text-danger"><?= $totalExpiradas ?></div>
                <div class="text-muted small">Garantias Expiradas</div>
            </div>
        </div>
    </div>
</div>

<h4 class="mb-3"><i class="fa-solid fa-file-contract me-2"></i>Lista de Garantias</h4>

<div class="table-responsive">
    <table id="tabelaGarantias" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Equipamento</th>
                <th>Código</th>
                <th>Tipo</th>
                <th>Data Início</th>
                <th>Data Fim</th>
                <th>Estado</th>
                <th>Dias Restantes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($garantias as $g):
                $dias = (int)$g->diasRestantes;
                if ($dias < 0) {
                    $estadoBadge = '<span class="badge bg-danger">Expirada</span>';
                    $diasTexto   = '<strong class="text-danger">EXPIRADA</strong>';
                } elseif ($dias <= 30) {
                    $estadoBadge = '<span class="badge bg-warning text-dark">Vence em breve</span>';
                    $diasTexto   = '<strong class="text-warning">' . $dias . ' dias</strong>';
                } else {
                    $estadoBadge = '<span class="badge bg-success">Ativa</span>';
                    $diasTexto   = '<strong class="text-success">' . $dias . ' dias</strong>';
                }
            ?>
            <?php
                $trClass = '';
                if ($dias < 0) $trClass = 'table-danger';
                elseif ($dias <= 30) $trClass = 'table-warning';
            ?>
            <tr class="<?= $trClass ?>">
                <td><?= htmlspecialchars($g->designacao) ?></td>
                <td><?= htmlspecialchars($g->codigoEquipamento) ?></td>
                <td><?= htmlspecialchars($g->tipoGarantia ?? '—') ?></td>
                <td><?= date('d/m/Y', strtotime($g->dataInicio)) ?></td>
                <td><?= date('d/m/Y', strtotime($g->dataFim)) ?></td>
                <td><?= $estadoBadge ?></td>
                <td><?= $diasTexto ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$scriptsExtra = '
<script>
$(document).ready(function() {
    $("#tabelaGarantias").DataTable({
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
