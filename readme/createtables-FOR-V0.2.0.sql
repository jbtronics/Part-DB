-- 
-- Table structure for table `categories`
-- 

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` mediumtext NOT NULL,
  `parentnode` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parentnode` (`parentnode`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `datasheets`
-- 

CREATE TABLE `datasheets` (
  `id` int(11) NOT NULL auto_increment,
  `part_id` int(11) NOT NULL default '0',
  `datasheeturl` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `part_id` (`part_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `footprints`
-- 

CREATE TABLE `footprints` (
  `id` int(11) NOT NULL auto_increment,
  `name` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `parts`
-- 

CREATE TABLE `parts` (
  `id` int(11) NOT NULL auto_increment,
  `id_category` int(11) NOT NULL default '0',
  `name` mediumtext NOT NULL,
  `instock` int(11) NOT NULL default '0',
  `mininstock` int(11) NOT NULL default '0',
  `comment` mediumtext NOT NULL,
  `id_footprint` int(11) NOT NULL default '0',
  `id_storeloc` int(11) NOT NULL default '0',
  `id_supplier` int(11) NOT NULL default '0',
  `supplierpartnr` mediumtext NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `id_storeloc` (`id_storeloc`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `pending_orders`
-- 

CREATE TABLE `pending_orders` (
  `id` int(11) NOT NULL auto_increment,
  `part_id` int(11) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  `t` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `part_id` (`part_id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `pictures`
-- 

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL auto_increment,
  `part_id` int(11) NOT NULL default '0',
  `pict_fname` varchar(255) NOT NULL default '',
  `pict_width` int(11) NOT NULL default '0',
  `pict_height` int(11) NOT NULL default '0',
  `pict_type` enum('P','T') NOT NULL default 'P',
  `tn_obsolete` smallint(6) NOT NULL default '0',
  `tn_t` datetime NOT NULL default '0000-00-00 00:00:00',
  `tn_pictid` int(11) NOT NULL default '0',
  `pict_masterpict` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pict_type` (`pict_type`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `preise`
-- 

CREATE TABLE `preise` (
  `id` int(11) NOT NULL auto_increment,
  `part_id` int(11) NOT NULL default '0',
  `ma` smallint(6) NOT NULL default '0',
  `preis` decimal(6,3) NOT NULL default '0.000',
  `t` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `part_id` (`part_id`),
  KEY `ma` (`ma`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `storeloc`
-- 

CREATE TABLE `storeloc` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `suppliers`
-- 

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL auto_increment,
  `name` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `devices`
-- 

CREATE TABLE `devices` (
  `id` int(11) NOT NULL auto_increment,
  `name` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur f�r Tabelle `part_device`
-- 

CREATE TABLE `part_device` (
  `id_part` int(11) NOT NULL default '0',
  `id_device` int(11) NOT NULL default '0',
  `quantity` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id_part`)
) ENGINE=MyISAM;
