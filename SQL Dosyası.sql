-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 05 Ağu 2019, 13:04:25
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `domaintakip`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_link` varchar(200) NOT NULL,
  `site_baslik` varchar(250) NOT NULL,
  `site_aciklama` mediumtext NOT NULL,
  `site_sahibi` varchar(300) NOT NULL,
  `site_logo` varchar(300) NOT NULL,
  `site_mail` varchar(250) NOT NULL,
  `host_adresi` varchar(250) NOT NULL,
  `port_numarasi` int(5) NOT NULL,
  `mail_adresi` varchar(300) NOT NULL,
  `mail_sifre` varchar(200) NOT NULL,
  `sms_kullanici_adi` varchar(300) NOT NULL,
  `sms_sifre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_link`, `site_baslik`, `site_aciklama`, `site_sahibi`, `site_logo`, `site_mail`, `host_adresi`, `port_numarasi`, `mail_adresi`, `mail_sifre`, `sms_kullanici_adi`, `sms_sifre`) VALUES
(1, 'http://kisalink.aksoyhlc.net', 'Aksoyhlc Domain Takip Scripti', 'Aksoyhlc Domain Takip Scripti', 'aksoyhlc@gmail.com', 'img/43871969aksoyhlclogo.png', '27aksoy27@gmail.com', '', 465, '', '', '00000', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `domain`
--

CREATE TABLE `domain` (
  `domain_id` int(11) NOT NULL,
  `domain_adi` varchar(400) NOT NULL,
  `domain_musteri` int(11) NOT NULL,
  `domain_baslangic` varchar(400) NOT NULL,
  `domain_kayit_firmasi` varchar(400) NOT NULL,
  `domain_bitis` varchar(400) NOT NULL,
  `domain_fiyat` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `domain`
--

INSERT INTO `domain` (`domain_id`, `domain_adi`, `domain_musteri`, `domain_baslangic`, `domain_kayit_firmasi`, `domain_bitis`, `domain_fiyat`) VALUES
(6, 'aksoyhlc.net', 7, '2019-12-31', 'Godaddy', '2030-12-31', '100');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(11) NOT NULL,
  `kul_isim` varchar(300) NOT NULL,
  `kul_mail` varchar(300) NOT NULL,
  `kul_sifre` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`) VALUES
(1, 'Ökkeş Aksoy', 'aksoyhlc@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `musteri`
--

CREATE TABLE `musteri` (
  `musteri_id` int(11) NOT NULL,
  `musteri_adi` varchar(400) NOT NULL,
  `musteri_telefon` varchar(400) NOT NULL,
  `musteri_mail` varchar(400) NOT NULL,
  `musteri_not` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `musteri`
--

INSERT INTO `musteri` (`musteri_id`, `musteri_adi`, `musteri_telefon`, `musteri_mail`, `musteri_not`) VALUES
(7, 'Ökkeş Aksoy', '000000000', 'aksoyhlc@gmail.com', '&lt;h2 style=&quot;font-style:italic;&quot;&gt;&lt;strong&gt;Aksoyhlc&lt;/strong&gt;&lt;/h2&gt;\r\n');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `domain`
--
ALTER TABLE `domain`
  ADD PRIMARY KEY (`domain_id`),
  ADD KEY `domain_musteri` (`domain_musteri`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`);

--
-- Tablo için indeksler `musteri`
--
ALTER TABLE `musteri`
  ADD PRIMARY KEY (`musteri_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `domain`
--
ALTER TABLE `domain`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `musteri`
--
ALTER TABLE `musteri`
  MODIFY `musteri_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `domain`
--
ALTER TABLE `domain`
  ADD CONSTRAINT `domain_ibfk_1` FOREIGN KEY (`domain_musteri`) REFERENCES `musteri` (`musteri_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
