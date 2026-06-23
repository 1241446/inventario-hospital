<?php
// =====================================================
// MedControl - Configuração Global da Aplicação
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

// ─── INFORMAÇÃO DA APLICAÇÃO ──────────────────────
define('APP_NAME',      'MedControl');
define('APP_VERSION',   '1.0.0');
define('APP_COPYRIGHT', '© 2026 MedControl – ISEP');

// ─── CAMINHO BASE (alterar conforme o servidor) ───
// Laragon local:
define('APP_BASE', '/sibdas/1241446/inventario-hospital');
define('APP_URL',  'http://127.0.0.1' . APP_BASE);

// ─── BASE DE DADOS ────────────────────────────────
// Deteta automaticamente se o servidor remoto está acessível (timeout 2s).
// Se não houver internet, usa a BD local do Laragon como fallback.
$_remoto_ok = (bool)@fsockopen('vsgate-s1.dei.isep.ipp.pt', 10464, $_, $__, 2);

if ($_remoto_ok) {
    define('DB_HOST', 'vsgate-s1.dei.isep.ipp.pt');
    define('DB_PORT', 10464);
    define('DB_NAME', 'db1241446');
    define('DB_USER', '1241446');
    define('DB_PASS', 'santos_446');
} else {
    // BD local Laragon (fallback sem internet)
    define('DB_HOST', '127.0.0.1');
    define('DB_PORT', 3306);
    define('DB_NAME', 'db1241446');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}

// ─── MYSQL (Ficha 11) ─────────────────────────────
define('MYSQL_HOST',     DB_HOST);
define('MYSQL_PORT',     DB_PORT);
define('MYSQL_DATABASE', DB_NAME);
define('MYSQL_USERNAME', DB_USER);
define('MYSQL_PASSWORD', DB_PASS);
define('MYSQL_AES_KEY',  'medcontrol2025');

// ─── OPENSSL / AES (Ficha 13) ─────────────────────
define('OPENSSL_CIPHER', 'AES-256-CBC');
define('OPENSSL_KEY',    'medcontrol_hospital_key_2025_abc');
define('OPENSSL_IV',     'medcontrol_iv_16');

// ─── FUSO HORÁRIO ─────────────────────────────────
date_default_timezone_set('Europe/Lisbon');
