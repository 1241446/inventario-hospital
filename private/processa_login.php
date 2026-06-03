<?php
// =====================================================
// MedControl – Processamento de Login
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/includes/funcoes.php';
require_once __DIR__ . '/includes/sessao.php';

start_session();

// --------------------------------------------------------------------
// SEGURANÇA: só aceita pedidos POST
// --------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// RECOLHA DE DADOS DO FORMULÁRIO
// --------------------------------------------------------------------
$username = isset($_POST['text_username']) ? trim($_POST['text_username']) : '';
$password = isset($_POST['text_password']) ? $_POST['text_password']        : '';

// --------------------------------------------------------------------
// VALIDAÇÃO DOS DADOS
// --------------------------------------------------------------------
$validation_errors = [];

if (!validarObrigatorio($username)) {
    $validation_errors[] = 'O campo utilizador é obrigatório.';
} elseif (strlen($username) < 3 || strlen($username) > 50) {
    $validation_errors[] = 'O utilizador deve ter entre 3 e 50 caracteres.';
}

if (!validarObrigatorio($password)) {
    $validation_errors[] = 'O campo password é obrigatório.';
} elseif (strlen($password) < 6 || strlen($password) > 50) {
    $validation_errors[] = 'A password deve ter entre 6 e 50 caracteres.';
}

if (!empty($validation_errors)) {
    $_SESSION['validation_errors'] = $validation_errors;
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// VERIFICAÇÃO DE CREDENCIAIS (simulado — sem ligação à BD por agora)
// --------------------------------------------------------------------
$utilizadoresValidos = [
    ['nomeUtilizador' => 'admin',  'password' => 'admin123',  'nomeCompleto' => 'Administrador Sistema', 'tipoUtilizador' => 'ADMINISTRADOR', 'idUtilizador' => 1],
    ['nomeUtilizador' => 'carlos', 'password' => 'senha123',  'nomeCompleto' => 'Carlos Silva',          'tipoUtilizador' => 'TECNICO',        'idUtilizador' => 2],
    ['nomeUtilizador' => 'joana',  'password' => 'senha456',  'nomeCompleto' => 'Joana Ferreira',        'tipoUtilizador' => 'GESTOR',         'idUtilizador' => 3],
];

$utilizadorEncontrado = null;
foreach ($utilizadoresValidos as $u) {
    if ($u['nomeUtilizador'] === $username && $u['password'] === $password) {
        $utilizadorEncontrado = $u;
        break;
    }
}

$result['status'] = $utilizadorEncontrado ? 1 : 0;

if (!$result['status']) {
    $_SESSION['server_error'] = 'Credenciais incorretas. Tente novamente.';
    registarLog('LOGIN_FALHA', "utilizador=$username");
    header('Location: ../public/login.php');
    return;
}

// --------------------------------------------------------------------
// LOGIN BEM-SUCEDIDO: guardar utilizador na sessão
// --------------------------------------------------------------------
iniciarSessaoUtilizador($utilizadorEncontrado);
registarLog('LOGIN_SUCESSO', "utilizador=$username");

header('Location: ' . APP_BASE . '/private/home.php');
exit;
