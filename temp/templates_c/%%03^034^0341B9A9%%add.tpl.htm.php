<?php /* Smarty version 2.6.22, created on 2009-02-08 21:31:41
         compiled from install_script/add.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['installscript'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">描述</td>
      <td><input name="description" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">檔案路徑</td>
      <td>
        <font color="red">*作業系統中的絕對路徑</font><br>
        <input name="path" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['path']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">程序內容</td>
      <td>
        <textarea id="txtbody" name="txtbody" cols="40" rows="30" onkeydown="TraceCursorPosition(this)" onkeypress="TraceCursorPosition(this)" onfocus="TraceCursorPosition(this)" onselect="TraceCursorPosition(this)" onmouseover="TraceCursorPosition(this)" onmousedown="TraceCursorPosition(this)"><?php echo $this->_tpl_vars['row']['txtbody']; ?>
</textarea>
      </td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>