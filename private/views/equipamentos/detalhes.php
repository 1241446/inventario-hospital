<?php
// =====================================================
// MedControl – Detalhes do Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Detalhes do Equipamento';
$paginaAtiva  = 'equipamentos';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<style>
    .info-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px; margin-bottom: 24px; }
    .info-group { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 0.74em; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); }
    .info-value { font-size: 0.92em; font-weight: 500; color: var(--text); }

    .content-card {
        background: var(--surface);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .content-card-header {
        padding: 12px 20px;
        border-bottom: 1px solid var(--border);
        font-size: 0.85em;
        font-weight: 700;
        color: var(--text);
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--bg);
    }

    .content-card-body { padding: 20px; }

    @media (max-width: 700px) { .info-grid { grid-template-columns: 1fr; } }
</style>

<div class="page">

    <div class="tab-buttons" style="margin-bottom:24px;">
        <button class="tab-btn active" onclick="switchTab(this,0)">Identificação</button>
        <button class="tab-btn" onclick="switchTab(this,1)">Dados Técnicos</button>
        <button class="tab-btn" onclick="switchTab(this,2)">Garantia</button>
        <button class="tab-btn" onclick="switchTab(this,3)">Fornecedores</button>
        <button class="tab-btn" onclick="switchTab(this,4)">Documentação</button>
    </div>

    <!-- TAB 1: Identificação -->
    <div class="tab-content active content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Código</div>
                <div class="info-value">EQ-001</div>
            </div>
            <div class="info-group">
                <div class="info-label">Nome</div>
                <div class="info-value">Ventilador Pulmonar</div>
            </div>
            <div class="info-group">
                <div class="info-label">Marca</div>
                <div class="info-value">Siemens</div>
            </div>
            <div class="info-group">
                <div class="info-label">Modelo</div>
                <div class="info-value">SERVO-i</div>
            </div>
            <div class="info-group">
                <div class="info-label">Número de Série</div>
                <div class="info-value">SN-2024-001547</div>
            </div>
            <div class="info-group">
                <div class="info-label">Localização</div>
                <div class="info-value">UCI-01</div>
            </div>
            <div class="info-group">
                <div class="info-label">Estado</div>
                <div class="info-value"><span class="badge badge-success">Operacional</span></div>
            </div>
            <div class="info-group">
                <div class="info-label">Criticidade</div>
                <div class="info-value"><span class="badge badge-danger">Crítica</span></div>
            </div>
        </div>
    </div>

    <!-- TAB 2: Dados Técnicos -->
    <div class="tab-content content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Tensão de Alimentação</div>
                <div class="info-value">220V ~ 50Hz</div>
            </div>
            <div class="info-group">
                <div class="info-label">Potência</div>
                <div class="info-value">500W</div>
            </div>
            <div class="info-group">
                <div class="info-label">Peso</div>
                <div class="info-value">28,5 kg</div>
            </div>
            <div class="info-group">
                <div class="info-label">Dimensões</div>
                <div class="info-value">65cm × 45cm × 120cm</div>
            </div>
            <div class="info-group">
                <div class="info-label">Última Calibração</div>
                <div class="info-value">15/05/2024</div>
            </div>
            <div class="info-group">
                <div class="info-label">Próxima Calibração</div>
                <div class="info-value">15/11/2024</div>
            </div>
        </div>
    </div>

    <!-- TAB 3: Garantia -->
    <div class="tab-content content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Data de Início</div>
                <div class="info-value">15/01/2024</div>
            </div>
            <div class="info-group">
                <div class="info-label">Data de Fim</div>
                <div class="info-value">15/01/2027</div>
            </div>
            <div class="info-group">
                <div class="info-label">Tipo de Garantia</div>
                <div class="info-value">Fabricante</div>
            </div>
            <div class="info-group">
                <div class="info-label">Estado</div>
                <div class="info-value"><span class="badge badge-success">Ativa</span></div>
            </div>
        </div>
    </div>

    <!-- TAB 4: Fornecedores -->
    <div class="tab-content content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Fabricante</div>
                <div class="info-value">Siemens Healthineers</div>
            </div>
            <div class="info-group">
                <div class="info-label">Distribuidor</div>
                <div class="info-value">MedTech Portugal</div>
            </div>
            <div class="info-group">
                <div class="info-label">Assistência Técnica</div>
                <div class="info-value">Siemens Service Center</div>
            </div>
        </div>
    </div>

    <!-- TAB 5: Documentação -->
    <div class="tab-content">
        <div class="table-box">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Nome do Ficheiro</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Manual Técnico</td>
                            <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);"></i> SERVO-i_Manual_PT.pdf</td>
                            <td>20/01/2024</td>
                            <td><a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a></td>
                        </tr>
                        <tr>
                            <td>Certificado Calibração</td>
                            <td><i class="fa-solid fa-file-pdf" style="color:var(--danger);"></i> Calibracao_2024_05.pdf</td>
                            <td>15/05/2024</td>
                            <td><a href="#" class="btn-action ver"><i class="fa-solid fa-download"></i> Descarregar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    function switchTab(btn, index) {
        document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
        document.querySelectorAll(".tab-content").forEach(c => c.classList.remove("active"));
        btn.classList.add("active");
        document.querySelectorAll(".tab-content")[index].classList.add("active");
    }
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
