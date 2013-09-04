SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `slug` varchar(40) NOT NULL,
  `menuItem` bit(1) NOT NULL,
  `category_id` int(255) unsigned DEFAULT '1',
  `order` tinyint(2) unsigned DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `contenttypes`;
CREATE TABLE `contenttypes` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

TRUNCATE `contenttypes`;
INSERT INTO `contenttypes` (`id`, `type`, `updated_at`, `created_at`) VALUES
(1,	'image',	'2013-06-10 17:29:38',	'2013-06-10 17:29:38'),
(2,	'text',	'2013-06-10 17:29:38',	'2013-06-10 17:29:38'),
(3,	'youtube',	'2013-06-10 17:29:38',	'2013-06-10 17:29:38'),
(4,	'vimeo',	'2013-06-10 17:29:38',	'2013-06-10 17:29:38');

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE `galleries` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `show_info` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `info` text NOT NULL,
  `category_id` int(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `content` text,
  `contentType_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `category_id` int(255) unsigned NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

TRUNCATE `pages`;
INSERT INTO `pages` (`id`, `name`, `content`, `contentType_id`, `category_id`, `updated_at`, `created_at`) VALUES
(1,	'About',	'<h1>Lorem ipsum</h1>\r\n<p>Lorem ipsum dolor sit amet, venis potest flens praemio eirmod tuis Athenagorae principio intus ad nomine Stranguillio sit aliquip ipsa mihi. Stranguillione in fuerat eum in fuerat eum ego Pentapolim Cyrenaeorum tertia navigavit volente in. Aliorum eam in rei civibus laude clamaverunt donavit ipsum. Concita tempestatis cui sed esse ait, statimque assueta cum obiectum ait. Tyro sed haec vidit loco sed quod tamen ait est in. Lucina eodem in deinde plectrum anni ipsa quod una. Centum domine autem Apolloni codicellos iam adultera in modo, oculos ut diem derelinquere patris Tyrius tu mihi servitute coniunx.</p>\r\n<p>Sibi adsedit in lucem exitum vivit in rei exultant deo. Nulla enim materiam ad suis caelo dicit semper. Animae tuae infami nos filiae tibi confluentiam Scelerata nunc meae ceroma fronte comico hac auxilium super cubiculum in fuerat. Athenagoram rigorem nisl cum magna aliter refundens domum! Tace mordeo tertia veni est se est se est se ad quia. Adhibitis sedens loculum deprecationem vel regio hinc Dionysiade in rei exultant deo adoptavit cum suam in modo cavendum es.</p>\r\n<p>Ecce codicellis desinit sestertia domine cives ego esse ait. Pentapolitanas Cyrenensi reversus generum de ascendit rationis ad per sanctus ait mea Stet. Denique laetare quod ait mea Christianis aedificatur ergo est amet consensit cellula filia dedit ad per. Visceribusque esocem manibus missus fugam vel per te sed esse more filiam in lucem exitum vivit in lucem concitaverunt in. Dona abstulit meis commendet\' permansit in modo cavendum es illum vero diam omni diligentiam qui dicens unam si Ave. Eos Communicatio mihi quiditas patria convivium laetatus ait in fuerat eum. Dicis me naufragus habuisti sit aliquip ipsa codicellos, habet comam apodixin mei in modo genito in. Scinditque omnem scies Apollonius mihi esse more fuerit mitti. His carpens introivit gubernum defunctam vivum. Quantas quaerentes filiam sunt vero diam omni magnis dotem ad suis alteri formam unitas reddere Dionysiadem. Crede respiciens coniugem eo Apollonius non ait mea.</p>\r\n<h2>Mutilenae ratio</h2>\r\n<p>Mutilenae ratio iuvenis est se sed eu fides se ad suis Tyrium coniugem flebant Tharsiam si puella sed dominum sit in. Amen ad te in modo compungi mulierem volutpat cum. \'Ipsius dum veniens indica enim materiam ducenta quae, boreas ingreditur ad per animum pares terris classes. Statimque assueta cum suam non dum, aegypti regionibus in lucem genero. Duo nobilibus in deinde plectrum anni ipsa hospes navis famuli famuli dabit beata. Epheso Tyrum ad per accipere filia in rei civibus. Sordido triclinio laudes quod eam eos. Dionysias eius in fuerat accidens inquit fidem emam. Nec est se vero quo accumsan in rei completo litus ostendam Apollonio dares ipsum ait est Apollonius. Num praebeo deum rogus aegritudinis causet.</p>\r\n<p>Veniente mihi esse haec vidit tam gremio regi in deinde vero diam \' Apollonius non coepit dies suscepit osculum! Crede respiciens beneficio duxit quod ait est cum magna aliter refundens domum. Viam at actus cotidie hoc ait est Apollonius mihi cum magna Dianam Interposito brutis aeternae reversurus eum filiam in. Sit Mariae Bone de me in deinde cupis auras sed haec vidit tam ubicumque per accipere nescio qui. Triton testandum ecce adhibitis amor clara te princeps coniungitur vestra, numquid Lucina eodem in deinde duas horrido in lucem. Celebrantur nuptias iam est se est amet coram te ad nomine Piscatore mihi.</p>',	1,	2,	'2013-06-16 19:54:30',	'2013-06-10 17:30:07'),
(2,	'Contact',	'',	1,	2,	'2013-06-30 13:40:11',	'0000-00-00 00:00:00'),
(3,	'Welcome',	'<p>Index</p>',	1,	0,	'2013-06-21 18:06:16',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `value` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editable` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

TRUNCATE `settings`;
INSERT INTO `settings` (`id`, `name`, `value`, `updated_at`, `created_at`, `editable`) VALUES
(2,	'site_name',	'gallery',	'2013-06-10 17:30:07',	'2013-06-10 17:30:07',	1),
(3,	'baseUrl',	'http://laravel.dev/',	'2013-06-10 17:30:07',	'2013-06-10 17:30:07',	0),
(4,	'email',	'email@domain.com',	'2013-06-10 17:30:07',	'2013-06-10 17:30:07',	1),
(5,	'galleryUploadDir',	'/img/upload/gallery',	'2013-06-16 23:11:20',	'0000-00-00 00:00:00',	0),
(6,	'logoUploadDir',	'/img/upload/logo',	'2013-06-16 23:11:20',	'0000-00-00 00:00:00',	0),
(7,	'logo',	'little and big bunny.jpg',	'2013-07-01 21:46:45',	'0000-00-00 00:00:00',	0),
(8,	'backgroundUploadDir',	'/img/upload/background',	'2013-06-17 13:55:03',	'0000-00-00 00:00:00',	0),
(9,	'logo-align-class',	'logo-center',	'2013-07-08 16:58:05',	'0000-00-00 00:00:00',	0),
(10,	'indexBackground',	'1015601_432257066872441_2015602684_o.jpg',	'2013-07-01 21:49:39',	'0000-00-00 00:00:00',	0),
(11,	'indexForeground',	'logo.png',	'2013-07-01 22:03:01',	'0000-00-00 00:00:00',	0),
(12,	'foregroundUploadDir',	'/img/upload/foreground',	'2013-06-30 16:07:51',	'0000-00-00 00:00:00',	0);

DROP TABLE IF EXISTS `slides`;
CREATE TABLE `slides` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `content` text,
  `contentType_id` smallint(5) unsigned NOT NULL DEFAULT '1',
  `gallery_id` int(255) unsigned NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE latin1_bin DEFAULT NULL,
  `password` varchar(255) COLLATE latin1_bin DEFAULT NULL,
  `email` varchar(40) COLLATE latin1_bin NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- 2013-07-10 19:51:43