<?php
// =====================================================
// MedControl – Nova Localização
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();
verificarPerfil(['ADMINISTRADOR', 'GESTOR', 'TECNICO']);

$tituloPagina = 'Nova Localização';
$paginaAtiva  = 'localizacoes';

$erros        = [];
$erro_sistema = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomeLocalizacao = trim($_POST['nomeLocalizacao'] ?? '');
    $piso            = trim($_POST['piso']            ?? '');
    $ala             = trim($_POST['ala']             ?? '');
    $descricao       = trim($_POST['descricao']       ?? '');

    if (empty($nomeLocalizacao)) {
        $erros[] = 'O campo Nome da Localização é obrigatório.';
    }

    if (!empty($piso) && !is_numeric($piso)) {
        $erros[] = 'O piso deve ser um número.';
    }

    if (empty($erros)) {
        try {
            $pdo = get_pdo();

            $stmt = $pdo->prepare(
                "INSERT INTO Localizacao (nomeLocalizacao, piso, ala, descricao) VALUES (:nome, :piso, :ala, :descricao)"
            );
            $stmt->execute([
                ':nome'     => $nomeLocalizacao,
                ':piso'     => $piso !== '' ? (int)$piso : null,
                ':ala'      => $ala      ?: null,
                ':descricao'=> $descricao ?: null,
            ]);
            $pdo = null;
            registarLog('INSERIR_LOCALIZACAO', "nome=$nomeLocalizacao por " . ($_SESSION['utilizador'] ?? 'desconhecido'));
            $_SESSION['toast'] = ['msg' => 'Localização criada com sucesso.', 'type' => 'success'];
            header('Location: lista.php');
            exit;
        } catch (PDOException $err) {
            registarLog('ERRO_INSERIR_LOCALIZACAO', $err->getMessage());
            $erro_sistema = 'Erro ao guardar: ' . $err->getMessage();
        }
    }
}
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<div class="page">
    <div class="content-box">

        <h5 class="mb-4"><i class="fa-solid fa-map-location-dot me-2"></i>Nova Localização</h5>

        <form action="#" method="post" novalidate>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="nomeLocalizacao" class="form-label">Nome da Localização *</label>
                    <input type="text" class="form-control" id="nomeLocalizacao" name="nomeLocalizacao"
                           value="<?= htmlspecialchars($_POST['nomeLocalizacao'] ?? '') ?>"
                           placeholder="Ex: Bloco Operatório B">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="piso" class="form-label">Piso</label>
                    <input type="number" class="form-control" id="piso" name="piso"
                           value="<?= htmlspecialchars($_POST['piso'] ?? '') ?>"
                           placeholder="Ex: 2">
                </div>
                <div class="col-md-3">
                    <label for="ala" class="form-label">Ala</label>
                    <input type="text" class="form-control" id="ala" name="ala"
                           value="<?= htmlspecialchars($_POST['ala'] ?? '') ?>"
                           placeholder="Ex: Norte">
                </div>
                <div class="col-md-6">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao"
                           value="<?= htmlspecialchars($_POST['descricao'] ?? '') ?>"
                           placeholder="Breve descrição da localização">
                </div>
            </div>

            <?php if (!empty($erros)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <?php if (!empty($erro_sistema)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro_sistema) ?></div>
            <?php endif; ?>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="<?= APP_BASE ?>/private/views/localizacoes/lista.php" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                </button>
            </div>

        </form>
    </div>
</div>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
