<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-language.php';
$pagedir = 'language';

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

// VH列表
if( $hidop == 'list'){
    
    act_DbConnect();
    
    $sqlgetcount = 'select * from '._TABLE_LANGUAGE;    
    $result = mysql_query($sqlgetcount);
    $total  = mysql_num_rows($result);
    
    // SplitPage(顯示筆數,目前所在頁數,資料總數,總分頁數)
    $page = new SplitPage($nowPage, $total, _SPLITPAGE_TOTAL_RECORDS, 20);  //建構出 SplitPage 物件
    
    //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)
    $page->setViewList($thisfilename."?hidop=list&", 'test');  
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
    $languages = $rows;

    act_DbDisconnect($result,$link);  

    $smarty->assign('smarty_head',$pagedir.'/list.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/list.tpl.htm');  
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("languages",$languages);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){
        
    $sql_values['alias'] = $_POST["alias"];
    $sql_values['name'] = $_POST["name"];
    $sql_values['fileexten'] = $_POST["fileexten"];
        
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_LANGUAGE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'update','id='.$id);
    $debuglines[] = $sql;
    
    act_DbConnect();

    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
        
    act_DbDisconnect(NULL,$link);
       
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','修改成功');
    $smarty->display('index.tpl.htm'); 
    exit;   
    
// 修改VH名稱的前置作業   
} elseif( $hidop == 'editing'){
    
    act_DbConnect();

    $sql = 'select * from '._TABLE_LANGUAGE.' where id='.$id;
    $debuglines[] = $sql;
    
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $language = $row;
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head',$pagedir.'/detail.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/detail.tpl.htm'); 
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("language",$language);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){

    $smarty->assign('smarty_head',$pagedir.'/detail.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
} elseif( $hidop == 'add'){    
    
    $sql_values['alias'] = $_POST["alias"];
    $sql_values['name'] = $_POST["name"];
    $sql_values['fileexten'] = $_POST["fileexten"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_LANGUAGE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
    $debuglines[] = $sql;
    
    act_DbConnect();
    
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
    
    act_DbDisconnect(NULL,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','新增成功');
    $smarty->display('index.tpl.htm'); 
    exit;     

} elseif( $hidop == 'del'){  
        
    act_DbConnect();

    $sql = 'delete from '._TABLE_LANGUAGE.' where id='.$id.' limit 1';
    $debuglines[] = $sql;
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
           
    act_DbDisconnect($result,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
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