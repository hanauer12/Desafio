Estrutura do banco de dados temporario


CREATE TABLE  `primeiro` (
`cod_paciente` INT NOT NULL AUTO_INCREMENT,
`nome_paciente` VARCHAR(255) NOT NULL,
`nasc_paciente` DATE NOT NULL,
`pai_paciente` VARCHAR(255) NOT NULL,
`mae_paciente` VARCHAR(255) NOT NULL,
`cpf_paciente` VARCHAR(14) NULL,
`rg_paciente` VARCHAR(20) NULL,
`sexo_pac` ENUM('M', 'F') NOT NULL,
`id_conv` iNT NULL,
`convenio` VARCHAR(14) NULL,
`obs_clinicas` VARCHAR(50) NULL,
PRIMARY KEY (`cod_paciente`)
)
