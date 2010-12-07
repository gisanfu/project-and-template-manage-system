<?php /* Smarty version 2.6.22, created on 2009-02-11 14:24:49
         compiled from controller/edit.tpl.htm */ ?>
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
      <td class="hed">所包含的信號區塊</td>
      <td>
        *這裡是可以複選的<br>
        <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['signals']; ?>
        <select id="signal_hide_select" onchange="xajax_ajax_signal_update(<?php echo $this->_tpl_vars['id']; ?>
,this.options[this.selectedIndex].value,'add')">
          <option value="">請選擇區塊</option>
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
        <div id="usesignal"></div>
      </td>
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
      <td class="hed">php程式內容</td>
      <td>
        <font color="red">*放PHP程式的東西</font><br>
        
                <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['tablenames'];
         ?>
        <select id="php_tablename_id" onchange="js_insert_text('phpbody',this.options[this.selectedIndex].value);this.selectedIndex=0">
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
            <option value="<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['alias']; ?>
">
              <?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name']; ?>

            </option>
          <?php endfor; endif; ?>
        </select>
        
                <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['phpfunctions'];
         ?>
        <select id="php_phpfunction_id" onchange="js_insert_text('phpbody',this.options[this.selectedIndex].value);this.selectedIndex=0">
          <option value="">插入PHP函式</option>
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
            <option value="<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['selectvalue']; ?>
">
              <?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['selecttext']; ?>

            </option>
          <?php endfor; endif; ?>
        </select>
        
        <br>
        
        <textarea id="phpbody" name="phpbody" cols="40" rows="30" onkeydown="TraceCursorPosition(this)" onkeypress="TraceCursorPosition(this)" onfocus="TraceCursorPosition(this)" onselect="TraceCursorPosition(this)" onmouseover="TraceCursorPosition(this)" onmousedown="TraceCursorPosition(this)"><?php echo $this->_tpl_vars['row']['phpbody']; ?>
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

<script type="text/javascript">
    window.onload= function(){ 
    xajax_ajax_signal_update(<?php echo $this->_tpl_vars['id']; ?>
,'','update');
  }</script>