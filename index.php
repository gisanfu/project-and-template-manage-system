<?php
include('config.php');
/* This will give an error. Note the output
 * above, which is before the header() call */
header('Location: dase-project.php?hidop=list');

// $smarty->assign('smarty_content','normal/welcome.tpl.htm');
// $smarty->display('index.tpl.htm');
?>
