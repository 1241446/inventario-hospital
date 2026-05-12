-- =====================================================
-- MedControl - Dados de Teste
-- Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
-- =====================================================
-- Pre-requisito: executar primeiro o schema.sql.
-- BD do projeto: db1241446.

USE `db1241446`;

-- ─── CATEGORIAS ──────────────────────────────────────

INSERT INTO Categoria (nomeCategoria, descricao) VALUES
  ('Imagiologia',    'Equipamentos de diagnóstico por imagem')
 ,('Monitorização',  'Equipamentos de monitorização de sinais vitais')
 ,('Cirurgia',       'Equipamentos utilizados em bloco operatório')
 ,('Laboratório',    'Equipamentos de análises clínicas e laboratoriais')
 ,('Reabilitação',   'Equipamentos de fisioterapia e reabilitação');

-- ─── ESTADOS ─────────────────────────────────────────

INSERT INTO Estado (nomeEstado) VALUES
  ('Ativo')
 ,('Em Manutencao')
 ,('Avariado')
 ,('Abatido');

-- ─── CRITICIDADES ────────────────────────────────────

INSERT INTO Criticidade (nomeCriticidade, descricao) VALUES
  ('Alta',   'Equipamento crítico para funções vitais do doente')
 ,('Media',  'Equipamento importante mas com alternativas disponíveis')
 ,('Baixa',  'Equipamento de suporte sem impacto direto no doente');

-- ─── PAÍSES ──────────────────────────────────────────

INSERT INTO Pais (nomePais, codigoISO) VALUES
  ('Portugal',         'PT')
 ,('Alemanha',         'DE')
 ,('Estados Unidos',   'US')
 ,('Franca',           'FR')
 ,('Japao',            'JP');

-- ─── LOCALIZACOES ────────────────────────────────────

INSERT INTO Localizacao (nomeLocalizacao, piso, ala, descricao) VALUES
  ('Bloco Operatório A',   2, 'Norte', 'Bloco operatório principal')
 ,('UCI',                  1, 'Sul',   'Unidade de Cuidados Intensivos')
 ,('Radiologia',           0, 'Este',  'Departamento de imagiologia e radiologia')
 ,('Laboratório Central',  0, 'Oeste', 'Laboratório de análises clínicas')
 ,('Fisioterapia',         1, 'Norte', 'Departamento de reabilitação física');

-- ─── FORNECEDORES ────────────────────────────────────

INSERT INTO Fornecedor (nomeEmpresa, nif, tipoFornecedor, idPais, website, morada, nomeContacto, cargoContacto, telefoneContacto, emailContacto) VALUES
  ('Siemens Healthineers', '500123456', 'FABRICANTE',   2, 'www.siemens-healthineers.com', 'Rua da Inovação 45, Lisboa',      'Hans Mueller',    'Diretor Comercial', '+351210000001', 'hmueller@siemens.com')
 ,('Philips Healthcare',   '500234567', 'FABRICANTE',   3, 'www.philips.com',              'Av. Tecnológica 120, Porto',      'Maria Rodrigues', 'Gestora de Conta',  '+351220000002', 'mrodrigues@philips.com')
 ,('MedTech Portugal',     '500345678', 'DISTRIBUIDOR', 1, 'www.medtech.pt',               'Estrada Nacional 10, Coimbra',   'João Silva',      'Responsável Vendas','+351239000003', 'jsilva@medtech.pt');

-- ─── UTILIZADORES ────────────────────────────────────

INSERT INTO Utilizador (nomeUtilizador, password, nomeCompleto, email, tipoUtilizador, ativo) VALUES
  ('admin',  SHA2('admin123', 256), 'Administrador do Sistema', 'admin@medcontrol.pt',   'ADMINISTRADOR', TRUE)
 ,('carlos', SHA2('senha123', 256), 'Carlos Ferreira',          'carlos@medcontrol.pt',  'TECNICO',       TRUE)
 ,('joana',  SHA2('senha456', 256), 'Joana Pereira',            'joana@medcontrol.pt',   'GESTOR',        TRUE);

-- ─── EQUIPAMENTOS ────────────────────────────────────

INSERT INTO Equipamento (codigoEquipamento, designacao, idCategoria, marca, modelo, numeroSerie, anoFabrico, idEstado, idCriticidade, idLocalizacao) VALUES
  ('EQ-001', 'Ressonância Magnética 3T',        1, 'Siemens', 'MAGNETOM Vida',    'SN-2021-001', 2021, 1, 1, 3)
 ,('EQ-002', 'Monitor de Sinais Vitais',         2, 'Philips', 'IntelliVue MX800', 'SN-2020-002', 2020, 1, 1, 2)
 ,('EQ-003', 'Ventilador Mecânico',              3, 'Draeger', 'Evita Infinity V500','SN-2019-003',2019, 1, 1, 1)
 ,('EQ-004', 'Tomógrafo Computorizado',          1, 'Siemens', 'SOMATOM Drive',    'SN-2022-004', 2022, 1, 1, 3)
 ,('EQ-005', 'Analisador Hematológico',          4, 'Sysmex',  'XN-3000',          'SN-2021-005', 2021, 1, 2, 4)
 ,('EQ-006', 'Eletrocardiógrafo Portátil',       2, 'Philips', 'PageWriter TC70',  'SN-2018-006', 2018, 2, 2, 2)
 ,('EQ-007', 'Mesa Cirúrgica Motorizada',        3, 'Maquet',  'Alphamaxx',        'SN-2020-007', 2020, 1, 2, 1)
 ,('EQ-008', 'Aparelho de Ultrassons Portátil',  1, 'GE',      'Vscan Air',        'SN-2023-008', 2023, 1, 2, 5);

-- ─── AQUISICOES ──────────────────────────────────────

INSERT INTO Aquisicao (idEquipamento, dataAquisicao, custoAquisicao, tipoEntrada, idFornecedor) VALUES
  (1, str_to_date('15-03-2021', '%d-%c-%Y'), 850000.00, 'COMPRA',   1)
 ,(2, str_to_date('10-06-2020', '%d-%c-%Y'),  12500.00, 'COMPRA',   2)
 ,(3, str_to_date('20-09-2019', '%d-%c-%Y'),  45000.00, 'LEASING',  3)
 ,(4, str_to_date('08-01-2022', '%d-%c-%Y'), 620000.00, 'COMPRA',   1)
 ,(5, str_to_date('22-04-2021', '%d-%c-%Y'),  28000.00, 'COMPRA',   3)
 ,(6, str_to_date('05-11-2018', '%d-%c-%Y'),   3200.00, 'COMPRA',   2)
 ,(7, str_to_date('14-02-2020', '%d-%c-%Y'),  95000.00, 'COMPRA',   3)
 ,(8, str_to_date('30-08-2023', '%d-%c-%Y'),   6500.00, 'DOACAO',   NULL);

-- ─── GARANTIAS ───────────────────────────────────────

INSERT INTO Garantia (idEquipamento, dataInicio, dataFim, tipoGarantia, condicoes, idFornecedor) VALUES
  (1, str_to_date('15-03-2021', '%d-%c-%Y'), str_to_date('15-03-2026', '%d-%c-%Y'), 'Completa',   'Cobre peças e mão de obra', 1)
 ,(2, str_to_date('10-06-2020', '%d-%c-%Y'), str_to_date('10-06-2025', '%d-%c-%Y'), 'Completa',   'Cobre peças e mão de obra', 2)
 ,(4, str_to_date('08-01-2022', '%d-%c-%Y'), str_to_date('08-01-2027', '%d-%c-%Y'), 'Completa',   'Cobre peças e mão de obra', 1)
 ,(5, str_to_date('22-04-2021', '%d-%c-%Y'), str_to_date('22-04-2024', '%d-%c-%Y'), 'Limitada',   'Apenas peças originais',    3)
 ,(7, str_to_date('14-02-2020', '%d-%c-%Y'), str_to_date('14-02-2025', '%d-%c-%Y'), 'Completa',   'Cobre peças e mão de obra', 3)
 ,(8, str_to_date('30-08-2023', '%d-%c-%Y'), str_to_date('30-08-2026', '%d-%c-%Y'), 'Fabricante', 'Garantia de fábrica',       NULL);

-- ─── MANUTENCOES ─────────────────────────────────────

INSERT INTO Manutencao (idEquipamento, dataManutencao, tipoManutencao, descricao, idFornecedor, custo) VALUES
  (1, str_to_date('10-09-2022', '%d-%c-%Y'), 'PREVENTIVA', 'Revisão anual e calibração de campos magnéticos', 1,  2500.00)
 ,(2, str_to_date('15-01-2023', '%d-%c-%Y'), 'PREVENTIVA', 'Limpeza e verificação de sensores',               2,   350.00)
 ,(3, str_to_date('20-03-2023', '%d-%c-%Y'), 'CORRETIVA',  'Substituição de válvula expiratória defeituosa',  3,  1200.00)
 ,(6, str_to_date('05-06-2023', '%d-%c-%Y'), 'CORRETIVA',  'Troca de bateria e calibração de eléctrodos',     2,   480.00)
 ,(1, str_to_date('12-09-2023', '%d-%c-%Y'), 'PREVENTIVA', 'Revisão anual e verificação de gradientes',       1,  2700.00)
 ,(4, str_to_date('20-01-2024', '%d-%c-%Y'), 'CALIBRACAO', 'Calibração de detetores e verificação de dose',   1,  1800.00)
 ,(5, str_to_date('08-03-2024', '%d-%c-%Y'), 'PREVENTIVA', 'Manutenção preventiva e troca de reagentes',      3,   600.00);

-- ─── DOCUMENTOS ──────────────────────────────────────

INSERT INTO Documento (idEquipamento, nomeDocumento, tipoDocumento, caminhoArquivo) VALUES
  (1, 'Manual de Operador MAGNETOM Vida',       'MANUAL',         'docs/eq001_manual_operador.pdf')
 ,(1, 'Certificado de Calibração 2023',         'CERTIFICADO',    'docs/eq001_calibracao_2023.pdf')
 ,(2, 'Manual IntelliVue MX800',                'MANUAL',         'docs/eq002_manual.pdf')
 ,(3, 'Contrato de Leasing Ventilador',         'CONTRATO',       'docs/eq003_contrato_leasing.pdf')
 ,(4, 'Especificações Técnicas SOMATOM Drive',  'ESPECIFICACAO',  'docs/eq004_especificacoes.pdf')
 ,(4, 'Certificado de Instalação',              'CERTIFICADO',    'docs/eq004_instalacao.pdf')
 ,(5, 'Manual XN-3000 Português',               'MANUAL',         'docs/eq005_manual_pt.pdf')
 ,(8, 'Manual Vscan Air',                       'MANUAL',         'docs/eq008_manual.pdf');

-- ─── EQUIPAMENTO FORNECEDOR ──────────────────────────

INSERT INTO EquipamentoFornecedor (idEquipamento, idFornecedor) VALUES
  (1, 1)
 ,(2, 2)
 ,(3, 3)
 ,(4, 1)
 ,(5, 3)
 ,(6, 2)
 ,(7, 3);

-- ─── HISTORICO DE ALTERACOES ─────────────────────────

INSERT INTO HistoricoAlteracoes (tabela, tipoOperacao, idRegistro, dataOperacao, idUtilizador, descricaoAlteracao) VALUES
  ('Equipamento', 'INSERT', 1, str_to_date('15-03-2021', '%d-%c-%Y'), 1, 'Registo inicial do equipamento EQ-001')
 ,('Equipamento', 'INSERT', 2, str_to_date('10-06-2020', '%d-%c-%Y'), 1, 'Registo inicial do equipamento EQ-002')
 ,('Equipamento', 'UPDATE', 6, str_to_date('05-06-2023', '%d-%c-%Y'), 2, 'Estado alterado para Em Manutencao')
 ,('Equipamento', 'UPDATE', 6, str_to_date('08-06-2023', '%d-%c-%Y'), 2, 'Estado revertido para Ativo apos manutencao');
