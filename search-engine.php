<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");

$thisfilename = 'search-engine.php';

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

$query = $_GET["query"];

if (!$query){
    echo 'not found'."\n";
    return;  
}

// 即時搜尋資料庫裡的總公司資料，這個是原價和特價都會有的
if( $hidop == 'searchcodes'){  
  
    act_DbConnect();
        
    $sql = "select 
              d.id,
              concat(d.alias,'(',g.alias,')') as name
            from "._TABLE_CODE." as d
            left join "._TABLE_LANGUAGE." as g on d.language_id=g.id
            where d.alias like '%".$query."%'
           ";
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    //$rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
        echo $row["name"].'	'.$row["id"].'	'.'['.$hidop.'] '.mysql_error()."\n";
    }
    include('pages/debug-db-result.php');
    
    act_DbDisconnect($result,$link); 
    
    exit;
    
// 如果修件都不符合的話，就會到這裡來
} else {
    //$smarty->assign("function","詳細資料");
    //$smarty->display('detail.tpl.htm');
    echo 'miss arg'."\n";
    exit;
}