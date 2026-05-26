<?php
// =====================================================
// MedControl – Novo / Editar Fornecedor
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Novo Fornecedor';
$paginaAtiva  = 'fornecedores';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<?php
$topbarTitulo    = '<i class="fa-solid fa-plus" style="color:var(--primary);margin-right:8px;"></i>Novo Fornecedor';
$topbarSubtitulo = 'Registar um novo fornecedor ou parceiro';
$topbarAcao      = '<a href="' . APP_BASE . '/private/views/fornecedores/lista.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Voltar</a>';
include __DIR__ . '/../../includes/nav.php';
?>

<div class="page">
    <div class="content-box">
        <form id="novoFornecedorForm" method="POST" action="">

            <div class="form-grid">
                <div class="form-group">
                    <label>Nome da Empresa *</label>
                    <input type="text" name="nomeEmpresa" required placeholder="Ex: Siemens Healthineers">
                </div>
                <div class="form-group">
                    <label>NIF *</label>
                    <input type="text" name="nif" required placeholder="Ex: 500123456">
                </div>
                <div class="form-group">
                    <label>Tipo de Fornecedor *</label>
                    <select name="tipoFornecedor" required>
                        <option value="">--- Seleccione ---</option>
                        <option value="FABRICANTE">Fabricante</option>
                        <option value="DISTRIBUIDOR">Distribuidor</option>
                        <option value="FORNECEDOR">Fornecedor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>País</label>
                    <select name="idPais">
                        <option value="">--- Seleccione ---</option>
                        <option value="1">Portugal</option>
                        <option value="2">Alemanha</option>
                        <option value="3">Estados Unidos</option>
                        <option value="4">França</option>
                        <option value="5">Japão</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" name="website" placeholder="www.empresa.com">
                </div>
                <div class="form-group full">
                    <label>Morada *</label>
                    <input type="text" name="morada" required placeholder="Rua, número, cidade">
                </div>
            </div>

            <hr style="border:none;border-top:1px solid var(--border);margin:24px 0;">
            <p style="font-size:0.85em;font-weight:700;color:var(--text-muted);margin-bottom:16px;text-transform:uppercase;letter-spacing:0.05em;">
                <i class="fa-solid fa-address-card"></i> Contacto Principal
            </p>

            <div class="form-grid">
                <div class="form-group">
                    <label>Nome do Contacto</label>
                    <input type="text" name="nomeContacto" placeholder="Nome completo">
                </div>
                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" name="cargoContacto" placeholder="Ex: Diretor Comercial">
                </div>
                <div class="form-group">
                    <label>Telefone</label>
                    <input type="tel" name="telefoneContacto" placeholder="+351 2XX XXX XXX">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="emailContacto" required placeholder="email@empresa.com">
                </div>
                <div class="form-group full">
                    <label>Observações</label>
                    <textarea name="observacoes" placeholder="Notas adicionais sobre o fornecedor..."></textarea>
                </div>
            </div>

            <div class="form-actions">
                <a href="<?= APP_BASE ?>/private/views/fornecedores/lista.php" class="btn btn-secondary">
                    <i class="fa-solid fa-xmark"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-check"></i> Guardar Fornecedor
                </button>
            </div>
        </form>
    </div>
</div><!-- /page -->

<?php
$scriptsExtra = '
<script>
    document.getElementById("novoFornecedorForm").addEventListener("submit", (e) => {
        e.preventDefault();
        showNotification("Fornecedor registado com sucesso!", "success");
        setTimeout(() => { window.location.href = "lista.php"; }, 1500);
    });
</script>
';
?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
