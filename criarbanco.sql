CREATE DATABASE db_woody_woodpecker;



CREATE TABLE `tbl_fale_conosco` (
  `id` int(11) NOT NULL,
  `nomeContato` varchar(100) NOT NULL,
  
`emailContato` varchar(100) NOT NULL,
  `sexoContato` char(1) NOT NULL,
  `profissao` varchar(55) NOT NULL,
  `telefone` varchar(13) DEFAULT NULL,
  
`celular` varchar(14) NOT NULL,
  `homePage` varchar(75) DEFAULT NULL,
  `contaFacebook` varchar(45) DEFAULT NULL,
  `critica_e_sugestao` text,
  
`infoProduto` text
);


ALTER TABLE `tbl_fale_conosco`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tbl_fale_conosco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
