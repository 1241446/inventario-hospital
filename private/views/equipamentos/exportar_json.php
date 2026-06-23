<?php
// =====================================================
// MedControl – Exportar Equipamentos para JSON
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();
verificarPerfil(['ADMINISTRADOR', 'GESTOR', 'TECNICO']);

try {
    $pdo  = get_pdo();
    $stmt = $pdo->query("
        SELECT e.codigoEquipamento,
               e.designacao,
               e.marca,
               e.modelo,
               e.numeroSerie,
               e.anoFabrico,
               cat.nomeCategoria,
               est.nomeEstado,
               c.nomeCriticidade,
               l.nomeLocalizacao
          FROM Equipamento e
          JOIN Categoria   cat ON e.idCategoria   = cat.idCategoria
          JOIN Estado      est ON e.idEstado      = est.idEstado
          JOIN Criticidade c   ON e.idCriticidade = c.idCriticidade
          JOIN Localizacao l   ON e.idLocalizacao = l.idLocalizacao
         ORDER BY e.codigoEquipamento
    ");
    $equipamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;

} catch (PDOException $e) {
    http_response_code(500);
    exit(json_encode(['erro' => 'Erro ao exportar dados.'], JSON_UNESCAPED_UNICODE));
}

$filename = 'equipamentos_' . date('Ymd_His') . '.json';

header('Content-Type: application/json; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');

$export = [
    'sistema'       => 'MedControl',
    'exportado_em'  => date('Y-m-d H:i:s'),
    'total'         => count($equipamentos),
    'equipamentos'  => $equipamentos,
];

echo json_encode($export, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

registarLog('EXPORTAR_JSON', 'Exportação de equipamentos para JSON por ' . ($_SESSION['utilizador'] ?? 'desconhecido'));
exit;
