<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Solução MedControl — Plataforma integrada para gestão de inventário hospitalar com rastreabilidade e controlo de garantias em tempo real.">
    <title>A Solução | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
    <style>
        .arch-row { display: flex; align-items: center; justify-content: center; gap: 20px; flex-wrap: wrap; margin-top: 40px; }
        .arch-card { text-align: center; padding: 30px 24px; border-radius: 14px; flex: 1; min-width: 200px; max-width: 260px; }
        .arch-card .icon-circle { width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; }
        .arch-card h3 { font-size: 1.1em; margin-bottom: 8px; color: #0a2540; }
        .arch-card p { color: #666; font-size: 0.88em; line-height: 1.5; }
        .arch-arrow { font-size: 2em; color: #4fc3f7; flex-shrink: 0; }
        .cta-section { background: linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding: 70px 40px; text-align: center; }
        .cta-section h2 { color: white; font-size: 1.9em; margin-bottom: 12px; }
        .cta-section p { color: #b0c4de; margin-bottom: 30px; font-size: 1.05em; }
        @media (max-width: 768px) { .arch-arrow { transform: rotate(90deg); } }
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
                <a href="<?= APP_BASE ?>/public/solucao.php" class="active">A Solução</a>
                <a href="<?= APP_BASE ?>/public/funcionalidades.php">Funcionalidades</a>
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
    <h1>A Nossa <span>Solução</span></h1>
    <p>O MedControl é uma plataforma web completa desenhada especificamente para a gestão centralizada do inventário tecnológico em instituições hospitalares.</p>
</div>

<h2 class="section-title">O Sistema MedControl</h2>
<div class="section-divider"></div>

<section class="container-texto-generico">
    <article>
        <div class="icon"><i class="fa-solid fa-layer-group"></i></div>
        <h2>Plataforma Integrada</h2>
        <p>Uma solução centralizada que reúne toda a informação sobre equipamentos médicos: localização, estado, fornecedores, documentação técnica e histórico de garantias num único sistema.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-cloud"></i></div>
        <h2>Acesso via Web</h2>
        <p>Aceda ao sistema a partir de qualquer dispositivo com um navegador web, sem necessidade de instalação de software adicional. Disponível 24 horas por dia, todos os dias.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h2>Segurança e Controlo</h2>
        <p>Autenticação com diferentes perfis de acesso, garantindo que cada utilizador consulta e altera apenas a informação relevante para a sua função.</p>
    </article>
</section>

<!-- Módulos -->
<div class="feature-section">
    <h2 class="section-title" style="padding-top:0;">Módulos do Sistema</h2>
    <div class="section-divider"></div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-stethoscope"></i></div>
                    <h3>Módulo de Equipamentos</h3>
                    <p>Registo completo de cada equipamento com código único, marca, modelo, número de série, estado, criticidade e localização física.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-map-location-dot"></i></div>
                    <h3>Módulo de Localizações</h3>
                    <p>Organize a localização dos equipamentos por edifício, piso, serviço e sala com rastreabilidade total e histórico de movimentos.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-truck-medical"></i></div>
                    <h3>Módulo de Fornecedores</h3>
                    <p>Gira fabricantes, distribuidores e empresas de assistência técnica, associando cada fornecedor aos equipamentos correspondentes.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-folder-open"></i></div>
                    <h3>Módulo de Documentação</h3>
                    <p>Centralize manuais técnicos, certificados de calibração, contratos e toda a documentação associada a cada equipamento.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-contract"></i></div>
                    <h3>Garantias e Contratos</h3>
                    <p>Controle datas de garantia e contratos de manutenção com indicadores visuais de expiração para evitar situações críticas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-chart-pie"></i></div>
                    <h3>Painel de Indicadores</h3>
                    <p>Visão resumida do parque tecnológico com métricas em tempo real para apoio à decisão técnica e de gestão.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Arquitetura -->
<div style="background:white; padding:60px 40px; text-align:center;">
    <h2 class="section-title" style="padding-top:0;">Arquitetura da Plataforma</h2>
    <div class="section-divider"></div>
    <p style="color:#666; max-width:650px; margin:0 auto 20px;">A plataforma está dividida em duas áreas distintas: a área pública institucional e a área reservada de gestão.</p>

    <div class="arch-row">
        <div class="arch-card" style="background:#e3f2fd;">
            <div class="icon-circle" style="background:#bbdefb;">
                <i class="fa-solid fa-globe" style="font-size:2em; color:#1565c0;"></i>
            </div>
            <h3>Área Pública</h3>
            <p>Website institucional com informação sobre a empresa, solução, funcionalidades e formulário de contacto.</p>
        </div>

        <div class="arch-arrow">
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="arch-card" style="background:#e8f5e9;">
            <div class="icon-circle" style="background:#c8e6c9;">
                <i class="fa-solid fa-lock" style="font-size:2em; color:#2e7d32;"></i>
            </div>
            <h3>Autenticação</h3>
            <p>Acesso protegido por credenciais únicas com verificação de perfil e controlo de sessão segura.</p>
        </div>

        <div class="arch-arrow">
            <i class="fa-solid fa-arrow-right"></i>
        </div>

        <div class="arch-card" style="background:#fff3e0;">
            <div class="icon-circle" style="background:#ffe0b2;">
                <i class="fa-solid fa-gears" style="font-size:2em; color:#e65100;"></i>
            </div>
            <h3>Área Reservada</h3>
            <p>Aplicação completa de gestão do inventário hospitalar, com módulos de equipamentos, garantias, fornecedores e documentação.</p>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta-section">
    <h2>Interessado em saber mais?</h2>
    <p>Contacte-nos hoje e descubra como o MedControl pode melhorar a eficiência da sua instituição.</p>
    <div style="display:flex; gap:15px; justify-content:center; flex-wrap:wrap;">
        <a href="<?= APP_BASE ?>/public/contacto.php" class="btn btn-primary" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-envelope me-2"></i>Pedir Demonstração
        </a>
        <a href="<?= APP_BASE ?>/public/funcionalidades.php" class="btn btn-outline-light" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-list-check me-2"></i>Ver Funcionalidades
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
</body>
</html>
