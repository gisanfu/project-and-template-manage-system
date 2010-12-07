<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-project.php';

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
    
    $sqlgetcount = 'select 
                      p.*,
                      t.name as theme_name
                    from '._TABLE_PROJECT.' as p
                    left join '._TABLE_THEME.' as t on p.theme_id=t.id
                    ';
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
    $projects = $rows;
    
    act_DbDisconnect($result,$link);

    $smarty->assign('smarty_head','project/list.head.htm');
    $smarty->assign('smarty_content','project/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('projects',$projects);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');    
    
} elseif ( $hidop == 'edit'){
        
    $sql_values['name'] = $_POST["name"];
    $sql_values['exportdir'] = $_POST["exportdir"];
    $sql_values['httpaddress'] = $_POST["httpaddress"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['theme_id'] = $_POST["theme_id"];
        
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_PROJECT;
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
    
} elseif( $hidop == 'editing'){
    
    act_DbConnect();
    
    // 取得風格的列表
    $sql = 'select * from '._TABLE_THEME.' where project_id='.$id;
    $debuglines[] = $sql;
    
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $themes = $rows;
    
    // 取得所有函式
    $sql = 'select * from '._TABLE_LIBRARY_FILE;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('files',$rows);

    // 取得要修改的專案資料
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$id;
    $debuglines[] = $sql;
    
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error();
      include('pages/smarty-error.php');
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project = $row;
    
    act_DbDisconnect($result,$link);
    
    $xajax=new xajax();
    $xajax->registerFunction("ajax_libraryfile_update");
    $xajax->processRequests();    
    $smarty->assign('xajax_javascript', $xajax->getJavascript('./includes/xajax/'));
    
    $smarty->assign('smarty_head','project/edit.head.htm');
    $smarty->assign('smarty_content','project/edit.tpl.htm'); 
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project",$project);
    $smarty->assign("themes",$themes);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){
        
    $smarty->assign('smarty_head','project/add.head.htm');
    $smarty->assign('smarty_content','project/add.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
} elseif( $hidop == 'add'){    
    
    $sql_values['name'] = $_POST["name"];
    $sql_values['exportdir'] = $_POST["exportdir"];
    $sql_values['httpaddress'] = $_POST["httpaddress"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['theme_id'] = $_POST["theme_id"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_PROJECT;
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

    $sql = 'delete from '._TABLE_PROJECT.' where id='.$id.' limit 1';
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
    
} elseif( $hidop == 'funclist'){
        
    act_DbConnect();
        
    $sql = 'select * from '._TABLE_PROJECT.' where id='.$id;    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $cg_name = $row["name"];
    
    act_DbDisconnect($result,$link);
        
    $smarty->assign('smarty_head','func_list/list.head.htm');
    $smarty->assign('smarty_content','func_list/list.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('cg_name',$cg_name);
    $smarty->assign('project_id',$id);
    $smarty->display('index.tpl.htm'); 
    exit;
    
// 匯出程序參照檔
} elseif( $hidop == 'exportprocattr' ){
        
    $debuglines[] = php_proc_attr_export($id);
   
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    exit;
    
// 匯出網站的絕對路徑
} elseif( $hidop == 'exportsiterootfile' ){
        
    $debuglines[] = php_siterootfile_export($id);
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    exit;
    
// 產生網站的資料夾結構，以及預設的檔案
} elseif( $hidop == 'exportrootdir' ){
        
    $debuglines[] = php_createrootdir($id);
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    exit;
    
// 匯出函式檔案
} elseif( $hidop == 'exportlibraryfiles' ){
        
    $debuglines[] = php_exportlibraryfiles($id);
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
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