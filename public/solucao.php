<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Solução | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bng-navbar sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="<?= APP_BASE ?>/public/index.php">
            <i class="fa-solid fa-hospital-user" style="color:#4fc3f7; font-size:1.4em; margin-right:8px;"></i>
            Med<span>Control</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-label="Abrir menu">
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

<div class="hero-section" style="padding:70px 40px;">
    <h1>A Nossa <span>Solução</span></h1>
    <p>O sistema MedControl é uma plataforma web de apoio ao inventário hospitalar, desenhado especificamente para as necessidades das instituições de saúde modernas.</p>
</div>

<h2 class="section-title">O Sistema MedControl</h2>
<div class="section-divider"></div>

<section class="container-texto-generico">
    <article>
        <div class="icon"><i class="fa-solid fa-layer-group"></i></div>
        <h2>Plataforma Integrada</h2>
        <p>Uma solução centralizada que reúne toda a informação sobre equipamentos médicos: localização, estado, fornecedores, documentação técnica e histórico de garantias.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-cloud"></i></div>
        <h2>Acesso via Web</h2>
        <p>Aceda ao sistema a partir de qualquer dispositivo com um navegador web, sem necessidade de instalação de software adicional. Disponível 24h/7d.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-shield-halved"></i></div>
        <h2>Segurança e Controlo</h2>
        <p>Sistema de autenticação com diferentes níveis de acesso, garantindo que cada utilizador vê apenas a informação relevante para a sua função.</p>
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
                    <p>Registo completo de cada equipamento com código único, marca, modelo, número de série, estado, criticidade e mais.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-map-location-dot"></i></div>
                    <h3>Módulo de Localizações</h3>
                    <p>Estruture a localização física dos equipamentos por edifício, piso, serviço e sala com rastreabilidade total.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-truck-medical"></i></div>
                    <h3>Módulo de Fornecedores</h3>
                    <p>Gerencie fabricantes, distribuidores e empresas de assistência técnica associando-os a cada equipamento.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-folder-open"></i></div>
                    <h3>Módulo de Documentação</h3>
                    <p>Armazene e consulte manuais técnicos, certificados de calibração, contratos e toda a documentação técnica.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-contract"></i></div>
                    <h3>Garantias e Contratos</h3>
                    <p>Controle datas de garantia, contratos de manutenção e alertas de expiração, evitando surpresas.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-chart-pie"></i></div>
                    <h3>Dashboard de Indicadores</h3>
                    <p>Visão sintética do parque tecnológico com métricas em tempo real para apoio à decisão técnica.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Arquitetura -->
<div style="background:white; padding:60px 40px; text-align:center;">
    <h2 class="section-title" style="padding-top:0;">Arquitetura da Plataforma</h2>
    <div class="section-divider"></div>
    <div class="container">
        <div class="row justify-content-center g-4">
            <div class="col-md-4 text-center">
                <div style="background:#e3f2fd; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center; margin:0 auto 15px;">
                    <i class="fa-solid fa-display" style="font-size:2em; color:#1565c0;"></i>
                </div>
                <h3 style="color:#0a2540;">Front Office</h3>
                <p style="color:#666; font-size:0.9em;">Website institucional da empresa de software</p>
            </div>
            <div class="col-md-4 text-center">
                <div style="background:#e8f5e9; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center; margin:0 auto 15px;">
                    <i class="fa-solid fa-lock" style="font-size:2em; color:#2e7d32;"></i>
                </div>
                <h3 style="color:#0a2540;">Autenticação</h3>
                <p style="color:#666; font-size:0.9em;">Login seguro para acesso ao Back Office</p>
            </div>
            <div class="col-md-4 text-center">
                <div style="background:#fff3e0; border-radius:50%; width:80px; height:80px; display:flex; align-items:center; justify-content:center; margin:0 auto 15px;">
                    <i class="fa-solid fa-gears" style="font-size:2em; color:#e65100;"></i>
                </div>
                <h3 style="color:#0a2540;">Back Office</h3>
                <p style="color:#666; font-size:0.9em;">Aplicação de gestão do inventário hospitalar</p>
            </div>
        </div>
    </div>
</div>

<footer class="footer-container">
    <div class="footer-section">
        <strong><i class="fa-solid fa-hospital-user"></i> MedControl</strong>
        <p>Sistemas de Informação Hospitalar, Lda.</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-location-dot"></i> Localização</strong>
        <p>Rua do Hospital Escolar, 123<br>4200-072, Porto<br>Portugal</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-clock"></i> Horário</strong>
        <p>2ª a 6ª Feira: 9h — 18h</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-address-book"></i> Contactos</strong>
        <p><a href="mailto:geral@MedControl.pt">geral@MedControl.pt</a><br>+351 220 xxx xxx</p>
    </div>
</footer>
<div class="footer-bottom">
    <?= APP_COPYRIGHT ?>
</div>

<script src="<?= APP_BASE ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
