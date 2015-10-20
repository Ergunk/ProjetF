CREATE DATABASE IF NOT EXISTS `siteweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;

USE `siteweb`;

--
-- Structure de la table `tblevenements`
--

CREATE TABLE IF NOT EXISTS `tblevenements` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `createby` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tblmembres`
--

CREATE TABLE IF NOT EXISTS `tblmembres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date_inscription` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'offline',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tblmessages`
--

CREATE TABLE IF NOT EXISTS `tblmessages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `iduser` int(10) NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tblparticipants`
--

CREATE TABLE IF NOT EXISTS `tblparticipants` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idevent` int(10) NOT NULL,
  `iduser` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;