


DROP TABLE IF EXISTS `vt_admin_group`;
CREATE TABLE `vt_admin_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_key` varchar(128) DEFAULT NULL COMMENT '名称(多语言Key)',
  `u_id` int(10) unsigned DEFAULT NULL COMMENT '用户ID',
  `p_id` int(10) unsigned DEFAULT NULL COMMENT '父级id',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `note` varchar(512) DEFAULT NULL COMMENT '备注',
  `auth_list` varchar(512) DEFAULT NULL COMMENT '权限列表',
  `path` varchar(512) DEFAULT NULL COMMENT '路径，组关系',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1=启用,2=禁用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

INSERT INTO `vt_admin_group` VALUES ('57', 'productManagement', '1', '0', '2017-08-12 16:39:05', '2017-08-12 16:38:58', '', '22,24,23,41,42,43,44,45,46,25,26,29,47,48,49,50,51,52,53,54,55,56,57', '57', '1');
INSERT INTO `vt_admin_group` VALUES ('51', '产品管理', '35', '0', '2017-08-02 10:31:34', '2017-08-02 10:31:34', '该组负责管理产品。', null, '51', '1');


DROP TABLE IF EXISTS `vt_admin_history`;
CREATE TABLE `vt_admin_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(64) DEFAULT NULL COMMENT '城市',
  `ip` varchar(32) DEFAULT NULL COMMENT 'IP',
  `browser` varchar(32) DEFAULT NULL COMMENT '浏览器',
  `create_time` datetime DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=249 DEFAULT CHARSET=utf8;


INSERT INTO `vt_admin_history` VALUES ('230', null, '127.0.0.1', 'Other', '2017-08-12 18:26:23', '1');
INSERT INTO `vt_admin_history` VALUES ('231', null, '127.0.0.1', 'Chrome', '2017-08-12 18:28:27', '1');
INSERT INTO `vt_admin_history` VALUES ('232', null, '127.0.0.1', 'Other', '2017-08-14 09:46:01', '1');
INSERT INTO `vt_admin_history` VALUES ('233', null, '127.0.0.1', 'Chrome', '2017-08-14 09:48:18', '1');
INSERT INTO `vt_admin_history` VALUES ('234', null, '127.0.0.1', 'Chrome', '2017-08-14 10:00:35', '1');
INSERT INTO `vt_admin_history` VALUES ('235', null, '127.0.0.1', 'Other', '2017-08-14 10:15:03', '1');
INSERT INTO `vt_admin_history` VALUES ('236', null, '127.0.0.1', 'Chrome', '2017-08-14 10:23:23', '1');
INSERT INTO `vt_admin_history` VALUES ('237', null, '127.0.0.1', 'Other', '2017-08-14 10:27:06', '1');
INSERT INTO `vt_admin_history` VALUES ('238', null, '127.0.0.1', 'Chrome', '2017-08-14 10:52:13', '1');
INSERT INTO `vt_admin_history` VALUES ('239', null, '10.68.100.101', 'Chrome', '2017-08-14 11:55:58', '1');
INSERT INTO `vt_admin_history` VALUES ('240', null, '10.68.100.201', 'Chrome', '2017-08-14 12:06:55', '1');
INSERT INTO `vt_admin_history` VALUES ('241', null, '10.68.100.109', 'Safari', '2017-08-14 12:10:25', '1');
INSERT INTO `vt_admin_history` VALUES ('242', null, '127.0.0.1', 'Chrome', '2017-08-15 09:47:24', '1');
INSERT INTO `vt_admin_history` VALUES ('243', null, '127.0.0.1', 'Chrome', '2017-08-15 13:37:48', '1');
INSERT INTO `vt_admin_history` VALUES ('244', null, '127.0.0.1', 'Chrome', '2017-08-15 17:30:57', '1');
INSERT INTO `vt_admin_history` VALUES ('245', null, '127.0.0.1', 'Chrome', '2017-08-16 09:34:31', '1');
INSERT INTO `vt_admin_history` VALUES ('246', null, '127.0.0.1', 'Chrome', '2017-08-18 18:34:48', '1');
INSERT INTO `vt_admin_history` VALUES ('247', null, '10.68.100.102', 'Chrome', '2017-08-31 14:41:21', '1');
INSERT INTO `vt_admin_history` VALUES ('248', null, '10.68.100.102', 'Chrome', '2017-08-31 14:50:05', '1');

DROP TABLE IF EXISTS `vt_admin_user`;
CREATE TABLE `vt_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL COMMENT '用户名',
  `password` varchar(64) DEFAULT NULL COMMENT '密码',
  `header` varchar(64) DEFAULT 'uploads/admin/defaultHeader.png' COMMENT '头像',
  `email` varchar(64) DEFAULT NULL COMMENT '邮箱地址',
  `phone` varchar(64) DEFAULT NULL COMMENT '电话号码',
  `company` varchar(64) DEFAULT NULL COMMENT '公司',
  `address` varchar(128) DEFAULT NULL COMMENT '地址',
  `introduction` varchar(512) DEFAULT NULL COMMENT '简介',
  `create_time` int(10) unsigned DEFAULT NULL COMMENT '创建时间',
  `g_id` varchar(128) DEFAULT NULL COMMENT '组id(多个)',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(1=启用，2=禁用)',
  `p_id` int(10) unsigned DEFAULT NULL COMMENT '所属用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `vt_article`;
CREATE TABLE `vt_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(1=启用,2=禁用)',
  `title` varchar(128) DEFAULT NULL COMMENT '标题',
  `category` varchar(32) DEFAULT NULL COMMENT '所属类别',
  `cover` varchar(256) DEFAULT NULL COMMENT '封面',
  `content` text COMMENT '内容',
  `title_index` varchar(256) DEFAULT NULL COMMENT '标题索引',
  `seo` varchar(512) DEFAULT NULL COMMENT 'seo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vt_article_category`;
CREATE TABLE `vt_article_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_key` varchar(64) DEFAULT NULL COMMENT '多语言KEY',
  `pid` int(10) unsigned DEFAULT '0',
  `note` varchar(256) DEFAULT NULL COMMENT '备注',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1=启用，2=禁用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;


INSERT INTO `vt_article_category` VALUES ('34', 'Linux系统', '27', '', '2017-08-02 10:07:51', '2017-08-02 10:07:51', '1');
INSERT INTO `vt_article_category` VALUES ('35', '路由交换技术', '27', '', '2017-08-02 10:08:35', '2017-08-02 10:08:29', '1');
INSERT INTO `vt_article_category` VALUES ('25', 'IT', null, '', '2017-08-15 10:05:36', '2017-06-16 16:51:11', '1');
INSERT INTO `vt_article_category` VALUES ('26', '', null, '', '2017-08-15 10:05:56', '2017-06-16 16:51:43', '1');
INSERT INTO `vt_article_category` VALUES ('27', '网络', '25', '', '2017-06-16 16:51:50', '2017-06-16 16:51:50', '1');
INSERT INTO `vt_article_category` VALUES ('28', 'php', '26', '', '2017-06-16 16:51:59', '2017-06-16 16:51:59', '1');
INSERT INTO `vt_article_category` VALUES ('29', 'javascript', '26', '', '2017-06-16 16:52:08', '2017-06-16 16:52:08', '1');
INSERT INTO `vt_article_category` VALUES ('30', 'node', '29', '', '2017-06-16 16:52:17', '2017-06-16 16:52:17', '1');
INSERT INTO `vt_article_category` VALUES ('33', '新闻', '0', '', '2017-07-07 10:49:18', '2017-07-07 10:49:18', '1');


DROP TABLE IF EXISTS `vt_gallery`;
CREATE TABLE `vt_gallery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL COMMENT '名称',
  `category_id` int(10) unsigned DEFAULT NULL COMMENT '类别id',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `description` varchar(256) DEFAULT NULL COMMENT '描述',
  `cover` varchar(128) DEFAULT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vt_gallery_category`;
CREATE TABLE `vt_gallery_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_key` varchar(64) DEFAULT NULL COMMENT '名称',
  `note` varchar(128) DEFAULT NULL COMMENT '备注',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '状态(1=启用,2=禁用)',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `pid` int(10) unsigned DEFAULT NULL COMMENT '父级id',
  `cover` varchar(256) DEFAULT NULL COMMENT '封面',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vt_home_history`;
CREATE TABLE `vt_home_history` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `create_time` int(12) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vt_language`;
CREATE TABLE `vt_language` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `folder` varchar(32) DEFAULT NULL COMMENT '多语言目录',
  `note` varchar(128) DEFAULT NULL COMMENT '备注',
  `create_time` int(10) unsigned DEFAULT NULL,
  `language_key` varchar(32) DEFAULT NULL COMMENT '多语言KEY',
  `modular` tinyint(1) unsigned DEFAULT NULL COMMENT '模块(1=前台，2=后台)',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1=启用，2=禁用)',
  `file_name` varchar(32) DEFAULT NULL COMMENT '文件名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;


INSERT INTO `vt_language` VALUES ('1', 'en', null, '1497428854', 'setting_english', '1', '1', 'homeLanguage');
INSERT INTO `vt_language` VALUES ('2', 'zh', null, '1497428854', 'setting_simplifiedChinese', '2', '1', 'adminLanguage');
INSERT INTO `vt_language` VALUES ('16', 'en', null, '1497428854', 'setting_english', '2', '1', 'adminLanguage');
INSERT INTO `vt_language` VALUES ('17', 'zh', null, '1497428854', 'setting_simplifiedChinese', '1', '1', 'homeLanguage');
INSERT INTO `vt_language` VALUES ('35', 'tc', '', '1497507178', 'setting_traditionalChinese', '2', '1', 'adminLanguage');
INSERT INTO `vt_language` VALUES ('34', 'tc', '', '1497507177', 'setting_traditionalChinese', '1', '1', 'homeLanguage');


DROP TABLE IF EXISTS `vt_member`;
CREATE TABLE `vt_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


INSERT INTO `vt_member` VALUES ('10', '312', '3123', '', '1', '', '', '', 'uploads/files/2017072420020929747.png', '1', '2017-07-24');


DROP TABLE IF EXISTS `vt_menu_admin`;
CREATE TABLE `vt_menu_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `note` varchar(128) DEFAULT NULL COMMENT '备注',
  `route` varchar(64) DEFAULT NULL COMMENT '路由',
  `is_show` tinyint(1) DEFAULT '1' COMMENT '1显示，2隐藏',
  `p_id` int(10) DEFAULT '0' COMMENT '父级id',
  `order` smallint(5) unsigned DEFAULT '1' COMMENT '排序，数字越大，越靠后',
  `icon` varchar(64) DEFAULT '*' COMMENT '图标',
  `active` varchar(64) DEFAULT NULL COMMENT '选中key',
  `auth` varchar(64) DEFAULT NULL COMMENT '权限key',
  `create_time` varchar(16) DEFAULT NULL COMMENT '创建时间',
  `language_key` varchar(64) DEFAULT NULL COMMENT '多语言key',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;


INSERT INTO `vt_menu_admin` VALUES ('1', 'menu_setting', 'javascript', '1', '0', '100', 'main-icon fa fa-gear', 'setting', '*', null, 'menu_setting');
INSERT INTO `vt_menu_admin` VALUES ('2', 'menu_menu', 'admin/setting/menu', '1', '64', '1', '*', 'setting_menu', 'menuAdminList', null, 'menu_menu');
INSERT INTO `vt_menu_admin` VALUES ('64', 'menu_menuS', 'javascript', '1', '0', '98', 'fa fa-map-signs', 'menu', '#', '1498725369', 'menu_menuS');
INSERT INTO `vt_menu_admin` VALUES ('14', 'menu_default', 'admin/setting/default', '1', '1', '1', '#', 'settingDefault', 'settingDefault', '1497422389', 'menu_default');
INSERT INTO `vt_menu_admin` VALUES ('15', 'menu_language', 'admin/setting/language', '1', '1', '1', '#', 'settingLanguage', 'settingLanguage', '1497427793', 'menu_language');
INSERT INTO `vt_menu_admin` VALUES ('17', 'setting_theme', 'admin/setting/theme', '1', '1', '2', '#', 'settingTheme', 'settingTheme', '1497507388', 'setting_theme');
INSERT INTO `vt_menu_admin` VALUES ('22', 'menu_Article', 'javascript', '1', '0', '1', 'main-icon fa fa-edit', 'article', '#', '1497584631', 'menu_Article');
INSERT INTO `vt_menu_admin` VALUES ('24', 'auth_ArticleList', 'admin/article', '1', '22', '1', '#', 'article', 'articleList', '1497601464', 'menu_Article');
INSERT INTO `vt_menu_admin` VALUES ('23', 'auth_CategoryList', 'admin/article/category', '1', '22', '1', '#', 'articleCategory', 'articleCategory', '1497584772', 'menu_articleCategory');
INSERT INTO `vt_menu_admin` VALUES ('25', 'auth_productList', 'javascript', '1', '0', '2', 'fa fa-cart-plus', 'product', 'product', '1497856605', 'menu_product');
INSERT INTO `vt_menu_admin` VALUES ('26', 'menu_productCategory', 'admin/product/category', '1', '25', '1', '#', 'productCategory', 'productCategory', '1497856711', 'menu_productCategory');
INSERT INTO `vt_menu_admin` VALUES ('27', 'menu_media', 'javascript', '1', '0', '4', 'fa fa-file-movie-o', 'media', 'media', '1497859633', 'menu_media');
INSERT INTO `vt_menu_admin` VALUES ('28', 'menu_lists', 'admin/media', '1', '27', '1', '#', 'mediaLists', 'media', '1497859707', 'menu_lists');
INSERT INTO `vt_menu_admin` VALUES ('29', 'menu_product', 'admin/product', '1', '25', '1', '#', 'product', 'productList', '1497924781', 'menu_product');
INSERT INTO `vt_menu_admin` VALUES ('31', 'menu_gallery', 'javascript', '1', '0', '3', 'main-icon fa fa-file-photo-o', 'gallery', 'gallery', '1498119633', 'menu_gallery');
INSERT INTO `vt_menu_admin` VALUES ('32', 'menu_galleryCategory', 'admin/gallery/category', '1', '31', '1', '#', 'galleryCategory', 'galleryCategory', '1498119729', 'menu_galleryCategory');
INSERT INTO `vt_menu_admin` VALUES ('33', 'menu_gallery', 'admin/gallery', '1', '31', '1', '#', 'gallery', 'galleryList', '1498128033', 'menu_gallery');
INSERT INTO `vt_menu_admin` VALUES ('34', 'menu_plugin', 'javascript', '1', '0', '6', 'fa fa-code', 'plugin', 'plugin', '1498463478', 'menu_plugin');
INSERT INTO `vt_menu_admin` VALUES ('35', 'common_lists', 'admin/plugin', '1', '34', '5', '#', 'plugin', 'admin/plugin', '1498463552', 'common_lists');
INSERT INTO `vt_menu_admin` VALUES ('36', 'menu_homeMenu', 'admin/setting/homemenu', '1', '64', '1', '#', 'homeMenu', 'homeMenuList', '1498554262', 'menu_homeMenu');
INSERT INTO `vt_menu_admin` VALUES ('37', 'menu_Administrators', 'javascript', '1', '0', '99', 'fa fa-users', 'administrators', 'administrators', '1498700722', 'menu_Administrators');
INSERT INTO `vt_menu_admin` VALUES ('38', 'menu_group', 'admin/administrators/group', '1', '37', '1', '#', 'administratorsGroup', 'administratorsGroup', '1498700818', 'menu_group');
INSERT INTO `vt_menu_admin` VALUES ('39', 'admin_adminUser', 'admin/administrators/user', '1', '37', '1', '#', 'administratorsUser', 'administratorsUser', '1498704487', 'admin_adminUser');
INSERT INTO `vt_menu_admin` VALUES ('41', 'auth_ArticleAdd', '#', '2', '22', '1', '#', '#', 'articleAdd', '1498721923', 'auth_ArticleAdd');
INSERT INTO `vt_menu_admin` VALUES ('42', 'auth_ArticleEdit', '#', '2', '22', '1', '#', '#', 'articleEdit', '1498722010', 'auth_ArticleEdit');
INSERT INTO `vt_menu_admin` VALUES ('43', 'auth_ArticleDelete', '#', '2', '22', '1', '#', '#', 'articleDelete', '1498722034', 'auth_ArticleDelete');
INSERT INTO `vt_menu_admin` VALUES ('44', 'auth_CategoryAdd', '#', '2', '22', '1', '#', '#', 'articleCategoryAdd', '1498722172', 'auth_CategoryAdd');
INSERT INTO `vt_menu_admin` VALUES ('45', 'auth_CategoryEdit', '#', '2', '22', '1', '#', '#', 'articleCategoryEdit', '1498722249', 'auth_CategoryEdit');
INSERT INTO `vt_menu_admin` VALUES ('46', 'auth_CategoryDelete', '#', '2', '22', '1', '#', '#', 'articleCategoryDelete', '1498722497', 'auth_CategoryDelete');
INSERT INTO `vt_menu_admin` VALUES ('47', 'auth_productAdd', '#', '2', '25', '1', '#', '#', 'productAdd', '1498723130', 'auth_productAdd');
INSERT INTO `vt_menu_admin` VALUES ('48', 'auth_productEdit', '#', '2', '25', '1', '#', '#', 'productEdit', '1498723264', 'auth_productEdit');
INSERT INTO `vt_menu_admin` VALUES ('49', 'auth_productDelete', '#', '2', '25', '1', '#', '#', 'productDelete', '1498723297', 'auth_productDelete');
INSERT INTO `vt_menu_admin` VALUES ('50', 'auth_CategoryList', '#', '2', '25', '1', '#', '#', 'productCategory', '1498723545', 'auth_CategoryList');
INSERT INTO `vt_menu_admin` VALUES ('51', 'auth_CategoryAdd', '#', '2', '25', '1', '#', '#', 'productCategoryAdd', '1498723580', 'auth_CategoryAdd');
INSERT INTO `vt_menu_admin` VALUES ('52', 'auth_CategoryEdit', '#', '2', '25', '1', '#', '#', 'productCategoryEdit', '1498723603', 'auth_CategoryEdit');
INSERT INTO `vt_menu_admin` VALUES ('53', 'auth_CategoryDelete', '#', '2', '25', '1', '#', '#', 'productCategoryDelete', '1498723646', 'auth_CategoryDelete');
INSERT INTO `vt_menu_admin` VALUES ('54', 'auth_productAttribute', '#', '2', '25', '1', '#', '#', 'productAttribute', '1498723893', 'auth_productAttribute');
INSERT INTO `vt_menu_admin` VALUES ('55', 'auth_productAttributeAdd', '#', '2', '25', '1', '#', '#', 'productAttributeAdd', '1498723929', 'auth_productAttributeAdd');
INSERT INTO `vt_menu_admin` VALUES ('56', 'auth_productAttributeEdit', '#', '2', '25', '1', '#', '#', 'productAttributeEdit', '1498723961', 'auth_productAttributeEdit');
INSERT INTO `vt_menu_admin` VALUES ('57', 'auth_productAttributeDelete', '#', '2', '25', '1', '#', '#', 'productAttributeDelete', '1498723993', 'auth_productAttributeDelete');
INSERT INTO `vt_menu_admin` VALUES ('58', 'auth_mediaFolderCreate', '#', '2', '27', '1', '#', '#', 'mediaFolderCreate', '1498724117', 'auth_mediaFolderCreate');
INSERT INTO `vt_menu_admin` VALUES ('59', 'auth_galleryCategoryAdd', '#', '2', '31', '1', '#', '#', 'galleryCategoryAdd', '1498724712', 'auth_galleryCategoryAdd');
INSERT INTO `vt_menu_admin` VALUES ('60', 'auth_galleryCategoryEdit', '#', '2', '31', '1', '#', '#', 'galleryCategoryEdit', '1498724740', 'auth_galleryCategoryEdit');
INSERT INTO `vt_menu_admin` VALUES ('61', 'auth_galleryCategoryDelete', '#', '2', '31', '1', '#', '#', 'galleryCategoryDelete', '1498724772', 'auth_galleryCategoryDelete');
INSERT INTO `vt_menu_admin` VALUES ('62', 'auth_galleryAdd', '#', '2', '31', '1', '#', '#', 'galleryAdd', '1498724849', 'auth_galleryAdd');
INSERT INTO `vt_menu_admin` VALUES ('63', 'auth_galleryDelete', '#', '2', '31', '1', '#', '#', 'galleryDelete', '1498724897', 'auth_galleryDelete');
INSERT INTO `vt_menu_admin` VALUES ('65', 'auth_menuAdminAdd', '#', '2', '64', '1', '#', '#', 'menuAdminAdd', '1498725849', 'auth_menuAdminAdd');
INSERT INTO `vt_menu_admin` VALUES ('66', 'auth_menuAdminEdit', '#', '2', '64', '1', '#', '#', 'menuAdminEdit', '1498725872', 'auth_menuAdminEdit');
INSERT INTO `vt_menu_admin` VALUES ('67', 'auth_menuAdminDelete', '#', '2', '64', '1', '#', '#', 'menuAdminDelete', '1498725902', 'auth_menuAdminDelete');
INSERT INTO `vt_menu_admin` VALUES ('68', 'auth_homeMenuAdd', '#', '2', '64', '1', '#', '#', 'homeMenuAdd', '1498726253', 'auth_homeMenuAdd');
INSERT INTO `vt_menu_admin` VALUES ('69', 'auth_homeMenuEdit', '#', '2', '64', '1', '#', '#', 'homeMenuEdit', '1498726355', 'auth_homeMenuEdit');
INSERT INTO `vt_menu_admin` VALUES ('70', 'auth_homeMenuDelete', '#', '2', '64', '1', '#', '#', 'homeMenuDelete', '1498726398', 'auth_homeMenuDelete');


DROP TABLE IF EXISTS `vt_menu_home`;
CREATE TABLE `vt_menu_home` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_key` varchar(64) DEFAULT NULL COMMENT '多语言KEY',
  `route` varchar(128) DEFAULT NULL COMMENT '路由',
  `is_show` tinyint(1) DEFAULT NULL COMMENT '是否显示(1=显示，2=隐藏)',
  `p_id` int(10) unsigned DEFAULT '0' COMMENT '父级id',
  `order` smallint(10) DEFAULT NULL COMMENT '排序',
  `icon` varchar(64) DEFAULT NULL COMMENT '图标',
  `active` varchar(64) DEFAULT NULL COMMENT '选中关键字',
  `index` tinyint(1) unsigned DEFAULT '2' COMMENT '首页(1=是，2=否)',
  `note` varchar(256) DEFAULT NULL COMMENT '备注',
  `type` tinyint(1) DEFAULT '1' COMMENT '链接类型(1=内置,2=外链)',
  `target` tinyint(1) DEFAULT '1' COMMENT '是否在新窗口打开(1=否,2=是)',
  `parameter` varchar(64) DEFAULT 'null' COMMENT '内置链接的参数',
  `modular_id` smallint(5) unsigned DEFAULT NULL COMMENT '模块id',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;


INSERT INTO `vt_menu_home` VALUES ('15', 'nav_product', 'product', '1', null, '2', '#', 'product', '2', '', '0', '1', 'p=?', null, '2017-07-07 10:28:50', '2017-07-07 09:55:17');
INSERT INTO `vt_menu_home` VALUES ('14', 'nav_home', '/', '1', '0', '1', '#', '/', '2', '', '0', '1', 'Empty', null, '2017-08-11 14:32:03', '2017-07-07 09:46:41');
INSERT INTO `vt_menu_home` VALUES ('16', 'nav_Article', 'news', '1', '0', '3', '#', 'news', '2', '', '0', '2', 'a=?', null, '2017-08-08 14:45:50', '2017-07-07 09:55:44');
INSERT INTO `vt_menu_home` VALUES ('25', 'nav_contactUs', 'contact', '1', '0', '10', '', '', '2', '', '0', '1', 'Empty', null, '2017-08-08 14:39:39', '2017-08-08 14:39:28');
INSERT INTO `vt_menu_home` VALUES ('18', 'nav_aboutUs', 'about', '1', '0', '5', '#', 'about', '2', '', '0', '1', 'Empty', null, '2017-08-08 13:53:01', '2017-07-07 09:56:23');


DROP TABLE IF EXISTS `vt_options`;
CREATE TABLE `vt_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `vt_plugin_options`;
CREATE TABLE `vt_plugin_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '插件唯一标识名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '安装的插件状态（1=未启用，2=启用）',
  `order` tinyint(1) DEFAULT '1' COMMENT '排序，数字越大越靠前',
  `create_time` datetime DEFAULT NULL COMMENT '安装时间，不能重复安装',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='启用插件配置';


INSERT INTO `vt_plugin_options` VALUES ('22', 'longjinwen', '2', '1', '2017-08-31 14:44:22');
INSERT INTO `vt_plugin_options` VALUES ('23', 'member', '2', '1', '2017-08-31 15:39:40');

DROP TABLE IF EXISTS `vt_product`;
CREATE TABLE `vt_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL COMMENT '名称',
  `price` float(10,2) DEFAULT NULL COMMENT '价格',
  `cover` varchar(256) DEFAULT NULL COMMENT '封面',
  `gallery` varchar(512) DEFAULT NULL COMMENT '图集',
  `content` text COMMENT '内容',
  `describe` varchar(512) DEFAULT NULL COMMENT '描述',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1=启用，2=禁用)',
  `category` varchar(128) DEFAULT NULL COMMENT '分类',
  `seo` varchar(512) DEFAULT NULL COMMENT 'SEO',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vt_product_attribute`;
CREATE TABLE `vt_product_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL COMMENT '属性名称',
  `category_id` int(8) unsigned DEFAULT NULL COMMENT '分类ID',
  `input_type` tinyint(1) unsigned DEFAULT NULL COMMENT '输入类型(1=文本框，2=单选框，3=复选框)',
  `default_value` varchar(128) DEFAULT NULL COMMENT '默认值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;


INSERT INTO `vt_product_attribute` VALUES ('55', '类型', '15', '2', '计算机,设计,财务');
INSERT INTO `vt_product_attribute` VALUES ('54', '页数', '15', '1', '102');
INSERT INTO `vt_product_attribute` VALUES ('51', '爱好', '14', '3', '1,2,3,45,5,6,7,87,89,9');
INSERT INTO `vt_product_attribute` VALUES ('50', '重量', '14', '1', '10kg');
INSERT INTO `vt_product_attribute` VALUES ('49', '颜色', '14', '1', '红色');
INSERT INTO `vt_product_attribute` VALUES ('56', '语言', '15', '3', '中文,英文');
INSERT INTO `vt_product_attribute` VALUES ('57', '价钱', '8', '1', '55');
INSERT INTO `vt_product_attribute` VALUES ('58', '类型', '8', '2', '文学,金融,计算机');

DROP TABLE IF EXISTS `vt_product_attribute_value`;
CREATE TABLE `vt_product_attribute_value` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL COMMENT '产品ID',
  `attribute_id` int(10) unsigned DEFAULT NULL COMMENT '属性ID',
  `attribute_value` varchar(128) DEFAULT NULL COMMENT '属性值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `vt_product_category`;
CREATE TABLE `vt_product_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_key` varchar(64) DEFAULT NULL COMMENT '多语言KEY',
  `pid` int(10) unsigned DEFAULT NULL COMMENT '父级分类',
  `note` varchar(256) DEFAULT NULL COMMENT '备注',
  `updated_at` datetime DEFAULT NULL COMMENT '更新时间',
  `created_at` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1=启用,2=禁用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


INSERT INTO `vt_product_category` VALUES ('7', 'laravel', '2', '', '2017-08-01 18:04:20', null, '1');
INSERT INTO `vt_product_category` VALUES ('2', 'PHP', '0', '', '2017-06-20 09:55:48', '0000-00-00 00:00:00', '1');
INSERT INTO `vt_product_category` VALUES ('3', 'thinkphp', '2', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `vt_product_category` VALUES ('4', 'JavaScript', '0', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `vt_product_category` VALUES ('5', 'Node.js', '4', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `vt_product_category` VALUES ('6', 'VUE', '4', null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `vt_product_category` VALUES ('8', 'Yii', '2', '', '2017-08-01 18:04:31', '2017-06-19 15:51:01', '1');
INSERT INTO `vt_product_category` VALUES ('10', 'nodejs', '5', '', '2017-06-20 09:56:14', '2017-06-20 09:56:14', '1');
INSERT INTO `vt_product_category` VALUES ('11', 'vue', '6', '', '2017-06-20 17:18:01', '2017-06-20 17:18:01', '1');
INSERT INTO `vt_product_category` VALUES ('13', 'C', '0', '', '2017-06-21 11:33:31', '2017-06-21 11:33:31', '1');
INSERT INTO `vt_product_category` VALUES ('15', 'Lumen', '7', '', '2017-08-01 18:04:52', '2017-08-01 18:04:52', '1');
INSERT INTO `vt_product_category` VALUES ('16', 'test龙锦文', '0', '', '2017-08-10 16:50:17', '2017-08-10 16:50:17', '1');

DROP TABLE IF EXISTS `vt_theme`;
CREATE TABLE `vt_theme` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) DEFAULT NULL,
  `path` varchar(64) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO `vt_theme` VALUES ('1', 'Default_', 'default', '1');
INSERT INTO `vt_theme` VALUES ('21', '复古古诗词', 'gushici', '2');
