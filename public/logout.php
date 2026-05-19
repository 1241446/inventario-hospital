<?php
// =====================================================
// MedControl – Logout
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../private/includes/funcoes.php';
require_once __DIR__ . '/../private/includes/sessao.php';

start_session();
registarLog('LOGOUT', 'utilizador=' . ($_SESSION['utilizador']['nomeUtilizador'] ?? 'desconhecido'));
logout_and_redirect();
