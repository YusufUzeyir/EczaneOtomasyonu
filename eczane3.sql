-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 May 2023, 12:35:39
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eczane3`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hasta`
--

CREATE TABLE `hasta` (
  `id` int(11) NOT NULL,
  `hasta_ad` varchar(50) DEFAULT NULL,
  `hasta_soyad` varchar(50) DEFAULT NULL,
  `cinsiyet` varchar(10) DEFAULT NULL,
  `dogum_tarihi` date DEFAULT NULL,
  `adres` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `hasta`
--

INSERT INTO `hasta` (`id`, `hasta_ad`, `hasta_soyad`, `cinsiyet`, `dogum_tarihi`, `adres`) VALUES
(1, 'Ahmet', 'Yılmaz', 'Erkek', '1980-01-01', 'Ankara'),
(2, 'Ayşe', 'Kaya', 'Kadın', '1990-05-12', 'İstanbul'),
(3, 'Mehmet', 'Demir', 'Erkek', '1985-08-23', 'İzmir'),
(4, 'Zeynep', 'Can', 'Kadın', '1995-02-14', 'Bursa'),
(5, 'Ali', 'Çelik', 'Erkek', '2000-11-03', 'Adana'),
(6, 'Selin', 'Öztürk', 'Kadın', '1998-06-18', 'Antalya'),
(7, 'Kadir', 'Yıldız', 'Erkek', '1992-12-30', 'Ankara'),
(8, 'Aylin', 'Aydın', 'Kadın', '1997-03-07', 'İstanbul'),
(9, 'Emre', 'Arslan', 'Erkek', '1988-09-09', 'Bursa'),
(10, 'Ebru', 'Güneş', 'Kadın', '1993-04-22', 'İzmir');

--
-- Tetikleyiciler `hasta`
--
DELIMITER $$
CREATE TRIGGER `hastaid_sil` BEFORE DELETE ON `hasta` FOR EACH ROW DELETE FROM satis
WHERE hasta_id=OLD.id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hastaid_sil_trigger` BEFORE DELETE ON `hasta` FOR EACH ROW BEGIN
    -- "recete" tablosundan ilgili kayıtları silme
    DELETE FROM sepet WHERE hasta_id = OLD.id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `hasta_ilac_sepet`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `hasta_ilac_sepet` (
`hasta_id` int(11)
,`hasta_ad` varchar(50)
,`hasta_soyad` varchar(50)
,`ilac_adi` varchar(50)
,`adet` int(11)
,`fiyat` decimal(8,2)
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilaclar`
--

CREATE TABLE `ilaclar` (
  `id` int(11) NOT NULL,
  `uretici_firma` varchar(50) DEFAULT NULL,
  `dozaj` varchar(20) DEFAULT NULL,
  `fiyat` decimal(8,2) DEFAULT NULL,
  `ilac_adi` varchar(50) DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `ilaclar`
--

INSERT INTO `ilaclar` (`id`, `uretici_firma`, `dozaj`, `fiyat`, `ilac_adi`, `kategori`) VALUES
(1, 'Bayer', '50mg', 10.50, 'Parol', 'Ağrı Kesici'),
(2, 'Abdi İbrahim', '10mg', 25.00, 'Nexium', 'Mide İlaçları'),
(3, 'Novartis', '100mg', 30.00, 'Atarax', 'Anksiyolitikler'),
(4, 'Pfizer', '250mg', 15.00, 'Keflex', 'Antibiyotikler'),
(5, 'Merck', '5mg', 8.75, 'Lisinopril', 'Kan Basıncı İlaçları'),
(6, 'Pfizer', '100mg', 50.00, 'Zoloft', 'Antidepresanlar'),
(7, 'Johnson & Johnson', '10mg', 20.00, 'Zyrtec', 'Antihistaminikler'),
(8, 'GlaxoSmithKline', '500mg', 12.50, 'Paracetamol', 'Ağrı Kesici'),
(9, 'Janssen', '50mg', 35.00, 'Risperdal', 'Antipsikotikler'),
(10, 'Bayer', '100mg', 50.00, 'Lamictal', 'Antiepileptikler');

--
-- Tetikleyiciler `ilaclar`
--
DELIMITER $$
CREATE TRIGGER `ilac_sil_trigger` BEFORE DELETE ON `ilaclar` FOR EACH ROW BEGIN
    -- "recete" tablosundan ilgili kayıtları silme
    DELETE FROM recete WHERE ilac_id = OLD.id;

    -- "stok" tablosundan ilgili kayıtları silme
    DELETE FROM stok WHERE ilac_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_ilac_stok` AFTER UPDATE ON `ilaclar` FOR EACH ROW BEGIN 
  UPDATE stok 
  SET kategori = NEW.kategori 
  WHERE ilac_id = NEW.id; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_recete_ilac` AFTER UPDATE ON `ilaclar` FOR EACH ROW BEGIN
UPDATE recete
SET ilac_id = NEW.id
WHERE ilac_id = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_ilac` AFTER UPDATE ON `ilaclar` FOR EACH ROW BEGIN
UPDATE stok
SET ilac_id = NEW.id
WHERE ilac_id = OLD.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE `personel` (
  `id` int(11) NOT NULL,
  `personel_ad` varchar(50) DEFAULT NULL,
  `personel_soyad` varchar(50) DEFAULT NULL,
  `cinsiyet` varchar(10) DEFAULT NULL,
  `dogum_tarihi` date DEFAULT NULL,
  `giris_tarih` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `personel`
--

INSERT INTO `personel` (`id`, `personel_ad`, `personel_soyad`, `cinsiyet`, `dogum_tarihi`, `giris_tarih`) VALUES
(1, 'Ahmet', 'Öz', 'Erkek', '1985-01-01', '2010-05-01'),
(2, 'Merve', 'Yılmaz', 'Kadın', '1990-08-15', '2012-03-01'),
(3, 'Can', 'Kara', 'Erkek', '1982-06-20', '2009-10-01'),
(4, 'Fatma', 'Demir', 'Kadın', '1995-02-14', '2021-01-01'),
(5, 'Mustafa', 'Aydın', 'Erkek', '1988-03-10', '2014-07-01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `recete`
--

CREATE TABLE `recete` (
  `id` int(11) NOT NULL,
  `verilen_tarih` date DEFAULT NULL,
  `ilac_id` int(11) DEFAULT NULL,
  `miktar` int(11) DEFAULT NULL,
  `kullanim` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `recete`
--

INSERT INTO `recete` (`id`, `verilen_tarih`, `ilac_id`, `miktar`, `kullanim`) VALUES
(1, '2022-01-15', 1, 2, 'Sabah-Akşam'),
(2, '2022-02-01', 3, 1, 'Sabah-Tok'),
(3, '2022-02-10', 5, 1, 'Akşam-Tok'),
(4, '2022-03-03', 7, 2, 'Sabah-Akşam'),
(5, '2022-04-22', 2, 1, 'Sabah-Aç'),
(6, '2022-05-07', 9, 2, 'Sabah-Akşam'),
(7, '2022-06-01', 4, 1, ' Sabah'),
(8, '2022-06-05', 6, 1, 'Akşam'),
(9, '2022-07-12', 8, 1, 'Akşam-Tok'),
(10, '2022-08-02', 10, 15, 'Sabah-Aç');

--
-- Tetikleyiciler `recete`
--
DELIMITER $$
CREATE TRIGGER `update_stok_ilac_adet` AFTER UPDATE ON `recete` FOR EACH ROW BEGIN
UPDATE stok
SET adet = adet - NEW.miktar
WHERE ilac_id = NEW.ilac_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satis`
--

CREATE TABLE `satis` (
  `hasta_id` int(11) DEFAULT NULL,
  `barkod` varchar(50) DEFAULT NULL,
  `adet` int(11) DEFAULT NULL,
  `fiyat` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `satis`
--

INSERT INTO `satis` (`hasta_id`, `barkod`, `adet`, `fiyat`) VALUES
(8, '10101010', 15, 10.50);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sepet`
--

CREATE TABLE `sepet` (
  `hasta_id` int(11) DEFAULT NULL,
  `barkod` varchar(50) DEFAULT NULL,
  `adet` int(11) DEFAULT NULL,
  `fiyat` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tetikleyiciler `sepet`
--
DELIMITER $$
CREATE TRIGGER `sepet_silme_triggeri` AFTER DELETE ON `sepet` FOR EACH ROW BEGIN
    -- Silinen adeti al
    DECLARE silinen_adet INT;
    SET silinen_adet = OLD.adet;

    -- Stoktaki adeti güncelle ve kontrol et
    UPDATE stok
    SET adet = adet - silinen_adet
    WHERE barkod = OLD.barkod
    AND adet >= silinen_adet;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `sepet_triggeri` AFTER DELETE ON `sepet` FOR EACH ROW BEGIN
    -- Verileri satis tablosuna ekle
    INSERT INTO satis (hasta_id, barkod, adet, fiyat)
    VALUES (OLD.hasta_id, OLD.barkod, OLD.adet, OLD.fiyat);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stok`
--

CREATE TABLE `stok` (
  `barkod` varchar(50) NOT NULL,
  `ilac_id` int(11) DEFAULT NULL,
  `adet` int(11) DEFAULT NULL,
  `fiyat` decimal(8,2) DEFAULT NULL,
  `uretim_tarihi` date DEFAULT NULL,
  `son_kullanim` date DEFAULT NULL,
  `kategori` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `stok`
--

INSERT INTO `stok` (`barkod`, `ilac_id`, `adet`, `fiyat`, `uretim_tarihi`, `son_kullanim`, `kategori`) VALUES
('10101010', 1, 85, 10.50, '2022-01-01', '2023-09-01', 'Ağrı Kesici');

--
-- Tetikleyiciler `stok`
--
DELIMITER $$
CREATE TRIGGER `barkod_sil_trigger` BEFORE DELETE ON `stok` FOR EACH ROW BEGIN
    -- "recete" tablosundan ilgili kayıtları silme
    DELETE FROM sepet WHERE barkod = OLD.barkod;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `stok_adet`
-- (Asıl görünüm için aşağıya bakın)
--
CREATE TABLE `stok_adet` (
`ilac_id` int(11)
,`toplam_adet` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Görünüm yapısı `hasta_ilac_sepet`
--
DROP TABLE IF EXISTS `hasta_ilac_sepet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `hasta_ilac_sepet`  AS SELECT `h`.`id` AS `hasta_id`, `h`.`hasta_ad` AS `hasta_ad`, `h`.`hasta_soyad` AS `hasta_soyad`, `i`.`ilac_adi` AS `ilac_adi`, `s`.`adet` AS `adet`, `s`.`fiyat` AS `fiyat` FROM (((`sepet` `s` join `hasta` `h` on(`s`.`hasta_id` = `h`.`id`)) join `stok` `st` on(`s`.`barkod` = `st`.`barkod`)) join `ilaclar` `i` on(`st`.`ilac_id` = `i`.`id`)) ;

-- --------------------------------------------------------

--
-- Görünüm yapısı `stok_adet`
--
DROP TABLE IF EXISTS `stok_adet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `stok_adet`  AS SELECT `stok`.`ilac_id` AS `ilac_id`, sum(`stok`.`adet`) AS `toplam_adet` FROM `stok` GROUP BY `stok`.`ilac_id` ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `hasta`
--
ALTER TABLE `hasta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_hasta_id` (`id`);

--
-- Tablo için indeksler `ilaclar`
--
ALTER TABLE `ilaclar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ilaclar_id` (`id`);

--
-- Tablo için indeksler `personel`
--
ALTER TABLE `personel`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `recete`
--
ALTER TABLE `recete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_recete_ilac_id` (`ilac_id`);

--
-- Tablo için indeksler `sepet`
--
ALTER TABLE `sepet`
  ADD KEY `idx_sepet_hasta_id` (`hasta_id`),
  ADD KEY `idx_sepet_barkod` (`barkod`);

--
-- Tablo için indeksler `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`barkod`),
  ADD KEY `idx_stok_barkod` (`barkod`),
  ADD KEY `idx_stok_ilac_id` (`ilac_id`);

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `recete`
--
ALTER TABLE `recete`
  ADD CONSTRAINT `recete_ibfk_1` FOREIGN KEY (`ilac_id`) REFERENCES `ilaclar` (`id`);

--
-- Tablo kısıtlamaları `sepet`
--
ALTER TABLE `sepet`
  ADD CONSTRAINT `sepet_ibfk_1` FOREIGN KEY (`hasta_id`) REFERENCES `hasta` (`id`),
  ADD CONSTRAINT `sepet_ibfk_2` FOREIGN KEY (`barkod`) REFERENCES `stok` (`barkod`);

--
-- Tablo kısıtlamaları `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`ilac_id`) REFERENCES `ilaclar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
