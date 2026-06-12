<?php
// =====================================================
// MedControl – Processamento de Login
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/includes/funcoes.php';
require_once __DIR__ . '/includes/sessao.php';

// Inicia a sessão para poder usar a variável $_SESSION
start_session();

// --------------------------------------------------------------------
// SEGURANÇA: Impede acesso direto a este script (só aceita POST)
// --------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// RECOLHA DE DADOS DO FORMULÁRIO
// --------------------------------------------------------------------
$username = isset($_POST['text_username']) ? trim($_POST['text_username']) : '';
$password = isset($_POST['text_password']) ? $_POST['text_password']       : '';

// --------------------------------------------------------------------
// VALIDAÇÃO DOS DADOS
// --------------------------------------------------------------------
$validation_errors = [];

// Verifica se o username é um email válido
if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
    $validation_errors[] = 'O username tem que ser um email válido.';
}

// Verifica comprimento do username
if (strlen($username) < 5 || strlen($username) > 50) {
    $validation_errors[] = 'O username deve ter entre 5 e 50 caracteres.';
}

// Verifica comprimento da password
if (strlen($password) < 6 || strlen($password) > 12) {
    $validation_errors[] = 'A password deve ter entre 6 e 12 caracteres.';
}

if (!empty($validation_errors)) {
    $_SESSION['validation_errors'] = $validation_errors;
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// VERIFICAÇÃO DE CREDENCIAIS NA BASE DE DADOS
// --------------------------------------------------------------------
$utilizadorEncontrado = null;

try {
    $pdo = get_pdo();

    $stmt = $pdo->prepare(
        "SELECT * FROM Utilizador WHERE email = :email AND password = SHA2(:password, 256) AND ativo = 1"
    );
    $stmt->execute([':email' => $username, ':password' => $password]);
    $utilizadorEncontrado = $stmt->fetch(PDO::FETCH_ASSOC);
    $pdo = null;

} catch (PDOException $e) {
    $_SESSION['server_error'] = 'Erro de ligação à base de dados.';
    registarLog('LOGIN_ERRO_BD', $e->getMessage());
    header('Location: ../public/login.php');
    return;
}

if (!$utilizadorEncontrado) {
    $_SESSION['server_error'] = 'Login inválido';
    registarLog('LOGIN_FALHA', "email=$username");
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// LOGIN BEM-SUCEDIDO: guardar utilizador na sessão
// --------------------------------------------------------------------
// Guarda o email na sessão (conforme ficha 10)
$_SESSION['utilizador'] = $utilizadorEncontrado['email'];

// Inicia a sessão completa com todos os dados do utilizador
iniciarSessaoUtilizador([
    'idUtilizador'   => $utilizadorEncontrado['idUtilizador'],
    'nomeUtilizador' => $utilizadorEncontrado['nomeUtilizador'],
    'nomeCompleto'   => $utilizadorEncontrado['nomeCompleto'],
    'tipoUtilizador' => $utilizadorEncontrado['tipoUtilizador'],
]);

// Mensagem de boas-vindas para o dashboard
$_SESSION['success_message'] = 'Bem-vindo, ' . $utilizadorEncontrado['nomeCompleto'] . '!';

registarLog('LOGIN_SUCESSO', "email=$username");

header('Location: ' . APP_BASE . '/private/home.php');
exit;
