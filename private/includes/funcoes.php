<?php
// =====================================================
// MedControl - Funções Utilitárias
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

/**
 * Sanitiza uma string para saída HTML segura.
 *
 * @param  string $valor  Valor a sanitizar
 * @return string         Valor seguro para HTML
 */
function sanitizar(string $valor): string
{
    return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
}

/**
 * Verifica se um campo obrigatório foi preenchido.
 *
 * @param  string $valor  Valor a validar
 * @return bool           true se preenchido, false se vazio
 */
function validarObrigatorio(string $valor): bool
{
    return trim($valor) !== '';
}

/**
 * Redireciona para um URL e termina a execução do script.
 *
 * @param  string $url  Destino do redireccionamento
 * @return void
 */
function redirecionar(string $url): void
{
    header('Location: ' . $url);
    exit;
}

/**
 * Regista uma mensagem no ficheiro de log da aplicação.
 *
 * @param  string $tipo      Tipo de evento (ex.: LOGIN_SUCESSO, ERRO)
 * @param  string $mensagem  Descrição do evento
 * @return void
 */
function registarLog(string $tipo, string $mensagem): void
{
    $pasta   = __DIR__ . '/../../logs';
    $ficheiro = $pasta . '/app.log';

    if (!is_dir($pasta)) {
        mkdir($pasta, 0755, true);
    }

    $ip    = $_SERVER['REMOTE_ADDR'] ?? 'desconhecido';
    $linha = date('[Y-m-d H:i:s]') . " [$tipo] [$ip] $mensagem" . PHP_EOL;
    file_put_contents($ficheiro, $linha, FILE_APPEND | LOCK_EX);
}

/**
 * Gera o HTML de um alerta Bootstrap com ícone Font Awesome.
 *
 * @param  string $tipo      Tipo Bootstrap: success | danger | warning | info
 * @param  string $mensagem  Texto da mensagem
 * @return string            HTML do alerta
 */
function alerta(string $tipo, string $mensagem): string
{
    $icones = [
        'success' => 'fa-circle-check',
        'danger'  => 'fa-circle-xmark',
        'warning' => 'fa-triangle-exclamation',
        'info'    => 'fa-circle-info',
    ];
    $icone = $icones[$tipo] ?? 'fa-circle-info';

    return '<div class="alert alert-' . $tipo . ' d-flex align-items-center gap-2" role="alert">'
         . '<i class="fa-solid ' . $icone . '"></i>'
         . '<span>' . sanitizar($mensagem) . '</span>'
         . '</div>';
}

/**
 * Formata um valor monetário em euros (pt-PT).
 *
 * @param  float  $valor  Valor numérico
 * @return string         Valor formatado (ex.: 1 500,00 €)
 */
function formatarMoeda(float $valor): string
{
    return number_format($valor, 2, ',', ' ') . ' €';
}

/**
 * Formata uma data no formato pt-PT.
 *
 * @param  string $data  Data em formato ISO (Y-m-d)
 * @return string        Data formatada (ex.: 15/03/2024)
 */
function formatarData(string $data): string
{
    $dt = DateTime::createFromFormat('Y-m-d', $data);
    return $dt ? $dt->format('d/m/Y') : sanitizar($data);
}

function start_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function check_session(): bool
{
    return isset($_SESSION['utilizador']);
}

function redirect_if_not_logged(string $redirect_to = ''): void
{
    start_session();
    if (!check_session()) {
        $url = $redirect_to ?: APP_URL . '/public/login.php';
        header("Location: $url");
        exit;
    }
}

function logout_and_redirect(string $redirect_to = ''): void
{
    start_session();
    session_unset();
    session_destroy();
    $url = $redirect_to ?: APP_URL . '/public/login.php';
    header("Location: $url");
    exit;
}
