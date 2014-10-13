-- MySQL dump 10.13  Distrib 5.6.20, for osx10.7 (x86_64)
--
-- Host: localhost    Database: caketest
-- ------------------------------------------------------
-- Server version	5.6.20

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `event_comments`
--

DROP TABLE IF EXISTS `event_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_comments`
--

LOCK TABLES `event_comments` WRITE;
/*!40000 ALTER TABLE `event_comments` DISABLE KEYS */;
INSERT INTO `event_comments` VALUES (1,NULL,19,'コメントだよんだよん\r\nだよん','2014-02-09 18:15:47'),(2,NULL,19,'コメントだよんだよん\r\nだよん','2014-02-09 18:16:09'),(3,1,19,'テスト投稿ですん。\r\nわー','2014-02-09 18:17:53'),(4,2,19,'投稿あ\r\nああああ\r\n\r\nあ','2014-02-09 18:18:26'),(5,1,19,'コメント２','2014-02-13 14:08:15'),(6,10,19,'ああああ１','2014-02-13 17:46:15'),(7,10,19,'ああああ２','2014-02-13 17:46:24'),(8,10,19,'<script>alert(\'aaaa\');</script>','2014-02-15 10:41:54'),(9,10,19,'don\'t speak Japanese.','2014-02-15 10:43:53'),(10,10,19,'\' OR 1=1--','2014-02-15 10:47:13'),(11,14,19,'コメント','2014-02-15 22:41:42'),(12,16,19,'あああ','2014-02-17 16:28:45'),(13,16,19,'あああ','2014-02-17 16:31:05'),(14,16,19,'あああ','2014-02-17 17:17:58'),(15,22,19,'ああああ','2014-02-26 22:57:38'),(16,22,19,'22222\r\nw22','2014-02-27 00:20:59');
/*!40000 ALTER TABLE `event_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `place_name` varchar(255) DEFAULT NULL,
  `prefecture` int(6) DEFAULT NULL,
  `place_address` varchar(255) DEFAULT NULL,
  `place_latitude` double DEFAULT NULL,
  `place_longitude` double DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `wanted` int(6) DEFAULT NULL,
  `wanted_max` int(6) DEFAULT NULL,
  `body` mediumtext,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `event_time` time DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_end` time DEFAULT NULL,
  `participant` int(6) DEFAULT NULL,
  `uncertain` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,NULL,NULL,'SFC新入生オフ','テラスモール湘南',14,'藤沢市辻堂',0,0,NULL,10,20,'内容だよん\r\n内容\r\nあああ\r\n\r\nあ','2014-02-08 21:58:11','2014-02-08 21:58:11',NULL,NULL,NULL,NULL,NULL),(2,19,0,'テスト２','船橋',12,'船橋市西船橋',0,0,NULL,20,30,'あああ\r\n\r\nああ\r\nあ','2014-02-08 22:57:43','2014-02-08 22:57:43',NULL,NULL,NULL,NULL,NULL),(3,19,0,'湘南台オフ','食彩ガーデン',14,'神奈川県藤沢市湘南台２丁目７−１５',35.39687910000001,139.46374879999996,NULL,5,6,'湘南台の皆様オフ会しよ','2014-02-12 00:03:23','2014-02-12 00:03:23',NULL,NULL,NULL,NULL,NULL),(4,19,0,'さむい','旭川駅',1,'旭川',43.7706355,142.364819,NULL,1,4,'本文ああああ2014/02/13 16:09てS苞','2014-02-13 16:09:29','2014-02-13 16:09:29',NULL,NULL,NULL,NULL,NULL),(5,19,0,'わわわ','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:28:10','2014-02-13 17:28:10',NULL,NULL,NULL,NULL,NULL),(6,19,0,'わわわ','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:32:30','2014-02-13 17:32:30',NULL,NULL,NULL,NULL,NULL),(7,19,0,'わわわ','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:38:08','2014-02-13 17:38:08',NULL,NULL,NULL,NULL,NULL),(8,19,0,'わわわ','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:38:49','2014-02-13 17:38:49',NULL,NULL,NULL,NULL,NULL),(9,19,0,'わわわ','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:42:43','2014-02-13 17:42:43',NULL,NULL,NULL,NULL,NULL),(10,19,0,'わわわ2','東京タワー',13,'東京タワー',35.6585805,139.74543289999997,NULL,1,2,'てすと\r\nあああ\r\n\r\nあてすと\r\nあてすと２','2014-02-13 17:44:32','2014-02-13 17:44:32',NULL,NULL,NULL,NULL,NULL),(11,19,0,'あ','あ',1,'船橋',38.807112120217596,152.0675789375,NULL,1,1,'ｓ','2014-02-15 11:16:50','2014-02-15 11:16:50',NULL,NULL,NULL,NULL,NULL),(12,19,0,'時刻のテストです','首里城',47,'沖縄',26.2124013,127.68093169999997,NULL,3,2,'時間のテストです。\r\nふにゃんふにゃん\r\nあ','2014-02-15 16:01:27','2014-02-15 16:01:27','20:00:00',NULL,NULL,NULL,NULL),(13,19,0,'時刻のテストです2','首里城',41,'沖縄',26.2124013,127.68093169999997,NULL,3,2,'時間のテストです。\r\nふにゃんふにゃん\r\nあ','2014-02-15 16:06:10','2014-02-15 16:06:10','20:00:00','2014-03-07',NULL,NULL,NULL),(14,19,0,'日付のテスト','江ノ島',14,'江ノ島',35.299925,139.48087599999997,NULL,4,7,'ぬわーぬわぬわ','2014-02-15 22:41:05','2014-02-15 22:41:05','19:30:00','2014-02-20',NULL,NULL,NULL),(16,20,0,'ユーザーのテスト','あきたこまち食べたい',5,'秋田',39.7200079,140.10256419999996,NULL,4,6,'飽きた\r\nもう飽きた','2014-02-17 12:57:01','2014-02-17 12:57:01','12:00:00','2014-02-28',NULL,NULL,NULL),(18,19,0,'フラッシュメッセージのテスト','札幌時計台',1,'札幌時計台',42.9978443,141.35074629999997,NULL,4,10,'ぬわんぬわん','2014-02-17 16:40:58','2014-02-17 16:40:58','04:00:00','2014-02-21',NULL,1,0),(22,19,NULL,'追加ページのテスト','アローム',14,'神奈川県藤沢市湘南台２丁目１−１',35.3972458,139.46486260000006,NULL,10,20,'<font face=\"Arial Black\" size=\"5\">ようこそ</font><div><font face=\"Arial Black\" size=\"5\"><br /></font></div><div>いよいよウェブは新しい時代が始まります！</div><div><br /></div><div><br /></div><div>さあ、未来へ旅立とう。！</div>','2014-02-22 01:02:12','2014-02-22 01:02:12','10:30:00','2014-03-01','13:00:00',2,0);
INSERT INTO `events` VALUES (24,19,NULL,'バリデーション','ラシェットブランシュ湘南',14,'神奈川県茅ヶ崎市松が丘２丁目８−４２',35.3251253,139.4228713,NULL,1,20,'あ\n    ','2014-02-22 12:59:26','2014-02-22 12:59:26','03:00:00','2014-03-07','05:00:00',NULL,NULL),(25,19,NULL,'バリ２','東京タワー',13,'東京都港区芝公園4-2-8',35.6587039,139.74540809999996,NULL,10,20,'あ\n    ','2014-02-22 13:13:24','2014-02-22 13:13:24','07:00:00','2014-02-28','08:00:00',NULL,NULL),(26,19,NULL,'バリ２','東京タワー',13,'東京都港区芝公園4-2-8',35.6587039,139.74540809999996,NULL,10,20,'あ','2014-02-22 13:20:01','2014-02-22 13:20:01','07:00:00','2014-02-28','08:00:00',NULL,NULL),(27,19,NULL,'バリ２','東京タワー',13,'東京都港区芝公園4-2-8',35.6587039,139.74540809999996,NULL,10,20,'あ\n    ','2014-02-22 13:24:02','2014-02-22 13:24:02','07:00:00','2014-02-28','08:00:00',NULL,NULL),(28,19,NULL,'バり３','東京タワー',13,'東京都港区芝公園4-2-8',35.6587039,139.74540809999996,NULL,10,20,'あ\n    ','2014-02-22 13:26:24','2014-02-22 13:26:24','07:00:00','2014-02-28','08:00:00',NULL,NULL),(29,19,NULL,'バり４','東京タワー',13,'東京都港区芝公園4-2-8',35.6587039,139.74540809999996,NULL,10,20,'あ\n    ','2014-02-22 13:27:59','2014-02-22 13:27:59','07:00:00','2014-02-28','08:00:00',NULL,NULL),(30,19,NULL,'バリ５','みなとみらい駅',14,'神奈川県横浜市西区みなとみらい３丁目５',35.4578894,139.63193649999994,NULL,10,20,'あ\n    ','2014-02-22 13:34:48','2014-02-22 13:34:48','03:00:00','2014-02-28','07:00:00',1,0),(31,19,NULL,'バリ６','みなとみらい駅',14,'神奈川県横浜市西区みなとみらい３丁目５',35.4578894,139.63193649999994,NULL,10,20,'\n    <div>あ</div>','2014-02-22 14:44:53','2014-02-22 14:44:53','03:00:00','2014-02-28','07:00:00',NULL,NULL),(32,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'これはテストです。','2014-02-24 15:14:49','2014-02-24 15:14:49','09:00:00','2014-03-01','08:00:00',NULL,NULL),(33,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:14:58','2014-02-24 15:14:58','09:00:00','2014-03-01','08:00:00',NULL,NULL),(34,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:03','2014-02-24 15:15:03','09:00:00','2014-03-01','08:00:00',NULL,NULL),(35,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:06','2014-02-24 15:15:06','09:00:00','2014-03-01','08:00:00',NULL,NULL),(36,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:10','2014-02-24 15:15:10','09:00:00','2014-03-01','08:00:00',NULL,NULL),(37,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:14','2014-02-24 15:15:14','09:00:00','2014-03-01','08:00:00',NULL,NULL),(38,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:17','2014-02-24 15:15:17','09:00:00','2014-03-01','08:00:00',NULL,NULL),(39,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:21','2014-02-24 15:15:21','09:00:00','2014-03-01','08:00:00',NULL,NULL),(40,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:24','2014-02-24 15:15:24','09:00:00','2014-03-01','08:00:00',NULL,NULL),(41,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:28','2014-02-24 15:15:28','09:00:00','2014-03-01','08:00:00',NULL,NULL),(42,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:32','2014-02-24 15:15:32','09:00:00','2014-03-01','08:00:00',NULL,NULL),(43,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:36','2014-02-24 15:15:36','09:00:00','2014-03-01','08:00:00',NULL,NULL),(44,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:39','2014-02-24 15:15:39','09:00:00','2014-03-01','08:00:00',NULL,NULL),(45,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:43','2014-02-24 15:15:43','09:00:00','2014-03-01','08:00:00',NULL,NULL),(46,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:48','2014-02-24 15:15:48','09:00:00','2014-03-01','08:00:00',NULL,NULL),(47,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:52','2014-02-24 15:15:52','09:00:00','2014-03-01','08:00:00',NULL,NULL),(48,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:15:57','2014-02-24 15:15:57','09:00:00','2014-03-01','08:00:00',NULL,NULL),(49,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:16:02','2014-02-24 15:16:02','09:00:00','2014-03-01','08:00:00',NULL,NULL),(50,19,NULL,'テストタグを大量投下するテスト','箱根湯本',14,'神奈川県足柄下郡箱根町湯本６９８',35.2319524,139.10260730000005,NULL,10,320,'\n    ','2014-02-24 15:16:06','2014-02-24 15:16:06','09:00:00','2014-03-01','08:00:00',NULL,NULL),(51,19,NULL,'テスト','海浜公園',14,'神奈川県藤沢市辻堂西海岸３丁目２',35.3209872,139.44856730000004,NULL,10,20,'画像のテス<div><br /></div><div><br /></div><div></div>','2014-02-28 23:04:27','2014-02-28 23:04:27','05:00:00','2014-03-06','09:00:00',1,0),(52,19,NULL,'あああ','アローム',14,'神奈川県藤沢市湘南台２丁目１−１',35.3972458,139.46486260000006,NULL,101,NULL,'あ<font size=\"5\">あああ</font>\n    <div><font size=\"5\"><br /></font></div><div><font size=\"5\"><br /></font></div><div><font size=\"5\">ｓｒｇｓｒｇ</font></div><div></div>','2014-03-21 16:48:58','2014-03-21 16:48:58','09:00:00','2014-04-07','08:00:00',1,0),(53,19,NULL,'あああ','アローム',14,'神奈川県藤沢市湘南台２丁目１−１',35.3972458,139.46486260000006,NULL,101,NULL,'ああああ\n    ','2014-03-21 16:49:14','2014-03-21 16:49:14','09:00:00','2014-04-07','08:00:00',1,0),(54,19,NULL,'あきた','かずどん',14,'神奈川県藤沢市湘南台１丁目１０−６',35.3966486,139.46914849999996,NULL,10,20,'あああ\n    ','2014-04-07 20:46:53','2014-04-07 20:46:53','06:00:00','2014-05-21','09:00:00',1,0),(55,19,NULL,'新しい','湘南藤沢',14,'神奈川県藤沢市辻堂新町4丁目3-5 ',35.3397223,139.46409110000002,NULL,10,3,'あ<font size=\"5\">ああ</font><div><font size=\"5\"><br /></font></div><div><font size=\"5\">aaa</font></div><div><font size=\"5\"><br /></font></div><div><font size=\"5\">adevav</font></div><div><font size=\"5\"><br /></font></div>','2014-04-10 11:34:30','2014-04-10 11:34:30','06:00:00','2014-04-17','06:00:00',1,0),(56,19,NULL,'イベント','アローム',14,'神奈川県藤沢市湘南台２丁目１−１',35.3972458,139.46486260000006,NULL,10,2,'ああ<font face=\"Arial\" size=\"5\">ああ「</font>','2014-04-10 13:32:01','2014-04-10 13:32:01','03:00:00','2014-04-24','07:00:00',1,0),(57,19,NULL,'あたらしい','ざんまい',14,'神奈川県藤沢市湘南台４丁目８−１１',35.3976596,139.46427100000005,NULL,10,20,'<font size=\"5\">a</font>\n    ','2014-05-01 17:33:11','2014-05-01 17:33:11','05:00:00','2014-05-15','05:00:00',1,0),(58,19,NULL,'Web技術勉強会','湘南藤沢キャンパス',14,'神奈川県藤沢市遠藤５３２２',35.3882757,139.42734819999998,NULL,10,20,'てｓｔ\n    <div><br /></div>','2014-06-04 20:15:16','2014-06-04 20:15:16','18:00:00','2014-06-11','21:00:00',1,0),(59,19,NULL,'ああああ','マークシティ',13,'東京都渋谷区道玄坂1-12-5 渋谷マークシティRESTAURANTS AVENUE 4F',35.6575054,139.69664309999996,NULL,4,5,'あああ\n    <div>ああ</div><div>あ</div>','2014-08-06 17:20:22','2014-08-06 17:20:22','05:00:00','2014-08-07','07:00:00',1,0);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_tags`
--

DROP TABLE IF EXISTS `events_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_tags`
--

LOCK TABLES `events_tags` WRITE;
/*!40000 ALTER TABLE `events_tags` DISABLE KEYS */;
INSERT INTO `events_tags` VALUES (1,8,4),(2,9,4),(3,10,1),(4,10,2),(5,10,3),(6,10,4),(7,11,1),(8,11,2),(11,12,1),(12,12,2),(13,12,7),(14,13,1),(15,13,2),(16,13,7),(17,14,1),(18,14,2),(19,14,8),(24,16,1),(25,16,2),(26,16,10),(30,18,1),(31,18,2),(32,18,12),(37,22,14),(38,22,4),(39,24,4),(40,25,4),(41,26,4),(42,27,4),(43,28,4),(44,29,4),(45,30,4),(46,31,4),(47,32,4),(48,33,4),(49,34,4),(50,35,4),(51,36,4),(52,37,4),(53,38,4),(54,39,4),(55,40,4),(56,41,4),(57,42,4),(58,43,4),(59,44,4),(60,45,4),(61,46,4),(62,47,4),(63,48,4),(64,49,4),(65,50,4),(66,52,1),(67,52,14),(68,53,1),(69,53,14),(70,54,10),(71,54,2),(72,55,4),(73,56,1),(74,57,1),(75,59,1),(76,59,15);
/*!40000 ALTER TABLE `events_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events_users`
--

DROP TABLE IF EXISTS `events_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events_users`
--

LOCK TABLES `events_users` WRITE;
/*!40000 ALTER TABLE `events_users` DISABLE KEYS */;
INSERT INTO `events_users` VALUES (14,18,19,1),(19,16,19,2),(23,22,19,1),(24,23,19,1),(25,24,19,1),(26,25,19,1),(27,26,19,1),(28,27,19,1),(29,28,19,1),(30,29,19,1),(31,30,19,1),(32,31,19,1),(34,2,20,2),(35,3,20,2),(36,4,20,2),(37,5,20,2),(38,6,20,2),(39,7,20,2),(40,8,20,2),(41,9,20,2),(42,10,20,2),(43,11,20,2),(44,12,20,2),(45,13,20,2),(46,14,20,2),(47,32,19,1),(48,33,19,1),(49,34,19,1),(50,35,19,1),(51,36,19,1),(52,37,19,1),(53,38,19,1),(54,39,19,1),(55,40,19,1),(56,41,19,1),(57,42,19,1),(58,43,19,1),(59,44,19,1),(60,45,19,1),(61,46,19,1),(62,47,19,1),(63,48,19,1),(64,49,19,1),(65,50,19,1),(67,1,20,3),(78,22,20,2),(79,51,19,1),(80,52,19,1),(81,53,19,1),(82,54,19,1),(83,55,19,1),(84,56,19,1),(85,57,19,1),(86,58,19,1),(87,59,19,1);
/*!40000 ALTER TABLE `events_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` text,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_tags`
--

DROP TABLE IF EXISTS `messages_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_tags`
--

LOCK TABLES `messages_tags` WRITE;
/*!40000 ALTER TABLE `messages_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'タイトル','これは、記事の本文です。','2013-12-24 23:19:58','2013-12-28 09:46:17'),(2,'またタイトル','そこに本文が続きます。','2013-12-24 23:20:06',NULL),(3,'タイトルの逆襲','こりゃ本当にわくわくする！うそ。','2013-12-24 23:20:07',NULL),(5,'a','berb','2014-01-24 16:25:30','2014-01-24 16:25:30');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Tag1',1,'2014-02-13 17:28:10'),(2,'Tag2',0,'2014-02-13 17:38:50'),(3,'ソーシャルメディア',1,'2014-02-13 17:38:50'),(4,'テスト',2,'2014-02-13 17:38:50'),(7,'南国',1,'2014-02-15 16:01:28'),(8,'湘南',0,'2014-02-15 22:41:05'),(9,'農業',0,'2014-02-17 12:45:41'),(10,'秋田',1,'2014-02-17 12:57:01'),(11,'水戸黄門',0,'2014-02-17 15:38:53'),(12,'雪国',1,'2014-02-17 16:40:58'),(13,'',0,'2014-02-18 21:15:13'),(14,'新規タグ',1,'2014-02-18 22:16:07'),(15,'タグ',0,'2014-08-06 17:20:22');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `twitter_user_id` varchar(20) DEFAULT NULL,
  `twitter_screen_name` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `oauth_token` varchar(100) DEFAULT NULL,
  `oauth_token_secret` varchar(100) DEFAULT NULL,
  `profile_image_url` varchar(120) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_body` text,
  `prefecture` int(6) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,NULL,'testuser',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2014-01-03 18:01:14','2014-01-03 18:01:14'),(19,'544281276','Tak0002','World Wide Ｗatanabe','544281276-s8PCS0xW0YpThqtuNcptMTIUaw5DFkWwmlXFHd4d','NBauYhVFSbi5JoSwtwUYt4p0nZ9PcCvawkaRTriQ9Yfit','http://pbs.twimg.com/profile_images/427006639472771072/DCshQ6p2_normal.png',NULL,'\n        \n        \n        \n        \n        \n        \n        \n        \n        <div style=\"text-align:center;\"><span style=\"font-size:x-large;\">ああああ</span></div><div style=\"text-align:center;\"></div><div style=\"text-align:center;\"></div><div style=\"text-align:center;\"></div><div style=\"text-align:center;\"></div><div style=\"text-align:center;\"></div><div style=\"text-align:right;\"></div><img src=\"data:image/png;base64,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vj5DbBD/AsPADEFIVBlSjcpsf3kJLYdMITt2POX+XtYsfIan7rmDz9WWGNO2iSiJGOmVQsURVRIiUgwUA14aPYZds6ZTn66BBUvJ7N1F0NSAIKhGBFQRIBTPQG+JfhM0CBEbxL/IMAQhjmOCIGDzuvUs/94XaRhWS77lELav3sCGtVuYNXUiM7e/xf7dZUbnKpAYUQXKkVHUkFI54JXhI9h85ESaXIrwlVWkO7uIfUA6HZDJhORSQlAoYcQkiaPPHAMJiA3iX6CAquIR1BJEoH39+/SvXkZp3zr2rV1H++4uDpwxi0lvLqVz2btkswHNqRJRLFRjTzESihpQraZYnM+ybmILY3P15FZsIt1XQGIj641sTYpMLkWuVASqFCPoR4hcmv8FFmSrXchJtkUAAAAASUVORK5CYIIgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA=\">    <div><br /></div><div>ああああ</div><div><br /></div><div><br /></div><div>うぇｇｒｗｇｗｒｇうぇｒ</div>    ',NULL,NULL,'2014-01-03 23:09:59','2014-10-13 16:19:11'),(20,'607038888','komodo_dake','コモド島','607038888-LtRGhrCfh4sqUrW711fr1BzDdpwiu4LhKsCp8udG','kWGXVc8H7X8UOgkx3pXi4J1c4A6Nmq59OBp2T4zveHK2h','http://pbs.twimg.com/profile_images/3328465017/3355fb53844ccb66d22c7a64f4eefb9a_normal.png',NULL,NULL,NULL,NULL,'2014-01-03 23:11:32','2014-02-26 22:22:00'),(21,'1567701752','Tak00002','Ｗ','1567701752-PXgc8hXz0sZ7keHMrKPJChdgB91Y0DHqae8I4Jt','GIcKPXxuLkHe7FbHxnzvSqZuoEljtqTGOhOhZ2hhfhRla','http://pbs.twimg.com/profile_images/378800000085912059/9e59ae707eb5bb0a071de76f5bbc4de0_normal.png',NULL,NULL,NULL,NULL,'2014-02-13 09:42:51','2014-02-25 23:11:52'),(22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,'2014-02-27 15:27:33','2014-02-27 15:27:33'),(23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'あああああ\n            ',NULL,NULL,'2014-02-27 15:28:51','2014-02-27 15:28:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_tags`
--

DROP TABLE IF EXISTS `users_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_tags`
--

LOCK TABLES `users_tags` WRITE;
/*!40000 ALTER TABLE `users_tags` DISABLE KEYS */;
INSERT INTO `users_tags` VALUES (6,19,4),(7,20,1),(8,19,7),(9,19,12),(11,19,3),(12,19,14),(14,19,10);
/*!40000 ALTER TABLE `users_tags` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-13 22:52:03