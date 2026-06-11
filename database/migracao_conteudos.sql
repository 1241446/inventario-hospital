-- =====================================================
-- MedControl - Migracao: Tabelas de Conteudos
-- Estudante: 1241446 | SIBDAS LEBIOM 2025-2026
-- =====================================================
-- Executar este ficheiro no HeidiSQL SEM apagar as
-- tabelas ja existentes (nao corre o schema.sql completo).
-- =====================================================

USE `db1241446`;

-- ─── CRIAR TABELAS ───────────────────────────────────

CREATE TABLE IF NOT EXISTS Noticia (
    idNoticia      integer        auto_increment,
    titulo         varchar(200)   NOT NULL,
    resumo         text,
    destaque       boolean        DEFAULT FALSE,
    publicada      boolean        DEFAULT TRUE,
    dataPublicacao datetime       DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkNoticiaIdNoticia PRIMARY KEY (idNoticia)
);

CREATE TABLE IF NOT EXISTS Testemunho (
    idTestemunho integer      auto_increment,
    nomeEmpresa  varchar(100) NOT NULL,
    nomeAutor    varchar(100),
    cargoAutor   varchar(100),
    texto        text         NOT NULL,
    ativo        boolean      DEFAULT TRUE,
    dataRegisto  datetime     DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkTestemunhoIdTestemunho PRIMARY KEY (idTestemunho)
);

CREATE TABLE IF NOT EXISTS MensagemContacto (
    idMensagem     integer      auto_increment,
    nomeRemetente  varchar(100) NOT NULL,
    emailRemetente varchar(100) NOT NULL,
    assunto        varchar(200),
    mensagem       text         NOT NULL,
    lida           boolean      DEFAULT FALSE,
    dataRecebida   datetime     DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT pkMensagemContactoIdMensagem PRIMARY KEY (idMensagem)
);

-- ─── DADOS INICIAIS ──────────────────────────────────

INSERT INTO Noticia (titulo, resumo, destaque, publicada) VALUES
  ('MedControl Apresenta Nova Versão', 'Lançamento da versão com novas funcionalidades de análise avançada e melhorias de desempenho.', FALSE, TRUE)
 ,('Integração com Sistema ERP', 'Nova integração API permite sincronização automática com sistemas ERP hospitalares.', FALSE, TRUE)
 ,('Solução Completa de Gestão', 'Da identificação ao acompanhamento, o MedControl oferece uma solução integrada.', TRUE, TRUE)
 ,('Suporte 24/7 Dedicado', 'Equipa técnica sempre disponível para resolver qualquer questão.', TRUE, TRUE);

INSERT INTO Testemunho (nomeEmpresa, nomeAutor, cargoAutor, texto) VALUES
  ('Hospital de São João', 'Dr. Carlos Ferreira', 'Diretor de Tecnologia', 'Desde que implementámos o MedControl, temos visibilidade total do nosso parque de equipamentos.')
 ,('Hospital da Luz', 'Eng. Paula Ribeiro', 'Gestora de Infraestruturas', 'O sistema é muito intuitivo. Os técnicos aprenderam a usar rapidamente.');

INSERT INTO MensagemContacto (nomeRemetente, emailRemetente, assunto, mensagem) VALUES
  ('João Silva', 'joao@hospital.pt', 'Solicitar Demo', 'Gostaria de conhecer melhor o sistema MedControl. Podem agendar uma demonstração?')
 ,('Maria Costa', 'maria@hospital.net', 'Informações Gerais', 'Qual é o tempo de implementação típico do sistema?');
