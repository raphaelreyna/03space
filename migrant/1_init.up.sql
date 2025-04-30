CREATE TABLE IF NOT EXISTS `blogcomments` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `parent_id` int(11) default NULL,
  `author` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `kudos` int(11) default '0',
  `category` int(11) NOT NULL,
  `privacy_level` int(11) NOT NULL default '2',
  `pinned` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `bulletincomments` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `bulletins` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `favorites` (
  `user_id` int(11) NOT NULL,
  `favorites` text,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `friends` (
  `id` int(11) NOT NULL auto_increment,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL default 'PENDING',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `groupcomments` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `members` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `layoutcomments` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `text` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `layouts` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` blob NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL auto_increment,
  `toid` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `body` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(16) NOT NULL default 'unread',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content_type` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL auto_increment,
  `session_id` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `last_logon` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `last_activity` timestamp NULL default NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `rank` tinyint(4) NOT NULL default '0',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `lastactive` datetime NOT NULL default NOW(),
  `lastlogon` datetime NOT NULL default NOW(),
  `bio` varchar(500) NOT NULL default '',
  `interests` varchar(500) NOT NULL default ' ',
  `css` blob,
  `music` varchar(255) NOT NULL default 'default.mp3',
  `pfp` varchar(255) NOT NULL default 'default.jpg',
  `currentgroup` varchar(255) NOT NULL default 'None',
  `status` varchar(255) NOT NULL default '',
  `private` tinyint(1) NOT NULL default '0',
  `views` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;