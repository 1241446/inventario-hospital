<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';

$noticias = [];
try {
    $pdo      = get_pdo();
    $noticias = $pdo->query("SELECT * FROM Noticia WHERE publicada = 1 AND destaque = 1 ORDER BY dataCriacao DESC LIMIT 3")->fetchAll(PDO::FETCH_OBJ);
    $pdo      = null;
} catch (PDOException $e) {
    $noticias = [];
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MedControl - Sistema de Gestão de Inventário Hospitalar. Controlo total de equipamentos médicos, fornecedores, garantias e documentação.">
    <title><?= APP_NAME ?> - Sistemas de Informação Hospitalar</title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
</head>
<body>

<!-- Navegação Bootstrap Responsiva -->
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
                <a href="<?= APP_BASE ?>/public/index.php" class="active">Quem Somos</a>
                <a href="<?= APP_BASE ?>/public/solucao.php">A Solução</a>
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

<!-- Hero Section -->
<div class="hero-section" style="display:grid; grid-template-columns:1fr 1fr; align-items:center; gap:40px; padding:60px; text-align:left;">
    <div>
        <h1 style="font-size:2.5em;">Gestão Inteligente do<br><span>Inventário Hospitalar</span></h1>
        <p style="margin:20px 0;">Desenvolvemos soluções web especializadas para a gestão centralizada de equipamentos médicos, garantindo rastreabilidade, segurança e eficiência operacional em instituições de saúde.</p>
    </div>
    <!-- Imagem Hospital -->
    <div style="display:flex; justify-content:center; align-items:center;">
        <img src="../assets/img/hospital.jpg" alt="Hospital"
             style="width:100%; max-width:480px; height:320px; object-fit:cover; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,0.4);">
    </div>
</div>

<!-- Stats Bar -->
<div class="stats-bar">
    <div class="stat-item">
        <div class="number">+50</div>
        <div class="label">Hospitais Parceiros</div>
    </div>
    <div class="stat-item">
        <div class="number">+80 000</div>
        <div class="label">Equipamentos Geridos</div>
    </div>
    <div class="stat-item">
        <div class="number">99.9%</div>
        <div class="label">Disponibilidade</div>
    </div>
    <div class="stat-item">
        <div class="number">12</div>
        <div class="label">Anos de Experiência</div>
    </div>
</div>

<!-- Quem Somos -->
<h2 class="section-title">Quem Somos</h2>
<div class="section-divider"></div>
<p class="section-subtitle">Uma empresa portuguesa especializada em sistemas de informação para a área da saúde</p>

<section class="container-texto-generico">
    <article>
        <div class="icon"><i class="fa-solid fa-bullseye"></i></div>
        <h2>A Nossa Missão</h2>
        <p>Desenvolvemos soluções digitais inovadoras que transformam a gestão tecnológica hospitalar, permitindo que os profissionais de saúde se concentrem no que verdadeiramente importa: o cuidado ao doente.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-eye"></i></div>
        <h2>A Nossa Visão</h2>
        <p>Ser a referência nacional em sistemas de informação para gestão de tecnologia em saúde, contribuindo para hospitais mais eficientes, seguros e preparados para o futuro digital.</p>
    </article>
    <article>
        <div class="icon"><i class="fa-solid fa-handshake"></i></div>
        <h2>Os Nossos Valores</h2>
        <p>Rigor técnico, inovação contínua, proximidade com o cliente e compromisso com a qualidade são os pilares que orientam cada projeto que desenvolvemos.</p>
    </article>
</section>

<!-- O Problema que Resolvemos -->
<div class="feature-section">
    <h2 class="section-title" style="padding-top:0;">O Problema que Resolvemos</h2>
    <div class="section-divider"></div>
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-excel"></i></div>
                    <h3>Gestão Dispersa</h3>
                    <p>Muitos hospitais continuam a gerir o inventário com folhas de Excel, documentos isolados e pastas físicas sem integração, dificultando o acesso à informação.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <h3>Falta de Rastreabilidade</h3>
                    <p>Sem um sistema centralizado, torna-se impossível conhecer em tempo real a localização, o estado e o histórico de cada equipamento médico.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-file-circle-xmark"></i></div>
                    <h3>Fragilidade Documental</h3>
                    <p>A documentação técnica dispersa compromete a resposta a auditorias e processos de certificação da qualidade, expondo o hospital a riscos desnecessários.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tecnologias -->
<div class="tech-section">
    <h2 class="section-title">Tecnologias Utilizadas</h2>
    <div class="section-divider" style="background:linear-gradient(to right, #4fc3f7, #81d4fa);"></div>
    <p style="color:#b0c4de; margin-bottom:30px;">As nossas soluções são desenvolvidas com tecnologias modernas, abertas e escaláveis</p>
    <div>
        <span class="tech-badge"><i class="fa-brands fa-html5"></i> HTML5</span>
        <span class="tech-badge"><i class="fa-brands fa-css3-alt"></i> CSS3</span>
        <span class="tech-badge"><i class="fa-brands fa-js"></i> JavaScript</span>
        <span class="tech-badge"><i class="fa-brands fa-bootstrap"></i> Bootstrap 5</span>
        <span class="tech-badge"><i class="fa-solid fa-server"></i> PHP</span>
        <span class="tech-badge"><i class="fa-solid fa-database"></i> MySQL</span>
    </div>
</div>

<!-- Notícias em Destaque (carregadas da BD via gestao.php) -->
<?php if (!empty($noticias)): ?>
<div style="background:#f8f9fa; padding:60px 40px;">
    <h2 class="section-title" style="padding-top:0;">Últimas Notícias</h2>
    <div class="section-divider"></div>
    <div class="container" style="margin-top:30px;">
        <div class="row g-4 justify-content-center">
            <?php foreach ($noticias as $n): ?>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card" style="height:100%; text-align:left;">
                    <div style="margin-bottom:12px;">
                        <span style="background:#e3f2fd; color:#1565c0; padding:4px 10px; border-radius:20px; font-size:0.8em; font-weight:600;">
                            <i class="fa-solid fa-newspaper me-1"></i>Destaque
                        </span>
                    </div>
                    <h3 style="font-size:1.05em;"><?= htmlspecialchars($n->titulo) ?></h3>
                    <p style="color:#7f8c8d; font-size:0.9em; margin-top:10px;">
                        <?= htmlspecialchars($n->resumo) ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Rodapé -->
<footer class="footer-container">
    <div class="footer-section">
        <strong><i class="fa-solid fa-hospital-user"></i> MedControl</strong>
        <p>Sistemas de Informação Hospitalar, Lda.<br>Especialistas em gestão digital de tecnologia médica.</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-location-dot"></i> Localização</strong>
        <p>Rua do Hospital Escolar, 123<br>4200-072, Porto<br>Portugal</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-clock"></i> Horário</strong>
        <p>2ª a 6ª Feira: 9h — 18h<br>Sábado e Feriados: Encerrado</p>
    </div>
    <div class="footer-section">
        <strong><i class="fa-solid fa-address-book"></i> Contactos</strong>
        <p><a href="mailto:geral@MedControl.pt">geral@MedControl.pt</a><br>+351 220 xxx xxx<br><a href="https://www.MedControl.pt">www.MedControl.pt</a></p>
    </div>
</footer>
<div class="footer-bottom">
    <?= APP_COPYRIGHT ?> Todos os direitos reservados.
</div>

<script src="<?= APP_BASE ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
