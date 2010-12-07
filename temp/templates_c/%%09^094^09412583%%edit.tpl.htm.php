<?php /* Smarty version 2.6.22, created on 2009-02-09 16:05:59
         compiled from install_script/edit.tpl.htm */ ?>
<?php 
  $this->_tpl_vars['row'] = array();
  $this->_tpl_vars['row'] = $this->_tpl_vars['installscript'];
 ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  程序資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">描述</td>
      <td>
        例如: Freebsd64 + Apache2 + PHP5<br>
        <input name="description" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['description']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">檔案路徑</td>
      <td>
        <font color="red">*作業系統中的絕對路徑</font><br>
        <input name="path" type="text" size="60" value="<?php echo $this->_tpl_vars['row']['path']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">所使用的套件</td>
      <td>
        套件公司名稱:
                <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['packagecompanys']; ?>
        <select id="packagecompany_id" onchange="xajax_ajax_update_package_select(this.options[this.selectedIndex].value,this.options[this.selectedIndex].text);this.selectedIndex=0">
          <option value=""></option>
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
        (輔助選擇)
        <br>
        套件名稱:
        <select id="packages_hide_select" onchange="xajax_ajax_package_update(<?php echo $this->_tpl_vars['id']; ?>
,this.options[this.selectedIndex].value,'add');this.selectedIndex=0">
          <option value=""></option>
        </select>
        (請選擇)
        <br>
        所使用的套件:<br>
        <div id="usepackage"></div>
      </td>
    </tr>
    <tr>
      <td class="hed">程序內容</td>
      <td>
                        <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['packages'];
         ?>
        <select onchange="js_insert_text('txtbody',this.options[this.selectedIndex].text);this.selectedIndex=0">
          <option value="">插入套件別名</option>
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
_package%
            </option>
          <?php endfor; endif; ?>
        </select>
                        <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['packages'];
         ?>
        <select onchange="js_insert_text('txtbody',this.options[this.selectedIndex].text);this.selectedIndex=0">
          <option value="">插入套件解壓後別名</option>
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
_unzipdir%
            </option>
          <?php endfor; endif; ?>
        </select>
        <br>
        <textarea id="txtbody" name="txtbody" cols="40" rows="30" onkeydown="TraceCursorPosition(this)" onkeypress="TraceCursorPosition(this)" onfocus="TraceCursorPosition(this)" onselect="TraceCursorPosition(this)" onmouseover="TraceCursorPosition(this)" onmousedown="TraceCursorPosition(this)"><?php echo $this->_tpl_vars['row']['txtbody']; ?>
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

<script type="text/javascript">
    window.onload= function(){ 
    xajax_ajax_package_update(<?php echo $this->_tpl_vars['id']; ?>
,'','update');
  }</script>