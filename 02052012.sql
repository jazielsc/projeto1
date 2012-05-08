-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 03/05/2012 às 01h04min
-- Versão do Servidor: 5.5.20
-- Versão do PHP: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `boletimflex`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `cod_aluno` int(10) NOT NULL AUTO_INCREMENT,
  `cod_status` int(10) NOT NULL,
  `cod_instituicao` int(10) NOT NULL,
  `cod_curso` int(10) NOT NULL,
  `1_identificacao_unica` varchar(8) NOT NULL,
  `2_nome_completo` varchar(102) NOT NULL,
  `3_nis` varchar(11) NOT NULL,
  `4_data_nascimento` date NOT NULL,
  `5_sexo` char(1) NOT NULL,
  `6_cor_raca` int(11) NOT NULL,
  `7_mae` varchar(102) NOT NULL,
  `7_pai` varchar(102) NOT NULL,
  `8_nacionalidade` int(11) NOT NULL,
  `9_pais_origem` varchar(3) NOT NULL,
  `10_uf_nascimento` varchar(2) NOT NULL,
  `11_municipio_nascimento` varchar(44) NOT NULL,
  `12_deficiencia` int(11) NOT NULL,
  `12a_tipo_deficiencia` int(11) NOT NULL,
  `13_identidade` varchar(25) NOT NULL,
  `13a_complemento_identidade` varchar(4) NOT NULL,
  `13b_orgao_emissor` varchar(18) NOT NULL,
  `13c_uf` varchar(2) NOT NULL,
  `13d_data_emissao` date NOT NULL,
  `14_certidao_civil` int(11) NOT NULL,
  `14a_tipo` int(11) NOT NULL,
  `14b_numero_termo` varchar(8) NOT NULL,
  `14c_folha` varchar(4) NOT NULL,
  `14d_livro` varchar(8) NOT NULL,
  `14e_data_emissao_certidao` date NOT NULL,
  `14f_uf_cartorio` varchar(2) NOT NULL,
  `14g_municipio_cartorio` varchar(44) NOT NULL,
  `14h_nome_cartorio` varchar(60) NOT NULL,
  `14i_numero_matricula` varchar(32) NOT NULL,
  `15_cpf` varchar(11) NOT NULL,
  `16_passaporte` varchar(20) NOT NULL,
  `17_localizacao` int(11) NOT NULL,
  `18_cep` varchar(8) NOT NULL,
  `19_endereco` varchar(102) NOT NULL,
  `20_numero` varchar(20) NOT NULL,
  `21_complemento` varchar(20) NOT NULL,
  `22_bairro` varchar(44) NOT NULL,
  `23_uf` varchar(2) NOT NULL,
  `24_municipio` varchar(102) NOT NULL,
  `25_nome_turma` varchar(102) NOT NULL,
  `26_turma_unificada` int(11) NOT NULL,
  `27_educacao_infantil` int(11) NOT NULL,
  `27_ensino_fundamental_seie` varchar(2) NOT NULL,
  `27_ensino_fundamental_ano` varchar(2) NOT NULL,
  `27_educacao_jovens_adultos` int(11) NOT NULL,
  `27_educacao_profissional_mista` int(11) NOT NULL,
  `28_escolarizacao_fora_escola` int(11) NOT NULL,
  `29_transporte_publico` int(11) NOT NULL,
  `29a_poder_responsavel` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nome_responsavel` varchar(102) NOT NULL,
  `email_responsavel` varchar(60) NOT NULL,
  `matricula` varchar(60) NOT NULL,
  PRIMARY KEY (`cod_aluno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_curso`
--

CREATE TABLE IF NOT EXISTS `aluno_curso` (
  `cod_aluno` int(11) NOT NULL,
  `cod_curso` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE IF NOT EXISTS `avaliacao` (
  `cod_avaliacao` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `cod_professor` int(10) NOT NULL,
  `cod_curso` int(11) NOT NULL,
  `cod_turma` int(11) NOT NULL,
  `cod_disciplina` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `minima` int(10) NOT NULL DEFAULT '7',
  `cod_usuario` int(10) NOT NULL,
  PRIMARY KEY (`cod_avaliacao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

CREATE TABLE IF NOT EXISTS `bairro` (
  `bairro_id` int(6) NOT NULL AUTO_INCREMENT,
  `bairro_nome` varchar(50) NOT NULL,
  `cidade_id` int(6) NOT NULL,
  PRIMARY KEY (`bairro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=138 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `boletim`
--

CREATE TABLE IF NOT EXISTS `boletim` (
  `cod_boletim` int(11) NOT NULL AUTO_INCREMENT,
  `nota_01` decimal(10,2) DEFAULT NULL,
  `nota_02` decimal(10,2) DEFAULT NULL,
  `nota_03` decimal(10,2) DEFAULT NULL,
  `nota_04` decimal(10,2) DEFAULT NULL,
  `nota_05` decimal(10,2) DEFAULT NULL,
  `nota_06` decimal(10,2) DEFAULT NULL,
  `n_avaliacoes` int(2) NOT NULL,
  `faltas` int(11) DEFAULT NULL,
  `media` decimal(10,2) DEFAULT NULL,
  `cod_curso` int(11) NOT NULL,
  `cod_turma` int(11) NOT NULL,
  `cod_disciplina` int(11) NOT NULL,
  `cod_professor` int(11) NOT NULL,
  `cod_aluno` int(11) NOT NULL,
  `unidade` varchar(6) NOT NULL,
  PRIMARY KEY (`cod_boletim`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendario`
--

CREATE TABLE IF NOT EXISTS `calendario` (
  `cod_calendario` int(10) NOT NULL AUTO_INCREMENT,
  `dia` date NOT NULL,
  `inicio` char(5) NOT NULL,
  `termino` char(5) NOT NULL,
  `cod_turma` int(10) NOT NULL,
  `cod_disciplina` int(10) NOT NULL,
  `cod_professor` int(11) NOT NULL DEFAULT '6',
  `calendario` varchar(10) NOT NULL,
  `dia_numero` int(2) NOT NULL,
  `cod_curso` int(9) NOT NULL,
  PRIMARY KEY (`cod_calendario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cidade`
--

CREATE TABLE IF NOT EXISTS `cidade` (
  `cidade_id` int(11) NOT NULL AUTO_INCREMENT,
  `cidade_uf` int(11) NOT NULL DEFAULT '0',
  `cidade_nome` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`cidade_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tabela suporte com todas as \r\n\r\ncidades utilizadas pelo sist' AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--

CREATE TABLE IF NOT EXISTS `colaborador` (
  `cod_colaborador` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cod_cidade` int(10) NOT NULL,
  `cod_bairro` int(10) NOT NULL,
  `cod_rua` int(10) NOT NULL,
  `complemento` varchar(80) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `cod_uf` varchar(10) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular` varchar(14) NOT NULL,
  `cod_status` int(10) NOT NULL,
  `cep` char(9) DEFAULT NULL,
  `login` varchar(60) NOT NULL,
  `senha` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_colaborador`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador_instituicao`
--

CREATE TABLE IF NOT EXISTS `colaborador_instituicao` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_colaborador` int(11) NOT NULL,
  `cod_instituicao` int(11) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `media` varchar(3) NOT NULL,
  `cod_tipo` varchar(2) NOT NULL,
  `ranking` varchar(3) NOT NULL,
  `cod_instituicao` int(11) NOT NULL,
  `cod_paralela` int(3) NOT NULL,
  `tipo_cadastro` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `cod_curso` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `cod_instituicao` int(10) NOT NULL,
  `tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`cod_curso`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE IF NOT EXISTS `disciplina` (
  `cod_disciplina` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `cod_professor` int(10) NOT NULL,
  `cod_curso` int(10) NOT NULL,
  `cod_turma` int(10) NOT NULL,
  `carga_horaria` decimal(10,2) NOT NULL,
  `numero_faltas` int(3) NOT NULL,
  PRIMARY KEY (`cod_disciplina`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `esqueceu_senha`
--

CREATE TABLE IF NOT EXISTS `esqueceu_senha` (
  `ip_assinatura` varchar(15) NOT NULL,
  `ip_confirmacao` varchar(15) NOT NULL,
  `data_assinatura` date NOT NULL,
  `data_confirmacao` date NOT NULL,
  `hash` varchar(50) NOT NULL,
  `nick` varchar(100) NOT NULL,
  `cod_usuario` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `cod_pagamento` int(2) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`cod_pagamento`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `cod_funcionario` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `cod_cidade` int(10) NOT NULL,
  `cod_bairro` int(10) NOT NULL,
  `cod_rua` int(10) NOT NULL,
  `complemento` varchar(80) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `cod_uf` varchar(10) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `cod_status` int(10) NOT NULL,
  `cod_instituicao` int(10) NOT NULL,
  `cep` char(9) DEFAULT NULL,
  `cargo` varchar(30) NOT NULL,
  `identidade` varchar(20) NOT NULL,
  PRIMARY KEY (`cod_funcionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `cod_horario` int(10) NOT NULL AUTO_INCREMENT,
  `dia` varchar(60) NOT NULL,
  `inicio` char(5) NOT NULL,
  `termino` char(5) NOT NULL,
  `cod_turma` int(10) NOT NULL,
  `cod_disciplina` int(10) NOT NULL,
  `cod_professor` int(11) NOT NULL DEFAULT '6',
  `horario` varchar(10) NOT NULL,
  `dia_numero` int(2) NOT NULL,
  `cod_curso` int(9) NOT NULL,
  PRIMARY KEY (`cod_horario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE IF NOT EXISTS `instituicao` (
  `cod_instituicao` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `cod_status` int(10) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `pasta` varchar(60) NOT NULL,
  `cod_tipo` int(3) NOT NULL,
  `1_` varchar(2) NOT NULL,
  `2a_` date NOT NULL,
  `2b_` date NOT NULL,
  `3_` varchar(102) NOT NULL,
  `4_` varchar(20) NOT NULL,
  `5_` varchar(102) NOT NULL,
  `6_` varchar(50) NOT NULL,
  `7_` varchar(80) NOT NULL,
  `8_` varchar(100) NOT NULL,
  `9_` varchar(2) NOT NULL,
  `10_` varchar(70) NOT NULL,
  `11_` varchar(100) NOT NULL,
  `12_` varchar(20) NOT NULL,
  `13_` varchar(20) NOT NULL,
  `14_` varchar(20) NOT NULL,
  `15_` varchar(20) NOT NULL,
  `16_` varchar(20) NOT NULL,
  `17_` varchar(80) NOT NULL,
  `18_` varchar(10) NOT NULL,
  `18a_` varchar(80) NOT NULL,
  `19_` varchar(2) NOT NULL,
  `20_` varchar(2) NOT NULL,
  `21_` varchar(2) NOT NULL,
  `21a_` varchar(2) NOT NULL,
  `21b_` varchar(50) NOT NULL,
  `21c_` varchar(50) NOT NULL,
  `22_1_` varchar(5) NOT NULL,
  `22_2_` varchar(5) NOT NULL,
  `22_3_` varchar(5) NOT NULL,
  `22_4_` varchar(5) NOT NULL,
  `23_` varchar(50) NOT NULL,
  `24_` varchar(50) NOT NULL,
  `25_` varchar(2) NOT NULL,
  `26_` varchar(50) NOT NULL,
  `27_` varchar(100) NOT NULL,
  `28_` varchar(80) NOT NULL,
  `29_` varchar(80) NOT NULL,
  `30_1_` varchar(5) NOT NULL,
  `30_2_` varchar(5) NOT NULL,
  `30_3_` varchar(5) NOT NULL,
  `30_4_` varchar(5) NOT NULL,
  `30_5_` varchar(5) NOT NULL,
  `30_6_` varchar(5) NOT NULL,
  `30_7_` varchar(5) NOT NULL,
  `30_8_` varchar(5) NOT NULL,
  `30a_` varchar(2) NOT NULL,
  `31_` varchar(2) NOT NULL,
  `31a_1_` varchar(20) NOT NULL,
  `31a_2_` varchar(20) NOT NULL,
  `31a_3_` varchar(20) NOT NULL,
  `31a_4_` varchar(20) NOT NULL,
  `31a_5_` varchar(20) NOT NULL,
  `31a_6_` varchar(20) NOT NULL,
  `32_` varchar(2) NOT NULL,
  `33_` varchar(2) NOT NULL,
  `34_` varchar(2) NOT NULL,
  `35_` varchar(2) NOT NULL,
  `36_` varchar(2) NOT NULL,
  `37_1_` varchar(5) NOT NULL,
  `37_2_` varchar(5) NOT NULL,
  `37_3_` varchar(5) NOT NULL,
  `37_4_` varchar(5) NOT NULL,
  `37_5_` varchar(5) NOT NULL,
  `37_6_` varchar(5) NOT NULL,
  `37_7_` varchar(5) NOT NULL,
  `37_8_` varchar(5) NOT NULL,
  `37_9_` varchar(5) NOT NULL,
  `37_10_` varchar(5) NOT NULL,
  `37_11_` varchar(5) NOT NULL,
  `37_12_` varchar(5) NOT NULL,
  `37_13_` varchar(5) NOT NULL,
  `37_14_` varchar(5) NOT NULL,
  `37_15_` varchar(5) NOT NULL,
  `37_16_` varchar(5) NOT NULL,
  `37_17_` varchar(5) NOT NULL,
  `37_18_` varchar(5) NOT NULL,
  `38_` varchar(10) NOT NULL,
  `39_` varchar(10) NOT NULL,
  `40_1_` varchar(5) NOT NULL,
  `40_2_` varchar(5) NOT NULL,
  `40_3_` varchar(5) NOT NULL,
  `40_4_` varchar(5) NOT NULL,
  `40_5_` varchar(5) NOT NULL,
  `40_6_` varchar(5) NOT NULL,
  `40_7_` varchar(5) NOT NULL,
  `41_` varchar(2) NOT NULL,
  `41a_` varchar(10) NOT NULL,
  `41b_` varchar(10) NOT NULL,
  `41c_` varchar(10) NOT NULL,
  `41d_` varchar(2) NOT NULL,
  `41e_` varchar(2) NOT NULL,
  `42_` varchar(10) NOT NULL,
  `43_` varchar(2) NOT NULL,
  `44_` varchar(2) NOT NULL,
  `45_` varchar(2) NOT NULL,
  `46_` varchar(2) NOT NULL,
  `47_1_` varchar(2) NOT NULL,
  `47_2_` varchar(2) NOT NULL,
  `47_3_` varchar(2) NOT NULL,
  `47_4_` varchar(2) NOT NULL,
  `48_` varchar(2) NOT NULL,
  `49_` varchar(2) NOT NULL,
  `50_` varchar(2) NOT NULL,
  `51_` varchar(2) NOT NULL,
  `52_` varchar(2) NOT NULL,
  `52_1_` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_instituicao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`cod_instituicao`, `nome`, `email`, `cod_status`, `responsavel`, `pasta`, `cod_tipo`, `1_`, `2a_`, `2b_`, `3_`, `4_`, `5_`, `6_`, `7_`, `8_`, `9_`, `10_`, `11_`, `12_`, `13_`, `14_`, `15_`, `16_`, `17_`, `18_`, `18a_`, `19_`, `20_`, `21_`, `21a_`, `21b_`, `21c_`, `22_1_`, `22_2_`, `22_3_`, `22_4_`, `23_`, `24_`, `25_`, `26_`, `27_`, `28_`, `29_`, `30_1_`, `30_2_`, `30_3_`, `30_4_`, `30_5_`, `30_6_`, `30_7_`, `30_8_`, `30a_`, `31_`, `31a_1_`, `31a_2_`, `31a_3_`, `31a_4_`, `31a_5_`, `31a_6_`, `32_`, `33_`, `34_`, `35_`, `36_`, `37_1_`, `37_2_`, `37_3_`, `37_4_`, `37_5_`, `37_6_`, `37_7_`, `37_8_`, `37_9_`, `37_10_`, `37_11_`, `37_12_`, `37_13_`, `37_14_`, `37_15_`, `37_16_`, `37_17_`, `37_18_`, `38_`, `39_`, `40_1_`, `40_2_`, `40_3_`, `40_4_`, `40_5_`, `40_6_`, `40_7_`, `41_`, `41a_`, `41b_`, `41c_`, `41d_`, `41e_`, `42_`, `43_`, `44_`, `45_`, `46_`, `47_1_`, `47_2_`, `47_3_`, `47_4_`, `48_`, `49_`, `50_`, `51_`, `52_`, `52_1_`) VALUES
(6, 'Boletim Flex - Apresentação do Sistema', 'direcaoboletimflex@hotmail.com', 1, 'Administraçãoo Executiva/Técnica', 'apresentacao', 0, '', '0000-00-00', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `cod_item` int(10) NOT NULL AUTO_INCREMENT,
  `cod_turma` int(10) NOT NULL,
  `cod_aluno` int(10) NOT NULL,
  `cod_status` int(3) NOT NULL,
  PRIMARY KEY (`cod_item`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item2`
--

CREATE TABLE IF NOT EXISTS `item2` (
  `cod_item2` int(10) NOT NULL AUTO_INCREMENT,
  `cod_disciplina` int(10) NOT NULL,
  `cod_aluno` int(10) NOT NULL,
  `cod_status` int(2) NOT NULL,
  PRIMARY KEY (`cod_item2`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=145 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE IF NOT EXISTS `mensagem` (
  `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `data` date DEFAULT NULL,
  `id_rem` int(11) DEFAULT NULL,
  `id_des` int(11) DEFAULT NULL,
  `prioridade` int(3) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`cod_mensagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem_enviadas`
--

CREATE TABLE IF NOT EXISTS `mensagem_enviadas` (
  `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT,
  `assunto` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `data` date DEFAULT NULL,
  `id_rem` int(11) DEFAULT NULL,
  `id_des` int(11) DEFAULT NULL,
  `prioridade` int(3) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`cod_mensagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem_lixeira`
--

CREATE TABLE IF NOT EXISTS `mensagem_lixeira` (
  `cod_mensagem` int(11) NOT NULL,
  `assunto` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mensagem` text COLLATE utf8_unicode_ci,
  `data` date DEFAULT NULL,
  `id_rem` int(11) DEFAULT NULL,
  `id_des` int(11) DEFAULT NULL,
  `prioridade` int(3) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`cod_mensagem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `cod_professor` int(10) NOT NULL AUTO_INCREMENT,
  `cod_status` int(10) NOT NULL,
  `cod_instituicao` int(10) NOT NULL,
  `1_` varchar(30) NOT NULL,
  `2_` varchar(102) NOT NULL,
  `3_` varchar(80) NOT NULL,
  `4_` varchar(50) NOT NULL,
  `5_` date NOT NULL,
  `6_` varchar(2) NOT NULL,
  `7_` varchar(2) NOT NULL,
  `8_` varchar(102) NOT NULL,
  `9_` varchar(2) NOT NULL,
  `10_` varchar(10) NOT NULL,
  `11_` varchar(5) NOT NULL,
  `12_` varchar(80) NOT NULL,
  `13_` varchar(20) NOT NULL,
  `14_` varchar(20) NOT NULL,
  `15_` varchar(80) NOT NULL,
  `16_` varchar(20) NOT NULL,
  `17_` varchar(80) NOT NULL,
  `18_` varchar(80) NOT NULL,
  `19_` varchar(5) NOT NULL,
  `20_` varchar(102) NOT NULL,
  `21_1_` varchar(2) NOT NULL,
  `21_2_` varchar(2) NOT NULL,
  `21_3_` varchar(20) NOT NULL,
  `21_4_` varchar(20) NOT NULL,
  `21_5_` varchar(20) NOT NULL,
  `21_6_` varchar(20) NOT NULL,
  `21_7_` varchar(2) NOT NULL,
  `21_8_` varchar(2) NOT NULL,
  `21_9_` varchar(2) NOT NULL,
  `21_10_` varchar(20) NOT NULL,
  `21_11_` varchar(20) NOT NULL,
  `21_12_` varchar(20) NOT NULL,
  `21_13_` varchar(20) NOT NULL,
  `21_14_` varchar(2) NOT NULL,
  `21_15_` varchar(2) NOT NULL,
  `21_16_` varchar(2) NOT NULL,
  `21_17_` varchar(20) NOT NULL,
  `21_18_` varchar(20) NOT NULL,
  `21_19_` varchar(20) NOT NULL,
  `21_20_` varchar(20) NOT NULL,
  `21_21_` varchar(2) NOT NULL,
  `21_22_` varchar(2) NOT NULL,
  `22_` varchar(2) NOT NULL,
  `23_1_` varchar(5) NOT NULL,
  `23_2_` varchar(5) NOT NULL,
  `23_3_` varchar(5) NOT NULL,
  `23_4_` varchar(5) NOT NULL,
  `23_5_` varchar(5) NOT NULL,
  `23_6_` varchar(5) NOT NULL,
  `23_7_` varchar(5) NOT NULL,
  `23_8_` varchar(5) NOT NULL,
  `23_9_` varchar(5) NOT NULL,
  `23_10_` varchar(5) NOT NULL,
  `23_11_` varchar(5) NOT NULL,
  `24_` varchar(2) NOT NULL,
  `25_` varchar(2) NOT NULL,
  `26_1_` varchar(100) NOT NULL,
  `26_2_` varchar(100) NOT NULL,
  `26_3_` varchar(100) NOT NULL,
  `26_4_` varchar(100) NOT NULL,
  `26_5_` varchar(100) NOT NULL,
  `26_6_` varchar(100) NOT NULL,
  `27_1_1_` varchar(5) NOT NULL,
  `27_1_2_` varchar(5) NOT NULL,
  `27_1_3_` varchar(5) NOT NULL,
  `27_1_4_` varchar(5) NOT NULL,
  `27_1_5_` varchar(5) NOT NULL,
  `27_1_6_` varchar(5) NOT NULL,
  `27_1_7_` varchar(5) NOT NULL,
  `27_2_1_` varchar(5) NOT NULL,
  `27_2_2_` varchar(5) NOT NULL,
  `27_2_3_` varchar(5) NOT NULL,
  `27_2_4_` varchar(5) NOT NULL,
  `27_2_5_` varchar(5) NOT NULL,
  `27_2_6_` varchar(5) NOT NULL,
  `27_2_7_` varchar(5) NOT NULL,
  `27_3_1_` varchar(5) NOT NULL,
  `27_3_2_` varchar(5) NOT NULL,
  `27_3_3_` varchar(5) NOT NULL,
  `27_3_4_` varchar(5) NOT NULL,
  `27_3_5_` varchar(5) NOT NULL,
  `27_3_6_` varchar(5) NOT NULL,
  `27_3_7_` varchar(5) NOT NULL,
  `27_4_1_` varchar(5) NOT NULL,
  `27_4_2_` varchar(5) NOT NULL,
  `27_4_3_` varchar(5) NOT NULL,
  `27_4_4_` varchar(5) NOT NULL,
  `27_4_5_` varchar(5) NOT NULL,
  `27_4_6_` varchar(5) NOT NULL,
  `27_4_7_` varchar(11) NOT NULL,
  `27_5_1_` varchar(5) NOT NULL,
  `27_5_2_` varchar(5) NOT NULL,
  `27_5_3_` varchar(5) NOT NULL,
  `27_5_4_` varchar(5) NOT NULL,
  `27_5_5_` varchar(5) NOT NULL,
  `27_5_6_` varchar(5) NOT NULL,
  `27_5_7_` varchar(5) NOT NULL,
  `27_6_1_` varchar(5) NOT NULL,
  `27_6_2_` varchar(5) NOT NULL,
  `27_6_3_` varchar(5) NOT NULL,
  `27_6_4_` varchar(5) NOT NULL,
  `27_6_5_` varchar(5) NOT NULL,
  `27_6_6_` varchar(5) NOT NULL,
  `27_6_7_` varchar(5) NOT NULL,
  PRIMARY KEY (`cod_professor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE IF NOT EXISTS `prova` (
  `cod_prova` int(10) NOT NULL AUTO_INCREMENT,
  `numero` int(3) NOT NULL,
  `resposta` varchar(2) NOT NULL,
  `cod_avaliacao` int(10) NOT NULL,
  `session` int(10) NOT NULL,
  `cod_aluno` int(11) NOT NULL,
  PRIMARY KEY (`cod_prova`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE IF NOT EXISTS `questao` (
  `cod_questao` int(10) NOT NULL AUTO_INCREMENT,
  `numero` int(3) NOT NULL,
  `peso` int(3) NOT NULL,
  `pergunta` varchar(600) NOT NULL,
  `resposta` varchar(2) NOT NULL,
  `cod_avaliacao` int(10) NOT NULL,
  `session` int(10) NOT NULL,
  `tipo` int(2) NOT NULL,
  PRIMARY KEY (`cod_questao`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `cod_resposta` int(10) NOT NULL AUTO_INCREMENT,
  `numero` int(3) NOT NULL,
  `alternativa` varchar(2) NOT NULL,
  `resposta` varchar(300) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `cod_questao` int(10) NOT NULL,
  `session` int(10) NOT NULL,
  PRIMARY KEY (`cod_resposta`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE IF NOT EXISTS `resultado` (
  `cod_resultado` int(10) NOT NULL AUTO_INCREMENT,
  `cod_aluno` int(10) NOT NULL,
  `cod_avaliacao` int(10) NOT NULL,
  `data` date NOT NULL,
  `tempo` time NOT NULL,
  `nota` decimal(10,2) NOT NULL,
  PRIMARY KEY (`cod_resultado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rua`
--

CREATE TABLE IF NOT EXISTS `rua` (
  `rua_id` int(8) NOT NULL AUTO_INCREMENT,
  `rua_nome` varchar(40) NOT NULL,
  `bairro_id` int(8) NOT NULL,
  PRIMARY KEY (`rua_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=493 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `cod_status` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`cod_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status2`
--

CREATE TABLE IF NOT EXISTS `status2` (
  `cod_status` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status3`
--

CREATE TABLE IF NOT EXISTS `status3` (
  `cod_status` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`cod_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `status4`
--

CREATE TABLE IF NOT EXISTS `status4` (
  `cod_status` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`cod_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `cod_tipo` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_tipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `cod_turma` int(10) NOT NULL AUTO_INCREMENT,
  `cod_instituicao` int(10) NOT NULL,
  `cod_curso` int(10) NOT NULL,
  `turno` varchar(30) NOT NULL,
  `semestre` varchar(2) NOT NULL,
  `ano` varchar(11) NOT NULL,
  `1_` varchar(102) NOT NULL,
  `2_1_` varchar(20) NOT NULL,
  `2_2_` varchar(20) NOT NULL,
  `3_` varchar(2) NOT NULL,
  `4_` varchar(2) NOT NULL,
  `5_1_` varchar(5) NOT NULL,
  `5_2_` varchar(5) NOT NULL,
  `5_3_` varchar(5) NOT NULL,
  `5_4_` varchar(5) NOT NULL,
  `5_5_` varchar(5) NOT NULL,
  `5_6_` varchar(5) NOT NULL,
  `6_1_` varchar(5) NOT NULL,
  `6_2_` varchar(5) NOT NULL,
  `6_3_` varchar(5) NOT NULL,
  `6_4_` varchar(5) NOT NULL,
  `6_5_` varchar(5) NOT NULL,
  `6_6_` varchar(5) NOT NULL,
  `6_7_` varchar(5) NOT NULL,
  `6_8_` varchar(5) NOT NULL,
  `6_9_` varchar(5) NOT NULL,
  `6_10_` varchar(5) NOT NULL,
  `6_11_` varchar(5) NOT NULL,
  `7_` varchar(2) NOT NULL,
  `8_` varchar(2) NOT NULL,
  `9_1_` varchar(5) NOT NULL,
  `9_2_` varchar(5) NOT NULL,
  `9_3_` varchar(5) NOT NULL,
  `9_4_` varchar(5) NOT NULL,
  `9_5_` varchar(5) NOT NULL,
  `9_6_` varchar(5) NOT NULL,
  `9_7_` varchar(5) NOT NULL,
  `9_8_` varchar(5) NOT NULL,
  `9_9_` varchar(5) NOT NULL,
  `9_10_` varchar(5) NOT NULL,
  `9_11_` varchar(5) NOT NULL,
  `9_12_` varchar(5) NOT NULL,
  `9_13_` varchar(5) NOT NULL,
  `9_14_` varchar(5) NOT NULL,
  `9_15_` varchar(5) NOT NULL,
  `9_16_` varchar(5) NOT NULL,
  `9_17_` varchar(5) NOT NULL,
  `9_20_` varchar(5) NOT NULL,
  `9_21_` varchar(5) NOT NULL,
  `9_23_` varchar(5) NOT NULL,
  `9_25_` varchar(5) NOT NULL,
  `9_26_` varchar(5) NOT NULL,
  `9_27_` varchar(5) NOT NULL,
  `9_99_` varchar(5) NOT NULL,
  `8_1_` varchar(10) NOT NULL,
  `8_2_` varchar(10) NOT NULL,
  `8_3_` varchar(10) NOT NULL,
  PRIMARY KEY (`cod_turma`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE IF NOT EXISTS `uf` (
  `uf_id` int(11) NOT NULL AUTO_INCREMENT,
  `uf_sigla` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`uf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Tabela suporte com todos os \r\n\r\nestados brasileiros.' AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) NOT NULL,
  `usuario_login` varchar(100) NOT NULL,
  `usuario_pass` varchar(60) NOT NULL,
  `usuario_atrib` int(5) NOT NULL,
  `referencia` int(2) NOT NULL DEFAULT '0',
  `cod_aluno_professor` int(11) NOT NULL DEFAULT '0',
  `cod_instituicao` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `loginUsuario` (`usuario_login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='tabela de usuario que acessam o sistema.' AUTO_INCREMENT=231 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `usuario_login`, `usuario_pass`, `usuario_atrib`, `referencia`, `cod_aluno_professor`, `cod_instituicao`, `email`) VALUES
(0, 'Administração Geral Boletim Flex', 'boletimflex', '2c411c05a77137df3d0512c97dc508c8', 1, 0, 0, 6, 'contatoboletimflex@hotmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
