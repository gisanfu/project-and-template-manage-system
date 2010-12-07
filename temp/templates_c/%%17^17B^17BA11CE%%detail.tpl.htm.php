<?php /* Smarty version 2.6.22, created on 2009-02-07 17:20:30
         compiled from controller_example/detail.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['controller']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  控制區塊資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">控制區塊名稱</td>
      <td>
        <input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">描述</td>
      <td><input name="description" type="text" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">是否啟用</td>
      <td>
        <input type="radio" name="enable" VALUE="1" 
                    <?php if ($this->_tpl_vars['row']['enable'] > 0): ?>
            checked
          <?php endif; ?>
        />啟用<br>
        <input type="radio" name="enable" VALUE="0" 
                    <?php if ($this->_tpl_vars['row']['enable'] <= 0 || $this->_tpl_vars['row']['enable'] == ''): ?>
            checked
          <?php endif; ?>        
        />停用<br>
      </td>
    </tr>
    <tr>
      <td class="hed">PHP程式內容</td>
      <td>
        <font color="red">*放html的東西，可以有Smarty的程式碼</font><br>
        <textarea name="phpbody" cols="40" rows="30"><?php echo $this->_tpl_vars['row']['phpbody']; ?>
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