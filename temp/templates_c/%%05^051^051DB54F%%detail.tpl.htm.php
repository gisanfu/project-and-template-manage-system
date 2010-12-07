<?php /* Smarty version 2.6.22, created on 2009-02-09 09:51:53
         compiled from argument/detail.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['argument']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  欄位資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">欄位名稱</td>
      <td>
        <font color="red">*建議以"f_"開頭當做欄位的名稱</font><br>
        <input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">描述</td>
      <td>
        <font color="red">*必填,在修改程序內文的時候，會出現在下拉式選單</font><br>
        <input name="description" type="text" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">型態</td>
      <td>
                <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['types']; ?>
        <select name="type_id">
        <option value="<?php echo $this->_tpl_vars['row']['type_id']; ?>
"><?php echo $this->_tpl_vars['row']['type_name']; ?>
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
      <td class="hed">長度</td>
      <td>
        <font color="red">*這個欄位的功能尚未啟用</font><br>
        <input name="length" type="text" value="<?php echo $this->_tpl_vars['row']['length']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">required</td>
      <td>
        定義這個欄位為必要<br>
        在呼叫這個程序時<br>
        這個欄位也必需要帶值<br>
        <input type="radio" name="required" VALUE="1" 
          <?php if ($this->_tpl_vars['row']['required'] > 0): ?>
            checked
          <?php endif; ?>
        />啟用<br>
        <input type="radio" name="required" VALUE="0" 
                    <?php if ($this->_tpl_vars['row']['required'] <= 0 || $this->_tpl_vars['row']['required'] == ''): ?>
            checked
          <?php endif; ?>        
        />停用<br>
      </td>
    </tr>
    <tr>
      <td class="hed">是否啟用</td>
      <td>
        停用就等同於沒有這個欄位<br>
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
      <td class="hed">順序</td>
      <td>
        請指定2~n的欄位順序編號<br>
        順序1，通常是版本號所占用<br>
        <input name="sequence" type="text" value="<?php echo $this->_tpl_vars['row']['sequence']; ?>
"/>
      </td>
    </tr>
  </table>
  <br>
   
  <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input name="project_id" type="hidden" value="<?php echo $this->_tpl_vars['project_id']; ?>
" />
  <input name="procedure_id" type="hidden" value="<?php echo $this->_tpl_vars['procedure_id']; ?>
" />
  <input name="hidop" type="hidden" value="<?php echo $this->_tpl_vars['hidop']; ?>
" />
  <input value="送出" type="submit" />

</form>