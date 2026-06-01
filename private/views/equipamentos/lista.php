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
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<?php
$topbarTitulo    = '<i class="fa-solid fa-stethoscope" style="color:var(--primary);margin-right:8px;"></i>Gestão de Equipamentos';
$topbarSubtitulo = 'Inventário completo de equipamentos médicos';
$topbarAcao      = '<a href="' . APP_BASE . '/private/views/equipamentos/novo.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Novo Equipamento</a>';
include __DIR__ . '/../../includes/nav.php';
?>

<!-- ─── CONTEÚDO ─── -->
<div class="page">

    <!-- Filtros -->
    <div class="filters">
        <div class="filter-group">
            <label>Pesquisar</label>
            <input type="text" id="searchInput" placeholder="Código, nome ou marca...">
        </div>
        <div class="filter-group">
            <label>Estado</label>
            <select id="filterEstado">
                <option value="">Todos os estados</option>
                <option value="Operacional">Operacional</option>
                <option value="Manutenção">Manutenção</option>
                <option value="Avariado">Avariado</option>
            </select>
        </div>
        <div class="filter-group">
            <label>Criticidade</label>
            <select id="filterCriticidade">
                <option value="">Todas as criticidades</option>
                <option value="Crítica">Crítica</option>
                <option value="Alta">Alta</option>
                <option value="Média">Média</option>
                <option value="Baixa">Baixa</option>
            </select>
        </div>
        <div style="display:flex;gap:8px;align-items:flex-end;">
            <button class="btn btn-secondary" onclick="exportarCSV()">
                <i class="fa-solid fa-download"></i> Exportar
            </button>
        </div>
    </div>

    <!-- Tabela -->
    <div class="table-box">
        <div class="table-responsive">
            <table id="equipamentosTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Marca / Modelo</th>
                        <th>Localização</th>
                        <th>Estado</th>
                        <th>Criticidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EQ-001</td>
                        <td>Ventilador Pulmonar</td>
                        <td>Siemens SERVO-i</td>
                        <td>UCI-01</td>
                        <td><span class="badge badge-success">Operacional</span></td>
                        <td><span class="badge badge-danger">Crítica</span></td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id=1" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id=1" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarEquipamento(1)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EQ-002</td>
                        <td>Monitor Cardíaco</td>
                        <td>Philips IntelliVue MP50</td>
                        <td>Urgência</td>
                        <td><span class="badge badge-success">Operacional</span></td>
                        <td><span class="badge badge-danger">Crítica</span></td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id=2" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id=2" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarEquipamento(2)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EQ-003</td>
                        <td>Bomba de Infusão</td>
                        <td>Fresenius Volumat Agilia</td>
                        <td>UCI-02</td>
                        <td><span class="badge badge-success">Operacional</span></td>
                        <td><span class="badge badge-info">Alta</span></td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id=3" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id=3" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarEquipamento(3)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EQ-004</td>
                        <td>Desfibrilhador</td>
                        <td>Zoll X Series</td>
                        <td>Bloco Operatório</td>
                        <td><span class="badge badge-success">Operacional</span></td>
                        <td><span class="badge badge-danger">Crítica</span></td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id=4" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id=4" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarEquipamento(4)"><i class="fa-solid fa-trash"></i> Apagar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>EQ-005</td>
                        <td>Electrocardiograma</td>
                        <td>GE Healthcare MAC 5000</td>
                        <td>Cardio</td>
                        <td><span class="badge badge-warning">Manutenção</span></td>
                        <td><span class="badge badge-info">Alta</span></td>
                        <td class="actions">
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id=5" class="btn-action ver"><i class="fa-solid fa-eye"></i> Ver</a>
                            <a href="<?= APP_BASE ?>/private/views/equipamentos/editar.php?id=5" class="btn-action editar"><i class="fa-solid fa-pen"></i> Editar</a>
                            <button class="btn-action apagar" onclick="apagarEquipamento(5)"><i class="fa-solid fa-trash"></i> Apagar</button>
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
    function apagarEquipamento(id) {
        if (confirm("Tem a certeza que deseja apagar este equipamento?")) {
            showNotification("Equipamento apagado com sucesso!", "success");
        }
    }

    function exportarCSV() {
        exportTableToCSV("equipamentosTable", "equipamentos.csv");
    }

    document.addEventListener("DOMContentLoaded", () => {
        filterTable("equipamentosTable", "searchInput");

        document.getElementById("filterEstado").addEventListener("change", filterRows);
        document.getElementById("filterCriticidade").addEventListener("change", filterRows);

        function filterRows() {
            const estado = document.getElementById("filterEstado").value.toLowerCase();
            const crit   = document.getElementById("filterCriticidade").value.toLowerCase();
            document.querySelectorAll("#equipamentosTable tbody tr").forEach(row => {
                const texto = row.textContent.toLowerCase();
                const ok = (!estado || texto.includes(estado)) && (!crit || texto.includes(crit));
                row.style.display = ok ? "" : "none";
            });
        }
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
