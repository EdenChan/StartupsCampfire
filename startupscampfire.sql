/*
Navicat MySQL Data Transfer

Source Server         : aliyun
Source Server Version : 50546
Source Host           : 115.28.40.237:3306
Source Database       : startupscampfire

Target Server Type    : MYSQL
Target Server Version : 50546
File Encoding         : 65001

Date: 2016-03-02 11:04:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for scamp_admins
-- ----------------------------
DROP TABLE IF EXISTS `scamp_admins`;
CREATE TABLE `scamp_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_name_unique` (`name`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_admins
-- ----------------------------
INSERT INTO `scamp_admins` VALUES ('1', 'admin', 'admin@admin.com', '$2y$10$811PYxeUgkeCbDpHOqbox.ca.zhAeKYm8r0kGNS0hAmtq78QFs8sq', null, 'OhE9EWAwQ1bbKCLraTCrI8ddcZqKqcEy0grnBuf62tCSUdJrnJ65DeUH1nfB', '2016-01-12 08:32:22', '2016-02-18 20:13:04', null);

-- ----------------------------
-- Table structure for scamp_carousels
-- ----------------------------
DROP TABLE IF EXISTS `scamp_carousels`;
CREATE TABLE `scamp_carousels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_carousels
-- ----------------------------
INSERT INTO `scamp_carousels` VALUES ('3', '1', 'http://weibo.com', 'image1454580011.jpg', 'index', null, '2016-02-04 10:00:11', '2016-02-04 10:00:11');

-- ----------------------------
-- Table structure for scamp_categories
-- ----------------------------
DROP TABLE IF EXISTS `scamp_categories`;
CREATE TABLE `scamp_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url_tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seo_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `_lft` int(10) unsigned NOT NULL,
  `_rgt` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_url_tag_unique` (`url_tag`),
  KEY `categories__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`),
  KEY `categories_id_index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_categories
-- ----------------------------
INSERT INTO `scamp_categories` VALUES ('1', 'level1', 'level1', 'level1', null, '2016-01-07 06:32:48', '2016-01-12 08:17:36', '1', '2', null);
INSERT INTO `scamp_categories` VALUES ('2', 'level2', 'level2', 'level2', null, '2016-01-07 06:33:04', '2016-01-12 08:17:36', '3', '6', null);
INSERT INTO `scamp_categories` VALUES ('3', 'level1_1', 'level1_1', 'level1_1', null, '2016-01-07 06:33:20', '2016-01-07 06:33:20', '2', '3', '1');
INSERT INTO `scamp_categories` VALUES ('4', 'level1_2', 'level1_2', 'level1_2的描述', null, '2016-01-07 06:33:33', '2016-01-13 10:13:15', '6', '9', '1');
INSERT INTO `scamp_categories` VALUES ('5', 'level2_1', 'level2_1', '这是level2_1', null, '2016-01-07 06:33:47', '2016-01-22 06:30:30', '12', '13', '2');
INSERT INTO `scamp_categories` VALUES ('6', 'level2_2', 'level2_2', 'level2_2', null, '2016-01-07 06:34:01', '2016-01-07 06:34:01', '14', '15', '2');
INSERT INTO `scamp_categories` VALUES ('7', 'level2_3', 'level2_3', 'level2_3', null, '2016-01-07 06:34:23', '2016-01-13 08:38:54', '16', '17', '2');
INSERT INTO `scamp_categories` VALUES ('9', 'level3', '8', '这是level3', null, '2016-01-15 02:50:29', '2016-01-15 02:50:29', '18', '21', null);
INSERT INTO `scamp_categories` VALUES ('10', 'level3_1', '10', '这是level3_1', null, '2016-01-15 02:56:50', '2016-01-15 02:56:50', '19', '20', '9');

-- ----------------------------
-- Table structure for scamp_comments
-- ----------------------------
DROP TABLE IF EXISTS `scamp_comments`;
CREATE TABLE `scamp_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `commentable_id` int(11) NOT NULL,
  `commentable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `body_parsed` text COLLATE utf8_unicode_ci NOT NULL,
  `is_block` tinyint(1) NOT NULL DEFAULT '0',
  `vote_count` int(11) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `comments_user_id_index` (`user_id`),
  KEY `comments_commentable_id_index` (`commentable_id`),
  KEY `comments_commentable_type_index` (`commentable_type`),
  KEY `comments_is_block_index` (`is_block`),
  KEY `comments_vote_count_index` (`vote_count`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_comments
-- ----------------------------
INSERT INTO `scamp_comments` VALUES ('41', '1', '28', 'StartupsCampfire\\Models\\Post', '测试评论', '测试评论', '0', '1', null, '2016-03-02 10:20:26', '2016-03-02 10:53:38');
INSERT INTO `scamp_comments` VALUES ('42', '5', '30', 'StartupsCampfire\\Models\\Post', '测试@功能\r\n@eden ', '测试@功能\r\n<a href=\"http://115.28.40.237/users/1\">@eden</a> ', '0', '0', null, '2016-03-02 10:29:31', '2016-03-02 10:29:31');
INSERT INTO `scamp_comments` VALUES ('43', '5', '28', 'StartupsCampfire\\Models\\Post', '@eden \r\n测试回复', '<a href=\"http://115.28.40.237/users/1\">@eden</a> \r\n测试回复', '0', '1', null, '2016-03-02 10:29:58', '2016-03-02 10:53:41');
INSERT INTO `scamp_comments` VALUES ('44', '4', '10', 'StartupsCampfire\\Models\\Event', '评论活动\r\n@eden', '评论活动\r\n<a href=\"http://115.28.40.237/users/1\">@eden</a>', '0', '0', null, '2016-03-02 10:51:01', '2016-03-02 10:51:01');
INSERT INTO `scamp_comments` VALUES ('45', '1', '28', 'StartupsCampfire\\Models\\Post', '@batman \r\n回复batman', '<a href=\"http://115.28.40.237/users/5\">@batman</a> \r\n回复batman', '0', '0', null, '2016-03-02 10:53:32', '2016-03-02 10:53:32');
INSERT INTO `scamp_comments` VALUES ('46', '1', '36', 'StartupsCampfire\\Models\\Post', '测试评论', '测试评论', '0', '0', null, '2016-03-02 10:57:47', '2016-03-02 10:57:47');
INSERT INTO `scamp_comments` VALUES ('47', '5', '28', 'StartupsCampfire\\Models\\Post', '测试评论@jim', '测试评论<a href=\"http://115.28.40.237/users/4\">@jim</a>', '0', '0', null, '2016-03-02 10:59:17', '2016-03-02 10:59:17');

-- ----------------------------
-- Table structure for scamp_events
-- ----------------------------
DROP TABLE IF EXISTS `scamp_events`;
CREATE TABLE `scamp_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brief` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `body_parsed` text COLLATE utf8_unicode_ci NOT NULL,
  `is_passed` tinyint(4) NOT NULL DEFAULT '0',
  `vote_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `events_user_id_index` (`user_id`),
  KEY `events_vote_count_index` (`vote_count`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_events
-- ----------------------------
INSERT INTO `scamp_events` VALUES ('7', '1', '2016-02-28 10:50:00', '2016-03-29 13:35:00', '这是eden发起的活动1', '活动简介活动简介', 'cover1456887758.jpg', '广东广州黄埔区', '<p><img src=\"/upload/ueditor/image/20160302/1456885041770127.jpeg\" title=\"1456885041770127.jpeg\" alt=\"wallhaven-193236.jpg\" width=\"1\" height=\"1\" style=\"width: 1px; height: 1px;\"/><img src=\"/upload/ueditor/image/20160302/1456885071182183.jpeg\" title=\"1456885071182183.jpeg\" alt=\"wallhaven-193236.jpg\" width=\"381\" height=\"220\" style=\"width: 381px; height: 220px;\"/><br/><br/>这是eden发起的活动1<br/></p>', '<p><img src=\"/upload/ueditor/image/20160302/1456885041770127.jpeg\" title=\"1456885041770127.jpeg\" alt=\"wallhaven-193236.jpg\" width=\"1\" height=\"1\" style=\"width: 1px; height: 1px;\"/><img src=\"/upload/ueditor/image/20160302/1456885071182183.jpeg\" title=\"1456885071182183.jpeg\" alt=\"wallhaven-193236.jpg\" width=\"381\" height=\"220\" style=\"width: 381px; height: 220px;\"/><br/><br/>这是eden发起的活动1<br/></p>', '1', '2', '0', null, '2016-03-02 10:18:27', '2016-03-02 10:50:33');
INSERT INTO `scamp_events` VALUES ('8', '1', '2016-02-23 10:50:00', '2016-03-30 10:50:00', '这是eden发起的活动2', '活动简介活动简介', 'cover1456887758.jpg', '广东深圳南山区', '<p><img src=\"/upload/ueditor/image/20160302/1456885338918330.jpeg\" title=\"1456885338918330.jpeg\" alt=\"gravity.png\" width=\"296\" height=\"157\" style=\"width: 296px; height: 157px;\"/><br/>这是活动2<br/></p>', '<p><img src=\"/upload/ueditor/image/20160302/1456885338918330.jpeg\" title=\"1456885338918330.jpeg\" alt=\"gravity.png\" width=\"296\" height=\"157\" style=\"width: 296px; height: 157px;\"/><br/>这是活动2<br/></p>', '1', '1', '0', null, '2016-03-02 10:22:59', '2016-03-02 10:50:22');
INSERT INTO `scamp_events` VALUES ('9', '0', '2016-02-29 04:20:00', '2016-03-31 22:25:00', '平台活动1', '平台活动1', 'cover1456887758.jpg', '广东广州黄埔区', '<p>这是平台发布的活动<br/></p>', '<p>这是平台发布的活动<br/></p>', '1', '2', '0', null, '2016-03-02 10:24:14', '2016-03-02 10:50:23');
INSERT INTO `scamp_events` VALUES ('10', '0', '2016-02-28 13:25:00', '2016-03-31 18:20:00', '平台活动2', '活动简介活动简介', 'cover1456887758.jpg', '广东广州黄埔区', '<p>这是平台发布的活动2</p><p><br/></p>', '<p>这是平台发布的活动2</p>', '1', '1', '1', null, '2016-03-02 10:25:54', '2016-03-02 11:02:38');
INSERT INTO `scamp_events` VALUES ('11', '5', '2016-02-29 12:45:00', '2016-03-31 14:55:00', 'batman活动1', '活动简介活动简介', 'cover1456887758.jpg', '广东深圳宝安区', '<p>这是活动内容</p>', '<p>这是活动内容</p>', '1', '0', '0', null, '2016-03-02 11:00:33', '2016-03-02 11:00:55');
INSERT INTO `scamp_events` VALUES ('12', '5', '2016-02-29 20:55:00', '2016-03-29 13:55:00', 'batman活动2', '活动简介活动简介', 'cover1456887758.jpg', '广东深圳罗湖区', '<p>这是活动内容2</p>', '<p>这是活动内容2</p>', '1', '0', '0', null, '2016-03-02 11:02:00', '2016-03-02 11:02:06');

-- ----------------------------
-- Table structure for scamp_favorites
-- ----------------------------
DROP TABLE IF EXISTS `scamp_favorites`;
CREATE TABLE `scamp_favorites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `favorites_post_id_index` (`post_id`),
  KEY `favorites_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_favorites
-- ----------------------------
INSERT INTO `scamp_favorites` VALUES ('25', '28', '4', null, '2016-03-02 10:12:04', '2016-03-02 10:12:04');
INSERT INTO `scamp_favorites` VALUES ('26', '28', '1', null, '2016-03-02 10:20:47', '2016-03-02 10:20:47');
INSERT INTO `scamp_favorites` VALUES ('27', '31', '1', null, '2016-03-02 10:27:41', '2016-03-02 10:27:41');
INSERT INTO `scamp_favorites` VALUES ('28', '31', '5', null, '2016-03-02 10:39:16', '2016-03-02 10:39:16');
INSERT INTO `scamp_favorites` VALUES ('29', '31', '4', null, '2016-03-02 10:51:45', '2016-03-02 10:51:45');

-- ----------------------------
-- Table structure for scamp_followers
-- ----------------------------
DROP TABLE IF EXISTS `scamp_followers`;
CREATE TABLE `scamp_followers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `follow_id` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_followers
-- ----------------------------
INSERT INTO `scamp_followers` VALUES ('27', '1', '4', null, '2016-03-02 10:15:18', '2016-03-02 10:15:18');
INSERT INTO `scamp_followers` VALUES ('28', '5', '1', null, '2016-03-02 10:28:55', '2016-03-02 10:28:55');
INSERT INTO `scamp_followers` VALUES ('29', '1', '5', null, '2016-03-02 10:47:23', '2016-03-02 10:47:23');
INSERT INTO `scamp_followers` VALUES ('30', '4', '1', null, '2016-03-02 10:50:15', '2016-03-02 10:50:15');

-- ----------------------------
-- Table structure for scamp_migrations
-- ----------------------------
DROP TABLE IF EXISTS `scamp_migrations`;
CREATE TABLE `scamp_migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_migrations
-- ----------------------------
INSERT INTO `scamp_migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2015_12_31_023225_create_admins_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2015_12_31_050341_create_posts_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2015_12_31_050409_create_profiles_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2016_01_02_050341_create_categories_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2016_01_10_040644_create_followers_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2016_01_11_070341_create_votes_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2016_01_11_080341_create_favorites_table', '1');
INSERT INTO `scamp_migrations` VALUES ('2016_01_12_091223_create_events_table', '2');
INSERT INTO `scamp_migrations` VALUES ('2016_01_07_050341_create_comments_table', '3');
INSERT INTO `scamp_migrations` VALUES ('2016_01_11_060341_create_notifications_table', '4');
INSERT INTO `scamp_migrations` VALUES ('2016_01_18_065273_create_notices_table', '5');
INSERT INTO `scamp_migrations` VALUES ('2016_01_28_050341_create_navigations_table', '6');
INSERT INTO `scamp_migrations` VALUES ('2016_01_31_061521_create_carousels_table', '7');

-- ----------------------------
-- Table structure for scamp_navigations
-- ----------------------------
DROP TABLE IF EXISTS `scamp_navigations`;
CREATE TABLE `scamp_navigations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `_lft` int(10) unsigned NOT NULL,
  `_rgt` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `navigations__lft__rgt_parent_id_index` (`_lft`,`_rgt`,`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_navigations
-- ----------------------------
INSERT INTO `scamp_navigations` VALUES ('1', '1', '社区热帖', 'http://115.28.40.237/posts', null, '2016-01-28 09:18:39', '2016-02-01 09:16:32', '1', '4', null);
INSERT INTO `scamp_navigations` VALUES ('2', '1', '测试二级导航', 'http://115.28.40.237/user', null, '2016-01-28 09:27:47', '2016-02-01 09:19:31', '2', '3', '1');
INSERT INTO `scamp_navigations` VALUES ('3', '2', '热门活动', 'http://115.28.40.237/events', null, '2016-02-01 08:21:06', '2016-02-01 09:16:18', '5', '6', null);

-- ----------------------------
-- Table structure for scamp_notices
-- ----------------------------
DROP TABLE IF EXISTS `scamp_notices`;
CREATE TABLE `scamp_notices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_notices
-- ----------------------------
INSERT INTO `scamp_notices` VALUES ('1', '测试站点公告', '<p>这是测试用的站点公告</p>', null, '2016-01-25 01:59:20', '2016-01-25 01:59:20');
INSERT INTO `scamp_notices` VALUES ('2', '测试图片公告', '<p><img src=\"/upload/ueditor/image/20160302/1456886904841328.jpeg\" title=\"1456886904841328.jpeg\" alt=\"bg1.jpg\" width=\"410\" height=\"264\" style=\"width: 410px; height: 264px;\"/></p><p><br/></p>', null, '2016-01-28 07:13:57', '2016-03-02 10:48:46');

-- ----------------------------
-- Table structure for scamp_notifications
-- ----------------------------
DROP TABLE IF EXISTS `scamp_notifications`;
CREATE TABLE `scamp_notifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `notifiable_id` int(11) NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_readed` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `notifications_user_id_index` (`user_id`),
  KEY `notifications_from_user_id_index` (`from_user_id`),
  KEY `notifications_notifiable_id_index` (`notifiable_id`),
  KEY `notifications_notifiable_type_index` (`notifiable_type`),
  KEY `notifications_type_index` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_notifications
-- ----------------------------
INSERT INTO `scamp_notifications` VALUES ('52', '4', '1', null, '0', '', null, 'new follow', '0', null, '2016-03-02 10:15:18', '2016-03-02 10:15:18');
INSERT INTO `scamp_notifications` VALUES ('53', '4', '1', '41', '28', 'StartupsCampfire\\Models\\Post', '测试评论', 'new comment', '0', null, '2016-03-02 10:20:26', '2016-03-02 10:20:26');
INSERT INTO `scamp_notifications` VALUES ('54', '1', '5', null, '0', '', null, 'new follow', '0', null, '2016-03-02 10:28:55', '2016-03-02 10:28:55');
INSERT INTO `scamp_notifications` VALUES ('55', '4', '5', '42', '30', 'StartupsCampfire\\Models\\Post', '测试@功能\r\n<a href=\"http://115.28.40.237/users/1\">@eden</a> ', 'new comment', '0', null, '2016-03-02 10:29:31', '2016-03-02 10:29:31');
INSERT INTO `scamp_notifications` VALUES ('56', '1', '5', '42', '42', 'StartupsCampfire\\Models\\Comment', '测试@功能\r\n<a href=\"http://115.28.40.237/users/1\">@eden</a> ', 'new at', '0', null, '2016-03-02 10:29:31', '2016-03-02 10:29:31');
INSERT INTO `scamp_notifications` VALUES ('57', '4', '5', '43', '28', 'StartupsCampfire\\Models\\Post', '<a href=\"http://115.28.40.237/users/1\">@eden</a> \r\n测试回复', 'new comment', '0', null, '2016-03-02 10:29:58', '2016-03-02 10:29:58');
INSERT INTO `scamp_notifications` VALUES ('58', '1', '5', '43', '43', 'StartupsCampfire\\Models\\Comment', '<a href=\"http://115.28.40.237/users/1\">@eden</a> \r\n测试回复', 'new at', '0', null, '2016-03-02 10:29:58', '2016-03-02 10:29:58');
INSERT INTO `scamp_notifications` VALUES ('59', '5', '1', null, '0', '', null, 'new follow', '0', null, '2016-03-02 10:47:23', '2016-03-02 10:47:23');
INSERT INTO `scamp_notifications` VALUES ('60', '1', '4', null, '0', '', null, 'new follow', '0', null, '2016-03-02 10:50:15', '2016-03-02 10:50:15');
INSERT INTO `scamp_notifications` VALUES ('61', '1', '4', '44', '44', 'StartupsCampfire\\Models\\Comment', '评论活动\r\n<a href=\"http://115.28.40.237/users/1\">@eden</a>', 'new at', '0', null, '2016-03-02 10:51:01', '2016-03-02 10:51:01');
INSERT INTO `scamp_notifications` VALUES ('62', '4', '1', '45', '28', 'StartupsCampfire\\Models\\Post', '<a href=\"http://115.28.40.237/users/5\">@batman</a> \r\n回复batman', 'new comment', '0', null, '2016-03-02 10:53:32', '2016-03-02 10:53:32');
INSERT INTO `scamp_notifications` VALUES ('63', '5', '1', '45', '45', 'StartupsCampfire\\Models\\Comment', '<a href=\"http://115.28.40.237/users/5\">@batman</a> \r\n回复batman', 'new at', '0', null, '2016-03-02 10:53:32', '2016-03-02 10:53:32');
INSERT INTO `scamp_notifications` VALUES ('64', '4', '5', '47', '28', 'StartupsCampfire\\Models\\Post', '测试评论<a href=\"http://115.28.40.237/users/4\">@jim</a>', 'new comment', '0', null, '2016-03-02 10:59:17', '2016-03-02 10:59:17');
INSERT INTO `scamp_notifications` VALUES ('65', '4', '5', '47', '47', 'StartupsCampfire\\Models\\Comment', '测试评论<a href=\"http://115.28.40.237/users/4\">@jim</a>', 'new at', '0', null, '2016-03-02 10:59:17', '2016-03-02 10:59:17');

-- ----------------------------
-- Table structure for scamp_password_resets
-- ----------------------------
DROP TABLE IF EXISTS `scamp_password_resets`;
CREATE TABLE `scamp_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for scamp_posts
-- ----------------------------
DROP TABLE IF EXISTS `scamp_posts`;
CREATE TABLE `scamp_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_block` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `body_parsed` text COLLATE utf8_unicode_ci NOT NULL,
  `vote_count` int(11) NOT NULL DEFAULT '0',
  `comment_count` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `posts_user_id_index` (`user_id`),
  KEY `posts_category_id_index` (`category_id`),
  KEY `posts_is_block_index` (`is_block`),
  KEY `posts_vote_count_index` (`vote_count`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_posts
-- ----------------------------
INSERT INTO `scamp_posts` VALUES ('26', '4', '3', '0', '微软全息眼镜开卖', '微软在北京时间3月1日正式开启了全息增强现实眼镜HoloLens开发者版的预售，定价3000美元(约18000元人民币)。同时公开了三款HoloLens游戏《碎片(Fragments)》、《小松鼠(Young Conker)》以及《机器人突进(RoboRaid)》的预告片。HoloLens基于Windows 10系统打造，开发者版计划在3月30日正式发售，并且作为一款独立设备，消费者无需再购买一台额外的 PC 或是搭配一台移动设备。', '微软在北京时间3月1日正式开启了全息增强现实眼镜HoloLens开发者版的预售，定价3000美元(约18000元人民币)。同时公开了三款HoloLens游戏《碎片(Fragments)》、《小松鼠(Young Conker)》以及《机器人突进(RoboRaid)》的预告片。HoloLens基于Windows 10系统打造，开发者版计划在3月30日正式发售，并且作为一款独立设备，消费者无需再购买一台额外的 PC 或是搭配一台移动设备。', '1', '0', null, '2016-03-01 10:00:00', '2016-03-02 10:20:58');
INSERT INTO `scamp_posts` VALUES ('27', '4', '4', '0', '去哪儿组建航空公司', '腾讯科技消息，据报道，“去哪儿”网正准备与另外两家企业筹建一家航空公司，并将总部落户深圳。该消息2016年2月29日已从深圳市交委证实。去哪儿也在今天确认了这一消息。去哪儿表示正在参与以深圳为主运营基地的“互联网+、低成本”的航空公司的申请，该公司由两家深圳本地公司申请，将主营国内、周边地区国际航线。在这家新公司中，去哪儿将采用技术参股等投资形式，主要负责互联网直销部分。在回应中去哪儿提到，“去哪儿网一直以来的努力方向，就是用信息技术与大数据来推动民航业的互联网化和航空公司的线上直销。未来期待各方携手合作，共同推进整个行业的升级。”', '腾讯科技消息，据报道，“去哪儿”网正准备与另外两家企业筹建一家航空公司，并将总部落户深圳。该消息2016年2月29日已从深圳市交委证实。去哪儿也在今天确认了这一消息。去哪儿表示正在参与以深圳为主运营基地的“互联网+、低成本”的航空公司的申请，该公司由两家深圳本地公司申请，将主营国内、周边地区国际航线。在这家新公司中，去哪儿将采用技术参股等投资形式，主要负责互联网直销部分。在回应中去哪儿提到，“去哪儿网一直以来的努力方向，就是用信息技术与大数据来推动民航业的互联网化和航空公司的线上直销。未来期待各方携手合作，共同推进整个行业的升级。”', '0', '0', null, '2016-02-29 10:07:48', '2016-02-29 10:07:48');
INSERT INTO `scamp_posts` VALUES ('28', '4', '3', '0', '日媒：iPhone 7尺寸无变化', '<p>据日本科技博客Mac Otakara报道，iPhone 7被指在长宽尺寸上与现有的iPhone 6s差别不大。不过凯基证券分析师郭明池认为由于采用了新的LCD阵列，iPhone 7可能在厚度上再次薄出1毫米来。Mac Otakara认为传言中所说的iPhone 7将支持防水（采用新款复合材料）是子虚乌有，新款机器将和老款一样使用铝合金材质，但苹果将会搞定摄像头凸起这个槽点，而且会砍掉3.5毫米接口，填补空位的可能是一排新的立体声扬声器，由于取消了耳机接口，Lightning接口也会变得更薄。</p>', '<p>据日本科技博客Mac Otakara报道，iPhone 7被指在长宽尺寸上与现有的iPhone 6s差别不大。不过凯基证券分析师郭明池认为由于采用了新的LCD阵列，iPhone 7可能在厚度上再次薄出1毫米来。Mac Otakara认为传言中所说的iPhone 7将支持防水（采用新款复合材料）是子虚乌有，新款机器将和老款一样使用铝合金材质，但苹果将会搞定摄像头凸起这个槽点，而且会砍掉3.5毫米接口，填补空位的可能是一排新的立体声扬声器，由于取消了耳机接口，Lightning接口也会变得更薄。</p>', '2', '4', null, '2016-03-02 10:09:37', '2016-03-02 10:59:17');
INSERT INTO `scamp_posts` VALUES ('29', '4', '5', '0', '京东家电今年下乡开专卖店', '据北京晨报消息，在1日举行的京东家电“沸腾中国”战略发布会上，京东透露，2016年，京东家电将通过加盟的方式在全国各村镇开设“京东家电专卖店”。据悉，“京东家电专卖店”的合作者将获得京东家电在仓储、配送、安装和系统上的全力支持，除店面装潢外，合作伙伴还可获得定制的技术支持、专属特色产品以及为顾客提供的金融服务支持，使自己的门店可以媲美家电综合卖场的实力商家。京东相关人士表示，此举将强化村镇市场的家电销售能力，使京东家电市场体系发展得更加完善。这也可以看作是京东帮服务店的补强，目的是做到家电渠道的进一步下沉。', '据北京晨报消息，在1日举行的京东家电“沸腾中国”战略发布会上，京东透露，2016年，京东家电将通过加盟的方式在全国各村镇开设“京东家电专卖店”。据悉，“京东家电专卖店”的合作者将获得京东家电在仓储、配送、安装和系统上的全力支持，除店面装潢外，合作伙伴还可获得定制的技术支持、专属特色产品以及为顾客提供的金融服务支持，使自己的门店可以媲美家电综合卖场的实力商家。京东相关人士表示，此举将强化村镇市场的家电销售能力，使京东家电市场体系发展得更加完善。这也可以看作是京东帮服务店的补强，目的是做到家电渠道的进一步下沉。', '0', '0', null, '2016-03-02 10:10:36', '2016-03-02 10:10:36');
INSERT INTO `scamp_posts` VALUES ('30', '4', '10', '0', '中国互联网金融协会本月挂牌', '据北京晨报消息，业界期盼已久的中国互联网金融协会将于本月底前挂牌。与其他互联网金融协会不同的是，中国互联网金融协会由央行条法司牵头筹建，2014年4月正式获得国务院批复，旨在对互联网金融行业进行规范化的自律管理。在此之前成立的互联网金融专业委员会为中国支付清算协会（一级协会）下设的专委会。据悉，此前中国支付清算协会中首批接入的9家互联网金融公司有陆金所、宜信、网信理财、红岭创投、人人贷、拍拍贷、开鑫贷、翼龙贷、合力贷。', '据北京晨报消息，业界期盼已久的中国互联网金融协会将于本月底前挂牌。与其他互联网金融协会不同的是，中国互联网金融协会由央行条法司牵头筹建，2014年4月正式获得国务院批复，旨在对互联网金融行业进行规范化的自律管理。在此之前成立的互联网金融专业委员会为中国支付清算协会（一级协会）下设的专委会。据悉，此前中国支付清算协会中首批接入的9家互联网金融公司有陆金所、宜信、网信理财、红岭创投、人人贷、拍拍贷、开鑫贷、翼龙贷、合力贷。', '1', '1', null, '2016-03-02 10:11:54', '2016-03-02 10:29:31');
INSERT INTO `scamp_posts` VALUES ('31', '1', '6', '0', '阿里与中国旅游协会达成战略合作', '据新浪科技消息，阿里巴巴与中国旅游协会今日签署了战略合作协议。阿里巴巴及关联公司将与旅游协会的旅游资源、会员、行业影响力等进行融合，并在云计算与大数据、电子商务、移动支付、旅游创新、物流、信用建设等领域全面合作。据了解，阿里巴巴集团CEO张勇，阿里巴巴集团副总裁、阿里旅行总裁李少华，中国旅游协会第六届理事会会长段强，中国旅游协会秘书长张润钢等共同出席了此次签约。', '据新浪科技消息，阿里巴巴与中国旅游协会今日签署了战略合作协议。阿里巴巴及关联公司将与旅游协会的旅游资源、会员、行业影响力等进行融合，并在云计算与大数据、电子商务、移动支付、旅游创新、物流、信用建设等领域全面合作。据了解，阿里巴巴集团CEO张勇，阿里巴巴集团副总裁、阿里旅行总裁李少华，中国旅游协会第六届理事会会长段强，中国旅游协会秘书长张润钢等共同出席了此次签约。', '1', '0', null, '2016-03-02 10:27:34', '2016-03-02 10:27:44');
INSERT INTO `scamp_posts` VALUES ('32', '5', '7', '0', '微信提现开收手续费转账恢复免费', '据腾讯科技消息，3月1日起微信提现进入收费时代。微信此前发布公告称，微信支付对累计超出1000元额度的提现交易收取手续费，超出部分按银行费率收取手续费(目前费率为0.1%)，每笔最少收0.1元。不过，微信转账功能则不再收取手续费。同时，微信红包、面对面收付款、AA收款等功能也免收手续费。', '据腾讯科技消息，3月1日起微信提现进入收费时代。微信此前发布公告称，微信支付对累计超出1000元额度的提现交易收取手续费，超出部分按银行费率收取手续费(目前费率为0.1%)，每笔最少收0.1元。不过，微信转账功能则不再收取手续费。同时，微信红包、面对面收付款、AA收款等功能也免收手续费。', '0', '0', null, '2016-03-02 10:31:30', '2016-03-02 10:31:30');
INSERT INTO `scamp_posts` VALUES ('33', '5', '3', '0', '库克承诺将提高苹果年度股息', '2月27日消息，据路透社报道，苹果首席执行官蒂姆·库克（Tim Cook）周五宣布，该公司承诺提高每年股息。苹果此举旨在取悦投资者，但也表明这家全球最著名科技公司的股票可能不再是一支成长股。', '2月27日消息，据路透社报道，苹果首席执行官蒂姆·库克（Tim Cook）周五宣布，该公司承诺提高每年股息。苹果此举旨在取悦投资者，但也表明这家全球最著名科技公司的股票可能不再是一支成长股。', '0', '0', null, '2016-03-02 10:40:58', '2016-03-02 10:40:58');
INSERT INTO `scamp_posts` VALUES ('34', '5', '4', '0', '好艺术家抄袭，伟大艺术家剽窃', '<p><img src=\"http://7xjsga.com2.z0.glb.qiniucdn.com/uploadfile/2016/0301/20160301052044190.jpg?imageView2/2/q/90/w/760\" width=\"401\" height=\"200\" style=\"width: 401px; height: 200px;\"/><br/><br/></p><p>看到这句话可能就有人憋不住要开喷了，我奉劝大家一句看完再说。</p><p><br/></p><p>自从互联网时代来临，产品经理这个职位就成为了热门词、流行词。如果你创业了，公司没有一个或几个拿得出手的产品经理，貌似你就像压根儿没入行一样。所以，大多数初创公司，是在还没了解产品经理为何物的时候，就草草的给自己戴上了一个“新帽子”。</p><p><br/></p><p>然而，就在你刚刚了解了产品经理的工作范畴后，有没有想过可能这个职位名称已经慢慢的被束之高阁，亦或慢慢的被另一个职位名称所取代了？</p><p><br/></p><p>当瓦特发明了蒸汽机时，他可能没有意识到这玩意儿对第一次工业革命会有着多么巨大的作用。德国人Karl Friedrich Benz通过对蒸汽机的应用，发明了汽车。那个时候，这个叫Benz（奔驰）的人，其实就是一个地地道道的产品经理。他不知道为自己发明的这个四个轱辘能自动快速跑起来的玩意儿，增加任何所谓的品牌力。他只想着这个产品能满足人们的需求，并随着需求的迭代而将产品快速迭代......</p><p><br/></p><p>但是随着蒸汽机发展，汽车已经不再是什么稀奇玩意，蒸汽机的技术也不再是深不可测的“高科技”，于是渐渐的出现了更多“汽车”这种同质化的产品。那么同样是汽车，如何在市场竞争中取胜呢？于是人们开始市场调研、细分、定位、形象打造......是的，“品牌”这个名词开始出现了，并且日益盛行。而“品牌经理”这个职务，也逐渐变得比“产品经理”更加的高大上！</p><p><br/></p><p>看看，这是不是像极了当今的互联网时代？</p><p><br/></p><p>当互联网盛行，而互联网的技术得到普及，不再是什么稀缺资源的时候，人们的“效仿能力”就会变得越来越强大，那么“产品同质化”就会变成是必然的结果。这个时候，互联网公司之间的竞争又应该是怎样一个景象呢？</p><p><br/></p><p>首先，抄袭不可怕，可怕的是没有提升的抄袭</p><p><br/></p><p>现在有许多人都在指责小米抄袭苹果。但是又有多少人知道苹果也是源于“剽窃”呢？自诩完美主义商业艺术家的乔布斯不是说过：“好艺术家抄袭，伟大艺术家剽窃”的话吗？</p><p><br/></p><p>所以抄袭也好，剽窃也罢，都不是问题。问题是你不了解市场需求，不了解团队能力，不了解企业目标，只是看着别人做的好，就认为自己抄一下就能达到同样的效果。这样的盲目抄袭是浪费自己的时间，没有任何意义。或者说名你并不会真正的抄袭，也不懂真正的剽窃，所以你必定会死在互联网下一站的起点上！</p><p><br/></p><p>在我们眼镜行业里，前两年有很多大大小小的公司都在抄袭我们伊视可“验光车上门配眼镜”的商业模式，但是截至2014年底，就已经七七八八死完了。其中有行业老大哥式的品牌连锁店，也有同行的上市公司，希望通过“验光车上门配眼镜”这样的新模式来拉动自身的业绩增长。也有自诩互联网思维的眼镜外行人，想拿这个O2O模式骗VC钱。结果劳民伤财的折腾许久，最终却都以失败而告终。</p><p><br/></p><p>他们并不是被我们伊视可打败的，而是他们搬了石头把自己砸死了。对，这像极了“举鼎而亡”的秦武王。</p><p><br/></p><p>即使小米抄袭了苹果，或者魅族，亦或三星、华为什么的，但是我们不能否认它是一个成功的品牌，起码在现阶段还是！而它之所以成功，不是因为它的抄袭对象成功，而是因为它是瞄准了自己所定位的市场、族群，进行了有目的的截取与优化，并将之进行了“品牌体系化”。所谓青出于蓝，而胜于蓝！</p><p><br/></p><p>同理，我们每个人都有自己的老师，都是在学习与刻录老师身上的知识。但是并非每个老师都是成功人士，也并非每位学生都是成功人士。只有活学活用的学生，最终才能达到人生巅峰，不是？</p><p><br/></p><p>所以，产品抄袭不可怕，可怕的是没有“品牌思维”的抄袭。也因此，在互联网的下一个阶段，传统的产品经理想要不被干掉，那就应该乘早的加入“品牌思维”。如果还一味的依靠技术来实现产品的功能迭代，那最后可能也只会“举鼎而亡”了。</p><p><br/></p><p>其次，小不可怕，可怕的是不够精</p><p><br/></p><p>很多产品经理都埋怨市场需求已经被BAT满足的差不多了，在产品创新上已经不再有什么机会。产品经理已经进入了夹缝求生存阶段。</p><p><br/></p><p>这在我看来是极没有能力的一种表现和说法。</p><p><br/></p><p>进入互联网时代，因为技术而产生了许多数字化产品，比如QQ、微信、微博、手游、淘宝、美图等等。这些其实都是可以追根述源到其前世今生的。比如即时通讯类的工具，此前是书信、电报，亦或电话、短信。手游的前生是玩泥巴、打陀螺亦或电子游戏等。淘宝的前世则是百货商场，美图上辈子就是相机......是的！互联网给这些传统的事物带来了升级。</p><p><br/></p><p>那么互联网发展到现在这个阶段，难道所有的事物都已经得到了升级吗？我觉得还远远没有升级完。</p><p><br/></p><p>许多投资人在2016年初，都不约而同的把精力从O2O、P2P转移到了消费升级、服务升级、品牌升级上来。这意味着什么？此前诸如滴滴、饿了么、新美大等从大面儿上覆盖了吃喝住行的大产品、大工具的机会的确越来越少，但是针对和满足小需求的个性化、小众化的品牌产品，将如雨后春笋般诞生。</p><p><br/></p><p>很多人不明白为什么我做伊视可的时候，把那么大的精力用在设计和推广“运动防滑眼镜”这个小众的产品上。也有很多人说，市场那么大，为什么不设计个几千几万款产品来供客户挑选？</p><p><br/></p><p>我只想说：如果我能像麦当劳那样，专心把薯条做好，那么就不会愁汉堡卖不过肯德基；如果我能像全聚德那样，专心做好烤鸭，那么就不会担心翻台率超不过俏江南；如果我能像苹果那样，专心做好手机，那么就不会担心其它同系产品的市场占有率......</p><p><br/></p><p>所以，当互联网进入品牌竞争时代，无论是创业者，还是投资人，都没必要再去看是否能用产品思维，再造一个亚马逊，或者阿里巴巴。而应该专心到一个哪怕针孔般的小市场，用“品牌思维”打造成一个新麦当劳、新肯德基、新苹果......</p><p><br/>转载自创业邦&nbsp;<br/><a href=\"http://www.cyzone.cn/a/20160302/291148.html\" target=\"_self\">http://www.cyzone.cn/a/20160302/291148.html</a></p>', '<p><img src=\"http://7xjsga.com2.z0.glb.qiniucdn.com/uploadfile/2016/0301/20160301052044190.jpg?imageView2/2/q/90/w/760\" width=\"401\" height=\"200\" style=\"width: 401px; height: 200px;\"/><br/><br/></p><p>看到这句话可能就有人憋不住要开喷了，我奉劝大家一句看完再说。</p><p><br/></p><p>自从互联网时代来临，产品经理这个职位就成为了热门词、流行词。如果你创业了，公司没有一个或几个拿得出手的产品经理，貌似你就像压根儿没入行一样。所以，大多数初创公司，是在还没了解产品经理为何物的时候，就草草的给自己戴上了一个“新帽子”。</p><p><br/></p><p>然而，就在你刚刚了解了产品经理的工作范畴后，有没有想过可能这个职位名称已经慢慢的被束之高阁，亦或慢慢的被另一个职位名称所取代了？</p><p><br/></p><p>当瓦特发明了蒸汽机时，他可能没有意识到这玩意儿对第一次工业革命会有着多么巨大的作用。德国人Karl Friedrich Benz通过对蒸汽机的应用，发明了汽车。那个时候，这个叫Benz（奔驰）的人，其实就是一个地地道道的产品经理。他不知道为自己发明的这个四个轱辘能自动快速跑起来的玩意儿，增加任何所谓的品牌力。他只想着这个产品能满足人们的需求，并随着需求的迭代而将产品快速迭代......</p><p><br/></p><p>但是随着蒸汽机发展，汽车已经不再是什么稀奇玩意，蒸汽机的技术也不再是深不可测的“高科技”，于是渐渐的出现了更多“汽车”这种同质化的产品。那么同样是汽车，如何在市场竞争中取胜呢？于是人们开始市场调研、细分、定位、形象打造......是的，“品牌”这个名词开始出现了，并且日益盛行。而“品牌经理”这个职务，也逐渐变得比“产品经理”更加的高大上！</p><p><br/></p><p>看看，这是不是像极了当今的互联网时代？</p><p><br/></p><p>当互联网盛行，而互联网的技术得到普及，不再是什么稀缺资源的时候，人们的“效仿能力”就会变得越来越强大，那么“产品同质化”就会变成是必然的结果。这个时候，互联网公司之间的竞争又应该是怎样一个景象呢？</p><p><br/></p><p>首先，抄袭不可怕，可怕的是没有提升的抄袭</p><p><br/></p><p>现在有许多人都在指责小米抄袭苹果。但是又有多少人知道苹果也是源于“剽窃”呢？自诩完美主义商业艺术家的乔布斯不是说过：“好艺术家抄袭，伟大艺术家剽窃”的话吗？</p><p><br/></p><p>所以抄袭也好，剽窃也罢，都不是问题。问题是你不了解市场需求，不了解团队能力，不了解企业目标，只是看着别人做的好，就认为自己抄一下就能达到同样的效果。这样的盲目抄袭是浪费自己的时间，没有任何意义。或者说名你并不会真正的抄袭，也不懂真正的剽窃，所以你必定会死在互联网下一站的起点上！</p><p><br/></p><p>在我们眼镜行业里，前两年有很多大大小小的公司都在抄袭我们伊视可“验光车上门配眼镜”的商业模式，但是截至2014年底，就已经七七八八死完了。其中有行业老大哥式的品牌连锁店，也有同行的上市公司，希望通过“验光车上门配眼镜”这样的新模式来拉动自身的业绩增长。也有自诩互联网思维的眼镜外行人，想拿这个O2O模式骗VC钱。结果劳民伤财的折腾许久，最终却都以失败而告终。</p><p><br/></p><p>他们并不是被我们伊视可打败的，而是他们搬了石头把自己砸死了。对，这像极了“举鼎而亡”的秦武王。</p><p><br/></p><p>即使小米抄袭了苹果，或者魅族，亦或三星、华为什么的，但是我们不能否认它是一个成功的品牌，起码在现阶段还是！而它之所以成功，不是因为它的抄袭对象成功，而是因为它是瞄准了自己所定位的市场、族群，进行了有目的的截取与优化，并将之进行了“品牌体系化”。所谓青出于蓝，而胜于蓝！</p><p><br/></p><p>同理，我们每个人都有自己的老师，都是在学习与刻录老师身上的知识。但是并非每个老师都是成功人士，也并非每位学生都是成功人士。只有活学活用的学生，最终才能达到人生巅峰，不是？</p><p><br/></p><p>所以，产品抄袭不可怕，可怕的是没有“品牌思维”的抄袭。也因此，在互联网的下一个阶段，传统的产品经理想要不被干掉，那就应该乘早的加入“品牌思维”。如果还一味的依靠技术来实现产品的功能迭代，那最后可能也只会“举鼎而亡”了。</p><p><br/></p><p>其次，小不可怕，可怕的是不够精</p><p><br/></p><p>很多产品经理都埋怨市场需求已经被BAT满足的差不多了，在产品创新上已经不再有什么机会。产品经理已经进入了夹缝求生存阶段。</p><p><br/></p><p>这在我看来是极没有能力的一种表现和说法。</p><p><br/></p><p>进入互联网时代，因为技术而产生了许多数字化产品，比如QQ、微信、微博、手游、淘宝、美图等等。这些其实都是可以追根述源到其前世今生的。比如即时通讯类的工具，此前是书信、电报，亦或电话、短信。手游的前生是玩泥巴、打陀螺亦或电子游戏等。淘宝的前世则是百货商场，美图上辈子就是相机......是的！互联网给这些传统的事物带来了升级。</p><p><br/></p><p>那么互联网发展到现在这个阶段，难道所有的事物都已经得到了升级吗？我觉得还远远没有升级完。</p><p><br/></p><p>许多投资人在2016年初，都不约而同的把精力从O2O、P2P转移到了消费升级、服务升级、品牌升级上来。这意味着什么？此前诸如滴滴、饿了么、新美大等从大面儿上覆盖了吃喝住行的大产品、大工具的机会的确越来越少，但是针对和满足小需求的个性化、小众化的品牌产品，将如雨后春笋般诞生。</p><p><br/></p><p>很多人不明白为什么我做伊视可的时候，把那么大的精力用在设计和推广“运动防滑眼镜”这个小众的产品上。也有很多人说，市场那么大，为什么不设计个几千几万款产品来供客户挑选？</p><p><br/></p><p>我只想说：如果我能像麦当劳那样，专心把薯条做好，那么就不会愁汉堡卖不过肯德基；如果我能像全聚德那样，专心做好烤鸭，那么就不会担心翻台率超不过俏江南；如果我能像苹果那样，专心做好手机，那么就不会担心其它同系产品的市场占有率......</p><p><br/></p><p>所以，当互联网进入品牌竞争时代，无论是创业者，还是投资人，都没必要再去看是否能用产品思维，再造一个亚马逊，或者阿里巴巴。而应该专心到一个哪怕针孔般的小市场，用“品牌思维”打造成一个新麦当劳、新肯德基、新苹果......</p><p><br/>转载自创业邦&nbsp;<br/><a href=\"http://www.cyzone.cn/a/20160302/291148.html\" target=\"_self\">http://www.cyzone.cn/a/20160302/291148.html</a></p>', '0', '0', null, '2016-03-02 10:44:06', '2016-03-02 10:44:06');
INSERT INTO `scamp_posts` VALUES ('35', '4', '6', '0', '京东第四季度净收入546亿元', '腾讯科技消息，自营电商企业京东集团（纳斯达克股票代码：JD）今天发布了其截至2015年12月31日的2015财年第四季度和全年业绩。京东集团第四季度净收入为546亿元，同比增长57%。京东集团第四季度归属于普通股股东的净亏损为76亿元，主要源于拍拍网减值、以及本季度对部分投资确认的减值。', '腾讯科技消息，自营电商企业京东集团（纳斯达克股票代码：JD）今天发布了其截至2015年12月31日的2015财年第四季度和全年业绩。京东集团第四季度净收入为546亿元，同比增长57%。京东集团第四季度归属于普通股股东的净亏损为76亿元，主要源于拍拍网减值、以及本季度对部分投资确认的减值。', '0', '0', null, '2016-03-02 10:52:22', '2016-03-02 10:52:22');
INSERT INTO `scamp_posts` VALUES ('36', '1', '7', '0', '滴滴宣布月交易额破8亿美元', '腾讯科技消息，滴滴出行首席发展官李建华透露，2016年1月滴滴全平台的GMV（商品交易总额）首度超过8亿美元，超过整个北美地区移动出行的同期GMV(美国和加拿大共约6亿美元)。同时，滴滴1月份新增专车快车用户超过1000万。李建华表示，按照中国移动出行市场的潜力以及滴滴平台自身的增长速度，预计最迟到今年第三季度，滴滴平台的月GMV将超过其主要竞争对手全球的月GMV水平。', '腾讯科技消息，滴滴出行首席发展官李建华透露，2016年1月滴滴全平台的GMV（商品交易总额）首度超过8亿美元，超过整个北美地区移动出行的同期GMV(美国和加拿大共约6亿美元)。同时，滴滴1月份新增专车快车用户超过1000万。李建华表示，按照中国移动出行市场的潜力以及滴滴平台自身的增长速度，预计最迟到今年第三季度，滴滴平台的月GMV将超过其主要竞争对手全球的月GMV水平。', '0', '1', null, '2016-03-02 10:57:15', '2016-03-02 10:57:47');

-- ----------------------------
-- Table structure for scamp_profiles
-- ----------------------------
DROP TABLE IF EXISTS `scamp_profiles`;
CREATE TABLE `scamp_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '2',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` text COLLATE utf8_unicode_ci,
  `occupation` text COLLATE utf8_unicode_ci,
  `experience` text COLLATE utf8_unicode_ci,
  `address` text COLLATE utf8_unicode_ci,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qq` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wechat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weibo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `profiles_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_profiles
-- ----------------------------
INSERT INTO `scamp_profiles` VALUES ('1', '1', '0', 'avatar1456887310.jpg', '这是eden', '', '', '', '', '', '', '', '', '2016-01-12 08:07:25', '2016-03-02 10:55:10', null);
INSERT INTO `scamp_profiles` VALUES ('4', '4', '0', 'avatar1456884874.png', '这是jim', '', '', '', '', '', '', '', '', '2016-03-02 09:55:02', '2016-03-02 10:14:34', null);
INSERT INTO `scamp_profiles` VALUES ('5', '5', '2', 'avatar1456886202.jpg', '', '', '', '', '', '', '', '', '', '2016-03-02 10:28:46', '2016-03-02 10:36:50', null);

-- ----------------------------
-- Table structure for scamp_users
-- ----------------------------
DROP TABLE IF EXISTS `scamp_users`;
CREATE TABLE `scamp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `followers_count` int(10) DEFAULT '0',
  `followings_count` int(10) DEFAULT '0',
  `banned_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_name_unique` (`name`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_users
-- ----------------------------
INSERT INTO `scamp_users` VALUES ('1', 'eden', '2301016897@qq.com', '$2y$10$F9kH01gFsmAh0WS2gx9cKem8rB7QNimgPyvOPLPBoWUYQZz6Z4yOm', '2', '2', null, 'VMa2GFRuZNXFIgOANn6SKfsLnfefu5gTvBnbiXyYhLQoMk7tK00zfNpTOVkJ', '2016-01-12 08:07:25', '2016-03-02 10:58:29', null);
INSERT INTO `scamp_users` VALUES ('4', 'jim', 'jim@jim.com', '$2y$10$0uM1xgSKUpBuRt2D9YkJvuQ/BwXTVNTq8yIHrTWBX4AXq.OnbHr8a', '1', '1', null, '73uJaUWWRtYDXqEbOFqBHtsEKvVvOI5AruUzc17ZPSeyWXLhYU4am1rFs5tV', '2016-03-02 09:55:01', '2016-03-02 10:53:01', null);
INSERT INTO `scamp_users` VALUES ('5', 'batman', 'batman@batman.com', '$2y$10$g7TAAj/j7L8XZVYSxQOqX.u5ve0HO27gIvv3HiD6RJPhjky/qVefq', '1', '1', null, '81cW8WGNYYD6XKLSExPHp5ZAZONiNDHLhmrwSXJJxl4kksXzsTN8TisrTgVx', '2016-03-02 10:28:46', '2016-03-02 10:47:23', null);

-- ----------------------------
-- Table structure for scamp_votes
-- ----------------------------
DROP TABLE IF EXISTS `scamp_votes`;
CREATE TABLE `scamp_votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `votable_id` int(11) NOT NULL,
  `votable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `votes_user_id_index` (`user_id`),
  KEY `votes_votable_id_index` (`votable_id`),
  KEY `votes_votable_type_index` (`votable_type`),
  KEY `votes_is_index` (`is`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of scamp_votes
-- ----------------------------
INSERT INTO `scamp_votes` VALUES ('50', '4', '28', 'StartupsCampfire\\Models\\Post', 'upvote', null, '2016-03-02 10:12:01', '2016-03-02 10:12:01');
INSERT INTO `scamp_votes` VALUES ('51', '1', '7', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:20:03', '2016-03-02 10:20:03');
INSERT INTO `scamp_votes` VALUES ('52', '1', '28', 'StartupsCampfire\\Models\\Post', 'upvote', null, '2016-03-02 10:20:10', '2016-03-02 10:20:10');
INSERT INTO `scamp_votes` VALUES ('53', '1', '26', 'StartupsCampfire\\Models\\Post', 'upvote', null, '2016-03-02 10:20:58', '2016-03-02 10:20:58');
INSERT INTO `scamp_votes` VALUES ('54', '1', '31', 'StartupsCampfire\\Models\\Post', 'upvote', null, '2016-03-02 10:27:44', '2016-03-02 10:27:44');
INSERT INTO `scamp_votes` VALUES ('55', '5', '30', 'StartupsCampfire\\Models\\Post', 'upvote', null, '2016-03-02 10:29:05', '2016-03-02 10:29:05');
INSERT INTO `scamp_votes` VALUES ('56', '1', '10', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:49:58', '2016-03-02 10:49:58');
INSERT INTO `scamp_votes` VALUES ('57', '1', '9', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:50:00', '2016-03-02 10:50:00');
INSERT INTO `scamp_votes` VALUES ('58', '4', '8', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:50:22', '2016-03-02 10:50:22');
INSERT INTO `scamp_votes` VALUES ('59', '4', '9', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:50:23', '2016-03-02 10:50:23');
INSERT INTO `scamp_votes` VALUES ('60', '4', '7', 'StartupsCampfire\\Models\\Event', 'upvote', null, '2016-03-02 10:50:33', '2016-03-02 10:50:33');
INSERT INTO `scamp_votes` VALUES ('61', '1', '41', 'StartupsCampfire\\Models\\Comment', 'upvote', null, '2016-03-02 10:53:38', '2016-03-02 10:53:38');
INSERT INTO `scamp_votes` VALUES ('62', '1', '43', 'StartupsCampfire\\Models\\Comment', 'upvote', null, '2016-03-02 10:53:41', '2016-03-02 10:53:41');
