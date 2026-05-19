<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/includes/funcoes.php';
require_once __DIR__ . '/includes/sessao.php';

redirect_if_not_logged();
header('Location: ' . APP_BASE . '/private/home.php');
exit;
