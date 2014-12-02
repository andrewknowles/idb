-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2014 at 05:27 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `idb`
--

-- --------------------------------------------------------

--
-- Table structure for table `idb_error`
--

CREATE TABLE IF NOT EXISTS `idb_error` (
  `err_id` int(11) NOT NULL,
  `err_cause` varchar(200) COLLATE utf8_bin NOT NULL,
  `err_detail` varchar(500) COLLATE utf8_bin NOT NULL,
  `err_callfrom` varchar(250) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `err_id` (`err_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `idb_error`
--

INSERT INTO `idb_error` (`err_id`, `err_cause`, `err_detail`, `err_callfrom`) VALUES
(1, 'Connection error to MySQL database', 'Thrown by mysqli_connect_error', 'db_Mylib2.php - function openConnection'),
(2, 'Connection error to Informix database', 'Thrown by odbc_connect', 'db_Ifxlib2.php - openConnection'),
(3, 'Critical error occured - Program halted', 'Generic message displayed when $_SESSION[''error_flag''] === 1', 'Multiple locations'),
(4, 'Failed to read queries from idb_query table in idb database', 'Thrown by mysqli_prepare', 'db_Mylib2.php - function idbquerybytype'),
(5, 'Informix query with no parameters failed', 'Thrown by odbc_exec', 'db_Ifxlib2.php - function query0'),
(6, 'Single parameter Informix query failed', 'Thrown by odbc_prepare', 'db_Ifxlib2.php - function query1'),
(7, 'Selected branch code not in list of branches for t...', 'Thrown by array_key_exists', 'validation.php - function validatebranch'),
(8, 'Selected company code does not exist in list of co...', 'Thrown by array_key_exists', 'validation.php - function validatecompany'),
(9, 'Failed to select a query by number from idb_query', 'Thrown by mysqli_prepare', 'db_Mylin2.php - function idbquerybyno');

-- --------------------------------------------------------

--
-- Table structure for table `idb_query`
--

CREATE TABLE IF NOT EXISTS `idb_query` (
  `qry_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `qry_title` varchar(50) COLLATE utf8_bin NOT NULL,
  `qry_qry` varchar(2000) COLLATE utf8_bin NOT NULL,
  `qry_qry2` varchar(2000) COLLATE utf8_bin NOT NULL,
  `qry_qry3` varchar(2000) COLLATE utf8_bin NOT NULL,
  `qry_type` int(11) NOT NULL,
  `qry_order` int(11) NOT NULL,
  `qry_link` int(11) NOT NULL,
  `qry_detail` int(11) NOT NULL,
  UNIQUE KEY `qry_id` (`qry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=31 ;

--
-- Dumping data for table `idb_query`
--

INSERT INTO `idb_query` (`qry_id`, `qry_title`, `qry_qry`, `qry_qry2`, `qry_qry3`, `qry_type`, `qry_order`, `qry_link`, `qry_detail`) VALUES
(1, '1-Part Lines On Wait', 'SELECT count(*) \r\nFROM ofl, ofh, oft \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_wait <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0''', 'AND ofh.bra_id = ? ORDER BY 1 ', 'AND ofh.cpy_id = ? ORDER BY 1', 0, 1, 0, 5),
(2, '2-Parts on requisition - Count', 'SELECT count(*) \r\nFROM ofl, ofh, oft\r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0''', 'AND ofh.bra_id = ? ORDER BY 1', 'AND ofh.cpy_id = ? ORDER BY 1', 0, 2, 0, 22),
(3, '3-Parts on transfer - Count', 'SELECT count(*) \r\nFROM ofh, oft, ofl  \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0'' \r\nAND NOT EXISTS (SELECT * FROM rfl WHERE rfl.ofh_id = ofl.ofh_id AND rfl.ofl_id = ofl.ofl_id AND rfl.rfl_ibt = 1) ', 'AND ofh.bra_id = ? ORDER BY 1', 'AND ofh.cpy_id = ? ORDER BY 1', 0, 3, 0, 24),
(4, '4-Parts on transfer 2 - Count', 'SELECT count(*) FROM ofh, oft, ofl, rfl \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0''\r\nAND(( ofl_q_sord <> 0 and rfl_ibt = 1 ))', 'AND ofh.bra_id = ? ORDER BY 1', 'AND ofh.cpy_id = ? ORDER BY 1', 0, 4, 0, 26),
(5, 'Part Lines On Wait', 'SELECT ofh.ofh_doc_id Document, ofh.ofh_d_cre, bra.bra_screen, xvd.xvd_display, xvd1.xvd_display, ofl.pmf_id, ofl.pro_id, ofl.ofl_q_cord, ofl.ofl_q_wait\r\nFROM ofh, bra, xvd, xvd xvd1, oft, ofl \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_wait <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0'' \r\nAND ofh.bra_id = bra.bra_id \r\nAND ofh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND xvd1.xcv_id = ofh.oft_id \r\nAND xvd1.lng_id = 0 \r\nAND xvd1.xcd_id = 24\r\n\r\n', 'and ofh.bra_id = ? \r\norder by 1,2\r\n', 'and ofh.cpy_id = ? \r\norder by 1,2', 1, 1, 0, 0),
(6, 'PO Invoice Not Integrated', 'SELET sih.sih_doc_id, sih.sih_inv_id, sih.sih_d_inv, sih.spp_id, sih.sih_matchname, sih.bra_id, sih.dpr_id, sih.sih_total_local \r\nFROM sih \r\nWHERE sih.sih_acc_status <> 0  \r\nAND sih.sih_inv_status = 0', 'AND sih.bra_id = ? ORDER BY 1', 'AND sih.cpy_id = ? ORDER BY 1', 1, 12, 0, 0),
(7, 'Receipt Not Integrated', 'SELECT srh_doc_id, srh.spp_id, srh_matchname, bra.bra_screen, xvd.xvd_display, round(sum(srl_q_rec * (srl_pnet_local + srl_pro_local)),2) \r\nFROM srh, srl, bra, xvd \r\nWHERE srh_rec_status = 1 \r\nAND srh_acc_status = 0\r\nAND srl.srh_id = srh.srh_id \r\nAND srh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND srh.bra_id = bra.bra_id \r\nAND srl.srl_line = 1\r\nAND not exists (select * from sil where sil.srh_id = srl.srh_id and sil.srl_id = srl.srl_id)\r\n', 'AND srh.bra_id = ? ORDER BY 1', 'AND srh.cpy_id = ? ORDER BY 1', 1, 10, 0, 0),
(8, 'Receipts In Progress', 'SELECT srh_doc_id, srh.spp_id, srh_matchname, bra.bra_screen, xvd.xvd_display\r\nFROM srh, bra, xvd \r\nWHERE srh_rec_status = 0\r\nAND srh_acc_status = 0\r\nAND srh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND srh.bra_id = bra.bra_id', 'AND srh.bra_id = ? ORDER BY 1', 'AND srh.cpy_id = ? ORDER BY 1', 1, 9, 0, 0),
(9, 'Part Lines Delivered Not Invoiced', 'SELECT odh.odh_doc_id, odh_doc_id_seq, bra.bra_screen, xvd.xvd_display, odh.odh_d_closed, sum(opl_q_del),0,0,0 \r\nFROM opl, odh, bra, xvd \r\nWHERE opl_status <5 \r\nAND opl_line = 1 \r\nAND odh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND opl.opl_cancel=0 \r\nAND odh.odh_cancel=0 \r\nAND odh.bra_id = bra.bra_id \r\nAND opl.odh_id = odh.odh_id', 'AND odh.bra_id = ? GROUP BY 1,2,3,4,5 ORDER BY 1', 'AND odh.cpy_id = ? GROUP BY 1,2,3,4,5 ORDER BY 1', 1, 6, 0, 0),
(10, 'XXX', 'XXXX', '', '', 999, 0, 0, 0),
(11, 'Invoices Generated Not Printed', 'SELECT oih.oih_doc_id, oih.csc_id_inv, oih.oih_matchname, oih.oih_d_cre, bra.bra_screen, xvd.xvd_display FROM oih, bra, xvd\r\nWHERE oih.oih_status < 3 \r\nAND oih.oih_cancel = 0 \r\nAND oih_process <> ''F''\r\nAND oih.bra_id = bra.bra_id \r\nAND oih.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1\r\n', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.bra_id = ? ORDER BY 1', 1, 7, 0, 0),
(12, 'Invoiced Not Printed Pt2', 'SELECT COUNT(*)\r\nFROM oih\r\nWHERE oih.oih_status < 3 \r\nAND oih.oih_cancel = 0 \r\nAND oih_process <> ''F''\r\n\r\n', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.cpy_id = ? ORDER BY 1', 0, 7, 0, 11),
(13, 'xxx', 'xxx', '', '', 999, 0, 0, 0),
(14, 'XXX', 'XXX', '', '', 999, 0, 0, 0),
(15, '15-Receipt Lines not Integrated', 'SELECT COUNT(*)\r\nFROM srh, srl, bra, xvd \r\nWHERE srh_rec_status = 1\r\nAND srh_acc_status = 0 \r\nAND srl.srh_id = srh.srh_id\r\nAND srh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND srh.bra_id = bra.bra_id \r\nAND srl.srl_line = 1 \r\nAND not exists\r\n(SELECT * FROM sil WHERE sil.srh_id = srl.srh_id AND sil.srl_id = srl.srl_id)', 'AND srh.bra_id = ? ORDER BY 1', 'AND srh.bra_id = ? ORDER BY 1', 0, 10, 0, 7),
(16, 'PO Invoices In Progress', 'SELET sih.sih_doc_id, sih.sih_inv_id, sih.sih_d_inv, sih.spp_id, sih.sih_matchname, sih.bra_id, sih.dpr_id, sih.sih_total_local \r\nFROM sih \r\nWHERE sih.sih_acc_status = 0  \r\nAND sih.sih_inv_status = 0', 'AND sih.bra_id = ? ORDER BY 1', 'AND sih.cpy_id = ? ORDER BY 1', 1, 11, 0, 0),
(17, '17-PO Invoice In Progress', 'SELECT count(*) \r\nFROM sih \r\nWHERE sih.sih_acc_status = 0  \r\nAND sih.sih_inv_status = 0', 'AND sih.bra_id = ? ORDER BY 1', 'AND sih.cpy_id = ? ORDER BY 1', 0, 11, 16, 0),
(18, '18-PO Invoice Not Integrated', 'SELECT count(*) \r\nFROM sih \r\nWHERE sih.sih_acc_status <> 0  \r\nAND sih.sih_inv_status = 0', 'AND sih.bra_id = ? ORDER BY 1 ', 'AND sih.cpy_id = ? ORDER BY 1', 0, 12, 0, 6),
(19, '19-Receipts In Progress', 'SELECT count(*) \r\nFROM srh \r\nWHERE srh_rec_status = 0', 'AND srh.bra_id = ? ORDER BY 1', 'AND srh.cpy_id = ? ORDER BY 1', 0, 9, 0, 0),
(20, '20-Proforma Invoice Not Cancelled - Count', 'SELECT count(*) \r\nFROM oih \r\nWHERE oih_status = 2 \r\nAND ( oih_cancel = 0 OR oih_cancel IS NULL ) \r\nAND oih_account = 0 \r\nAND oih_process = ''F''', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.cpy_id = ? ORDER BY 1', 0, 5, 0, 23),
(21, '21-Invoices Printed Not Integrated - Count', 'SELECT count(*) \r\nFROM oih \r\nWHERE oih_status = 2 \r\nAND ( oih_cancel = 0 OR oih_cancel IS NULL ) \r\nAND oih_account = 0 \r\nAND oih_process <> ''F''', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.cpy_id = ? ORDER BY 1', 0, 8, 0, 0),
(22, 'Part Lines On Requisition', 'SELECT ofh.ofh_doc_id, ofh.ofh_d_cre, bra.bra_screen, xvd.xvd_display, xvd1.xvd_display, ofl.pmf_id, ofl.pro_id, ofl.ofl_q_cord, ofl.ofl_q_sreq \r\nFROM ofh , oft,ofl, bra, xvd, xvd xvd1 \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0'' \r\nAND ofh.bra_id = bra.bra_id \r\nAND ofh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND xvd1.xcv_id = ofh.oft_id \r\nAND xvd1.lng_id = 0 \r\nAND xvd1.xcd_id = 24\r\n', 'AND ofh.bra_id = ? order by 1,2', 'AND ofh.cpy_id = ? order by 1,2', 1, 2, 0, 0),
(23, 'Proforma Invoices Not Cancelled', 'SELECT oih.oih_doc_id, oih.csc_id_inv, oih.oih_matchname, oih.oih_d_cre, bra.bra_screen, xvd.xvd_display \r\nFROM oih, bra, xvd\r\nWHERE oih_status < 3 \r\nAND ( oih_cancel = 0 OR oih_cancel IS NULL ) \r\nAND oih_account = 0 \r\nAND oih_process = ''F''\r\nAND oih.bra_id = bra.bra_id \r\nAND oih.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1\r\n', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.cpy_id = ? ORDER BY 1', 1, 5, 0, 0),
(24, 'Part Lines On Transfer', 'SELECT ofh.ofh_doc_id, ofh.ofh_d_cre, bra.bra_screen, xvd.xvd_display, xvd1.xvd_display, ofl.pmf_id, ofl.pro_id, ofl.ofl_q_cord, ofl.ofl_q_sord FROM ofh, oft, ofl, bra, xvd, xvd xvd1  \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0'' \r\nAND NOT EXISTS (SELECT * FROM rfl WHERE rfl.ofh_id = ofl.ofh_id AND rfl.ofl_id = ofl.ofl_id AND rfl.rfl_ibt = 1) \r\nAND ofh.bra_id = bra.bra_id \r\nAND ofh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND xvd1.xcv_id = ofh.oft_id \r\nAND xvd1.lng_id = 0 \r\nAND xvd1.xcd_id = 24', 'and ofh.bra_id = ? order by 1,2', 'and ofh.cpy_id = ? order by 1,2', 1, 3, 0, 0),
(25, '25-Parts lines delivered not invoiced', 'SELECT count(*)\r\nFROM opl, odh\r\nWHERE opl_status = 4 \r\nAND opl_line = 1\r\nAND opl.opl_cancel=0 \r\nAND odh.odh_cancel=0\r\nAND opl.odh_id = odh.odh_id\r\n', 'AND odh.bra_id = ? ORDER BY 1', 'AND odh.cpy_id = ? ORDER BY 1', 0, 6, 0, 9),
(26, 'Part Lines On Transfer 2', 'SELECT ofh.ofh_doc_id, ofh.ofh_d_cre, bra.bra_screen, xvd.xvd_display, xvd1.xvd_display, ofl.pmf_id, ofl.pro_id, ofl.ofl_q_cord, ofl.ofl_q_sord FROM ofh, oft, ofl, rfl, bra, xvd, xvd xvd1  \r\nWHERE ofh_doc_id IS NOT NULL \r\nAND ofh.oft_id = oft.oft_id \r\nAND ofh_cancel = 0 \r\nAND ofh.ofh_id = ofl.ofh_id \r\nAND ofh.ofh_sqciw <> 1 \r\nAND ofl_q_sreq <> 0 \r\nAND ofl_line = 1 \r\nAND ofh_status in (0,1) \r\nAND oft.oft_process = ''0''\r\nAND(( ofl_q_sord <> 0 and rfl_ibt = 1 )) \r\nAND ofh.bra_id = bra.bra_id \r\nAND ofh.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1 \r\nAND xvd1.xcv_id = ofh.oft_id \r\nAND xvd1.lng_id = 0 \r\nAND xvd1.xcd_id = 24\r\n', 'and ofh.bra_id = ? order by 1,2', 'and ofh.cpy_id = ? order by 1,2', 1, 4, 0, 0),
(27, 'Invoices Printed Not Integrated', 'SELECT oih_doc_id, csc_id_inv, oih_matchname, oih_d_cre, bra.bra_screen, xvd.xvd_display \r\nFROM oih, bra, xvd \r\nWHERE oih_status = 2 \r\nAND ( oih_cancel = 0 OR oih_cancel IS NULL ) \r\nAND oih_account = 0 \r\nAND oih_process <> ''F''\r\nAND oih.bra_id = bra.bra_id \r\nAND oih.dpr_id = xvd.xcv_id \r\nAND xvd.lng_id = 0 \r\nAND xvd.xcd_id = 1\r\n\r\n', 'AND oih.bra_id = ? ORDER BY 1', 'AND oih.cpy_id = ? ORDER BY 1', 1, 8, 0, 0),
(28, 'aaa', 'aaa', '', '', 999, 0, 0, 0),
(29, 'aaa', 'aaa', '', '', 999, 0, 0, 0),
(30, 'aaa', 'aaa', '', '', 999, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `idb_settings`
--

CREATE TABLE IF NOT EXISTS `idb_settings` (
  `idb_setting_id` int(11) NOT NULL,
  `idb_setting_char` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `idb_settings`
--

INSERT INTO `idb_settings` (`idb_setting_id`, `idb_setting_char`) VALUES
(1, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `idb_tables`
--

CREATE TABLE IF NOT EXISTS `idb_tables` (
  `tab_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tab_tabname` varchar(15) COLLATE utf8_bin NOT NULL,
  `tab_colname` varchar(20) COLLATE utf8_bin NOT NULL,
  `tab_coltype` varchar(20) COLLATE utf8_bin NOT NULL,
  `tab_colvalues` varchar(100) COLLATE utf8_bin NOT NULL,
  `tab_comment` varchar(500) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `tab_id` (`tab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='able layout of idb tables' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `idb_tables`
--

INSERT INTO `idb_tables` (`tab_id`, `tab_tabname`, `tab_colname`, `tab_coltype`, `tab_colvalues`, `tab_comment`) VALUES
(1, 'idb_query', 'qry_type', 'INT', '0= Quick Status Count\r\n1= Quick Status Detail\r\n2=', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
