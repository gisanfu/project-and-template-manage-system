<?php /* Smarty version 2.6.22, created on 2009-02-08 09:08:25
         compiled from project/edit.tpl.htm */ ?>
<?php $this->_tpl_vars['row'] = $this->_tpl_vars['project']; ?>

<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">
  專案資料<br />

  <table class="stats" cellspacing="0">
    <tr>
      <td class="hed">專案名稱</td>
      <td><input name="name" type="text" value="<?php echo $this->_tpl_vars['row']['name']; ?>
"/></td>
    </tr>
    <tr>
      <td class="hed">檔案路徑</td>
      <td>
        *ex => /home/user/project/exportdir<br>
        *在設定這個資料夾之前，請先不要建立<br>
        <input name="exportdir" type="text" size="50" value="<?php echo $this->_tpl_vars['row']['exportdir']; ?>
"/>
      </td>
    </tr>
    <tr>
      <td class="hed">網址</td>
      <td>
        *ex => http://www.pchome.com.tw/index.php<br>
        <input name="httpaddress" type="text" size="50" value="<?php echo $this->_tpl_vars['row']['httpaddress']; ?>
"/>
      </td>
    </tr> 
    <tr>
      <td class="hed">風格</td>
      <td>
                <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['themes']; ?>
        <select name="theme_id">
          <option value="<?php echo $this->_tpl_vars['row']['theme_id']; ?>
"><?php echo $this->_tpl_vars['row']['theme_name']; ?>
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
      <td class="hed">所包含的<br>函式檔案</td>
      <td>
        *這裡是可以複選的<br>
        <?php 
          $this->_tpl_vars['rows'] = array();
          $this->_tpl_vars['rows'] = $this->_tpl_vars['files'];
         ?>
        <select id="libraryfile_hide_select" onchange="xajax_ajax_libraryfile_update(<?php echo $this->_tpl_vars['id']; ?>
,this.options[this.selectedIndex].value,'add');this.selectedIndex=0">
          <option value="">請選擇函式檔案</option>
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
        <div id="usefile"></div>
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
    xajax_ajax_libraryfile_update(<?php echo $this->_tpl_vars['id']; ?>
,'','update');
  }</script>