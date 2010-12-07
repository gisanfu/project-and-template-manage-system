<?php /* Smarty version 2.6.22, created on 2009-05-22 06:31:55
         compiled from func_list/list.tpl.htm */ ?>
所在位置:
/<?php echo $this->_tpl_vars['cg_name']; ?>
/<br>

<br>
專案所屬的功能選項
<br><br>

資料庫類:<br>
<a href="dase-project-db.php?hidop=list&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
">連線管理</a><br>
<a href="dase-proc.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">程序管理</a><br>
<a href="dase-tablename.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">資料表別名管理</a><br>
<a href="dase-project-db.php?hidop=exportattr&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
">匯出欄位對應檔</a><font color="red">*會覆蓋(config/sql_attrs.php)</font><br>
<a href="dase-project-db.php?hidop=exportschema&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
">匯出欄位結構檔</a><font color="red">*會覆蓋(config/sql_schemas.php)</font><br>

<br>

系統類:<br>
<a href="dase-project.php?id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=exportsiterootfile">匯出SiteRoot路徑設定檔</a><font color="red">*會覆蓋</font><br>
<a href="dase-project.php?id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=exportlibraryfiles">匯出函式檔案</a><font color="red">*會覆蓋</font><br>
<a href="dase-project.php?id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=exportrootdir">建立目錄結構</a><br>

<br>

版面類:<br>
<a href="dase-block.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">Block區塊管理</a><br>
<a href="dase-page.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">Page區塊管理</a><br>
<a href="dase-signal.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">Signal區塊管理</a><br>
<a href="dase-controller.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">Controller區塊管理</a><br>
<a href="dase-theme.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=list">Theme區塊管理</a><br>
<a href="dase-controller.php?project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&hidop=exportallviewsandcontrollers">匯出版面所有區塊</a><br>