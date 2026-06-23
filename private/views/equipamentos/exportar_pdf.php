<?php
// =====================================================
// MedControl – Exportar Equipamentos para PDF
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
    $equipamentos = $stmt->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;

} catch (PDOException $e) {
    http_response_code(500);
    exit('Erro ao gerar relatório PDF.');
}

registarLog('EXPORTAR_PDF', 'Exportação de equipamentos para PDF por ' . ($_SESSION['utilizador'] ?? 'desconhecido'));

$totalEquipamentos = count($equipamentos);
$dataHora          = date('d/m/Y H:i');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Equipamentos – MedControl</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px 30px 15px;
            border-bottom: 3px solid #0a2540;
            margin-bottom: 20px;
        }

        .header-logo {
            font-size: 22px;
            font-weight: bold;
            color: #0a2540;
            letter-spacing: -0.5px;
        }

        .header-logo span {
            color: #4fc3f7;
        }

        .header-meta {
            text-align: right;
            color: #555;
            font-size: 10px;
            line-height: 1.6;
        }

        .report-title {
            padding: 0 30px 15px;
        }

        .report-title h1 {
            font-size: 16px;
            color: #0a2540;
            margin-bottom: 4px;
        }

        .report-title p {
            color: #666;
            font-size: 10px;
        }

        .stats {
            display: flex;
            gap: 15px;
            padding: 10px 30px 20px;
        }

        .stat-box {
            background: #f0f4f8;
            border-left: 3px solid #0a2540;
            padding: 8px 14px;
            border-radius: 3px;
        }

        .stat-box .value {
            font-size: 20px;
            font-weight: bold;
            color: #0a2540;
        }

        .stat-box .label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            page-break-inside: auto;
        }

        thead {
            background-color: #0a2540;
            color: #fff;
        }

        thead th {
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            page-break-inside: avoid;
            border-bottom: 1px solid #e8edf2;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f9fb;
        }

        tbody td {
            padding: 6px 6px;
            vertical-align: middle;
        }

        .badge-estado {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }

        .estado-operacional  { background: #d4edda; color: #155724; }
        .estado-manutencao   { background: #fff3cd; color: #856404; }
        .estado-avariado     { background: #f8d7da; color: #721c24; }
        .estado-abatido      { background: #e2e3e5; color: #383d41; }

        .badge-criticidade {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }

        .crit-critica { background: #f8d7da; color: #721c24; }
        .crit-alta    { background: #fde8cd; color: #7d4a00; }
        .crit-media   { background: #fff3cd; color: #856404; }
        .crit-baixa   { background: #d4edda; color: #155724; }

        .footer {
            margin-top: 25px;
            padding: 12px 30px;
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            color: #888;
            font-size: 9px;
        }

        .no-print {
            position: fixed;
            top: 15px;
            right: 15px;
            display: flex;
            gap: 8px;
            z-index: 100;
        }

        .btn-print {
            background: #0a2540;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-back {
            background: #6c757d;
            color: #fff;
            border: none;
            padding: 9px 18px;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        @media print {
            .no-print { display: none; }
            body { font-size: 10px; }
            .header { padding: 10px 20px 10px; }
            .report-title, .stats { padding-left: 20px; }
            table { font-size: 9px; }
        }

        @page {
            margin: 15mm;
        }
    </style>
</head>
<body>

<div class="no-print">
    <a href="lista.php" class="btn-back">&#8592; Voltar</a>
    <button class="btn-print" onclick="window.print()">&#128438; Guardar como PDF</button>
</div>

<!-- Cabeçalho -->
<div class="header">
    <div>
        <div class="header-logo">Med<span>Control</span></div>
        <div style="font-size:10px; color:#555; margin-top:3px;">
            Sistema de Gestão de Inventário Hospitalar
        </div>
    </div>
    <div class="header-meta">
        <strong>Relatório de Equipamentos</strong><br>
        Data: <?= $dataHora ?><br>
        Gerado por: <?= htmlspecialchars($_SESSION['utilizador'] ?? '') ?><br>
        Estudante: 1241446
    </div>
</div>

<!-- Título -->
<div class="report-title">
    <h1>Lista de Equipamentos Médicos</h1>
    <p>Listagem completa de todos os equipamentos registados no sistema.</p>
</div>

<!-- Estatísticas -->
<div class="stats">
    <div class="stat-box">
        <div class="value"><?= $totalEquipamentos ?></div>
        <div class="label">Total de Equipamentos</div>
    </div>
    <?php
    $porEstado = [];
    foreach ($equipamentos as $eq) {
        $estado = $eq->nomeEstado;
        $porEstado[$estado] = ($porEstado[$estado] ?? 0) + 1;
    }
    foreach ($porEstado as $estado => $total):
    ?>
    <div class="stat-box">
        <div class="value"><?= $total ?></div>
        <div class="label"><?= htmlspecialchars($estado) ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Tabela -->
<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Designação</th>
            <th>Marca / Modelo</th>
            <th>Nº Série</th>
            <th>Ano</th>
            <th>Categoria</th>
            <th>Localização</th>
            <th>Estado</th>
            <th>Criticidade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipamentos as $eq): ?>
        <?php
            $estadoClass = match(strtolower($eq->nomeEstado)) {
                'operacional'          => 'estado-operacional',
                'em manutenção'        => 'estado-manutencao',
                'avariado'             => 'estado-avariado',
                'abatido', 'desativado'=> 'estado-abatido',
                default                => '',
            };
            $critClass = match(strtolower($eq->nomeCriticidade)) {
                'crítica'  => 'crit-critica',
                'alta'     => 'crit-alta',
                'média'    => 'crit-media',
                'baixa'    => 'crit-baixa',
                default    => '',
            };
        ?>
        <tr>
            <td><strong><?= htmlspecialchars($eq->codigoEquipamento) ?></strong></td>
            <td><?= htmlspecialchars($eq->designacao) ?></td>
            <td><?= htmlspecialchars(trim($eq->marca . ' ' . $eq->modelo)) ?></td>
            <td><?= htmlspecialchars($eq->numeroSerie ?? '—') ?></td>
            <td><?= htmlspecialchars($eq->anoFabrico ?? '—') ?></td>
            <td><?= htmlspecialchars($eq->nomeCategoria) ?></td>
            <td><?= htmlspecialchars($eq->nomeLocalizacao) ?></td>
            <td>
                <span class="badge-estado <?= $estadoClass ?>">
                    <?= htmlspecialchars($eq->nomeEstado) ?>
                </span>
            </td>
            <td>
                <span class="badge-criticidade <?= $critClass ?>">
                    <?= htmlspecialchars($eq->nomeCriticidade) ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Rodapé -->
<div class="footer">
    <span>MedControl – Sistema de Gestão de Inventário Hospitalar | ISEP LEBIOM 2025-2026</span>
    <span>Relatório gerado em <?= $dataHora ?> | Total: <?= $totalEquipamentos ?> equipamentos</span>
</div>

<script>
    // Auto-abre o diálogo de impressão ao carregar a página
    window.addEventListener('load', function() {
        window.print();
    });
</script>

</body>
</html>
