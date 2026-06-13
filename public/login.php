<?php
// =====================================================
// MedControl - Página de Login
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';
require_once __DIR__ . '/../private/includes/sessao.php';

// Inicia a sessão (necessário para usar $_SESSION)
start_session();

// Se já estiver autenticado, redireciona para o dashboard
if (check_session()) {
    redirecionar(APP_URL . '/private/home.php');
}

// --------------------------------------------------------------------
// RECOLHA DE MENSAGENS TEMPORÁRIAS DA SESSÃO
// --------------------------------------------------------------------
// Inicializa a variável que irá conter os erros de validação
$validation_errors = [];

// Verifica se existem erros de validação guardados na sessão
if (!empty($_SESSION['validation_errors'])) {
    // Se existirem, copia-os para a variável local
    $validation_errors = $_SESSION['validation_errors'];
    // Remove os erros da sessão para que não apareçam novamente numa recarga de página
    unset($_SESSION['validation_errors']);
}

// Inicializa a variável que irá conter erros de servidor
$server_error = '';

// Verifica se existe algum erro de servidor guardado na sessão
if (!empty($_SESSION['server_error'])) {
    // Se existir, copia-o para a variável local
    $server_error = $_SESSION['server_error'];
    // Remove o erro da sessão após ser lido
    unset($_SESSION['server_error']);
}

$tituloPagina = 'Login';
?>
<?php include __DIR__ . '/../private/includes/header.php'; ?>

<div class="container-fluid">
    <div class="row">
        <main class="col-12 d-flex justify-content-center align-items-center" style="min-height:90vh;">

            <div style="width:100%;max-width:420px;">

                <div class="text-center mb-4">
                    <i class="fa-solid fa-hospital-user fa-3x" style="color:#1565c0;"></i>
                    <h2 class="mt-2 fw-bold" style="color:#0a2540;">
                        Med<span style="color:#1565c0;"><?php echo APP_NAME; ?></span>
                    </h2>
                    <p class="text-muted small">Sistema de Gestão de Inventário Hospitalar</p>
                    <p class="text-muted" style="font-size:0.75em;">Introduza o seu email e password para aceder</p>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4 text-center">Acesso à Área Reservada</h5>

                        <!-- O conteúdo do formulário de login será adicionado aqui -->
                        <form name="formulario" action="../private/processa_login.php" method="post" novalidate>

                            <div class="mb-3">
                                <label for="text_username" class="form-label fw-semibold">Utilizador</label>
                                <input type="email" class="form-control" id="text_username"
                                       name="text_username" placeholder="email@exemplo.com"
                                       required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="text_password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="text_password"
                                           name="text_password" placeholder="Password" required>
                                    <button class="btn btn-outline-secondary" type="button"
                                            id="togglePassword" aria-label="Mostrar ou ocultar password">
                                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary px-4" id="btnSubmit">
                                    <i class="fa-solid fa-right-to-bracket me-2" id="btnIcon"></i>
                                    <span id="btnText">Entrar</span>
                                </button>
                            </div>

                            <!-- Botões de preenchimento automático (Fase de Testes) -->
                            <div class="mt-2 text-center">
                                <button type="button" id="preencher_adm" class="btn btn-outline-primary btn-sm me-2">
                                    Preencher Admin
                                </button>
                                <button type="button" id="preencher_tec" class="btn btn-outline-secondary btn-sm">
                                    Preencher Técnico
                                </button>
                            </div>

                            <!-- -------------------------------------------------------------------- -->
                            <!-- APRESENTAÇÃO DE MENSAGENS DE ERRO (VALIDAÇÃO E SERVIDOR) -->
                            <!-- -------------------------------------------------------------------- -->

                            <!-- Verifica se existem erros de validação -->
                            <?php if (!empty($validation_errors)) : ?>
                                <!-- Se existirem, apresenta um alerta de erro (vermelho) usando as classes do Bootstrap -->
                                <div class="alert alert-danger p-2 text-center">
                                    <!-- Percorre todos os erros de validação -->
                                    <?php foreach ($validation_errors as $error) : ?>
                                        <!-- Mostra cada erro dentro de uma <div>, escapando caracteres especiais para segurança -->
                                        <div><?= htmlspecialchars($error) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Verifica se existe um erro de servidor -->
                            <?php if (!empty($server_error)) : ?>
                                <!-- Apresenta também num alerta de erro (vermelho) -->
                                <div class="alert alert-danger p-2 text-center">
                                    <!-- Mostra o erro do servidor, também escapado com htmlspecialchars -->
                                    <div><?= htmlspecialchars($server_error) ?></div>
                                </div>
                            <?php endif; ?>

                        </form>
                    </div>
                </div>

                <p class="text-center text-muted small mt-3">
                    <a href="index.php" class="text-decoration-none">
                        <i class="fa-solid fa-arrow-left me-1"></i>Voltar ao site
                    </a>
                </p>

            </div>

<?php
$scriptsExtra = '
<script>
document.getElementById("togglePassword").addEventListener("click", function () {
    var input = document.getElementById("text_password");
    var icon  = document.getElementById("toggleIcon");
    var show  = input.type === "password";
    input.type = show ? "text" : "password";
    icon.className = show ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
});

document.querySelector("#preencher_adm").addEventListener("click", function () {
    const f = document.forms["formulario"];
    f["text_username"].value = "admin@medcontrol.pt";
    f["text_password"].value = "admin123";
});

document.querySelector("#preencher_tec").addEventListener("click", function () {
    const f = document.forms["formulario"];
    f["text_username"].value = "carlos@medcontrol.pt";
    f["text_password"].value = "senha123";
});

document.querySelector("form").addEventListener("submit", function () {
    var btn  = document.getElementById("btnSubmit");
    var icon = document.getElementById("btnIcon");
    var text = document.getElementById("btnText");
    btn.disabled     = true;
    icon.className   = "fa-solid fa-spinner fa-spin me-2";
    text.textContent = "A autenticar...";
});
</script>
';
include __DIR__ . '/../private/includes/footer.php';
?>
