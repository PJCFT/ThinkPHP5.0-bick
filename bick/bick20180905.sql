/*
Navicat MySQL Data Transfer

Source Server         : MySQL573
Source Server Version : 50723
Source Host           : localhost:3306
Source Database       : bick

Target Server Type    : MYSQL
Target Server Version : 50723
File Encoding         : 65001

Date: 2018-09-05 20:18:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bk_admin`
-- ----------------------------
DROP TABLE IF EXISTS `bk_admin`;
CREATE TABLE `bk_admin` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '//管理员id',
  `name` varchar(30) NOT NULL COMMENT '//管理员名称',
  `password` char(32) NOT NULL COMMENT '//管理员密码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_admin
-- ----------------------------
INSERT INTO `bk_admin` VALUES ('1', 'admin', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `bk_admin` VALUES ('2', 'admin1', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `bk_admin` VALUES ('11', 'admin2', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `bk_admin` VALUES ('12', 'admin3', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `bk_admin` VALUES ('13', 'admin4', 'e10adc3949ba59abbe56e057f20f883e');
INSERT INTO `bk_admin` VALUES ('14', 'admin5', 'e10adc3949ba59abbe56e057f20f883e');

-- ----------------------------
-- Table structure for `bk_article`
-- ----------------------------
DROP TABLE IF EXISTS `bk_article`;
CREATE TABLE `bk_article` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '//文章id',
  `title` varchar(60) NOT NULL COMMENT '//文章标题',
  `keywords` varchar(100) NOT NULL COMMENT '//关键词',
  `desc` varchar(255) NOT NULL COMMENT '//描述',
  `author` varchar(30) NOT NULL COMMENT '//作者',
  `thumb` varchar(160) DEFAULT NULL COMMENT '//缩略图',
  `content` text NOT NULL COMMENT '//内容',
  `click` mediumint(9) NOT NULL DEFAULT '0' COMMENT '//点击数',
  `zan` mediumint(9) NOT NULL DEFAULT '0' COMMENT '//点赞数',
  `rec` tinyint(1) NOT NULL DEFAULT '0' COMMENT '//0：不推荐，1：推荐',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '//发布时间',
  `cateid` mediumint(9) NOT NULL COMMENT '//所属栏目',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_article
-- ----------------------------
INSERT INTO `bk_article` VALUES ('3', '死飞车', '232死飞车', '死飞车', 'pjc', '/bick/public\\uploads/20180904\\db8b6b9a7439f2dd440f88ad7039d7c4.jpg', '<p>死飞车</p>', '19', '0', '0', '1535694644', '4');
INSERT INTO `bk_article` VALUES ('7', '复古骑行', '复古骑行', '复古骑行', 'pjc', null, '<p>1复古骑行</p>', '2', '0', '0', '1535713737', '12');
INSERT INTO `bk_article` VALUES ('8', '人身装备', '人身装备', '人身装备', 'pjc', '/bick/public\\uploads/20180904\\f2dc349b923e7b3b3c3201e2b815f46b.png', '<p>人身装备</p>', '0', '0', '0', '1535974050', '11');
INSERT INTO `bk_article` VALUES ('9', '车身装备', '人身装备', '人身装备', 'pjc', '/bick/public\\uploads/20180904\\3be78bd398ed15e2e3875ae908d152c0.jpg', '<p>人身装备</p>', '3', '0', '0', '1535974081', '5');
INSERT INTO `bk_article` VALUES ('10', '单车生活', '人身装备', '人身装备', 'pjc', '/bick/public\\uploads/20180904\\bd12e51fa46637457f0071fa202110e4.jpg', '<p>人身装备</p>', '2', '0', '0', '1535974113', '13');
INSERT INTO `bk_article` VALUES ('12', '第一篇', '第一篇', '第一篇', 'pjc', '/bick/public\\uploads/20180904\\3db61bb1d62fb3ec5241a888cd8d3fe7.jpg', '<p>第一篇~~~~</p>', '1', '0', '0', '1536057263', '13');
INSERT INTO `bk_article` VALUES ('13', '第二篇', '第二篇', '第二篇', 'pjc', '/bick/public\\uploads/20180904\\b5d445d1ba36b7bffde9db20b4a7cbed.jpg', '<p>第二篇~~</p>', '1', '0', '0', '1536057300', '13');
INSERT INTO `bk_article` VALUES ('14', '第三篇', '第三篇', '第三篇', 'pjc', '/bick/public\\uploads/20180904\\24b6e5eac0c12ec025ce4e98fb24c75d.jpg', '<p>第三篇</p>', '1', '0', '0', '1536057335', '13');
INSERT INTO `bk_article` VALUES ('15', '第四篇', '第四篇', '第四篇', 'pjc', '/bick/public\\uploads/20180904\\1fe7203a5bbfaad1920f46d3f02d4211.jpg', '<p>第四篇~~</p>', '0', '0', '0', '1536057382', '13');
INSERT INTO `bk_article` VALUES ('16', '轮播1', '轮播1', '轮播1', 'pjc', '/bick/public\\uploads/20180904\\207e2e93fae3d891a9a68adf2665d9a0.jpg', '<p>轮播1</p>', '1', '0', '1', '1536067979', '4');
INSERT INTO `bk_article` VALUES ('17', '轮播2', '轮播2', '轮播2', 'pjc', '/bick/public\\uploads/20180904\\43406c3497c7279229f02448d87391d2.jpg', '<p>轮播2</p>', '1', '0', '1', '1536068009', '4');
INSERT INTO `bk_article` VALUES ('18', '轮播3', '轮播3', '轮播3', 'pjc', '/bick/public\\uploads/20180904\\9cbd164a7dc30e3a363e899ffc552665.jpg', '<p>轮播3</p>', '0', '0', '1', '1536068032', '1');
INSERT INTO `bk_article` VALUES ('19', '轮播4', '轮播4', '轮播4', 'pjc', '/bick/public\\uploads/20180904\\c77db93ce756cf1d0d378d81cdda6980.jpg', '<p>轮播4</p>', '2', '0', '1', '1536068057', '4');

-- ----------------------------
-- Table structure for `bk_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `bk_auth_group`;
CREATE TABLE `bk_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//用户组id',
  `title` char(100) NOT NULL DEFAULT '' COMMENT '//用户组中文名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//为1正常，为0禁用',
  `rules` char(80) NOT NULL DEFAULT '' COMMENT '//用户组拥有的规则id， 多个规则","隔开',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_auth_group
-- ----------------------------
INSERT INTO `bk_auth_group` VALUES ('1', '超级管理员', '1', '16,29,17,18,19,20,30,21,22,23,24,25,26,27,28,1,31,12,13,2,3,32,6,14,15,33');
INSERT INTO `bk_auth_group` VALUES ('2', '文章管理员', '1', '16,29,17,18,19');
INSERT INTO `bk_auth_group` VALUES ('3', '栏目管理员', '1', '20,30,21,22,23');
INSERT INTO `bk_auth_group` VALUES ('6', '系统管理员', '1', '3,32,6,14,15,33');
INSERT INTO `bk_auth_group` VALUES ('8', '链接管理员', '1', '1,31,12,13,2');
INSERT INTO `bk_auth_group` VALUES ('9', '管理员', '1', '16,29,17,18,19,20,30,21,22,23,1,31,12,13,2,3,32,6,14,15,33');

-- ----------------------------
-- Table structure for `bk_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `bk_auth_group_access`;
CREATE TABLE `bk_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL COMMENT '//用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '//用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_auth_group_access
-- ----------------------------
INSERT INTO `bk_auth_group_access` VALUES ('1', '1');
INSERT INTO `bk_auth_group_access` VALUES ('2', '9');
INSERT INTO `bk_auth_group_access` VALUES ('11', '3');
INSERT INTO `bk_auth_group_access` VALUES ('12', '2');
INSERT INTO `bk_auth_group_access` VALUES ('13', '8');
INSERT INTO `bk_auth_group_access` VALUES ('14', '6');

-- ----------------------------
-- Table structure for `bk_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `bk_auth_rule`;
CREATE TABLE `bk_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '//规则id',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '//权限地址',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '//权限名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//权限类型',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//状态：为1正常，为0禁用',
  `condition` char(100) NOT NULL DEFAULT '' COMMENT '//规则表达式，为空表示存在就验证，不为空表示按照条件验证',
  `pid` mediumint(9) DEFAULT '0' COMMENT '//上级权限',
  `level` tinyint(1) DEFAULT '0',
  `sort` int(5) DEFAULT '50' COMMENT '//排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_auth_rule
-- ----------------------------
INSERT INTO `bk_auth_rule` VALUES ('1', 'Link', '友情链接', '1', '1', '', '0', '0', '2');
INSERT INTO `bk_auth_rule` VALUES ('2', 'Link/add', '添加友情链接', '1', '1', '', '31', '2', '3');
INSERT INTO `bk_auth_rule` VALUES ('3', 'Conf', '系统配置', '1', '1', '', '0', '0', '1');
INSERT INTO `bk_auth_rule` VALUES ('6', 'Conf/add', '添加配置项', '1', '1', '', '32', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('12', 'Link/edit', '修改友情链接', '1', '1', '', '31', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('13', 'Link/del', '删除友情链接', '1', '1', '', '31', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('14', 'Conf/edit', '修改配置项', '1', '1', '', '32', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('15', 'Conf/del', '删除配置项', '1', '1', '', '32', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('16', 'Article', '文章管理', '1', '1', '', '0', '0', '50');
INSERT INTO `bk_auth_rule` VALUES ('17', 'Article/add', '新增文章', '1', '1', '', '29', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('18', 'Article/edit', '修改文章', '1', '1', '', '29', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('19', 'Article/del', '删除文章', '1', '1', '', '29', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('20', 'Cate', '栏目管理', '1', '1', '', '0', '0', '50');
INSERT INTO `bk_auth_rule` VALUES ('21', 'Cate/add', '新增栏目', '1', '1', '', '30', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('22', 'Cate/edit', '修改栏目', '1', '1', '', '30', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('23', 'Cate/del', '删除栏目', '1', '1', '', '30', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('24', 'Admin', '管理员管理', '1', '1', '', '0', '0', '50');
INSERT INTO `bk_auth_rule` VALUES ('25', 'Admin/list', '管理员列表', '1', '1', '', '24', '1', '50');
INSERT INTO `bk_auth_rule` VALUES ('26', 'Admin/add', '增加管理员', '1', '1', '', '25', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('27', 'Admin/edit', '修改管理员', '1', '1', '', '25', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('28', 'Admin/del', '删除管理员', '1', '1', '', '25', '2', '50');
INSERT INTO `bk_auth_rule` VALUES ('29', 'Article/lst', '文章列表', '1', '1', '', '16', '1', '50');
INSERT INTO `bk_auth_rule` VALUES ('30', 'Cate/lst', '栏目列表', '1', '1', '', '20', '1', '50');
INSERT INTO `bk_auth_rule` VALUES ('31', 'Link/lst', '友情链接列表', '1', '1', '', '1', '1', '50');
INSERT INTO `bk_auth_rule` VALUES ('32', 'Conf/lst', '配置列表', '1', '1', '', '3', '1', '50');
INSERT INTO `bk_auth_rule` VALUES ('33', 'Conf/conf', '配置', '1', '1', '', '3', '1', '50');

-- ----------------------------
-- Table structure for `bk_cate`
-- ----------------------------
DROP TABLE IF EXISTS `bk_cate`;
CREATE TABLE `bk_cate` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '//栏目id',
  `catename` varchar(30) NOT NULL COMMENT '//栏目名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//栏目类型:1:文章列表 2:单页栏目 3:图片列表',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '//上级栏目id',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '//排序序号',
  `keywords` varchar(255) NOT NULL COMMENT '//栏目关键词',
  `desc` varchar(255) NOT NULL COMMENT '//栏目描述',
  `content` text NOT NULL COMMENT '//栏目内容',
  `rec_index` tinyint(1) DEFAULT '0' COMMENT '//0：不推荐 1：推荐',
  `rec_bottom` tinyint(1) DEFAULT '0' COMMENT '//0：不推荐 1：推荐',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_cate
-- ----------------------------
INSERT INTO `bk_cate` VALUES ('1', '单车分类', '1', '0', '60', '', '', '', '0', '0');
INSERT INTO `bk_cate` VALUES ('4', '死飞车', '1', '1', '2', '', '', '', '0', '0');
INSERT INTO `bk_cate` VALUES ('5', '车身装备', '2', '10', '3', '', '', '', '0', '0');
INSERT INTO `bk_cate` VALUES ('10', '骑行装备', '1', '0', '50', '', '', '', '0', '0');
INSERT INTO `bk_cate` VALUES ('11', '人身装备', '1', '10', '50', '', '', '', '1', '0');
INSERT INTO `bk_cate` VALUES ('12', '复古骑行', '1', '1', '1', '', '', '', '0', '0');
INSERT INTO `bk_cate` VALUES ('13', '单车生活', '3', '0', '40', '', '', '', '0', '1');
INSERT INTO `bk_cate` VALUES ('14', '行业资讯', '2', '0', '30', '关于我们', '', '<p><br/></p><h2 microsoft=\"\" trebuchet=\"\" line-height:=\"\" color:=\"\" white-space:=\"\" style=\"white-space: normal; margin: 0px 0px 20px; padding: 0px; border: 0px; font-size: 22px; vertical-align: baseline;\">关于我们</h2><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">“骑摆客”（Biker），城市自动双轮梭行者。</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">他们不满步行太迟缓、开车太壅塞，还有安全帽对发型的践踏和破坏。他们厌倦公交及地铁的贴饼生活。他们心里的隐约骄傲，来自自食其力的从容和悠哉，来自他们标志性的“骑摆客”坐骑。他们一身劲装加背包，稳坐在“摆客”上，大街小巷兜兜转，遇上塞车还来不及心烦，脑中已经浮现小路可以转弯改道。</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">骑摆客们总在抄捷径的同时，意外发现城市的精采。五颜六色的小店橱窗，引人发噱的看板招牌，令人好奇老板的甘居陋巷所为何来。互掷刀盘的夫妻，捡拾狗便的贵妇，情侣刚从酒店走出来，骑摆客一一捕捉他们的瞬间神态，在接下来的途中把故事写完。唯有气味，能让骑摆客们齿轮停摆。刚起锅的面摊卤味，正好出炉的新鲜面包，骑摆客们永远都知道：为享受“最佳状态”而停下来，迟点赴约当然应该。</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">这个城市里，上班12小时的劳累人们，走路太累，开车太烦，公交太挤，“摆客”是最好的速度；看到漂亮的人了，闻到菜香了，脚不动，就由得双轮随思而去。他们知道在这城市里骑“摆客”是最酷的，所以他们省吃俭用甘为卡奴，让他们成为一个酷酷的摆客。他们摇摆过市，吸饱城市光怪陆离，回去吐成一篇一篇他们钟爱的小品文，发表在博客上，有多欢喜。</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">骑摆客们怎么会放弃那风光里的林荫路，车就扔在远远的地方吧，后备箱里永远备着“BIKE”，那是“骑摆客”们的标志，任由阳光洒满全身，摆客们欣赏风景当然要自由。</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\">城市的风景是静默的，但穿梭其间的我们是灵动的；日程表上的计划是静态的，但迎风骑行的心情是澎湃的；思考的瞬间是安静的，但承载它的生命却在流光溢彩中完成了思考；眼前的你在安静中透着亲切，我们的轨迹却在四处闪烁；骑车一起出发吧！就在前方！</p><p microsoft=\"\" helvetica=\"\" white-space:=\"\" style=\"margin-top: 0px; margin-bottom: 20px; white-space: normal; padding: 0px; border: 0px; font-size: 14px; vertical-align: baseline; line-height: 28px; color: rgb(102, 102, 102);\"><strong style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;\">备注</strong>：<strong style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;\">本网站内容部分来自车友分享，如有侵权请及时联系我们，我们将第一时间处理。本网站原创文章欢迎转载，转载请注明本站网址。</strong></p><p><strong style=\"margin: 0px; padding: 0px; border: 0px; vertical-align: baseline;\"><br/></strong></p><h2 style=\"margin: 0px 0px 20px; padding: 0px; border: 0px; font-size: 22px; vertical-align: baseline; font-family: \" microsoft=\"\" trebuchet=\"\" line-height:=\"\" color:=\"\" white-space:=\"\"><br/></h2>', '0', '0');
INSERT INTO `bk_cate` VALUES ('15', '公司简介', '1', '0', '50', '公司简介', '公司简介', '<p>公司简介</p>', '1', '1');

-- ----------------------------
-- Table structure for `bk_conf`
-- ----------------------------
DROP TABLE IF EXISTS `bk_conf`;
CREATE TABLE `bk_conf` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '//配置项id',
  `cnname` varchar(50) NOT NULL COMMENT '//配置中文名称',
  `enname` varchar(50) NOT NULL COMMENT '//配置英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '//配置类型1：单行文本 2：多行文本 3：单选按钮 4：复选框5：下拉菜单',
  `value` varchar(255) DEFAULT NULL COMMENT '//配置值',
  `values` varchar(255) NOT NULL COMMENT '//配置可选值',
  `sort` int(11) NOT NULL DEFAULT '50' COMMENT '//配置项排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_conf
-- ----------------------------
INSERT INTO `bk_conf` VALUES ('6', '自动清除缓存', 'cache', '5', '1个小时', '1个小时,2个小时,3个小时', '10');
INSERT INTO `bk_conf` VALUES ('7', '启动验证码', 'code', '4', '是', '是', '15');
INSERT INTO `bk_conf` VALUES ('8', '站点描述', 'desc', '2', '以自行车为主题的一个网站平台                                                                                                                                                                                                                                ', '', '40');
INSERT INTO `bk_conf` VALUES ('10', '是否关闭网站', 'sitestatus', '3', '否', '是,否', '20');
INSERT INTO `bk_conf` VALUES ('11', '站点名称', 'sitename', '1', '自行车站点', '', '60');
INSERT INTO `bk_conf` VALUES ('14', '站点关键词', 'keywords', '1', '自行车', '', '50');
INSERT INTO `bk_conf` VALUES ('15', '允许评论', 'zan', '4', '允许', '允许', '0');

-- ----------------------------
-- Table structure for `bk_link`
-- ----------------------------
DROP TABLE IF EXISTS `bk_link`;
CREATE TABLE `bk_link` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '//友情链接id',
  `title` varchar(60) NOT NULL COMMENT '//友情链接标题',
  `desc` varchar(255) NOT NULL COMMENT '//友情链接描述',
  `url` varchar(160) NOT NULL COMMENT '//友情链接地址',
  `sort` mediumint(11) NOT NULL DEFAULT '50' COMMENT '//排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bk_link
-- ----------------------------
INSERT INTO `bk_link` VALUES ('2', '360', '360', 'http://www.360.cn', '2');
INSERT INTO `bk_link` VALUES ('3', '新浪', '新浪', 'http://www.sina.com', '3');
INSERT INTO `bk_link` VALUES ('4', '百度', '百度', 'http://www.baidu.com', '1');
INSERT INTO `bk_link` VALUES ('5', '腾讯视频', '腾讯视频', 'https://v.qq.com/', '50');
INSERT INTO `bk_link` VALUES ('6', '优酷', '优酷', 'https://www.youku.com/', '50');
INSERT INTO `bk_link` VALUES ('7', '爱奇艺', '爱奇艺', 'http://www.iqiyi.com/', '50');
