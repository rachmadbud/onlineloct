-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Feb 2024 pada 13.08
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_v3_radius_update`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `building`
--

CREATE TABLE `building` (
  `building_id` int(8) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `latitude_longtitude` varchar(150) NOT NULL,
  `radius` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `building`
--

INSERT INTO `building` (`building_id`, `code`, `name`, `address`, `latitude_longtitude`, `radius`) VALUES
(1, 'SWUKZ/2021', 'Kantor Pusat Bank Waway', 'TBU', '-5.4285148667687135,105.26024560883981', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cuty`
--

CREATE TABLE `cuty` (
  `cuty_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `cuty_start` date NOT NULL,
  `cuty_end` date NOT NULL,
  `date_work` date NOT NULL,
  `cuty_total` int(5) NOT NULL,
  `cuty_description` varchar(100) NOT NULL,
  `cuty_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employees_code` varchar(30) NOT NULL,
  `employees_email` varchar(30) NOT NULL,
  `employees_password` varchar(100) NOT NULL,
  `employees_name` varchar(50) NOT NULL,
  `position_id` int(5) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_login` datetime NOT NULL,
  `created_cookies` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `employees`
--

INSERT INTO `employees` (`id`, `employees_code`, `employees_email`, `employees_password`, `employees_name`, `position_id`, `shift_id`, `building_id`, `photo`, `created_login`, `created_cookies`) VALUES
(17, '12341234', 'firdausandiko@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Firdaus Andiko ', 8, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(18, '12341234', 'anangsofi@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Anang Sofi', 8, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(222, '12341234', 'harrybudiarjo@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Harry Budiarjo', 9, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(223, '12341234', 'muhammadriza@mail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhammad Riza', 9, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(224, '12341234', 'dwiastuti@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dwi Astuti Setianingsih', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(225, '12341234', 'dwiastutisetianingsih@gmail.co', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dwi Astuti Setianingsih', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(226, '12341234', 'agusprinanto@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Agus Prinanto', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(227, '12341234', 'mutiacitra@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Mutia Citra', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(228, '12341234', 'muhammadherjuno@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhammad Herjuno', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(229, '12341234', 'sofyanniaga@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Sofyan Niaga', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(230, '12341234', 'muhammadfauzi@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhammad Fauzi', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(232, '12341234', 'tersani@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Tersani ', 10, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(233, '12341234', 'nuraini@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Nuraini ', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(234, '12341234', 'veronicatitibudiarti@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Veronica Titi Budiarti ', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(249, '12341234', 'pajri@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Pajri', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(250, '12341234', 'venthykartikanurrahmi@gmail.co', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Venthy Kartika Nurrahmi', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(251, '12341234', 'deckylesmana@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Decky Lesmana', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(254, '12341234', 'yogasarakurniawan@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Yoga Sara Kurniawan', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(255, '12341234', 'netharithalti@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Netha Rithalti', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(256, '12341234', 'ilwandjauhari@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Ilwan Djauhari', 11, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(257, '12341234', 'susipujiastuti@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Susi Puji Astuti', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(258, '12341234', 'etioktaria@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Eti Oktaria', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(259, '12341234', 'astrimulianingsih@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Astri Mulianingsih', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(260, '12341234', 'dinanovalia@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dina Novalia', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(261, '12341234', 'hevimariadona@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Hevi Mariadona', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(262, '12341234', 'irmasilvia@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Irma Silvia', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(263, '12341234', 'anggarendiseptian@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Angga Rendi Septian', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(264, '12341234', 'hendri@gmaill.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Hendri ', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(265, '12341234', 'hendriansyah@gmail.com ', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Hendriansyah', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(266, '12341234', 'agungnugroho@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhammad Prio Agung Nugroho', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(267, '12341234', 'andithasandraprasudha', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Anditha Sandra Prasudha', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(268, '12341234', 'anggrek@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Anggrek Waskita Kusumarinni', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(269, '12341234', 'dwiyuliadiyanto@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dwi Yuli Adiyanto', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(271, '12341234', 'muhizarikatapip@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhizar Ikat Apip', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(272, '12341234', 'gitaprimalestari@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Gita Prima Lestari', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(273, '12341234', 'ade@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Ade Septia Yulandari', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(275, '12341234', 'angger@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Angger Hepy Kesuma', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(276, '12341234', 'agungprasetio@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Agung Prasetio', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(277, '12341234', 'wisnuwardana@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Wisnu Wardana', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(282, '12341234', 'rezairawangmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Reza Irawan', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(283, '12341234', 'bagus@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Bagus Barmansyah', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(284, '12341234', 'nadya', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Nadya Ayu Puspita', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(285, '12341234', 'nadabella@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Nada Bella Ramadhani', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(286, '12341234', 'aras@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Aras Peni Devita', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(287, '12341234', 'adelia@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Adelia Putriana', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(288, '12341234', 'arif@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Achmad Arif Abdurahman', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(289, '12341234', 'samsul@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Muhammad Samsul', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(290, '12341234', 'edwar@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Edwar Birin', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(291, '12341234', 'derytriandi@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dery Triandi', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(292, '12341234', 'dekieantoni', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dekie Antoni', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(293, '12341234', 'budiansyah', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Budiansyah', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(294, '12341234', 'dwisurya', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dwi Surya', 1, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(295, '12341234', 'dwisurya', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Dwi Surya', 12, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(296, '12341234', 'budianto@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Budianto', 12, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(297, '12341234', 'hendra@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Hendra Wijaya Saputra', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(298, '12341234', 'anistia@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Anistia Putri Kartika', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(299, '12341234', 'rudipracoyo@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Rudi Pracoyo', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(300, '12341234', 'deckiadima@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Decki Adima Zendra', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(301, '12341234', 'ully', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Ully Eka Arissya', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(302, '12341234', 'jimmi@mail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Jimmi Afriando Akbar', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(303, '12341234', 'khairina@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Khairina Efia Putri', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(304, '12341234', 'fenny@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Fenny Riannisa', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(305, '12341234', 'nanda@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Nurul Nanda Pratiwi', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(306, '12341234', 'rachmad@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Rachmad Budianto', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(307, '12341234', 'sugengriyanto', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Sugeng Riyanto', 13, 0, 1, '', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(309, '12341234', 'ariyandi@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Ariyandi', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(310, '12341234', 'supriyanto@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Supriyanto', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(311, '12341234', 'amelia@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Rizky Amelia Putri', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(312, '12341234', 'suci@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Suci Hayati', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(313, '12341234', 'ardiyansah@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Ardiyansah', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e'),
(314, '12341234', 'dhafa@gmail.com', '60bdc2bb69e8b04343921b83ffe7d01e140ae3eaf2cb3ac988462067ff4546ff', 'Achmad Dhafa Yuliandy', 13, 0, 1, '2024-02-273193a1448fdf5ea7f27ade1f77f54d1b.gif', '2024-02-27 18:56:38', 'f1e958a6a397d07eb9c48ce21aef424e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `permission_name` varchar(35) NOT NULL,
  `permission_date` date NOT NULL,
  `permission_date_finish` date NOT NULL,
  `permission_description` text NOT NULL,
  `files` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `position`
--

CREATE TABLE `position` (
  `position_id` int(5) NOT NULL,
  `position_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'STAFF'),
(2, 'ACCOUNTING'),
(7, 'MARKETING'),
(8, 'DIREKSI'),
(9, 'KOMITE'),
(10, 'KABAG'),
(11, 'KASUBAG'),
(12, 'NON STAFF'),
(13, 'KONTRAK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presence`
--

CREATE TABLE `presence` (
  `presence_id` int(11) NOT NULL,
  `employees_id` int(11) NOT NULL,
  `presence_date` date NOT NULL,
  `shift_id` int(11) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `picture_in` text NOT NULL,
  `picture_out` varchar(150) NOT NULL,
  `kehadiran` varchar(20) NOT NULL COMMENT 'Masuk,Pulang,Tidak Hadir',
  `latitude_longtitude_in` varchar(200) NOT NULL,
  `latitude_longtitude_out` varchar(200) NOT NULL,
  `status_in` varchar(20) NOT NULL,
  `status_out` varchar(20) NOT NULL,
  `information` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `presence`
--

INSERT INTO `presence` (`presence_id`, `employees_id`, `presence_date`, `shift_id`, `jam_masuk`, `jam_pulang`, `time_in`, `time_out`, `picture_in`, `picture_out`, `kehadiran`, `latitude_longtitude_in`, `latitude_longtitude_out`, `status_in`, `status_out`, `information`) VALUES
(10, 6, '2023-10-20', 5, '13:00:00', '21:00:00', '22:08:35', '22:13:09', 'absen-in-6-1697814515.jpg', 'absen-out-6-1697814789.jpg', 'Hadir', '-5.373952,105.2573696', '-5.373952,105.2573696', 'Telat', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `present_status`
--

CREATE TABLE `present_status` (
  `present_id` int(6) NOT NULL,
  `present_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `present_status`
--

INSERT INTO `present_status` (`present_id`, `present_name`) VALUES
(1, 'Hadir'),
(2, 'Sakit'),
(3, 'Izin'),
(4, 'Dinas Luar Kota'),
(5, 'Dinas Dalam Kota');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_name` varchar(20) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL,
  `active` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_name`, `time_in`, `time_out`, `active`) VALUES
(1, 'Minggu', '08:00:00', '17:00:00', 'N'),
(2, 'Senin', '08:00:00', '17:00:00', 'Y'),
(3, 'Selasa', '08:00:00', '17:00:00', 'Y'),
(4, 'Rabu', '08:00:00', '17:00:00', 'Y'),
(5, 'Kamis', '08:00:00', '17:00:00', 'Y'),
(6, 'Jumat', '08:00:00', '17:00:00', 'Y'),
(7, 'Sabtu', '08:00:00', '17:00:00', 'N');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sw_site`
--

CREATE TABLE `sw_site` (
  `site_id` int(4) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_company` varchar(30) NOT NULL,
  `site_manager` varchar(30) NOT NULL,
  `site_director` varchar(30) NOT NULL,
  `site_phone` char(12) NOT NULL,
  `site_address` text NOT NULL,
  `site_description` text NOT NULL,
  `site_logo` varchar(50) NOT NULL,
  `site_email` varchar(30) NOT NULL,
  `site_email_domain` varchar(50) NOT NULL,
  `gmail_host` varchar(50) NOT NULL,
  `gmail_username` varchar(50) NOT NULL,
  `gmail_password` varchar(50) NOT NULL,
  `gmail_port` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sw_site`
--

INSERT INTO `sw_site` (`site_id`, `site_url`, `site_name`, `site_company`, `site_manager`, `site_director`, `site_phone`, `site_address`, `site_description`, `site_logo`, `site_email`, `site_email_domain`, `gmail_host`, `gmail_username`, `gmail_password`, `gmail_port`) VALUES
(1, 'http://localhost/absensiBankWaway/', 'Absensi Bank Waway', 'Bank Waway', 'Juniaji Suryopracoyo', 'Firdaus', '089666665781', 'Jl. Diponegoro No.28, Gulak Galik, Kec. Tlk. Betung Utara, Kota Bandar Lampung, Lampung 35212', 'Absensi Bank Waway v1', 'logoptbprwawaylampungperserodaokpng.png', 'bankwawaylampung@yahoo.com', 'bankwawaylampung.com', 'smtp.gmail.com', 'emailanda@gmail.com', 'passwordemailserver', '465');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `registered` datetime NOT NULL,
  `created_login` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `session` varchar(100) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `browser` varchar(30) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `fullname`, `registered`, `created_login`, `last_login`, `session`, `ip`, `browser`, `level`) VALUES
(1, 'admin', 'admin@mail.com', '88222999e01f1910a5ac39fa37d3b8b704973d503d0ff7c84d46305b92cfa0f6', 'admin', '2021-02-03 10:22:00', '2024-02-27 16:33:48', '2024-02-27 16:33:41', '-', '1', 'Google Crome', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_level`
--

CREATE TABLE `user_level` (
  `level_id` int(4) NOT NULL,
  `level_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_level`
--

INSERT INTO `user_level` (`level_id`, `level_name`) VALUES
(1, 'Administrator'),
(2, 'Operator');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`building_id`);

--
-- Indeks untuk tabel `cuty`
--
ALTER TABLE `cuty`
  ADD PRIMARY KEY (`cuty_id`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indeks untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indeks untuk tabel `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indeks untuk tabel `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`presence_id`);

--
-- Indeks untuk tabel `present_status`
--
ALTER TABLE `present_status`
  ADD PRIMARY KEY (`present_id`);

--
-- Indeks untuk tabel `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indeks untuk tabel `sw_site`
--
ALTER TABLE `sw_site`
  ADD PRIMARY KEY (`site_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `building`
--
ALTER TABLE `building`
  MODIFY `building_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `cuty`
--
ALTER TABLE `cuty`
  MODIFY `cuty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT untuk tabel `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `presence`
--
ALTER TABLE `presence`
  MODIFY `presence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `present_status`
--
ALTER TABLE `present_status`
  MODIFY `present_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT untuk tabel `sw_site`
--
ALTER TABLE `sw_site`
  MODIFY `site_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_level`
--
ALTER TABLE `user_level`
  MODIFY `level_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
