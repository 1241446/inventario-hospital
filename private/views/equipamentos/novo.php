<?php
// =====================================================
// MedControl – Novo Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/validacoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Novo Equipamento';
$paginaAtiva  = 'equipamentos';

// ─── CARREGAR LISTAS DA BD ───────────────────────────
try {
    $pdoListas = get_pdo();
    $categorias   = $pdoListas->query("SELECT * FROM Categoria   ORDER BY nomeCategoria")->fetchAll(PDO::FETCH_OBJ);
    $estados      = $pdoListas->query("SELECT * FROM Estado      ORDER BY nomeEstado")->fetchAll(PDO::FETCH_OBJ);
    $criticidades = $pdoListas->query("SELECT * FROM Criticidade ORDER BY nomeCriticidade")->fetchAll(PDO::FETCH_OBJ);
    $localizacoes = $pdoListas->query("SELECT * FROM Localizacao ORDER BY nomeLocalizacao")->fetchAll(PDO::FETCH_OBJ);
    $pdoListas = null;
} catch (PDOException $e) {
    $categorias = $estados = $criticidades = $localizacoes = [];
}

// ─── INICIALIZAÇÃO ───────────────────────────────────
$erros        = [];
$erro_sistema = "";

// ─── PROCESSAR FORMULÁRIO (POST) ─────────────────────
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recolher dados
    $codigo        = $_POST['codigo_equipamento']     ?? '';
    $designacao    = $_POST['designacao_equipamento'] ?? '';
    $idCategoria   = $_POST['id_categoria']           ?? '';
    $marca         = $_POST['marca_equipamento']      ?? '';
    $modelo        = $_POST['modelo_equipamento']     ?? '';
    $serie         = $_POST['serie_equipamento']      ?? '';
    $anoFabrico    = $_POST['ano_fabrico']            ?? '';
    $idEstado      = $_POST['id_estado']              ?? '';
    $idCriticidade = $_POST['id_criticidade']         ?? '';
    $idLocalizacao = $_POST['id_localizacao']         ?? '';
    $observacoes   = $_POST['observacoes_equipamento'] ?? '';

    // 2. Validar dados
    $codigo        = trim($codigo);
    $designacao    = trim($designacao);
    $marca         = trim($marca);
    $modelo        = trim($modelo);
    $serie         = trim($serie);
    $anoFabrico    = trim($anoFabrico);
    $observacoes   = trim($observacoes);

    $erros = array_merge($erros, validar_codigo($codigo));
    $erros = array_merge($erros, validar_designacao($designacao));
    $erros = array_merge($erros, validar_ano_fabrico($anoFabrico));

    if (empty($idCategoria))   $erros[] = "A Categoria é obrigatória.";
    if (empty($idEstado))      $erros[] = "O Estado é obrigatório.";
    if (empty($idCriticidade)) $erros[] = "A Criticidade é obrigatória.";
    if (empty($idLocalizacao)) $erros[] = "A Localização é obrigatória.";

    // 3. Normalizar entrada
    if (empty($erros)) {
        $designacao = ucwords(strtolower($designacao));
        $marca      = ucwords(strtolower($marca));
        $modelo     = ucwords(strtolower($modelo));
        $codigo     = strtoupper($codigo);

        // 4. Guardar na base de dados
        try {
            $ligacao = get_pdo();

            $sql = "INSERT INTO Equipamento (
                        codigoEquipamento, designacao, idCategoria, marca, modelo,
                        numeroSerie, anoFabrico, idEstado, idCriticidade, idLocalizacao, observacoes
                    ) VALUES (
                        :codigo, :designacao, :idCategoria, :marca, :modelo,
                        :serie, :anoFabrico, :idEstado, :idCriticidade, :idLocalizacao, :observacoes
                    )";

            $stmt = $ligacao->prepare($sql);
            $stmt->execute([
                ':codigo'        => $codigo,
                ':designacao'    => $designacao,
                ':idCategoria'   => $idCategoria,
                ':marca'         => $marca         ?: null,
                ':modelo'        => $modelo         ?: null,
                ':serie'         => $serie          ?: null,
                ':anoFabrico'    => $anoFabrico     ?: null,
                ':idEstado'      => $idEstado,
                ':idCriticidade' => $idCriticidade,
                ':idLocalizacao' => $idLocalizacao,
                ':observacoes'   => $observacoes    ?: null,
            ]);

            $novoId = $ligacao->lastInsertId();
            $ligacao = null;
            registarLog('INSERIR_EQUIPAMENTO', "codigo=$codigo id=$novoId por " . ($_SESSION['utilizador'] ?? 'desconhecido'));
            $_SESSION['toast'] = ['msg' => 'Equipamento criado com sucesso.', 'type' => 'success'];
            header('Location: lista.php');
            exit;

        } catch (PDOException $err) {
            registarLog('ERRO_INSERIR_EQUIPAMENTO', $err->getMessage());
            $erro_sistema = "Erro ao gravar os dados: " . $err->getMessage();
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

<!-- ─── CONTEÚDO ─── -->
<div class="page">
    <div class="content-box">

        <h5 class="mb-4">
            <i class="fa-solid fa-hospital-user me-2"></i>Inserir novo equipamento
        </h5>

        <form action="#" method="post" novalidate>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="codigo_equipamento" class="form-label">Código Único *</label>
                    <input type="text" class="form-control" id="codigo_equipamento"
                           name="codigo_equipamento"
                           value="<?= htmlspecialchars($_POST['codigo_equipamento'] ?? '') ?>"
                           placeholder="EQ-001">
                </div>
                <div class="col-md-8">
                    <label for="designacao_equipamento" class="form-label">Designação *</label>
                    <input type="text" class="form-control" id="designacao_equipamento"
                           name="designacao_equipamento"
                           value="<?= htmlspecialchars($_POST['designacao_equipamento'] ?? '') ?>"
                           placeholder="Nome do equipamento">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="marca_equipamento" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca_equipamento"
                           name="marca_equipamento"
                           value="<?= htmlspecialchars($_POST['marca_equipamento'] ?? '') ?>"
                           placeholder="Ex: Siemens">
                </div>
                <div class="col-md-4">
                    <label for="modelo_equipamento" class="form-label">Modelo</label>
                    <input type="text" class="form-control" id="modelo_equipamento"
                           name="modelo_equipamento"
                           value="<?= htmlspecialchars($_POST['modelo_equipamento'] ?? '') ?>"
                           placeholder="Ex: MAGNETOM Vida">
                </div>
                <div class="col-md-4">
                    <label for="serie_equipamento" class="form-label">Número de Série</label>
                    <input type="text" class="form-control" id="serie_equipamento"
                           name="serie_equipamento"
                           value="<?= htmlspecialchars($_POST['serie_equipamento'] ?? '') ?>"
                           placeholder="Ex: SN-2021-001">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="ano_fabrico" class="form-label">Ano de Fabrico</label>
                    <input type="text" class="form-control" id="ano_fabrico"
                           name="ano_fabrico"
                           value="<?= htmlspecialchars($_POST['ano_fabrico'] ?? '') ?>"
                           placeholder="AAAA">
                </div>
                <div class="col-md-3">
                    <label for="id_categoria" class="form-label">Categoria *</label>
                    <select class="form-select" id="id_categoria" name="id_categoria">
                        <option value="">-- Escolha uma opção --</option>
                        <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat->idCategoria ?>"
                            <?= (($_POST['id_categoria'] ?? '') == $cat->idCategoria) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat->nomeCategoria) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="id_estado" class="form-label">Estado *</label>
                    <select class="form-select" id="id_estado" name="id_estado">
                        <option value="">-- Escolha uma opção --</option>
                        <?php foreach ($estados as $est): ?>
                        <option value="<?= $est->idEstado ?>"
                            <?= (($_POST['id_estado'] ?? '') == $est->idEstado) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($est->nomeEstado) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="id_criticidade" class="form-label">Criticidade *</label>
                    <select class="form-select" id="id_criticidade" name="id_criticidade">
                        <option value="">-- Escolha uma opção --</option>
                        <?php foreach ($criticidades as $crit): ?>
                        <option value="<?= $crit->idCriticidade ?>"
                            <?= (($_POST['id_criticidade'] ?? '') == $crit->idCriticidade) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($crit->nomeCriticidade) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_localizacao" class="form-label">Localização *</label>
                    <select class="form-select" id="id_localizacao" name="id_localizacao">
                        <option value="">-- Escolha uma opção --</option>
                        <?php foreach ($localizacoes as $loc): ?>
                        <option value="<?= $loc->idLocalizacao ?>"
                            <?= (($_POST['id_localizacao'] ?? '') == $loc->idLocalizacao) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($loc->nomeLocalizacao) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="observacoes_equipamento" class="form-label">Observações</label>
                    <textarea class="form-control" id="observacoes_equipamento"
                              name="observacoes_equipamento" rows="2"
                              placeholder="Informações adicionais..."><?= htmlspecialchars($_POST['observacoes_equipamento'] ?? '') ?></textarea>
                </div>
            </div>

            <p class="text-muted small mt-2"><span class="text-danger">*</span> Campos obrigatórios</p>

            <!-- Área de erros de validação -->
            <?php if (!empty($erros)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Foram encontrados os seguintes erros:</strong>
                <ul class="mb-0">
                    <?php foreach ($erros as $erro): ?>
                    <li><?= htmlspecialchars($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- Área de erro do sistema (PDO) -->
            <?php if (!empty($erro_sistema)): ?>
            <div class="alert alert-danger" role="alert">
                <strong>Erro:</strong>
                <p class="mb-0"><?= htmlspecialchars($erro_sistema) ?></p>
            </div>
            <?php endif; ?>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark me-1"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Guardar
                </button>
            </div>

        </form>

    </div>
</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
flatpickr("#ano_fabrico", {
    dateFormat: "Y",
    maxDate: "today"
});
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
