CREATE DATABASE IF NOT EXISTS `camagru` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `camagru`;

CREATE TABLE IF NOT EXISTS users
(id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
login varchar(255) NOT NULL,
email varchar(255) NOT NULL, 
password varchar(255) NOT NULL, 
confirm tinyint(1) NOT NULL DEFAULT '0');

INSERT INTO users (login, email, password, confirm) 
VALUES
('test1', 'test1@gmail.com', 'test1', true),
('test2', 'test2@gmail.com', 'test2', false),
('test3', 'test3@gmail.com', 'test3', true);