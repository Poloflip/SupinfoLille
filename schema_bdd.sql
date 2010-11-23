-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Serveur: mysql5-13.pro
-- Généré le : Mar 23 Novembre 2010 à 20:06
-- Version du serveur: 5.0.90
-- Version de PHP: 5.2.6-1+lenny8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `makemywebsup`
--

-- --------------------------------------------------------

--
-- Structure de la table `TB_DOCUMENTS`
--

CREATE TABLE IF NOT EXISTS `TB_DOCUMENTS` (
  `document_id` int(10) NOT NULL auto_increment,
  `document_nom` varchar(45) character set utf8 collate utf8_bin NOT NULL,
  `document_chemin` text NOT NULL,
  `document_extension` varchar(10) NOT NULL,
  `document_date` date NOT NULL,
  `document_telechargements` int(10) NOT NULL default '0',
  `document_status` int(5) NOT NULL default '0',
  `student_id` int(10) NOT NULL,
  `matiere_id` int(10) NOT NULL,
  PRIMARY KEY  (`document_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_ENTRAIDES`
--

CREATE TABLE IF NOT EXISTS `TB_ENTRAIDES` (
  `entraide_id` int(11) NOT NULL auto_increment,
  `entraide_question` text character set utf8 collate utf8_bin NOT NULL,
  `entraide_auteur` varchar(40) character set utf8 collate utf8_bin NOT NULL,
  `entraide_date` date NOT NULL,
  `entraide_details` text character set utf8 collate utf8_bin NOT NULL,
  `entraide_resolu` int(11) NOT NULL default '0',
  PRIMARY KEY  (`entraide_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_ENTRAIDES_REPONSES`
--

CREATE TABLE IF NOT EXISTS `TB_ENTRAIDES_REPONSES` (
  `entraide_reponse_id` int(11) NOT NULL auto_increment,
  `entraide_id` int(11) NOT NULL,
  `entraide_reponse` text character set utf8 collate utf8_bin NOT NULL,
  `entraide_reponse_auteur` varchar(40) character set utf8 collate utf8_bin NOT NULL,
  `entraide_reponse_date` date NOT NULL,
  PRIMARY KEY  (`entraide_reponse_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_EVENEMENTS`
--

CREATE TABLE IF NOT EXISTS `TB_EVENEMENTS` (
  `evenement_id` int(11) NOT NULL auto_increment,
  `evenement_titre` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `evenement_ss_titre` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `evenement_date` date NOT NULL,
  `evenement_participants` int(10) NOT NULL default '0',
  `evenement_description` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`evenement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_EVENEMENTS_PARTICIPATIONS`
--

CREATE TABLE IF NOT EXISTS `TB_EVENEMENTS_PARTICIPATIONS` (
  `evenement_id` int(11) NOT NULL,
  `student_idbooster` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `TB_MATIERES`
--

CREATE TABLE IF NOT EXISTS `TB_MATIERES` (
  `matiere_id` int(10) NOT NULL auto_increment,
  `matiere_nom` text NOT NULL,
  `matiere_nom_complet` text NOT NULL,
  `matiere_cursus` varchar(5) NOT NULL,
  PRIMARY KEY  (`matiere_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_NEWS`
--

CREATE TABLE IF NOT EXISTS `TB_NEWS` (
  `news_id` int(10) NOT NULL auto_increment,
  `news_titre` varchar(200) character set utf8 collate utf8_unicode_ci NOT NULL,
  `news_contenu` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `news_auteur` int(10) NOT NULL,
  `news_date` date NOT NULL,
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Table contenant les news SupinfoLille2013' AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_SONDAGES`
--

CREATE TABLE IF NOT EXISTS `TB_SONDAGES` (
  `sondage_id` int(10) NOT NULL auto_increment,
  `sondage_question` text NOT NULL,
  `sondage_date_debut` date NOT NULL,
  `sondage_date_fin` date NOT NULL,
  `sondage_type` varchar(30) NOT NULL,
  `sondage_actif` int(2) NOT NULL,
  PRIMARY KEY  (`sondage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_SONDAGES_CHOIX`
--

CREATE TABLE IF NOT EXISTS `TB_SONDAGES_CHOIX` (
  `sondage_choix_id` int(10) NOT NULL auto_increment,
  `sondage_choix` text NOT NULL,
  `sondage_choix_votes` int(10) NOT NULL default '0',
  `sondage_id` int(10) NOT NULL,
  PRIMARY KEY  (`sondage_choix_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- Structure de la table `TB_STUDENTS`
--

CREATE TABLE IF NOT EXISTS `TB_STUDENTS` (
  `student_idbooster` int(10) NOT NULL,
  `student_promo` varchar(5) NOT NULL,
  `student_pass` varchar(100) NOT NULL,
  `student_prenom` varchar(35) character set utf8 collate utf8_bin NOT NULL,
  `student_nom` varchar(35) character set utf8 collate utf8_unicode_ci NOT NULL,
  `student_portable` int(10) default NULL,
  `student_msn` varchar(100) default NULL,
  `student_skype` varchar(100) default NULL,
  `student_twitter` varchar(100) default NULL,
  `student_facebook` varchar(100) default NULL,
  `student_autorisation` int(1) NOT NULL default '0',
  `student_visites` int(10) NOT NULL default '0',
  `student_derniere_visite` date NOT NULL,
  `student_sondage_reponses` text,
  PRIMARY KEY  (`student_idbooster`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
