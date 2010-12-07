<?php /* Smarty version 2.6.22, created on 2009-02-09 16:10:00
         compiled from package/detail.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['procedure'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">別名</td>
      <td>
        例如: mysql<font color="red">*必填</font><br>
        <input name="alias" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['alias']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">套件名稱</td>
      <td>
        例如: mysql-5.0.51b.tar.gz<font color="red">*必填</font><br>
        <input name="name" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">解壓後名稱</td>
      <td>
        例如: mysql-5.0.51b<font color="red">*必填</font><br>
        <input name="unzip" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['unzip']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">下載的來源</td>
      <td>
        <font color="red">*必填</font><br>
        <input name="downloadlink" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['downloadlink']; ?>
"/>
      </td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="package_company_id" type="hidden" value="<?php echo $this->_tpl_vars['package_company_id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>