<?php /* Smarty version 2.6.22, created on 2009-02-08 09:08:02
         compiled from index.tpl.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'config_load', 'index.tpl.htm', 1, false),)), $this); ?>
<?php echo smarty_function_config_load(array('file' => "vars.conf"), $this);?>


<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-TW">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>程式輔助開發平台</title>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'normal/left.head.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src="includes/myjs/divcontrol.js"></script>

<?php if ($this->_tpl_vars['smarty_head'] != ''): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['smarty_head'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

</head>

<body>

<?php if ($this->_config[0]['vars']['debug'] == 1): ?>
  <?php $this->_tpl_vars['rows'] = $this->_tpl_vars['debuglines']; ?>
  <a href="#" style="text-decoration:none" onclick="DivViewControl('debug_div01')" title="Debug訊息">
    [debug]
  </a>
  <div id="debug_div01" style="display:none">
    <font color="#FF0000">
    <?php unset($this->_sections['nums']);
$this->_sections['nums']['name'] = 'nums';
$this->_sections['nums']['loop'] = is_array($_loop=$this->_tpl_vars['rows']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nums']['show'] = true;
$this->_sections['nums']['max'] = $this->_sections['nums']['loop'];
$this->_sections['nums']['step'] = 1;
$this->_sections['nums']['start'] = $this->_sections['nums']['step'] > 0 ? 0 : $this->_sections['nums']['loop']-1;
if ($this->_sections['nums']['show']) {
    $this->_sections['nums']['total'] = $this->_sections['nums']['loop'];
    if ($this->_sections['nums']['total'] == 0)
        $this->_sections['nums']['show'] = false;
} else
    $this->_sections['nums']['total'] = 0;
if ($this->_sections['nums']['show']):

            for ($this->_sections['nums']['index'] = $this->_sections['nums']['start'], $this->_sections['nums']['iteration'] = 1;
                 $this->_sections['nums']['iteration'] <= $this->_sections['nums']['total'];
                 $this->_sections['nums']['index'] += $this->_sections['nums']['step'], $this->_sections['nums']['iteration']++):
$this->_sections['nums']['rownum'] = $this->_sections['nums']['iteration'];
$this->_sections['nums']['index_prev'] = $this->_sections['nums']['index'] - $this->_sections['nums']['step'];
$this->_sections['nums']['index_next'] = $this->_sections['nums']['index'] + $this->_sections['nums']['step'];
$this->_sections['nums']['first']      = ($this->_sections['nums']['iteration'] == 1);
$this->_sections['nums']['last']       = ($this->_sections['nums']['iteration'] == $this->_sections['nums']['total']);
?>
      <?php echo $this->_tpl_vars['rows'][$this->_sections['nums']['index']]; ?>
<br />
    <?php endfor; endif; ?>
    </font>
    <div id="debugdiv"></div>
  </div>
<?php endif; ?>

<table border="0" width="932" align="center">
  <tr>
    <td colspan="2">
            
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'normal/top.tpl.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
  </tr>
  <tr>
    <td style="vertical-align:top" width="150">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'normal/left.tpl.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
    <td ALIGN=left VALIGN=top>
            <?php if ($this->_tpl_vars['smarty_content'] != ''): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['smarty_content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php else: ?>
        沒有可載入的樣版
      <?php endif; ?>
    </td>
  </tr>
  <tr>
    <td colspan="2">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'normal/bottom.tpl.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td>
  </tr>
</table>

</body>
</html>