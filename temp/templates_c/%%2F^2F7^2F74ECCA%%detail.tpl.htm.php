<?php /* Smarty version 2.6.22, created on 2009-04-23 13:47:06
         compiled from library_category/detail.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['category'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  函式分類資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">分類名稱</td>
      <td>
        <input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>