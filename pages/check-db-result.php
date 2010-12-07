<?php
  // 這個檔案，主要是要分擔主php的程式碼量
  if($debug == 1 ) $debuglines[] = $sql;
  if(!$result){
    // 如果有問題，先把之前所有將要assign到smarty的變數都清掉
    $smarty->clear_all_assign(); 
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    // 不用轉頁
    $debuglines[] = 'Failed to query database';
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('message','操作發生異常問題，請洽管理人員');
    $smarty->display('index.tpl.htm');
    exit;
  }/* !result */  
?>