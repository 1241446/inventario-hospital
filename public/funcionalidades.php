<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Funcionalidades MedControl — Gestão de equipamentos, localizações, fornecedores, garantias e documentação numa única plataforma hospitalar.">
    <title>Funcionalidades | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
    <style>
        .cta-section { background: linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding: 70px 40px; text-align: center; }
        .cta-section h2 { color: white; font-size: 1.9em; margin-bottom: 12px; }
        .cta-section p { color: #b0c4de; margin-bottom: 30px; font-size: 1.05em; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bng-navbar sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="<?= APP_BASE ?>/public/index.php">
            <i class="fa-solid fa-hospital-user" style="color:#4fc3f7; font-size:1.4em; margin-right:8px;"></i>
            Med<span>Control</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <div class="container-navegacao mx-auto">
                <a href="<?= APP_BASE ?>/public/index.php">Quem Somos</a>
                <a href="<?= APP_BASE ?>/public/solucao.php">A Solução</a>
                <a href="<?= APP_BASE ?>/public/funcionalidades.php" class="active">Funcionalidades</a>
                <a href="<?= APP_BASE ?>/public/clientes.php">Clientes</a>
                <a href="<?= APP_BASE ?>/public/contacto.php">Contacto</a>
            </div>
            <div class="nav-cliente">
                <a href="<?= APP_BASE ?>/public/login.php"><i class="fa-solid fa-right-to-bracket"></i> Área Restrita</a>
            </div>
        </div>
    </div>
</nav>

<div class="hero-section" style="padding:80px 40px;">
    <h1>Funcionalidades <span>Principais</span></h1>
    <p>Explore todas as capacidades do sistema MedControl concebido para otimizar a gestão do inventário tecnológico hospitalar.</p>
</div>

<h2 class="section-title">Perguntas Frequentes</h2>
<div class="section-divider"></div>

<div style="max-width:1000px; margin:0 auto; padding:40px 20px;">
    <div id="faqAccordion">
        <div class="accordion-item">
            <div class="accordion-header">
                <span>Como registar um novo equipamento?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Para registar um novo equipamento, aceda ao módulo de Equipamentos na área reservada, clique em "Novo Equipamento" e preencha os campos obrigatórios: código único, marca, modelo, número de série, localização física e dados técnicos. O sistema irá gerar um identificador único para rastreabilidade.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>É possível importar equipamentos em massa?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Sim. O sistema MedControl permite importar dados em massa através de ficheiro CSV. Basta seguir o modelo de importação fornecido e carregar o ficheiro na secção de Importação. O sistema valida automaticamente os dados antes de confirmar a importação.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Como consultar o histórico de um equipamento?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Aceda à página de Detalhes do equipamento e navegue até à secção de histórico. Aqui encontrará um registo completo de todas as ações efetuadas: alterações de localização, manutenções, reparações e alterações de estado.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Consigo ver quais as garantias que estão a expirar?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Certamente. A página de Garantias apresenta indicadores visuais para garantias próximas de expirar (30 dias) e já expiradas. Desta forma, tem sempre uma visão clara do estado das garantias de todo o parque tecnológico.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Como organizar os equipamentos por localização?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                O módulo de Localizações permite estruturar a instituição por edifícios, pisos, serviços e salas. Cada equipamento é associado a uma localização específica, permitindo rastreabilidade total e uma visão clara de onde se encontra cada item.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Posso exportar dados do inventário?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Sim. O sistema permite exportar listagens em formato CSV, compatível com o Microsoft Excel e outras folhas de cálculo. O ficheiro exportado inclui todos os campos do inventário, prontos para análise ou arquivo.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Como funciona o sistema de perfis de acesso?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                O MedControl suporta diferentes perfis de utilizador — Administrador, Gestor, Técnico e Consultor — cada um com diferentes níveis de acesso. O Administrador pode criar e gerir contas de utilizador e definir os perfis adequados à função de cada pessoa.
            </div>
        </div>

        <div class="accordion-item">
            <div class="accordion-header">
                <span>Como definir e consultar manutenções de equipamentos?</span>
                <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
            </div>
            <div class="accordion-body">
                Na ficha de cada equipamento é possível registar e consultar intervenções de manutenção, incluindo a data, o técnico responsável e as observações. O estado do equipamento reflete sempre a sua situação atual.
            </div>
        </div>
    </div>
</div>

<!-- Funcionalidades Principais -->
<div style="background:white; padding:60px 40px; margin-top:40px;">
    <h2 class="section-title" style="padding-top:0;">Funcionalidades Principais</h2>
    <div class="section-divider"></div>

    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-clipboard-list"></i></div>
                    <h3>Inventário Centralizado</h3>
                    <p>Registo detalhado de cada equipamento com código único, estado, localização física, fornecedor e documentação associada — tudo num único ponto de acesso.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-contract"></i></div>
                    <h3>Controlo de Garantias</h3>
                    <p>Acompanhamento visual do estado das garantias com alertas para equipamentos próximos da data de expiração ou já fora do período de garantia.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h3>Painel de Indicadores</h3>
                    <p>Visualize em tempo real os indicadores-chave do inventário: total de equipamentos, distribuição por estado, críticos e itens com garantia a expirar.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-pdf"></i></div>
                    <h3>Gestão de Documentação</h3>
                    <p>Centralize manuais técnicos, certificados, contratos e relatórios de calibração. Consulta organizada e rápida de toda a documentação por equipamento.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-lock"></i></div>
                    <h3>Controlo de Acessos</h3>
                    <p>Sistema de perfis de utilizador com diferentes níveis de permissão — do consultor ao administrador — garantindo segurança e responsabilização.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-building"></i></div>
                    <h3>Gestão Multi-Serviço</h3>
                    <p>Ideal para instituições com múltiplos edifícios e serviços. Gira todo o inventário a partir de um ponto centralizado com filtragem por localização.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <h2>Pronto para começar?</h2>
    <p>Entre em contacto connosco e agende uma demonstração personalizada da plataforma MedControl.</p>
    <div style="display:flex; gap:15px; justify-content:center; flex-wrap:wrap;">
        <a href="<?= APP_BASE ?>/public/contacto.php" class="btn btn-primary" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-envelope me-2"></i>Solicitar Demonstração
        </a>
        <a href="<?= APP_BASE ?>/public/clientes.php" class="btn btn-outline-light" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-star me-2"></i>Ver Casos de Sucesso
        </a>
    </div>
</div>

<footer class="footer-container">
    <div class="footer-section">
        <strong><i class="fa-solid fa-hospital-user"></i> MedControl</strong>
        <p>Sistemas de Informação Hospitalar, Lda.<br>Especialistas em gestão digital de tecnologia médica.</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-location-dot"></i> Localização</strong>
        <p>Rua do Hospital Escolar, 123<br>4200-072 Porto<br>Portugal</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-clock"></i> Horário</strong>
        <p>2.ª a 6.ª feira: 9h00 — 18h00<br>Sábados e feriados: encerrado</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-address-book"></i> Contactos</strong>
        <p><a href="mailto:geral@medcontrol.pt">geral@medcontrol.pt</a><br>+351 220 123 456</p>
    </div>
</footer>
<div class="footer-bottom">
    <?= APP_COPYRIGHT ?> Todos os direitos reservados.
</div>

<script src="<?= APP_BASE ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= APP_BASE ?>/assets/js/1241446.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        initializeAccordion('faqAccordion');
    });
</script>
</body>
</html>
