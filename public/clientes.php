<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';

$testemunhos = [];
try {
    $pdo = get_pdo();
    $testemunhos = $pdo->query("SELECT * FROM Testemunho ORDER BY idTestemunho DESC")->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
} catch (PDOException $e) {
    $testemunhos = [];
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Clientes MedControl — Hospitais e unidades de saúde que confiam no nosso sistema de gestão de inventário hospitalar.">
    <title>Clientes | <?= APP_NAME ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= APP_BASE ?>/assets/favicon.svg">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
    <style>
        .hospital-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.08); transition: transform .2s, box-shadow .2s; height: 100%; }
        .hospital-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.13); }
        .hospital-card .card-header { background: linear-gradient(135deg, #0a2540, #0d3d5c); color: white; padding: 18px 24px; font-weight: 600; font-size: 1.05em; display: flex; align-items: center; gap: 10px; }
        .hospital-card .card-header i { color: #4fc3f7; font-size: 1.2em; }
        .hospital-card .card-body { padding: 24px; }
        .hospital-card .card-body p { margin-bottom: 8px; font-size: 0.93em; color: #4a4a4a; }
        .hospital-card .card-body .quote { margin-top: 15px; color: #666; font-style: italic; border-left: 3px solid #4fc3f7; padding-left: 12px; line-height: 1.6; font-size: 0.9em; }
        .stat-bar { background: #061e33; padding: 20px 60px; display: flex; gap: 50px; align-items: center; justify-content: center; flex-wrap: wrap; }
        .stat-item { text-align: center; }
        .stat-item .num { font-size: 2em; font-weight: 800; color: #4fc3f7; line-height: 1; }
        .stat-item .lbl { font-size: 0.82em; color: #b0c4de; margin-top: 4px; }
        .cta-section { background: linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding: 70px 40px; text-align: center; }
        .cta-section h2 { color: white; font-size: 1.9em; margin-bottom: 12px; }
        .cta-section p { color: #b0c4de; margin-bottom: 30px; font-size: 1.05em; }
        @media (max-width: 768px) { .stat-bar { padding: 20px 24px; gap: 30px; } }
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

<div class="hero-section" style="padding:80px 40px;">
    <h1>Os Nossos <span>Clientes</span></h1>
    <p>Hospitais e instituições de saúde em todo o país que confiam no MedControl para gerir o seu inventário tecnológico.</p>
</div>

<!-- Estatísticas -->
<div class="stat-bar">
    <div class="stat-item">
        <div class="num">50+</div>
        <div class="lbl">Hospitais parceiros</div>
    </div>
    <div class="stat-item">
        <div class="num">80 000+</div>
        <div class="lbl">Equipamentos geridos</div>
    </div>
    <div class="stat-item">
        <div class="num">12</div>
        <div class="lbl">Anos de experiência</div>
    </div>
    <div class="stat-item">
        <div class="num">99,9 %</div>
        <div class="lbl">Disponibilidade</div>
    </div>
</div>

<!-- Hospitais Clientes -->
<h2 class="section-title">Hospitais Parceiros</h2>
<div class="section-divider"></div>

<div class="container" style="padding:40px 20px;">
    <div class="row g-4 justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Hospital de São João
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Porto, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 8 500+</p>
                    <p><strong>Cliente desde:</strong> 2015</p>
                    <p class="quote">"O MedControl transformou completamente a nossa gestão de inventário. Conseguimos reduzir o tempo de localização de equipamentos em 80 %."</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Hospital da Luz
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Lisboa, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 6 200+</p>
                    <p><strong>Cliente desde:</strong> 2018</p>
                    <p class="quote">"Excelente sistema! A rastreabilidade que agora temos é fundamental para a auditoria interna e acreditação hospitalar."</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Centro Hospitalar da Covilhã
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Covilhã, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 4 800+</p>
                    <p><strong>Cliente desde:</strong> 2019</p>
                    <p class="quote">"Suporte técnico excecional. Sempre disponíveis e prontos a ajudar de forma rápida e eficiente."</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Hospital Amélia Lemos
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Esmoriz, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 3 100+</p>
                    <p><strong>Cliente desde:</strong> 2020</p>
                    <p class="quote">"Interface intuitiva e acessível. Mesmo o pessoal menos familiarizado com tecnologia utiliza o sistema com facilidade."</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Hospital de Braga
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Braga, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 5 600+</p>
                    <p><strong>Cliente desde:</strong> 2021</p>
                    <p class="quote">"Os relatórios detalhados permitiram-nos melhorar significativamente o planeamento da manutenção preventiva."</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="hospital-card">
                <div class="card-header">
                    <i class="fa-solid fa-hospital"></i>Santa Casa da Misericórdia de Viseu
                </div>
                <div class="card-body">
                    <p><strong>Localização:</strong> Viseu, Portugal</p>
                    <p><strong>Equipamentos geridos:</strong> 2 900+</p>
                    <p><strong>Cliente desde:</strong> 2022</p>
                    <p class="quote">"Retorno positivo logo no primeiro ano. Poupança considerável na gestão e controlo dos equipamentos."</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testemunhos da BD -->
<?php if (!empty($testemunhos)): ?>
<div style="background:linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding:60px 40px; margin-top:40px;">
    <h2 class="section-title" style="color:white; padding-top:0;">O Que Dizem os Nossos Clientes</h2>
    <div class="section-divider"></div>
    <div class="container">
        <div class="row g-4" style="margin-top:30px;">
            <?php foreach ($testemunhos as $t): ?>
            <div class="col-lg-6">
                <div style="background:white; padding:30px; border-radius:12px; box-shadow:0 10px 30px rgba(0,0,0,0.2);">
                    <div style="display:flex; gap:6px; margin-bottom:15px;">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                        <i class="fa-solid fa-star" style="color:#ffc107;"></i>
                        <?php endfor; ?>
                    </div>
                    <p style="margin-bottom:15px; color:#0a2540; font-size:0.95em; line-height:1.8; font-style:italic;">
                        "<?= htmlspecialchars($t->texto) ?>"
                    </p>
                    <p style="color:#4fc3f7; font-weight:700; margin:0;">
                        <?= htmlspecialchars($t->nomeAutor) ?>, <?= htmlspecialchars($t->cargoAutor) ?><br>
                        <span style="font-size:0.85em; color:#7f8c8d;"><?= htmlspecialchars($t->nomeEmpresa) ?></span>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- CTA -->
<div class="cta-section">
    <h2>Junte-se às instituições que já confiam em nós</h2>
    <p>Entre em contacto para saber como o MedControl pode ser implementado na sua organização.</p>
    <div style="display:flex; gap:15px; justify-content:center; flex-wrap:wrap;">
        <a href="<?= APP_BASE ?>/public/contacto.php" class="btn btn-primary" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-envelope me-2"></i>Contacte-nos
        </a>
        <a href="<?= APP_BASE ?>/public/solucao.php" class="btn btn-outline-light" style="padding:13px 32px; font-size:1em;">
            <i class="fa-solid fa-circle-info me-2"></i>Saber Mais
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
