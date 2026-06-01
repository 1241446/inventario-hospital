<?php
// =====================================================
// MedControl – Editar Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Editar Equipamento';
$paginaAtiva  = 'equipamentos';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<?php
$topbarTitulo    = '<i class="fa-solid fa-pen" style="color:var(--primary);margin-right:8px;"></i>Editar Equipamento – EQ-001';
$topbarSubtitulo = 'Alterar os dados do equipamento no inventário';
$topbarAcao      = '<a href="' . APP_BASE . '/private/views/equipamentos/lista.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar</a>';
include __DIR__ . '/../../includes/nav.php';
?>

<div class="page">
    <div class="content-box">

        <div class="tab-buttons">
            <button class="tab-btn active" onclick="switchTab(this,0)">Identificação</button>
            <button class="tab-btn" onclick="switchTab(this,1)">Dados Técnicos</button>
            <button class="tab-btn" onclick="switchTab(this,2)">Garantia</button>
            <button class="tab-btn" onclick="switchTab(this,3)">Fornecedores</button>
        </div>

        <form id="editarForm" method="POST" action="">

            <!-- Identificação -->
            <div class="tab-content active">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Código Único *</label>
                        <input type="text" name="codigo" value="EQ-001" required>
                    </div>
                    <div class="form-group">
                        <label>Nome *</label>
                        <input type="text" name="nome" value="Ventilador Pulmonar" required>
                    </div>
                    <div class="form-group">
                        <label>Marca *</label>
                        <input type="text" name="marca" value="Siemens" required>
                    </div>
                    <div class="form-group">
                        <label>Modelo *</label>
                        <input type="text" name="modelo" value="SERVO-i" required>
                    </div>
                    <div class="form-group">
                        <label>Número de Série *</label>
                        <input type="text" name="serie" value="SN-2024-001547" required>
                    </div>
                    <div class="form-group">
                        <label>Localização *</label>
                        <select name="localizacao" required>
                            <option selected>UCI-01</option>
                            <option>UCI-02</option>
                            <option>Urgência</option>
                            <option>Bloco Operatório A</option>
                            <option>Radiologia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado *</label>
                        <select name="estado" required>
                            <option value="Ativo" selected>Ativo</option>
                            <option>Em Manutencao</option>
                            <option>Avariado</option>
                            <option>Abatido</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Criticidade *</label>
                        <select name="criticidade" required>
                            <option value="Alta" selected>Alta</option>
                            <option>Media</option>
                            <option>Baixa</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Dados Técnicos -->
            <div class="tab-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Tensão de Alimentação</label>
                        <input type="text" name="tensao" value="220V ~ 50Hz">
                    </div>
                    <div class="form-group">
                        <label>Potência</label>
                        <input type="text" name="potencia" value="500W">
                    </div>
                    <div class="form-group">
                        <label>Peso</label>
                        <input type="text" name="peso" value="28.5 kg">
                    </div>
                    <div class="form-group">
                        <label>Dimensões</label>
                        <input type="text" name="dimensoes" value="65cm × 45cm × 120cm">
                    </div>
                </div>
            </div>

            <!-- Garantia -->
            <div class="tab-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Data de Início *</label>
                        <input type="date" name="dataInicio" value="2024-01-15" required>
                    </div>
                    <div class="form-group">
                        <label>Data de Fim *</label>
                        <input type="date" name="dataFim" value="2027-01-15" required>
                    </div>
                    <div class="form-group">
                        <label>Tipo de Garantia</label>
                        <select name="tipoGarantia">
                            <option value="Fabricante" selected>Fabricante</option>
                            <option>Completa</option>
                            <option>Limitada</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Fornecedores -->
            <div class="tab-content">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Fabricante</label>
                        <select name="fabricante">
                            <option value="Siemens Healthineers" selected>Siemens Healthineers</option>
                            <option>Philips Healthcare</option>
                            <option>MedTech Portugal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Distribuidor</label>
                        <input type="text" name="distribuidor" value="MedTech Ibérica">
                    </div>
                    <div class="form-group">
                        <label>Assistência Técnica</label>
                        <input type="text" name="assistencia" value="Siemens Service Center">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Guardar Alterações
                </button>
            </div>
        </form>
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

    document.getElementById("editarForm").addEventListener("submit", (e) => {
        e.preventDefault();
        showNotification("Equipamento actualizado com sucesso!", "success");
        setTimeout(() => { window.location.href = "lista.php"; }, 1500);
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
