<?php
// =====================================================
// MedControl – Dashboard (Área Privada)
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/includes/funcoes.php';
require_once __DIR__ . '/includes/sessao.php';

redirect_if_not_logged();
start_session();

$tituloPagina = 'Dashboard';
$paginaAtiva  = 'dashboard';

$success_message = $_SESSION['success_message'] ?? '';
unset($_SESSION['success_message']);

// ─── DADOS DA BD ──────────────────────────────────────
$totalEquipamentos = 0;
$totalAtivos       = 0;
$totalManutencao   = 0;
$garantiasExpirando= 0;
$ultimosEquipamentos = [];
$statsEstado       = [];
$statsCriticidade  = [];

try {
    $pdo = get_pdo();

    $totalEquipamentos  = (int)$pdo->query("SELECT COUNT(*) FROM Equipamento")->fetchColumn();

    $totalAtivos        = (int)$pdo->query("
        SELECT COUNT(*) FROM Equipamento e
        JOIN Estado est ON e.idEstado = est.idEstado
        WHERE est.nomeEstado = 'Ativo'
    ")->fetchColumn();

    $totalManutencao    = (int)$pdo->query("
        SELECT COUNT(*) FROM Equipamento e
        JOIN Estado est ON e.idEstado = est.idEstado
        WHERE est.nomeEstado = 'Em Manutencao'
    ")->fetchColumn();

    $garantiasExpirando = (int)$pdo->query("
        SELECT COUNT(*) FROM Garantia
        WHERE dataFim BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
    ")->fetchColumn();

    $statsEstado = $pdo->query("
        SELECT est.nomeEstado, COUNT(*) AS total
          FROM Equipamento e
          JOIN Estado est ON e.idEstado = est.idEstado
         GROUP BY est.nomeEstado
    ")->fetchAll(PDO::FETCH_OBJ);

    $statsCriticidade = $pdo->query("
        SELECT c.nomeCriticidade, COUNT(*) AS total
          FROM Equipamento e
          JOIN Criticidade c ON e.idCriticidade = c.idCriticidade
         GROUP BY c.nomeCriticidade
         ORDER BY total DESC
    ")->fetchAll(PDO::FETCH_OBJ);

    $stmtUlt = $pdo->query("
        SELECT e.idEquipamento, e.codigoEquipamento, e.designacao, e.marca, e.modelo,
               est.nomeEstado, c.nomeCriticidade, l.nomeLocalizacao
          FROM Equipamento e
          JOIN Estado      est ON e.idEstado       = est.idEstado
          JOIN Criticidade c   ON e.idCriticidade  = c.idCriticidade
          JOIN Localizacao l   ON e.idLocalizacao  = l.idLocalizacao
         ORDER BY e.dataCriacao DESC
         LIMIT 5
    ");
    $ultimosEquipamentos = $stmtUlt->fetchAll(PDO::FETCH_OBJ);

    // Contagens para mini-stats
    $totalLocalizacoes = (int)$pdo->query("SELECT COUNT(*) FROM Localizacao")->fetchColumn();
    $totalFornecedores = (int)$pdo->query("SELECT COUNT(*) FROM Fornecedor")->fetchColumn();
    $totalGarantias    = (int)$pdo->query("SELECT COUNT(*) FROM Garantia WHERE dataFim >= CURDATE()")->fetchColumn();
    $totalDocumentos   = (int)$pdo->query("SELECT COUNT(*) FROM Documento")->fetchColumn();

    $pdo = null;
} catch (PDOException $e) {
    // Mantém os zeros em caso de erro
}

// Preparar dados para gráficos
$estadoLabels  = array_map(fn($s) => $s->nomeEstado,      $statsEstado);
$estadoValues  = array_map(fn($s) => (int)$s->total,      $statsEstado);
$critLabels    = array_map(fn($s) => $s->nomeCriticidade,  $statsCriticidade);
$critValues    = array_map(fn($s) => (int)$s->total,       $statsCriticidade);

$taxaOperacional = $totalEquipamentos > 0 ? round($totalAtivos / $totalEquipamentos * 100, 1) : 0;
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/nav.php'; ?>

<?php if (!empty($success_message)) : ?>
<div class="position-fixed top-0 end-0 p-3" style="z-index:11">
    <div id="toastSuccess" class="toast align-items-center text-bg-success border-0 show" role="alert">
        <div class="d-flex">
            <div class="toast-body"><?= htmlspecialchars($success_message) ?></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/includes/sidebar.php'; ?>

        <main class="col-md-9 col-lg-10 p-4">

<style>
    .kpi-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px; }
    .kpi-card { background:var(--surface); border-radius:var(--radius); padding:20px; box-shadow:var(--shadow); border:1px solid var(--border); display:flex; align-items:flex-start; gap:14px; }
    .kpi-icon-wrap { width:46px; height:46px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.1em; flex-shrink:0; }
    .kpi-icon-wrap.blue  { background:#dbeafe; color:var(--info); }
    .kpi-icon-wrap.green { background:#dcfce7; color:var(--success); }
    .kpi-icon-wrap.amber { background:#fef3c7; color:var(--warning); }
    .kpi-icon-wrap.red   { background:#fee2e2; color:var(--danger); }
    .kpi-body { flex:1; }
    .kpi-value { font-size:1.7em; font-weight:800; color:var(--text); line-height:1.1; }
    .kpi-label { font-size:0.78em; color:var(--text-muted); margin-top:3px; }

    .mid-grid    { display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-bottom:24px; }
    .bottom-grid { display:grid; grid-template-columns:2fr 1fr; gap:16px; }

    .chart-box { background:var(--surface); border-radius:var(--radius); box-shadow:var(--shadow); border:1px solid var(--border); overflow:hidden; }
    .chart-box canvas { display:block; width:100% !important; }

    .alert-box  { background:var(--surface); border-radius:var(--radius); box-shadow:var(--shadow); border:1px solid var(--border); overflow:hidden; display:flex; flex-direction:column; }
    .alert-list { padding:8px 0; flex:1; }
    .alert-item { display:flex; align-items:center; gap:10px; padding:9px 20px; border-bottom:1px solid var(--border); font-size:0.82em; }
    .alert-item:last-child { border-bottom:none; }
    .alert-dot  { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
    .alert-dot.red   { background:var(--danger); }
    .alert-dot.amber { background:var(--warning); }
    .alert-item-text { flex:1; color:var(--text); }

    .mini-stats { background:var(--surface); border-radius:var(--radius); box-shadow:var(--shadow); border:1px solid var(--border); overflow:hidden; }
    .mini-stat-item { padding:14px 20px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
    .mini-stat-item:last-child { border-bottom:none; }
    .mini-stat-label { font-size:0.82em; color:var(--text-muted); display:flex; align-items:center; gap:8px; }
    .mini-stat-label i { width:14px; color:var(--primary); }
    .mini-stat-value { font-size:0.88em; font-weight:700; color:var(--text); }
    .progress-bar-wrap { padding:6px 20px 14px; }
    .progress-bar-label { display:flex; justify-content:space-between; font-size:0.75em; color:var(--text-muted); margin-bottom:5px; }
    .progress-bar { height:6px; background:var(--border); border-radius:99px; overflow:hidden; }
    .progress-bar-fill { height:100%; border-radius:99px; background:var(--primary); }
    .progress-bar-fill.green { background:var(--success); }

    .search-input { flex:1; max-width:260px; padding:7px 12px 7px 32px; border:1px solid var(--border); border-radius:7px; font-size:0.82em; background:var(--bg) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z'/%3E%3C/svg%3E") no-repeat 10px center / 14px; outline:none; }
    .code-cell { font-family:Consolas,monospace; font-size:0.88em; color:var(--text-muted); }
    .tag { padding:2px 8px; border-radius:20px; font-size:0.78em; font-weight:600; }
    .tag-green { background:#dcfce7; color:#16a34a; }
    .tag-amber { background:#fef3c7; color:#d97706; }
    .tag-red   { background:#fee2e2; color:#dc2626; }
    .tag-blue  { background:#dbeafe; color:#2563eb; }

    @media (max-width:1200px) { .kpi-grid { grid-template-columns:repeat(2,1fr); } .mid-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:900px)  { .bottom-grid { grid-template-columns:1fr; } }
    @media (max-width:700px)  { .kpi-grid { grid-template-columns:1fr; } .mid-grid { grid-template-columns:1fr; } }
</style>

<div class="page">

    <!-- KPIs -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon-wrap blue"><i class="fa-solid fa-stethoscope"></i></div>
            <div class="kpi-body">
                <div class="kpi-value"><?= number_format($totalEquipamentos, 0, ',', ' ') ?></div>
                <div class="kpi-label">Total de Equipamentos</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon-wrap green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="kpi-body">
                <div class="kpi-value"><?= number_format($totalAtivos, 0, ',', ' ') ?></div>
                <div class="kpi-label">Ativos</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon-wrap amber"><i class="fa-solid fa-wrench"></i></div>
            <div class="kpi-body">
                <div class="kpi-value"><?= number_format($totalManutencao, 0, ',', ' ') ?></div>
                <div class="kpi-label">Em Manutenção</div>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon-wrap red"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div class="kpi-body">
                <div class="kpi-value"><?= number_format($garantiasExpirando, 0, ',', ' ') ?></div>
                <div class="kpi-label">Garantias a Expirar (30 dias)</div>
            </div>
        </div>
    </div>

    <!-- LINHA CENTRAL -->
    <div class="mid-grid">
        <div class="chart-box">
            <div class="box-header">
                <h3><i class="fa-solid fa-chart-pie" style="color:var(--primary)"></i> Estado dos Equipamentos</h3>
            </div>
            <div style="padding:16px;">
                <canvas id="chartEstado" width="300" height="200"></canvas>
                <div style="display:flex;gap:16px;justify-content:center;margin-top:12px;font-size:0.78em;color:var(--text-muted);">
                    <?php $cores = ['#22c55e','#f59e0b','#ef4444','#6b7280']; ?>
                    <?php foreach ($statsEstado as $i => $s): ?>
                    <span>
                        <span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:<?= $cores[$i % count($cores)] ?>;margin-right:5px;"></span>
                        <?= htmlspecialchars($s->nomeEstado) ?>
                    </span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="chart-box">
            <div class="box-header">
                <h3><i class="fa-solid fa-chart-bar" style="color:var(--primary)"></i> Por Criticidade</h3>
            </div>
            <div style="padding:16px;">
                <canvas id="chartCriticidade" width="300" height="200"></canvas>
            </div>
        </div>
        <div class="alert-box">
            <div class="box-header">
                <h3><i class="fa-solid fa-bell" style="color:var(--danger)"></i> Alertas</h3>
                <a href="<?= APP_BASE ?>/private/views/garantias/lista.php">Ver todos</a>
            </div>
            <div class="alert-list">
                <?php if ($garantiasExpirando === 0): ?>
                <div class="alert-item">
                    <div class="alert-dot" style="background:var(--success);"></div>
                    <div class="alert-item-text">Nenhuma garantia a expirar nos próximos 30 dias.</div>
                </div>
                <?php else: ?>
                <div class="alert-item">
                    <div class="alert-dot amber"></div>
                    <div class="alert-item-text">
                        <?= $garantiasExpirando ?> garantia<?= $garantiasExpirando > 1 ? 's' : '' ?> a expirar nos próximos 30 dias.
                        <span><a href="<?= APP_BASE ?>/private/views/garantias/lista.php">Ver detalhes</a></span>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($totalManutencao > 0): ?>
                <div class="alert-item">
                    <div class="alert-dot amber"></div>
                    <div class="alert-item-text">
                        <?= $totalManutencao ?> equipamento<?= $totalManutencao > 1 ? 's' : '' ?> em manutenção.
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- LINHA INFERIOR -->
    <div class="bottom-grid">
        <div class="table-box">
            <div class="box-header">
                <h3><i class="fa-solid fa-clock-rotate-left" style="color:var(--primary)"></i> Últimos Registos</h3>
                <a href="<?= APP_BASE ?>/private/views/equipamentos/lista.php">Ver todos</a>
            </div>
            <div style="padding:12px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;">
                <input type="text" class="search-input" placeholder="Pesquisar equipamento..." id="searchTable">
                <a href="<?= APP_BASE ?>/private/views/equipamentos/novo.php" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Adicionar
                </a>
            </div>
            <div class="table-responsive">
                <table id="tabelaDashboard">
                    <thead>
                        <tr><th>Código</th><th>Equipamento</th><th>Localização</th><th>Estado</th><th>Criticidade</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ultimosEquipamentos as $eq):
                            $estadoCss = match(true) {
                                str_contains($eq->nomeEstado, 'Ativo')        => 'tag-green',
                                str_contains($eq->nomeEstado, 'Manutencao')   => 'tag-amber',
                                default                                        => 'tag-red',
                            };
                            $critCss = match($eq->nomeCriticidade) {
                                'Alta'  => 'tag-red',
                                'Media' => 'tag-amber',
                                default => 'tag-blue',
                            };
                        ?>
                        <tr>
                            <td class="code-cell"><?= htmlspecialchars($eq->codigoEquipamento) ?></td>
                            <td>
                                <div style="font-weight:600;"><?= htmlspecialchars($eq->designacao) ?></div>
                                <div style="font-size:0.78em;color:var(--text-muted);"><?= htmlspecialchars(trim($eq->marca . ' ' . $eq->modelo)) ?></div>
                            </td>
                            <td><?= htmlspecialchars($eq->nomeLocalizacao) ?></td>
                            <td><span class="tag <?= $estadoCss ?>"><?= htmlspecialchars($eq->nomeEstado) ?></span></td>
                            <td><span class="tag <?= $critCss ?>"><?= htmlspecialchars($eq->nomeCriticidade) ?></span></td>
                            <td>
                                <a href="<?= APP_BASE ?>/private/views/equipamentos/detalhes.php?id_equipamento=<?= aes_encrypt($eq->idEquipamento) ?>">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mini-stats">
            <div class="box-header">
                <h3><i class="fa-solid fa-info-circle" style="color:var(--primary)"></i> Resumo</h3>
            </div>
            <div class="mini-stat-item">
                <span class="mini-stat-label"><i class="fa-solid fa-map-location-dot"></i> Localizações</span>
                <span class="mini-stat-value"><?= $totalLocalizacoes ?></span>
            </div>
            <div class="mini-stat-item">
                <span class="mini-stat-label"><i class="fa-solid fa-truck-medical"></i> Fornecedores</span>
                <span class="mini-stat-value"><?= $totalFornecedores ?></span>
            </div>
            <div class="mini-stat-item">
                <span class="mini-stat-label"><i class="fa-solid fa-file-contract"></i> Garantias Ativas</span>
                <span class="mini-stat-value"><?= $totalGarantias ?></span>
            </div>
            <div class="mini-stat-item">
                <span class="mini-stat-label"><i class="fa-solid fa-file-pdf"></i> Documentos</span>
                <span class="mini-stat-value"><?= $totalDocumentos ?></span>
            </div>
            <div class="progress-bar-wrap">
                <div class="progress-bar-label">
                    <span>Taxa Operacional</span>
                    <span style="font-weight:700;color:var(--success);"><?= $taxaOperacional ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-bar-fill green" style="width:<?= $taxaOperacional ?>%"></div>
                </div>
            </div>
        </div>
    </div>

</div><!-- /page -->

<?php
$estadoValuesJson = json_encode($estadoValues);
$estadoCoresJson  = json_encode(['#22c55e','#f59e0b','#ef4444','#6b7280']);
$critLabelsJson   = json_encode($critLabels);
$critValuesJson   = json_encode($critValues);

$scriptsExtra = '
<script>
    document.getElementById("searchTable").addEventListener("input", function() {
        const term = this.value.toLowerCase();
        document.querySelectorAll("#tabelaDashboard tbody tr").forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(term) ? "" : "none";
        });
    });
    document.addEventListener("DOMContentLoaded", () => {
        drawDonutChart("chartEstado", ' . $estadoValuesJson . ', ' . $estadoCoresJson . ');
        drawBarChart("chartCriticidade", ' . $critLabelsJson . ', ' . $critValuesJson . ');
    });
    function drawDonutChart(canvasId, values, colors) {
        const canvas = document.getElementById(canvasId); if (!canvas) return;
        const ctx = canvas.getContext("2d");
        const cx = canvas.width/2, cy = canvas.height/2, R = 72, r = 44;
        const total = values.reduce((a,b)=>a+b,0);
        let angle = -Math.PI/2;
        values.forEach((val,i) => {
            if (val === 0) return;
            const sweep=(val/total)*2*Math.PI;
            ctx.beginPath(); ctx.moveTo(cx,cy); ctx.arc(cx,cy,R,angle,angle+sweep); ctx.closePath();
            ctx.fillStyle=colors[i]; ctx.fill(); angle+=sweep;
        });
        ctx.beginPath(); ctx.arc(cx,cy,r,0,2*Math.PI); ctx.fillStyle="white"; ctx.fill();
        ctx.fillStyle="#0f172a"; ctx.font="bold 18px Segoe UI,sans-serif"; ctx.textAlign="center"; ctx.textBaseline="middle";
        ctx.fillText(total.toLocaleString("pt-PT"),cx,cy-8);
        ctx.font="11px Segoe UI,sans-serif"; ctx.fillStyle="#64748b"; ctx.fillText("equipamentos",cx,cy+10);
    }
</script>
';
?>
<?php include __DIR__ . '/includes/footer.php'; ?>
