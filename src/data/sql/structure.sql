CREATE TABLE `config` (
  `id_config` int(11) NOT NULL AUTO_INCREMENT,
  `used` int(1) NOT NULL,
  `close` int(1) NOT NULL,
  `company_logo_path` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_street` varchar(255) NOT NULL,
  `company_town` varchar(255) NOT NULL,
  `company_country` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `company_info_mail` varchar(255) NOT NULL,
  `mail_header_email` varchar(255) NOT NULL,
  `footer_mail` varchar(255) NOT NULL,
  `debug_mode` int(1) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_swift` varchar(255) NOT NULL,
  `bank_iban` varchar(255) NOT NULL,
  `bank_account_number` varchar(255) NOT NULL,
  `bank_transfer_beneficiary` varchar(255) NOT NULL,
  PRIMARY KEY (`id_config`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `config`
--

INSERT INTO `config` (`id_config`, `used`, `close`, `company_logo_path`, `company_name`, `company_street`, `company_town`, `company_country`, `company_phone`, `company_info_mail`, `mail_header_email`, `footer_mail`, `debug_mode`, `bank_name`, `bank_swift`, `bank_iban`, `bank_account_number`, `bank_transfer_beneficiary`) VALUES
(1, 1, 0, 'server/assets/img/logo.png', 'Prisma', 'Menendez Pelayo 3', 'Vigo', 'Spain', '886131361', 'info@prismamec.com', 'Prisma Mec<noreply@prismamec.com>', '', 1, '0000', '0000', '0000', '0000', '0000');
