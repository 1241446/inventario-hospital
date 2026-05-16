-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: vsgate-s1.dei.isep.ipp.pt    Database: db1241446
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Aquisicao`
--

DROP TABLE IF EXISTS `Aquisicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Aquisicao` (
  `idAquisicao` int NOT NULL AUTO_INCREMENT,
  `idEquipamento` int NOT NULL,
  `dataAquisicao` date NOT NULL,
  `custoAquisicao` decimal(10,2) DEFAULT NULL,
  `tipoEntrada` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idFornecedor` int DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idAquisicao`),
  KEY `fkAquisicaoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkAquisicaoIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkAquisicaoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkAquisicaoIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckAquisicaoCustoAquisicao` CHECK ((`custoAquisicao` >= 0)),
  CONSTRAINT `ckAquisicaoTipoEntrada` CHECK ((upper(`tipoEntrada`) in (_utf8mb4'COMPRA',_utf8mb4'LEASING',_utf8mb4'DOACAO')))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Aquisicao`
--

LOCK TABLES `Aquisicao` WRITE;
/*!40000 ALTER TABLE `Aquisicao` DISABLE KEYS */;
INSERT INTO `Aquisicao` (`idAquisicao`, `idEquipamento`, `dataAquisicao`, `custoAquisicao`, `tipoEntrada`, `idFornecedor`, `observacoes`) VALUES (1,1,'2021-03-15',850000.00,'COMPRA',1,NULL),(2,2,'2020-06-10',12500.00,'COMPRA',2,NULL),(3,3,'2019-09-20',45000.00,'LEASING',3,NULL),(4,4,'2022-01-08',620000.00,'COMPRA',1,NULL),(5,5,'2021-04-22',28000.00,'COMPRA',3,NULL),(6,6,'2018-11-05',3200.00,'COMPRA',2,NULL),(7,7,'2020-02-14',95000.00,'COMPRA',3,NULL),(8,8,'2023-08-30',6500.00,'DOACAO',NULL,NULL);
/*!40000 ALTER TABLE `Aquisicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categoria` (
  `idCategoria` int NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `nomeCategoria` (`nomeCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categoria`
--

LOCK TABLES `Categoria` WRITE;
/*!40000 ALTER TABLE `Categoria` DISABLE KEYS */;
INSERT INTO `Categoria` (`idCategoria`, `nomeCategoria`, `descricao`) VALUES (1,'Imagiologia','Equipamentos de diagnóstico por imagem'),(2,'Monitorização','Equipamentos de monitorização de sinais vitais'),(3,'Cirurgia','Equipamentos utilizados em bloco operatório'),(4,'Laboratório','Equipamentos de análises clínicas e laboratoriais'),(5,'Reabilitação','Equipamentos de fisioterapia e reabilitação');
/*!40000 ALTER TABLE `Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Criticidade`
--

DROP TABLE IF EXISTS `Criticidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Criticidade` (
  `idCriticidade` int NOT NULL AUTO_INCREMENT,
  `nomeCriticidade` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idCriticidade`),
  UNIQUE KEY `nomeCriticidade` (`nomeCriticidade`),
  CONSTRAINT `ckCriticidadeNomeCriticidade` CHECK ((char_length(trim(`nomeCriticidade`)) > 0))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Criticidade`
--

LOCK TABLES `Criticidade` WRITE;
/*!40000 ALTER TABLE `Criticidade` DISABLE KEYS */;
INSERT INTO `Criticidade` (`idCriticidade`, `nomeCriticidade`, `descricao`) VALUES (1,'Alta','Equipamento crítico para funções vitais do doente'),(2,'Media','Equipamento importante mas com alternativas disponíveis'),(3,'Baixa','Equipamento de suporte sem impacto direto no doente');
/*!40000 ALTER TABLE `Criticidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Documento`
--

DROP TABLE IF EXISTS `Documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Documento` (
  `idDocumento` int NOT NULL AUTO_INCREMENT,
  `idEquipamento` int NOT NULL,
  `nomeDocumento` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoDocumento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caminhoArquivo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataUpload` datetime DEFAULT CURRENT_TIMESTAMP,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idDocumento`),
  KEY `fkDocumentoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  CONSTRAINT `fkDocumentoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `ckDocumentoTipoDocumento` CHECK ((upper(`tipoDocumento`) in (_utf8mb4'MANUAL',_utf8mb4'CERTIFICADO',_utf8mb4'CONTRATO',_utf8mb4'ESPECIFICACAO',_utf8mb4'OUTRO')))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Documento`
--

LOCK TABLES `Documento` WRITE;
/*!40000 ALTER TABLE `Documento` DISABLE KEYS */;
INSERT INTO `Documento` (`idDocumento`, `idEquipamento`, `nomeDocumento`, `tipoDocumento`, `caminhoArquivo`, `dataUpload`, `observacoes`) VALUES (1,1,'Manual de Operador MAGNETOM Vida','MANUAL','docs/eq001_manual_operador.pdf','2026-06-21 23:20:46',NULL),(2,1,'Certificado de Calibração 2023','CERTIFICADO','docs/eq001_calibracao_2023.pdf','2026-06-21 23:20:46',NULL),(3,2,'Manual IntelliVue MX800','MANUAL','docs/eq002_manual.pdf','2026-06-21 23:20:46',NULL),(4,3,'Contrato de Leasing Ventilador','CONTRATO','docs/eq003_contrato_leasing.pdf','2026-06-21 23:20:46',NULL),(5,4,'Especificações Técnicas SOMATOM Drive','ESPECIFICACAO','docs/eq004_especificacoes.pdf','2026-06-21 23:20:46',NULL),(6,4,'Certificado de Instalação','CERTIFICADO','docs/eq004_instalacao.pdf','2026-06-21 23:20:46',NULL),(7,5,'Manual XN-3000 Português','MANUAL','docs/eq005_manual_pt.pdf','2026-06-21 23:20:46',NULL),(8,8,'Manual Vscan Air','MANUAL','docs/eq008_manual.pdf','2026-06-21 23:20:46',NULL);
/*!40000 ALTER TABLE `Documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Equipamento`
--

DROP TABLE IF EXISTS `Equipamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Equipamento` (
  `idEquipamento` int NOT NULL AUTO_INCREMENT,
  `codigoEquipamento` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designacao` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idCategoria` int NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numeroSerie` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anoFabrico` int DEFAULT NULL,
  `idEstado` int NOT NULL,
  `idCriticidade` int NOT NULL,
  `idLocalizacao` int NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `dataAtualizacao` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEquipamento`),
  UNIQUE KEY `codigoEquipamento` (`codigoEquipamento`),
  UNIQUE KEY `numeroSerie` (`numeroSerie`),
  KEY `fkEquipamentoIdCategoriaCategoriaidCategoria` (`idCategoria`),
  KEY `fkEquipamentoIdEstadoEstadoIdEstado` (`idEstado`),
  KEY `fkEquipamentoIdCriticidadeCriticidadeIdCriticidade` (`idCriticidade`),
  KEY `fkEquipamentoIdLocalizacaoLocalizacaoIdLocalizacao` (`idLocalizacao`),
  CONSTRAINT `fkEquipamentoIdCategoriaCategoriaidCategoria` FOREIGN KEY (`idCategoria`) REFERENCES `Categoria` (`idCategoria`),
  CONSTRAINT `fkEquipamentoIdCriticidadeCriticidadeIdCriticidade` FOREIGN KEY (`idCriticidade`) REFERENCES `Criticidade` (`idCriticidade`),
  CONSTRAINT `fkEquipamentoIdEstadoEstadoIdEstado` FOREIGN KEY (`idEstado`) REFERENCES `Estado` (`idEstado`),
  CONSTRAINT `fkEquipamentoIdLocalizacaoLocalizacaoIdLocalizacao` FOREIGN KEY (`idLocalizacao`) REFERENCES `Localizacao` (`idLocalizacao`),
  CONSTRAINT `ckEquipamentoAnoFabrico` CHECK ((`anoFabrico` > 1900))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipamento`
--

LOCK TABLES `Equipamento` WRITE;
/*!40000 ALTER TABLE `Equipamento` DISABLE KEYS */;
INSERT INTO `Equipamento` (`idEquipamento`, `codigoEquipamento`, `designacao`, `idCategoria`, `marca`, `modelo`, `numeroSerie`, `anoFabrico`, `idEstado`, `idCriticidade`, `idLocalizacao`, `observacoes`, `dataCriacao`, `dataAtualizacao`) VALUES (1,'EQ-001','Ressonância Magnética 3T',1,'Siemens','MAGNETOM Vida','SN-2021-001',2021,1,1,3,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(2,'EQ-002','Monitor de Sinais Vitais',2,'Philips','IntelliVue MX800','SN-2020-002',2020,1,1,2,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(3,'EQ-003','Ventilador Mecânico',3,'Draeger','Evita Infinity V500','SN-2019-003',2019,1,1,1,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(4,'EQ-004','Tomógrafo Computorizado',1,'Siemens','SOMATOM Drive','SN-2022-004',2022,1,1,3,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(5,'EQ-005','Analisador Hematológico',4,'Sysmex','XN-3000','SN-2021-005',2021,1,2,4,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(6,'EQ-006','Eletrocardiógrafo Portátil',2,'Philips','PageWriter TC70','SN-2018-006',2018,2,2,2,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(7,'EQ-007','Mesa Cirúrgica Motorizada',3,'Maquet','Alphamaxx','SN-2020-007',2020,1,2,1,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45'),(8,'EQ-008','Aparelho de Ultrassons Portátil',1,'GE','Vscan Air','SN-2023-008',2023,1,2,5,NULL,'2026-06-21 23:20:45','2026-06-21 23:20:45');
/*!40000 ALTER TABLE `Equipamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EquipamentoFornecedor`
--

DROP TABLE IF EXISTS `EquipamentoFornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EquipamentoFornecedor` (
  `idEquipamento` int NOT NULL,
  `idFornecedor` int NOT NULL,
  `dataAssociacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idEquipamento`,`idFornecedor`),
  KEY `fkEquipamentoFornecedorIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkEquipamentoFornecedorIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkEquipamentoFornecedorIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EquipamentoFornecedor`
--

LOCK TABLES `EquipamentoFornecedor` WRITE;
/*!40000 ALTER TABLE `EquipamentoFornecedor` DISABLE KEYS */;
INSERT INTO `EquipamentoFornecedor` (`idEquipamento`, `idFornecedor`, `dataAssociacao`) VALUES (1,1,'2026-06-21 23:20:46'),(2,2,'2026-06-21 23:20:46'),(3,3,'2026-06-21 23:20:46'),(4,1,'2026-06-21 23:20:46'),(5,3,'2026-06-21 23:20:46'),(6,2,'2026-06-21 23:20:46'),(7,3,'2026-06-21 23:20:46');
/*!40000 ALTER TABLE `EquipamentoFornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Estado`
--

DROP TABLE IF EXISTS `Estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Estado` (
  `idEstado` int NOT NULL AUTO_INCREMENT,
  `nomeEstado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idEstado`),
  UNIQUE KEY `nomeEstado` (`nomeEstado`),
  CONSTRAINT `ckEstadoNomeEstado` CHECK ((char_length(trim(`nomeEstado`)) > 0))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Estado`
--

LOCK TABLES `Estado` WRITE;
/*!40000 ALTER TABLE `Estado` DISABLE KEYS */;
INSERT INTO `Estado` (`idEstado`, `nomeEstado`) VALUES (4,'Abatido'),(1,'Ativo'),(3,'Avariado'),(2,'Em Manutencao');
/*!40000 ALTER TABLE `Estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Fornecedor`
--

DROP TABLE IF EXISTS `Fornecedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Fornecedor` (
  `idFornecedor` int NOT NULL AUTO_INCREMENT,
  `nomeEmpresa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoFornecedor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPais` int DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `morada` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeContacto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargoContacto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefoneContacto` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emailContacto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFornecedor`),
  UNIQUE KEY `nif` (`nif`),
  UNIQUE KEY `emailContacto` (`emailContacto`),
  KEY `fkFornecedorIdPaisPaisIdPais` (`idPais`),
  CONSTRAINT `fkFornecedorIdPaisPaisIdPais` FOREIGN KEY (`idPais`) REFERENCES `Pais` (`idPais`),
  CONSTRAINT `ckFornecedorEmailContacto` CHECK (regexp_like(`emailContacto`,_utf8mb4'^([[:alnum:]]+.)+@([[:alnum:]]+.)+[[:alpha:]]{2,}$',_utf8mb4'i')),
  CONSTRAINT `ckFornecedorTipoFornecedor` CHECK ((upper(`tipoFornecedor`) in (_utf8mb4'FABRICANTE',_utf8mb4'DISTRIBUIDOR',_utf8mb4'FORNECEDOR')))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fornecedor`
--

LOCK TABLES `Fornecedor` WRITE;
/*!40000 ALTER TABLE `Fornecedor` DISABLE KEYS */;
INSERT INTO `Fornecedor` (`idFornecedor`, `nomeEmpresa`, `nif`, `tipoFornecedor`, `idPais`, `website`, `morada`, `nomeContacto`, `cargoContacto`, `telefoneContacto`, `emailContacto`, `observacoes`, `dataCriacao`) VALUES (1,'Siemens Healthineers','500123456','FABRICANTE',2,'www.siemens-healthineers.com','Rua da Inovação 45, Lisboa','Hans Mueller','Diretor Comercial','+351210000001','hmueller@siemens.com',NULL,'2026-06-21 23:20:44'),(2,'Philips Healthcare','500234567','FABRICANTE',3,'www.philips.com','Av. Tecnológica 120, Porto','Maria Rodrigues','Gestora de Conta','+351220000002','mrodrigues@philips.com',NULL,'2026-06-21 23:20:44'),(3,'MedTech Portugal','500345678','DISTRIBUIDOR',1,'www.medtech.pt','Estrada Nacional 10, Coimbra','João Silva','Responsável Vendas','+351239000003','jsilva@medtech.pt',NULL,'2026-06-21 23:20:44');
/*!40000 ALTER TABLE `Fornecedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Garantia`
--

DROP TABLE IF EXISTS `Garantia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Garantia` (
  `idGarantia` int NOT NULL AUTO_INCREMENT,
  `idEquipamento` int NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `tipoGarantia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condicoes` text COLLATE utf8mb4_unicode_ci,
  `idFornecedor` int DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idGarantia`),
  KEY `fkGarantiaIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkGarantiaIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkGarantiaIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkGarantiaIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckGarantiaDataFimInicio` CHECK ((`dataFim` > `dataInicio`))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Garantia`
--

LOCK TABLES `Garantia` WRITE;
/*!40000 ALTER TABLE `Garantia` DISABLE KEYS */;
INSERT INTO `Garantia` (`idGarantia`, `idEquipamento`, `dataInicio`, `dataFim`, `tipoGarantia`, `condicoes`, `idFornecedor`, `observacoes`, `dataCriacao`) VALUES (1,1,'2021-03-15','2026-03-15','Completa','Cobre peças e mão de obra',1,NULL,'2026-06-21 23:20:46'),(2,2,'2020-06-10','2025-06-10','Completa','Cobre peças e mão de obra',2,NULL,'2026-06-21 23:20:46'),(3,4,'2022-01-08','2027-01-08','Completa','Cobre peças e mão de obra',1,NULL,'2026-06-21 23:20:46'),(4,5,'2021-04-22','2024-04-22','Limitada','Apenas peças originais',3,NULL,'2026-06-21 23:20:46'),(5,7,'2020-02-14','2025-02-14','Completa','Cobre peças e mão de obra',3,NULL,'2026-06-21 23:20:46'),(6,8,'2023-08-30','2026-08-30','Fabricante','Garantia de fábrica',NULL,NULL,'2026-06-21 23:20:46');
/*!40000 ALTER TABLE `Garantia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HistoricoAlteracoes`
--

DROP TABLE IF EXISTS `HistoricoAlteracoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `HistoricoAlteracoes` (
  `idHistorico` int NOT NULL AUTO_INCREMENT,
  `tabela` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoOperacao` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idRegistro` int DEFAULT NULL,
  `dataOperacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `idUtilizador` int DEFAULT NULL,
  `descricaoAlteracao` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idHistorico`),
  KEY `fkHistoricoAlteracoesIdUtilizadorUtilizadorIdUtilizador` (`idUtilizador`),
  CONSTRAINT `fkHistoricoAlteracoesIdUtilizadorUtilizadorIdUtilizador` FOREIGN KEY (`idUtilizador`) REFERENCES `Utilizador` (`idUtilizador`),
  CONSTRAINT `ckHistoricoAlteracoesTipoOperacao` CHECK ((upper(`tipoOperacao`) in (_utf8mb4'INSERT',_utf8mb4'UPDATE',_utf8mb4'DELETE')))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricoAlteracoes`
--

LOCK TABLES `HistoricoAlteracoes` WRITE;
/*!40000 ALTER TABLE `HistoricoAlteracoes` DISABLE KEYS */;
INSERT INTO `HistoricoAlteracoes` (`idHistorico`, `tabela`, `tipoOperacao`, `idRegistro`, `dataOperacao`, `idUtilizador`, `descricaoAlteracao`) VALUES (1,'Equipamento','INSERT',1,'2021-03-15 00:00:00',1,'Registo inicial do equipamento EQ-001'),(2,'Equipamento','INSERT',2,'2020-06-10 00:00:00',1,'Registo inicial do equipamento EQ-002'),(3,'Equipamento','UPDATE',6,'2023-06-05 00:00:00',2,'Estado alterado para Em Manutencao'),(4,'Equipamento','UPDATE',6,'2023-06-08 00:00:00',2,'Estado revertido para Ativo apos manutencao');
/*!40000 ALTER TABLE `HistoricoAlteracoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Localizacao`
--

DROP TABLE IF EXISTS `Localizacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Localizacao` (
  `idLocalizacao` int NOT NULL AUTO_INCREMENT,
  `nomeLocalizacao` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `piso` int DEFAULT NULL,
  `ala` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `dataRegisto` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idLocalizacao`),
  UNIQUE KEY `nomeLocalizacao` (`nomeLocalizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Localizacao`
--

LOCK TABLES `Localizacao` WRITE;
/*!40000 ALTER TABLE `Localizacao` DISABLE KEYS */;
INSERT INTO `Localizacao` (`idLocalizacao`, `nomeLocalizacao`, `piso`, `ala`, `descricao`, `dataRegisto`) VALUES (1,'Bloco Operatório A',2,'Norte','Bloco operatório principal','2026-06-21 23:20:44'),(2,'UCI',1,'Sul','Unidade de Cuidados Intensivos','2026-06-21 23:20:44'),(3,'Radiologia',0,'Este','Departamento de imagiologia e radiologia','2026-06-21 23:20:44'),(4,'Laboratório Central',0,'Oeste','Laboratório de análises clínicas','2026-06-21 23:20:44'),(5,'Fisioterapia',1,'Norte','Departamento de reabilitação física','2026-06-21 23:20:44');
/*!40000 ALTER TABLE `Localizacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Manutencao`
--

DROP TABLE IF EXISTS `Manutencao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Manutencao` (
  `idManutencao` int NOT NULL AUTO_INCREMENT,
  `idEquipamento` int NOT NULL,
  `dataManutencao` date NOT NULL,
  `tipoManutencao` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `idFornecedor` int DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idManutencao`),
  KEY `fkManutencaoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkManutencaoIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkManutencaoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkManutencaoIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckManutencaoCusto` CHECK ((`custo` >= 0)),
  CONSTRAINT `ckManutencaoTipoManutencao` CHECK ((upper(`tipoManutencao`) in (_utf8mb4'PREVENTIVA',_utf8mb4'CORRETIVA',_utf8mb4'CALIBRACAO')))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manutencao`
--

LOCK TABLES `Manutencao` WRITE;
/*!40000 ALTER TABLE `Manutencao` DISABLE KEYS */;
INSERT INTO `Manutencao` (`idManutencao`, `idEquipamento`, `dataManutencao`, `tipoManutencao`, `descricao`, `idFornecedor`, `custo`, `observacoes`) VALUES (1,1,'2022-09-10','PREVENTIVA','Revisão anual e calibração de campos magnéticos',1,2500.00,NULL),(2,2,'2023-01-15','PREVENTIVA','Limpeza e verificação de sensores',2,350.00,NULL),(3,3,'2023-03-20','CORRETIVA','Substituição de válvula expiratória defeituosa',3,1200.00,NULL),(4,6,'2023-06-05','CORRETIVA','Troca de bateria e calibração de eléctrodos',2,480.00,NULL),(5,1,'2023-09-12','PREVENTIVA','Revisão anual e verificação de gradientes',1,2700.00,NULL),(6,4,'2024-01-20','CALIBRACAO','Calibração de detetores e verificação de dose',1,1800.00,NULL),(7,5,'2024-03-08','PREVENTIVA','Manutenção preventiva e troca de reagentes',3,600.00,NULL);
/*!40000 ALTER TABLE `Manutencao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MensagemContacto`
--

DROP TABLE IF EXISTS `MensagemContacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `MensagemContacto` (
  `idMensagem` int NOT NULL AUTO_INCREMENT,
  `nomeRemetente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailRemetente` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assunto` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lida` tinyint(1) DEFAULT '0',
  `dataRecebida` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMensagem`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MensagemContacto`
--

LOCK TABLES `MensagemContacto` WRITE;
/*!40000 ALTER TABLE `MensagemContacto` DISABLE KEYS */;
INSERT INTO `MensagemContacto` (`idMensagem`, `nomeRemetente`, `emailRemetente`, `assunto`, `mensagem`, `lida`, `dataRecebida`) VALUES (1,'João Silva','joao@hospital.pt','Solicitar Demo','Gostaria de conhecer melhor o sistema MedControl. Podem agendar uma demonstração?',0,'2026-06-21 23:20:47'),(2,'Maria Costa','maria@hospital.net','Informações Gerais','Qual é o tempo de implementação típico do sistema?',0,'2026-06-21 23:20:47');
/*!40000 ALTER TABLE `MensagemContacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Noticia`
--

DROP TABLE IF EXISTS `Noticia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Noticia` (
  `idNoticia` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resumo` text COLLATE utf8mb4_unicode_ci,
  `destaque` tinyint(1) DEFAULT '0',
  `publicada` tinyint(1) DEFAULT '1',
  `dataPublicacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idNoticia`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Noticia`
--

LOCK TABLES `Noticia` WRITE;
/*!40000 ALTER TABLE `Noticia` DISABLE KEYS */;
INSERT INTO `Noticia` (`idNoticia`, `titulo`, `resumo`, `destaque`, `publicada`, `dataPublicacao`) VALUES (1,'MedControl Apresenta Nova Versão','Lançamento da versão com novas funcionalidades de análise avançada e melhorias de desempenho.',0,1,'2026-06-21 23:20:46'),(2,'Integração com Sistema ERP','Nova integração API permite sincronização automática com sistemas ERP hospitalares.',0,1,'2026-06-21 23:20:46'),(3,'Solução Completa de Gestão','Da identificação ao acompanhamento, o MedControl oferece uma solução integrada para gestão de equipamentos.',1,1,'2026-06-21 23:20:46'),(4,'Suporte 24/7 Dedicado','Equipa técnica sempre disponível para resolver qualquer questão ou implementar customizações.',1,1,'2026-06-21 23:20:46');
/*!40000 ALTER TABLE `Noticia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pais`
--

DROP TABLE IF EXISTS `Pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pais` (
  `idPais` int NOT NULL AUTO_INCREMENT,
  `nomePais` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigoISO` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idPais`),
  UNIQUE KEY `nomePais` (`nomePais`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pais`
--

LOCK TABLES `Pais` WRITE;
/*!40000 ALTER TABLE `Pais` DISABLE KEYS */;
INSERT INTO `Pais` (`idPais`, `nomePais`, `codigoISO`) VALUES (1,'Portugal','PT'),(2,'Alemanha','DE'),(3,'Estados Unidos','US'),(4,'Franca','FR'),(5,'Japao','JP');
/*!40000 ALTER TABLE `Pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Testemunho`
--

DROP TABLE IF EXISTS `Testemunho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Testemunho` (
  `idTestemunho` int NOT NULL AUTO_INCREMENT,
  `nomeEmpresa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeAutor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargoAutor` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `dataRegisto` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTestemunho`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Testemunho`
--

LOCK TABLES `Testemunho` WRITE;
/*!40000 ALTER TABLE `Testemunho` DISABLE KEYS */;
INSERT INTO `Testemunho` (`idTestemunho`, `nomeEmpresa`, `nomeAutor`, `cargoAutor`, `texto`, `ativo`, `dataRegisto`) VALUES (1,'Hospital de São João','Dr. Carlos Ferreira','Diretor de Tecnologia','Desde que implementámos o MedControl, temos visibilidade total do nosso parque de equipamentos.',1,'2026-06-21 23:20:46'),(2,'Hospital da Luz','Eng. Paula Ribeiro','Gestora de Infraestruturas','O sistema é muito intuitivo. Os técnicos aprenderam a usar rapidamente.',1,'2026-06-21 23:20:46');
/*!40000 ALTER TABLE `Testemunho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilizador`
--

DROP TABLE IF EXISTS `Utilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Utilizador` (
  `idUtilizador` int NOT NULL AUTO_INCREMENT,
  `nomeUtilizador` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeCompleto` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipoUtilizador` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUtilizador`),
  UNIQUE KEY `nomeUtilizador` (`nomeUtilizador`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `ckUtilizadorEmail` CHECK (regexp_like(`email`,_utf8mb4'^([[:alnum:]]+.)+@([[:alnum:]]+.)+[[:alpha:]]{2,}$',_utf8mb4'i')),
  CONSTRAINT `ckUtilizadorTipoUtilizador` CHECK ((upper(`tipoUtilizador`) in (_utf8mb4'ADMINISTRADOR',_utf8mb4'TECNICO',_utf8mb4'GESTOR',_utf8mb4'CONSULTOR')))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilizador`
--

LOCK TABLES `Utilizador` WRITE;
/*!40000 ALTER TABLE `Utilizador` DISABLE KEYS */;
INSERT INTO `Utilizador` (`idUtilizador`, `nomeUtilizador`, `password`, `nomeCompleto`, `email`, `tipoUtilizador`, `ativo`, `dataCriacao`) VALUES (1,'admin','$2y$10$e017jXf6fLDEBpRbS8RxeOO5XizMfRGwJbqUQV9DaRDwgmg.kpsQ.','Administrador do Sistema','admin@medcontrol.pt','ADMINISTRADOR',1,'2026-06-21 23:20:45'),(2,'carlos','$2y$10$RoSyVl0pgarYw5PUmwM1e.CzpltKZuyVyV0aSZxVSiY90ZRxNl6zC','Carlos Ferreira','carlos@medcontrol.pt','TECNICO',1,'2026-06-21 23:20:45'),(3,'joana','$2y$10$ceZzqLY69PjVv50PZ9C0E.t/wiY7mJIes2ugyduwEhlfFApfgj/0u','Joana Pereira','joana@medcontrol.pt','GESTOR',1,'2026-06-21 23:20:45'),(4,'rui','$2y$10$hHgMEd78QNEYCTdGapLZlO/yt6rDuYwWwLVxx/LlPL2E7sxgrvbMi','Rui Mendes','rui@medcontrol.pt','CONSULTOR',1,'2026-06-22 12:56:42');
/*!40000 ALTER TABLE `Utilizador` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-22 15:47:15
