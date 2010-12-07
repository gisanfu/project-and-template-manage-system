<?php

//
// Update: 2008-10-15
// FileName: dase-http.php
// AliasName: dase function, its mean => 'D'el 'A'dd 'S'earch 'E'dit
//

include_once("config.php");
include_once("includes/phpclass/splitpage.php");

$thisfilename = 'dase-project-db.php';

// 這個page的範本目錄
// 把這個單位定義成一個Page
$pagedir = 'project_db';

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
    
    // 先取得所屬專案的名稱
    $sql = 'select * from '._TABLE_PROJECT.' where id='.$project_id;    
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $cg_name = $row["name"];
    
    // 取得資料庫連線的資訊
    $sqlgetcount = 'select 
                      id, project_id,
                      alias, host, port, user, pass,
                      dbname
                    from '._TABLE_PROJECT_DB.' where project_id='.$project_id;    
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
    $project_dbs = $rows;
    
    // 取得程序己啟用列表
    $sql = 'select * from '._TABLE_PROCEDURE.' where project_id='.$project_id." and enable='1'";
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $matchcheck_procedures = $rows;   
    
    // 取得己停用的程序數量
    $sql = 'select * from '._TABLE_PROCEDURE.' where project_id='.$project_id." and enable!='1'";
    $result = mysql_query($sql);
    $proc_disable_total  = mysql_num_rows($result);

    // 以主機連線資料為單位，去檢查各proc的和資料庫的proc版本是否match
    foreach( $project_dbs as $key => $val ){
        
      // 這個變數是要存放己停用的程序數量
      $project_dbs[$key]['disable'] = $proc_disable_total; 
        
      // 底下這三個變數，是計算該專案底下的程序，線上的、需更新的、檢查失敗的相關筆數
      $project_dbs[$key]['newfield'] = 0;
      $project_dbs[$key]['oldfield'] = 0;
      $project_dbs[$key]['failfield'] = 0;
        
      // 連線資料庫
      $link2 = mysqli_connect( $val['host'], $val['user'], $val['pass'], $val['dbname'], $val['port'] ) or $status='error';
      if( $status == 'error' ){
        $debuglines[] = mysqli_connect_error().' 連線資料庫錯誤';
        $project_dbs[$key]['connectstatus'] = '1';
        continue;
      }
      mysqli_query($link2,'set names utf8');
      //mysqli_select_db($link2,$val['dbname']);
      
      // 建立sql語法
      foreach( $matchcheck_procedures as $proc_key => $proc_val ){
        
        $sql = 'call '.$proc_val['name'].'( ';
        
        // 先取得欄位列表
        $sqlhelp = 'select 
                   a.*,
                   t.name as type_name
                 from '._TABLE_ARGUMENT.' as a 
                 left join '._TABLE_ARGUMENT_TYPE.' as t on a.type_id=t.id
                 where 
                   a.project_id='.$project_id.' 
                 and 
                   a.procedure_id='.$proc_val['id'].'
                 order by char(a.sequence) asc';
        $debuglines[] = $sqlhelp;
        $result = mysql_query($sqlhelp);
        if( !$result ){
          $debuglines[] = 'field get fail => '.$sqlhelp;
          continue;
        }
        // 如果沒有任何欄位，就直接宣告不支援版本檢查
        if( mysql_num_rows($result) <= 0 ){
          $project_dbs[$key]['failfield'] = (int)$project_dbs[$key]['failfield'] + 1;
          $debuglines[] = 'procedure not support version check, because field is empty';
          continue;
        }
        $row  = array();
        $rows = array();
        while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
          // 如果是版本欄位，那就帶入1的引數
          if( $row['name'] == 'f_version' ){
            $sql .= '\'1\', ';
          } else {
            // 補上空白的欄位值
            $sql .= '\'\', ';
          } // end if row name
        } // end while mysql fetch

        $sql = substr($sql, 0, -2);
        $sql .= ');';
        
        $debuglines[] = $sql;
        
        $link2->multi_query($sql) or $status = 'error'; 
        if( $status == 'error' ){
          $project_dbs[$key]['failfield'] = (int)$project_dbs[$key]['failfield'] + 1;
          $debuglines[] = 'query have fatal error or warning, so proc is not support version check => '.$link2->error;
          continue;
        }
        
        while( $link2->more_results() ){
          if ($result = $link2->store_result()) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            // 如果資料庫上的proc不支援版本檢查，那就不需要更新
            // 不管有幾筆，只要有1筆需要更新，那在前端就會標示需要更新
            if( $row['version']  == '' ){
              $project_dbs[$key]['failfield'] = (int)$project_dbs[$key]['failfield'] + 1;
              $debuglines[] = 'procedure not support version check, because proc version is not define';
            } elseif( $row['version']  != $proc_val['version'] ){                
              $project_dbs[$key]['oldfield'] = (int)$project_dbs[$key]['oldfield'] + 1;
              $debuglines[] = 'procedure need update';
            // 如果資料庫上的proc是最新的，那就不需要更新
            } else {
              $project_dbs[$key]['newfield'] = (int)$project_dbs[$key]['newfield'] + 1;
              $debuglines[] = 'procedure is online';
            } // end if row version
            $result->close();
          }    
          $link2->next_result();
        } // while        
      } // foreach matchcheck_procedures
      
      // 資料庫離線
      $link2->close();
      
    } // foreach project_dbs 2

    act_DbDisconnect($result,$link);   
       
    $smarty->assign('smarty_head',$pagedir.'/list.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/list.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("cg_name",$cg_name);
    $smarty->assign("project_dbs",$project_dbs);
    $smarty->assign("viewlist",$viewlist);
    $smarty->display('index.tpl.htm');         

} elseif ( $hidop == 'edit'){

    $sql_values['project_id'] = $project_id;
    $sql_values['alias'] = $_POST["alias"];
    $sql_values['host'] = $_POST["host"];
    $sql_values['port'] = ($_POST["port"] == '')? '3306':$_POST["port"];
    $sql_values['user'] = $_POST["user"];
    $sql_values['pass'] = $_POST["pass"];
    $sql_values['dbname'] = $_POST["dbname"];
       
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_PROJECT_DB;
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

    $sql = 'select * from '._TABLE_PROJECT_DB.' where id='.$id.' and project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project_db = $row;
    
    act_DbDisconnect($result,$link);
    
    $smarty->assign('smarty_head',$pagedir.'/detail.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("project_db",$project_db);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","edit");
    $smarty->display('index.tpl.htm');    
    
} elseif( $hidop == 'adding'){

    $smarty->assign('smarty_head',$pagedir.'/detail.head.htm');
    $smarty->assign('smarty_content',$pagedir.'/detail.tpl.htm');
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign("id",$id);
    $smarty->assign("project_id",$project_id);
    $smarty->assign("hidop","add");
    $smarty->display('index.tpl.htm');     
    
// 建立社區的動作
} elseif( $hidop == 'add'){ 
        
    $sql_values['project_id'] = $project_id;
    $sql_values['alias'] = $_POST["alias"];
    $sql_values['host'] = $_POST["host"];
    $sql_values['port'] = ($_POST["port"] == '')? '3306':$_POST["port"];
    $sql_values['user'] = $_POST["user"];
    $sql_values['pass'] = $_POST["pass"];
    $sql_values['dbname'] = $_POST["dbname"];
    
    // function('tablename',fields,fieldattrs,action,parameters);
    // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
    $sql_table = _TABLE_PROJECT_DB;
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

    $sql = 'delete from '._TABLE_PROJECT_DB.' where id='.$id.' limit 1';
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
    
} elseif( $hidop == 'procupdate'){
     
    /*
     * 1.取得資料表別名與實際名稱的對應列表
     * 2.取得程序的列表
     * 3.匯出所有的procedure成sql檔案(目前只能用replace的方式去覆蓋原有的procedure)
     * 4.把實體檔案載入到資料庫
     */
     
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
    
    $export_develdir = $project["exportdir"].'/'._PROJECT_DEVEL;
    
    // 如果DEVEL這個資料夾不存在，就試著建立它
    if( !file_exists($export_develdir) ){
      if(!mkdir($export_develdir, 0777)){
        return '建立DEVEL資料夾失敗=>'.$export_develdir;
      }
    }
    
    $export_develsqldir = $export_develdir . 'sql/';
    
    // 如果DEVEL這個資料夾不存在，就試著建立它
    if( !file_exists($export_develsqldir) ){
      if(!mkdir($export_develsqldir, 0777)){
        return '建立DEVEL資料夾內的sql資料夾失敗=>'.$export_develsqldir;
      }
    }    
    
    // 指定要寫入的完整路徑及檔名
    // 如果檔案己存在的話，就直接覆寫
    $export_sql_file = $export_develsqldir.'procedure.sql';
    
    // 取得資料表別名與實際名稱的對應列表
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
    
    // 取得程序的列表    
    //$sql = 'select * from '._TABLE_PROCEDURE.' where enable=\'1\' and project_id='.$project_id;
    $sql = 'select * from '._TABLE_PROCEDURE.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $procedures = $rows;
    
    // 如果沒有建立任何的procedure,就離開
    if( count($procedures) <= 0 ){
      $errmsg = '沒有任何程序可供匯出';
      include('pages/smarty-error.php');
      exit;
    }
    
    // 這個變數是要存放所有的程序內容，最後要寫入sql檔案
    $bodys = "";
    
    // 指定跳行的變數
    $nextline = "\r\n";
    
    foreach( $procedures as $key => $val ){
        
      $body = '';
        
      // 存放procedure body的變數
      $body = 'DROP PROCEDURE IF EXISTS '.$val["name"].';'.$nextline;
      
      // 如果程序是被停用的，那就把該程序砍掉
      // 也就是只留下drop procedure的部份，其他body的部份不要匯出
      if( $val['enable'] != '1' ){
        $bodys .= $body;
        continue;
      }
      
      // 附加procedure的開頭與名稱
      $body .= 'DELIMITER //'.$nextline;
      $body .= 'CREATE PROCEDURE '.$val["name"].'('.$nextline;
      
      // 利用procedure_id去取得arguments，並儲存在另外一個陣列  
      $sql = 'select 
                a.name,
                a.length,
                a.required,
                a.sequence,
                t.name as type
              from '._TABLE_ARGUMENT.' as a
              left join '._TABLE_ARGUMENT_TYPE.' as t on a.type_id=t.id
              where 
                a.enable=\'1\'
              and
                a.project_id='.$project_id.'
              and 
                a.procedure_id='.$val["id"].'
              order by char(a.sequence) asc';
      $result = mysql_query($sql);
      include('pages/check-db-result.php');   
      $row  = array();
      $rows = array();
      while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        //$rows[$row["name"]] = $row;
        $rows[$row["name"]] = $row;
      }
      include('pages/debug-db-result.php');
      
      // 附加欄位資料成procedure的輸入引數
      // 範例: in arg_id int(10)
      if( count($rows) > 0 ){
        foreach($rows as $arg_key => $arg_val){
          $body .= 'in ' . $arg_key . ' ' . $arg_val["type"];
          if( $arg_val["length"] != '' ){
            $body .= '('.$arg_val["length"].')';
          } /* if */
          $body .= ', ';
        } /* foreach */
        // 把最後一個逗點和空白字元給刪掉
        $body = substr($body, 0, -2) . $nextline;
      } /* count($rows) */
      
      // 附加輸入引數的結尾
      $body .= ')' . $nextline;
      
      // 把beginbody內的資料表別名更換成正式的資料表名稱，並附加上去
      $beginbody = $val["beginbody"];
      if( count($tablenames) > 0 ){
        foreach( $tablenames as $tablename_key => $tablenames_val ){
          $beginbody = str_replace('%'.$tablenames_val["alias"].'%',$tablenames_val["name"],$beginbody);
        } /* foreach */
      } /* if */
      
      // 把程序的版本關鍵字更換成程序的版本屬性值
      if( $val['version'] != '' ){
        $beginbody = str_replace('%_PROC_VER_%',$val['version'],$beginbody);
      }
      
      $body .= $beginbody . $nextline;
      
      // 附加procedure的結尾
      $body .= '//' . $nextline;
      $body .= 'DELIMITER ;' . $nextline . $nextline;
      
      // 最後，累加在最後要一齊寫入的變數
      $bodys .= $body;
      
    } /* foreach */
    
    act_DbDisconnect($result,$link);
        
    // 寫入procedure SQL文字檔
    if( ($file = fopen($export_sql_file,'w')) == false ){
      $errmsg = '檔案開啟錯誤 '.$export_sql_file;
      include('pages/smarty-error.php');
      exit;
    }
    fwrite($file,$bodys);
    fclose($file);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_sql_file);
    
    // 取得資料庫的連線資料
    $sql = 'select * from '._TABLE_PROJECT_DB.' where id='.$id.' and project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project_db = $row;
    
    // 把匯出的檔案，用mysql cli程式匯入到資料庫裡面
    $cmd = '/app/mysql/bin/mysql -u'.
                        $project_db['user'].
                      ' --password='.
                        $project_db['pass'].
                      ' -h '.
                        $project_db['host'].
                      ' -P '.
                        $project_db['port'].
                      ' '.
                        $project_db['dbname'].
                      ' < '.
                        $export_sql_file;
    $debuglines[] = $cmd;
    // 執行指令
    if( exec($cmd) == false ){
      $errmsg = '資料庫更新錯誤';
      //include('pages/smarty-error.php');
      //exit;
    }
    
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 

// 匯出欄位對應檔
} elseif( $hidop == 'exportattr'){
        
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
    $export_configdir = $project["exportdir"].'/'._PROJECT_CONFIG;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_configdir) ){
      if(!mkdir($export_configdir, 0777)){
        return '建立CONFIG資料夾失敗=>'.$export_configdir;
      }
    }
    
    $export_attr_file .= $export_configdir._SQL_ATTR_FILE;
    
    // 取得資料庫的連線資料
    $sql = 'select * from '._TABLE_PROJECT_DB.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project_db = $row;
    
    act_DbDisconnect($result,$link);
        
    $connect = array( 
                 'host' => $project_db['host'],
                 'user' => $project_db['user'],
                 'pass' => $project_db['pass'],
                 'db'   => $project_db['dbname']
                );
    create_attr_file($connect,$export_attr_file);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_attr_file);
        
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    
// 匯出欄位結構檔
} elseif( $hidop == 'exportschema'){
        
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
    $export_configdir = $project["exportdir"].'/'._PROJECT_CONFIG;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_configdir) ){
      if(!mkdir($export_configdir, 0777)){
        return '建立CONFIG資料夾失敗=>'.$export_configdir;
      }
    }
    
    $export_schema_file .= $export_configdir._SQL_SCHEMA_FILE;
    
    // 取得資料庫的連線資料
    $sql = 'select * from '._TABLE_PROJECT_DB.' where project_id='.$project_id;
    $result = mysql_query($sql);
    include('pages/check-db-result.php');   
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    include('pages/debug-db-result.php');
    $project_db = $row;
    
    act_DbDisconnect($result,$link);
        
    $connect = array( 
                 'host' => $project_db['host'],
                 'user' => $project_db['user'],
                 'pass' => $project_db['pass'],
                 'db'   => $project_db['dbname']
                );
    create_schema_file($connect,$export_schema_file);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_schema_file);
        
    $smarty->assign('smarty_head','normal/status.head.htm');
    $smarty->assign('smarty_content','normal/status.tpl.htm');
    //如果是debug模式，那就取消自動轉址的功能
    if( $debug !== 1 ) 
        $smarty->assign('redir',$thisfilename.'?hidop=list');
    $smarty->assign('debuglines',$debuglines);
    $smarty->assign('targetpost',$thisfilename);
    $smarty->assign('message','匯出成功');
    $smarty->display('index.tpl.htm'); 
    
// 匯出資料庫連線參照檔
} elseif( $hidop == 'exportsqlconnect'){
        
    $debuglines[] = php_sql_connect_export($id,$project_id);
  
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