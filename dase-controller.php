<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-controller.php';
$pagedir = 'controller';

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
    
    $sqlgetcount = 'select * from '._TABLE_CONTROLLER.' where project_id='.$project_id;    
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
    $controllers = $rows;

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head',$pagedir.'/list.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("cg_name",$cg_name);
    $smarty->assign("controllers",$controllers);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['project_id'] = $project_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['enable'] = $_POST["enable"];
    
    // 這個比較特別，因為textarea的關係，所以它送來的東西要先把跳脫字元拿掉
    $sql_values['phpbody'] = stripslashes($_POST["phpbody"]);
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_CONTROLLER;
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
    
    // 取得所有的signals列表
    $sql = 'select * from '._TABLE_SIGNAL.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $signals = $rows;
    $smarty->assign("signals",$signals);
    
    // 取得資料表別名的相關資料，讓前台可以用選擇的方式帶入TEXTAREA
    $sql = 'select * from '._TABLE_TABLENAME.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $tablenames = $rows;
    $smarty->assign("tablenames",$tablenames);
    
    // 取得己帶入的PHP函式庫，讓前台可以用選擇的方式帶入TEXTAREA
    $sql = 'select
              m.id,
              concat(\'[\',c.name,\'] \',m.name) as selecttext,
              m.name as selectvalue
            from '._TABLE_PROJECT_FILE.' as p
            left join '._TABLE_LIBRARY_FILE_ITEM.' as y on p.libraryfile_id=y.libraryfile_id
            left join '._TABLE_LIBRARY_FILE.' as f on y.libraryfile_id=f.id
            left join '._TABLE_LIBRARY_CATEGORY.' as c on f.librarycategory_id=c.id
            left join '._TABLE_LANGUAGE.' as u on f.language_id=u.id
            left join '._TABLE_LIBRARY_ITEM.' as m on y.libraryitem_id=m.id
            where 
              u.alias=\'php\'
            and
              p.project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign("phpfunctions",$rows);
    
    // 取得要修改的controller資料
    $sql = 'select * from '._TABLE_CONTROLLER.' where id='.$id.' and project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $controller = $row;
    
    act_DbDisconnect($result,$link);
    
    $xajax=new xajax();
    $xajax->registerFunction("ajax_signal_update");
    $xajax->processRequests();    
    $smarty->assign('xajax_javascript', $xajax->getJavascript('./includes/xajax/'));
    
    $smarty->assign('smarty_head',$pagedir.'/edit.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/edit.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("controller",$controller);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){
        
    act_DbConnect();
    
    // 取得資料表別名的相關資料，讓前台可以用選擇的方式帶入TEXTAREA
    $sql = 'select * from '._TABLE_TABLENAME.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $tablenames = $rows;
    $smarty->assign("tablenames",$tablenames);
    
    // 取得己帶入的PHP函式庫，讓前台可以用選擇的方式帶入TEXTAREA
    $sql = 'select
              m.id,
              concat(\'[\',c.name,\'] \',m.name) as selecttext,
              m.name as selectvalue
            from '._TABLE_PROJECT_FILE.' as p
            left join '._TABLE_LIBRARY_FILE_ITEM.' as y on p.libraryfile_id=y.libraryfile_id
            left join '._TABLE_LIBRARY_FILE.' as f on y.libraryfile_id=f.id
            left join '._TABLE_LIBRARY_CATEGORY.' as c on f.librarycategory_id=c.id
            left join '._TABLE_LANGUAGE.' as u on f.language_id=u.id
            left join '._TABLE_LIBRARY_ITEM.' as m on y.libraryitem_id=m.id
            where 
              u.alias=\'php\'
            and
              p.project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign("phpfunctions",$rows);
        
    // 取得所有的block列表
    $sql = 'select * from '._TABLE_CONTROLLER_EXAMPLE.' where enable=\'1\'';
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $controller = $row;
    $smarty->assign("controller",$controller);
    
    act_DbDisconnect($result,$link);
        
    $smarty->assign('smarty_head',$pagedir.'/add.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/add.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
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
    
    // 這個比較特別，因為textarea的關係，所以它送來的東西要先把跳脫字元拿掉
    $sql_values['phpbody'] = stripslashes($_POST["phpbody"]);
    
    $sql_table = _TABLE_CONTROLLER;
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

    $sql = 'delete from '._TABLE_CONTROLLER.' where id='.$id.' limit 1';
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
    
} elseif( $hidop == 'exportcontroller' ){
        
    $debuglines[] = php_controllerfile_export($id,$project_id);
  
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    exit;
        
} elseif( $hidop == 'exportcontrollers' ){
        
    act_DbConnect();
        
    // 取得Controller區塊的所有資料
    $sql = 'select * from '._TABLE_CONTROLLER." where enable='1' and project_id=".$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $controllers = $rows;
    
    act_DbDisconnect($result,$link); 
    
    foreach( $controllers as $key => $val ){
      $debuglines[] = php_controllerfile_export($val['id'],$project_id);
    }
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    exit;
    
// 把所有的View和Controller都匯出
} elseif( $hidop == 'exportallviewsandcontrollers' ){
        
    act_DbConnect();
        
    // 取得Block區塊的所有資料
    $sql = 'select * from '._TABLE_BLOCK." where enable='1' and project_id=".$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $blocks = $rows;
    
    foreach( $blocks as $key => $val ){
      $debuglines[] = php_blockdir_export($val['id'],$project_id);
    }
    
    // 取得Page區塊的所有資料
    $sql = 'select * from '._TABLE_PAGE." where enable='1' and project_id=".$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $pages = $rows;
    
    act_DbDisconnect($result,$link); 
    
    foreach( $pages as $key => $val ){
      $debuglines[] = php_pagedir_export($val['id'],$project_id);
    }
    
    // 取得Controller區塊的所有資料
    $sql = 'select * from '._TABLE_CONTROLLER." where enable='1' and project_id=".$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $controllers = $rows;
    
    act_DbDisconnect($result,$link); 
    
    foreach( $controllers as $key => $val ){
      $debuglines[] = php_controllerfile_export($val['id'],$project_id);
    }
    
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
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