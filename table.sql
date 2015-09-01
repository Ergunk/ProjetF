CREATE DATABASE IF NOT EXISTS `siteweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `siteweb`;


CREATE TABLE IF NOT EXISTS `tblevenements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `tblmembres` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `pseudo`varchar(255) NOT NULL,
    `pass` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `date_inscription` date NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;