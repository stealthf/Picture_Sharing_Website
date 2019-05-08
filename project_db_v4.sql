-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-26 08:12:44
-- 服务器版本： 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--
drop database if exists project_db;

create database project_db;

use project_db;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `cid` int(11) NOT NULL,
  `content` varchar(140) DEFAULT NULL,
  `uid` varchar(8) NOT NULL,
  `iid` varchar(8) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`cid`, `content`, `uid`, `iid`, `time`) VALUES
(64, 'i am 0', 'u7098046', 'i7097984', '2016-11-25 15:05:09'),
(65, 'i am 1', 'u7098760', 'i7094920', '2016-11-25 15:05:09'),
(66, 'i am 2', 'u7103366', 'i7102874', '2016-11-25 15:05:10'),
(67, 'i am 3', 'u7106629', 'i7101630', '2016-11-25 15:05:10'),
(68, 'i am 4', 'u7102539', 'i7108681', '2016-11-25 15:05:10');

-- --------------------------------------------------------

--
-- 表的结构 `img`
--

CREATE TABLE `img` (
  `iid` varchar(8) NOT NULL,
  `img_name` varchar(20) DEFAULT NULL,
  `upload_time` datetime NOT NULL,
  `uploader` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `img`
--

INSERT INTO `img` (`iid`, `img_name`, `upload_time`, `uploader`) VALUES
('i7094920', 'imgname1', '2016-11-25 15:05:09', 'u7098760'),
('i7097984', 'imgname0', '2016-11-25 15:05:09', 'u7098046'),
('i7101630', 'imgname3', '2016-11-25 15:05:10', 'u7106629'),
('i7102874', 'imgname2', '2016-11-25 15:05:10', 'u7103366'),
('i7108681', 'imgname4', '2016-11-25 15:05:10', 'u7102539');

-- --------------------------------------------------------

--
-- 表的结构 `relation`
--

CREATE TABLE `relation` (
  `rid` int(8) NOT NULL,
  `user` varchar(8) NOT NULL,
  `friend` varchar(8) NOT NULL,
  `category` varchar(16) NOT NULL DEFAULT 'undefined',
  `clearance` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `relation`
--

INSERT INTO `relation` (`rid`, `user`, `friend`, `category`, `clearance`, `time`) VALUES
(42, 'u7098046', 'u7098760', 'g1', 0, '2016-11-25 15:05:10'),
(43, 'u7098046', 'u7103366', 'g2', 0, '2016-11-25 15:05:10'),
(44, 'u7098046', 'u7106629', 'g3', 0, '2016-11-25 15:05:10'),
(45, 'u7098046', 'u7102539', 'g4', 0, '2016-11-25 15:05:10');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `uid` varchar(8) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(32) NOT NULL,
  `reg_time` datetime NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `reg_time`, `admin`) VALUES
('u7098046', 'user0', 'a65910902c0aba77c97fe826566df2b8', '2016-11-25 15:05:09', 0),
('u7098760', 'user1', '99024280cab824efca53a5d1341b9210', '2016-11-25 15:05:09', 0),
('u7102539', 'user4', '973a44c52462cf4ef8c51b24fe3b32c1', '2016-11-25 15:05:10', 0),
('u7103366', 'user2', '36ddda5af915d91549d3ab5bff1bafec', '2016-11-25 15:05:10', 0),
('u7106629', 'user3', '7d7e94f4e318389eb8de80dcaddffb32', '2016-11-25 15:05:10', 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_likes`
--

CREATE TABLE `user_likes` (
  `likes_id` int(11) NOT NULL,
  `userId` varchar(8) NOT NULL,
  `iid` varchar(8) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user_likes`
--

INSERT INTO `user_likes` (`likes_id`, `userId`, `iid`, `time`) VALUES
(46, 'u7098046', 'i7097984', '2016-11-25 15:05:09'),
(47, 'u7098760', 'i7094920', '2016-11-25 15:05:09'),
(48, 'u7103366', 'i7102874', '2016-11-25 15:05:10'),
(49, 'u7106629', 'i7101630', '2016-11-25 15:05:10'),
(50, 'u7102539', 'i7108681', '2016-11-25 15:05:10');

-- --------------------------------------------------------

--
-- 表的结构 `view_img`
--

CREATE TABLE `view_img` (
  `iid` varchar(8) NOT NULL,
  `uid` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `view_img`
--

INSERT INTO `view_img` (`iid`, `uid`) VALUES
('i7097984', 'u7098760'),
('i7097984', 'u7102539'),
('i7097984', 'u7103366'),
('i7097984', 'u7106629');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`),
  ADD KEY `iid` (`iid`);

--
-- Indexes for table `img`
--
ALTER TABLE `img`
  ADD PRIMARY KEY (`iid`),
  ADD KEY `uid` (`uploader`),
  ADD KEY `uid_2` (`uploader`);

--
-- Indexes for table `relation`
--
ALTER TABLE `relation`
  ADD PRIMARY KEY (`rid`),
  ADD UNIQUE KEY `user_3` (`user`,`friend`,`category`),
  ADD KEY `user` (`user`),
  ADD KEY `friend` (`friend`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`likes_id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `iid` (`iid`);

--
-- Indexes for table `view_img`
--
ALTER TABLE `view_img`
  ADD PRIMARY KEY (`iid`,`uid`),
  ADD KEY `viewer` (`uid`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- 使用表AUTO_INCREMENT `relation`
--
ALTER TABLE `relation`
  MODIFY `rid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- 使用表AUTO_INCREMENT `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `likes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- 限制导出的表
--

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FKiid` FOREIGN KEY (`iid`) REFERENCES `img` (`iid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKuid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `img`
--
ALTER TABLE `img`
  ADD CONSTRAINT `FKuploader` FOREIGN KEY (`uploader`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `FKfriend` FOREIGN KEY (`friend`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKuser` FOREIGN KEY (`user`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `user_likes`
--
ALTER TABLE `user_likes`
  ADD CONSTRAINT `FKimgid` FOREIGN KEY (`iid`) REFERENCES `img` (`iid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FKuserid` FOREIGN KEY (`userId`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `view_img`
--
ALTER TABLE `view_img`
  ADD CONSTRAINT `img` FOREIGN KEY (`iid`) REFERENCES `img` (`iid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `viewer` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
