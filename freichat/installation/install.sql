DROP TABLE IF EXISTS `frei_chat`;
DROP TABLE IF EXISTS `frei_session`;
DROP TABLE IF EXISTS `frei_config`;
DROP TABLE IF EXISTS `frei_video_session`;


CREATE TABLE IF NOT EXISTS `frei_chat` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `from` int(11) NOT NULL,
    `from_name` varchar(30) NOT NULL,
    `to` int(11) NOT NULL,
    `to_name` varchar(30) NOT NULL,
    `message` text NOT NULL,
    `sent` datetime NOT NULL DEFAULT current_timestamp,
    `recd` int(10) unsigned NOT NULL DEFAULT '0',
    `time` double(15,4) NOT NULL,
    `GMT_time` bigint(20) NOT NULL,
    `message_type` int(11) NOT NULL DEFAULT '0',
    `room_id` bigint(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `frei_session` (
    `id` int(100) NOT NULL AUTO_INCREMENT,
    `username` varchar(255) DEFAULT NULL,
    `time` int(100) NOT NULL,
    `session_id` varchar(100) NOT NULL,
    `permanent_id` int(100) NOT NULL,
    `status` tinyint(4) NOT NULL,
    `status_mesg` varchar(100) NOT NULL,
    `guest` tinyint(3) NOT NULL,
    `in_room` int(4) NOT NULL DEFAULT '-1',
    PRIMARY KEY (`id`),
    UNIQUE KEY `permanent_id` (`permanent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `frei_rooms` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `room_name` text NOT NULL,
    `room_order` int(4) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;


CREATE TABLE IF NOT EXISTS `frei_banned_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `user_id` int(11) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;


CREATE TABLE IF NOT EXISTS `frei_video_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) DEFAULT NULL COMMENT 'unique room id',
  `from_id` int(11) NOT NULL,
  `msg_type` varchar(10) NOT NULL,
  `msg_label` int(2) NOT NULL,
  `msg_data` varchar(3000) NOT NULL,
  `msg_time` decimal(15,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

CREATE TABLE IF NOT EXISTS `frei_smileys` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `symbol` varchar(10) NOT NULL,
    `image_name` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;


CREATE TABLE IF NOT EXISTS `frei_config` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `key` varchar(30) DEFAULT 'NULL',
    `cat` varchar(20) DEFAULT 'NULL',
    `subcat` varchar(20) DEFAULT 'NULL',
    `val` varchar(500) DEFAULT 'NULL',
    PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;



INSERT IGNORE INTO `frei_rooms` (`id`, `room_name`, `room_order`) VALUES
        (1, 'Innovative Talk', 3),
        (2, 'Fun Talk', 1),
        (3, 'Boring Talk', 0),
        (4, 'General Talk', 2),
        (5, 'Supreme talk', -4);


INSERT IGNORE INTO `frei_smileys` (`id`, `symbol`, `image_name`) VALUES
        (1, ':)', 'smile.png'),
        (2, ':(', 'sad43501.png'),
        (3, ':B', 'cool43528.png'),
        (4, ':'')', 'cry43550.jpeg'),
        (5, ':laugh:', 'laughing43578.png'),
        (6, ':cheer:', 'cheerful43597.png'),
        (7, ';)', 'wink43617.png'),
        (8, ':P', 'tongue43638.png'),
        (9, ':angry:', 'angry43660.png'),
        (10, ':unsure:', 'unsure43683.png'),
        (11, ':ohmy:', 'shocked43703.png'),
        (12, ':huh:', 'wassat43723.png'),
        (13, ':o', 'shocked43751.png'),
        (14, ':0', 'shocked43765.png'),
        (15, ':dry:', 'ermm43788.png'),
        (16, ':lol:', 'grin43809.png'),
        (17, ':D', 'grin43826.png'),
        (18, ':silly:', 'silly43845.png'),
        (19, ':woohoo:', 'w00t43867.png');





INSERT IGNORE INTO `frei_config` (`id`, `key`, `cat`, `subcat`, `val`) VALUES
        (1, 'PATH', 'NULL', 'NULL', 'freichat/'),
        (2, 'show_name', 'NULL', 'NULL', 'guest'),
        (3, 'displayname', 'NULL', 'NULL', 'username'),
        (4, 'chatspeed', 'NULL', 'NULL', '5000'),
        (5, 'fxval', 'NULL', 'NULL', 'true'),
        (6, 'draggable', 'NULL', 'NULL', 'enable'),
        (7, 'conflict', 'NULL', 'NULL', ''),
        (8, 'msgSendSpeed', 'NULL', 'NULL', '1000'),
        (9, 'show_avatar', 'NULL', 'NULL', 'block'),
        (10, 'debug', 'NULL', 'NULL', 'false'),
        (11, 'freichat_theme', 'NULL', 'NULL', 'basic'),
        (12, 'lang', 'NULL', 'NULL', 'english'),
        (13, 'load', 'NULL', 'NULL', 'show'),
        (14, 'time', 'NULL', 'NULL', '7'),
        (15, 'JSdebug', 'NULL', 'NULL', 'false'),
        (16, 'busy_timeOut', 'NULL', 'NULL', '500'),
        (17, 'offline_timeOut', 'NULL', 'NULL', '1000'),
        (18, 'cache', 'NULL', 'NULL', 'enabled'),
        (19, 'GZIP_handler', 'NULL', 'NULL', 'ON'),
        (20, 'plugins', 'file_sender', 'show', 'true'),
        (21, 'plugins', 'file_sender', 'file_size', '2000'),
        (22, 'plugins', 'file_sender', 'expiry', '300'),
        (23, 'plugins', 'file_sender', 'valid_exts', 'jpeg,jpg,png,gif,zip'),
        (24, 'plugins', 'send_conv', 'show', 'true'),
        (25, 'plugins', 'send_conv', 'mailtype', 'smtp'),
        (26, 'plugins', 'send_conv', 'smtp_server', 'smtp.gmail.com'),
        (27, 'plugins', 'send_conv', 'smtp_port', '465'),
        (28, 'plugins', 'send_conv', 'smtp_protocol', 'ssl'),
        (29, 'plugins', 'send_conv', 'from_address', 'you@domain.com'),
        (30, 'plugins', 'send_conv', 'from_name', 'FreiChat'),
        (31, 'playsound', 'NULL', 'NULL', 'true'),
        (32, 'ACL', 'filesend', 'user', 'allow'),
        (33, 'ACL', 'filesend', 'guest', 'noallow'),
        (34, 'ACL', 'chatroom', 'user', 'allow'),
        (35, 'ACL', 'chatroom', 'guest', 'allow'),
        (36, 'ACL', 'mail', 'user', 'allow'),
        (37, 'ACL', 'mail', 'guest', 'allow'),
        (38, 'ACL', 'save', 'user', 'allow'),
        (39, 'ACL', 'save', 'guest', 'allow'),
        (40, 'ACL', 'smiley', 'user', 'allow'),
        (41, 'ACL', 'smiley', 'guest', 'allow'),
        (42, 'polling', 'NULL', 'NULL', 'disabled'),
        (43, 'polling_time', 'NULL', 'NULL', '30'),
        (44, 'link_profile', 'NULL', 'NULL', 'disabled'),
        (46, 'sef_link_profile', 'NULL', 'NULL', 'disabled'),
        (47, 'plugins', 'chatroom', 'location', 'left'),
        (48, 'plugins', 'chatroom', 'autoclose', 'true'),
        (49, 'content_height', 'NULL', 'NULL', '200px'),
        (50, 'chatbox_status', 'NULL', 'NULL', 'false'),
        (51, 'BOOT', 'NULL', 'NULL', 'yes'),
        (52, 'exit_for_guests', 'NULL', 'NULL', 'no'),
        (53, 'plugins', 'chatroom', 'offset', '50px'),
        (54, 'plugins', 'chatroom', 'label_offset', '0.8%'),
        (55, 'addedoptions_visibility', 'NULL', 'NULL', 'HIDDEN'),
        (56, 'ug_ids', 'NULL', 'NULL', ''),
        (57, 'ACL', 'chat', 'user', 'allow'),
        (58, 'ACL', 'chat', 'guest', 'allow'),
        (59, 'plugins', 'chatroom', 'override_positions', 'yes'),
        (60, 'ACL', 'video', 'user', 'allow'),
        (61, 'ACL', 'video', 'guest', 'allow');        
