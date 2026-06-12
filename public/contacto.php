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

    if (empty($nome))                              $erros[] = 'O nome é obrigatório.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'O email não é válido.';
    if (empty($assunto))                           $erros[] = 'O assunto é obrigatório.';
    if (empty($mensagem))                          $erros[] = 'A mensagem é obrigatória.';

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
            $erro_envio = 'Erro ao enviar mensagem. Tente novamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Contacto MedControl - Entre em contacto connosco para saber mais sobre o sistema de gestão de inventário hospitalar.">
    <title>Contacto | <?= APP_NAME ?></title>
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

<div class="hero-section" style="padding:70px 40px;">
    <h1>Contacte-nos</h1>
    <p>Tem alguma dúvida sobre o MedControl? Envie-nos uma mensagem e responderemos no mais breve espaço de tempo.</p>
</div>

<div class="container" style="padding: 60px 20px; max-width: 1100px;">
    <div class="row g-4">
        <div class="col-lg-4">
            <div style="background: white; padding: 30px; border-radius: 12px; border-left: 4px solid var(--primary-color); box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="color: var(--bg-dark); margin-bottom: 15px;">
                    <i class="fa-solid fa-location-dot" style="color: var(--primary-color); margin-right: 10px;"></i>
                    Morada
                </h3>
                <p>Rua do Hospital Escolar, 123<br>4200-072, Porto<br>Portugal</p>
            </div>

            <div style="background: white; padding: 30px; border-radius: 12px; border-left: 4px solid var(--primary-color); box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-top: 20px;">
                <h3 style="color: var(--bg-dark); margin-bottom: 15px;">
                    <i class="fa-solid fa-phone" style="color: var(--primary-color); margin-right: 10px;"></i>
                    Telefone
                </h3>
                <p>+351 220 123 456 (Ext. Vendas)<br>+351 220 123 457 (Ext. Suporte)<br>+351 220 123 458 (Ext. Administrativo)</p>
            </div>

            <div style="background: white; padding: 30px; border-radius: 12px; border-left: 4px solid var(--primary-color); box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-top: 20px;">
                <h3 style="color: var(--bg-dark); margin-bottom: 15px;">
                    <i class="fa-solid fa-envelope" style="color: var(--primary-color); margin-right: 10px;"></i>
                    Email
                </h3>
                <p><a href="mailto:geral@MedControl.pt" style="color: var(--primary-color); text-decoration: none;">geral@MedControl.pt</a><br><a href="mailto:vendas@MedControl.pt" style="color: var(--primary-color); text-decoration: none;">vendas@MedControl.pt</a><br><a href="mailto:suporte@MedControl.pt" style="color: var(--primary-color); text-decoration: none;">suporte@MedControl.pt</a></p>
            </div>

            <div style="background: white; padding: 30px; border-radius: 12px; border-left: 4px solid var(--primary-color); box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-top: 20px;">
                <h3 style="color: var(--bg-dark); margin-bottom: 15px;">
                    <i class="fa-solid fa-clock" style="color: var(--primary-color); margin-right: 10px;"></i>
                    Horário
                </h3>
                <p><strong>Segunda a Sexta:</strong> 9h00 — 18h00<br><strong>Sábado, Domingo:</strong> Encerrado<br><strong>Feriados:</strong> Encerrado</p>
            </div>
        </div>

        <div class="col-lg-8">
            <div style="background: white; padding: 40px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <h2 style="color: var(--bg-dark); margin-bottom: 30px;">Formulário de Contacto</h2>

                <?php if ($mensagem_enviada): ?>
                <div class="alert alert-success d-flex align-items-center gap-2">
                    <i class="fa-solid fa-circle-check fa-lg"></i>
                    <div>
                        <strong>Mensagem enviada com sucesso!</strong><br>
                        Responderemos no prazo de 24h úteis.
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
                    <div style="margin-bottom: 20px;">
                        <label for="nome" style="display: block; margin-bottom: 8px; color: var(--bg-dark); font-weight: 600;">Nome Completo *</label>
                        <input type="text" id="nome" name="nome" required
                               value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"
                               class="form-control" placeholder="Seu nome completo">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div>
                            <label for="email" style="display: block; margin-bottom: 8px; color: var(--bg-dark); font-weight: 600;">Email *</label>
                            <input type="email" id="email" name="email" required
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                   class="form-control" placeholder="seu@email.com">
                        </div>
                        <div>
                            <label for="assunto" style="display: block; margin-bottom: 8px; color: var(--bg-dark); font-weight: 600;">Assunto *</label>
                            <select id="assunto" name="assunto" required class="form-select">
                                <option value="">--- Seleccione um assunto ---</option>
                                <?php foreach (['Informações Gerais','Solicitar Demo','Suporte Técnico','Proposta Comercial','Parcerias','Outro'] as $op): ?>
                                <option value="<?= $op ?>" <?= (($_POST['assunto'] ?? '') === $op) ? 'selected' : '' ?>><?= $op ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label for="mensagem" style="display: block; margin-bottom: 8px; color: var(--bg-dark); font-weight: 600;">Mensagem *</label>
                        <textarea id="mensagem" name="mensagem" required class="form-control"
                                  rows="5" placeholder="Descreva a sua mensagem em detalhe..."><?= htmlspecialchars($_POST['mensagem'] ?? '') ?></textarea>
                    </div>

                    <div style="display: flex; gap: 15px; margin-top: 30px;">
                        <button type="submit" class="btn btn-primary" style="padding: 12px 28px; font-size: 1em;">
                            <i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Enviar Mensagem
                        </button>
                        <button type="reset" class="btn btn-secondary" style="padding: 12px 28px; font-size: 1em;">
                            <i class="fa-solid fa-rotate-left" style="margin-right: 8px;"></i> Limpar
                        </button>
                    </div>
                    <p style="color: var(--text-light); font-size: 0.85em; margin-top: 15px;">* Campos obrigatórios. Responderemos no prazo de 24h úteis.</p>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Mapa ou Informações Adicionais -->
<div style="background: linear-gradient(135deg, var(--bg-dark) 0%, #0d3d5c 100%); padding: 60px 40px; margin-top: 60px;">
    <div class="container">
        <h2 class="section-title" style="color: white; padding-top: 0;">Por Que Escolher o MedControl?</h2>
        <div class="section-divider"></div>

        <div class="row g-4" style="margin-top: 30px;">
            <div class="col-md-4" style="text-align: center;">
                <div style="font-size: 2.5em; color: var(--primary-color); margin-bottom: 15px;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 style="color: white; margin-bottom: 10px;">Parceria Estratégica</h3>
                <p style="color: #b0c4de;">Não somos apenas fornecedores, somos parceiros comprometidos com o sucesso da sua instituição.</p>
            </div>

            <div class="col-md-4" style="text-align: center;">
                <div style="font-size: 2.5em; color: var(--primary-color); margin-bottom: 15px;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 style="color: white; margin-bottom: 10px;">Suporte 24/7</h3>
                <p style="color: #b0c4de;">Equipa técnica disponível para resolver qualquer questão ou problema, a qualquer hora.</p>
            </div>

            <div class="col-md-4" style="text-align: center;">
                <div style="font-size: 2.5em; color: var(--primary-color); margin-bottom: 15px;">
                    <i class="fa-solid fa-rocket"></i>
                </div>
                <h3 style="color: white; margin-bottom: 10px;">Inovação Contínua</h3>
                <p style="color: #b0c4de;">Actualizações regulares com novas funcionalidades baseadas em feedback dos clientes.</p>
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
<script src="<?= APP_BASE ?>/assets/js/1241446.js"></script>
</body>
</html>
