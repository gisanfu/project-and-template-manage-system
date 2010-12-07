<?php /* Smarty version 2.6.22, created on 2009-02-08 09:08:05
         compiled from language/list.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'language/list.tpl.htm', 26, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=adding" style="text-decoration:none;color:#0052D9;">
  [add]
  新增程式語言
</a>

<br>

<?php $this->_tpl_vars['rows'] = $this->_tpl_vars['languages']; ?>

<?php if (count ( $this->_tpl_vars['rows'] ) <= 0): ?>
  無資料
<?php else: ?>
  <table class="stats" cellspacing="0">
  <tr>
    <td class="hed">簡稱</td>
    <td class="hed">實際名稱</td>
    <td class="hed">副檔名</td>
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
        <?php echo ((is_array($_tmp=$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['alias'])) ? $this->_run_mod_handler('cat', true, $_tmp, "&nbsp;") : smarty_modifier_cat($_tmp, "&nbsp;")); ?>

      </td>
            <td>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, "&nbsp;") : smarty_modifier_cat($_tmp, "&nbsp;")); ?>

      </td>
            <td>
        <?php echo ((is_array($_tmp=$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['fileexten'])) ? $this->_run_mod_handler('cat', true, $_tmp, "&nbsp;") : smarty_modifier_cat($_tmp, "&nbsp;")); ?>

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
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&hidop=del" 
             onclick="return confirm('真的要刪除嗎？')">
            刪除
          </a>
        </div>
      </td>
    </tr>
  <?php endfor; endif; ?>
  </table>
  
    <?php echo $this->_tpl_vars['viewlist']; ?>

  
<?php endif; ?>