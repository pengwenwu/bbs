-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 �?03 �?22 �?10:02
-- 服务器版本: 5.5.53
-- PHP 版本: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `bbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `ban_ips`
--

CREATE TABLE IF NOT EXISTS `ban_ips` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(30) NOT NULL COMMENT '用户ip',
  `dated` datetime NOT NULL COMMENT 'dated',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `ban_ips`
--

INSERT INTO `ban_ips` (`id`, `ip`, `dated`) VALUES
(2, '127.0.0.10', '2017-03-20 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '板块名称',
  `order_by` tinyint(4) NOT NULL DEFAULT '50',
  `dated` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `categorys`
--

INSERT INTO `categorys` (`id`, `name`, `order_by`, `dated`) VALUES
(1, '生活', 50, '2017-03-21 14:41:19'),
(2, '模板', 50, '2017-03-09 14:28:35'),
(3, '应用中心', 50, '2017-03-14 11:27:27'),
(4, '安装使用', 50, '2017-03-09 15:03:34'),
(5, '站长帮', 50, '2017-03-17 15:47:08'),
(6, 'bug反馈', 50, '2017-03-15 17:05:24'),
(11, '板块列表', 50, '2017-03-21 13:41:34');

-- --------------------------------------------------------

--
-- 表的结构 `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cate_id` int(11) NOT NULL COMMENT '板块id',
  `title` varchar(30) NOT NULL COMMENT '帖子标题',
  `reply_num` int(11) NOT NULL DEFAULT '0' COMMENT '回复数',
  `ip` varchar(20) NOT NULL COMMENT 'ip地址',
  `topdated` datetime NOT NULL COMMENT '置顶时间',
  `is_ban` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否结帖，0不结帖，1结帖',
  `update_dated` datetime NOT NULL COMMENT '最后修改时间',
  `dated` datetime NOT NULL COMMENT '发帖时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=212 ;

--
-- 转存表中的数据 `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `cate_id`, `title`, `reply_num`, `ip`, `topdated`, `is_ban`, `update_dated`, `dated`) VALUES
(93, 9, 2, '12121212', 0, '127.0.0.1', '0000-00-00 00:00:00', 1, '2017-03-03 16:46:52', '2017-03-03 16:46:52'),
(189, 9, 6, '今日发帖啊', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-14 09:50:27', '2017-03-14 09:50:27'),
(91, 9, 1, '从自行车自行车小', 0, '127.0.0.1', '2017-03-06 10:15:36', 0, '2017-03-03 14:52:41', '2017-03-03 14:52:41'),
(89, 9, 1, '1231545', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 14:52:34', '2017-03-03 14:52:34'),
(87, 9, 1, 'zzz', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 14:52:24', '2017-03-03 14:52:24'),
(106, 9, 1, '凑个数', 0, '127.0.0.1', '2017-03-06 10:50:33', 0, '2017-03-06 10:50:18', '2017-03-06 10:50:18'),
(85, 9, 1, '发腿儿', 2, '127.0.0.1', '0000-00-00 00:00:00', 1, '2017-03-03 17:24:51', '2017-03-03 14:52:15'),
(84, 9, 1, '发帖', 0, '127.0.0.1', '2017-03-06 10:29:18', 0, '2017-03-03 14:32:47', '2017-03-03 14:32:47'),
(83, 9, 1, 'ip', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 13:14:03', '2017-03-03 13:14:03'),
(82, 9, 1, '《》《》《》', 2, '', '0000-00-00 00:00:00', 0, '2017-03-03 14:07:00', '2017-03-03 13:07:36'),
(81, 9, 1, '1212', 0, '', '0000-00-00 00:00:00', 0, '2017-03-03 10:53:28', '2017-03-03 10:53:28'),
(80, 9, 1, 'eeee', 1, '', '2017-03-06 10:21:34', 1, '2017-03-03 14:33:05', '2017-03-03 10:51:53'),
(79, 9, 4, '满级没回家吗', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-03-03 10:39:52'),
(78, 9, 4, 'jmm', 0, '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2017-03-03 10:39:47'),
(77, 9, 3, 'dasdasdas', 1, '', '2017-03-13 12:01:56', 0, '2017-03-10 17:29:19', '2017-03-03 10:39:41'),
(76, 9, 3, '大大声点', 1, '', '2017-03-21 09:02:57', 0, '2017-03-03 14:11:01', '2017-03-03 10:39:36'),
(74, 9, 2, '从自行车自行车在', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-03-03 10:39:26'),
(73, 9, 2, '穿着穿着小锤子线', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-03-03 10:39:21'),
(72, 9, 2, '132123', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-03-03 10:39:17'),
(71, 9, 1, '1312312312', 0, '', '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '2017-03-03 10:39:11'),
(94, 9, 2, 'zxczxcczxzc', 0, '127.0.0.1', '0000-00-00 00:00:00', 1, '2017-03-03 16:46:57', '2017-03-03 16:46:57'),
(205, 12, 1, '最新发帖-热门', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:18:31', '2017-03-21 14:18:31'),
(96, 9, 2, 'czxczxczxczx', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 16:47:04', '2017-03-03 16:47:04'),
(97, 9, 2, '3恩恩饿', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:06:32', '2017-03-03 17:06:32'),
(98, 9, 2, '饿2饿2饿2e', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:06:36', '2017-03-03 17:06:36'),
(99, 9, 2, '哇打我打算的', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:06:41', '2017-03-03 17:06:41'),
(100, 9, 2, '大大声点', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:06:45', '2017-03-03 17:06:45'),
(101, 9, 2, '大打算打算233 ', 0, '127.0.0.1', '2017-03-06 11:13:20', 0, '2017-03-09 16:33:28', '2017-03-03 17:06:58'),
(102, 9, 2, '打算打算', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:07:04', '2017-03-03 17:07:04'),
(103, 9, 2, '撒大声大声道', 2, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-03 17:07:07', '2017-03-03 17:07:07'),
(192, 9, 3, 'ssssss', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-14 11:27:27', '2017-03-14 11:27:27'),
(156, 9, 3, '事实上事实上', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 15:36:04', '2017-03-10 15:36:04'),
(107, 9, 1, '凑数', 0, '127.0.0.1', '2017-03-06 10:51:06', 0, '2017-03-06 10:50:24', '2017-03-06 10:50:24'),
(108, 9, 1, '置顶帖1', 0, '127.0.0.1', '2017-03-06 10:51:08', 1, '2017-03-06 10:50:45', '2017-03-06 10:50:45'),
(109, 9, 1, '213412', 8, '127.0.0.1', '2017-03-06 10:51:15', 0, '2017-03-10 16:37:59', '2017-03-06 10:50:54'),
(110, 9, 1, '置顶帖222', 4, '127.0.0.1', '2017-03-06 10:51:13', 0, '2017-03-13 13:48:55', '2017-03-06 10:50:59'),
(111, 9, 2, '置顶1', 0, '127.0.0.1', '2017-03-06 11:09:44', 0, '2017-03-06 11:09:27', '2017-03-06 11:09:27'),
(113, 9, 2, '打算打算m ', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-09 16:31:42', '2017-03-06 14:04:25'),
(114, 9, 1, '1312312312', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 14:04:44', '2017-03-06 14:04:44'),
(115, 9, 1, '修改', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 14:27:09', '2017-03-06 14:09:42'),
(154, 9, 3, '试试效果1 ', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 15:19:10', '2017-03-10 15:19:10'),
(118, 9, 4, '添加', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 14:55:21', '2017-03-06 14:55:21'),
(119, 9, 4, '12313', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 14:57:33', '2017-03-06 14:57:33'),
(122, 9, 1, '我问问', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 15:51:14', '2017-03-06 15:51:14'),
(121, 9, 4, '今天天气不错~', 2, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-06 15:12:10', '2017-03-06 15:11:47'),
(134, 9, 1, '123344', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-07 11:04:54', '2017-03-07 11:04:54'),
(144, 9, 2, 'dfsssswdqwdf', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-09 14:23:56', '2017-03-09 14:23:56'),
(158, 9, 1, '33333333333333333333', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 15:41:34', '2017-03-10 15:41:34'),
(157, 9, 3, '事实上实上', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 15:36:23', '2017-03-10 15:36:23'),
(143, 9, 1, 'ajax提交', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-09 14:23:09', '2017-03-09 14:23:09'),
(148, 9, 4, '33333331111', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-09 16:33:36', '2017-03-09 15:03:34'),
(159, 9, 1, '33333333333333333', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 15:41:50', '2017-03-10 15:41:50'),
(152, 9, 1, '123344', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-09 15:48:29', '2017-03-09 15:48:29'),
(160, 9, 5, 'zzzzzzzzz ', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 16:13:57', '2017-03-10 16:13:57'),
(161, 9, 6, '发表一个帖子', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 16:14:19', '2017-03-10 16:14:19'),
(162, 9, 1, '顶顶顶顶顶顶顶顶顶heel', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:03:12', '2017-03-10 17:03:12'),
(163, 9, 1, '            说说说所是', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:05:29', '2017-03-10 17:05:29'),
(164, 9, 1, '为什么内容四也能输入', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:06:33', '2017-03-10 17:06:33'),
(165, 9, 1, '顶顶顶顶顶顶顶顶顶顶', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:07:02', '2017-03-10 17:07:02'),
(166, 9, 1, '为什么空帖也能输入', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:09:06', '2017-03-10 17:09:06'),
(167, 9, 1, '空帖实验是', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:13:02', '2017-03-10 17:13:02'),
(168, 9, 1, '空帖实验是空帖实验是', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:16:24', '2017-03-10 17:16:24'),
(169, 9, 1, '空帖实验是空帖实验是v', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 17:17:27', '2017-03-10 17:17:27'),
(208, 12, 1, '测试热门发帖在', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:19:19', '2017-03-21 14:19:19'),
(171, 9, 1, 'ssssssssssssss', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 18:13:43', '2017-03-10 18:13:43'),
(172, 9, 1, 'ssssssssssssssss', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 18:14:08', '2017-03-10 18:14:08'),
(173, 9, 1, 'xxxxxxxxxxxxx', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-10 18:16:21', '2017-03-10 18:16:21'),
(179, 9, 1, 'ddddddddddddd', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 13:32:23', '2017-03-13 13:32:23'),
(177, 9, 1, 'ssssss修改啊', 0, '127.0.0.1', '2017-03-13 09:28:48', 0, '2017-03-13 13:51:46', '2017-03-10 19:08:41'),
(180, 9, 1, '侧市大长度', 2, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 13:40:09', '2017-03-13 13:35:04'),
(182, 9, 1, '上传图片 从v', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 14:52:15', '2017-03-13 14:52:15'),
(183, 9, 1, '上传文件n', 1, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 14:54:50', '2017-03-13 14:54:50'),
(184, 9, 1, '上传超大图片', 1, '127.0.0.1', '2017-03-20 18:47:27', 0, '2017-03-21 15:28:42', '2017-03-13 14:59:32'),
(185, 9, 6, '添加一条帖子', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 16:34:14', '2017-03-13 16:34:14'),
(190, 9, 5, '3-14号发帖', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-14 09:51:35', '2017-03-14 09:51:35'),
(188, 9, 1, 'zzzzzzzzzzzzzzzzz', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-13 18:35:35', '2017-03-13 18:35:35'),
(191, 9, 5, '3-14   -14', 1, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-14 09:51:57', '2017-03-14 09:51:57'),
(193, 12, 6, 'ssssssssssssssssssss', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-15 17:05:24', '2017-03-15 17:05:24'),
(194, 9, 1, '新用户发帖', 4, '127.0.0.1', '2017-03-17 13:29:32', 0, '2017-03-16 16:28:16', '2017-03-16 16:28:16'),
(195, 9, 1, '新发帖顶顶顶顶顶顶顶顶顶', 1, '127.0.0.1', '2017-03-17 13:29:29', 1, '2017-03-16 17:11:13', '2017-03-16 17:11:13'),
(196, 12, 1, '发帖发帖啊', 3, '127.0.0.1', '2017-03-20 18:47:31', 0, '2017-03-17 13:28:50', '2017-03-17 13:28:50'),
(197, 13, 5, '新人报道22', 1, '127.0.0.1', '2017-03-17 15:52:36', 0, '2017-03-17 15:47:08', '2017-03-17 15:47:08'),
(199, 9, 1, '新的的顶顶顶顶顶的顶顶', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-17 17:09:14', '2017-03-17 17:09:14'),
(206, 12, 1, '测试热门发帖', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:18:58', '2017-03-21 14:18:58'),
(203, 9, 1, '2111111111', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-17 17:17:20', '2017-03-17 17:17:20'),
(207, 12, 1, '测试热门发帖想', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:19:09', '2017-03-21 14:19:09'),
(204, 9, 1, 'cececcecece', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-17 17:30:27', '2017-03-17 17:30:27'),
(209, 12, 1, '测试热门发帖我', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:19:26', '2017-03-21 14:19:26'),
(210, 12, 1, '测试热门发帖要', 0, '127.0.0.1', '0000-00-00 00:00:00', 0, '2017-03-21 14:19:36', '2017-03-21 14:19:36'),
(211, 16, 1, '好天气好天气', 1, '127.0.0.1', '2017-03-21 15:17:13', 0, '2017-03-21 14:34:51', '2017-03-21 14:34:24');

-- --------------------------------------------------------

--
-- 表的结构 `post_contents`
--

CREATE TABLE IF NOT EXISTS `post_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL COMMENT '帖子id',
  `content` text NOT NULL COMMENT '帖子内容',
  `dated` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

--
-- 转存表中的数据 `post_contents`
--

INSERT INTO `post_contents` (`id`, `post_id`, `content`, `dated`) VALUES
(47, 114, '修改内容', '2017-03-06 14:04:44'),
(4, 71, '312312312312', '2017-03-03 10:39:11'),
(46, 113, '33人人r', '2017-03-09 16:31:42'),
(6, 73, '从自行车自行车中出现', '2017-03-03 10:39:21'),
(7, 74, '自产自销创造性', '2017-03-03 10:39:26'),
(9, 76, '大师大师都是', '2017-03-03 10:39:36'),
(10, 77, '是大大大叔的', '2017-03-03 10:39:41'),
(11, 78, '美好卖家', '2017-03-03 10:39:47'),
(12, 79, '没结婚没结婚', '2017-03-03 10:39:52'),
(13, 80, 'eeee', '2017-03-03 10:51:53'),
(14, 81, '21221', '2017-03-03 10:53:28'),
(15, 82, '《》？@@@!!!', '2017-03-03 13:07:36'),
(16, 83, 'ip', '2017-03-03 13:14:03'),
(17, 84, '121212', '2017-03-03 14:32:47'),
(18, 85, '发帖', '2017-03-03 14:52:15'),
(19, 86, 'zzz', '2017-03-03 14:52:21'),
(20, 87, 'zzzz', '2017-03-03 14:52:24'),
(22, 89, '12341打算', '2017-03-03 14:52:34'),
(24, 91, '这心辞职信', '2017-03-03 14:52:41'),
(122, 189, '122222222222222222', '2017-03-14 09:50:27'),
(26, 93, '1212121212', '2017-03-03 16:46:52'),
(27, 94, 'zxczxczxczxc', '2017-03-03 16:46:57'),
(132, 205, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/29.gif" border="0" alt="">', '2017-03-21 14:18:31'),
(29, 96, 'czxczxczx', '2017-03-03 16:47:04'),
(30, 97, '2饿2饿e', '2017-03-03 17:06:32'),
(31, 98, '饿2额1饿2', '2017-03-03 17:06:36'),
(32, 99, '的打算打算', '2017-03-03 17:06:41'),
(33, 100, '大大声点', '2017-03-03 17:06:45'),
(34, 101, '打算打算2233', '2017-03-09 16:33:28'),
(35, 102, '打算打算', '2017-03-03 17:07:04'),
(36, 103, '打算打算', '2017-03-03 17:07:07'),
(125, 192, '是事实上事实上事实上事实上事实上事实上', '2017-03-14 11:27:27'),
(39, 106, '12121212', '2017-03-06 10:50:18'),
(40, 107, '12123123', '2017-03-06 10:50:24'),
(41, 108, '12213', '2017-03-06 10:50:45'),
(42, 109, '312312', '2017-03-09 16:13:03'),
(43, 110, '23112312312', '2017-03-13 13:48:55'),
(44, 111, '之定义', '2017-03-06 11:09:27'),
(48, 115, '最新修改在', '2017-03-06 14:27:09'),
(87, 154, '试试效果1&nbsp;试试效果1&nbsp;', '2017-03-10 15:19:10'),
(51, 118, '1231231', '2017-03-06 14:55:21'),
(52, 119, '312312312', '2017-03-06 14:57:33'),
(55, 122, '啊啊啊', '2017-03-06 15:51:14'),
(54, 121, '加油111', '2017-03-06 15:12:00'),
(116, 183, '<a href="/static/uploads/file/20170313/20170313145444_43763.txt" target="_blank">/static/uploads/file/20170313/20170313145444_43763.txt</a>', '2017-03-13 14:54:50'),
(76, 143, '提交效果试试', '2017-03-09 14:23:09'),
(77, 144, '地区发vwefggwrger&nbsp;', '2017-03-09 14:23:56'),
(90, 157, '去去去去去去前期', '2017-03-10 15:36:23'),
(89, 156, '少时诵诗书', '2017-03-10 15:36:04'),
(81, 148, '11132312', '2017-03-09 16:33:36'),
(91, 158, '43222222222222', '2017-03-10 15:41:34'),
(85, 152, '241444444', '2017-03-09 15:48:29'),
(92, 159, '<a href="http://www.myitem.com/index.php/Home/Index/postDetail/158">33333333333333333333</a>', '2017-03-10 15:41:50'),
(93, 160, 'zzzzzzzzzzzzz', '2017-03-10 16:13:57'),
(94, 161, '发表一个帖子发表一个帖子发表一个帖子发表一个帖子发表一个帖子', '2017-03-10 16:14:19'),
(95, 162, '擦擦擦擦擦擦擦擦擦擦', '2017-03-10 17:03:12'),
(96, 163, '&nbsp;是是是是 &nbsp;', '2017-03-10 17:05:29'),
(115, 182, '<img src="/static/uploads/image/20170313/20170313145213_68930.jpg" alt="">', '2017-03-13 14:52:15'),
(98, 165, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;', '2017-03-10 17:07:02'),
(99, 166, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', '2017-03-10 17:09:06'),
(100, 167, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;', '2017-03-10 17:13:02'),
(101, 168, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', '2017-03-10 17:16:24'),
(102, 169, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;', '2017-03-10 17:17:27'),
(133, 206, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/40.gif" border="0" alt="">', '2017-03-21 14:18:58'),
(104, 171, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; sssssssssssss', '2017-03-10 18:13:43'),
(105, 172, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;', '2017-03-10 18:14:08'),
(106, 173, '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;', '2017-03-10 18:16:21'),
(118, 185, '<img src="http://api.map.baidu.com/staticimage?center=118.809326,32.052913&zoom=17&width=558&height=360&markers=118.809326,32.052913&markerStyles=l,A" alt="">', '2017-03-13 16:34:14'),
(112, 179, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/36.gif" border="0" alt="">', '2017-03-13 13:32:23'),
(110, 177, 'sss &nbsp; &nbsp;吃吃吃', '2017-03-13 13:51:46'),
(113, 180, '定义和用法<br>\nstr_replace() 函数以其他字符替换字符串中的一些字符（区分大小写）。<br>\n该函数必须遵循下列规则：<br>\n如果搜索的字符串是数组，那么它将返回数组。<br>\n如果搜索的字符串是数组，那么它将对数组中的每个元素进行查找和替换。<br>\n如果同时需要对数组进行查找和替换，并且需要执行替换的元素少于查找到的元素的数量，那么多余元素将用空字符串进行替换<br>\n如果查找的是数组，而替换的是字符串，那么替代字符串将对所有查找到的值起作用。<br>\n注释：该函数区分大小写。请使用 str_ireplace() 函数执行不区分大小写的搜索。<br>\n注释：该函数是二进制安全的。<br>\n语法<br>\nstr_replace(find,replace,string,count)<br>\n参数 描述<br>\nfind 必需。规定要查找的值。<br>\nreplace 必需。规定替换 find 中的值的值。<br>\nstring 必需。规定被搜索的字符串。<br>\ncount 可选。对替换数进行计数的变量。<br>\n技术细节<br>\n返回值： 返回带有替换值的字符串或数组。<br>\nPHP 版本： 4+<br>\n更新日志： <br>\n在 PHP 5.0 中，新增了 count 参数。<br>\n在 PHP 4.3.3 之前，该函数的 find 和 replace 参数都为数组时将会遇到麻烦，会引起空的 find 索引在内部指针没有更换到 replace 数组上时被忽略。新的版本不会有这个问题。<br>\n自 PHP 4.0.5 起，大多数参数可以是一个数组。<br>\n更多实例<br>\n例子 1<br>\n<br>', '2017-03-13 13:35:04'),
(117, 184, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/27.gif" border="0" alt=""><img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/28.gif" border="0" alt=""><img src="http://api.map.baidu.com/staticimage?center=121.473704,31.230393&zoom=11&width=558&height=360&markers=121.473704,31.230393&markerStyles=l,A" alt=""><img src="/static/uploads/image/20170313/20170313145929_33659.jpg" alt="">', '2017-03-21 15:28:42'),
(121, 188, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', '2017-03-13 18:35:35'),
(123, 190, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/36.gif" border="0" alt="">', '2017-03-14 09:51:35'),
(124, 191, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/18.gif" border="0" alt="">', '2017-03-14 09:51:57'),
(126, 193, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/37.gif" border="0" alt="">', '2017-03-15 17:05:24'),
(127, 194, '看看效果内容', '2017-03-16 16:28:16'),
(128, 195, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/37.gif" border="0" alt="">', '2017-03-16 17:11:13'),
(129, 196, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/36.gif" border="0" alt="">', '2017-03-17 13:28:50'),
(130, 197, '测试新人报道', '2017-03-17 15:47:08'),
(131, 204, '<img src="/static/uploads/image/20170317/20170317173025_19950.jpg" alt="">', '2017-03-17 17:30:27'),
(134, 207, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/43.gif" border="0" alt="">', '2017-03-21 14:19:09'),
(135, 208, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/8.gif" border="0" alt="">', '2017-03-21 14:19:19'),
(136, 209, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/0.gif" border="0" alt="">', '2017-03-21 14:19:26'),
(137, 210, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/9.gif" border="0" alt="">', '2017-03-21 14:19:36'),
(138, 211, '今天好天气好天气', '2017-03-21 14:34:51');

-- --------------------------------------------------------

--
-- 表的结构 `replys`
--

CREATE TABLE IF NOT EXISTS `replys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL COMMENT '帖子id',
  `content` text NOT NULL COMMENT '回帖内容',
  `ip` varchar(20) NOT NULL COMMENT 'ip地址',
  `dated` datetime NOT NULL COMMENT '回帖时间',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `replys`
--

INSERT INTO `replys` (`id`, `post_id`, `content`, `ip`, `dated`, `user_id`) VALUES
(54, 103, '<img src="/static/js/editor/attached/image/20170313/20170313181142_78060.jpg" alt="">', '127.0.0.1', '2017-03-13 18:11:44', 9),
(53, 103, 'jiayou', '127.0.0.1', '2017-03-13 18:10:46', 9),
(52, 183, '最新回复。', '127.0.0.1', '2017-03-13 16:31:42', 9),
(8, 82, '回复', '127.0.0.1', '2017-03-03 14:06:56', 9),
(9, 82, '再回复', '127.0.0.1', '2017-03-03 14:07:00', 9),
(10, 76, '11152', '127.0.0.1', '2017-03-03 14:11:01', 9),
(11, 80, '回复一个', '127.0.0.1', '2017-03-03 14:33:05', 9),
(51, 184, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/11.gif" border="0" alt=""><img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/11.gif" border="0" alt="">回复<img src="/static/js/editor/attached/image/20170313/20170313152634_86950.jpg" alt="">', '127.0.0.1', '2017-03-13 15:26:53', 9),
(21, 85, '回一个\r\n', '127.0.0.1', '2017-03-03 17:24:48', 9),
(27, 121, '222', '127.0.0.1', '2017-03-06 15:12:10', 9),
(26, 121, '111', '127.0.0.1', '2017-03-06 15:12:08', 9),
(43, 109, '<span>回复回复</span>', '127.0.0.1', '2017-03-10 16:37:29', 9),
(44, 109, '<span xss=removed> 回复回复</span>', '127.0.0.1', '2017-03-10 16:37:59', 9),
(45, 77, '<span xss=removed>是大大大叔的</span>', '127.0.0.1', '2017-03-10 17:29:19', 9),
(46, 110, 'ccccccccccccc', '127.0.0.1', '2017-03-13 09:51:05', 9),
(47, 110, 'zzzzzzzzzzzzzzzzzz', '127.0.0.1', '2017-03-13 09:51:08', 9),
(48, 110, 'bbbbbbbbbbbbbbbbbbb', '127.0.0.1', '2017-03-13 09:51:14', 9),
(49, 110, 'mmmmmmmmmmmmmmmmmmmm', '127.0.0.1', '2017-03-13 09:51:18', 9),
(50, 180, '<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/12.gif" border="0" alt=""><img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/32.gif" border="0" alt="">', '127.0.0.1', '2017-03-13 13:40:09', 9),
(42, 109, '<span>回复回复</span>', '127.0.0.1', '2017-03-10 16:37:20', 9),
(38, 109, '123132312', '127.0.0.1', '2017-03-09 15:09:34', 9),
(41, 109, '回复回复啊', '127.0.0.1', '2017-03-10 16:37:16', 9),
(39, 109, 'ajax回复', '127.0.0.1', '2017-03-09 15:11:49', 9),
(40, 109, '31231231', '127.0.0.1', '2017-03-09 15:41:05', 9),
(55, 109, '才踩踩踩从', '127.0.0.1', '2017-03-16 16:34:48', 9),
(61, 196, 'sssssssssss', '127.0.0.1', '2017-03-17 15:28:03', 9),
(57, 180, 'dddddd', '127.0.0.1', '2017-03-16 17:05:34', 9),
(62, 197, '欢迎欢迎欢迎', '127.0.0.1', '2017-03-17 15:52:55', 13),
(59, 194, 'sssssssssssssssssssssssssssssssss', '127.0.0.1', '2017-03-16 18:23:46', 12),
(60, 196, '我要回帖<img src="http://www.myitem.com/static/js/editor/plugins/emoticons/images/27.gif" border="0" alt="">', '127.0.0.1', '2017-03-17 13:29:17', 9),
(64, 194, '大大大滴滴答答', '127.0.0.1', '2017-03-17 16:41:10', 15),
(65, 194, '<img src="/static/js/editor/attached/image/20170317/20170317170837_64154.jpg" alt="">', '127.0.0.1', '2017-03-17 17:08:40', 9),
(67, 211, 'hello', '127.0.0.1', '2017-03-21 14:36:01', 16);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `birthday` date NOT NULL COMMENT '生日',
  `sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别',
  `is_ban` tinyint(4) NOT NULL DEFAULT '0',
  `last_dated` datetime NOT NULL COMMENT '最后登录时间',
  `is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否是管理员',
  `dated` datetime NOT NULL COMMENT '注册时间',
  `ip` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `email`, `birthday`, `sex`, `is_ban`, `last_dated`, `is_admin`, `dated`, `ip`) VALUES
(7, '31233122', 'd1f38800faf5e6ee1a27a069c9397cc3', '3123123123', 'pww@163.com', '1994-05-01', 2, 0, '2017-03-16 10:15:00', 0, '2017-03-15 14:38:20', '127.0.0.1'),
(8, '1312312', '943e31d8492f55c493deda01180ee76d', '12312312', '315359131@qq.com', '1994-05-01', 2, 0, '2017-03-16 10:15:00', 0, '2017-03-15 15:15:53', '127.0.0.1'),
(5, '这是一个用户名', '23438022fe665797de0c365ad966d405', '昵称呢', '315359131@qq.com', '1994-05-01', 2, 1, '2017-03-16 10:15:00', 0, '2017-03-15 14:02:37', '127.0.0.1'),
(6, '什么什么是什么', 'c9200b02a62aa42563536b78f0495732', '1232131312', 'pww@163.com', '1994-05-01', 2, 0, '2017-03-16 10:15:00', 0, '2017-03-15 14:17:56', '127.0.0.1'),
(9, 'user', '0e9633b5f0f67dcc17412335597666ca', '用户昵称啊啊啊在', '315359131@qq.com', '1994-05-01', 1, 0, '2017-03-21 15:28:26', 0, '2017-03-15 16:23:45', '127.0.0.1'),
(10, '3123吃吃吃', 'ce2824c59bca3a9eceaa01b9dca27a32', '31231231231', '315359131@qq.com', '1994-05-01', 1, 0, '2017-03-16 10:15:00', 0, '2017-03-15 17:41:03', '127.0.0.1'),
(12, 'admin', '15e9cadb845b50bbefd0d42e4b244a67', '测试十五个字的用户', '315359131@qq.com', '1994-05-01', 1, 0, '2017-03-21 14:18:07', 0, '2017-03-16 17:22:51', '127.0.0.1'),
(13, 'leiyuan', '3fdadcee4a1fa97e976eff1fe6774d4c', 'leiyuan2', 'leiyuan@corp-ci.com', '1992-05-01', 2, 0, '2017-03-17 15:50:39', 0, '2017-03-17 15:45:09', '127.0.0.1'),
(15, '事实上事实上', '10c72553cb6c5721a4269823ff54cd8e', '惺惺惜惺惺想', 'pww@163.com', '1994-05-01', 2, 0, '0000-00-00 00:00:00', 0, '2017-03-17 16:40:38', '127.0.0.1'),
(16, '雷媛02', '37b14efd54b9c6a1e262c7a09d17618c', 'leyiuan', 'leiyuan@corp-ci.com', '1994-05-01', 2, 0, '0000-00-00 00:00:00', 0, '2017-03-21 14:33:55', '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;