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
            <input type="text" id="searchInput" placeholder="Nome ou NIF...">
        </div>
        <div class="filter-group">
            <label>Tipo</label>
            <select id="filterTipo">
                <option value="">Todos os tipos</option>
                <option value="Fabricante">Fabricante</option>
                <option value="Distribuidor">Distribuidor</option>
                <option value="Fornecedor">Fornecedor</option>
            </select>
        </div>
    </div>

    <div class="table-box">
        <div class="table-responsive">
            <table id="fornecedoresTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Equipamentos</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>FORN-001</td>
                        <td>Siemens Healthineers</td>
                        <td><span class="badge badge-primary">Fabricante</span></td>
                        <td>hmueller@siemens.com</td>
                        <td>+351 210 000 001</td>
                        <td>3</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/detalhes.php?id=1" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/novo.php?id=1" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarFornecedor(1)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>FORN-002</td>
                        <td>Philips Healthcare</td>
                        <td><span class="badge badge-primary">Fabricante</span></td>
                        <td>mrodrigues@philips.com</td>
                        <td>+351 220 000 002</td>
                        <td>2</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/detalhes.php?id=2" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/novo.php?id=2" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarFornecedor(2)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>FORN-003</td>
                        <td>MedTech Portugal</td>
                        <td><span class="badge badge-info">Distribuidor</span></td>
                        <td>jsilva@medtech.pt</td>
                        <td>+351 239 000 003</td>
                        <td>3</td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/detalhes.php?id=3" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/fornecedores/novo.php?id=3" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarFornecedor(3)"><i class="fa-solid fa-trash"></i> Apagar</button>
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
    function apagarFornecedor(id) {
        if (confirm("Tem a certeza que deseja apagar este fornecedor?")) {
            showNotification("Fornecedor apagado com sucesso!", "success");
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        filterTable("fornecedoresTable", "searchInput");
        document.getElementById("filterTipo").addEventListener("change", function() {
            const tipo = this.value.toLowerCase();
            document.querySelectorAll("#fornecedoresTable tbody tr").forEach(row => {
                row.style.display = !tipo || row.textContent.toLowerCase().includes(tipo) ? "" : "none";
            });
        });
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
