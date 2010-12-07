<?php /* Smarty version 2.6.22, created on 2009-02-09 09:41:23
         compiled from project_db/list.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'project_db/list.tpl.htm', 35, false),)), $this); ?>
所在位置:
/<a href="dase-project.php?hidop=funclist&id=<?php echo $this->_tpl_vars['project_id']; ?>
"><?php echo $this->_tpl_vars['cg_name']; ?>
</a>/資料庫連線列表<br><br>

<a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=adding&project_id=<?php echo $this->_tpl_vars['project_id']; ?>
" style="text-decoration:none;color:#0052D9;">
  [add]
  新增資料庫連線
</a>

<br>
這裡可以建立多筆需要維護的資料庫主機
<br>

<?php $this->_tpl_vars['rows'] = $this->_tpl_vars['project_dbs']; ?>

<?php if (count ( $this->_tpl_vars['rows'] ) <= 0): ?>
  無資料
<?php else: ?>
  <table class="stats" cellspacing="0">
  <tr>
    <td class="hed">別名</td>
    <td class="hed">主機位置</td>
    <td class="hed">主機埠號</td>
    <td class="hed">帳號</td>
    <td class="hed">資料庫名稱</td>
    <td class="hed">程序狀態/更新</td>
    <td class="hed">匯出連線設定</td>
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
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['alias'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['host'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['port'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['user'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
      <td>
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['rows'][$this->_sections['num01']['index']]['dbname'])) ? $this->_run_mod_handler('default', true, $_tmp, "&nbsp;") : smarty_modifier_default($_tmp, "&nbsp;")); ?>

      </td>
            <td>
                <?php if ($this->_tpl_vars['rows'][$this->_sections['num01']['index']]['connectstatus'] == '1'): ?>
          連線失敗!!!
        <?php else: ?>
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=procupdate&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&project_id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['project_id']; ?>
">
            最新版(<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['newfield']; ?>
) 需更新(<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['oldfield']; ?>
) 停用(<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['disable']; ?>
) 失敗(<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['failfield']; ?>
)
          </a>
        <?php endif; ?>
      </td>
            <td>
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=exportsqlconnect&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&project_id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['project_id']; ?>
">
            匯出
          </a>
        </div>
      </td>
      <td>
        <div align="center">
          <a href="<?php echo $this->_tpl_vars['targetpost']; ?>
?hidop=editing&id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['id']; ?>
&project_id=<?php echo $this->_tpl_vars['rows'][$this->_sections['num01']['index']]['project_id']; ?>
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