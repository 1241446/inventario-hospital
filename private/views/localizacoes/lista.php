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
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<div class="page">

    <div class="filters">
        <div class="filter-group">
            <label>Pesquisar</label>
            <input type="text" id="searchInput" placeholder="Nome ou ala...">
        </div>
        <div class="filter-group">
            <label>Piso</label>
            <select id="filterPiso">
                <option value="">Todos os pisos</option>
                <option value="0">Piso 0</option>
                <option value="1">Piso 1</option>
                <option value="2">Piso 2</option>
            </select>
        </div>
    </div>

    <div class="table-box">
        <div class="table-responsive">
            <table id="localizacoesTable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Piso</th>
                        <th>Ala</th>
                        <th>Descrição</th>
                        <th>Equipamentos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Bloco Operatório A</td>
                        <td>2</td>
                        <td>Norte</td>
                        <td>Bloco operatório principal</td>
                        <td>3</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php?id=1" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarLocalizacao(1)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>UCI</td>
                        <td>1</td>
                        <td>Sul</td>
                        <td>Unidade de Cuidados Intensivos</td>
                        <td>2</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php?id=2" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarLocalizacao(2)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Radiologia</td>
                        <td>0</td>
                        <td>Este</td>
                        <td>Departamento de imagiologia e radiologia</td>
                        <td>2</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php?id=3" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarLocalizacao(3)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Laboratório Central</td>
                        <td>0</td>
                        <td>Oeste</td>
                        <td>Laboratório de análises clínicas</td>
                        <td>1</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php?id=4" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarLocalizacao(4)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Fisioterapia</td>
                        <td>1</td>
                        <td>Norte</td>
                        <td>Departamento de reabilitação física</td>
                        <td>0</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/localizacoes/novo.php?id=5" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarLocalizacao(5)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    function apagarLocalizacao(id) {
        if (confirm("Tem a certeza que deseja apagar esta localização?")) {
            showNotification("Localização apagada com sucesso!", "success");
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        filterTable("localizacoesTable", "searchInput");
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
