-- -----------------------------------------------------
-- Criando DATABASE `IMOVELNET`
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `IMOVELNET` DEFAULT CHARACTER SET UTF8MB4;
USE `IMOVELNET`;
/*drop database IMOVELNET;*/

-- -----------------------------------------------------
-- Table loja
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS lojas (
  id_loja INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  nome_loja VARCHAR(255) DEFAULT NULL,
  cnpj VARCHAR(20) DEFAULT NULL,
  creci VARCHAR(255) DEFAULT NULL,
  link VARCHAR(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table lojas; */
/* select * from lojas; */

-- -----------------------------------------------------
-- Table clientes
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS clientes (
  id_clientes INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_loja INT DEFAULT NULL,
  nome_completo VARCHAR(255) NULL,
  tipo_pessoa ENUM('PJ', 'PF', 'ESTRANGEIRO'),
  documento VARCHAR(255) NULL,
  tipo_cliente ENUM('PROPRIETARIO', 'COMPRADOR', 'LOCADOR', 'VENDEDOR'),
  email VARCHAR(255) DEFAULT NULL,
  telefone VARCHAR(11) DEFAULT NULL,
  cep  VARCHAR(10) DEFAULT NULL,
  endereco VARCHAR(255) DEFAULT NULL,
  endereco_numero VARCHAR(50) DEFAULT NULL,
  complemento VARCHAR(100) DEFAULT NULL,
  bairro VARCHAR(100) DEFAULT NULL,
  cidade VARCHAR(100) DEFAULT NULL,    
  estado CHAR(2) DEFAULT NULL,
  obs tinytext default NULL,
  status ENUM('0', '1'),
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table clientes; */
/* select * from clientes; */

-- -----------------------------------------------------
-- Table IMOVEIS
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS imoveis (
  id_imovel INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_cliente INT DEFAULT NULL,
  id_loja INT DEFAULT NULL,
  tipo_imovel ENUM('CASA', 'TERRENO', 'LOJA', 'APTO', 'COBERTURA'),
  qtd_comodos INT DEFAULT NULL,
  m2 decimal(6,2) DEFAULT NULL,
  qtd_fotos INT DEFAULT NULL,
  endereco VARCHAR(255) DEFAULT NULL,
  endereco_numero VARCHAR(50) DEFAULT NULL,
  bairro VARCHAR(50) DEFAULT NULL,
  complemento VARCHAR(100) DEFAULT NULL,
  cidade VARCHAR(100) DEFAULT NULL,
  estado CHAR(2) DEFAULT NULL,
  cep char(10) DEFAULT NULL,
  obs tinytext default NULL,
  status ENUM('0', '1'),
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table imoveis; */
/* select * from imoveis; */

-- -----------------------------------------------------
-- Table ceps
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS ceps (
 id_cep INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
 cep VARCHAR(10) DEFAULT NULL,
 endereco VARCHAR(255) DEFAULT NULL,
 endereco_numero VARCHAR(50) DEFAULT NULL,
 complemento VARCHAR(255) DEFAULT NULL,
 bairro VARCHAR(255) DEFAULT NULL,
 cidade VARCHAR(255) DEFAULT NULL,
 estado CHAR(2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table ceps; */
/* select * from ceps; */

-- -----------------------------------------------------
-- Table Contratos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS contratos (
  id_contrato INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_loja INT DEFAULT NULL,
  id_clientes INT DEFAULT NULL,
  id_imovel INT DEFAULT NULL,
  contrato text DEFAULT NULL,
  obs tinytext default NULL,
  dt_entrada date default NULL,
  dt_saida date default NULL,
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table contratos; */
/* select * from contratos; */

-- -----------------------------------------------------
-- Table funcionarios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS funcionarios (
  id_funcionario INT AUTO_INCREMENT PRIMARY KEY NOT NULL, 
  id_loja INT DEFAULT NULL,
  nome VARCHAR(255) NULL, 
  cpf VARCHAR(11) NULL, 
  email VARCHAR(255) NULL, 
  senha tinytext DEFAULT NULL,
  telefone VARCHAR(255) NULL, 
  cargo VARCHAR(255) NULL, 
  salario decimal(6,2), 
  obs VARCHAR(255) default NULL,
  status ENUM('0', '1'),
  dt_entrada date default NULL,
  dt_saida date default NULL,
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table funcionarios; */
/* select * from funcionarios; */

-- -----------------------------------------------------
-- Table corretores
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS corretores (
  id_corretor INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_loja INT DEFAULT NULL,
  id_funcionario INT DEFAULT NULL,
  creci VARCHAR(255) NULL,
  obs VARCHAR(255) default NULL,
  status ENUM('0', '1'),
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table corretores; */
/* select * from corretores; */

-- -----------------------------------------------------
-- Table fornecedores
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS fornecedores (
  id_fornecedor INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  id_loja INT DEFAULT NULL,
  fornecedor VARCHAR(255) NULL,
  tipo ENUM('PJ', 'PF', 'ESTRANGEIRO'),
  documento VARCHAR(255) NULL,
  tipo_forn ENUM('SERVICO', 'PRODUTOS', 'AMBOS'),
  responsavel VARCHAR(255) NULL,
  email VARCHAR(255) NULL,
  telefone VARCHAR(11) NULL,
  descricao VARCHAR(255),
  obs VARCHAR(255) default NULL,
  status ENUM('0', '1'),
  dt_reg DATETIME NULL,
  dt_alt DATETIME NULL
) ENGINE = InnoDB DEFAULT CHARSET=UTF8MB4;
/* drop table fornecedores; */
/* select * from fornecedores; */