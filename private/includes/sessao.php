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

    $_SESSION['utilizador'] = [
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
    return $_SESSION['utilizador'] ?? null;
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
