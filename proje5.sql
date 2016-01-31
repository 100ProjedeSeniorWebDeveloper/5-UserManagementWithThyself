-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Şub 2016, 00:32:58
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `proje5`
--
CREATE DATABASE IF NOT EXISTS `proje5` DEFAULT CHARACTER SET utf8 COLLATE utf8_turkish_ci;
USE `proje5`;


-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteriler`
--

CREATE TABLE IF NOT EXISTS `musteriler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `soyad` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `cep` int(11) NOT NULL,
  `ek` text COLLATE utf8_turkish_ci NOT NULL,
  `image_80_80` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `image_200_200` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `image_300_300` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=0 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteri_uye`
--

CREATE TABLE IF NOT EXISTS `musteri_uye` (
  `musteri_id` int(11) NOT NULL,
  `uye_id` int(11) NOT NULL,
  PRIMARY KEY (`uye_id`),
  UNIQUE KEY `musteri_id` (`musteri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE IF NOT EXISTS `uyeler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `email` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `aktif` int(11) NOT NULL,
  `kod` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=0 ;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `musteri_uye`
--
ALTER TABLE `musteri_uye`
  ADD CONSTRAINT `musteri_uye_ibfk_2` FOREIGN KEY (`uye_id`) REFERENCES `uyeler` (`id`),
  ADD CONSTRAINT `musteri_uye_ibfk_1` FOREIGN KEY (`musteri_id`) REFERENCES `musteriler` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
