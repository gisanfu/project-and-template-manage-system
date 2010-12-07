<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-argument.php';

// function select. add, or edit
//$hidop    = $_POST["hidop"];

if( $_GET["hidop"] != '' ){
  $hidop = $_GET["hidop"];
  $id    = $_GET["id"];
  $project_id = $_GET["project_id"];
  $procedure_id = $_GET["procedure_id"];
} elseif( $_POST["hidop"] != '' ){
  $hidop = $_POST["hidop"];
  $id    = $_POST["id"];
  $project_id = $_POST["project_id"];
  $procedure_id = $_POST["procedure_id"];
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
    $smarty->assign("projectname",$row["name"]);
    
    $sql = 'select * from '._TABLE_PROCEDURE.' where id='.$procedure_id;    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $smarty->assign("procedurename",$row["name"]);
    
    $sqlgetcount = 'select 
                      a.*,
                      t.name as type_name
                    from '._TABLE_ARGUMENT.' as a 
                    left join '._TABLE_ARGUMENT_TYPE.' as t on a.type_id=t.id
                    where 
                      a.project_id='.$project_id.' 
                    and 
                      a.procedure_id='.$procedure_id.'
                    ORDER BY CAST(sequence AS UNSIGNED)'; // 把字串轉換成數字做排序
 
    $result = mysql_query($sqlgetcount);
    $total  = mysql_num_rows($result);
    
    // SplitPage(顯示筆數,目前所在頁數,資料總數,總分頁數)
    $page = new SplitPage($nowPage, $total, _SPLITPAGE_TOTAL_RECORDS, 20);  //建構出 SplitPage 物件
    
    //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)
    $page->setViewList($thisfilename."?hidop=list&project_id=".$project_id.'&procedure_id='.$procedure_id.'&', 'test');  
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
    $arguments = $rows;

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head','argument/list.head.htm');
    $smarty->assign('smarty_content','argument/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("procedure_id",$procedure_id);    
    $smarty->assign("arguments",$arguments);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['project_id'] = $project_id;
    $sql_values['procedure_id'] = $procedure_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['type_id'] = $_POST["type_id"];
    $sql_values['length'] = $_POST["length"];
    $sql_values['required'] = $_POST["required"];
    $sql_values['enable'] = $_POST["enable"];
    $sql_values['sequence'] = $_POST["sequence"];
        
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_ARGUMENT;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'update','id='.$id);

    act_DbConnect();
    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
        
    act_DbDisconnect(NULL,$link);
       
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id.'&procedure_id='.$procedure_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','修改成功');
    $smarty->display('index.tpl.htm'); 
    exit;   
    
} elseif( $hidop == 'editing'){
    
    act_DbConnect();
    
    // 取得型態的列表
    $smarty->assign('types',db_getrowstable(_TABLE_ARGUMENT_TYPE));
    if($db_errmsg!= '') include('pages/smarty-error.php');  
    if($debug=='1') $debuglines = array_merge_recursive($debuglines,$db_debugtxt);

    $sql = 'select 
              a.*,
              t.name as type_name
            from '._TABLE_ARGUMENT.' as a
            left join '._TABLE_ARGUMENT_TYPE.' as t on a.type_id=t.id
            where 
              a.id='.$id.' 
            and 
              a.project_id='.$project_id.'
            and 
              a.procedure_id='.$procedure_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $argument = $row;
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head','argument/detail.head.htm');
    $smarty->assign('smarty_content','argument/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("argument",$argument);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("procedure_id",$procedure_id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){
               
    // 取得型態的列表
    $smarty->assign('types',db_getrowstable(_TABLE_ARGUMENT_TYPE));
    if($db_errmsg!= '') include('pages/smarty-error.php');  
    if($debug=='1') $debuglines = array_merge_recursive($debuglines,$db_debugtxt);
    
    $smarty->assign('smarty_head','argument/detail.head.htm');
    $smarty->assign('smarty_content','argument/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("procedure_id",$procedure_id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
} elseif( $hidop == 'add'){ 
        
    $sql_values['project_id'] = $project_id;
    $sql_values['procedure_id'] = $procedure_id;
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];
    $sql_values['type_id'] = $_POST["type_id"];
    $sql_values['length'] = $_POST["length"];
    $sql_values['required'] = $_POST["required"];
    $sql_values['enable'] = $_POST["enable"];
    $sql_values['sequence'] = $_POST["sequence"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_ARGUMENT;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');

    act_DbConnect();

    $result = mysql_query($sql);
    include('pages/check-db-result.php');
    
    act_DbDisconnect(NULL,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id.'&procedure_id='.$procedure_id);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','新增成功');
    $smarty->display('index.tpl.htm'); 
    exit;     

} elseif( $hidop == 'del'){  
        
    act_DbConnect();

    $sql = 'delete from '._TABLE_ARGUMENT.' where id='.$id.' limit 1';
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
           
    act_DbDisconnect($result,$link); 
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list&project_id='.$project_id.'&procedure_id='.$procedure_id);
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