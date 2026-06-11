<?php
// =====================================================
// MedControl – Lista de Localizações
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Localizações';
$paginaAtiva  = 'localizacoes';

try {
    $pdo = new PDO(
        'mysql:host=' . MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DATABASE . ';charset=utf8',
        MYSQL_USERNAME,
        MYSQL_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("
        SELECT l.idLocalizacao, l.nomeLocalizacao, l.piso, l.ala, l.descricao,
               COUNT(e.idEquipamento) AS totalEquipamentos
          FROM Localizacao l
          LEFT JOIN Equipamento e ON l.idLocalizacao = e.idLocalizacao
         GROUP BY l.idLocalizacao
         ORDER BY l.nomeLocalizacao
    ");
    $localizacoes = $stmt->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
} catch (PDOException $e) {
    $dbErro      = $e->getMessage();
    $localizacoes = [];
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
    <h4 class="mb-0"><i class="fa-solid fa-map-location-dot me-2"></i>Localizações</h4>
    <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-1"></i>Nova Localização
    </a>
</div>

<div class="table-responsive">
    <table id="tabelaLocalizacoes" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Piso</th>
                <th>Ala</th>
                <th>Descrição</th>
                <th>Equipamentos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($localizacoes as $loc): ?>
            <tr>
                <td><?= htmlspecialchars($loc->nomeLocalizacao) ?></td>
                <td><?= htmlspecialchars($loc->piso ?? '—') ?></td>
                <td><?= htmlspecialchars($loc->ala ?? '—') ?></td>
                <td><?= htmlspecialchars($loc->descricao ?? '—') ?></td>
                <td><?= (int)$loc->totalEquipamentos ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$scriptsExtra = '
<script>
$(document).ready(function() {
    $("#tabelaLocalizacoes").DataTable({
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
