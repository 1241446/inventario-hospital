<?php
// =====================================================
// MedControl – Executar Desativação de Equipamento
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../includes/funcoes.php';
require_once __DIR__ . '/../../includes/sessao.php';

redirect_if_not_logged();

$idEncrypted = $_GET['id_equipamento'] ?? null;
$id          = aes_decrypt($idEncrypted);

if (!$id || !is_numeric($id) || $id <= 0) {
    header('Location: lista.php');
    exit;
}

try {
    $pdo  = get_pdo();
    $stmt = $pdo->prepare("
        UPDATE Equipamento
           SET idEstado = (SELECT idEstado FROM Estado WHERE nomeEstado = 'Abatido' LIMIT 1)
         WHERE idEquipamento = :id
    ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    registarLog('DESATIVAR_EQUIPAMENTO', "idEquipamento=$id por " . ($_SESSION['utilizador'] ?? 'desconhecido'));
    $_SESSION['toast'] = ['msg' => 'Equipamento desativado com sucesso.', 'type' => 'success'];
    header('Location: lista.php');
    exit;

} catch (PDOException $e) {
    registarLog('ERRO_DESATIVAR_EQUIPAMENTO', $e->getMessage());
    $_SESSION['toast'] = ['msg' => 'Erro ao desativar equipamento.', 'type' => 'danger'];
    header('Location: lista.php');
    exit;
}
