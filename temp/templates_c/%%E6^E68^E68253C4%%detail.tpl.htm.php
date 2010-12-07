<?php /* Smarty version 2.6.22, created on 2009-02-14 22:49:49
         compiled from code/detail.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['code']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">程式碼別名</td>
      <td><input name="alias" type="text" value="<?php echo $this->_tpl_vars['row']['alias']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">程式語言</td>
      <td>
                <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['languages']; ?>
        <select name="language_id">
          <option value="<?php echo $this->_tpl_vars['row']['language_id']; ?>
"><?php echo $this->_tpl_vars['row']['language_name']; ?>
</option>
          <?php unset($this->_sections['num01']);
$this->_sections['num01']['name'] = 'num01';
$this->_sections['num01']['loop'] = is_array($_loop=$this->_tpl_vars['rows']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['num01']['show'] = true;
$this->_sections['num01']['max'] = $this->_sections['num01']['loop'];
$this->_sections['num01']['step'] = 1;
$this->_sections['num01']['start'] = $this->_sections['num01']['step'] > 0 ? 0 : $this->_sections['num01']['loop']-1;
if ($this->_sections['num01']['show']) {
    $this->_sections['num01']['total'] = $this->_sections['num01']['loop'];
    if ($this->_sections['num01']['total'] == 0)
        $this->_sections['num01']['show'] = false;
} else
    $this->_sections['num01']['total'] = 0;
if ($this->_sections['num01']['show']):

            for ($this->_sections['num01']['index'] = $this->_sections['num01']['start'], $this->_sections['num01']['iteration'] = 1;
                 $this->_sections['num01']['iteration'] <= $this->_sections['num01']['total'];
                 $this->_sections['num01']['index'] += $this->_sections['num01']['step'], $this->_sections['num01']['iteration']++):
$this->_sections['num01']['rownum'] = $this->_sections['num01']['iteration'];
$this->_sections['num01']['index_prev'] = $this->_sections['num01']['index'] - $this->_sections['num01']['step'];
$this->_sections['num01']['index_next'] = $this->_sections['num01']['index'] + $this->_sections['num01']['step'];
$this->_sections['num01']['first']      = ($this->_sections['num01']['iteration'] == 1);
$this->_sections['num01']['last']       = ($this->_sections['num01']['iteration'] == $this->_sections['num01']['total']);
?>
            <option value="<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
">
              <?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name']; ?>

            </option>
          <?php endfor; endif; ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="hed">描述</td>
      <td><input name="description" type="text" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">程式碼內容</td>
      <td><textarea name="codebody" cols="40" rows="30"><?php echo $this->_tpl_vars['row']['codebody']; ?>
</textarea></td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>