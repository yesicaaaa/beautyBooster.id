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

CREATE TABLE `menu_categories` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `category` VARCHAR(128)
);

CREATE TABLE `user_role` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `role` VARCHAR(128)
);

CREATE TABLE `menu_sub_categories` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `menu_id` INT(11),
  `title` VARCHAR(128),
  `url` VARCHAR(128),
  `is_active` int(1)
);

CREATE TABLE `tb_m_menu` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `menu` VARCHAR(128)
);

CREATE TABLE `tb_m_sub_menu` (
  `id` INT(11) PRIMARY KEY AUTO_INCREMENT,
  `menu_id` INT(11),
  `title` VARCHAR(128),
  `icon` VARCHAR(128),
  `url` VARCHAR(128),
  `is_active` int(1)
);

CREATE TABLE `tb_m_products` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `category_id` INT,
  `sub_category_id` INT,
  `product_name` VARCHAR(128),
  `rating` VARCHAR(128),
  `stock` INT,
  `price` INT,
  `description` TEXT,
  `date_created` INT
);

CREATE TABLE `user_token` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `email` VARCHAR(128),
  `token` VARCHAR(255),
  `date_created` INT
);