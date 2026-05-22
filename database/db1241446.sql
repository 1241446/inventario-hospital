mysqldump: [Warning] Using a password on the command line interface can be insecure.
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
mysqldump: Error: 'Access denied; you need (at least one of) the PROCESS privilege(s) for this operation' when trying to dump tablespaces

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
  `tipoEntrada` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `idFornecedor` int DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idAquisicao`),
  KEY `fkAquisicaoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkAquisicaoIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkAquisicaoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkAquisicaoIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckAquisicaoCustoAquisicao` CHECK ((`custoAquisicao` >= 0)),
  CONSTRAINT `ckAquisicaoTipoEntrada` CHECK ((upper(`tipoEntrada`) in (_utf8mb4'COMPRA',_utf8mb4'LEASING',_utf8mb4'DOACAO')))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Aquisicao`
--

LOCK TABLES `Aquisicao` WRITE;
/*!40000 ALTER TABLE `Aquisicao` DISABLE KEYS */;
INSERT INTO `Aquisicao` VALUES (1,1,'2021-03-15',850000.00,'COMPRA',1,NULL),(2,2,'2020-06-10',12500.00,'COMPRA',2,NULL),(3,3,'2019-09-20',45000.00,'LEASING',3,NULL),(4,4,'2022-01-08',620000.00,'COMPRA',1,NULL),(5,5,'2021-04-22',28000.00,'COMPRA',3,NULL),(6,6,'2018-11-05',3200.00,'COMPRA',2,NULL),(7,7,'2020-02-14',95000.00,'COMPRA',3,NULL),(8,8,'2023-08-30',6500.00,'DOACAO',NULL,NULL);
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
  `nomeCategoria` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `descricao` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idCategoria`),
  UNIQUE KEY `nomeCategoria` (`nomeCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categoria`
--

LOCK TABLES `Categoria` WRITE;
/*!40000 ALTER TABLE `Categoria` DISABLE KEYS */;
INSERT INTO `Categoria` VALUES (1,'Imagiologia','Equipamentos de diagn??stico por imagem'),(2,'Monitoriza????o','Equipamentos de monitoriza????o de sinais vitais'),(3,'Cirurgia','Equipamentos utilizados em bloco operat??rio'),(4,'Laborat??rio','Equipamentos de an??lises cl??nicas e laboratoriais'),(5,'Reabilita????o','Equipamentos de fisioterapia e reabilita????o');
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
  `nomeCriticidade` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `descricao` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idCriticidade`),
  UNIQUE KEY `nomeCriticidade` (`nomeCriticidade`),
  CONSTRAINT `ckCriticidadeNomeCriticidade` CHECK ((char_length(trim(`nomeCriticidade`)) > 0))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Criticidade`
--

LOCK TABLES `Criticidade` WRITE;
/*!40000 ALTER TABLE `Criticidade` DISABLE KEYS */;
INSERT INTO `Criticidade` VALUES (1,'Alta','Equipamento cr??tico para fun????es vitais do doente'),(2,'Media','Equipamento importante mas com alternativas dispon??veis'),(3,'Baixa','Equipamento de suporte sem impacto direto no doente');
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
  `nomeDocumento` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `tipoDocumento` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `caminhoArquivo` varchar(500) COLLATE utf8mb4_bin DEFAULT NULL,
  `dataUpload` datetime DEFAULT CURRENT_TIMESTAMP,
  `observacoes` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idDocumento`),
  KEY `fkDocumentoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  CONSTRAINT `fkDocumentoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `ckDocumentoTipoDocumento` CHECK ((upper(`tipoDocumento`) in (_utf8mb4'MANUAL',_utf8mb4'CERTIFICADO',_utf8mb4'CONTRATO',_utf8mb4'ESPECIFICACAO',_utf8mb4'OUTRO')))
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Documento`
--

LOCK TABLES `Documento` WRITE;
/*!40000 ALTER TABLE `Documento` DISABLE KEYS */;
INSERT INTO `Documento` VALUES (1,1,'Manual de Operador MAGNETOM Vida','MANUAL','docs/eq001_manual_operador.pdf','2026-06-17 22:23:03',NULL),(2,1,'Certificado de Calibra????o 2023','CERTIFICADO','docs/eq001_calibracao_2023.pdf','2026-06-17 22:23:03',NULL),(3,2,'Manual IntelliVue MX800','MANUAL','docs/eq002_manual.pdf','2026-06-17 22:23:03',NULL),(4,3,'Contrato de Leasing Ventilador','CONTRATO','docs/eq003_contrato_leasing.pdf','2026-06-17 22:23:03',NULL),(5,4,'Especifica????es T??cnicas SOMATOM Drive','ESPECIFICACAO','docs/eq004_especificacoes.pdf','2026-06-17 22:23:03',NULL),(6,4,'Certificado de Instala????o','CERTIFICADO','docs/eq004_instalacao.pdf','2026-06-17 22:23:03',NULL),(7,5,'Manual XN-3000 Portugu??s','MANUAL','docs/eq005_manual_pt.pdf','2026-06-17 22:23:03',NULL),(8,8,'Manual Vscan Air','MANUAL','docs/eq008_manual.pdf','2026-06-17 22:23:03',NULL);
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
  `codigoEquipamento` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `designacao` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `idCategoria` int NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `numeroSerie` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `anoFabrico` int DEFAULT NULL,
  `idEstado` int NOT NULL,
  `idCriticidade` int NOT NULL,
  `idLocalizacao` int NOT NULL,
  `observacoes` text COLLATE utf8mb4_bin,
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Equipamento`
--

LOCK TABLES `Equipamento` WRITE;
/*!40000 ALTER TABLE `Equipamento` DISABLE KEYS */;
INSERT INTO `Equipamento` VALUES (1,'EQ-001','Resson??ncia Magn??tica 3T',1,'Siemens','MAGNETOM Vida','SN-2021-001',2021,1,1,3,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(2,'EQ-002','Monitor de Sinais Vitais',2,'Philips','IntelliVue MX800','SN-2020-002',2020,1,1,2,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(3,'EQ-003','Ventilador Mec??nico',3,'Draeger','Evita Infinity V500','SN-2019-003',2019,1,1,1,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(4,'EQ-004','Tom??grafo Computorizado',1,'Siemens','SOMATOM Drive','SN-2022-004',2022,1,1,3,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(5,'EQ-005','Analisador Hematol??gico',4,'Sysmex','XN-3000','SN-2021-005',2021,1,2,4,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(6,'EQ-006','Eletrocardi??grafo Port??til',2,'Philips','PageWriter TC70','SN-2018-006',2018,2,2,2,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(7,'EQ-007','Mesa Cir??rgica Motorizada',3,'Maquet','Alphamaxx','SN-2020-007',2020,1,2,1,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02'),(8,'EQ-008','Aparelho de Ultrassons Port??til',1,'GE','Vscan Air','SN-2023-008',2023,1,2,5,NULL,'2026-06-17 22:23:02','2026-06-17 22:23:02');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EquipamentoFornecedor`
--

LOCK TABLES `EquipamentoFornecedor` WRITE;
/*!40000 ALTER TABLE `EquipamentoFornecedor` DISABLE KEYS */;
INSERT INTO `EquipamentoFornecedor` VALUES (1,1,'2026-06-17 22:23:03'),(2,2,'2026-06-17 22:23:03'),(3,3,'2026-06-17 22:23:03'),(4,1,'2026-06-17 22:23:03'),(5,3,'2026-06-17 22:23:03'),(6,2,'2026-06-17 22:23:03'),(7,3,'2026-06-17 22:23:03');
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
  `nomeEstado` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idEstado`),
  UNIQUE KEY `nomeEstado` (`nomeEstado`),
  CONSTRAINT `ckEstadoNomeEstado` CHECK ((char_length(trim(`nomeEstado`)) > 0))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Estado`
--

LOCK TABLES `Estado` WRITE;
/*!40000 ALTER TABLE `Estado` DISABLE KEYS */;
INSERT INTO `Estado` VALUES (4,'Abatido'),(1,'Ativo'),(3,'Avariado'),(2,'Em Manutencao');
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
  `nomeEmpresa` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `nif` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `tipoFornecedor` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `idPais` int DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `morada` text COLLATE utf8mb4_bin NOT NULL,
  `nomeContacto` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `cargoContacto` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `telefoneContacto` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `emailContacto` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `observacoes` text COLLATE utf8mb4_bin,
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFornecedor`),
  UNIQUE KEY `nif` (`nif`),
  UNIQUE KEY `emailContacto` (`emailContacto`),
  KEY `fkFornecedorIdPaisPaisIdPais` (`idPais`),
  CONSTRAINT `fkFornecedorIdPaisPaisIdPais` FOREIGN KEY (`idPais`) REFERENCES `Pais` (`idPais`),
  CONSTRAINT `ckFornecedorEmailContacto` CHECK (regexp_like(`emailContacto`,_utf8mb4'^([[:alnum:]]+.)+@([[:alnum:]]+.)+[[:alpha:]]{2,}$',_utf8mb4'i')),
  CONSTRAINT `ckFornecedorTipoFornecedor` CHECK ((upper(`tipoFornecedor`) in (_utf8mb4'FABRICANTE',_utf8mb4'DISTRIBUIDOR',_utf8mb4'FORNECEDOR')))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Fornecedor`
--

LOCK TABLES `Fornecedor` WRITE;
/*!40000 ALTER TABLE `Fornecedor` DISABLE KEYS */;
INSERT INTO `Fornecedor` VALUES (1,'Siemens Healthineers','500123456','FABRICANTE',2,'www.siemens-healthineers.com','Rua da Inova????o 45, Lisboa','Hans Mueller','Diretor Comercial','+351210000001','hmueller@siemens.com',NULL,'2026-06-17 22:23:01'),(2,'Philips Healthcare','500234567','FABRICANTE',3,'www.philips.com','Av. Tecnol??gica 120, Porto','Maria Rodrigues','Gestora de Conta','+351220000002','mrodrigues@philips.com',NULL,'2026-06-17 22:23:01'),(3,'MedTech Portugal','500345678','DISTRIBUIDOR',1,'www.medtech.pt','Estrada Nacional 10, Coimbra','Jo??o Silva','Respons??vel Vendas','+351239000003','jsilva@medtech.pt',NULL,'2026-06-17 22:23:01');
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
  `tipoGarantia` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `condicoes` text COLLATE utf8mb4_bin,
  `idFornecedor` int DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_bin,
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idGarantia`),
  KEY `fkGarantiaIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkGarantiaIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkGarantiaIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkGarantiaIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckGarantiaDataFimInicio` CHECK ((`dataFim` > `dataInicio`))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Garantia`
--

LOCK TABLES `Garantia` WRITE;
/*!40000 ALTER TABLE `Garantia` DISABLE KEYS */;
INSERT INTO `Garantia` VALUES (1,1,'2021-03-15','2026-03-15','Completa','Cobre pe??as e m??o de obra',1,NULL,'2026-06-17 22:23:03'),(2,2,'2020-06-10','2025-06-10','Completa','Cobre pe??as e m??o de obra',2,NULL,'2026-06-17 22:23:03'),(3,4,'2022-01-08','2027-01-08','Completa','Cobre pe??as e m??o de obra',1,NULL,'2026-06-17 22:23:03'),(4,5,'2021-04-22','2024-04-22','Limitada','Apenas pe??as originais',3,NULL,'2026-06-17 22:23:03'),(5,7,'2020-02-14','2025-02-14','Completa','Cobre pe??as e m??o de obra',3,NULL,'2026-06-17 22:23:03'),(6,8,'2023-08-30','2026-08-30','Fabricante','Garantia de f??brica',NULL,NULL,'2026-06-17 22:23:03');
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
  `tabela` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `tipoOperacao` varchar(20) COLLATE utf8mb4_bin DEFAULT NULL,
  `idRegistro` int DEFAULT NULL,
  `dataOperacao` datetime DEFAULT CURRENT_TIMESTAMP,
  `idUtilizador` int DEFAULT NULL,
  `descricaoAlteracao` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idHistorico`),
  KEY `fkHistoricoAlteracoesIdUtilizadorUtilizadorIdUtilizador` (`idUtilizador`),
  CONSTRAINT `fkHistoricoAlteracoesIdUtilizadorUtilizadorIdUtilizador` FOREIGN KEY (`idUtilizador`) REFERENCES `Utilizador` (`idUtilizador`),
  CONSTRAINT `ckHistoricoAlteracoesTipoOperacao` CHECK ((upper(`tipoOperacao`) in (_utf8mb4'INSERT',_utf8mb4'UPDATE',_utf8mb4'DELETE')))
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricoAlteracoes`
--

LOCK TABLES `HistoricoAlteracoes` WRITE;
/*!40000 ALTER TABLE `HistoricoAlteracoes` DISABLE KEYS */;
INSERT INTO `HistoricoAlteracoes` VALUES (1,'Equipamento','INSERT',1,'2021-03-15 00:00:00',1,'Registo inicial do equipamento EQ-001'),(2,'Equipamento','INSERT',2,'2020-06-10 00:00:00',1,'Registo inicial do equipamento EQ-002'),(3,'Equipamento','UPDATE',6,'2023-06-05 00:00:00',2,'Estado alterado para Em Manutencao'),(4,'Equipamento','UPDATE',6,'2023-06-08 00:00:00',2,'Estado revertido para Ativo apos manutencao');
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
  `nomeLocalizacao` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `piso` int DEFAULT NULL,
  `ala` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_bin,
  `dataRegisto` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idLocalizacao`),
  UNIQUE KEY `nomeLocalizacao` (`nomeLocalizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Localizacao`
--

LOCK TABLES `Localizacao` WRITE;
/*!40000 ALTER TABLE `Localizacao` DISABLE KEYS */;
INSERT INTO `Localizacao` VALUES (1,'Bloco Operat??rio A',2,'Norte','Bloco operat??rio principal','2026-06-17 22:23:01'),(2,'UCI',1,'Sul','Unidade de Cuidados Intensivos','2026-06-17 22:23:01'),(3,'Radiologia',0,'Este','Departamento de imagiologia e radiologia','2026-06-17 22:23:01'),(4,'Laborat??rio Central',0,'Oeste','Laborat??rio de an??lises cl??nicas','2026-06-17 22:23:01'),(5,'Fisioterapia',1,'Norte','Departamento de reabilita????o f??sica','2026-06-17 22:23:01');
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
  `tipoManutencao` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_bin,
  `idFornecedor` int DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `observacoes` text COLLATE utf8mb4_bin,
  PRIMARY KEY (`idManutencao`),
  KEY `fkManutencaoIdEquipamentoEquipamentoIdEquipamento` (`idEquipamento`),
  KEY `fkManutencaoIdFornecedorFornecedorIdFornecedor` (`idFornecedor`),
  CONSTRAINT `fkManutencaoIdEquipamentoEquipamentoIdEquipamento` FOREIGN KEY (`idEquipamento`) REFERENCES `Equipamento` (`idEquipamento`) ON DELETE CASCADE,
  CONSTRAINT `fkManutencaoIdFornecedorFornecedorIdFornecedor` FOREIGN KEY (`idFornecedor`) REFERENCES `Fornecedor` (`idFornecedor`),
  CONSTRAINT `ckManutencaoCusto` CHECK ((`custo` >= 0)),
  CONSTRAINT `ckManutencaoTipoManutencao` CHECK ((upper(`tipoManutencao`) in (_utf8mb4'PREVENTIVA',_utf8mb4'CORRETIVA',_utf8mb4'CALIBRACAO')))
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Manutencao`
--

LOCK TABLES `Manutencao` WRITE;
/*!40000 ALTER TABLE `Manutencao` DISABLE KEYS */;
INSERT INTO `Manutencao` VALUES (1,1,'2022-09-10','PREVENTIVA','Revis??o anual e calibra????o de campos magn??ticos',1,2500.00,NULL),(2,2,'2023-01-15','PREVENTIVA','Limpeza e verifica????o de sensores',2,350.00,NULL),(3,3,'2023-03-20','CORRETIVA','Substitui????o de v??lvula expirat??ria defeituosa',3,1200.00,NULL),(4,6,'2023-06-05','CORRETIVA','Troca de bateria e calibra????o de el??ctrodos',2,480.00,NULL),(5,1,'2023-09-12','PREVENTIVA','Revis??o anual e verifica????o de gradientes',1,2700.00,NULL),(6,4,'2024-01-20','CALIBRACAO','Calibra????o de detetores e verifica????o de dose',1,1800.00,NULL),(7,5,'2024-03-08','PREVENTIVA','Manuten????o preventiva e troca de reagentes',3,600.00,NULL);
/*!40000 ALTER TABLE `Manutencao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pais`
--

DROP TABLE IF EXISTS `Pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pais` (
  `idPais` int NOT NULL AUTO_INCREMENT,
  `nomePais` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `codigoISO` varchar(2) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`idPais`),
  UNIQUE KEY `nomePais` (`nomePais`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pais`
--

LOCK TABLES `Pais` WRITE;
/*!40000 ALTER TABLE `Pais` DISABLE KEYS */;
INSERT INTO `Pais` VALUES (1,'Portugal','PT'),(2,'Alemanha','DE'),(3,'Estados Unidos','US'),(4,'Franca','FR'),(5,'Japao','JP');
/*!40000 ALTER TABLE `Pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Utilizador`
--

DROP TABLE IF EXISTS `Utilizador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Utilizador` (
  `idUtilizador` int NOT NULL AUTO_INCREMENT,
  `nomeUtilizador` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `nomeCompleto` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `tipoUtilizador` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `dataCriacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUtilizador`),
  UNIQUE KEY `nomeUtilizador` (`nomeUtilizador`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `ckUtilizadorEmail` CHECK (regexp_like(`email`,_utf8mb4'^([[:alnum:]]+.)+@([[:alnum:]]+.)+[[:alpha:]]{2,}$',_utf8mb4'i')),
  CONSTRAINT `ckUtilizadorTipoUtilizador` CHECK ((upper(`tipoUtilizador`) in (_utf8mb4'ADMINISTRADOR',_utf8mb4'TECNICO',_utf8mb4'GESTOR',_utf8mb4'CONSULTOR')))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Utilizador`
--

LOCK TABLES `Utilizador` WRITE;
/*!40000 ALTER TABLE `Utilizador` DISABLE KEYS */;
INSERT INTO `Utilizador` VALUES (1,'admin','240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9','Administrador do Sistema','admin@medcontrol.pt','ADMINISTRADOR',1,'2026-06-17 22:23:02'),(2,'carlos','55a5e9e78207b4df8699d60886fa070079463547b095d1a05bc719bb4e6cd251','Carlos Ferreira','carlos@medcontrol.pt','TECNICO',1,'2026-06-17 22:23:02'),(3,'joana','6b08d780140e292a4af8ba3f2333fc1357091442d7e807c6cad92e8dcd0240b7','Joana Pereira','joana@medcontrol.pt','GESTOR',1,'2026-06-17 22:23:02');
/*!40000 ALTER TABLE `Utilizador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db1241446'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-20 13:24:12
