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
define('DB_HOST', 'vsgate-s1.dei.isep.ipp.pt');
define('DB_PORT', 10464);
define('DB_NAME', 'db1241446');
define('DB_USER', '1241446');
define('DB_PASS', 'santos_446');

// ─── FUSO HORÁRIO ─────────────────────────────────
date_default_timezone_set('Europe/Lisbon');
