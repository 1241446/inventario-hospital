<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';

$mensagem_enviada = false;
$erro_envio       = '';
$erros            = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim($_POST['nome']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $assunto  = trim($_POST['assunto']  ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if (empty($nome))                               $erros[] = 'O nome é obrigatório.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'O email não é válido.';
    if (empty($assunto))                            $erros[] = 'O assunto é obrigatório.';
    if (empty($mensagem))                           $erros[] = 'A mensagem é obrigatória.';

    if (empty($erros)) {
        try {
            $pdo  = get_pdo();
            $stmt = $pdo->prepare("
                INSERT INTO MensagemContacto (nomeRemetente, emailRemetente, assunto, mensagem)
                VALUES (:nome, :email, :assunto, :mensagem)
            ");
            $stmt->execute([
                ':nome'     => $nome,
                ':email'    => $email,
                ':assunto'  => $assunto,
                ':mensagem' => $mensagem,
            ]);
            $pdo = null;
            $mensagem_enviada = true;
            registarLog('CONTACTO_RECEBIDO', "de=$email assunto=$assunto");
        } catch (PDOException $e) {
            $erro_envio = 'Erro ao enviar a mensagem. Por favor, tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacto MedControl — Entre em contacto connosco para saber mais sobre o sistema de gestão de inventário hospitalar.">
    <title>Contacto | <?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= APP_BASE ?>/assets/css/1241446.css">
    <style>
        .info-card { background: white; padding: 28px; border-radius: 12px; border-left: 4px solid var(--primary-color); box-shadow: 0 2px 8px rgba(0,0,0,0.06); margin-bottom: 20px; }
        .info-card h3 { color: var(--bg-dark); margin-bottom: 12px; font-size: 1.05em; display: flex; align-items: center; gap: 10px; }
        .info-card h3 i { color: var(--primary-color); }
        .info-card p { color: #555; font-size: 0.92em; line-height: 1.7; margin: 0; }
        .info-card p a { color: var(--primary-color); text-decoration: none; }
        .info-card p a:hover { text-decoration: underline; }
        .form-wrap { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
        .form-wrap h2 { color: var(--bg-dark); margin-bottom: 28px; font-size: 1.4em; }
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
                <a href="<?= APP_BASE ?>/public/clientes.php">Clientes</a>
                <a href="<?= APP_BASE ?>/public/contacto.php" class="active">Contacto</a>
            </div>
            <div class="nav-cliente">
                <a href="<?= APP_BASE ?>/public/login.php"><i class="fa-solid fa-right-to-bracket"></i> Área Restrita</a>
            </div>
        </div>
    </div>
</nav>

<div class="hero-section" style="padding:80px 40px;">
    <h1>Contacte-<span>nos</span></h1>
    <p>Tem alguma questão sobre o MedControl? Envie-nos uma mensagem e responderemos no prazo de 24 horas úteis.</p>
</div>

<div class="container" style="padding:60px 20px; max-width:1100px;">
    <div class="row g-4">
        <!-- Informações de Contacto -->
        <div class="col-lg-4">
            <div class="info-card">
                <h3><i class="fa-solid fa-location-dot"></i> Morada</h3>
                <p>Rua do Hospital Escolar, 123<br>4200-072 Porto<br>Portugal</p>
            </div>
            <div class="info-card">
                <h3><i class="fa-solid fa-phone"></i> Telefone</h3>
                <p>+351 220 123 456 (Vendas)<br>+351 220 123 457 (Suporte)<br>+351 220 123 458 (Administrativo)</p>
            </div>
            <div class="info-card">
                <h3><i class="fa-solid fa-envelope"></i> Email</h3>
                <p>
                    <a href="mailto:geral@medcontrol.pt">geral@medcontrol.pt</a><br>
                    <a href="mailto:vendas@medcontrol.pt">vendas@medcontrol.pt</a><br>
                    <a href="mailto:suporte@medcontrol.pt">suporte@medcontrol.pt</a>
                </p>
            </div>
            <div class="info-card">
                <h3><i class="fa-solid fa-clock"></i> Horário de Atendimento</h3>
                <p>
                    <strong>2.ª a 6.ª feira:</strong> 9h00 — 18h00<br>
                    <strong>Sábado e Domingo:</strong> Encerrado<br>
                    <strong>Feriados:</strong> Encerrado
                </p>
            </div>
        </div>

        <!-- Formulário -->
        <div class="col-lg-8">
            <div class="form-wrap">
                <h2><i class="fa-solid fa-paper-plane" style="color:var(--primary-color); margin-right:10px;"></i>Formulário de Contacto</h2>

                <?php if ($mensagem_enviada): ?>
                <div class="alert alert-success d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                    <div>
                        <strong>Mensagem enviada com sucesso!</strong><br>
                        Responderemos no prazo de 24 horas úteis.
                    </div>
                </div>
                <?php else: ?>

                <?php if (!empty($erros)): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($erros as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <?php if (!empty($erro_envio)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($erro_envio) ?></div>
                <?php endif; ?>

                <form id="contactForm" method="post" action="#" novalidate>
                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">Nome Completo <span class="text-danger">*</span></label>
                        <input type="text" id="nome" name="nome" required
                               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
                               class="form-control" placeholder="O seu nome completo">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" required
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                   class="form-control" placeholder="o.seu@email.pt">
                        </div>
                        <div class="col-md-6">
                            <label for="assunto" class="form-label fw-semibold">Assunto <span class="text-danger">*</span></label>
                            <select id="assunto" name="assunto" required class="form-select">
                                <option value="">--- Selecione um assunto ---</option>
                                <?php foreach (['Informações Gerais', 'Solicitar Demonstração', 'Suporte Técnico', 'Proposta Comercial', 'Parcerias', 'Outro'] as $op): ?>
                                <option value="<?= htmlspecialchars($op) ?>" <?= (($_POST['assunto'] ?? '') === $op) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($op) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mensagem" class="form-label fw-semibold">Mensagem <span class="text-danger">*</span></label>
                        <textarea id="mensagem" name="mensagem" required class="form-control"
                                  rows="5" placeholder="Descreva a sua questão ou pedido em detalhe..."><?= htmlspecialchars($_POST['mensagem'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-primary" style="padding:12px 28px;">
                            <i class="fa-solid fa-paper-plane me-2"></i>Enviar Mensagem
                        </button>
                        <button type="reset" class="btn btn-secondary" style="padding:12px 28px;">
                            <i class="fa-solid fa-rotate-left me-2"></i>Limpar
                        </button>
                    </div>
                    <p class="text-muted mt-3" style="font-size:0.85em;"><span class="text-danger">*</span> Campos obrigatórios. Responderemos no prazo de 24 horas úteis.</p>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Porquê escolher o MedControl -->
<div style="background:linear-gradient(135deg, #0a2540 0%, #0d3d5c 100%); padding:60px 40px; margin-top:20px;">
    <div class="container">
        <h2 class="section-title" style="color:white; padding-top:0;">Por Que Escolher o MedControl?</h2>
        <div class="section-divider"></div>
        <div class="row g-4" style="margin-top:30px;">
            <div class="col-md-4" style="text-align:center;">
                <div style="font-size:2.5em; color:#4fc3f7; margin-bottom:15px;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 style="color:white; margin-bottom:10px;">Parceria Estratégica</h3>
                <p style="color:#b0c4de;">Não somos apenas fornecedores: somos parceiros comprometidos com o sucesso da sua instituição a longo prazo.</p>
            </div>
            <div class="col-md-4" style="text-align:center;">
                <div style="font-size:2.5em; color:#4fc3f7; margin-bottom:15px;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 style="color:white; margin-bottom:10px;">Suporte Dedicado</h3>
                <p style="color:#b0c4de;">Equipa técnica disponível para resolver qualquer questão ou problema, com resposta rápida e acompanhamento personalizado.</p>
            </div>
            <div class="col-md-4" style="text-align:center;">
                <div style="font-size:2.5em; color:#4fc3f7; margin-bottom:15px;">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <h3 style="color:white; margin-bottom:10px;">Inovação Contínua</h3>
                <p style="color:#b0c4de;">Atualizações regulares com novas funcionalidades desenvolvidas com base no retorno dos clientes e nas necessidades do setor.</p>
            </div>
        </div>
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
