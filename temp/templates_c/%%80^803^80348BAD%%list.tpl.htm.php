<?php /* Smarty version 2.6.22, created on 2009-02-08 09:08:02
         compiled from project/list.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'project/list.tpl.htm', 36, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=adding" style="text-decoration:none;color:#0052D9;">
  [add]
  新增專案
</a>

<br>
每個專案都能擁有多個mysql程序<br>
還有資料表的別名對應(這樣改資料表名稱的時候，就不用去修改程序)<br>
還有多個資料庫連線資料(像是本機測試的資料庫、與正式站台的資料庫，這樣就有2個了)
<br>

<?php 
  $this->_tpl_vars['rows'] = array();
  $this->_tpl_vars['rows'] = $this->_tpl_vars['projects'];
 ?>

<?php if (count ( $this->_tpl_vars['rows'] ) <= 0): ?>
  無資料
<?php else: ?>
  <table class="stats" cellspacing="0">
  <tr>
    <td class="hed">專案名稱</td>
    <td class="hed">檔案路徑</td>
    <td class="hed" width="40">網址</td>
    <td class="hed" width="60">風格</td>
    <td class="hed">描述</td>
    <td class="hed" width="70">功能總覽</td>
    <td class="hed" width="40">修改</td>
    <td class="hed" width="40">刪除</td>  
  </tr>
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
    <tr>
            <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
            <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['exportdir'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
            <td>
        <?php if ($this->_tpl_vars['rows'][$this->_sections['num01']['index']]['httpaddress'] == ''): ?>
          none
        <?php else: ?>
          <a href="<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['httpaddress']; ?>
" target=_blank>連結</a>
        <?php endif; ?>
      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['theme_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['description'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
            <td>
        <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=funclist&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
">功能總覽</a>
      </td>
            <td>
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=editing&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
">
            修改
          </a>
        </div>
      </td>
            <td>
        <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&hidop=del" 
           onclick="return confirm('真的要刪除嗎？')">
          刪除
        </a>
      </td>
    </tr>
  <?php endfor; endif; ?>
  </table>
  
    <?php echo $this->_tpl_vars['viewlist']; ?>

  
<?php endif; ?>