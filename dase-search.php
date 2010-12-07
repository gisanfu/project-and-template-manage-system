<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");

$thisfilename = 'dase-search.php';
$pagedir = 'search';

// function select. add, or edit
//$hidop    = $_POST["hidop"];

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

// debug GET and POST variables
$rows = array(); // debug use
$rows = $_POST;
include('pages/debug-db-result.php');
$rows = $_GET;
include('pages/debug-db-result.php');

if( $hidop == 'list'){
        
    $xajax=new xajax();
    //$xajax->debugOn();
    $xajax->registerFunction("ajax_code_update");
    $xajax->processRequests();    
    $smarty->assign('xajax_javascript', $xajax->getJavascript('./includes/xajax/'));
       
    $smarty->assign('smarty_head',$pagedir.'/list.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->display('index.tpl.htm');

// 如果修件都不符合的話，就會到這裡來
} else {
    //$smarty->assign("function","詳細資料");
    //$smarty->display('detail.tpl.htm');
    echo 'miss arg';
    exit;
}

?>