<?php
// =====================================================
// MedControl – Detalhes do Fornecedor
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Detalhes do Fornecedor';
$paginaAtiva  = 'fornecedores';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<style>
    .info-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 16px 32px; }
    .info-group { display: flex; flex-direction: column; gap: 4px; }
    .info-label { font-size: 0.74em; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); }
    .info-value { font-size: 0.92em; font-weight: 500; color: var(--text); }
    @media (max-width: 700px) { .info-grid { grid-template-columns: 1fr; } }
</style>

<?php
$topbarTitulo    = '<i class="fa-solid fa-truck-medical" style="color:var(--primary);margin-right:8px;"></i>Siemens Healthineers';
$topbarSubtitulo = 'Fabricante · FORN-001';
$topbarAcao      = '<a href="' . APP_BASE . '/private/views/fornecedores/lista.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
    <a href="' . APP_BASE . '/private/views/fornecedores/novo.php?id=1" class="btn btn-primary"><i class="fa-solid fa-pen"></i> Editar</a>';
include __DIR__ . '/../../includes/nav.php';
?>

<div class="page">

    <div class="tab-buttons" style="margin-bottom:24px;">
        <button class="tab-btn active" onclick="switchTab(this,0)">Informações Gerais</button>
        <button class="tab-btn" onclick="switchTab(this,1)">Contacto</button>
        <button class="tab-btn" onclick="switchTab(this,2)">Equipamentos Associados</button>
    </div>

    <!-- TAB 1: Informações Gerais -->
    <div class="tab-content active content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Nome da Empresa</div>
                <div class="info-value">Siemens Healthineers</div>
            </div>
            <div class="info-group">
                <div class="info-label">NIF</div>
                <div class="info-value">500123456</div>
            </div>
            <div class="info-group">
                <div class="info-label">Tipo</div>
                <div class="info-value"><span class="badge badge-primary">Fabricante</span></div>
            </div>
            <div class="info-group">
                <div class="info-label">País</div>
                <div class="info-value">Alemanha</div>
            </div>
            <div class="info-group">
                <div class="info-label">Website</div>
                <div class="info-value"><a href="https://www.siemens-healthineers.com" target="_blank" style="color:var(--primary);">www.siemens-healthineers.com</a></div>
            </div>
            <div class="info-group">
                <div class="info-label">Morada</div>
                <div class="info-value">Rua da Inovação 45, Lisboa</div>
            </div>
        </div>
    </div>

    <!-- TAB 2: Contacto -->
    <div class="tab-content content-box">
        <div class="info-grid">
            <div class="info-group">
                <div class="info-label">Nome do Contacto</div>
                <div class="info-value">Hans Mueller</div>
            </div>
            <div class="info-group">
                <div class="info-label">Cargo</div>
                <div class="info-value">Diretor Comercial</div>
            </div>
            <div class="info-group">
                <div class="info-label">Telefone</div>
                <div class="info-value">+351 210 000 001</div>
            </div>
            <div class="info-group">
                <div class="info-label">Email</div>
                <div class="info-value"><a href="mailto:hmueller@siemens.com" style="color:var(--primary);">hmueller@siemens.com</a></div>
            </div>
        </div>
    </div>

    <!-- TAB 3: Equipamentos -->
    <div class="tab-content">
        <div class="table-box">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Equipamento</th>
                            <th>Estado</th>
                            <th>Localização</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EQ-001</td>
                            <td>Ressonância Magnética 3T</td>
                            <td><span class="badge badge-success">Ativo</span></td>
                            <td>Radiologia</td>
                        </tr>
                        <tr>
                            <td>EQ-004</td>
                            <td>Tomógrafo Computorizado</td>
                            <td><span class="badge badge-success">Ativo</span></td>
                            <td>Radiologia</td>
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
