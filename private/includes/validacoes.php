<?php
// =====================================================
// MedControl – Funções de Validação (Ficha 13)
// Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
// =====================================================

function validar_designacao(string $designacao): array
{
    $erros = [];
    if (empty(trim($designacao))) {
        $erros[] = "O campo Designação é obrigatório.";
    }
    return $erros;
}

function validar_codigo(string $codigo): array
{
    $erros = [];
    if (empty(trim($codigo))) {
        $erros[] = "O campo Código é obrigatório.";
    } elseif (!preg_match('/^[A-Za-z]{2}-\d{3}$/', $codigo)) {
        $erros[] = "Código inválido. Use o formato EQ-001 (2 letras, hífen, 3 dígitos).";
    }
    return $erros;
}

function validar_ano_fabrico(string $ano): array
{
    $erros = [];
    if (!empty(trim($ano))) {
        if (!preg_match('/^\d{4}$/', $ano)) {
            $erros[] = "Ano de fabrico inválido. Use o formato AAAA (ex: 2021).";
        } else {
            $anoInt = (int)$ano;
            if ($anoInt < 1900 || $anoInt > (int)date('Y')) {
                $erros[] = "Ano de fabrico fora do intervalo válido (1900 – " . date('Y') . ").";
            }
        }
    }
    return $erros;
}
