<?php
// =====================================================
// MedControl – Lista de Garantias
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Garantias';
$paginaAtiva  = 'garantias';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<style>
    .kpi-mini {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .kpi-mini-card {
        background: var(--surface);
        border-radius: var(--radius);
        padding: 20px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        border-left: 4px solid var(--primary);
    }

    .kpi-mini-card.green { border-left-color: var(--success); }
    .kpi-mini-card.amber { border-left-color: var(--warning); }
    .kpi-mini-card.red   { border-left-color: var(--danger); }

    .kpi-mini-value { font-size: 1.8em; font-weight: 800; line-height: 1; }
    .kpi-mini-card.green .kpi-mini-value { color: var(--success); }
    .kpi-mini-card.amber .kpi-mini-value { color: var(--warning); }
    .kpi-mini-card.red   .kpi-mini-value { color: var(--danger); }

    .kpi-mini-label { font-size: 0.82em; color: var(--text-muted); margin-top: 4px; }

    @media (max-width: 700px) { .kpi-mini { grid-template-columns: 1fr; } }
</style>

<div class="page">

    <!-- KPIs -->
    <div class="kpi-mini">
        <div class="kpi-mini-card green">
            <div class="kpi-mini-value">180</div>
            <div class="kpi-mini-label">Garantias Ativas</div>
        </div>
        <div class="kpi-mini-card amber">
            <div class="kpi-mini-value">17</div>
            <div class="kpi-mini-label">Vencimento Próximo (30 dias)</div>
        </div>
        <div class="kpi-mini-card red">
            <div class="kpi-mini-value">3</div>
            <div class="kpi-mini-label">Garantias Expiradas</div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="filters">
        <div class="filter-group">
            <label>Pesquisar</label>
            <input type="text" id="searchInput" placeholder="Código ou equipamento...">
        </div>
        <div class="filter-group">
            <label>Estado</label>
            <select id="filterStatus">
                <option value="">Todos</option>
                <option value="Ativa">Ativa</option>
                <option value="Vence">Vencimento Próximo</option>
                <option value="Expirada">Expirada</option>
            </select>
        </div>
    </div>

    <!-- Tabela -->
    <div class="table-box">
        <div class="table-responsive">
            <table id="garantiasTable">
                <thead>
                    <tr>
                        <th>Equipamento</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Data Início</th>
                        <th>Data Fim</th>
                        <th>Estado</th>
                        <th>Dias Restantes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ressonância Magnética 3T</td>
                        <td>EQ-001</td>
                        <td><span class="badge badge-primary">Completa</span></td>
                        <td>15/03/2021</td>
                        <td>15/03/2026</td>
                        <td><span class="badge badge-success">Ativa</span></td>
                        <td><strong style="color:var(--success);">269 dias</strong></td>
                    </tr>
                    <tr>
                        <td>Monitor de Sinais Vitais</td>
                        <td>EQ-002</td>
                        <td><span class="badge badge-primary">Completa</span></td>
                        <td>10/06/2020</td>
                        <td>10/06/2025</td>
                        <td><span class="badge badge-danger">Expirada</span></td>
                        <td><strong style="color:var(--danger);">EXPIRADA</strong></td>
                    </tr>
                    <tr>
                        <td>Tomógrafo Computorizado</td>
                        <td>EQ-004</td>
                        <td><span class="badge badge-primary">Completa</span></td>
                        <td>08/01/2022</td>
                        <td>08/01/2027</td>
                        <td><span class="badge badge-success">Ativa</span></td>
                        <td><strong style="color:var(--success);">567 dias</strong></td>
                    </tr>
                    <tr>
                        <td>Analisador Hematológico</td>
                        <td>EQ-005</td>
                        <td><span class="badge badge-muted">Limitada</span></td>
                        <td>22/04/2021</td>
                        <td>22/04/2024</td>
                        <td><span class="badge badge-danger">Expirada</span></td>
                        <td><strong style="color:var(--danger);">EXPIRADA</strong></td>
                    </tr>
                    <tr>
                        <td>Mesa Cirúrgica Motorizada</td>
                        <td>EQ-007</td>
                        <td><span class="badge badge-primary">Completa</span></td>
                        <td>14/02/2020</td>
                        <td>14/02/2025</td>
                        <td><span class="badge badge-danger">Expirada</span></td>
                        <td><strong style="color:var(--danger);">EXPIRADA</strong></td>
                    </tr>
                    <tr>
                        <td>Aparelho de Ultrassons</td>
                        <td>EQ-008</td>
                        <td><span class="badge badge-muted">Fabricante</span></td>
                        <td>30/08/2023</td>
                        <td>30/08/2026</td>
                        <td><span class="badge badge-warning">Vence em breve</span></td>
                        <td><strong style="color:var(--warning);">71 dias</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    document.addEventListener("DOMContentLoaded", () => {
        filterTable("garantiasTable", "searchInput");
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
