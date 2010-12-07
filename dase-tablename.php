<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-tablename.php';

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
    
    $sqlgetcount = 'select * from '._TABLE_TABLENAME.' where project_id='.$project_id.' order by id';    
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
    $tablenames = $rows;

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head','tablename/list.head.htm');
    $smarty->assign('smarty_content','tablename/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("cg_name",$cg_name);
    $smarty->assign("tablenames",$tablenames);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['project_id'] = $project_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['alias'] = $_POST["alias"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_TABLENAME;
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

    $sql = 'select * from '._TABLE_TABLENAME.' where id='.$id.' and project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $tablename = $row;
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head','tablename/detail.head.htm');
    $smarty->assign('smarty_content','tablename/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("tablename",$tablename);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){

    $smarty->assign('smarty_head','tablename/detail.head.htm');
    $smarty->assign('smarty_content','tablename/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
// 建立社區的動作
} elseif( $hidop == 'add'){ 
        
    $sql_values['project_id'] = $project_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['alias'] = $_POST["alias"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_TABLENAME;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');

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
    $smarty->assign('message','新增成功');
    $smarty->display('index.tpl.htm'); 
    exit;     

} elseif( $hidop == 'del'){  
        
    act_DbConnect();

    $sql = 'delete from '._TABLE_TABLENAME.' where id='.$id.' limit 1';
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

// 匯出資料表欄位對應檔
} elseif( $hidop == 'exportfile'){
        
    // 要匯出以下的內容到檔案
    // define('_TABLE_PROJECT','t_project');
    
    // 取得專案的路徑，並帶入匯出的路徑
    act_DbConnect();
     
    // 取得專案的基本資料   
    $sql = 'select * from '._TABLE_PROJECT.' where id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $errmsg = '請先指定專案的匯出路徑';
      include('pages/smarty-error.php');
      exit;
    }
    
    // 指定要寫入的完整路徑及檔名
    $export_tablealias_file = $project["exportdir"].'/'._PROJECT_CONFIG.'sql_tablealias.php';
    
    // 取得資料表別名對應表
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
    
    act_DbDisconnect($result,$link);
    
    if( ($file = fopen($export_tablealias_file,'w')) == false ){
      $errmsg = '檔案寫入錯誤';
      include('pages/smarty-error.php');
      exit;
    }
    
    fwrite($file,"<?php\r\n");
        
    // define('_TABLE_PROJECT','t_project');
    foreach( $tablenames as $key => $val ){
      fwrite($file,'define(\''.$val['alias'].'\',\''.$val['name'].'\');'."\r\n");          
    }
    
    fwrite($file,"?>");
    fclose($file);
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功 '.$export_tablealias_file);
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