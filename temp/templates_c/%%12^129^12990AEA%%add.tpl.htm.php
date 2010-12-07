<?php /* Smarty version 2.6.22, created on 2009-02-09 09:37:19
         compiled from project/add.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['project']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  專案資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">專案名稱</td>
      <td><input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">檔案路徑</td>
      <td>
        *ex => /home/user/project/exportdir<br>
        *在設定這個資料夾之前，請先不要建立<br>
        <input name="exportdir" type="text" size="50" value="<?php echo $this->_tpl_vars['row']['exportdir']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">網址</td>
      <td>
        *ex => http://www.pchome.com.tw/index.php<br>
        <input name="httpaddress" type="text" size="50" value="<?php echo $this->_tpl_vars['row']['httpaddress']; ?>
"/>
      </td>
    </tr> 
    <tr>
      <td class="hed">描述</td>
      <td><input name="description" type="text" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/></td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>