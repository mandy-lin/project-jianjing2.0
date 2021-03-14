-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-06-11 16:32:33
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `1`
--

-- --------------------------------------------------------

--
-- 資料表結構 `client`
--

CREATE TABLE `client` (
  `c_no` int(4) NOT NULL COMMENT '大樓編號',
  `c_name` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '大樓名稱',
  `c_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電話',
  `address_num` int(5) DEFAULT NULL COMMENT '郵遞區號',
  `address` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '地址',
  `payment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '收款方式',
  `editor` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '統一編號',
  `invoice` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '發票',
  `c_status` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '客戶狀態',
  `c_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '備註',
  `floorplan` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '平面圖'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `client_connection`
--

CREATE TABLE `client_connection` (
  `co_no` int(5) NOT NULL COMMENT '聯絡人主鍵',
  `zhu_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '主委姓名',
  `zhu_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '主委電話',
  `zhu_conn` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '主委聯絡方式',
  `cai_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '財委姓名',
  `cai_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '財委電話',
  `cai_conn` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '財委聯絡方式',
  `jian_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '監委姓名',
  `jian_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '監委電話',
  `jian_conn` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '監委其他聯絡方式',
  `ganshi_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '總幹事姓名',
  `ganshi_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '總幹事電話',
  `ganshi_conn` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '總幹事其他聯絡方式',
  `admin_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理員姓名',
  `admin_phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理員電話',
  `admin_conn` text COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '管理員其他聯絡方式',
  `co_date` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '年分',
  `c_no` int(4) NOT NULL COMMENT '大樓編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `contact_person`
--

CREATE TABLE `contact_person` (
  `c_no` int(4) NOT NULL COMMENT '客戶外來鍵',
  `other_no` int(4) NOT NULL COMMENT '聯絡人編號',
  `other_name` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡人姓名',
  `other_phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡人電話',
  `other_conn` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡人其他聯絡方式'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `contract`
--

CREATE TABLE `contract` (
  `con_no` int(10) NOT NULL COMMENT '合約編號',
  `con_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '合約名稱',
  `con_total_amount` int(8) DEFAULT NULL COMMENT '總金額',
  `con_prefer_total` int(8) DEFAULT NULL COMMENT '優惠總金額',
  `start_date` date NOT NULL COMMENT '起始日',
  `end_date` date NOT NULL COMMENT '結束日',
  `maintimes` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '保養次數',
  `duty` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '責任',
  `con_status` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '合約狀態',
  `con_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '備註',
  `con_img` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '責任附表圖',
  `con_file` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '合約電子檔',
  `con_tax` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '未含稅',
  `c_no` int(4) DEFAULT NULL COMMENT '客戶外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `contract_content`
--

CREATE TABLE `contract_content` (
  `con_id` int(4) NOT NULL COMMENT '合約內容編號',
  `con_device` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '設備',
  `con_date` varchar(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '日期',
  `con_duty` varchar(4) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '責任',
  `con_num` int(3) NOT NULL COMMENT '數量',
  `con_price` int(4) NOT NULL COMMENT '單價',
  `con_total` int(5) NOT NULL COMMENT '總價',
  `con_no` int(10) NOT NULL COMMENT '合約外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `fix`
--

CREATE TABLE `fix` (
  `f_no` int(5) NOT NULL COMMENT '維修編號',
  `f_date` date DEFAULT NULL COMMENT '維修日期',
  `f_device` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '設備',
  `f_situation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '故障情形',
  `f_reason` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '故障原因',
  `f_person1` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務人員1',
  `f_person2` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務人員2',
  `f_img` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '維修圖',
  `c_no` int(4) NOT NULL COMMENT '客戶外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `fix_components`
--

CREATE TABLE `fix_components` (
  `f_no` int(5) NOT NULL COMMENT '維修外來鍵',
  `f_co_no` int(5) NOT NULL COMMENT '更新零件編號',
  `f_snuma` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務編號',
  `f_detail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '更新零件內容',
  `f_price` int(8) DEFAULT NULL COMMENT '更新零件價格',
  `f_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '更新零件備註',
  `com_no` int(6) DEFAULT NULL COMMENT '零件編號'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `fix_content`
--

CREATE TABLE `fix_content` (
  `f_no` int(5) NOT NULL COMMENT '維修外來鍵',
  `f_c_no` int(5) NOT NULL COMMENT '維修內容編號',
  `f_snum` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務編號',
  `f_content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '維修內容',
  `pro_no` int(4) DEFAULT NULL COMMENT '服務編號'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `maintain`
--

CREATE TABLE `maintain` (
  `m_no` int(12) NOT NULL COMMENT '保養編號',
  `m_month` varchar(7) NOT NULL,
  `m_date` date NOT NULL COMMENT '保養日期',
  `m_device` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '保養設備',
  `m_device1` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '保養機種',
  `m_recode` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '備考紀錄(工作說明)',
  `m_suggest` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '建議事項',
  `m_person_1` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務人員1',
  `m_person_2` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務人員2',
  `m_img` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '圖片',
  `m_status` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '狀態',
  `c_no` int(5) NOT NULL COMMENT '客戶外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `maintain_content`
--

CREATE TABLE `maintain_content` (
  `m_no` int(12) NOT NULL COMMENT '保養外來鍵',
  `m_c_no` int(5) NOT NULL COMMENT '保養項目編號',
  `m_c_1` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_2` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_3` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_4` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_5` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_6` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_7` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_8` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_9` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_10` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_11` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_12` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_13` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_14` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_15` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_16` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_17` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_18` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_19` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_20` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_21` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_22` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_23` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_24` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_25` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_26` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_27` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_28` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_29` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_30` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_31` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_32` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_33` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_c_34` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `price`
--

CREATE TABLE `price` (
  `p_no` int(5) NOT NULL COMMENT '報價編號',
  `p_num` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '報價單流水號',
  `p_date` date DEFAULT NULL COMMENT '報假日期',
  `p_status` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '狀態',
  `p_kind` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '設備',
  `p_total_amount` int(8) DEFAULT NULL COMMENT '總金額',
  `p_prefer_total` int(8) DEFAULT NULL COMMENT '優惠總金額',
  `p_tax` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '未含稅',
  `p_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '備註',
  `p_contont` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '內容',
  `c_no` int(4) NOT NULL COMMENT '客戶外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `price_content`
--

CREATE TABLE `price_content` (
  `p_id` int(5) NOT NULL COMMENT '報價內容編號',
  `p_snum` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '服務編號',
  `p_device` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '設備',
  `p_num` int(3) DEFAULT NULL COMMENT '數量',
  `p_price` int(8) DEFAULT NULL COMMENT '單價',
  `p_total` int(8) DEFAULT NULL COMMENT '總價',
  `p_no` int(5) DEFAULT NULL COMMENT '報價外來鍵'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `c_no` int(4) NOT NULL COMMENT '客戶外來鍵',
  `pro_no` int(4) NOT NULL COMMENT '產品編號',
  `pro_kind` varchar(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '機種',
  `pro_num` int(3) DEFAULT NULL COMMENT '數量',
  `pro_price` int(8) DEFAULT NULL COMMENT '保養費',
  `pro_duty` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '責任',
  `pro_amount` int(3) DEFAULT NULL COMMENT '控制器數量',
  `park` varchar(17) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '機械式停車設備',
  `drivemethod` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '驅動方式',
  `transmisson` varchar(9) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '傳動元件',
  `elevator` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '升降機',
  `turntable` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '旋轉台'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- 資料表結構 `region`
--

CREATE TABLE `region` (
  `re_no` int(5) NOT NULL COMMENT '車區主鍵',
  `re_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '服務編號',
  `pro_no` int(4) DEFAULT NULL COMMENT '產品編號',
  `re_name` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '車區名稱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `region_components`
--

CREATE TABLE `region_components` (
  `com_no` int(6) NOT NULL COMMENT '零件編號',
  `com_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '零件名稱',
  `com_size` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '零件尺寸',
  `re_no` int(4) DEFAULT NULL COMMENT '車區主鍵'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `worker`
--

CREATE TABLE `worker` (
  `w_id` int(10) NOT NULL COMMENT '工作人員主鍵',
  `w_name` varchar(4) COLLATE utf8_unicode_ci NOT NULL COMMENT '工作人員'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`c_no`);

--
-- 資料表索引 `client_connection`
--
ALTER TABLE `client_connection`
  ADD PRIMARY KEY (`co_no`),
  ADD KEY `c_no` (`c_no`);

--
-- 資料表索引 `contact_person`
--
ALTER TABLE `contact_person`
  ADD PRIMARY KEY (`other_no`),
  ADD KEY `c_no` (`c_no`);

--
-- 資料表索引 `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`con_no`),
  ADD KEY `c_no` (`c_no`);

--
-- 資料表索引 `contract_content`
--
ALTER TABLE `contract_content`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `con_no` (`con_no`);

--
-- 資料表索引 `fix`
--
ALTER TABLE `fix`
  ADD PRIMARY KEY (`f_no`),
  ADD KEY `f_c_no` (`c_no`);

--
-- 資料表索引 `fix_components`
--
ALTER TABLE `fix_components`
  ADD PRIMARY KEY (`f_co_no`),
  ADD KEY `f_no` (`f_no`),
  ADD KEY `pro_no` (`com_no`);

--
-- 資料表索引 `fix_content`
--
ALTER TABLE `fix_content`
  ADD PRIMARY KEY (`f_c_no`),
  ADD KEY `f_no` (`f_no`),
  ADD KEY `pro_no` (`pro_no`);

--
-- 資料表索引 `maintain`
--
ALTER TABLE `maintain`
  ADD PRIMARY KEY (`m_no`),
  ADD KEY `m_c_no` (`c_no`);

--
-- 資料表索引 `maintain_content`
--
ALTER TABLE `maintain_content`
  ADD PRIMARY KEY (`m_c_no`),
  ADD KEY `m_no` (`m_no`);

--
-- 資料表索引 `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`p_no`),
  ADD KEY `p_id` (`c_no`);

--
-- 資料表索引 `price_content`
--
ALTER TABLE `price_content`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `p_no` (`p_no`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_no`),
  ADD KEY `c_no` (`c_no`);

--
-- 資料表索引 `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`re_no`),
  ADD KEY `pro_no` (`pro_no`);

--
-- 資料表索引 `region_components`
--
ALTER TABLE `region_components`
  ADD PRIMARY KEY (`com_no`),
  ADD KEY `re_no` (`re_no`);

--
-- 資料表索引 `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`w_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `client`
--
ALTER TABLE `client`
  MODIFY `c_no` int(4) NOT NULL AUTO_INCREMENT COMMENT '大樓編號', AUTO_INCREMENT=2147483648;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `client_connection`
--
ALTER TABLE `client_connection`
  MODIFY `co_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '聯絡人主鍵';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contact_person`
--
ALTER TABLE `contact_person`
  MODIFY `other_no` int(4) NOT NULL AUTO_INCREMENT COMMENT '聯絡人編號', AUTO_INCREMENT=73;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contract`
--
ALTER TABLE `contract`
  MODIFY `con_no` int(10) NOT NULL AUTO_INCREMENT COMMENT '合約編號', AUTO_INCREMENT=2005121526;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `contract_content`
--
ALTER TABLE `contract_content`
  MODIFY `con_id` int(4) NOT NULL AUTO_INCREMENT COMMENT '合約內容編號', AUTO_INCREMENT=106;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fix`
--
ALTER TABLE `fix`
  MODIFY `f_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '維修編號', AUTO_INCREMENT=2005131022;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fix_components`
--
ALTER TABLE `fix_components`
  MODIFY `f_co_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '更新零件編號', AUTO_INCREMENT=91;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `fix_content`
--
ALTER TABLE `fix_content`
  MODIFY `f_c_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '維修內容編號', AUTO_INCREMENT=110;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `maintain`
--
ALTER TABLE `maintain`
  MODIFY `m_no` int(12) NOT NULL AUTO_INCREMENT COMMENT '保養編號', AUTO_INCREMENT=2147483648;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `maintain_content`
--
ALTER TABLE `maintain_content`
  MODIFY `m_c_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '保養項目編號', AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `price`
--
ALTER TABLE `price`
  MODIFY `p_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '報價編號', AUTO_INCREMENT=2010412302;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `price_content`
--
ALTER TABLE `price_content`
  MODIFY `p_id` int(5) NOT NULL AUTO_INCREMENT COMMENT '報價內容編號', AUTO_INCREMENT=69;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `product`
--
ALTER TABLE `product`
  MODIFY `pro_no` int(4) NOT NULL AUTO_INCREMENT COMMENT '產品編號', AUTO_INCREMENT=56541;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `region`
--
ALTER TABLE `region`
  MODIFY `re_no` int(5) NOT NULL AUTO_INCREMENT COMMENT '車區主鍵';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `region_components`
--
ALTER TABLE `region_components`
  MODIFY `com_no` int(6) NOT NULL AUTO_INCREMENT COMMENT '零件編號';

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `worker`
--
ALTER TABLE `worker`
  MODIFY `w_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '工作人員主鍵', AUTO_INCREMENT=3;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `client_connection`
--
ALTER TABLE `client_connection`
  ADD CONSTRAINT `client_connection_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `contact_person`
--
ALTER TABLE `contact_person`
  ADD CONSTRAINT `contact_person_ibfk_2` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `contract_content`
--
ALTER TABLE `contract_content`
  ADD CONSTRAINT `contract_content_ibfk_1` FOREIGN KEY (`con_no`) REFERENCES `contract` (`con_no`);

--
-- 資料表的限制式 `fix`
--
ALTER TABLE `fix`
  ADD CONSTRAINT `fix_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `fix_components`
--
ALTER TABLE `fix_components`
  ADD CONSTRAINT `fix_components_ibfk_1` FOREIGN KEY (`f_no`) REFERENCES `fix` (`f_no`);

--
-- 資料表的限制式 `fix_content`
--
ALTER TABLE `fix_content`
  ADD CONSTRAINT `fix_content_ibfk_1` FOREIGN KEY (`f_no`) REFERENCES `fix` (`f_no`);

--
-- 資料表的限制式 `maintain`
--
ALTER TABLE `maintain`
  ADD CONSTRAINT `maintain_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `maintain_content`
--
ALTER TABLE `maintain_content`
  ADD CONSTRAINT `maintain_content_ibfk_1` FOREIGN KEY (`m_no`) REFERENCES `maintain` (`m_no`);

--
-- 資料表的限制式 `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `price_content`
--
ALTER TABLE `price_content`
  ADD CONSTRAINT `price_content_ibfk_1` FOREIGN KEY (`p_no`) REFERENCES `price` (`p_no`);

--
-- 資料表的限制式 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`c_no`) REFERENCES `client` (`c_no`);

--
-- 資料表的限制式 `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`pro_no`) REFERENCES `product` (`pro_no`);

--
-- 資料表的限制式 `region_components`
--
ALTER TABLE `region_components`
  ADD CONSTRAINT `region_components_ibfk_1` FOREIGN KEY (`re_no`) REFERENCES `region` (`re_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
