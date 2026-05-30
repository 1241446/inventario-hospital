<?php
// =====================================================
// MedControl – Novo Fornecedor
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Novo Fornecedor';
$paginaAtiva  = 'fornecedores';

// ─── CARREGAR PAÍSES ─────────────────────────────────
try {
    $pdoPaises = get_pdo();
    $paises = $pdoPaises->query("SELECT * FROM Pais ORDER BY nomePais")->fetchAll(PDO::FETCH_OBJ);
    $pdoPaises = null;
} catch (PDOException $e) {
    $paises = [];
}

$erros        = [];
$erro_sistema = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomeEmpresa      = trim($_POST['nomeEmpresa']      ?? '');
    $nif              = trim($_POST['nif']              ?? '');
    $tipoFornecedor   = trim($_POST['tipoFornecedor']   ?? '');
    $idPais           = $_POST['idPais']                ?? '';
    $website          = trim($_POST['website']          ?? '');
    $morada           = trim($_POST['morada']           ?? '');
    $nomeContacto     = trim($_POST['nomeContacto']     ?? '');
    $cargoContacto    = trim($_POST['cargoContacto']    ?? '');
    $telefoneContacto = trim($_POST['telefoneContacto'] ?? '');
    $emailContacto    = trim($_POST['emailContacto']    ?? '');
    $observacoes      = trim($_POST['observacoes']      ?? '');

    if (empty($nomeEmpresa))    $erros[] = 'O Nome da Empresa é obrigatório.';
    if (empty($nif))            $erros[] = 'O NIF é obrigatório.';
    if (empty($tipoFornecedor)) $erros[] = 'O Tipo de Fornecedor é obrigatório.';
    if (empty($morada))         $erros[] = 'A Morada é obrigatória.';
    if (empty($emailContacto))  $erros[] = 'O Email de Contacto é obrigatório.';

    if (empty($erros)) {
        try {
            $pdo = get_pdo();

            $stmt = $pdo->prepare("
                INSERT INTO Fornecedor
                    (nomeEmpresa, nif, tipoFornecedor, idPais, website, morada,
                     nomeContacto, cargoContacto, telefoneContacto, emailContacto, observacoes)
                VALUES
                    (:nomeEmpresa, :nif, :tipoFornecedor, :idPais, :website, :morada,
                     :nomeContacto, :cargoContacto, :telefoneContacto, :emailContacto, :observacoes)
            ");
            $stmt->execute([
                ':nomeEmpresa'      => $nomeEmpresa,
                ':nif'              => $nif,
                ':tipoFornecedor'   => strtoupper($tipoFornecedor),
                ':idPais'           => $idPais ?: null,
                ':website'          => $website    ?: null,
                ':morada'           => $morada,
                ':nomeContacto'     => $nomeContacto     ?: null,
                ':cargoContacto'    => $cargoContacto    ?: null,
                ':telefoneContacto' => $telefoneContacto ?: null,
                ':emailContacto'    => $emailContacto,
                ':observacoes'      => $observacoes      ?: null,
            ]);
            $pdo = null;
            registarLog('INSERIR_FORNECEDOR', "empresa=$nomeEmpresa por " . ($_SESSION['utilizador'] ?? 'desconhecido'));
            $_SESSION['toast'] = ['msg' => 'Fornecedor criado com sucesso.', 'type' => 'success'];
            header('Location: lista.php');
            exit;
        } catch (PDOException $err) {
            registarLog('ERRO_INSERIR_FORNECEDOR', $err->getMessage());
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

        <h5 class="mb-4"><i class="fa-solid fa-truck-medical me-2"></i>Novo Fornecedor</h5>

        <form action="#" method="post" novalidate>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nomeEmpresa" class="form-label">Nome da Empresa *</label>
                    <input type="text" class="form-control" id="nomeEmpresa" name="nomeEmpresa"
                           value="<?= htmlspecialchars($_POST['nomeEmpresa'] ?? '') ?>"
                           placeholder="Ex: Siemens Healthineers">
                </div>
                <div class="col-md-3">
                    <label for="nif" class="form-label">NIF *</label>
                    <input type="text" class="form-control" id="nif" name="nif"
                           value="<?= htmlspecialchars($_POST['nif'] ?? '') ?>"
                           placeholder="Ex: 500123456">
                </div>
                <div class="col-md-3">
                    <label for="tipoFornecedor" class="form-label">Tipo *</label>
                    <select class="form-select" id="tipoFornecedor" name="tipoFornecedor">
                        <option value="">-- Escolha --</option>
                        <option value="FABRICANTE"  <?= (($_POST['tipoFornecedor'] ?? '') === 'FABRICANTE')  ? 'selected' : '' ?>>Fabricante</option>
                        <option value="DISTRIBUIDOR"<?= (($_POST['tipoFornecedor'] ?? '') === 'DISTRIBUIDOR')? 'selected' : '' ?>>Distribuidor</option>
                        <option value="FORNECEDOR"  <?= (($_POST['tipoFornecedor'] ?? '') === 'FORNECEDOR')  ? 'selected' : '' ?>>Fornecedor</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="idPais" class="form-label">País</label>
                    <select class="form-select" id="idPais" name="idPais">
                        <option value="">-- Escolha --</option>
                        <?php foreach ($paises as $pais): ?>
                        <option value="<?= $pais->idPais ?>"
                            <?= (($_POST['idPais'] ?? '') == $pais->idPais) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($pais->nomePais) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="website" class="form-label">Website</label>
                    <input type="text" class="form-control" id="website" name="website"
                           value="<?= htmlspecialchars($_POST['website'] ?? '') ?>"
                           placeholder="www.empresa.com">
                </div>
                <div class="col-md-5">
                    <label for="morada" class="form-label">Morada *</label>
                    <input type="text" class="form-control" id="morada" name="morada"
                           value="<?= htmlspecialchars($_POST['morada'] ?? '') ?>"
                           placeholder="Rua, número, cidade">
                </div>
            </div>

            <hr class="my-3">
            <p class="small fw-bold text-muted text-uppercase mb-3" style="letter-spacing:.05em;">
                <i class="fa-solid fa-address-card me-1"></i>Contacto Principal
            </p>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="nomeContacto" class="form-label">Nome do Contacto</label>
                    <input type="text" class="form-control" id="nomeContacto" name="nomeContacto"
                           value="<?= htmlspecialchars($_POST['nomeContacto'] ?? '') ?>"
                           placeholder="Nome completo">
                </div>
                <div class="col-md-3">
                    <label for="cargoContacto" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="cargoContacto" name="cargoContacto"
                           value="<?= htmlspecialchars($_POST['cargoContacto'] ?? '') ?>"
                           placeholder="Ex: Diretor Comercial">
                </div>
                <div class="col-md-3">
                    <label for="telefoneContacto" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefoneContacto" name="telefoneContacto"
                           value="<?= htmlspecialchars($_POST['telefoneContacto'] ?? '') ?>"
                           placeholder="+351 2XX XXX XXX">
                </div>
                <div class="col-md-3">
                    <label for="emailContacto" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="emailContacto" name="emailContacto"
                           value="<?= htmlspecialchars($_POST['emailContacto'] ?? '') ?>"
                           placeholder="email@empresa.com">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <label for="observacoes" class="form-label">Observações</label>
                    <textarea class="form-control" id="observacoes" name="observacoes" rows="2"
                              placeholder="Notas adicionais..."><?= htmlspecialchars($_POST['observacoes'] ?? '') ?></textarea>
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
                <a href="<?= APP_BASE ?>/private/views/fornecedores/lista.php" class="btn btn-secondary">
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
