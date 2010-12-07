<?php /* Smarty version 2.6.22, created on 2009-02-09 09:47:30
         compiled from procedure/detail.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['procedure'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">程序名稱</td>
      <td>
        <font color="red">*建議使用以"sp_"開頭的名稱</font><br>
        <input name="name" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">描述</td>
      <td><input name="description" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['description']; ?>
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
      <td class="hed">程序內容</td>
      <td>
        <font color="red">*只要BEGIN~END(含)區塊內的東西就可以了</font><br>
        
                <select id="static_id" onchange="js_insert_text('beginbody',this.options[this.selectedIndex].value);this.selectedIndex=0">
          <option value="">插入保留字</option>
          <option value="%_PROC_VER_%">程序的版本</option>
        </select>
        
                        <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['tablenames'];
         ?>
        <select id="tablename_id" onchange="js_insert_text('beginbody',this.options[this.selectedIndex].text);this.selectedIndex=0">
          <option value="">插入資料表別名</option>
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
              %<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['alias']; ?>
%
            </option>
          <?php endfor; endif; ?>
        </select>
        
                        <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['arguments'];
         ?>
        <select id="argument_id" onchange="js_insert_text('beginbody',this.options[this.selectedIndex].value);this.selectedIndex=0">
          <option value="">插入欄位名稱</option>
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
            <option value="<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name']; ?>
">
              <?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['description']; ?>

            </option>
          <?php endfor; endif; ?>
        </select>        

        <br>
        <textarea id="beginbody" name="beginbody" cols="40" rows="30" onkeydown="TraceCursorPosition(this)" onkeypress="TraceCursorPosition(this)" onfocus="TraceCursorPosition(this)" onselect="TraceCursorPosition(this)" onmouseover="TraceCursorPosition(this)" onmousedown="TraceCursorPosition(this)"><?php echo $this->_tpl_vars['row']['beginbody']; ?>
</textarea>
      </td>
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