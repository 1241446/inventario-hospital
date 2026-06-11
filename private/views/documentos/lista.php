<?php
// =====================================================
// MedControl – Lista de Documentos
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Documentos';
$paginaAtiva  = 'documentos';

try {
    $pdo = new PDO(
        'mysql:host=' . MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DATABASE . ';charset=utf8',
        MYSQL_USERNAME,
        MYSQL_PASSWORD
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $documentos = $pdo->query("
        SELECT d.idDocumento, d.nomeDocumento, d.tipoDocumento, d.dataUpload,
               e.codigoEquipamento, e.designacao
          FROM Documento d
          JOIN Equipamento e ON d.idEquipamento = e.idEquipamento
         ORDER BY d.dataUpload DESC
    ")->fetchAll(PDO::FETCH_OBJ);

    $pdo = null;
} catch (PDOException $e) {
    $dbErro     = $e->getMessage();
    $documentos = [];
}

$badgeTipo = [
    'MANUAL'        => 'bg-info text-dark',
    'CERTIFICADO'   => 'bg-success',
    'CONTRATO'      => 'bg-warning text-dark',
    'ESPECIFICACAO' => 'bg-secondary',
    'OUTRO'         => 'bg-dark',
];
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

<h4 class="mb-3"><i class="fa-solid fa-file-pdf me-2"></i>Documentos</h4>

<div class="table-responsive">
    <table id="tabelaDocumentos" class="table table-striped table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome do Documento</th>
                <th>Tipo</th>
                <th>Equipamento</th>
                <th>Data Upload</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($documentos as $doc):
                $tipoKey  = strtoupper($doc->tipoDocumento ?? '');
                $badgeCss = $badgeTipo[$tipoKey] ?? 'bg-secondary';
                $tipoLabel = ucfirst(strtolower($doc->tipoDocumento ?? 'Outro'));
            ?>
            <tr>
                <td>
                    <i class="fa-solid fa-file-pdf text-danger me-1"></i>
                    <?= htmlspecialchars($doc->nomeDocumento) ?>
                </td>
                <td><span class="badge <?= $badgeCss ?>"><?= htmlspecialchars($tipoLabel) ?></span></td>
                <td><?= htmlspecialchars($doc->codigoEquipamento) ?> – <?= htmlspecialchars($doc->designacao) ?></td>
                <td><?= date('d/m/Y', strtotime($doc->dataUpload)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$scriptsExtra = '
<script>
$(document).ready(function() {
    $("#tabelaDocumentos").DataTable({
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
