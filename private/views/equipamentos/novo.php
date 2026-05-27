<?php
// =====================================================
// MedControl – Novo Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Novo Equipamento';
$paginaAtiva  = 'equipamentos';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<style>
    .step-indicator {
        display: flex;
        gap: 8px;
        margin-bottom: 28px;
        justify-content: space-between;
    }

    .step {
        flex: 1;
        padding: 12px 16px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 8px;
        text-align: center;
        font-size: 0.82em;
        font-weight: 600;
        color: var(--text-muted);
        cursor: pointer;
        transition: all 0.2s;
    }

    .step.active {
        background: var(--primary);
        border-color: var(--primary-dark);
        color: white;
    }

    .step-section-title {
        font-size: 1em;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--border);
    }
</style>

<?php
$topbarTitulo    = '<i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px;"></i>Novo Equipamento';
$topbarSubtitulo = 'Registar um novo equipamento no inventário';
$topbarAcao      = '<a href="' . APP_BASE . '/private/views/equipamentos/lista.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar à lista</a>';
include __DIR__ . '/../../includes/nav.php';
?>

<!-- ─── CONTEÚDO ─── -->
<div class="page">
    <div class="content-box">

        <!-- Indicador de passos -->
        <div class="step-indicator">
            <div class="step active" onclick="goToStep(0)">1. Identificação</div>
            <div class="step" onclick="goToStep(1)">2. Dados Técnicos</div>
            <div class="step" onclick="goToStep(2)">3. Garantia</div>
            <div class="step" onclick="goToStep(3)">4. Fornecedores</div>
        </div>

        <form id="novoForm" method="POST" action="">

            <!-- Passo 1 – Identificação -->
            <div class="tab-content active" id="step0">
                <p class="step-section-title"><i class="fa-solid fa-tag"></i> Identificação do Equipamento</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Código Único *</label>
                        <input type="text" name="codigo" required placeholder="EQ-XXX">
                    </div>
                    <div class="form-group">
                        <label>Nome *</label>
                        <input type="text" name="nome" required placeholder="Nome do equipamento">
                    </div>
                    <div class="form-group">
                        <label>Marca *</label>
                        <input type="text" name="marca" required placeholder="Marca">
                    </div>
                    <div class="form-group">
                        <label>Modelo *</label>
                        <input type="text" name="modelo" required placeholder="Modelo">
                    </div>
                    <div class="form-group">
                        <label>Número de Série *</label>
                        <input type="text" name="serie" required placeholder="Número de série">
                    </div>
                    <div class="form-group">
                        <label>Localização *</label>
                        <select name="localizacao" required>
                            <option value="">--- Seleccione ---</option>
                            <option>Bloco Operatório A</option>
                            <option>UCI</option>
                            <option>Radiologia</option>
                            <option>Laboratório Central</option>
                            <option>Fisioterapia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado *</label>
                        <select name="estado" required>
                            <option value="">--- Seleccione ---</option>
                            <option>Ativo</option>
                            <option>Em Manutencao</option>
                            <option>Avariado</option>
                            <option>Abatido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Criticidade *</label>
                        <select name="criticidade" required>
                            <option value="">--- Seleccione ---</option>
                            <option>Alta</option>
                            <option>Media</option>
                            <option>Baixa</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Passo 2 – Dados Técnicos -->
            <div class="tab-content" id="step1">
                <p class="step-section-title"><i class="fa-solid fa-microchip"></i> Dados Técnicos</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tensão de Alimentação</label>
                        <input type="text" name="tensao" placeholder="Ex: 220V ~ 50Hz">
                    </div>
                    <div class="form-group">
                        <label>Potência</label>
                        <input type="text" name="potencia" placeholder="Ex: 500W">
                    </div>
                    <div class="form-group">
                        <label>Peso</label>
                        <input type="text" name="peso" placeholder="Ex: 28.5 kg">
                    </div>
                    <div class="form-group">
                        <label>Dimensões</label>
                        <input type="text" name="dimensoes" placeholder="Ex: 65cm × 45cm × 120cm">
                    </div>
                    <div class="form-group full">
                        <label>Observações Técnicas</label>
                        <textarea name="observacoes" placeholder="Informações técnicas adicionais..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Passo 3 – Garantia -->
            <div class="tab-content" id="step2">
                <p class="step-section-title"><i class="fa-solid fa-file-contract"></i> Informações de Garantia</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Data de Início *</label>
                        <input type="date" name="dataInicio" required>
                    </div>
                    <div class="form-group">
                        <label>Data de Fim *</label>
                        <input type="date" name="dataFim" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Garantia</label>
                        <select name="tipoGarantia">
                            <option value="">--- Seleccione ---</option>
                            <option>Completa</option>
                            <option>Limitada</option>
                            <option>Fabricante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Condições</label>
                        <input type="text" name="condicoes" placeholder="Ex: Cobre peças e mão de obra">
                    </div>
                </div>
            </div>

            <!-- Passo 4 – Fornecedores -->
            <div class="tab-content" id="step3">
                <p class="step-section-title"><i class="fa-solid fa-truck-medical"></i> Fornecedores Associados</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Fabricante</label>
                        <select name="fabricante">
                            <option value="">--- Seleccione ---</option>
                            <option>Siemens Healthineers</option>
                            <option>Philips Healthcare</option>
                            <option>MedTech Portugal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distribuidor</label>
                        <input type="text" name="distribuidor" placeholder="Nome do distribuidor">
                    </div>
                    <div class="form-group">
                        <label>Assistência Técnica</label>
                        <input type="text" name="assistencia" placeholder="Nome da assistência técnica">
                    </div>
                </div>
            </div>

            <!-- Botões de navegação -->
            <div class="form-actions" style="justify-content:space-between;">
                <button type="button" class="btn btn-secondary" onclick="goToPreviousStep()">
                    <i class="fa-solid fa-arrow-left"></i> Anterior
                </button>
                <div style="display:flex;gap:8px;">
                    <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php" class="btn btn-secondary">
                        <i class="fa-solid fa-xmark"></i> Cancelar
                    </a>
                    <button type="button" class="btn btn-primary" id="btnProximo" onclick="goToNextStep()">
                        Próximo <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit" style="display:none;">
                        <i class="fa-solid fa-check"></i> Guardar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    let currentStep = 0;
    const totalSteps = 4;

    function goToStep(step) {
        currentStep = step;
        updateSteps();
    }

    function goToNextStep() {
        if (currentStep < totalSteps - 1) { currentStep++; updateSteps(); }
    }

    function goToPreviousStep() {
        if (currentStep > 0) { currentStep--; updateSteps(); }
    }

    function updateSteps() {
        document.querySelectorAll(".tab-content").forEach(el => el.classList.remove("active"));
        document.querySelectorAll(".step").forEach(el => el.classList.remove("active"));
        document.getElementById("step" + currentStep).classList.add("active");
        document.querySelectorAll(".step")[currentStep].classList.add("active");
        document.getElementById("btnProximo").style.display = currentStep === totalSteps - 1 ? "none" : "inline-flex";
        document.getElementById("btnSubmit").style.display  = currentStep === totalSteps - 1 ? "inline-flex" : "none";
    }

    document.getElementById("novoForm").addEventListener("submit", (e) => {
        e.preventDefault();
        showNotification("Equipamento registado com sucesso!", "success");
        setTimeout(() => { window.location.href = "lista.php"; }, 1500);
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
