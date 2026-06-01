<?php require_once __DIR__ . '/../config/config.php'; ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
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
                <a href="<?= APP_BASE ?>/public/solucao.php">A Solução</a>
                <a href="<?= APP_BASE ?>/public/funcionalidades.php">Funcionalidades</a>
                <a href="<?= APP_BASE ?>/public/clientes.php" class="active">Clientes</a>
                <a href="<?= APP_BASE ?>/public/contacto.php">Contacto</a>
            </div>
            <div class="nav-cliente">
                <a href="<?= APP_BASE ?>/public/login.php"><i class="fa-solid fa-right-to-bracket"></i> Área Restrita</a>
            </div>
        </div>
    </div>
</nav>

<div class="hero-section" style="padding:70px 40px;">
    <h1>Nossos <span>Clientes</span></h1>
    <p>Hospitais e instituições de saúde que confiam no MedControl para otimizar a sua gestão tecnológica.</p>
</div>

<!-- Hospitais Clientes -->
<h2 class="section-title">Hospitais Parceiros</h2>
<div class="section-divider"></div>

<div class="container" style="padding: 40px 20px;">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Hospital de São João
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Porto, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 8.500+</p>
                    <p><strong>Desde:</strong> 2015</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"O MedControl transformou completamente a nossa gestão de inventário. Conseguimos reduzir o tempo de localização de equipamentos em 80%."</em></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Hospital da Luz
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Lisboa, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 6.200+</p>
                    <p><strong>Desde:</strong> 2018</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"Excelente sistema! A rastreabilidade que agora temos é fundamental para a auditoria interna."</em></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Centro Hospitalar Covilhã
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Covilhã, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 4.800+</p>
                    <p><strong>Desde:</strong> 2019</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"Suporte técnico excelente. Responsivos e sempre disponíveis para ajudar."</em></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Hospital Amélia Lemos
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Esmoriz, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 3.100+</p>
                    <p><strong>Desde:</strong> 2020</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"Interface intuitiva, mesmo o pessoal menos familiarizado com tecnologia usa facilmente."</em></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Hospital de Braga
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Braga, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 5.600+</p>
                    <p><strong>Desde:</strong> 2021</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"Relatórios detalhados ajudaram-nos a otimizar a manutenção preventiva."</em></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital" style="margin-right: 10px;"></i>
                    Santa Casa Misericórdia
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Viseu, Portugal</p>
                    <p><strong>Equipamentos Geridos:</strong> 2.900+</p>
                    <p><strong>Desde:</strong> 2022</p>
                    <p style="margin-top: 15px; color: #7f8c8d;"><em>"ROI positivo no primeiro ano. Economia considerável em gestão de equipamentos."</em></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testemunhos -->
<div style="background: linear-gradient(135deg, var(--bg-dark) 0%, #0d3d5c 100%); padding: 60px 40px; margin-top: 40px;">
    <h2 class="section-title" style="color: white; padding-top: 0;">O Que Dizem os Nossos Clientes</h2>
    <div class="section-divider"></div>

    <div class="container">
        <div class="row g-4" style="margin-top: 30px;">
            <div class="col-lg-6">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                    </div>
                    <p style="margin-bottom: 15px; color: #0a2540; font-size: 0.95em; line-height: 1.8;">"Desde que implementámos o MedControl, temos visibilidade total do nosso parque de equipamentos. Os relatórios automáticos ajudam-nos nas auditorias internas."</p>
                    <p style="color: #4fc3f7; font-weight: 700; margin: 0;">Dr. Carlos Ferreira, Diretor de Tecnologia<br><span style="font-size: 0.85em; color: #7f8c8d;">Hospital de São João</span></p>
                </div>
            </div>

            <div class="col-lg-6">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                    </div>
                    <p style="margin-bottom: 15px; color: #0a2540; font-size: 0.95em; line-height: 1.8;">"O sistema é muito intuitivo. Os técnicos aprenderam a usar rapidamente, sem necessidade de formação extensiva. Ganhos de produtividade imediatos."</p>
                    <p style="color: #4fc3f7; font-weight: 700; margin: 0;">Eng. Paula Ribeiro, Gestora de Infraestruturas<br><span style="font-size: 0.85em; color: #7f8c8d;">Hospital da Luz</span></p>
                </div>
            </div>

            <div class="col-lg-6">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                    </div>
                    <p style="margin-bottom: 15px; color: #0a2540; font-size: 0.95em; line-height: 1.8;">"Melhorou significativamente a gestão de garantias. Agora temos alertas automáticos e não perdemos nenhuma garantia por vencer."</p>
                    <p style="color: #4fc3f7; font-weight: 700; margin: 0;">Dra. Marta Silva, Responsável Compras<br><span style="font-size: 0.85em; color: #7f8c8d;">Centro Hospitalar Covilhã</span></p>
                </div>
            </div>

            <div class="col-lg-6">
                <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                        <i class="fa-solid fa-star" style="color: #ffc107;"></i>
                    </div>
                    <p style="margin-bottom: 15px; color: #0a2540; font-size: 0.95em; line-height: 1.8;">"O suporte pós-venda é excelente. Sempre que precisámos, a equipa do MedControl responde rapidamente com soluções."</p>
                    <p style="color: #4fc3f7; font-weight: 700; margin: 0;">Sr. João Neves, Coordenador Técnico<br><span style="font-size: 0.85em; color: #7f8c8d;">Hospital Amélia Lemos</span></p>
                </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
