<?php
// =====================================================
// MedControl – Lista de Equipamentos
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Equipamentos';
$paginaAtiva  = 'equipamentos';

// ─── LIGAÇÃO À BASE DE DADOS (Ficha 11) ─────────────
try {
    $pdo = get_pdo();

    $stmt = $pdo->query("
        SELECT e.idEquipamento,
               e.codigoEquipamento,
               e.designacao,
               e.marca,
               e.modelo,
               est.nomeEstado,
               c.nomeCriticidade,
               l.nomeLocalizacao
          FROM Equipamento e
          JOIN Estado      est ON e.idEstado      = est.idEstado
          JOIN Criticidade c   ON e.idCriticidade = c.idCriticidade
          JOIN Localizacao l   ON e.idLocalizacao = l.idLocalizacao
         ORDER BY e.codigoEquipamento
    ");
    $equipamentos = $stmt->fetchAll(PDO::FETCH_OBJ);

} catch (PDOException $e) {
    $dbErro      = $e->getMessage();
    $equipamentos = [];
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<!-- ─── CONTEÚDO ─── -->

<?php if (!empty($dbErro)): ?>
    <div class="alert alert-danger">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        Erro na ligação à base de dados: <?= htmlspecialchars($dbErro) ?>
    </div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="fa-solid fa-hospital-user me-2"></i>Lista de Equipamentos</h4>
    <a href="<?= APP_BASE ?>/private/views/equipamentos/novo.php" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-1"></i>Novo Equipamento
    </a>
</div>

<div class="table-responsive">
    <table id="tabelaEquipamentos" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Designação</th>
                <th>Marca / Modelo</th>
                <th>Localização</th>
                <th>Estado</th>
                <th>Criticidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipamentos as $eq): ?>
            <tr>
                <td><?= htmlspecialchars($eq->codigoEquipamento) ?></td>
                <td><?= htmlspecialchars($eq->designacao) ?></td>
                <td><?= htmlspecialchars($eq->marca . ' ' . $eq->modelo) ?></td>
                <td><?= htmlspecialchars($eq->nomeLocalizacao) ?></td>
                <td><?= htmlspecialchars($eq->nomeEstado) ?></td>
                <td><?= htmlspecialchars($eq->nomeCriticidade) ?></td>
                <td>
                    <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id_equipamento=<?= aes_encrypt($eq->idEquipamento) ?>"
                       class="btn btn-sm btn-info" title="Ver detalhes">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id_equipamento=<?= aes_encrypt($eq->idEquipamento) ?>"
                       class="btn btn-sm btn-warning" title="Editar">
                        <i class="fa-solid fa-pen"></i>
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
    $("#tabelaEquipamentos").DataTable({
        pageLength: 5,
        language: {
            url: "' . APP_BASE . '/private/assets/js/datatables-pt.json"
        }
    });
});
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
