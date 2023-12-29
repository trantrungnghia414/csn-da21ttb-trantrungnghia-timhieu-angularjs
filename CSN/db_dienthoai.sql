-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 04:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dienthoai`
--
CREATE DATABASE IF NOT EXISTS `db_dienthoai` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_dienthoai`;

CREATE TABLE `sanpham` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `ten` varchar(255),
  `gia` integer,
  `mota` longtext,
  `hangsanxuat` integer,
  `thuonghieu_id` integer
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hinhanh` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `link` varchar(255),
  `sanpham_id` integer
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `thuonghieu` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `tenthuonghieu` varchar(255),77
  `xuatxu` varchar(255),
  `mota` text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `nguoidung` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `tennguoidung` varchar(255),
  `email` varchar(255),
  `sodienthoai` varchar(10),
  `diachi` varchar(255),
  `quyen` varchar(255)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `hinhanh` ADD FOREIGN KEY (`sanpham_id`) REFERENCES `sanpham` (`id`);

ALTER TABLE `sanpham` ADD FOREIGN KEY (`thuonghieu_id`) REFERENCES `thuonghieu` (`id`);
