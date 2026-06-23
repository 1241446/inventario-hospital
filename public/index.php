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
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="MedControl — Plataforma de gestão de inventário hospitalar. Controlo total de equipamentos médicos, fornecedores, garantias e documentação.">
    <title><?= APP_NAME ?> — Gestão de Inventário Hospitalar</title>
    <link rel="icon" type="image/svg+xml" href="<?= APP_BASE ?>/assets/favicon.svg">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
    <style>
        .hero-home {
            background: linear-gradient(135deg, #0a2540 0%, #0d3d5c 60%, #0a2540 100%);
            padding: 80px 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 50px;
        }
        .hero-home h1 { font-size: 2.8em; color: white; font-weight: 800; line-height: 1.2; margin-bottom: 20px; }
        .hero-home h1 span { color: #4fc3f7; }
        .hero-home p { color: #b0c4de; font-size: 1.1em; line-height: 1.8; margin-bottom: 30px; }
        .hero-home img { width: 100%; max-width: 500px; height: 340px; object-fit: cover; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.5); }
        .hero-btns { display: flex; gap: 15px; flex-wrap: wrap; }
        .btn-hero-primary { background: #4fc3f7; color: #0a2540; padding: 14px 32px; border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 1em; border: none; transition: background .2s; }
        .btn-hero-primary:hover { background: #81d4fa; color: #0a2540; }
        .btn-hero-outline { border: 2px solid rgba(255,255,255,0.4); color: white; padding: 13px 30px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 1em; transition: all .2s; }
        .btn-hero-outline:hover { border-color: #4fc3f7; color: #4fc3f7; }
        .trust-bar { background: #061e33; padding: 14px 60px; display: flex; gap: 40px; align-items: center; flex-wrap: wrap; }
        .trust-item { display: flex; align-items: center; gap: 10px; color: #b0c4de; font-size: 0.88em; }
        .trust-item i { color: #4fc3f7; font-size: 1em; }
        .cta-section { background: linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding: 70px 40px; text-align: center; }
        .cta-section h2 { color: white; font-size: 1.9em; margin-bottom: 12px; }
        .cta-section p { color: #b0c4de; margin-bottom: 30px; font-size: 1.05em; }
        .cta-btns { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        @media (max-width: 768px) {
            .hero-home { grid-template-columns: 1fr; padding: 50px 24px; }
            .hero-home img { display: none; }
            .hero-home h1 { font-size: 2em; }
            .trust-bar { padding: 14px 24px; gap: 20px; }
        }
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

<!-- Hero -->
<div class="hero-home">
    <div>
        <h1>Gestão Inteligente do<br><span>Inventário Hospitalar</span></h1>
        <p>Desenvolvemos soluções web especializadas para a gestão centralizada de equipamentos médicos, garantindo rastreabilidade, segurança e eficiência operacional em instituições de saúde.</p>
        <div class="hero-btns">
            <a href="<?= APP_BASE ?>/public/solucao.php" class="btn-hero-primary">
                <i class="fa-solid fa-circle-play" style="margin-right:8px;"></i>Ver a Solução
            </a>
            <a href="<?= APP_BASE ?>/public/contacto.php" class="btn-hero-outline">
                <i class="fa-solid fa-envelope" style="margin-right:8px;"></i>Contacte-nos
            </a>
        </div>
    </div>
    <div style="display:flex; justify-content:center;">
        <img src="<?= APP_BASE ?>/assets/img/hospital.jpg" alt="Hospital moderno com equipamentos médicos">
    </div>
</div>

<!-- Barra de confiança -->
<div class="trust-bar">
    <div class="trust-item"><i class="fa-solid fa-circle-check"></i> Mais de 50 hospitais parceiros</div>
    <div class="trust-item"><i class="fa-solid fa-circle-check"></i> Mais de 80 000 equipamentos geridos</div>
    <div class="trust-item"><i class="fa-solid fa-circle-check"></i> 99,9 % de disponibilidade</div>
    <div class="trust-item"><i class="fa-solid fa-circle-check"></i> 12 anos de experiência no setor</div>
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
                    <p>Muitos hospitais continuam a gerir o inventário com folhas de cálculo isoladas e pastas físicas sem integração, dificultando o acesso à informação atualizada.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <h3>Falta de Rastreabilidade</h3>
                    <p>Sem um sistema centralizado, é impossível conhecer em tempo real a localização, o estado e o histórico de cada equipamento médico.</p>
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

<!-- Notícias em Destaque (carregadas da BD) -->
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
                    <p style="color:#7f8c8d; font-size:0.9em; margin-top:10px;"><?= htmlspecialchars($n->resumo) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- CTA -->
<div class="cta-section">
    <h2>Pronto para transformar a gestão do seu hospital?</h2>
    <p>Contacte-nos hoje e agende uma demonstração gratuita da plataforma MedControl.</p>
    <div class="cta-btns">
        <a href="<?= APP_BASE ?>/public/contacto.php" class="btn btn-primary" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-envelope me-2"></i>Pedir Demonstração
        </a>
        <a href="<?= APP_BASE ?>/public/login.php" class="btn btn-outline-light" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-right-to-bracket me-2"></i>Entrar na Plataforma
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
