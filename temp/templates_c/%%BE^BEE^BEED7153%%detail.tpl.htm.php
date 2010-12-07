<?php /* Smarty version 2.6.22, created on 2009-02-09 09:42:56
         compiled from tablename/detail.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['tablename']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">資料表別名</td>
      <td>
        <font color="red">
          *這個欄位<br>
          是在程序的內容中可以使用<br>
          使用方式為=>%別名%</font><br>
        <input name="alias" type="text" value="<?php echo $this->_tpl_vars['row']['alias']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">實際名稱</td>
      <td>
        <font color="red">*資料表的實際名稱</font><br>
        <input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
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