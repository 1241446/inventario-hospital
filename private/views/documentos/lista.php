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
            <input type="text" id="searchInput" placeholder="Nome ou equipamento...">
        </div>
        <div class="filter-group">
            <label>Tipo</label>
            <select id="filterTipo">
                <option value="">Todos os tipos</option>
                <option value="Manual">Manual</option>
                <option value="Certificado">Certificado</option>
                <option value="Contrato">Contrato</option>
                <option value="Especificacao">Especificação</option>
            </select>
        </div>
    </div>

    <div class="table-box">
        <div class="table-responsive">
            <table id="documentosTable">
                <thead>
                    <tr>
                        <th>Nome do Ficheiro</th>
                        <th>Tipo</th>
                        <th>Equipamento</th>
                        <th>Data Upload</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);margin-right:6px;"></i>Manual de Operador MAGNETOM Vida</td>
                        <td><span class="badge badge-info">Manual</span></td>
                        <td>EQ-001</td>
                        <td>15/03/2021</td>
                        <td class="actions">
                            <a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a>
                            <button class="btn-action apagar" onclick="apagarDocumento(1)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);margin-right:6px;"></i>Certificado de Calibração 2023</td>
                        <td><span class="badge badge-success">Certificado</span></td>
                        <td>EQ-001</td>
                        <td>12/09/2023</td>
                        <td class="actions">
                            <a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a>
                            <button class="btn-action apagar" onclick="apagarDocumento(2)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);margin-right:6px;"></i>Manual IntelliVue MX800</td>
                        <td><span class="badge badge-info">Manual</span></td>
                        <td>EQ-002</td>
                        <td>10/06/2020</td>
                        <td class="actions">
                            <a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a>
                            <button class="btn-action apagar" onclick="apagarDocumento(3)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);margin-right:6px;"></i>Contrato de Leasing Ventilador</td>
                        <td><span class="badge badge-warning">Contrato</span></td>
                        <td>EQ-003</td>
                        <td>20/09/2019</td>
                        <td class="actions">
                            <a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a>
                            <button class="btn-action apagar" onclick="apagarDocumento(4)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);margin-right:6px;"></i>Especificações Técnicas SOMATOM Drive</td>
                        <td><span class="badge badge-muted">Especificação</span></td>
                        <td>EQ-004</td>
                        <td>08/01/2022</td>
                        <td class="actions">
                            <a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a>
                            <button class="btn-action apagar" onclick="apagarDocumento(5)"><i class="fa-solid fa-trash"></i> Apagar</button>
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
    function uploadDocumento() {
        showNotification("Funcionalidade em desenvolvimento.", "info");
    }

    function apagarDocumento(id) {
        if (confirm("Tem a certeza que deseja apagar este documento?")) {
            showNotification("Documento apagado com sucesso!", "success");
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        filterTable("documentosTable", "searchInput");
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
