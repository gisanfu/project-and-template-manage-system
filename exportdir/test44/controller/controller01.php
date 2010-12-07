<?php

// Controller Name => controller01
/*
 Update: 2009-1-9
 FileName: 檔名
 */

// 讀取全域設定檔
include_once("config.php");

$thisfilename = '請放本支程式的檔名';

//  把Get或Post所傳來的東西轉換成變數
if( $_GET["hidop"] != '' ){
  $hidop = $_GET["hidop"];
  $id    = $_GET["id"];
} elseif( $_POST["hidop"] != '' ){
  $hidop = $_POST["hidop"];
  $id    = $_POST["id"];
} else {
  echo 'no arg error';
  exit;
}

// 這裡只是做debug用的
$rows = array(); // debug use
$rows = $_POST;
include('pages/debug-db-result.php');
$rows = $_GET;
include('pages/debug-db-result.php');

if( $hidop == 'example_general_editing_signal' ){

  // Signal Body => example_general_editing_signal
  // 這個是debug用的變數
  $hidopname = '['.$hidop.'] ';

  // Block Name => block01
  act_DbConnect();

  $sql = 'select * from '._TABLE_WEIGHTS.' where id='.$id;
  $debuglines[] = $sql;
  
  $result = mysql_query($sql) or $status = 'error';
  if( $status == 'error' ){
    $errmsg = mysql_error();
    include('pages/smarty-error.php');
  }
  $row  = array();
  $row = mysql_fetch_array($result,MYSQL_ASSOC);
  include('pages/debug-db-result.php');
  $weight = $row;
  $smarty->assign("weight",$weight);
  
  act_DbDisconnect($result,$link);

  // Page Name => example_general_admin_index_page
  $smarty->assign('targetpost',$thisfilename);
  $smarty->assign('debuglines',$debuglines);
  $smarty->assign("weight",$weight);
  $smarty->assign("id",$id);
  $smarty->assign("hidop","輸入你的Signal名稱!!");

  $smarty->display('PAGE_example_general_admin_index_page/view.tpl.htm');

} else {
  echo 'miss arg';
  exit;
}

?>