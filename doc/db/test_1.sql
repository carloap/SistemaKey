-- ############################################
-- ---------------------------------------------------------------------
-- Inser��o de registros de teste
-- ---------------------------------------------------------------------
INSERT INTO usuario (idUsuario, idPerfilUsuario, nome_usu, login_usu, senha_usu, status_usu, datacad_usu) VALUES
	(2, 2, 'Balc�o firma teste', 'balcaoFirmas', 'balcao', 1, '2014-09-30'),
	(3, 3, 'Balc�o c�pia teste', 'balcaoCopias', 'balcao', 1, '2014-09-30'),
	(4, 4, 'Dept Firmas teste', 'deptFirmas', 'dept', 1, '2014-09-30'),
	(5, 5, 'Dept C�pias teste', 'deptCopias', 'dept', 1, '2014-09-30');

INSERT INTO cliente (idCliente, nome_cli, email_cli, sexo_cli, rg_cli, orgexped_cli, cpf_cli, datacad_cli) VALUES
	(1, 'Carlos Alberto', 'alcarlos@gmail.com', 'M', '50816252x', 'SSP', '40716437813', '2014-09-30');

