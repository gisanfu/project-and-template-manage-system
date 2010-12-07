-- phpMyAdmin SQL Dump
-- version 3.2.2.1deb1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Dec 07, 2010, 02:41 PM
-- 伺服器版本: 5.1.37
-- PHP 版本: 5.2.10-2ubuntu6.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `develop_platform`
--

-- --------------------------------------------------------

--
-- 資料表格式： `t_argument`
--

DROP TABLE IF EXISTS `t_argument`;
CREATE TABLE IF NOT EXISTS `t_argument` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '所對應的專案編號',
  `procedure_id` int(5) NOT NULL COMMENT '所對應的mysql程序編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '引數別名',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '引數說明',
  `type_id` int(3) NOT NULL COMMENT '引數型態的編號，指向另1個資料表',
  `length` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '引數長度值',
  `required` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '引數是否為必需欄位，1=>必要，其它皆為非必要',
  `sequence` varchar(3) COLLATE utf8_unicode_ci NOT NULL COMMENT '欄位的順序，從1開始',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '這個引數是否有效，如果為1，就是有效，其它都是無效',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='mysql程序的欄位屬性' AUTO_INCREMENT=41 ;

--
-- 列出以下資料庫的數據： `t_argument`
--

INSERT INTO `t_argument` (`id`, `project_id`, `procedure_id`, `name`, `description`, `type_id`, `length`, `required`, `sequence`, `enable`) VALUES
(1, 3, 0, '444', '555', 0, '', '', '', '1'),
(2, 3, 2, 'name', '22', 1, '33', '0', '3', '1'),
(3, 3, 2, 'pass', '33', 1, '11', '1', '1', '1'),
(4, 3, 2, 'enable', '是否啟用', 2, '2', '1', '2', '1'),
(5, 1, 4, 'f_name', '廠商的完整或不完整名稱', 2, '200', '0', '3', '1'),
(6, 1, 4, 'f_cid', '商品分類編號', 1, '11', '0', '2', '1'),
(7, 1, 5, 'f_pid', '廠商編號', 1, '11', '0', '3', '1'),
(8, 1, 5, 'f_pname', '廠商名稱', 2, '200', '0', '2', '1'),
(9, 1, 9, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(10, 1, 4, 'f_version', '程序版本', 2, '20', '0', '1', '1'),
(11, 1, 5, 'f_version', '程序版本', 2, '20', '0', '1', '1'),
(12, 5, 6, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(13, 5, 7, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(14, 5, 7, 'f_product_id', '商品編號', 1, '5', '1', '2', '1'),
(15, 5, 8, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(29, 5, 9, 'f_product_id ', '商品編號 ', 1, '5', '1', '3', '1'),
(17, 5, 8, 'f_hn', '對應中華電信的HN編號', 2, '8', '1', '2', '1'),
(18, 5, 8, 'f_name', '客戶名稱', 2, '255', '1', '3', '1'),
(19, 5, 8, 'f_address', '送貨地址', 2, '255', '1', '5', '1'),
(20, 5, 8, 'f_receipttype', '發票是2或是3聯', 2, '2', '1', '6', '1'),
(21, 5, 8, 'f_receiptname', '受買人或發票抬頭', 2, '50', '0', '7', '1'),
(22, 5, 8, 'f_receipttaxid', '公司的統編', 2, '20', '0', '8', '1'),
(30, 5, 9, 'f_quantity', '商品購買的數量 ', 1, '5', '1', '4', '1'),
(31, 5, 8, 'f_email', '客戶email', 2, '50', '1', '10', '1'),
(25, 5, 8, 'f_sex', '性別', 2, '2', '0', '9', '1'),
(26, 5, 8, 'f_phone', '客戶市話', 2, '20', '1', '4', '1'),
(27, 5, 9, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(28, 5, 9, 'f_order_id ', '訂單編號', 1, '5', '1', '2', '1'),
(32, 5, 8, 'f_mobile', '客戶手機', 2, '30', '1', '11', '1'),
(33, 5, 8, 'f_receiptstatus', '發票索取的方式', 2, '5', '0', '12', '1'),
(34, 1, 10, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(35, 1, 11, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(36, 1, 12, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(37, 1, 13, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(38, 1, 14, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(39, 1, 15, 'f_version', '程序版本', 2, '20', '', '1', '1'),
(40, 1, 16, 'f_version', '程序版本', 2, '20', '', '1', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_argument_type`
--

DROP TABLE IF EXISTS `t_argument_type`;
CREATE TABLE IF NOT EXISTS `t_argument_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '型態名稱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='程序欄位的型態名稱' AUTO_INCREMENT=3 ;

--
-- 列出以下資料庫的數據： `t_argument_type`
--

INSERT INTO `t_argument_type` (`id`, `name`) VALUES
(1, 'INT'),
(2, 'VARCHAR');

-- --------------------------------------------------------

--
-- 資料表格式： `t_block`
--

DROP TABLE IF EXISTS `t_block`;
CREATE TABLE IF NOT EXISTS `t_block` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應的專案編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Block的資料夾名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'php的程式主體',
  `tplbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'tpl的程式主體，含smarty的語法',
  `headbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'head，就是放在html的head中間',
  `tplname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以block名稱加上view.tpl.htm的路徑,如果指定了,會取代整個原有的名稱',
  `headname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以block名稱加上view.head.htm的路徑,會取代整個原有的名稱',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='版面處理區塊' AUTO_INCREMENT=7 ;

--
-- 列出以下資料庫的數據： `t_block`
--

INSERT INTO `t_block` (`id`, `project_id`, `name`, `description`, `phpbody`, `tplbody`, `headbody`, `tplname`, `headname`, `enable`) VALUES
(5, 3, 'block01', '標準後台詳細資料預載Block範本', '  act_DbConnect();\r\n\r\n  $sql = ''select * from ''._TABLE_WEIGHTS.'' where id=''.$id;\r\n  $debuglines[] = $sql;\r\n  \r\n  $result = mysql_query($sql) or $status = ''error'';\r\n  if( $status == ''error'' ){\r\n    $errmsg = mysql_error();\r\n    include(''pages/smarty-error.php'');\r\n  }\r\n  $row  = array();\r\n  $row = mysql_fetch_array($result,MYSQL_ASSOC);\r\n  include(''pages/debug-db-result.php'');\r\n  $weight = $row;\r\n  $smarty->assign("weight",$weight);\r\n  \r\n  act_DbDisconnect($result,$link);', '<a href="<{$targetpost}>?hidop=adding" style="text-decoration:none;color:#0052D9;">\r\n  <img src="images/add.png" width="16" height="16" border="0" />\r\n  新增資料\r\n</a>\r\n\r\n<br>\r\n\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''weights''];<{/php}>\r\n\r\n<{if count($rows) <= 0 }>\r\n  無資料\r\n<{else}>\r\n  <table class="stats" cellspacing="0">\r\n  <tr>\r\n    <td class="hed">單位名稱</td>\r\n    <td class="hed" width="30">修改</td>\r\n    <td class="hed" width="30">刪除</td>  \r\n  </tr>\r\n  <{section name=num01 loop=$rows}>\r\n    <tr>\r\n      <td>\r\n        <{$rows[num01].name|cat:" "}>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?hidop=editing&id=<{$rows[num01].id}>">\r\n            <img src="images/edit.png" width="16" height="16" border="0" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?id=<{$rows[num01].id}>&hidop=del" \r\n             onclick="return confirm(''真的要刪除嗎？'')">\r\n            <img src="images/del.png" border="0" width="16" height="16" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n    </tr>\r\n  <{/section}>\r\n  </table>\r\n<{/if}>', '<style>\r\n  <{* CSS來源 http://robertdenton.org/reference/css-tables-tutorial.html *}>\r\n  table.stats {\r\n    text-align: center;\r\n    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif ;\r\n    font-weight: normal;\r\n    font-size: 16px;\r\n    color: #fff;\r\n    /*width: 280px;*/\r\n    background-color: #666;\r\n    border: 0px;\r\n    border-collapse: collapse;\r\n    border-spacing: 0px;\r\n  }\r\n  \r\n  table.stats td {\r\n    background-color: #CCC;\r\n    color: #000;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border: 1px #fff solid;\r\n  }\r\n  \r\n  table.stats td.hed {\r\n    background-color: #666;\r\n    color: #fff;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border-bottom: 2px #fff solid;\r\n    font-size: 12px;\r\n    font-weight: bold;\r\n  }\r\n</style>', '', '', '1'),
(6, 6, 'example_general_pre_detail_block', '標準後台詳細資料預載Block範本', '  act_DbConnect();\r\n\r\n  $sql = ''select * from ''._TABLE_RADACCT.'' where TO_DAYS(AcctStartTime) = (TO_DAYS(NOW())-1)'';\r\n  $debuglines[] = $sql;\r\n  \r\n  $result = mysql_query($sql) or $status = ''error'';\r\n  if( $status == ''error'' ){\r\n    $errmsg = mysql_error();\r\n    include(''pages/smarty-error.php'');\r\n  }\r\n  $row  = array();\r\n  $row = mysql_fetch_array($result,MYSQL_ASSOC);\r\n  include(''pages/debug-db-result.php'');\r\n  $weight = $row;\r\n  $smarty->assign("weight",$weight);\r\n  \r\n  act_DbDisconnect($result,$link);', '<a href="<{$targetpost}>?hidop=adding" style="text-decoration:none;color:#0052D9;">\r\n  <img src="images/add.png" width="16" height="16" border="0" />\r\n  新增資料\r\n</a>\r\n\r\n<br>\r\n\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''weights''];<{/php}>\r\n\r\n<{if count($rows) <= 0 }>\r\n  無資料\r\n<{else}>\r\n  <table class="stats" cellspacing="0">\r\n  <tr>\r\n    <td class="hed">單位名稱</td>\r\n    <td class="hed" width="30">修改</td>\r\n    <td class="hed" width="30">刪除</td>  \r\n  </tr>\r\n  <{section name=num01 loop=$rows}>\r\n    <tr>\r\n      <td>\r\n        <{$rows[num01].name|cat:" "}>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?hidop=editing&id=<{$rows[num01].id}>">\r\n            <img src="images/edit.png" width="16" height="16" border="0" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?id=<{$rows[num01].id}>&hidop=del" \r\n             onclick="return confirm(''真的要刪除嗎？'')">\r\n            <img src="images/del.png" border="0" width="16" height="16" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n    </tr>\r\n  <{/section}>\r\n  </table>\r\n<{/if}>', '<style>\r\n  <{* CSS來源 http://robertdenton.org/reference/css-tables-tutorial.html *}>\r\n  table.stats {\r\n    text-align: center;\r\n    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif ;\r\n    font-weight: normal;\r\n    font-size: 16px;\r\n    color: #fff;\r\n    /*width: 280px;*/\r\n    background-color: #666;\r\n    border: 0px;\r\n    border-collapse: collapse;\r\n    border-spacing: 0px;\r\n  }\r\n  \r\n  table.stats td {\r\n    background-color: #CCC;\r\n    color: #000;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border: 1px #fff solid;\r\n  }\r\n  \r\n  table.stats td.hed {\r\n    background-color: #666;\r\n    color: #fff;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border-bottom: 2px #fff solid;\r\n    font-size: 12px;\r\n    font-weight: bold;\r\n  }\r\n</style>', '', '', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_block_example`
--

DROP TABLE IF EXISTS `t_block_example`;
CREATE TABLE IF NOT EXISTS `t_block_example` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Block的資料夾名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'php的程式主體',
  `tplbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'tpl的程式主體，含smarty的語法',
  `headbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'head，就是放在html的head中間',
  `tplname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以block名稱加上view.tpl.htm的路徑,如果指定了,會取代整個原有的名稱',
  `headname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以block名稱加上view.head.htm的路徑,會取代整個原有的名稱',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='版面處理區塊的範本' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_block_example`
--

INSERT INTO `t_block_example` (`id`, `name`, `description`, `phpbody`, `tplbody`, `headbody`, `tplname`, `headname`, `enable`) VALUES
(2, 'example_general_pre_detail_block', '標準後台詳細資料預載Block範本', '  act_DbConnect();\r\n\r\n  $sql = ''select * from ''._TABLE_WEIGHTS.'' where id=''.$id;\r\n  $debuglines[] = $hidopname.$sql;\r\n  \r\n  $result = mysql_query($sql) or $status = ''error'';\r\n  if( $status == ''error'' ){\r\n    $errmsg = $hidopname.mysql_error();\r\n    include(''pages/smarty-error.php'');\r\n  }\r\n  $row  = array();\r\n  $row = mysql_fetch_array($result,MYSQL_ASSOC);\r\n  include(''pages/debug-db-result.php'');\r\n  $weight = $row;\r\n  $smarty->assign("weight",$weight);\r\n  \r\n  act_DbDisconnect($result,$link);', '<a href="<{$targetpost}>?hidop=adding" style="text-decoration:none;color:#0052D9;">\r\n  <img src="images/add.png" width="16" height="16" border="0" />\r\n  新增資料\r\n</a>\r\n\r\n<br>\r\n\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''weights''];<{/php}>\r\n\r\n<{if count($rows) <= 0 }>\r\n  無資料\r\n<{else}>\r\n  <table class="stats" cellspacing="0">\r\n  <tr>\r\n    <td class="hed">單位名稱</td>\r\n    <td class="hed" width="30">修改</td>\r\n    <td class="hed" width="30">刪除</td>  \r\n  </tr>\r\n  <{section name=num01 loop=$rows}>\r\n    <tr>\r\n      <td>\r\n        <{$rows[num01].name|cat:" "}>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?hidop=editing&id=<{$rows[num01].id}>">\r\n            <img src="images/edit.png" width="16" height="16" border="0" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n      <td>\r\n        <div align="center">\r\n          <a href="<{$targetpost}>?id=<{$rows[num01].id}>&hidop=del" \r\n             onclick="return confirm(''真的要刪除嗎？'')">\r\n            <img src="images/del.png" border="0" width="16" height="16" />\r\n          </a>\r\n        </div>\r\n      </td>\r\n    </tr>\r\n  <{/section}>\r\n  </table>\r\n<{/if}>', '<style>\r\n  <{* CSS來源 http://robertdenton.org/reference/css-tables-tutorial.html *}>\r\n  table.stats {\r\n    text-align: center;\r\n    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif ;\r\n    font-weight: normal;\r\n    font-size: 16px;\r\n    color: #fff;\r\n    /*width: 280px;*/\r\n    background-color: #666;\r\n    border: 0px;\r\n    border-collapse: collapse;\r\n    border-spacing: 0px;\r\n  }\r\n  \r\n  table.stats td {\r\n    background-color: #CCC;\r\n    color: #000;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border: 1px #fff solid;\r\n  }\r\n  \r\n  table.stats td.hed {\r\n    background-color: #666;\r\n    color: #fff;\r\n    padding: 4px;\r\n    text-align: left;\r\n    border-bottom: 2px #fff solid;\r\n    font-size: 12px;\r\n    font-weight: bold;\r\n  }\r\n</style>', '', '', '1'),
(3, 'example_general_handle_detail_block', '標準後台詳細資料處理Block或成功訊息的範本', '  act_DbConnect();\r\n\r\n  $sql_values[''name''] = $_POST["name"];\r\n      \r\n  // function(''tablename'',fields,fieldattrs,action,parameters);\r\n  // example: sql_act_parse(''weights'',$sql_values,$sql_attrs,''insert'','''');\r\n  $sql_table = _TABLE_WEIGHTS;\r\n  $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],''update'',''id=''.$id);\r\n  $debuglines[] = $hidopname.$sql;\r\n\r\n  $result = mysql_query($sql) or $status = ''error'';\r\n  if( $status == ''error'' ){\r\n    $errmsg = $hidopname.mysql_error();\r\n    include(''pages/smarty-error.php'');\r\n  }\r\n      \r\n  act_DbDisconnect(NULL,$link);', '<h2><{$message}></h2>\r\n\r\n<{if $redir != '''' }>\r\n<br />\r\n如果瀏覽器沒有自動回到上層頁面，請按以下的超連結<br />\r\n<a href="<{$redir}>">回上層</a><br />\r\n<{/if}>', '<{if $redir != '''' }>\r\n  <meta http-equiv="Refresh" content="3;url=<{$redir}>">\r\n<{/if}>', '', '', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_code`
--

DROP TABLE IF EXISTS `t_code`;
CREATE TABLE IF NOT EXISTS `t_code` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `language_id` int(5) NOT NULL COMMENT '程式語言的編號',
  `alias` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '程式碼的別名',
  `codebody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '程式的主體',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='程式碼區段' AUTO_INCREMENT=10 ;

--
-- 列出以下資料庫的數據： `t_code`
--

INSERT INTO `t_code` (`id`, `language_id`, `alias`, `codebody`, `description`) VALUES
(4, 4, 'section 指令範例', '<{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''debuglines''];<{/php}>\r\n<{section name=nums loop=$rows}>\r\n  <{$rows[nums]}><br />\r\n<{/section}>', 'section的範例,第1行是把debuglines這個變數指定成rows,這樣就不用改底下迴圈的變數了'),
(5, 4, 'config_load 指令範例', 'vars.conf 檔案範例:\r\n\r\ndebug = 1\r\n\r\nindex.tpl.htm 檔案範例:\r\n\r\n<{config_load file="vars.conf"}>\r\n\r\n<{if #debug# == 1 }>\r\ndo something\r\n<{/if}>', '讀取外部的變數檔'),
(6, 4, 'section和htmlselect的搭配範例', '<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''languages''];<{/php}>\r\n<select name="language_id">\r\n  <option value="<{$row.language_id}>"><{$row.language_name}></option>\r\n  <{section name=num01 loop=$rows}>\r\n    <option value="<{$rows[num01].id}>">\r\n      <{$rows[num01].name}>\r\n    </option>\r\n  <{/section}>\r\n</select>', 'none'),
(7, 1, 'Div顯示及隱藏的函式', '/* 這個function是要顯示div用的\r\n * 觸發的那邊要加上onclick="ShowDiv(this)"\r\n * div那邊要先加上style="display:none"\r\n */\r\nfunction DivViewControl(divname) \r\n{ \r\n    var Layer_choice; \r\n \r\n   if (document.getElementById) {\r\n     Layer_choice = eval("document.getElementById(''" + divname + "'')"); \r\n   } else {\r\n     Layer_choice = eval("document.all.choice." + divname); \r\n   } \r\n   \r\n   if(Layer_choice){\r\n     if(Layer_choice.style.display=="none"){ \r\n       Layer_choice.style.display=''''; \r\n     } else {\r\n       Layer_choice.style.display="none";\r\n     }\r\n   }\r\n}\r\n\r\nfunction DivCmdControl(divname,cmd) \r\n{ \r\n   var Layer_choice; \r\n\r\n   if (document.getElementById) {\r\n     Layer_choice = eval("document.getElementById(''" + divname + "'')"); \r\n   } else {\r\n     Layer_choice = eval("document.all.choice." + divname); \r\n   } \r\n   \r\n   if(Layer_choice){\r\n     if(cmd=="show"){\r\n       Layer_choice.style.display=''''; \r\n     } else {\r\n       Layer_choice.style.display="none";\r\n     }\r\n   }\r\n}', '1次關,1次開,或者指定要關還是開'),
(8, 2, 'mysql 連線與斷線的函式', '/*\r\n * mysql 連線的函式\r\n */\r\nfunction act_DbConnect(){\r\n        \r\n    global $db_errmsg;\r\n    global $db_debugtxt;\r\n    \r\n    //ini_set(''display_errors'', ''0'');\r\n    //error_reporting(E_ALL);\r\n    \r\n    $link = mysql_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status=''error'';\r\n    if( $status == ''error'' ){\r\n      echo ''系統維護中<br>'';\r\n      exit;\r\n    }\r\n\r\n    mysql_query("set names utf8");\r\n    \r\n    //return $link;\r\n\r\n    mysql_select_db( _DB_NAME, $link);\r\n} /* act_DbConnect */\r\n\r\n/*\r\n * 從資料庫斷線\r\n */\r\nfunction act_DbDisconnect(){\r\n    //mysql_free_result($result); \r\n    //mysql_close($link);\r\n} /* act_DbDisconnect */', '這個是mysql的，mysqli的是獨立另外一筆'),
(9, 2, 'mysqli 連線與斷線的函式', '/*\r\n * update: 2009-01-05\r\n * 用mysqli連線資料庫\r\n */\r\nfunction php_mysqli_connect(){\r\n    global $db_errmsg;\r\n    //global $db_debugtxt;\r\n    \r\n    ini_set(''display_errors'', ''0'');\r\n    //error_reporting(E_ALL);\r\n    \r\n    $link = mysqli_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status=''error'';\r\n    if( $status == ''error'' ){\r\n      $db_errmsg =  ''mysqli connect fail'';\r\n      exit;\r\n    }\r\n    mysqli_query($link,"set names utf8");\r\n    mysqli_select_db($link,_DB_NAME);    \r\n    return $link;    \r\n} /* php_mysqli_connect */\r\n\r\n/*\r\n * update: 2009-01-05\r\n * 用mysqli資料庫離線\r\n */\r\nfunction php_mysqli_disconnect($link){\r\n  $link->close;\r\n} /* php_mysqli_disconnect */', '這種連線方式可以存取procedure');

-- --------------------------------------------------------

--
-- 資料表格式： `t_controller`
--

DROP TABLE IF EXISTS `t_controller`;
CREATE TABLE IF NOT EXISTS `t_controller` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應的專案編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '檔案名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='控制的處理區塊' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_controller`
--

INSERT INTO `t_controller` (`id`, `project_id`, `name`, `description`, `phpbody`, `enable`) VALUES
(2, 3, 'controller01', '標準Controller區塊範本', '/*\r\n Update: 2009-1-9\r\n FileName: 檔名\r\n */\r\n\r\n// 讀取全域設定檔\r\ninclude_once("config.php");\r\n\r\n$thisfilename = ''請放本支程式的檔名'';\r\n\r\n//  把Get或Post所傳來的東西轉換成變數\r\nif( $_GET["hidop"] != '''' ){\r\n  $hidop = $_GET["hidop"];\r\n  $id    = $_GET["id"];\r\n} elseif( $_POST["hidop"] != '''' ){\r\n  $hidop = $_POST["hidop"];\r\n  $id    = $_POST["id"];\r\n} else {\r\n  echo ''no arg error'';\r\n  exit;\r\n}\r\n\r\n// 這裡只是做debug用的\r\n$rows = array(); // debug use\r\n$rows = $_POST;\r\ninclude(''pages/debug-db-result.php'');\r\n$rows = $_GET;\r\ninclude(''pages/debug-db-result.php'');', '1'),
(3, 6, 'example_general_controller', '標準Controller區塊範本', '/*\r\n Update: 2009-1-9\r\n FileName: 檔名\r\n */\r\n\r\n// 讀取全域設定檔\r\ninclude_once("../config/config.php");\r\n\r\n$thisfilename = ''請放本支程式的檔名'';\r\n\r\n//  把Get或Post所傳來的東西轉換成變數\r\nif( $_GET["hidop"] != '''' ){\r\n  $hidop = $_GET["hidop"];\r\n  $id    = $_GET["id"];\r\n} elseif( $_POST["hidop"] != '''' ){\r\n  $hidop = $_POST["hidop"];\r\n  $id    = $_POST["id"];\r\n} else {\r\n  echo ''no arg error'';\r\n  exit;\r\n}\r\n\r\n// 這裡只是做debug用的\r\n$rows = array(); // debug use\r\n$rows = $_POST;\r\ninclude(''pages/debug-db-result.php'');\r\n$rows = $_GET;\r\ninclude(''pages/debug-db-result.php'');', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_controller_example`
--

DROP TABLE IF EXISTS `t_controller_example`;
CREATE TABLE IF NOT EXISTS `t_controller_example` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '檔案名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='控制的處理區塊' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_controller_example`
--

INSERT INTO `t_controller_example` (`id`, `name`, `description`, `phpbody`, `enable`) VALUES
(3, 'example_general_controller', '標準Controller區塊範本', '/*\r\n Update: 2009-1-9\r\n FileName: 檔名\r\n */\r\n\r\n// 讀取全域設定檔\r\ninclude_once("../config/config.php");\r\n\r\n$thisfilename = ''請放本支程式的檔名'';\r\n\r\n//  把Get或Post所傳來的東西轉換成變數\r\nif( $_GET["hidop"] != '''' ){\r\n  $hidop = $_GET["hidop"];\r\n  $id    = $_GET["id"];\r\n} elseif( $_POST["hidop"] != '''' ){\r\n  $hidop = $_POST["hidop"];\r\n  $id    = $_POST["id"];\r\n} else {\r\n  echo ''no arg error'';\r\n  exit;\r\n}\r\n\r\n// 這裡只是做debug用的\r\n$rows = array(); // debug use\r\n$rows = $_POST;\r\ninclude(''pages/debug-db-result.php'');\r\n$rows = $_GET;\r\ninclude(''pages/debug-db-result.php'');', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_controller_signal`
--

DROP TABLE IF EXISTS `t_controller_signal`;
CREATE TABLE IF NOT EXISTS `t_controller_signal` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `controller_id` int(5) NOT NULL COMMENT '控制區塊的編號',
  `signal_id` int(5) NOT NULL COMMENT '對應的信號區塊編號',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='控制區塊與信號區塊的對應表' AUTO_INCREMENT=10 ;

--
-- 列出以下資料庫的數據： `t_controller_signal`
--

INSERT INTO `t_controller_signal` (`id`, `controller_id`, `signal_id`) VALUES
(8, 2, 2),
(9, 3, 3);

-- --------------------------------------------------------

--
-- 資料表格式： `t_language`
--

DROP TABLE IF EXISTS `t_language`;
CREATE TABLE IF NOT EXISTS `t_language` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `alias` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '程式語言的簡稱',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '程式語言的實際名稱',
  `fileexten` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '副檔名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='程式語言的種類' AUTO_INCREMENT=7 ;

--
-- 列出以下資料庫的數據： `t_language`
--

INSERT INTO `t_language` (`id`, `alias`, `name`, `fileexten`) VALUES
(1, 'js', 'JavaScript', 'js'),
(2, 'php', 'PHP', 'php'),
(3, 'pl', 'Perl', 'pl'),
(4, 'smarty', 'Smarty', 'tpl.htm');

-- --------------------------------------------------------

--
-- 資料表格式： `t_librarycategory`
--

DROP TABLE IF EXISTS `t_librarycategory`;
CREATE TABLE IF NOT EXISTS `t_librarycategory` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '分類的名稱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='函式的分類' AUTO_INCREMENT=3 ;

--
-- 列出以下資料庫的數據： `t_librarycategory`
--

INSERT INTO `t_librarycategory` (`id`, `name`) VALUES
(2, '資料庫類');

-- --------------------------------------------------------

--
-- 資料表格式： `t_librarydir`
--

DROP TABLE IF EXISTS `t_librarydir`;
CREATE TABLE IF NOT EXISTS `t_librarydir` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '資料夾名稱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='函式的所在資料夾名稱,當然上一層是Library資料夾' AUTO_INCREMENT=5 ;

--
-- 列出以下資料庫的數據： `t_librarydir`
--

INSERT INTO `t_librarydir` (`id`, `name`) VALUES
(2, 'php_func'),
(3, 'js_func'),
(4, 'php_class');

-- --------------------------------------------------------

--
-- 資料表格式： `t_libraryfile`
--

DROP TABLE IF EXISTS `t_libraryfile`;
CREATE TABLE IF NOT EXISTS `t_libraryfile` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '本檔案編號',
  `language_id` int(5) NOT NULL COMMENT '所屬的程式語言,包含副檔名',
  `librarycategory_id` int(5) NOT NULL COMMENT '本檔案在函式總覽中的分類',
  `librarydir_id` int(5) NOT NULL COMMENT '所屬的library次資料夾',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '主檔名',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='函式的檔案個體,類似版面的Controller角色' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_libraryfile`
--

INSERT INTO `t_libraryfile` (`id`, `language_id`, `librarycategory_id`, `librarydir_id`, `name`, `description`) VALUES
(1, 2, 2, 2, 'function-mysql', '資料庫的相關函式'),
(2, 1, 0, 3, 'divcontrol', '決定要不要顯示div'),
(3, 2, 2, 4, 'function-mysql-api', '放置存取資料庫的相關Class');

-- --------------------------------------------------------

--
-- 資料表格式： `t_libraryfile_item`
--

DROP TABLE IF EXISTS `t_libraryfile_item`;
CREATE TABLE IF NOT EXISTS `t_libraryfile_item` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `libraryfile_id` int(5) NOT NULL COMMENT 'libraryfile的編號',
  `libraryitem_id` int(5) NOT NULL COMMENT 'libraryitem的編號',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='函式檔名與函式的對應表' AUTO_INCREMENT=24 ;

--
-- 列出以下資料庫的數據： `t_libraryfile_item`
--

INSERT INTO `t_libraryfile_item` (`id`, `libraryfile_id`, `libraryitem_id`) VALUES
(16, 1, 3),
(15, 1, 1),
(17, 1, 4),
(18, 1, 5),
(19, 1, 6),
(20, 2, 7),
(21, 2, 8),
(22, 1, 9),
(23, 3, 10);

-- --------------------------------------------------------

--
-- 資料表格式： `t_libraryitem`
--

DROP TABLE IF EXISTS `t_libraryitem`;
CREATE TABLE IF NOT EXISTS `t_libraryitem` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '函式編號',
  `language_id` int(5) NOT NULL COMMENT '所屬的程式語言',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '函式的名稱',
  `bodytext` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '函式的內容',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '中文描述',
  `synopsis` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '語法',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='函式的個體' AUTO_INCREMENT=11 ;

--
-- 列出以下資料庫的數據： `t_libraryitem`
--

INSERT INTO `t_libraryitem` (`id`, `language_id`, `name`, `bodytext`, `description`, `synopsis`) VALUES
(1, 2, 'php_mysql_connect()', 'function php_mysql_connect(){\r\n\r\n    global $db_errmsg;\r\n    global $db_debugtxt;\r\n\r\n    ini_set(''display_errors'', ''0'');\r\n    //error_reporting(E_ALL);\r\n\r\n    $link = mysql_connect( _DB_HOST.(_DB_PORT=='''')? '':3306'':'':''._DB_PORT\r\n                         , _DB_USER\r\n                         , _DB_PASS\r\n                         ) or $status=''error'';\r\n    if( $status == ''error'' ){\r\n      echo ''系統維護中<br>'';\r\n      exit;\r\n    }\r\n\r\n    mysql_query("set names utf8");\r\n\r\n    //return $link;\r\n\r\n    mysql_select_db( _DB_NAME, $link);\r\n\r\n} /* php_mysql_connect */', '連線資料庫', '/*\r\n * update: 2009-01-16\r\n * 連線資料庫\r\n*/'),
(3, 2, 'php_mysql_disconnect()', 'function php_mysql_disconnect($result,$link){\r\n        \r\n    // 一般有select的狀況下是$result = Resource id #30\r\n    // 如果是delete或是update，$result = 1\r\n    if( strlen($result) > 1 ){       \r\n        mysql_free_result($result);\r\n    }\r\n\r\n    // 一般如果$link有值，都會是Resource id #30\r\n    // 如果沒有link的話，就是null\r\n    if( !is_null($link) ){\r\n      mysql_close($link);\r\n    }\r\n} /* 函式 act_DbDisconnect */\r\n', '從資料庫離線', '/*\r\n * update: 2009-01-16\r\n */'),
(4, 2, 'php_mysqli_connect()', 'function php_mysqli_connect(){\r\n    global $db_errmsg;\r\n    //global $db_debugtxt;\r\n    \r\n    ini_set(''display_errors'', ''0'');\r\n    //error_reporting(E_ALL);\r\n    \r\n    $link = mysqli_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status=''error'';\r\n    if( $status == ''error'' ){\r\n      $db_errmsg =  ''mysqli connect fail'';\r\n      exit;\r\n    }\r\n    mysqli_query($link,"set names utf8");\r\n    mysqli_select_db($link,_DB_NAME);    \r\n    return $link;    \r\n} /* php_mysqli_connect */', '用mysqli連線資料庫', '/*\r\n * update: 2009-01-16\r\n */'),
(5, 2, 'php_mysqli_disconnect()', 'function php_mysqli_disconnect($link){\r\n  $link->close;\r\n} /* php_mysqli_disconnect */', '把mysqli的資料庫斷線', '/*\r\n * update: 2009-01-16\r\n */'),
(6, 2, 'php_proc_parse()', 'function php_proc_parse($procname,$values){\r\n      \r\n  // 讓呼叫這個函式的來源，可以知道錯誤和debug的訊息是什麼\r\n  //global $db_errmsg;\r\n  global $db_debugtxt;\r\n  \r\n  //$db_debugtxt = array();\r\n  \r\n  // 存放排序OK的陣列變數\r\n  $value_sequence = array();\r\n  \r\n  // $attrs = Array() 存放的是程序的欄位相關屬性\r\n  // $attrs = \r\n  //   array(\r\n  //     "procedure名稱" => array(\r\n  //        "argname01" => array(\r\n  //           "name"     => "argname01",\r\n  //           "length"   => "10",\r\n  //           "required" => "1",\r\n  //           "sequence" => "1",\r\n  //           "type"     => "INT"\r\n  //        )\r\n  //     )\r\n  //   );\r\n  global $sql_proc_attrs;\r\n  \r\n  // $procname是要呼叫的mysql procedure 名稱\r\n  \r\n  // 讀取全域陣列變數進來 $sql_proc_attrs\r\n  // $values = Array() 存放的是欄位的內容\r\n  //   ''姓名'' => ''老王''\r\n  //   ''編號'' => 12\r\n  //   ...  \r\n  \r\n  // 規劃: 連線資料庫區段(這我要自己在寫一次)\r\n  // 規劃: 檢查"必要"的引數\r\n  // 規劃: 檢查長度\r\n  // 規劃: 轉換型態，看要不要加引號\r\n  // 規劃: 建立sql語法，別忘了要套上引數的順序\r\n  // 規劃: 執行sql語法，要加上$result的判斷(如果是1，就不用在fetch_array)\r\n  // 規劃: 把結果做成rows的陣列變數，並return\r\n  \r\n  // 檢查procname名稱是否存在\r\n  if(array_key_exists($procname,$sql_proc_attrs) == false ){\r\n    $message = ''[''.$procname.''] procedure name is not exist'';\r\n    //$db_errmsg = $message;\r\n    $db_debugtxt[] = $message;\r\n    return;\r\n  }\r\n  \r\n  // debug\r\n  // echo ''<pre>'';\r\n  // print_r($sql_proc_attrs[$procname]);\r\n  // echo ''</pre>'';\r\n  \r\n  if( count($sql_proc_attrs[$procname]) > 0 ){\r\n    foreach($sql_proc_attrs[$procname] as $key => $val ){\r\n      // 檢查必要引數\r\n      if( $val["required"] == ''1'' ){\r\n        if( $values[$key] == '''' ){\r\n          $message = ''[''.$procname.'']''.'' ''.$key.''  is require field'';\r\n          //$db_errmsg = $message;\r\n          $db_debugtxt[] = $message;\r\n          return;      \r\n        } /* if values */   \r\n      } /* if required */\r\n      // 準備好待回要排序的陣列變數\r\n      $value_sequence[$key] = $val[''sequence''];\r\n    } /* foreach */\r\n  } /* if count*/\r\n  \r\n  // 將陣列排序，以value為主\r\n  asort($value_sequence);\r\n  \r\n  // debug\r\n  //echo ''<pre>'';\r\n  //print_r($value_sequence);\r\n  //echo ''</pre>'';\r\n  \r\n  // 把變數值帶進來己排序好的陣列裡面\r\n  if(count($values) > 0 ){\r\n    foreach($value_sequence as $key => $val){\r\n      $value_sequence[$key] = $values[$key];\r\n    }/* foreach value_sequence */\r\n  } else {\r\n    // 當呼叫此程序，沒有帶引數的情況，就會跑到這裡\r\n    foreach($value_sequence as $key => $val){\r\n      $value_sequence[$key] = '''';\r\n    }/* foreach value_sequence */      \r\n  } /* count */\r\n  \r\n  // 檢查長度\r\n  // 目前暫時不寫....\r\n  \r\n  // 重建sql語法\r\n  $sql = ''call ''.$procname.''('';\r\n  if(count($value_sequence) > 0 ){\r\n    foreach( $value_sequence as $fieldname => $fieldval ){\r\n      switch ($sql_proc_attrs[$procname][$fieldname]["type"]) {\r\n        case ''INT'':\r\n          if( $fieldval != '''' ){\r\n            $sql .= $fieldval .'', '';\r\n          } else {\r\n            $sql .= ''\\''\\'', '';\r\n          }\r\n          break;\r\n        case ''VARCHAR'':\r\n          $sql .= ''\\'''' . mysql_escape_string($fieldval) . ''\\'', '';\r\n          break;\r\n        default:\r\n          $sql .= ''\\'''' . mysql_escape_string($fieldval) . ''\\'', '';\r\n          break;\r\n      } /* switch */\r\n    } /* foreach values */\r\n    // 把最後面的逗點和空白刪掉\r\n    $sql = substr($sql, 0, -2);\r\n  } /* if count */  \r\n  $sql .= '')'';  \r\n  \r\n  return $sql;\r\n  \r\n} /* 函式結束 php_proc_parse */', '這是產生sql語法的proc API', '/*\r\n * update: 2008-1-21\r\n * 這個是給其它專案所使用的範例函式API\r\n * 配合載入本程式所匯出的兩支檔案\r\n * 可以讓呼叫資料庫的部分更系統化\r\n *\r\n * 利用傳進來的引數，產生SQL語法\r\n *\r\n */'),
(7, 1, 'js_divview_control', 'function js_divview_control(divname) \r\n{ \r\n    var Layer_choice; \r\n \r\n   if (document.getElementById) {\r\n     Layer_choice = eval("document.getElementById(''" + divname + "'')"); \r\n   } else {\r\n     Layer_choice = eval("document.all.choice." + divname); \r\n   } \r\n   \r\n   if(Layer_choice){\r\n     if(Layer_choice.style.display=="none"){ \r\n       Layer_choice.style.display=''''; \r\n     } else {\r\n       Layer_choice.style.display="none";\r\n     }\r\n   }\r\n}', '顯示div用的', '/* 這個function是要顯示div用的\r\n * 觸發的那邊要加上onclick=\\"ShowDiv(this)\\"\r\n * div那邊要先加上style=\\"display:none\\"\r\n */'),
(8, 1, 'js_divcmd_control', 'function js_divcmd_control(divname,cmd) \r\n{ \r\n   var Layer_choice; \r\n\r\n   if (document.getElementById) {\r\n     Layer_choice = eval("document.getElementById(''" + divname + "'')"); \r\n   } else {\r\n     Layer_choice = eval("document.all.choice." + divname); \r\n   } \r\n   \r\n   if(Layer_choice){\r\n     if(cmd=="show"){\r\n       Layer_choice.style.display=''''; \r\n     } else {\r\n       Layer_choice.style.display="none";\r\n     }\r\n   }\r\n}', '用開關指令來決定要不要顯示', ''),
(9, 2, 'php_getrowstable()', 'function php_getrowstable($tablename){\r\n        \r\n    global $db_errmsg;\r\n    global $db_debugtxt;\r\n    \r\n    $db_debugtxt = array();\r\n        \r\n    act_DbConnect();\r\n    \r\n    $sql = ''select * from ''.$tablename;\r\n    $db_debugtxt[] = $sql;\r\n    $result = mysql_query($sql) or $status = ''error'';\r\n    if( $status == ''error'' ){\r\n      $errmsg = mysql_error(); \r\n      return;\r\n    }\r\n    $row  = array();\r\n    $rows = array();\r\n    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){\r\n      $rows[] = $row;   \r\n    }\r\n    if( (count($rows) > 0) and is_array($rows) ){\r\n      foreach($rows as $key => $val){\r\n        $db_debugtxt[] = $key.'' =>''.$val;\r\n      }\r\n    }\r\n    \r\n    act_DbDisconnect($result,$link);\r\n    \r\n    return $rows;   \r\n    \r\n} /*db_getrowstable*/', '搜尋單一table的資料並return', '/*\r\n  取得資料表的所有資料\r\n  只做單純的select * from table而以\r\n  然後return陣列\r\n  這個函式只單純做這件事情而以\r\n  \r\n  IDEA:\r\n  這些idea，未來可以寫新的函式，不要在改這個函式了\r\n  因為很多地方會需要一起改\r\n  1.加上引數id，讓他可以搜尋單一編號的欄位\r\n  2.加上引數，抓幾筆(limit)\r\n  3.加上引數，抓哪一筆(where id=)\r\n  4.加上引數，抓數量\r\n*/'),
(10, 2, 'SqlProcParse()', '/*\r\n * update: 2009-01-22\r\n * 將使用者的引數，轉換成完整procedure的呼叫語法的API\r\n */\r\nclass SqlProcParse {\r\n        \r\n  // 設定Public存取控制的變數\r\n  public $debuglines;\r\n  public $errmsg;\r\n  public $procname;\r\n  public $values;\r\n  public $sql;\r\n  public $value_sequence;\r\n        \r\n  function __construct($procname, $values){\r\n    \r\n    $this->debuglines = array();\r\n    $this->error = $errmsg;\r\n    $this->sql = $sql;\r\n    \r\n    /*\r\n      $attrs = Array() 存放的是程序的欄位相關屬性\r\n      $attrs = \r\n        array(\r\n          "procedure名稱" => array(\r\n             "argname01" => array(\r\n                "name"     => "argname01",\r\n                "length"   => "10",\r\n                "required" => "1",\r\n                "sequence" => "1",\r\n                "type"     => "INT"\r\n             )\r\n          )\r\n        );\r\n    */\r\n    require_once(''sql_proc_attrs.php'');\r\n    \r\n    // 檢查procname名稱是否存在\r\n    if(array_key_exists($procname,$sql_proc_attrs) == false ){\r\n      $this->error = ''[''.$procname.''] procedure name is not exist'';\r\n    } else {\r\n      array_push($this->debuglines,''procedure name check is pass'');\r\n    }\r\n    \r\n    if( count($sql_proc_attrs[$procname]) > 0 ){\r\n      foreach($sql_proc_attrs[$procname] as $key => $val ){\r\n        // 檢查必要引數\r\n        if( $val["required"] == ''1'' ){\r\n          if( $values[$key] == '''' ){\r\n            $this->error = ''[''.$procname.'']''.'' ''.$key.''  is require field'';\r\n            return;      \r\n          } /* if values */   \r\n        } /* if required */\r\n        // 準備好待回要排序的陣列變數\r\n        $value_sequence[$key] = $val[''sequence''];\r\n      } /* foreach */\r\n    } /* if count*/\r\n    \r\n    // 將陣列排序，以value為主\r\n    asort($value_sequence);\r\n    \r\n    // debug\r\n    //echo ''<pre>'';\r\n    //print_r($value_sequence);\r\n    //echo ''</pre>'';\r\n    \r\n    // 把變數值帶進來己排序好的陣列裡面\r\n    if(count($values) > 0 ){\r\n      foreach($value_sequence as $key => $val){\r\n        $value_sequence[$key] = $values[$key];\r\n      }/* foreach value_sequence */\r\n    } else {\r\n      // 當呼叫此程序，沒有帶引數的情況，就會跑到這裡\r\n      foreach($value_sequence as $key => $val){\r\n        $value_sequence[$key] = '''';\r\n      }/* foreach value_sequence */      \r\n    } /* count */\r\n    \r\n    // 檢查長度\r\n    // 目前暫時不寫....\r\n    \r\n    // 重建sql語法\r\n    $sql = ''call ''.$procname.''('';\r\n    if(count($value_sequence) > 0 ){\r\n      foreach( $value_sequence as $fieldname => $fieldval ){\r\n        switch ($sql_proc_attrs[$procname][$fieldname]["type"]) {\r\n          case ''INT'':\r\n            if( $fieldval != '''' ){\r\n              $sql .= $fieldval .'', '';\r\n            } else {\r\n              $sql .= ''\\''\\'', '';\r\n            }\r\n            break;\r\n          case ''VARCHAR'':\r\n            $sql .= ''\\'''' . mysql_escape_string($fieldval) . ''\\'', '';\r\n            break;\r\n          default:\r\n            $sql .= ''\\'''' . mysql_escape_string($fieldval) . ''\\'', '';\r\n            break;\r\n        } /* switch */\r\n      } /* foreach values */\r\n      // 把最後面的逗點和空白刪掉\r\n      $sql = substr($sql, 0, -2);\r\n    } /* if count */  \r\n    $sql .= '')'';\r\n    \r\n    $this->sql = $sql;\r\n    \r\n  } /* __construct */\r\n  \r\n  function __destruct(){\r\n    // do nothing...\r\n  } /* __destruct */\r\n} /* SqlProcParse */', '將使用 者的引數，轉換成完整procedure的呼叫語法的API', '/*\r\n * 使用方式\r\n * include(\\''SqlProcParse.class.php\\'');\r\n * $sql_array[\\''f_version\\''] = \\''2\\'';\r\n * $sql_array[\\''f_product_id\\''] = \\''3\\'';\r\n * $aaa = new SqlProcParse(\\''sp_productdetail_get\\'',$sql_array);\r\n * print_r($aaa->debuglines);\r\n * echo $aaa->error.\\"\\\\r\\\\n\\";\r\n * echo $aaa->sql.\\"\\\\r\\\\n\\";\r\n */');

-- --------------------------------------------------------

--
-- 資料表格式： `t_page`
--

DROP TABLE IF EXISTS `t_page`;
CREATE TABLE IF NOT EXISTS `t_page` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應的專案編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '檔名',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '頁面的描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `tplbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'tpl的程式主體,含smarty的語法',
  `tplname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以page名稱加上page.tpl.htm的路徑,如果指定了,會取代整個原有的名稱',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='頁面的區塊' AUTO_INCREMENT=5 ;

--
-- 列出以下資料庫的數據： `t_page`
--

INSERT INTO `t_page` (`id`, `project_id`, `name`, `description`, `phpbody`, `tplbody`, `tplname`, `enable`) VALUES
(3, 3, 'example_general_admin_index_page', '標準後台頁面', '  $smarty->assign(''targetpost'',$thisfilename);\r\n  $smarty->assign(''debuglines'',$debuglines);\r\n  $smarty->assign("weight",$weight);\r\n  $smarty->assign("id",$id);\r\n  $smarty->assign("hidop","輸入你的Signal名稱!!");', '<{config_load file="vars.conf"}>\r\n\r\n<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>後台管理</title>\r\n\r\n<{* 把通用的javascript函式帶進來 *}>\r\n<script type="text/javascript" src="includes/myjs/divcontrol.js"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<{* 這裡是DEBUG區段 *}>\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{if #debug# == 1 }>\r\n  <{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''debuglines''];<{/php}>\r\n  <a href="#" style="text-decoration:none" onclick="DivViewControl(''debug_div01'')" title="Debug訊息">\r\n    <img src="images/debugt_obj_16x16.gif" border="0" />\r\n  </a>\r\n  <div id="debug_div01" style="display:none">\r\n    <font color="#FF0000">\r\n    <{section name=nums loop=$rows}>\r\n      <{$rows[nums]}><br />\r\n    <{/section}>\r\n    </font>\r\n    <div id="debugdiv"></div>\r\n  </div>\r\n<{/if}>\r\n\r\n<{* 這裡放置你的Body內容 *}>\r\n\r\n</body>\r\n</html>\r\n', '', '1'),
(4, 6, 'example_general_admin_index_page', '標準後台頁面', '  $smarty->assign(''targetpost'',$thisfilename);\r\n  $smarty->assign(''debuglines'',$debuglines);\r\n  $smarty->assign("weight",$weight);\r\n  $smarty->assign("id",$id);\r\n  $smarty->assign("hidop","輸入你的Signal名稱!!");', '<{config_load file="vars.conf"}>\r\n\r\n<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>後台管理</title>\r\n\r\n<{* 把通用的javascript函式帶進來 *}>\r\n<script type="text/javascript" src="includes/myjs/divcontrol.js"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<{* 這裡是DEBUG區段 *}>\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{if #debug# == 1 }>\r\n  <{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''debuglines''];<{/php}>\r\n  <a href="#" style="text-decoration:none" onclick="DivViewControl(''debug_div01'')" title="Debug訊息">\r\n    <img src="images/debugt_obj_16x16.gif" border="0" />\r\n  </a>\r\n  <div id="debug_div01" style="display:none">\r\n    <font color="#FF0000">\r\n    <{section name=nums loop=$rows}>\r\n      <{$rows[nums]}><br />\r\n    <{/section}>\r\n    </font>\r\n    <div id="debugdiv"></div>\r\n  </div>\r\n<{/if}>\r\n\r\n<{* 這裡放置你的Body內容 *}>\r\n\r\n</body>\r\n</html>\r\n', '', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_page_block`
--

DROP TABLE IF EXISTS `t_page_block`;
CREATE TABLE IF NOT EXISTS `t_page_block` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `page_id` int(5) NOT NULL COMMENT '頁面的編號',
  `block_id` int(5) NOT NULL COMMENT '版面的編號',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='頁面和版面的對應表' AUTO_INCREMENT=27 ;

--
-- 列出以下資料庫的數據： `t_page_block`
--

INSERT INTO `t_page_block` (`id`, `page_id`, `block_id`) VALUES
(21, 3, 5),
(26, 4, 6);

-- --------------------------------------------------------

--
-- 資料表格式： `t_page_example`
--

DROP TABLE IF EXISTS `t_page_example`;
CREATE TABLE IF NOT EXISTS `t_page_example` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '檔名',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '頁面的描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `tplbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'tpl的程式主體,含smarty的語法',
  `tplname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '預設是以page名稱加上page.tpl.htm的路徑,如果指定了,會取代整個原有的名稱',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='頁面的區塊' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_page_example`
--

INSERT INTO `t_page_example` (`id`, `name`, `description`, `phpbody`, `tplbody`, `tplname`, `enable`) VALUES
(3, 'example_general_admin_index_page', '標準後台頁面', '  $smarty->assign(''targetpost'',$thisfilename);\r\n  $smarty->assign(''debuglines'',$debuglines);\r\n  $smarty->assign("id",$id);\r\n  $smarty->assign("hidop","輸入你的Signal名稱!!");', '<{config_load file="vars.conf"}>\r\n\r\n<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">\r\n<head>\r\n<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n<title>後台管理</title>\r\n\r\n<{* 把通用的javascript函式帶進來 *}>\r\n<script type="text/javascript" src="includes/myjs/divcontrol.js"></script>\r\n\r\n</head>\r\n\r\n<body>\r\n\r\n<{* 這裡是DEBUG區段 *}>\r\n<{*將php傳來的變數，轉成固定名稱的變數，讓section迴圈使用*}>\r\n<{if #debug# == 1 }>\r\n  <{php}>$this->_tpl_vars[''rows''] = $this->_tpl_vars[''debuglines''];<{/php}>\r\n  <a href="#" style="text-decoration:none" onclick="DivViewControl(''debug_div01'')" title="Debug訊息">\r\n    <img src="images/debugt_obj_16x16.gif" border="0" />\r\n  </a>\r\n  <div id="debug_div01" style="display:none">\r\n    <font color="#FF0000">\r\n    <{section name=nums loop=$rows}>\r\n      <{$rows[nums]}><br />\r\n    <{/section}>\r\n    </font>\r\n    <div id="debugdiv"></div>\r\n  </div>\r\n<{/if}>\r\n\r\n<{* 這裡放置你的Body內容 *}>\r\n\r\n</body>\r\n</html>\r\n', '', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_procedure`
--

DROP TABLE IF EXISTS `t_procedure`;
CREATE TABLE IF NOT EXISTS `t_procedure` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應專案的編號',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mysql程序名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mysql程序說明',
  `beginbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '程序的內容，只要begin-end(含)區塊內的資料就可以了',
  `version` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用更新當下的timestamp當做版本號',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '是否啟用，1=>啟用，其它皆停用，預設啟用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='mysql程序的基本資料' AUTO_INCREMENT=17 ;

--
-- 列出以下資料庫的數據： `t_procedure`
--

INSERT INTO `t_procedure` (`id`, `project_id`, `name`, `description`, `beginbody`, `version`, `enable`) VALUES
(1, 0, '333', '444', '', '', '1'),
(2, 3, 'sp_testccc', '33', '  exit1: BEGIN\r\n    declare statuscode int(1) default 0;\r\n    \r\n    if isnull(arg_id) then\r\n      select \r\n        c.server_cus_id as id,\r\n        concat(r.domain,''\\.'',z.domain) as httpaddress\r\n      from %table_community% as c\r\n      left join vh as v on c.vh_id = v.id\r\n      left join records as r on v.records_id=r.id\r\n      left join zones as z on r.zone=z.id\r\n      where \r\n        r.type=''A'';\r\n    elseif not(isnull(arg_id)) then    \r\n      select \r\n        c.server_cus_id as id,\r\n        concat(r.domain,''\\.'',z.domain) as httpaddress\r\n      from %table_community% as c\r\n      left join vh as v on c.vh_id = v.id\r\n      left join records as r on v.records_id=r.id\r\n      left join zones as z on r.zone=z.id\r\n      where \r\n        r.type=''A''\r\n      and\r\n        c.server_cus_id=arg_id;\r\n    else\r\n      set statuscode=1;\r\n      select statuscode;\r\n      leave exit1;\r\n    end if;\r\n    \r\n  END', '', '0'),
(3, 3, 'sp_testgg', '111111', '', '', '1'),
(4, 1, 'sp_manufacturer_search_like_name', '給自動完成的搜尋引擎所使用，搜尋廠商資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  -- 如果廠商名稱和分類編號都是空白的情況\r\n  if f_name <> '''' and not(isnull(f_cid)) then\r\n      select m.id,m.name \r\n      from %_TABLE_MANUFACTURERS% as m\r\n      left join %_TABLE_MANUFACTURERS_CATEGORIES% as c on m.id=c.manufacturers_id\r\n      where m.name like concat(''%'',f_name,''%'')\r\n      and c.categories_id=f_cid;\r\n\r\n  -- 如果只有分類編號是空白的情況\r\n  elseif f_name <> '''' and isnull(f_cid) then\r\n      select m.id,m.name \r\n      from %_TABLE_MANUFACTURERS% as m\r\n      left join %_TABLE_MANUFACTURERS_CATEGORIES% as c on m.id=c.manufacturers_id\r\n      where m.name like concat(''%'',f_name,''%'');\r\n  end if;\r\n  \r\nEND', '1231559358', '1'),
(5, 1, 'sp_manufacturer_search_id_or_name', '檢查使用者所key的廠商名稱是否己存在於資料庫', '  exit1: BEGIN\r\n    declare statuscode int(1) default 0;\r\n    declare version varchar(20) default '''';\r\n\r\n    -- 版本檢查功能的區塊\r\n    if f_version = 1 then\r\n      set version = %_PROC_VER_%;\r\n      select version;\r\n      leave exit1;\r\n    end if;\r\n    \r\n    if f_pname <> '''' and isnull(f_pid) then\r\n      select \r\n        *\r\n      from %_TABLE_MANUFACTURERS%\r\n      where name=f_pname;\r\n    elseif f_pname = '''' and not(isnull(f_pid)) then    \r\n      select \r\n        *\r\n      from %_TABLE_MANUFACTURERS%\r\n      where id=f_pid;\r\n    else\r\n      set statuscode=1;\r\n      select statuscode;\r\n      leave exit1;\r\n    end if;\r\n    \r\n  END', '1231559612', '1'),
(6, 5, 'sp_productlist_list', '商品總覽-列表', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  -- 您的程式碼從這裡開始\r\n  select * from %_TABLE_PRODUCTS%;\r\n  \r\n  -- 程式碼從這裡結束\r\nEND', '1232507113', '1'),
(7, 5, 'sp_productdetail_get', '商品詳細說明-取得商品說明', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  -- 您的程式碼從這裡開始\r\n  select * from %_TABLE_PRODUCTS% where id=f_product_id;\r\n  \r\n  -- 程式碼從這裡結束\r\nEND', '1231904861', '1'),
(8, 5, 'sp_ordersuccess_insertorder', '訂單完成-寫入訂單基本資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n  declare order_id int(5) default 0;\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  insert into %_TABLE_ORDERS% (hn,name,sex,address,phone,receipttype,receiptname,receipttaxid,email,mobile,receiptstatus)values(f_hn,f_name,f_sex,f_address,f_phone,f_receipttype,f_receiptname,f_receipttaxid,f_email,f_mobile,f_receiptstatus);\r\n  set order_id = last_insert_id();\r\n  select order_id;\r\n\r\nEND', '1232374479', '1'),
(9, 5, 'sp_ordersuccess_insertorderitem', '訂單完成-寫入訂單相關商品編號及數量', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  insert into %_TABLE_ORDERITEMS% (order_id,product_id,quantity) values (f_order_id,f_product_id,f_quantity);\r\n\r\nEND', '1231915777', '1'),
(10, 1, 'sp_companys_group_getall', '取得總公司名稱列表的程序', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_COMPANYS_GROUP%;\r\n  \r\nEND', '1232520098', '1'),
(11, 1, 'sp_quantity_getall', '取得數量單位的所有資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_QUANTITYS%;\r\n\r\nEND', '1232520174', '1'),
(12, 1, 'sp_craft_getall', '取得行業類別所有資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_CRAFTS%;\r\n\r\nEND', '1232520230', '1'),
(13, 1, 'sp_manufacturers_getall', '取得廠商所有資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_MANUFACTURERS%;\r\nEND', '1232520284', '1'),
(14, 1, 'sp_capacitys_getall', '取得容量所有資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_CAPACITYS%;\r\nEND', '1232520358', '1'),
(15, 1, 'sp_weights_getall', '取得重量所有資料', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_WEIGHTS%;\r\n\r\nEND', '1232527252', '1'),
(16, 1, 'sp_categories_getall', '取得商品的分類', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  select * from %_TABLE_CATEGORIES%;\r\n\r\nEND', '1232527258', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_procedure_example`
--

DROP TABLE IF EXISTS `t_procedure_example`;
CREATE TABLE IF NOT EXISTS `t_procedure_example` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mysql程序名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'mysql程序說明',
  `beginbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT '程序的內容，只要begin-end(含)區塊內的資料就可以了',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '是否啟用，1=>啟用，其它皆停用，預設啟用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='mysql程序的基本資料' AUTO_INCREMENT=2 ;

--
-- 列出以下資料庫的數據： `t_procedure_example`
--

INSERT INTO `t_procedure_example` (`id`, `name`, `description`, `beginbody`, `enable`) VALUES
(1, 'sp_', '這是範本', 'exit1: BEGIN\r\n  declare statuscode int(1) default 0;\r\n  declare version varchar(20) default '''';\r\n\r\n  -- 版本檢查功能的區塊\r\n  if f_version = 1 then\r\n    set version = %_PROC_VER_%;\r\n    select version;\r\n    leave exit1;\r\n  end if;\r\n  \r\n  -- 您的程式碼從這裡開始\r\n\r\n  \r\n  -- 程式碼從這裡結束\r\nEND', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_project`
--

DROP TABLE IF EXISTS `t_project`;
CREATE TABLE IF NOT EXISTS `t_project` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `theme_id` int(5) NOT NULL COMMENT '對應的風格編號',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '專案名稱',
  `exportdir` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'php函數檔匯出路徑',
  `httpaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '專案的網址',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '專案說明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='專案的基本屬性資料' AUTO_INCREMENT=8 ;

--
-- 列出以下資料庫的數據： `t_project`
--

INSERT INTO `t_project` (`id`, `theme_id`, `name`, `exportdir`, `httpaddress`, `description`) VALUES
(3, 3, '測試用的專案', '/home/gisanfu/project/gisanfu/web/develop_platform/exportdir/test44', '', 'none');

-- --------------------------------------------------------

--
-- 資料表格式： `t_project_db`
--

DROP TABLE IF EXISTS `t_project_db`;
CREATE TABLE IF NOT EXISTS `t_project_db` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '所對應的專案編號',
  `alias` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '別名',
  `host` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '目標主機',
  `port` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '連線主機的埠號',
  `user` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '帳號',
  `pass` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '密碼',
  `dbname` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '資料庫名稱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='該專案裡所對應的資料庫連線相關資訊' AUTO_INCREMENT=7 ;

--
-- 列出以下資料庫的數據： `t_project_db`
--

INSERT INTO `t_project_db` (`id`, `project_id`, `alias`, `host`, `port`, `user`, `pass`, `dbname`) VALUES
(1, 3, '測試用', '127.0.0.1', '', 'blog_2', 'blog_2123', 'blog_2'),
(2, 1, '本機站台', 'localhost', '3306', 'pricecompare', 'pricecompare123', 'pricecompare'),
(3, 1, '遠端主機', '127.0.0.1', '3307', 'pricebook', 'pricebook123', 'pricebook'),
(4, 5, '本機資料庫', 'localhost', '3306', 'readyten', 'readyten123', 'readyten'),
(5, 6, '本地主機', 'localhost', '3306', 'cdrsync', 'cdrsync123', 'cdrsync'),
(6, 5, '上線主機', '127.0.0.1', '3307', 'readyten', 'H7Qv7J', 'readyten');

-- --------------------------------------------------------

--
-- 資料表格式： `t_project_libraryfile`
--

DROP TABLE IF EXISTS `t_project_libraryfile`;
CREATE TABLE IF NOT EXISTS `t_project_libraryfile` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '專案編號',
  `libraryfile_id` int(5) NOT NULL COMMENT '所對應的函式檔案',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='專案與函式的對應表' AUTO_INCREMENT=11 ;

--
-- 列出以下資料庫的數據： `t_project_libraryfile`
--

INSERT INTO `t_project_libraryfile` (`id`, `project_id`, `libraryfile_id`) VALUES
(4, 3, 1),
(5, 3, 2),
(6, 5, 1),
(7, 7, 1),
(8, 7, 2),
(9, 1, 1),
(10, 3, 3);

-- --------------------------------------------------------

--
-- 資料表格式： `t_signal`
--

DROP TABLE IF EXISTS `t_signal`;
CREATE TABLE IF NOT EXISTS `t_signal` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應專案的編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱,指的是hidop的值',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `page_id` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT '所對應的頁面編號',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='信號處理區塊' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_signal`
--

INSERT INTO `t_signal` (`id`, `project_id`, `name`, `description`, `phpbody`, `page_id`, `enable`) VALUES
(2, 3, 'example_general_editing_signal', '標準後台Signal修改功能的範本', '  // 這個是debug用的變數\r\n  $hidopname = ''[''.$hidop.''] '';', '3', '1'),
(3, 6, 'list', '標準後台Signal修改功能的範本', '  // 這個是debug用的變數\r\n  $hidopname = ''[''.$hidop.''] '';', '4', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_signal_example`
--

DROP TABLE IF EXISTS `t_signal_example`;
CREATE TABLE IF NOT EXISTS `t_signal_example` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '名稱,指的是hidop的值',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  `phpbody` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'PHP程式主體',
  `enable` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT '是否啟用這個區塊',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='信號處理區塊' AUTO_INCREMENT=4 ;

--
-- 列出以下資料庫的數據： `t_signal_example`
--

INSERT INTO `t_signal_example` (`id`, `name`, `description`, `phpbody`, `enable`) VALUES
(3, 'example_general_editing_signal', '標準後台Signal修改功能的範本', '  // 這個是debug用的變數\r\n  $hidopname = ''[''.$hidop.''] '';', '1');

-- --------------------------------------------------------

--
-- 資料表格式： `t_tablename`
--

DROP TABLE IF EXISTS `t_tablename`;
CREATE TABLE IF NOT EXISTS `t_tablename` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應專案的編號',
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '資料表別名',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '實際名稱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='資料表別名與實際名稱的對應表' AUTO_INCREMENT=20 ;

--
-- 列出以下資料庫的數據： `t_tablename`
--

INSERT INTO `t_tablename` (`id`, `project_id`, `alias`, `name`) VALUES
(3, 3, '_TABLE_COMMUNITY', 't_community'),
(2, 1, '_TABLE_CAPACITYS', 'capacitys'),
(4, 1, '_TABLE_CATEGORIES', 'categories'),
(5, 1, '_TABLE_COMPANYS', 'companys'),
(6, 1, '_TABLE_COMPANYS_GROUP', 'companys_group'),
(7, 1, '_TABLE_CRAFTS', 'craft'),
(8, 1, '_TABLE_MANUFACTURERS', 'manufacturers'),
(9, 1, '_TABLE_MANUFACTURERS_CRAFTS', 'manufacturers_craft'),
(10, 1, '_TABLE_PRICE_DYNAMIC', 'price_dynamic'),
(11, 1, '_TABLE_PRICE_STATIC', 'price_static'),
(12, 1, '_TABLE_PRODUCTS', 'products'),
(13, 1, '_TABLE_QUANTITYS', 'quantity'),
(14, 1, '_TABLE_WEIGHTS', 'weights'),
(15, 1, '_TABLE_MANUFACTURERS_CATEGORIES', 't_manufacturers_categories'),
(16, 5, '_TABLE_ORDERS', 'orders'),
(17, 5, '_TABLE_PRODUCTS', 'product'),
(18, 5, '_TABLE_ORDERITEMS', 'orderitem'),
(19, 6, '_TABLE_RADACCT', 'radacct');

-- --------------------------------------------------------

--
-- 資料表格式： `t_theme`
--

DROP TABLE IF EXISTS `t_theme`;
CREATE TABLE IF NOT EXISTS `t_theme` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '編號',
  `project_id` int(5) NOT NULL COMMENT '對應的專案編號',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '風格名稱',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='網站的風格' AUTO_INCREMENT=5 ;

--
-- 列出以下資料庫的數據： `t_theme`
--

INSERT INTO `t_theme` (`id`, `project_id`, `name`, `description`) VALUES
(1, 1, 'red', '紅色的'),
(2, 5, 'default', '預設的'),
(3, 3, 'default', '預設的風格'),
(4, 7, 'default', '預設的');
