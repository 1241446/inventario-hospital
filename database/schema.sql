-- =====================================================
-- MedControl - Modelo Fisico
-- Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
-- =====================================================

-- ─── BASE DE DADOS ───────────────────────────────────
-- Conforme o Guia de Submissao SIBDAS, a BD a utilizar e
-- a que ja esta disponivel apos a ligacao ao servidor
-- (vsgate-s1.dei.isep.ipp.pt:10464) com as credenciais do
-- estudante - nao se cria uma nova BD.
-- Antes de executar este script, selecionar essa BD no
-- HeidiSQL (clicar nela na arvore da esquerda) e substituir
-- "NOME_DA_BD" abaixo pelo nome real apresentado.

USE `db1241446`;

-- ─── LIMPEZA (script reexecutavel) ──────────────────
-- Remove apenas as tabelas deste projeto, pela ordem
-- inversa das dependencias, para nao deixar resto de
-- execucoes anteriores nem afetar outras tabelas que
-- eventualmente existam na BD.

DROP TABLE IF EXISTS HistoricoAlteracoes;
DROP TABLE IF EXISTS EquipamentoFornecedor;
DROP TABLE IF EXISTS Documento;
DROP TABLE IF EXISTS Manutencao;
DROP TABLE IF EXISTS Garantia;
DROP TABLE IF EXISTS Aquisicao;
DROP TABLE IF EXISTS Equipamento;
DROP TABLE IF EXISTS Utilizador;
DROP TABLE IF EXISTS Fornecedor;
DROP TABLE IF EXISTS Pais;
DROP TABLE IF EXISTS Localizacao;
DROP TABLE IF EXISTS Criticidade;
DROP TABLE IF EXISTS Estado;
DROP TABLE IF EXISTS Categoria;

-- ─── TABELAS SEM DEPENDENCIAS ───────────────────────

CREATE TABLE Categoria (
    idCategoria   integer
        auto_increment,
    nomeCategoria varchar(100)
        NOT NULL
        UNIQUE,
    descricao     text,
    CONSTRAINT pkCategoriaIdCategoria PRIMARY KEY (idCategoria)
);

CREATE TABLE Estado (
    idEstado   integer
        auto_increment,
    nomeEstado varchar(50)
        NOT NULL
        UNIQUE
        CONSTRAINT ckEstadoNomeEstado CHECK (char_length(trim(nomeEstado)) > 0),
    CONSTRAINT pkEstadoIdEstado PRIMARY KEY (idEstado)
);

CREATE TABLE Criticidade (
    idCriticidade   integer
        auto_increment,
    nomeCriticidade varchar(50)
        NOT NULL
        UNIQUE
        CONSTRAINT ckCriticidadeNomeCriticidade CHECK (char_length(trim(nomeCriticidade)) > 0),
    descricao       text,
    CONSTRAINT pkCriticidadeIdCriticidade PRIMARY KEY (idCriticidade)
);

CREATE TABLE Localizacao (
    idLocalizacao   integer
        auto_increment,
    nomeLocalizacao varchar(100)
        NOT NULL
        UNIQUE,
    piso            integer,
    ala             varchar(50),
    descricao       text,
    dataRegisto     datetime
        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkLocalizacaoIdLocalizacao PRIMARY KEY (idLocalizacao)
);

CREATE TABLE Pais (
    idPais    integer
        auto_increment,
    nomePais  varchar(100)
        NOT NULL
        UNIQUE,
    codigoISO varchar(2),
    CONSTRAINT pkPaisIdPais PRIMARY KEY (idPais)
);

-- ─── TABELAS COM DEPENDENCIAS ────────────────────────

CREATE TABLE Fornecedor (
    idFornecedor     integer
        auto_increment,
    nomeEmpresa      varchar(100)
        NOT NULL,
    nif              varchar(20)
        NOT NULL
        UNIQUE,
    tipoFornecedor   varchar(50)
        NOT NULL
        CONSTRAINT ckFornecedorTipoFornecedor CHECK (UPPER(tipoFornecedor) IN ('FABRICANTE', 'DISTRIBUIDOR', 'FORNECEDOR')),
    idPais           integer,
    website          varchar(255),
    morada           text
        NOT NULL,
    nomeContacto     varchar(100),
    cargoContacto    varchar(100),
    telefoneContacto varchar(20),
    emailContacto    varchar(100)
        NOT NULL
        UNIQUE
        CONSTRAINT ckFornecedorEmailContacto CHECK (
            regexp_like (
                emailContacto,
                '^([[:alnum:]]+\.)+@([[:alnum:]]+\.)+[[:alpha:]]{2,}$',
                'i'
            )
        ),
    observacoes      text,
    dataCriacao      datetime
        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkFornecedorIdFornecedor PRIMARY KEY (idFornecedor)
);

CREATE TABLE Utilizador (
    idUtilizador   integer
        auto_increment,
    nomeUtilizador varchar(100)
        NOT NULL
        UNIQUE,
    password       varchar(255)
        NOT NULL,
    nomeCompleto   varchar(150)
        NOT NULL,
    email          varchar(100)
        NOT NULL
        UNIQUE
        CONSTRAINT ckUtilizadorEmail CHECK (
            regexp_like (
                email,
                '^([[:alnum:]]+\.)+@([[:alnum:]]+\.)+[[:alpha:]]{2,}$',
                'i'
            )
        ),
    tipoUtilizador varchar(50)
        CONSTRAINT ckUtilizadorTipoUtilizador CHECK (UPPER(tipoUtilizador) IN ('ADMINISTRADOR', 'TECNICO', 'GESTOR', 'CONSULTOR')),
    ativo          boolean
        DEFAULT TRUE,
    dataCriacao    datetime
        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkUtilizadorIdUtilizador PRIMARY KEY (idUtilizador)
);

CREATE TABLE Equipamento (
    idEquipamento     integer
        auto_increment,
    codigoEquipamento varchar(50)
        NOT NULL
        UNIQUE,
    designacao        varchar(200)
        NOT NULL,
    idCategoria       integer
        NOT NULL,
    marca             varchar(100),
    modelo            varchar(100),
    numeroSerie       varchar(100)
        UNIQUE,
    anoFabrico        integer
        CONSTRAINT ckEquipamentoAnoFabrico CHECK (anoFabrico > 1900),
    idEstado          integer
        NOT NULL,
    idCriticidade     integer
        NOT NULL,
    idLocalizacao     integer
        NOT NULL,
    observacoes       text,
    dataCriacao       datetime
        DEFAULT CURRENT_TIMESTAMP,
    dataAtualizacao   datetime
        DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pkEquipamentoIdEquipamento PRIMARY KEY (idEquipamento)
);

CREATE TABLE Aquisicao (
    idAquisicao   integer
        auto_increment,
    idEquipamento integer
        NOT NULL,
    dataAquisicao date
        NOT NULL,
    custoAquisicao decimal(10,2)
        CONSTRAINT ckAquisicaoCustoAquisicao CHECK (custoAquisicao >= 0),
    tipoEntrada   varchar(50)
        CONSTRAINT ckAquisicaoTipoEntrada CHECK (UPPER(tipoEntrada) IN ('COMPRA', 'LEASING', 'DOACAO')),
    idFornecedor  integer,
    observacoes   text,
    CONSTRAINT pkAquisicaoIdAquisicao PRIMARY KEY (idAquisicao)
);

CREATE TABLE Garantia (
    idGarantia    integer
        auto_increment,
    idEquipamento integer
        NOT NULL,
    dataInicio    date
        NOT NULL,
    dataFim       date
        NOT NULL,
    tipoGarantia  varchar(100),
    condicoes     text,
    idFornecedor  integer,
    observacoes   text,
    dataCriacao   datetime
        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkGarantiaIdGarantia    PRIMARY KEY (idGarantia),
    CONSTRAINT ckGarantiaDataFimInicio CHECK (dataFim > dataInicio)
);

CREATE TABLE Manutencao (
    idManutencao   integer
        auto_increment,
    idEquipamento  integer
        NOT NULL,
    dataManutencao date
        NOT NULL,
    tipoManutencao varchar(100)
        CONSTRAINT ckManutencaoTipoManutencao CHECK (UPPER(tipoManutencao) IN ('PREVENTIVA', 'CORRETIVA', 'CALIBRACAO')),
    descricao      text,
    idFornecedor   integer,
    custo          decimal(10,2)
        CONSTRAINT ckManutencaoCusto CHECK (custo >= 0),
    observacoes    text,
    CONSTRAINT pkManutencaoIdManutencao PRIMARY KEY (idManutencao)
);

CREATE TABLE Documento (
    idDocumento    integer
        auto_increment,
    idEquipamento  integer
        NOT NULL,
    nomeDocumento  varchar(200)
        NOT NULL,
    tipoDocumento  varchar(100)
        CONSTRAINT ckDocumentoTipoDocumento CHECK (UPPER(tipoDocumento) IN ('MANUAL', 'CERTIFICADO', 'CONTRATO', 'ESPECIFICACAO', 'OUTRO')),
    caminhoArquivo varchar(500),
    dataUpload     datetime
        DEFAULT CURRENT_TIMESTAMP,
    observacoes    text,
    CONSTRAINT pkDocumentoIdDocumento PRIMARY KEY (idDocumento)
);

CREATE TABLE EquipamentoFornecedor (
    idEquipamento  integer
        NOT NULL,
    idFornecedor   integer
        NOT NULL,
    dataAssociacao datetime
        DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkEquipamentoFornecedor PRIMARY KEY (idEquipamento, idFornecedor)
);

CREATE TABLE HistoricoAlteracoes (
    idHistorico        integer
        auto_increment,
    tabela             varchar(100),
    tipoOperacao       varchar(20)
        CONSTRAINT ckHistoricoAlteracoesTipoOperacao CHECK (UPPER(tipoOperacao) IN ('INSERT', 'UPDATE', 'DELETE')),
    idRegistro         integer,
    dataOperacao       datetime
        DEFAULT CURRENT_TIMESTAMP,
    idUtilizador       integer,
    descricaoAlteracao text,
    CONSTRAINT pkHistoricoAlteracoesIdHistorico PRIMARY KEY (idHistorico)
);

-- ─── CHAVES ESTRANGEIRAS ─────────────────────────────

ALTER TABLE
    Fornecedor
ADD
    CONSTRAINT fkFornecedorIdPaisPaisIdPais FOREIGN KEY (idPais) REFERENCES Pais (idPais);

ALTER TABLE
    Equipamento
ADD
    CONSTRAINT fkEquipamentoIdCategoriaCategoriaidCategoria FOREIGN KEY (idCategoria) REFERENCES Categoria (idCategoria);

ALTER TABLE
    Equipamento
ADD
    CONSTRAINT fkEquipamentoIdEstadoEstadoIdEstado FOREIGN KEY (idEstado) REFERENCES Estado (idEstado);

ALTER TABLE
    Equipamento
ADD
    CONSTRAINT fkEquipamentoIdCriticidadeCriticidadeIdCriticidade FOREIGN KEY (idCriticidade) REFERENCES Criticidade (idCriticidade);

ALTER TABLE
    Equipamento
ADD
    CONSTRAINT fkEquipamentoIdLocalizacaoLocalizacaoIdLocalizacao FOREIGN KEY (idLocalizacao) REFERENCES Localizacao (idLocalizacao);

ALTER TABLE
    Aquisicao
ADD
    CONSTRAINT fkAquisicaoIdEquipamentoEquipamentoIdEquipamento FOREIGN KEY (idEquipamento) REFERENCES Equipamento (idEquipamento) ON DELETE CASCADE;

ALTER TABLE
    Aquisicao
ADD
    CONSTRAINT fkAquisicaoIdFornecedorFornecedorIdFornecedor FOREIGN KEY (idFornecedor) REFERENCES Fornecedor (idFornecedor);

ALTER TABLE
    Garantia
ADD
    CONSTRAINT fkGarantiaIdEquipamentoEquipamentoIdEquipamento FOREIGN KEY (idEquipamento) REFERENCES Equipamento (idEquipamento) ON DELETE CASCADE;

ALTER TABLE
    Garantia
ADD
    CONSTRAINT fkGarantiaIdFornecedorFornecedorIdFornecedor FOREIGN KEY (idFornecedor) REFERENCES Fornecedor (idFornecedor);

ALTER TABLE
    Manutencao
ADD
    CONSTRAINT fkManutencaoIdEquipamentoEquipamentoIdEquipamento FOREIGN KEY (idEquipamento) REFERENCES Equipamento (idEquipamento) ON DELETE CASCADE;

ALTER TABLE
    Manutencao
ADD
    CONSTRAINT fkManutencaoIdFornecedorFornecedorIdFornecedor FOREIGN KEY (idFornecedor) REFERENCES Fornecedor (idFornecedor);

ALTER TABLE
    Documento
ADD
    CONSTRAINT fkDocumentoIdEquipamentoEquipamentoIdEquipamento FOREIGN KEY (idEquipamento) REFERENCES Equipamento (idEquipamento) ON DELETE CASCADE;

ALTER TABLE
    EquipamentoFornecedor
ADD
    CONSTRAINT fkEquipamentoFornecedorIdEquipamentoEquipamentoIdEquipamento FOREIGN KEY (idEquipamento) REFERENCES Equipamento (idEquipamento) ON DELETE CASCADE;

ALTER TABLE
    EquipamentoFornecedor
ADD
    CONSTRAINT fkEquipamentoFornecedorIdFornecedorFornecedorIdFornecedor FOREIGN KEY (idFornecedor) REFERENCES Fornecedor (idFornecedor) ON DELETE CASCADE;

ALTER TABLE
    HistoricoAlteracoes
ADD
    CONSTRAINT fkHistoricoAlteracoesIdUtilizadorUtilizadorIdUtilizador FOREIGN KEY (idUtilizador) REFERENCES Utilizador (idUtilizador);
