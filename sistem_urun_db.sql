-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 04 May 2020, 18:17:33
-- Sunucu sürümü: 10.1.32-MariaDB
-- PHP Sürümü: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sistem_urun_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunsistemtablo`
--

CREATE TABLE `urunsistemtablo` (
  `Kullanici_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Sistem` varchar(150) COLLATE utf8_bin NOT NULL,
  `Birim` varchar(150) COLLATE utf8_bin NOT NULL,
  `KartNo` varchar(25) COLLATE utf8_bin NOT NULL,
  `SeriNo` varchar(100) COLLATE utf8_bin NOT NULL,
  `ArizaTipi` varchar(150) COLLATE utf8_bin NOT NULL,
  `UrunAdi` varchar(150) COLLATE utf8_bin NOT NULL,
  `Sehir` varchar(80) COLLATE utf8_bin NOT NULL,
  `Degistirilen_Parca` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `SonDurum` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `GirisTarihi` date DEFAULT NULL,
  `YapilanIslem` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `ResimAD` varchar(150) COLLATE utf8_bin DEFAULT NULL,
  `ResimYol` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `ProjeAdi` varchar(120) COLLATE utf8_bin NOT NULL,
  `EkBilgi` varchar(400) COLLATE utf8_bin DEFAULT NULL,
  `Revize_Nedeni` varchar(350) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Tablo döküm verisi `urunsistemtablo`
--

INSERT INTO `urunsistemtablo` (`Kullanici_ID`, `ID`, `Sistem`, `Birim`, `KartNo`, `SeriNo`, `ArizaTipi`, `UrunAdi`, `Sehir`, `Degistirilen_Parca`, `SonDurum`, `GirisTarihi`, `YapilanIslem`, `ResimAD`, `ResimYol`, `ProjeAdi`, `EkBilgi`, `Revize_Nedeni`) VALUES
(1, 1, 'KapÄ± OtomatiÄŸi', 'Mas 6', 'M798-4651-R32', '465798451320', 'Bozuk', 'Otomatik', 'Ä°stanbul', NULL, NULL, '2018-08-24', 'Panel deÄŸiÅŸti.', 'documents/', 'skull-and-bones-wallpaper-250x250.jpg', 'Mas Zil', 'deneme', 'revize yaptÄ±k.'),
(1, 7, 'KapÄ± OtomatiÄŸi', 'Mas 10', 'M746-8513-R29', '7812123', 'Bozuk', 'Mas', 'Amasya', NULL, NULL, '2018-10-11', NULL, 'documents/', '636560.jpg', 'Mas Proje', 'deneme', NULL);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `urunsistemtablo`
--
ALTER TABLE `urunsistemtablo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Kullanici_ID` (`Kullanici_ID`) USING BTREE;

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `urunsistemtablo`
--
ALTER TABLE `urunsistemtablo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `urunsistemtablo`
--
ALTER TABLE `urunsistemtablo`
  ADD CONSTRAINT `Foreign_Key` FOREIGN KEY (`Kullanici_ID`) REFERENCES `kullanicidb`.`users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
