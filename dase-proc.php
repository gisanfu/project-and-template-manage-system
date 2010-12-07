<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-proc.php';

// function select. add, or edit
//$hidop    = $_POST["hidop"];

if( $_GET["hidop"] != '' ){
  $hidop = $_GET["hidop"];
  $id    = $_GET["id"];
  $project_id = $_GET["project_id"];
} elseif( $_POST["hidop"] != '' ){
  $hidop = $_POST["hidop"];
  $id    = $_POST["id"];
  $project_id = $_POST["project_id"];
} else {
  echo 'no arg error';
  exit;
}

// 這裡的欄位，是可以允許整數值為0
//if($gid==NULL)$gid=0;

// 分頁引數檢查區段
if(isset($_GET['page']) and $_GET['page'] != 0 and is_numeric($_GET['page'])){   //設定目前頁數
  $nowPage = $_GET['page'];
} else {
  $nowPage = 1;
}

// debug GET and POST variables
$rows = array(); // debug use
$rows = $_POST;
include('pages/debug-db-result.php');
$rows = $_GET;
include('pages/debug-db-result.php');

if( $hidop == 'list'){

    act_DbConnect();
    
    $sql = 'select * from '._TABLE_PROJECT.' where id='.$project_id;    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $cg_name = $row["name"];
    
    $sqlgetcount = 'select * from '._TABLE_PROCEDURE.' where project_id='.$project_id;    
    $result = mysql_query($sqlgetcount);
    $total  = mysql_num_rows($result);
    
    // SplitPage(顯示筆數,目前所在頁數,資料總數,總分頁數)
    $page = new SplitPage($nowPage, $total, _SPLITPAGE_TOTAL_RECORDS, 20);  //建構出 SplitPage 物件
    
    //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)
    $page->setViewList($thisfilename."?hidop=list&project_id=".$project_id.'&', 'test');  
    $viewlist = $page->viewlist;  // $page->viewlist 即為所產生的導覽列,就如同上圖所示.
    
    $sql = $sqlgetcount.' limit '.$page->started_record.', '.$page->records_per_page;
            
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $procedures = $rows;

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head','procedure/list.head.htm');
    $smarty->assign('smarty_content','procedure/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("cg_name",$cg_name);
    $smarty->assign("procedures",$procedures);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['project_id'] = $project_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['enable'] = $_POST["enable"];
    $sql_values['version'] = time();
    
    // 這個比較特別，因為textarea的關係，所以它送來的東西要先把跳脫字元拿掉
    $sql_values['beginbody'] = stripslashes($_POST["beginbody"]);
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_PROCEDURE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'update','id='.$id);

    act_DbConnect();
    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
        
    act_DbDisconnect(NULL,$link);
       
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','修改成功');
    $smarty->display('index.tpl.htm'); 
    exit;   
    
} elseif( $hidop == 'editing'){
        
    act_DbConnect();

    // 取得資料表別名，讓使用者可以一選就直接拉進textarea的欄位
    $sql = 'select * from '._TABLE_TABLENAME.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $tablenames = $rows;
    $smarty->assign("tablenames",$tablenames);
    
    // 取得程序所屬的欄位列表，讓使用者可以一選就直接拉進textarea的欄位
    $sql = 'select * from '._TABLE_ARGUMENT.' where procedure_id='.$id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $arguments = $rows;
    $smarty->assign("arguments",$arguments);

    $sql = 'select * from '._TABLE_PROCEDURE.' where id='.$id.' and project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $procedure = $row;
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head','procedure/detail.head.htm');
    $smarty->assign('smarty_content','procedure/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("procedure",$procedure);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){
        
    act_DbConnect();
    
    // 取得資料表別名，讓使用者可以一選就直接拉進textarea的欄位
    $sql = 'select * from '._TABLE_TABLENAME.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $tablenames = $rows;
    $smarty->assign("tablenames",$tablenames);
        
    // 讀取範本檔，挑一筆啟用的出來當範本
    $sql = 'select * from '._TABLE_PROCEDURE_EXAMPLE." where enable='1'";
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $procedure = $row;
    
    act_DbDisconnect($result,$link);

    $smarty->assign('smarty_head','procedure/detail.head.htm');
    $smarty->assign('smarty_content','procedure/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('procedure',$procedure);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
} elseif( $hidop == 'add'){ 
        
    act_DbConnect();
        
    // 建立新的程序
    $sql_values = array();
    $sql_values['project_id'] = $project_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['enable'] = $_POST["enable"];
    $sql_values['beginbody'] = stripslashes($_POST["beginbody"]);
    $sql_values['version'] = time();    
    $sql_table = _TABLE_PROCEDURE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
    $procedure_id = mysql_insert_id();
    
    // 建立1個預設會有的程序版本欄位
    $sql_values = array();
    $sql_values['project_id'] = $project_id;
    $sql_values['procedure_id'] = $procedure_id;
    $sql_values['name'] = 'f_version';
    $sql_values['description'] = '程序版本';
    $sql_values['type_id'] = '2';
    $sql_values['length'] = '20';
    $sql_values['required'] = '';
    $sql_values['enable'] = '1';
    $sql_values['sequence'] = '1';
    $sql_table = _TABLE_ARGUMENT;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
    
    act_DbDisconnect(NULL,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','新增成功');
    $smarty->display('index.tpl.htm'); 
    exit;     

} elseif( $hidop == 'del'){  
        
    act_DbConnect();

    $sql = 'delete from '._TABLE_PROCEDURE.' where id='.$id.' limit 1';
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
           
    act_DbDisconnect($result,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','刪除成功');
    $smarty->display('index.tpl.htm'); 
    exit;          

// 如果修件都不符合的話，就會到這裡來
} else {
    //$smarty->assign("function","詳細資料");
    //$smarty->display('detail.tpl.htm');
    echo 'miss arg';
    exit;
}

?>