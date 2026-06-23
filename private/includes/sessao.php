<?php
// =====================================================
// MedControl - Gestão de Sessão
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

/**
 * Inicia a sessão PHP com configurações seguras.
 * Deve ser chamada antes de qualquer saída HTML.
 *
 * @return void
 */
function iniciarSessao(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_name('medcontrol_sessao');
        session_start([
            'cookie_httponly' => true,
            'cookie_samesite' => 'Strict',
        ]);
    }
}

/**
 * Inicia a sessão autenticada de um utilizador.
 * Chamada após validação bem-sucedida das credenciais.
 *
 * @param  array $utilizador  Dados do utilizador autenticado
 * @return void
 */
function iniciarSessaoUtilizador(array $utilizador): void
{
    session_regenerate_id(true);                // previne fixação de sessão

    // $_SESSION['utilizador'] guarda o email (string) — Ficha 10
    // Os dados completos ficam em $_SESSION['sessao']
    $_SESSION['sessao'] = [
        'id'            => $utilizador['idUtilizador'],
        'nomeUtilizador'=> $utilizador['nomeUtilizador'],
        'nomeCompleto'  => $utilizador['nomeCompleto'],
        'tipoUtilizador'=> $utilizador['tipoUtilizador'],
        'loginEm'       => time(),
    ];
}

/**
 * Verifica se o utilizador está autenticado.
 * Se não estiver, redireciona para a página de login.
 *
 * @return void
 */
function verificarSessao(): void
{
    iniciarSessao();

    if (!isset($_SESSION['utilizador'])) {
        redirecionar(APP_URL . '/public/login.php');
    }
}

/**
 * Devolve os dados do utilizador autenticado na sessão.
 *
 * @return array|null  Dados do utilizador ou null se não autenticado
 */
function utilizadorSessao(): ?array
{
    return $_SESSION['sessao'] ?? null;
}

/**
 * Verifica se o utilizador tem um dos perfis permitidos.
 * Se não tiver, redireciona para o dashboard com acesso negado.
 *
 * @param  array $perfisPermitidos  Lista de perfis com acesso (ex: ['ADMINISTRADOR','GESTOR'])
 * @return void
 */
function verificarPerfil(array $perfisPermitidos): void
{
    $perfil = strtoupper($_SESSION['sessao']['tipoUtilizador'] ?? '');
    if (!in_array($perfil, $perfisPermitidos)) {
        $_SESSION['server_error'] = 'Não tem permissão para aceder a esta página.';
        redirecionar(APP_BASE . '/private/home.php');
    }
}

/**
 * Termina a sessão e redireciona para o login.
 *
 * @return void
 */
function terminarSessao(): void
{
    iniciarSessao();
    $_SESSION = [];
    session_destroy();
    redirecionar(APP_URL . '/public/login.php');
}
