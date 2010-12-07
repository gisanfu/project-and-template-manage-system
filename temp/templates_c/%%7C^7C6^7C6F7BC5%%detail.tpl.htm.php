<?php /* Smarty version 2.6.22, created on 2009-02-08 21:49:55
         compiled from package_company/detail.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['packagecompany'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">公司名稱</td>
      <td>
        <input name="name" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">首頁</td>
      <td><input name="homepage" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['homepage']; ?>
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