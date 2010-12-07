<?php /* Smarty version 2.6.22, created on 2009-02-09 09:51:43
         compiled from argument/list.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'argument/list.tpl.htm', 35, false),)), $this); ?>
所在位置:
/<a href="dase-project.php?hidop=funclist&id=<?php echo $this->_tpl_vars['project_id']; ?>
"><?php echo $this->_tpl_vars['projectname']; ?>
</a>/<a href="dase-proc.php?hidop=list&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
">程序管理</a>/<?php echo $this->_tpl_vars['procedurename']; ?>
欄位列表<br><br>

<a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=adding&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
&procedure_id=<?php echo $this->_tpl_vars['procedure_id']; ?>
" style="text-decoration:none;color:#0052D9;">
  [add]
  新增欄位
</a>

<br>
程序的引數
<br>

<?php $this->_tpl_vars['rows'] = $this->_tpl_vars['arguments']; ?>

<?php if (count ( $this->_tpl_vars['rows'] ) <= 0): ?>
  無資料
<?php else: ?>
  <table class="stats" cellspacing="0">
  <tr>
    <td class="hed">順序</td>
    <td class="hed">欄位名稱</td>
    <td class="hed">描述</td>
    <td class="hed">型態</td>
    <td class="hed">長度</td>
    <td class="hed">required</td>
    <td class="hed">是否啟用</td>    
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
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['sequence'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['name'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['description'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['type_name'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['length'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php if ($this->_tpl_vars['rows'][$this->_sections['num01']['index']]['required'] == '1'): ?>
          必要
        <?php else: ?>
          非必要
        <?php endif; ?>
      </td>
      <td>
        <?php if ($this->_tpl_vars['rows'][$this->_sections['num01']['index']]['enable'] == '1'): ?>
          啟用
        <?php else: ?>
          停用
        <?php endif; ?>
      </td>
      <td>
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=editing&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&project_id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['project_id']; ?>
&procedure_id=<?php echo $this->_tpl_vars['procedure_id']; ?>
">
            修改
          </a>
        </div>
      </td>
      <td>
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&hidop=del"  onclick="return confirm('真的要刪除嗎？')">
            刪除
          </a>
        </div>
      </td>
    </tr>
  <?php endfor; endif; ?>
  </table>
  
    <?php echo $this->_tpl_vars['viewlist']; ?>

  
<?php endif; ?>