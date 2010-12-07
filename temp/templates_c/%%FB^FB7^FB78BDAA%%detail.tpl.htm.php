<?php /* Smarty version 2.6.22, created on 2009-02-08 09:10:39
         compiled from type/detail.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['weight']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  欄位型態資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">型態名稱</td>
      <td><input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
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