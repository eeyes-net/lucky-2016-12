CREATE DATABASE IF NOT EXISTS `test_lucky` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `test_lucky`;

CREATE TABLE IF NOT EXISTS `lucky_screen` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增序号',
  `name` CHAR(50) NOT NULL COMMENT '微信墙名称',
  `title` CHAR(32) NOT NULL COMMENT '页面标题',
  `bg` VARCHAR(255) NOT NULL COMMENT '背景图片路径',
  `color` INT NOT NULL COMMENT '平均颜色',
  `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE (`name`)
) ENGINE = MyISAM CHARSET = utf8 COLLATE utf8_general_ci COMMENT = '抽奖页面信息表';
