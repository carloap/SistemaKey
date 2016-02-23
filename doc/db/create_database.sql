DROP SCHEMA IF EXISTS `sistemakey` ;
CREATE SCHEMA IF NOT EXISTS `sistemakey` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sistemakey` ;

-- -----------------------------------------------------
-- Table `sistemakey`.`perfilUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`perfilUsuario` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`perfilUsuario` (
  `idPerfilUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_perf` VARCHAR(50) NOT NULL,
  `descricao_perf` VARCHAR(80) NULL,
  PRIMARY KEY (`idPerfilUsuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`usuario` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`usuario` (
  `idUsuario` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idPerfilUsuario` INT UNSIGNED NOT NULL,
  `nome_usu` VARCHAR(120) NOT NULL,
  `login_usu` VARCHAR(80) NOT NULL,
  `senha_usu` VARCHAR(120) NOT NULL,
  `foto_usu` VARCHAR(120) NULL,
  `status_usu` TINYINT UNSIGNED NOT NULL,
  `ultacesso_usu` DATETIME NULL,
  `datacad_usu` DATETIME NOT NULL,
  `dataat_usu` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idUsuario`, `idPerfilUsuario`),
  UNIQUE INDEX `email_UNIQUE` (`login_usu` ASC),
  INDEX `fk_usuario_perfilUsuario_idx` (`idPerfilUsuario` ASC),
  INDEX `usuario_loginsenha_idx` (`login_usu`(4) ASC, `senha_usu` ASC),
  CONSTRAINT `fk_usuario_perfilUsuario`
    FOREIGN KEY (`idPerfilUsuario`)
    REFERENCES `sistemakey`.`perfilUsuario` (`idPerfilUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`cliente` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`cliente` (
  `idCliente` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_cli` VARCHAR(120) NOT NULL,
  `email_cli` VARCHAR(120) NULL,
  `sexo_cli` CHAR(1) NULL,
  `rg_cli` VARCHAR(30) NULL,
  `orgexped_cli` VARCHAR(50) NULL,
  `cpf_cli` CHAR(11) NOT NULL,
  `cnpj_cli` CHAR(15) NULL,
  `passport_cli` INT NULL,
  `endereco_cli` VARCHAR(200) NULL,
  `num_cli` VARCHAR(15) NULL,
  `cep_cli` VARCHAR(10) NULL,
  `nacionalidade_cli` VARCHAR(50) NULL,
  `informacoes_cli` TEXT NULL,
  `foto_cli` VARCHAR(120) NULL,
  `datacad_cli` DATETIME NOT NULL,
  `dataat_cli` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idCliente`),
  UNIQUE INDEX `cliente_CPF_UNIQUE` (`cpf_cli` ASC),
  UNIQUE INDEX `cliente_CNPJ_UNIQUE` (`cnpj_cli` ASC),
  INDEX `cliente_nome_idx` (`nome_cli`(5) ASC))
ENGINE = InnoDB
COMMENT = 'cadastro de cliente';


-- -----------------------------------------------------
-- Table `sistemakey`.`prioridade`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`prioridade` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`prioridade` (
  `idPrioridade` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_pri` VARCHAR(30) NOT NULL,
  `descricao_pri` VARCHAR(100) NULL,
  `peso_pri` TINYINT UNSIGNED NULL,
  `status_pri` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idPrioridade`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`senha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`senha` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`senha` (
  `idSenha` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idUsuario` INT UNSIGNED NULL,
  `idCliente` INT UNSIGNED NULL,
  `idPrioridade` TINYINT UNSIGNED NOT NULL,
  `senha_sen` INT NOT NULL,
  `sigla_sen` CHAR(1) NULL,
  `posicao_sen` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '0=new; 1=exec; 2=end',
  `guiche_sen` TINYINT UNSIGNED NULL,
  `status_sen` TINYINT UNSIGNED NOT NULL COMMENT '0=disab;1=enab',
  `datacad_sen` DATETIME NOT NULL,
  `dataat_sen` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idSenha`, `idPrioridade`),
  INDEX `ix_senha` (`senha_sen` ASC),
  INDEX `fk_senha_usuario_idx` (`idUsuario` ASC),
  INDEX `fk_senha_cliente_idx` (`idCliente` ASC),
  INDEX `fk_senha_prioridade_idx` (`idPrioridade` ASC),
  CONSTRAINT `fk_senha_usuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `sistemakey`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_senha_cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `sistemakey`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_senha_prioridade`
    FOREIGN KEY (`idPrioridade`)
    REFERENCES `sistemakey`.`prioridade` (`idPrioridade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`departamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`departamento` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`departamento` (
  `idDepartamento` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`idDepartamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`sinal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`sinal` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`sinal` (
  `idSinal` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nomecartorio_sin` VARCHAR(80) NOT NULL,
  `cidade_sin` VARCHAR(60) NULL,
  `estado_sin` VARCHAR(2) NULL,
  `datacad_sin` DATETIME NOT NULL,
  `dataat_sin` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idSinal`))
ENGINE = InnoDB
COMMENT = 'local do tabeliao';


-- -----------------------------------------------------
-- Table `sistemakey`.`escrevente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`escrevente` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`escrevente` (
  `idEscrevente` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idSinal` INT UNSIGNED NOT NULL,
  `nome_esc` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`idEscrevente`, `idSinal`),
  INDEX `fk_escrevente_sinal_idx` (`idSinal` ASC),
  CONSTRAINT `fk_escrevente_sinal`
    FOREIGN KEY (`idSinal`)
    REFERENCES `sistemakey`.`sinal` (`idSinal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`historicoAtendimento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`historicoAtendimento` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`historicoAtendimento` (
  `idHistAtendimento` BIGINT(20) UNSIGNED NOT NULL,
  `idCliente` INT UNSIGNED NOT NULL,
  `idUsuario` INT UNSIGNED NOT NULL,
  `idServico` INT UNSIGNED NOT NULL,
  `idPrioridade` INT UNSIGNED NOT NULL,
  `senha_sen` INT NOT NULL,
  `sigla_sen` CHAR(1) NULL,
  `dt_cheg` DATETIME NULL,
  `dt_cham` DATETIME NULL,
  `dt_ini` DATETIME NULL,
  `dt_fim` DATETIME NULL,
  PRIMARY KEY (`idHistAtendimento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`modulo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`modulo` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`modulo` (
  `idModulo` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_mod` VARCHAR(20) NOT NULL,
  `descricao_mod` VARCHAR(100) NOT NULL,
  `status_mod` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idModulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`menu` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`menu` (
  `idMenu` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idModulo` SMALLINT UNSIGNED NOT NULL,
  `hierarquia_men` INT UNSIGNED NULL,
  `nome_men` VARCHAR(50) NOT NULL,
  `descricao_men` VARCHAR(100) NOT NULL,
  `link_men` VARCHAR(150) NOT NULL,
  `ordem_men` SMALLINT UNSIGNED NULL,
  `status_men` TINYINT UNSIGNED NOT NULL,
  `datacad_men` DATETIME NOT NULL,
  `dataat_men` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idMenu`, `idModulo`),
  INDEX `fk_menu_modulo_idx` (`idModulo` ASC),
  INDEX `fk_menu_hierarquia_menu_idx` (`hierarquia_men` ASC),
  CONSTRAINT `fk_menu_modulo`
    FOREIGN KEY (`idModulo`)
    REFERENCES `sistemakey`.`modulo` (`idModulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_menu_hierarquia_menu`
    FOREIGN KEY (`hierarquia_men`)
    REFERENCES `sistemakey`.`menu` (`idMenu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`authSession`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`authSession` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`authSession` (
  `idUsuario` INT UNSIGNED NULL,
  `key_ses` VARCHAR(100) NOT NULL,
  `status_ses` TINYINT UNSIGNED NOT NULL,
  `data_ses` DATETIME NULL,
  INDEX `fk_authSession_usuario_idx` (`idUsuario` ASC),
  INDEX `authSession_key_idx` (`key_ses`(5) ASC),
  CONSTRAINT `fk_authSession_usuario`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `sistemakey`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`perm_modulo_perfilUsuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`perm_modulo_perfilUsuario` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`perm_modulo_perfilUsuario` (
  `idModulo` SMALLINT UNSIGNED NOT NULL,
  `idPerfilUsuario` INT UNSIGNED NOT NULL,
  `permissao` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idModulo`, `idPerfilUsuario`),
  INDEX `fk_modulo_perfilUsuario_perfilUsuario_idx` (`idPerfilUsuario` ASC),
  INDEX `fk_modulo_perfilUsuario_modulo_idx` (`idModulo` ASC),
  CONSTRAINT `fk_modulo_perfilUsuario_modulo`
    FOREIGN KEY (`idModulo`)
    REFERENCES `sistemakey`.`modulo` (`idModulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_modulo_perfilUsuario_perfilUsuario`
    FOREIGN KEY (`idPerfilUsuario`)
    REFERENCES `sistemakey`.`perfilUsuario` (`idPerfilUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`servico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`servico` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`servico` (
  `idServico` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idModulo` SMALLINT UNSIGNED NOT NULL,
  `nome_srv` VARCHAR(40) NOT NULL,
  `sigla` CHAR(1) NOT NULL,
  `descricao_srv` VARCHAR(100) NULL,
  `status_srv` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idServico`, `idModulo`),
  INDEX `fk_servico_modulo_idx` (`idModulo` ASC),
  CONSTRAINT `fk_servico_modulo`
    FOREIGN KEY (`idModulo`)
    REFERENCES `sistemakey`.`modulo` (`idModulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`servico_senha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`servico_senha` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`servico_senha` (
  `idServico` INT UNSIGNED NOT NULL,
  `idSenha` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`idSenha`, `idServico`),
  INDEX `fk_servico_senha_senha_idx` (`idSenha` ASC),
  INDEX `fk_servico_senha_servico_idx` (`idServico` ASC),
  CONSTRAINT `fk_servico_senha_servico`
    FOREIGN KEY (`idServico`)
    REFERENCES `sistemakey`.`servico` (`idServico`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servico_senha_senha`
    FOREIGN KEY (`idSenha`)
    REFERENCES `sistemakey`.`senha` (`idSenha`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`ficha`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`ficha` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`ficha` (
  `idFicha` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCliente` INT UNSIGNED NOT NULL,
  `digitalizado_fic` VARCHAR(150) NOT NULL,
  `datacad_fic` DATETIME NOT NULL,
  `dataat_fic` TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idFicha`, `idCliente`),
  INDEX `fk_ficha_cliente_idx` (`idCliente` ASC),
  CONSTRAINT `fk_ficha_cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `sistemakey`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'abertura de firma';


-- -----------------------------------------------------
-- Table `sistemakey`.`carimbo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`carimbo` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`carimbo` (
  `idCarimbo` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_car` VARCHAR(80) NOT NULL,
  `qde_car` INT NULL,
  `termo_car` VARCHAR(500) NULL,
  `livro_car` VARCHAR(80) NULL,
  PRIMARY KEY (`idCarimbo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sistemakey`.`firmas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sistemakey`.`firmas` ;

CREATE TABLE IF NOT EXISTS `sistemakey`.`firmas` (
  `idFirmas` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `idCliente` INT UNSIGNED NOT NULL,
  `idSinal` INT UNSIGNED NOT NULL,
  `nome_fir` VARCHAR(200) NOT NULL,
  `assinatura_fir` VARCHAR(200) NULL,
  PRIMARY KEY (`idFirmas`, `idCliente`, `idSinal`),
  INDEX `fk_firmas_cliente_idx` (`idCliente` ASC),
  INDEX `fk_firmas_sinal_idx` (`idSinal` ASC),
  CONSTRAINT `fk_firmas_cliente`
    FOREIGN KEY (`idCliente`)
    REFERENCES `sistemakey`.`cliente` (`idCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_firmas_sinal`
    FOREIGN KEY (`idSinal`)
    REFERENCES `sistemakey`.`sinal` (`idSinal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'reconhecer firmas';



-- ############################################
-- ---------------------------------------------------------------------
-- Inserção de registros requerídos para o funcionamento
-- ---------------------------------------------------------------------
INSERT INTO modulo (idModulo, nome_mod, descricao_mod, status_mod) VALUES
	(1, 'Reconhecimento', 'Módulo de reconhecimento de firmas', 1),
	(2, 'Autenticações', 'Módulo de autenticações de documentos', 1),
	(3, 'Cópias', 'Módulo de cópias e fotocópias de documentos', 1),
	(4, 'Atendimento', 'Módulo de atendimento ao cliente', 1),
	(5, 'Monitor', 'Módulo de monitoração do atendimento', 1),
	(6, 'Totem', 'Módulo de distribuição de senhas', 1),
	(7, 'Usuários', 'Módulo de gerenciamento de usuários', 1),
	(8, 'Clientes', 'Módulo de gerenciamento de clientes', 1);
	
INSERT INTO menu (idMenu, idModulo, hierarquia_men, nome_men, descricao_men, link_men, status_men, datacad_men) VALUES
	(1, 1, null, 'Firma', 'Reconhecimento de firmas', '#', 1, '2014-09-30'),
	(2, 1, 1, 'Abertura de Firma', 'Abrir uma firma nova', 'firma/abertura', 1, '2014-09-30'),
	(3, 1, 1, 'Reconhecer por Semelhança', 'Reconhecimento por semelhança', 'firma/semelhanca', 1, '2014-09-30'),
	(4, 1, 1, 'Reconhecer por Autenticidade', 'Reconhecimento por autenticidade', 'firma/autenticidade', 1, '2014-09-30'),
	(5, 3, null, 'Cópia', 'Cópias e Fotocópias de documentos', '#', 1, '2014-09-30'),
	(6, 3, 5, 'Fotocópia', 'Cópia comum de documento', 'copia/fotocopia', 1, '2014-09-30'),
	(7, 2, 5, 'Autenticada', 'Cópia fiél ao original', 'copia/autentica', 1, '2014-09-30'),
	(8, 4, null, 'Atendimento', 'Atendimento ao cliente', 'atendimento/', 1, '2014-09-30'),
	(9, 5, null, 'Monitor de fila', 'Monitoração de filas', 'fila/', 1, '2014-09-30'),
	(10, 7, null, 'Usuario', 'Serviços aos usuários e funcionários', 'usuario/', 1, '2014-09-30'),
	(11, 7, 10, 'Listar todos', 'Lista de usuários cadastrados', 'usuario/listar', 1, '2014-09-30'),
	(12, 7, 10, 'Permissões', 'Gerenciar permissões de usuário', 'usuario/permissoes', 1, '2014-09-30'),
	(13, 8, null, 'Cliente', 'Serviços aos clientes', 'cliente/', 1, '2014-09-30'),
	(14, 8, 10, 'Listar todos', 'Lista de clientes cadastrados', 'cliente/listar', 1, '2014-09-30'),
	(15, 8, 10, 'Firmas reconhecidas', 'Firmas reconhecidas de um cliente', 'cliente/firmas', 1, '2014-09-30'),
	(16, 8, 10, 'Assinatura', 'Assinatura de um cliente', 'cliente/assinatura', 1, '2014-09-30');
	
INSERT INTO perfilUsuario (idPerfilUsuario, nome_perf, descricao_perf) VALUES
	(1, 'Administrador', 'Perfil de administrador'),
	(2, 'Balcão firmas', 'Balcão de Reconhecimento de Firmas'),
	(3, 'Balcão cópias', 'Balcão de Cópias e Autenticações'),
	(4, 'Dept Firmas', 'Departamento interno de Firmas'),
	(5, 'Dept Cópias', 'Departamento interno de Cópias');
	
INSERT INTO perm_modulo_perfilUsuario (idModulo, idPerfilUsuario, permissao) VALUES
	(1, 1, 1),
	(2, 1, 1),
	(3, 1, 1),
	(4, 1, 1),
	(5, 1, 1),
	(6, 1, 1),
	(7, 1, 1),
	(8, 1, 1),
	(1, 2, 1),
	(4, 2, 1),
	(5, 2, 1),
	(8, 2, 1),
	(2, 3, 1),
	(3, 3, 1),
	(4, 3, 1),
	(5, 3, 1),
	(8, 3, 1),
	(1, 4, 1),
	(5, 4, 1),
	(1, 5, 1),
	(5, 5, 1);

INSERT INTO usuario (idUsuario, idPerfilUsuario, nome_usu, login_usu, senha_usu, status_usu, datacad_usu) VALUES
	(1, 1, 'Administrador', 'admin', '12345', 1, '2014-09-30');
	
INSERT INTO prioridade (idPrioridade, nome_pri, descricao_pri, peso_pri, status_pri) VALUES
	(1, 'Sem prioridade', 'Sem prioridade', 0, 1),
	(2, 'Def. Auditivo', 'Deficiente Auditivo', 1, 1),
	(3, 'Def. Físico', 'Deficiente Físico', 1, 1),
	(4, 'Def. Visual', 'Deficiente Visual', 1, 1),
	(5, 'Gestante', 'Gestantes', 1, 1),
	(6, 'Idoso', 'Idosos', 1, 1),
	(7, 'Outros', 'Outra prioridade', 1, 1);
	
INSERT INTO sinal (idSinal, nomecartorio_sin, cidade_sin, estado_sin, datacad_sin) VALUES
	(1, '16º Tabelião de Notas', 'São Paulo', 'SP', '2014-09-30');
	
INSERT INTO escrevente (idEscrevente, idSinal, nome_esc) VALUES
	(1, 1, 'DANIELA CRISTINA PINHEIRO FINS'),
	(2, 1, 'FABIO TADEU BISOGNIN'),
	(3, 1, 'FABIO ZAFFALON PEREIRA'),
	(4, 1, 'JOAQUIM ITALO BELTRAMIN'),
	(5, 1, 'LAURO TADEU CARREA FALCHI'),
	(6, 1, 'PAULO EDUARDO NASCIMENTO'),
	(7, 1, 'RONALDO ROBERTO ZARATIN'),
	(8, 1, 'RONICLAY DOS SANTOS REGO'),
	(10, 1, 'WAGNER AUGUSTO TEIXEIRA'),
	(11, 1, 'WILLIAM DE OLIVEIRA ARANTES');
	