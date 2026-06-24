<?php
// =====================================================
// MedControl – Gestão de Conteúdos
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();
verificarPerfil(['ADMINISTRADOR', 'GESTOR']);

$tituloPagina = 'Conteúdos';
$paginaAtiva  = 'conteudos';

$erro_sistema = '';
$sucesso      = '';

// ─── PROCESSAR AÇÕES POST ────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    try {
        $pdo = get_pdo();

        if ($acao === 'add_noticia') {
            $titulo  = trim($_POST['titulo']  ?? '');
            $resumo  = trim($_POST['resumo']  ?? '');
            $destaque = isset($_POST['destaque']) ? 1 : 0;
            if (!empty($titulo)) {
                $stmt = $pdo->prepare("INSERT INTO Noticia (titulo, resumo, destaque) VALUES (:t, :r, :d)");
                $stmt->execute([':t' => $titulo, ':r' => $resumo ?: null, ':d' => $destaque]);
                $sucesso = 'Notícia adicionada com sucesso.';
            }
        } elseif ($acao === 'delete_noticia') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $pdo->prepare("DELETE FROM Noticia WHERE idNoticia = :id")->execute([':id' => $id]);
                $sucesso = 'Notícia apagada.';
            }
        } elseif ($acao === 'add_testemunho') {
            $empresa = trim($_POST['nomeEmpresa'] ?? '');
            $autor   = trim($_POST['nomeAutor']   ?? '');
            $cargo   = trim($_POST['cargoAutor']  ?? '');
            $texto   = trim($_POST['texto']       ?? '');
            if (!empty($empresa) && !empty($texto)) {
                $stmt = $pdo->prepare("INSERT INTO Testemunho (nomeEmpresa, nomeAutor, cargoAutor, texto) VALUES (:e,:a,:c,:t)");
                $stmt->execute([':e' => $empresa, ':a' => $autor ?: null, ':c' => $cargo ?: null, ':t' => $texto]);
                $sucesso = 'Testemunho adicionado com sucesso.';
            }
        } elseif ($acao === 'delete_testemunho') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $pdo->prepare("DELETE FROM Testemunho WHERE idTestemunho = :id")->execute([':id' => $id]);
                $sucesso = 'Testemunho apagado.';
            }
        } elseif ($acao === 'marcar_lida') {
            $id = (int)($_POST['id'] ?? 0);
            if ($id > 0) {
                $pdo->prepare("UPDATE MensagemContacto SET lida = 1 WHERE idMensagem = :id")->execute([':id' => $id]);
                $sucesso = 'Mensagem marcada como lida.';
            }
        }

        $pdo = null;
        header('Location: gestao.php');
        exit;

    } catch (PDOException $err) {
        $erro_sistema = 'Erro: ' . $err->getMessage();
    }
}

// ─── CARREGAR DADOS ──────────────────────────────────
$noticias    = [];
$destaques   = [];
$testemunhos = [];
$mensagens   = [];

try {
    $pdo = get_pdo();

    $noticias    = $pdo->query("SELECT * FROM Noticia    WHERE destaque = 0 ORDER BY dataPublicacao DESC")->fetchAll(PDO::FETCH_OBJ);
    $destaques   = $pdo->query("SELECT * FROM Noticia    WHERE destaque = 1 ORDER BY dataPublicacao DESC")->fetchAll(PDO::FETCH_OBJ);
    $testemunhos = $pdo->query("SELECT * FROM Testemunho WHERE ativo = 1   ORDER BY dataRegisto DESC")->fetchAll(PDO::FETCH_OBJ);
    $mensagens   = $pdo->query("SELECT * FROM MensagemContacto ORDER BY dataRecebida DESC")->fetchAll(PDO::FETCH_OBJ);
    $pdo = null;
} catch (PDOException $e) {
    $erro_sistema = 'Erro ao carregar dados: ' . $e->getMessage();
}

$totalNoticias    = count($noticias);
$totalDestaques   = count($destaques);
$totalTestemunhos = count($testemunhos);
$totalMensagens   = count(array_filter($mensagens, fn($m) => !$m->lida));
?>
<?php include __DIR__ . '/../../includes/header.php'; ?>
<?php include __DIR__ . '/../../includes/nav.php'; ?>

<div class="container-fluid">
    <div class="row">
        <?php include __DIR__ . '/../../includes/sidebar.php'; ?>
        <main class="col-md-9 col-lg-10 p-4">

<?php if (!empty($erro_sistema)): ?>
<div class="alert alert-danger"><?= htmlspecialchars($erro_sistema) ?></div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
<div class="alert alert-success"><?= htmlspecialchars($sucesso) ?></div>
<?php endif; ?>

<style>
.mc-pane { display: none; }
.mc-pane.mc-active { display: block; }
.mc-tab-link { cursor: pointer; }
.mc-tab-link.active { color: #0ea5e9 !important; border-bottom: 3px solid #0ea5e9; }
</style>

<div class="page">

    <ul class="nav nav-tabs mb-4" id="tabConteudos">
        <li class="nav-item"><a class="nav-link mc-tab-link active" onclick="mcTab('resumo',this)">Resumo</a></li>
        <li class="nav-item"><a class="nav-link mc-tab-link" onclick="mcTab('noticias',this)">Notícias <span class="badge bg-secondary"><?= $totalNoticias ?></span></a></li>
        <li class="nav-item"><a class="nav-link mc-tab-link" onclick="mcTab('destaques',this)">Destaques <span class="badge bg-secondary"><?= $totalDestaques ?></span></a></li>
        <li class="nav-item"><a class="nav-link mc-tab-link" onclick="mcTab('testemunhos',this)">Testemunhos <span class="badge bg-secondary"><?= $totalTestemunhos ?></span></a></li>
        <li class="nav-item"><a class="nav-link mc-tab-link" onclick="mcTab('mensagens',this)">Mensagens <?php if ($totalMensagens > 0): ?><span class="badge bg-danger"><?= $totalMensagens ?></span><?php endif; ?></a></li>
    </ul>

    <div>

        <!-- RESUMO -->
        <div class="mc-pane mc-active" id="resumo">
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <div class="card border-start border-primary border-4 shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold fs-3 text-primary"><?= $totalNoticias ?></div>
                            <div class="text-muted small">Notícias Publicadas</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-start border-success border-4 shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold fs-3 text-success"><?= $totalDestaques ?></div>
                            <div class="text-muted small">Destaques Ativos</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-start border-warning border-4 shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold fs-3 text-warning"><?= $totalTestemunhos ?></div>
                            <div class="text-muted small">Testemunhos</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-start border-danger border-4 shadow-sm">
                        <div class="card-body">
                            <div class="fw-bold fs-3 text-danger"><?= $totalMensagens ?></div>
                            <div class="text-muted small">Mensagens Não Lidas</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-box">
                <p class="text-muted small">
                    Utilize as abas acima para gerir o conteúdo do website do <strong><?= APP_NAME ?></strong>.
                </p>
            </div>
        </div>

        <!-- NOTÍCIAS -->
        <div class="mc-pane" id="noticias">
            <div class="content-box mb-3">
                <h6 class="fw-bold mb-3">Adicionar Notícia</h6>
                <form method="post" action="#">
                    <input type="hidden" name="acao" value="add_noticia">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label small">Título *</label>
                            <input type="text" class="form-control form-control-sm" name="titulo" placeholder="Título da notícia" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small">Resumo</label>
                            <input type="text" class="form-control form-control-sm" name="resumo" placeholder="Breve descrição">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fa-solid fa-plus me-1"></i>Adicionar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($noticias as $n): ?>
            <div class="card mb-2 shadow-sm">
                <div class="card-body py-2 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold"><?= htmlspecialchars($n->titulo) ?></div>
                        <?php if ($n->resumo): ?><div class="text-muted small"><?= htmlspecialchars($n->resumo) ?></div><?php endif; ?>
                        <div class="text-muted" style="font-size:0.72em;"><?= date('d/m/Y H:i', strtotime($n->dataPublicacao)) ?></div>
                    </div>
                    <form method="post" action="#" onsubmit="return confirm('Apagar esta notícia?')">
                        <input type="hidden" name="acao" value="delete_noticia">
                        <input type="hidden" name="id" value="<?= $n->idNoticia ?>">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($noticias)): ?><p class="text-muted small">Sem notícias registadas.</p><?php endif; ?>
        </div>

        <!-- DESTAQUES -->
        <div class="mc-pane" id="destaques">
            <div class="content-box mb-3">
                <h6 class="fw-bold mb-3">Adicionar Destaque</h6>
                <form method="post" action="#">
                    <input type="hidden" name="acao" value="add_noticia">
                    <input type="hidden" name="destaque" value="1">
                    <div class="row g-2 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label small">Título *</label>
                            <input type="text" class="form-control form-control-sm" name="titulo" placeholder="Título do destaque" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label small">Descrição</label>
                            <input type="text" class="form-control form-control-sm" name="resumo" placeholder="Breve descrição">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fa-solid fa-plus me-1"></i>Adicionar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($destaques as $d): ?>
            <div class="card mb-2 shadow-sm">
                <div class="card-body py-2 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold"><i class="fa-solid fa-star text-warning me-1"></i><?= htmlspecialchars($d->titulo) ?></div>
                        <?php if ($d->resumo): ?><div class="text-muted small"><?= htmlspecialchars($d->resumo) ?></div><?php endif; ?>
                    </div>
                    <form method="post" action="#" onsubmit="return confirm('Apagar este destaque?')">
                        <input type="hidden" name="acao" value="delete_noticia">
                        <input type="hidden" name="id" value="<?= $d->idNoticia ?>">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($destaques)): ?><p class="text-muted small">Sem destaques registados.</p><?php endif; ?>
        </div>

        <!-- TESTEMUNHOS -->
        <div class="mc-pane" id="testemunhos">
            <div class="content-box mb-3">
                <h6 class="fw-bold mb-3">Adicionar Testemunho</h6>
                <form method="post" action="#">
                    <input type="hidden" name="acao" value="add_testemunho">
                    <div class="row g-2 mb-2">
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" name="nomeEmpresa" placeholder="Nome da Empresa *" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" name="nomeAutor" placeholder="Nome do Autor">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control form-control-sm" name="cargoAutor" placeholder="Cargo">
                        </div>
                    </div>
                    <div class="row g-2 align-items-end">
                        <div class="col-md-10">
                            <textarea class="form-control form-control-sm" name="texto" rows="2" placeholder="Texto do testemunho *" required></textarea>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fa-solid fa-plus me-1"></i>Adicionar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <?php foreach ($testemunhos as $t): ?>
            <div class="card mb-2 shadow-sm">
                <div class="card-body py-2 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-semibold"><i class="fa-solid fa-quote-left text-primary me-1"></i><?= htmlspecialchars($t->nomeEmpresa) ?></div>
                        <div class="text-muted small fst-italic">"<?= htmlspecialchars($t->texto) ?>"</div>
                        <?php if ($t->nomeAutor): ?>
                        <div class="text-muted" style="font-size:0.78em;"><?= htmlspecialchars($t->nomeAutor) ?><?= $t->cargoAutor ? ', ' . htmlspecialchars($t->cargoAutor) : '' ?></div>
                        <?php endif; ?>
                    </div>
                    <form method="post" action="#" onsubmit="return confirm('Apagar este testemunho?')">
                        <input type="hidden" name="acao" value="delete_testemunho">
                        <input type="hidden" name="id" value="<?= $t->idTestemunho ?>">
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($testemunhos)): ?><p class="text-muted small">Sem testemunhos registados.</p><?php endif; ?>
        </div>

        <!-- MENSAGENS -->
        <div class="mc-pane" id="mensagens">
            <?php foreach ($mensagens as $m): ?>
            <div class="card mb-2 shadow-sm <?= $m->lida ? 'opacity-75' : 'border-warning' ?>">
                <div class="card-body py-2">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-semibold">
                                <?php if (!$m->lida): ?><span class="badge bg-warning text-dark me-1">Nova</span><?php endif; ?>
                                <i class="fa-solid fa-envelope me-1 text-primary"></i><?= htmlspecialchars($m->assunto ?? '(sem assunto)') ?>
                            </div>
                            <div class="text-muted small"><strong>De:</strong> <?= htmlspecialchars($m->nomeRemetente) ?> (<?= htmlspecialchars($m->emailRemetente) ?>)</div>
                            <div class="small mt-1"><?= htmlspecialchars($m->mensagem) ?></div>
                            <div class="text-muted" style="font-size:0.72em;"><?= date('d/m/Y H:i', strtotime($m->dataRecebida)) ?></div>
                        </div>
                        <?php if (!$m->lida): ?>
                        <form method="post" action="#">
                            <input type="hidden" name="acao" value="marcar_lida">
                            <input type="hidden" name="id" value="<?= $m->idMensagem ?>">
                            <button type="submit" class="btn btn-outline-secondary btn-sm">
                                <i class="fa-solid fa-check me-1"></i>Marcar como lida
                            </button>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php if (empty($mensagens)): ?><p class="text-muted small">Sem mensagens de contacto.</p><?php endif; ?>
        </div>

    </div>
</div><!-- /page -->

<?php $scriptsExtra = '
<script>
function mcTab(id, el) {
    document.querySelectorAll(".mc-pane").forEach(function(p){ p.classList.remove("mc-active"); });
    document.querySelectorAll(".mc-tab-link").forEach(function(a){ a.classList.remove("active"); });
    document.getElementById(id).classList.add("mc-active");
    el.classList.add("active");
}
</script>
'; ?>
<?php include __DIR__ . '/../../includes/footer.php'; ?>
