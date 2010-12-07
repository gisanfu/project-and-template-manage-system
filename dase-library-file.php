<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-library-file.php';
$pagedir = 'library_file';

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
    
    $sqlgetcount = 'select 
                      f.*,
                      g.name as language_name,
                      c.name as category_name,
                      s.name as subdir_name
                    from '._TABLE_LIBRARY_FILE.' as f
                    left join '._TABLE_LANGUAGE.' as g on f.language_id=g.id
                    left join '._TABLE_LIBRARY_CATEGORY.' as c on f.librarycategory_id=c.id
                    left join '._TABLE_LIBRARY_SUBDIR.' as s on f.librarydir_id=s.id
                    ';
    $result = mysql_query($sqlgetcount);
    $total  = mysql_num_rows($result);
    
    // SplitPage(顯示筆數,目前所在頁數,資料總數,總分頁數)
    $page = new SplitPage($nowPage, $total, _SPLITPAGE_TOTAL_RECORDS, 20);  //建構出 SplitPage 物件
    
    //設定導覽列資料,參數1為連結的頁面,參數2為連結的target(本參數可不設定)
    $page->setViewList($thisfilename."?hidop=list", 'test');  
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
    $smarty->assign("files",$rows);

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head',$pagedir.'/list.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];    
    $sql_values['language_id'] = $_POST["language_id"];
    $sql_values['librarycategory_id'] = $_POST["librarycategory_id"];
    $sql_values['librarydir_id'] = $_POST["librarydir_id"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_LIBRARY_FILE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'update','id='.$id);

    act_DbConnect();
    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
        
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
    
    // 取得程式語言的所有類型
    $sql = 'select * from '._TABLE_LANGUAGE;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('languages',$rows);
    
    // 取得函式所有類型
    $sql = 'select * from '._TABLE_LIBRARY_CATEGORY;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('categories',$rows);
    
    // 取得函式所有資料夾列表
    $sql = 'select * from '._TABLE_LIBRARY_SUBDIR;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('subdirs',$rows);
    
    // 取得要修改的函式檔案內容
    $sql = 'select 
              f.*,
              g.name as language_name,
              c.name as category_name,
              s.name as subdir_name
            from '._TABLE_LIBRARY_FILE.' as f
            left join '._TABLE_LANGUAGE.' as g on f.language_id=g.id
            left join '._TABLE_LIBRARY_CATEGORY.' as c on f.librarycategory_id=c.id
            left join '._TABLE_LIBRARY_SUBDIR.' as s on f.librarydir_id=s.id
            where f.id='.$id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $file = $row;
    
    // 取得所有函式
    // 以函式檔案所指定的程式語言種類而定
    if( $file['language_id'] != '' ){
      $sql = 'select * from '._TABLE_LIBRARY_ITEM.' where language_id='.$file['language_id'];
      $result = mysql_query($sql);
      include('pages/check-db-result.php');   
      $row  = array();
      $rows = array();
      while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $rows[] = $row;
      }
      include('pages/debug-db-result.php');
      $smarty->assign('items',$rows);
    }
    
    act_DbDisconnect($result,$link);
    
    $xajax=new xajax();
    $xajax->registerFunction("ajax_libraryitem_update");
    $xajax->processRequests();    
    $smarty->assign('xajax_javascript', $xajax->getJavascript('./includes/xajax/'));
    
    $smarty->assign('smarty_head',$pagedir.'/edit.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/edit.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("file",$file);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){
        
    act_DbConnect();
        
    // 取得程式語言的所有類型
    $sql = 'select * from '._TABLE_LANGUAGE;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('languages',$rows);
    
    // 取得函式所有類型
    $sql = 'select * from '._TABLE_LIBRARY_CATEGORY;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('categories',$rows);
    
    // 取得函式所有資料夾列表
    $sql = 'select * from '._TABLE_LIBRARY_SUBDIR;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $smarty->assign('subdirs',$rows);
    
    act_DbDisconnect($result,$link);
        
    $smarty->assign('smarty_head',$pagedir.'/add.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/add.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
} elseif( $hidop == 'add'){ 
        
    act_DbConnect();
        
    $sql_values['name'] = $_POST["name"];
    $sql_values['description'] = $_POST["description"];    
    $sql_values['language_id'] = $_POST["language_id"];
    $sql_values['librarycategory_id'] = $_POST["librarycategory_id"];
    $sql_values['librarydir_id'] = $_POST["librarydir_id"];
    
    $sql_table = _TABLE_LIBRARY_FILE;
    $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
    
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

    $sql = 'delete from '._TABLE_LIBRARY_FILE.' where id='.$id.' limit 1';
    $result = mysql_query($sql);
    include('pages/check-db-result.php');
           
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