DROP DATABASE IF EXISTS `beautyBooster.id`;

CREATE DATABASE `beautyBooster.id`;
USE `beautybooster.id`;

CREATE TABLE `user` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(128),
  `email` VARCHAR(128),
  `image` VARCHAR(255),
  `password` VARCHAR(255),
  `role_id` INT(11),
  `is_active` INT(1),
  `date_created` INT(11),
  `date_modified` INT(11)
);
ALTER TABLE `user` ADD UNIQUE `email` (`email`);

CREATE TABLE `user_access_menu` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `role_id` INT(11),
  `menu_id` INT(11)
);

CREATE TABLE `user_menu` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `menu` VARCHAR(128)
);

CREATE TABLE `user_role` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `role` VARCHAR(128)
);

CREATE TABLE `user_sub_menu` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `menu_id` INT(11),
  `title` VARCHAR(128),
  `url` VARCHAR(128),
  `icon` VARCHAR(128),
  `is_active` int(1)
);