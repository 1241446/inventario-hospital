<?php
// =====================================================
// MedControl – Gestão de Conteúdos Front Office
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$tituloPagina = 'Conteúdos';
$paginaAtiva  = 'conteudos';
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/sidebar.php'; ?>

<style>
    .content-card {
        background: var(--bg);
        border-radius: 8px;
        padding: 18px 20px;
        border-left: 4px solid var(--primary);
        margin-bottom: 14px;
    }

    .content-card h4 {
        font-size: 0.92em;
        font-weight: 700;
        color: var(--text);
        margin-bottom: 6px;
    }

    .content-card p {
        font-size: 0.84em;
        color: var(--text-muted);
        line-height: 1.5;
        margin-bottom: 4px;
    }

    .content-card small {
        font-size: 0.76em;
        color: var(--text-muted);
    }

    .card-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
    }

    .stat-mini-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .stat-mini {
        background: var(--surface);
        border-radius: var(--radius);
        padding: 18px;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        border-left: 4px solid var(--primary);
    }

    .stat-mini-value { font-size: 1.6em; font-weight: 800; color: var(--primary); }
    .stat-mini-label { font-size: 0.78em; color: var(--text-muted); margin-top: 2px; }

    @media (max-width: 900px) { .stat-mini-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<?php
$topbarTitulo    = '<i class="fa-solid fa-newspaper" style="color:var(--primary);margin-right:8px;"></i>Gestão de Conteúdos Front Office';
$topbarSubtitulo = 'Notícias, destaques, testemunhos e mensagens do website';
include __DIR__ . '/../../includes/nav.php';
?>

<div class="page">

    <div class="tab-buttons" style="margin-bottom:24px;">
        <button class="tab-btn active" onclick="switchTab(this,0)">Resumo</button>
        <button class="tab-btn" onclick="switchTab(this,1)">Notícias</button>
        <button class="tab-btn" onclick="switchTab(this,2)">Destaques</button>
        <button class="tab-btn" onclick="switchTab(this,3)">Testemunhos</button>
        <button class="tab-btn" onclick="switchTab(this,4)">Mensagens</button>
    </div>

    <!-- TAB 1: Resumo -->
    <div class="tab-content active">
        <div class="stat-mini-grid">
            <div class="stat-mini">
                <div class="stat-mini-value">12</div>
                <div class="stat-mini-label">Notícias Publicadas</div>
            </div>
            <div class="stat-mini" style="border-left-color:var(--success);">
                <div class="stat-mini-value" style="color:var(--success);">8</div>
                <div class="stat-mini-label">Destaques Ativos</div>
            </div>
            <div class="stat-mini" style="border-left-color:var(--warning);">
                <div class="stat-mini-value" style="color:var(--warning);">6</div>
                <div class="stat-mini-label">Testemunhos</div>
            </div>
            <div class="stat-mini" style="border-left-color:var(--danger);">
                <div class="stat-mini-value" style="color:var(--danger);">3</div>
                <div class="stat-mini-label">Mensagens de Contacto</div>
            </div>
        </div>

        <div class="content-box">
            <p style="color:var(--text-muted);line-height:1.8;font-size:0.9em;">
                Utilize as abas acima para gerir o conteúdo do website de front office do <strong><?= APP_NAME ?></strong>.
                Pode adicionar, editar ou apagar notícias, destaques, testemunhos de clientes e visualizar mensagens de contacto.
            </p>
        </div>
    </div>

    <!-- TAB 2: Notícias -->
    <div class="tab-content">
        <div style="margin-bottom:16px;">
            <button class="btn btn-primary" onclick="showNotification('Formulário em desenvolvimento', 'info')">
                <i class="fa-solid fa-plus"></i> Nova Notícia
            </button>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-newspaper" style="color:var(--primary);margin-right:6px;"></i>MedControl Apresenta Nova Versão</h4>
            <p>Lançamento da versão 3.0 com novas funcionalidades de análise avançada e melhorias de desempenho.</p>
            <small>Publicado em: 15/05/2025</small>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar notícia – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Notícia apagada!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-newspaper" style="color:var(--primary);margin-right:6px;"></i>Integração com Sistema ERP</h4>
            <p>Nova integração API permite sincronização automática com sistemas ERP hospitalares.</p>
            <small>Publicado em: 20/04/2025</small>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar notícia – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Notícia apagada!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>
    </div>

    <!-- TAB 3: Destaques -->
    <div class="tab-content">
        <div style="margin-bottom:16px;">
            <button class="btn btn-primary" onclick="showNotification('Formulário em desenvolvimento', 'info')">
                <i class="fa-solid fa-plus"></i> Novo Destaque
            </button>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-star" style="color:var(--primary);margin-right:6px;"></i>Solução Completa de Gestão</h4>
            <p>Da identificação ao acompanhamento, o MedControl oferece uma solução integrada para gestão de equipamentos.</p>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar destaque – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Destaque apagado!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-star" style="color:var(--primary);margin-right:6px;"></i>Suporte 24/7 Dedicado</h4>
            <p>Equipa técnica sempre disponível para resolver qualquer questão ou implementar customizações.</p>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar destaque – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Destaque apagado!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>
    </div>

    <!-- TAB 4: Testemunhos -->
    <div class="tab-content">
        <div style="margin-bottom:16px;">
            <button class="btn btn-primary" onclick="showNotification('Formulário em desenvolvimento', 'info')">
                <i class="fa-solid fa-plus"></i> Novo Testemunho
            </button>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-quote-left" style="color:var(--primary);margin-right:6px;"></i>Hospital de São João</h4>
            <p>"Desde que implementámos o MedControl, temos visibilidade total do nosso parque de equipamentos."</p>
            <small>Dr. Carlos Ferreira, Diretor de Tecnologia</small>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Testemunho apagado!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>

        <div class="content-card">
            <h4><i class="fa-solid fa-quote-left" style="color:var(--primary);margin-right:6px;"></i>Hospital da Luz</h4>
            <p>"O sistema é muito intuitivo. Os técnicos aprenderam a usar rapidamente."</p>
            <small>Eng. Paula Ribeiro, Gestora de Infraestruturas</small>
            <div class="card-actions">
                <button class="btn-action editar" onclick="showNotification('Editar – em desenvolvimento', 'info')"><i class="fa-solid fa-pen"></i> Editar</button>
                <button class="btn-action apagar" onclick="showNotification('Testemunho apagado!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>
    </div>

    <!-- TAB 5: Mensagens -->
    <div class="tab-content">
        <div class="content-card" style="border-left-color:var(--warning);">
            <h4><i class="fa-solid fa-envelope" style="color:var(--warning);margin-right:6px;"></i>Solicitação de Demo</h4>
            <p><strong>De:</strong> João Silva (joao@hospital.pt)</p>
            <p><strong>Assunto:</strong> Solicitar Demo</p>
            <p><strong>Mensagem:</strong> Gostaria de conhecer melhor o sistema MedControl. Podem agendar uma demonstração?</p>
            <small>Recebido em: 08/06/2025 · 14:30</small>
            <div class="card-actions">
                <button class="btn-action ver" onclick="showNotification('Função de resposta em desenvolvimento', 'info')"><i class="fa-solid fa-reply"></i> Responder</button>
                <button class="btn-action apagar" onclick="showNotification('Mensagem apagada!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
            </div>
        </div>

        <div class="content-card" style="border-left-color:var(--warning);">
            <h4><i class="fa-solid fa-envelope" style="color:var(--warning);margin-right:6px;"></i>Informações Comerciais</h4>
            <p><strong>De:</strong> Maria Costa (maria@hospital.net)</p>
            <p><strong>Assunto:</strong> Informações Gerais</p>
            <p><strong>Mensagem:</strong> Qual é o tempo de implementação típico do sistema?</p>
            <small>Recebido em: 07/06/2025 · 10:15</small>
            <div class="card-actions">
                <button class="btn-action ver" onclick="showNotification('Função de resposta em desenvolvimento', 'info')"><i class="fa-solid fa-reply"></i> Responder</button>
                <button class="btn-action apagar" onclick="showNotification('Mensagem apagada!', 'success')"><i class="fa-solid fa-trash"></i> Apagar</button>
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
