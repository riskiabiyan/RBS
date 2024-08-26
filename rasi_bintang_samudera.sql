/*
SQLyog Professional v13.1.1 (64 bit)
MySQL - 10.4.25-MariaDB : Database - rasi_bintang_samudera
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rasi_bintang_samudera` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `rasi_bintang_samudera`;

/*Table structure for table `data_pengiriman` */

DROP TABLE IF EXISTS `data_pengiriman`;

CREATE TABLE `data_pengiriman` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_id` bigint(20) unsigned DEFAULT NULL,
  `jenis_kayu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_kayu` double(8,2) NOT NULL,
  `total_kubikasi` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_pengiriman_surat_id_foreign` (`surat_id`),
  KEY `data_pengiriman_kode_user_foreign` (`kode_user`),
  CONSTRAINT `data_pengiriman_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `users` (`kode_user`) ON DELETE CASCADE,
  CONSTRAINT `data_pengiriman_surat_id_foreign` FOREIGN KEY (`surat_id`) REFERENCES `surat_angkut` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `data_pengiriman` */

insert  into `data_pengiriman`(`id`,`kode_user`,`kode_pengiriman`,`surat_id`,`jenis_kayu`,`jumlah_kayu`,`total_kubikasi`,`created_at`,`updated_at`) values 
(6,'4b95a3cb-1adb-45f9-980c-d94853d35371','f288f099-d3cd-40d5-b4eb-ad17ae3e4669',7,'Kayu Campuran Keras',249.00,1.07,'2024-08-26 02:43:59','2024-08-26 02:44:22');

/*Table structure for table `detail_kayu` */

DROP TABLE IF EXISTS `detail_kayu`;

CREATE TABLE `detail_kayu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kayu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tebal_kayu` double(8,2) NOT NULL,
  `lebar_kayu` double(8,2) NOT NULL,
  `panjang_kayu` double(8,2) NOT NULL,
  `isi_kayu` double(8,2) NOT NULL,
  `m3` double(8,2) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_kayu_kode_user_foreign` (`kode_user`),
  CONSTRAINT `detail_kayu_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `users` (`kode_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `detail_kayu` */

insert  into `detail_kayu`(`id`,`kode_user`,`kode_pengiriman`,`jenis_kayu`,`tebal_kayu`,`lebar_kayu`,`panjang_kayu`,`isi_kayu`,`m3`,`keterangan`,`created_at`,`updated_at`) values 
(206,'4b95a3cb-1adb-45f9-980c-d94853d35371','f288f099-d3cd-40d5-b4eb-ad17ae3e4669','Kayu Campuran Keras',4.00,10.00,100.00,46.00,0.19,NULL,'2024-08-26 02:43:59','2024-08-26 02:43:59'),
(207,'4b95a3cb-1adb-45f9-980c-d94853d35371','f288f099-d3cd-40d5-b4eb-ad17ae3e4669','Kayu Campuran Keras',4.00,10.00,100.00,74.00,0.32,NULL,'2024-08-26 02:43:59','2024-08-26 02:43:59'),
(208,'4b95a3cb-1adb-45f9-980c-d94853d35371','f288f099-d3cd-40d5-b4eb-ad17ae3e4669','Kayu Campuran Keras',4.00,10.00,100.00,34.00,0.14,NULL,'2024-08-26 02:43:59','2024-08-26 02:43:59'),
(209,'4b95a3cb-1adb-45f9-980c-d94853d35371','f288f099-d3cd-40d5-b4eb-ad17ae3e4669','Kayu Campuran Keras',4.00,10.00,100.00,95.00,0.41,NULL,'2024-08-26 02:43:59','2024-08-26 02:43:59');

/*Table structure for table `kendaraan_angkut` */

DROP TABLE IF EXISTS `kendaraan_angkut`;

CREATE TABLE `kendaraan_angkut` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kendaraan_angkut_kode_user_foreign` (`kode_user`),
  CONSTRAINT `kendaraan_angkut_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `users` (`kode_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `kendaraan_angkut` */

insert  into `kendaraan_angkut`(`id`,`kode_user`,`nomor_plat`,`jenis_kendaraan`,`foto_kendaraan`,`created_at`,`updated_at`) values 
(5,'4b95a3cb-1adb-45f9-980c-d94853d35371','H 6643 KQE','Truk','kendaraan/1724481569.jpg','2024-08-24 06:39:29','2024-08-24 06:39:29');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(5,'2014_10_12_000000_create_users_table',1),
(6,'2024_08_21_064432_create_detail_kayu_table',2),
(10,'2024_08_21_080818_create_pbb_table',3),
(11,'2024_08_21_081212_create_kendaraan_angkut_table',4),
(12,'2024_08_21_080601_create_surat_angkut_table',5),
(13,'2024_08_21_080627_create_data_pengiriman_table',6);

/*Table structure for table `pbb` */

DROP TABLE IF EXISTS `pbb`;

CREATE TABLE `pbb` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_pbb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_pbb` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pbb_nomor_pbb_unique` (`nomor_pbb`),
  KEY `pbb_kode_user_foreign` (`kode_user`),
  CONSTRAINT `pbb_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `users` (`kode_user`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pbb` */

insert  into `pbb`(`id`,`kode_user`,`nomor_pbb`,`foto_pbb`,`created_at`,`updated_at`) values 
(10,'4b95a3cb-1adb-45f9-980c-d94853d35371','HJYT55DD78SS','pbb/1724480123.jpg','2024-08-24 06:15:23','2024-08-24 06:15:23'),
(11,'4b95a3cb-1adb-45f9-980c-d94853d35371','44YH77FFII89','pbb/1724480438.jpg','2024-08-24 06:20:38','2024-08-24 06:20:38'),
(12,'4b95a3cb-1adb-45f9-980c-d94853d35371','HGFUIDEER678','pbb/1724480454.jpg','2024-08-24 06:20:54','2024-08-24 06:20:54');

/*Table structure for table `surat_angkut` */

DROP TABLE IF EXISTS `surat_angkut`;

CREATE TABLE `surat_angkut` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pbb_id` bigint(20) unsigned NOT NULL,
  `kendaraan_id` bigint(20) unsigned NOT NULL,
  `kode_pengiriman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_kepemilikan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pengirim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_muat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alat_angkut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_penerima` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hari_berlaku` int(11) NOT NULL,
  `dari_tanggal` date NOT NULL,
  `sampai_tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `surat_angkut_kode_user_foreign` (`kode_user`),
  KEY `surat_angkut_pbb_id_foreign` (`pbb_id`),
  KEY `surat_angkut_kendaraan_id_foreign` (`kendaraan_id`),
  CONSTRAINT `surat_angkut_kendaraan_id_foreign` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan_angkut` (`id`) ON DELETE CASCADE,
  CONSTRAINT `surat_angkut_kode_user_foreign` FOREIGN KEY (`kode_user`) REFERENCES `users` (`kode_user`) ON DELETE CASCADE,
  CONSTRAINT `surat_angkut_pbb_id_foreign` FOREIGN KEY (`pbb_id`) REFERENCES `pbb` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `surat_angkut` */

insert  into `surat_angkut`(`id`,`nomor_surat`,`kode_user`,`pbb_id`,`kendaraan_id`,`kode_pengiriman`,`desa`,`kecamatan`,`kabupaten`,`provinsi`,`bukti_kepemilikan`,`no_bukti`,`nama_pengirim`,`nik_pengirim`,`alamat_pengirim`,`tempat_muat`,`nomor_plat`,`alat_angkut`,`penerima`,`alamat_penerima`,`hari_berlaku`,`dari_tanggal`,`sampai_tanggal`,`created_at`,`updated_at`) values 
(7,'001/RBS/VIII/2024','4b95a3cb-1adb-45f9-980c-d94853d35371',12,5,'f288f099-d3cd-40d5-b4eb-ad17ae3e4669','Mulya kencana','Tulang Bawang Tengah','Mulya kencana','Lampung','PBB','HGFUIDEER678','Riski Abiyantoro','1812012708010002','Panaragan Jaya','Tanggamus','H 6643 KQE','Truk','RASI BINTANG SAMUDERA','Jl. Trunojoyo XIII, Semarang',30,'2024-08-26','2024-09-25','2024-08-26 02:44:22','2024-08-26 02:44:22');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'supplier',
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kabupaten` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_kode_user_unique` (`kode_user`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`kode_user`,`role`,`nama_lengkap`,`nik`,`no_hp`,`desa`,`kecamatan`,`kabupaten`,`provinsi`,`foto_ktp`,`email`,`email_verified_at`,`password`,`created_at`,`updated_at`) values 
(1,'4b95a3cb-1adb-45f9-980c-d94853d35371','supplier','Riski Abiyantoro','1812012708010002','082183170866','Mulya kencana','Tulang Bawang Tengah','Tulang Bawang Barat','Lampung','images/1724226638.jpg','riskiabiyan@gmail.com','2024-08-21 07:50:54','$2y$12$qIZXF8nQOZM4ObsZ.rAtBOUXBiAOY/0edryZR73oJRjaLrOcaP6X2','2024-08-21 07:50:38','2024-08-21 07:50:54'),
(2,'8276a0fe-60fa-4a27-9074-d9c869d94d60','admin','Admin RBS','1812012708010009','087768960745','Padanglarang','Banyumanik','Semarang','Jawa Tengah','images/1724643111.jpg','riskiabiyan41@gmail.com','2024-08-26 03:32:25','$2y$12$rD8yqm8oBidtLMw8CI8QauYGImDKxU9cVHRuE57ojd9R5mOoRMKaG','2024-08-26 03:31:51','2024-08-26 03:32:25');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
