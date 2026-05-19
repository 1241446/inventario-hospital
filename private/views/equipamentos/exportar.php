<?php
// =====================================================
// MedControl – Exportar Equipamentos para CSV
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

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

} catch (PDOException $e) {
    http_response_code(500);
    exit('Erro ao exportar dados.');
}

$filename = 'equipamentos_' . date('Ymd_His') . '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');

$out = fopen('php://output', 'w');

// BOM para Excel reconhecer UTF-8
fwrite($out, "\xEF\xBB\xBF");

// Cabeçalho
fputcsv($out, [
    'Código', 'Designação', 'Marca', 'Modelo',
    'Nº Série', 'Ano Fabrico', 'Categoria',
    'Estado', 'Criticidade', 'Localização'
], ';');

// Dados
foreach ($equipamentos as $eq) {
    fputcsv($out, [
        $eq['codigoEquipamento'],
        $eq['designacao'],
        $eq['marca'],
        $eq['modelo'],
        $eq['numeroSerie'],
        $eq['anoFabrico'],
        $eq['nomeCategoria'],
        $eq['nomeEstado'],
        $eq['nomeCriticidade'],
        $eq['nomeLocalizacao'],
    ], ';');
}

fclose($out);

registarLog('EXPORTAR_CSV', 'Exportação de equipamentos para CSV por ' . ($_SESSION['utilizador'] ?? 'desconhecido'));
exit;
