<?php /* Smarty version 2.6.22, created on 2009-02-08 21:30:49
         compiled from normal/status.tpl.htm */ ?>
<h2><?php echo $this->_tpl_vars['message']; ?>
</h2>

<?php if ($this->_tpl_vars['redir'] != ''): ?>
<br />
如果瀏覽器沒有自動回到上層頁面，請按以下的超連結<br />
<a href="<?php echo $this->_tpl_vars['redir']; ?>
">回上層</a><br />
<?php endif; ?>