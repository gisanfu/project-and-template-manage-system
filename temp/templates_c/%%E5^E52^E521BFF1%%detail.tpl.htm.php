<?php /* Smarty version 2.6.22, created on 2009-02-16 06:30:51
         compiled from project_db/detail.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['project_db'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">別名</td>
      <td>
        *只是讓管理者好分辦這筆的作用<br>
        <input name="alias" type="text" value="<?php echo $this->_tpl_vars['row']['alias']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">目標主機</td>
      <td>
        *本地端請填localhost<br>
        *OpenSSH Tunneling請填127.0.0.1<br>
        <input name="host" type="text" value="<?php echo $this->_tpl_vars['row']['host']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">主機埠號</td>
      <td>
        *不填的話，預設是3306<br>
        <input name="port" type="text" value="<?php echo $this->_tpl_vars['row']['port']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">帳號</td>
      <td><input name="user" type="text" value="<?php echo $this->_tpl_vars['row']['user']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">密碼</td>
      <td><input name="pass" type="password" value="<?php echo $this->_tpl_vars['row']['pass']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">資料庫名稱</td>
      <td><input name="dbname" type="text" value="<?php echo $this->_tpl_vars['row']['dbname']; ?>
"/></td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="project_id" type="hidden" value="<?php echo $this->_tpl_vars['project_id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>