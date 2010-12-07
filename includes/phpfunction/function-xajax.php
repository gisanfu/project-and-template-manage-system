<?php

/*
  負責把使用者所選擇的程式碼片斷的別名編號
  所相關的程式碼片斷資料給帶進來
*/
function ajax_code_update($cid){
        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear('alias','value');
    $objResponse->addClear('language_name','value');
    $objResponse->addClear('description','value');
    $objResponse->addClear('codebody','value');
    
    act_DbConnect();
    
    $sql = 'select 
              d.*,
              g.name as language_name
            from '._TABLE_CODE.' as d
            left join '._TABLE_LANGUAGE.' as g on d.language_id=g.id
            where d.id='.$cid;
 
    $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
    
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $objResponse->append('debugdiv', 'innerHTML', mysql_error());
      $objResponse->addAlert('發現內部錯誤，請與管理人員連繫');
      return $objResponse;
    }   
    
    // 如果找不到資料，就離開，不更新任何資料
    if( mysql_num_rows($result) <= 0 ){
      $objResponse->append('debugdiv', 'innerHTML', 'product search not found<br>');
      return $objResponse;
    }
    
    $row = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);  
    
    $objResponse->assign('alias', 'value', $row['alias']);
    $objResponse->assign('language_name', 'value', $row['language_name']);
    $objResponse->assign('description', 'value', $row['description']);
    $objResponse->assign('codebody', 'value', $row['codebody']);
    
    return $objResponse;
}/*ajax_code_update*/

/*
 *
*/
function ajax_block_update($page_id,$block_id,$action=''){

    global $sql_attrs;
    
    $functionname = '['.__FUNCTION__.'] ';
        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear('useblock','innerHTML');

    act_DbConnect();    
    
    if( $action == 'add' ){
        
      // 如果使用者是選擇預設的第1項，傳來的block_id將會是空白的
      if( $block_id != '' ){
        // 檢查是否有存在
        $sql = 'select id 
                from '._TABLE_PAGE_BLOCK .'
                where 
                  page_id='.$page_id.'
                and
                  block_id='.$block_id;
        $objResponse->append('debugdiv', 'innerHTML', $functionname.$sql.'<br>');
        $result = mysql_query($sql);
        if(!$result){
          $objResponse->append('debugdiv', 'innerHTML', $functionname.mysql_error().'<br>');
          return $objResponse;
        }
        $row = array();
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $block_row = $row;
        
        // 確定沒有資料才會新增一筆新的
        if( $block_row["id"] == '' ){
          
          $sql_values['page_id'] = $page_id;
          $sql_values['block_id'] = $block_id;
          $sql_table = _TABLE_PAGE_BLOCK;
          $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
          $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
          $result = mysql_query($sql);
          if(!$result){
            $objResponse->append('debugdiv', 'innerHTML', $functionname.mysql_error().'<br>');
            return $objResponse;
          }
          
        } /* block_row */
      } /* if != empty*/
      
    } elseif ( $action == 'del' ){
      $sql = 'delete 
              from '._TABLE_PAGE_BLOCK.'
              where 
                page_id='.$page_id.'
              and
                block_id='.$block_id. ' limit 1';
      $objResponse->append('debugdiv', 'innerHTML', $functionname.$sql.'<br>');
      $result = mysql_query($sql);
      if(!$result){
        $objResponse->append('debugdiv', 'innerHTML', $functionname.mysql_error().'<br>');
        return $objResponse;
      }
    } elseif ( $action == 'update' ){
      // 如果是更新，那這裡就會直接帶過
    } else {
      // 如果都不是我所定義的指令，就直接離開
      exit;
    }
    
    // 不管是新增還是刪除，都會在更新一次table
    $sql = 'select 
              p.*,
              b.name
            from '._TABLE_PAGE_BLOCK.' as p
            left join '._TABLE_BLOCK.' as b on p.block_id=b.id
            where
              p.page_id='.$page_id;
    $objResponse->append('debugdiv', 'innerHTML', $functionname.$sql.'<br>');
    $result = mysql_query($sql);
    if(!$result){
      $objResponse->append('debugdiv', 'innerHTML', $functionname.mysql_error().'<br>');
      return $objResponse;
    }
    
    // 如果找不到資料，就回傳無資料
    $total = mysql_num_rows($result);

    if( $total == '0' ){
      $return .= '無資料..';
    }
    
    $row = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $temp =  $row["name"].'&nbsp;';
        $temp .= '<a href="#" onclick="xajax_ajax_block_update('.$row['page_id'].','.$row["block_id"].',\'del\')">';
        $temp .= '[del]';
        $temp .= '</a><br>';
        $return .= $temp;        
    }
    
    act_DbDisconnect($result,$link);

    $objResponse->assign('useblock', 'innerHTML', $return);
    return $objResponse;
}


/*
 * 處理控制區塊和信號區塊的對應表
*/
function ajax_signal_update($controller_id,$signal_id,$action=''){

    global $sql_attrs;
        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear('usesignal','innerHTML');

    act_DbConnect();    
    
    if( $action == 'add' ){
        
      // 如果使用者是選擇預設的第1項，傳來的block_id將會是空白的
      if( $signal_id != '' ){
        // 檢查是否有存在
        $sql = 'select id 
                from '._TABLE_CONTROLLER_SIGNAL .'
                where 
                  controller_id='.$controller_id.'
                and
                  signal_id='.$signal_id;
        $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
        $result = mysql_query($sql);
        include('pages/check-db-result.php');   
        $row = array();
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        include('pages/debug-db-result.php');
        $signal_row = $row;
        
        // 確定沒有資料才會新增一筆新的
        if( $signal_row["id"] == '' ){
          
          $sql_values['controller_id'] = $controller_id;
          $sql_values['signal_id'] = $signal_id;
          
          // function('tablename',fields,fieldattrs,action,parameters);
          // example: sql_act_parse('weights',$sql_values,$sql_attrs,'insert','');
          $sql_table = _TABLE_CONTROLLER_SIGNAL;
          $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
          $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
          $result = mysql_query($sql);        
          
        } /* signal_row */
      } /* if != empty*/
      
    } elseif ( $action == 'del' ){
      $sql = 'delete 
              from '._TABLE_CONTROLLER_SIGNAL.'
              where 
                controller_id='.$controller_id.'
              and
                signal_id='.$signal_id. ' limit 1';
      $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
      $result = mysql_query($sql);
      include('pages/check-db-result.php');
    } elseif ( $action == 'update' ){
      // 如果是更新，那這裡就會直接帶過
    } else {
      // 如果都不是我所定義的指令，就直接離開
      exit;
    }
    
    // 不管是新增還是刪除，都會在更新一次table
    $sql = 'select 
              c.*,
              s.name
            from '._TABLE_CONTROLLER_SIGNAL.' as c
            left join '._TABLE_SIGNAL.' as s on c.signal_id=s.id
            where
              c.controller_id='.$controller_id;
    $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
    $result = mysql_query($sql);
        
    // 建立table的上半部
    //$return = '<table cellspacing="0"><tr><td>分類名稱</td><td width="30">動作</td></tr>';
    
    // 如果找不到資料，就回傳無資料
    $total = mysql_num_rows($result);
    //$return = $total;
    if( $total == '0' ){
      //$return .= '<tr><td>無資料...</td><td>&nbsp;</td></tr>';
      $return .= '無資料..';
    }
    
    $row = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        //$temp = '<tr><td>';
        //$temp .= $row["name"];
        //$temp .= '</td><td>';
        //$temp .= '<div align="center">;
        //$temp .= '</td></tr>';
        $temp =  $row["name"].'&nbsp;';
        $temp .= '<a href="#" onclick="xajax_ajax_signal_update('.$row['controller_id'].','.$row["signal_id"].',\'del\')">';
        $temp .= '[del]';
        $temp .= '</a><br>';
        $return .= $temp;        
    }
    include('pages/debug-db-result.php');
    
    act_DbDisconnect($result,$link);
    
    // 建立table的下半部
    //$return .= '</table>';
    
    //$objResponse->addClear('craft_datagrid','innerHTML');
    $objResponse->assign('usesignal', 'innerHTML', $return);
    return $objResponse;
}

/*
 * update: 2009-02-11
 * 處理函式檔案和函式的對應表(1對多)
 * 
 * +---------+-------+-------------------------------------------------+
 * |角色     |別名   |相關的描述                                       |
 * +---------+-------+-------------------------------------------------+
 * |主節點   |root   |假設: 1個人                                      |
 * |分支節點 |branch |說明: 存放主節點編號(1)與子節點編號(n)的對應資料 |
 * |子節點   |child  |假設: 可以擁有多支手機                           |
 * +---------+-------+-------------------------------------------------+
 *
 * 用法: 函式名稱(主節點的編號,子節點的編號,動作)
*/
function ajax_libraryitem_update($root_id,$child_id,$action=''){

    global $sql_attrs;
    
    // 定義基本運作的變數
    $functionname = '['.__FUNCTION__.'] ';
    $divname_debug = 'debugdiv';
    $returnmsg = '';
    $brline = '<BR>';
    
    // 定義ajax要更新的目標名稱(divname)
    $divname_update_target = 'useitem';
    
    // 定義分支節點的變數
    $branch_tablename = _TABLE_LIBRARY_FILE_ITEM;
    $branch_fieldname_rootid  = 'libraryfile_id';
    $branch_fieldname_childid = 'libraryitem_id';
    $branch_fieldname_id = 'id';
    
    // 定義子節點的變數
    $child_tablename = _TABLE_LIBRARY_ITEM;
    $child_fieldname_displayname = 'name';
    $child_fieldname_id = 'id';

        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear($divname_update_target,'innerHTML');

    act_DbConnect();    
    
    if( $action == 'add' ){
        
      // 如果使用者是選擇預設的第1項，傳來的item_id將會是空白的
      if( $child_id != '' ){
        // 新增資料前，先檢查分支節點中，對應的關係是否存在
        $sql = 'select '.$branch_fieldname_id.'
                from '.$branch_tablename .'
                where 
                  '.$branch_fieldname_rootid.'='.$root_id.'
                and
                  '.$branch_fieldname_childid.'='.$child_id;
                  
        $returnmsg .= $functionname.$sql.$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        $result = mysql_query($sql);
        if(!$result){
          $returnmsg .= $functionname.mysql_error().$brline;
          $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
          return $objResponse;
        }
        $row = array();
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $child_row = $row;
        
        // 確定沒有資料才會新增一筆新的
        if( $child_row[$branch_fieldname_id] == '' ){
          
          $sql_values = array();
          $sql_values[$branch_fieldname_childid] = $child_id;
          $sql_values[$branch_fieldname_rootid] = $root_id;
          $sql_table = $branch_tablename;
          $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
          $returnmsg .= $functionname.$sql.$brline;
          $result = mysql_query($sql);
          if(!$result){
            $returnmsg .= $functionname.mysql_error().$brline;
            $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
            return $objResponse;
          }
          
        } /* item_row */
      } /* if != empty*/
      
    } elseif ( $action == 'del' ){
      $sql = 'delete 
              from '.$branch_tablename.'
              where 
                '.$branch_fieldname_rootid.'='.$root_id.'
              and
                '.$branch_fieldname_childid.'='.$child_id. ' limit 1';
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.mysql_error().$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        return $objResponse;
      }
    } elseif ( $action == 'update' ){
      // 如果是更新，那這裡就會直接帶過
    } else {
      // 如果都不是我所定義的指令，就直接離開
      exit;
    }
    
    // 不管是新增還是刪除，都會在更新一次table
    $sql = 'select 
              p.*,
              y.'.$child_fieldname_displayname.'
            from '.$branch_tablename.' as p
            left join '.$child_tablename.' as y on p.'.$branch_fieldname_childid.'=y.id
            where
              p.'.$branch_fieldname_rootid.'='.$root_id;
              
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.mysql_error().$brline;
      $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
      return $objResponse;
    }
    
    // 如果找不到資料，就回傳無資料
    $total = mysql_num_rows($result);

    if( $total == '0' ){
      $return .= '無資料..';
    }
    
    $row = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $temp =  $row["name"].'&nbsp;';
        $temp .= '<a href="#" onclick="xajax_'.__FUNCTION__.'('.$row[$branch_fieldname_rootid].','.$row[$branch_fieldname_childid].',\'del\')">';
        $temp .= '[del]';
        $temp .= '</a><br>';
        $return .= $temp;        
    }
    
    act_DbDisconnect($result,$link);

    $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
    $objResponse->assign($divname_update_target, 'innerHTML', $return);
    
    return $objResponse;
} /* end ajax_libraryitem_update */

/*
 * update: 2009-02-11
 * 處理專案與函式檔案的對應表(1對多)
 * 
 * +---------+-------+-------------------------------------------------+
 * |角色     |別名   |相關的描述                                       |
 * +---------+-------+-------------------------------------------------+
 * |主節點   |root   |假設: 1個人                                      |
 * |分支節點 |branch |說明: 存放主節點編號(1)與子節點編號(n)的對應資料 |
 * |子節點   |child  |假設: 可以擁有多支手機                           |
 * +---------+-------+-------------------------------------------------+
 *
 * 用法: 函式名稱(主節點的編號,子節點的編號,動作)
*/
function ajax_libraryfile_update($root_id,$child_id,$action=''){

    global $sql_attrs;
    
    // 定義基本運作的變數
    $functionname = '['.__FUNCTION__.'] ';
    $divname_debug = 'debugdiv';
    $returnmsg = '';
    $brline = '<BR>';
    
    // 定義ajax要更新的目標名稱(divname)
    $divname_update_target = 'usefile';
    
    // 定義分支節點的變數
    $branch_tablename = _TABLE_PROJECT_FILE;
    $branch_fieldname_rootid  = 'project_id';
    $branch_fieldname_childid = 'libraryfile_id';
    $branch_fieldname_id = 'id';
    
    // 定義子節點的變數
    $child_tablename = _TABLE_LIBRARY_FILE;
    $child_fieldname_displayname = 'name';
    $child_fieldname_id = 'id';

        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear($divname_update_target,'innerHTML');

    act_DbConnect();    
    
    if( $action == 'add' ){
        
      // 如果使用者是選擇預設的第1項，傳來的item_id將會是空白的
      if( $child_id != '' ){
        // 新增資料前，先檢查分支節點中，對應的關係是否存在
        $sql = 'select '.$branch_fieldname_id.'
                from '.$branch_tablename .'
                where 
                  '.$branch_fieldname_rootid.'='.$root_id.'
                and
                  '.$branch_fieldname_childid.'='.$child_id;
                  
        $returnmsg .= $functionname.$sql.$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        $result = mysql_query($sql);
        if(!$result){
          $returnmsg .= $functionname.mysql_error().$brline;
          $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
          return $objResponse;
        }
        $row = array();
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $child_row = $row;
        
        // 確定沒有資料才會新增一筆新的
        if( $child_row[$branch_fieldname_id] == '' ){
          
          $sql_values = array();
          $sql_values[$branch_fieldname_childid] = $child_id;
          $sql_values[$branch_fieldname_rootid] = $root_id;
          $sql_table = $branch_tablename;
          $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
          $returnmsg .= $functionname.$sql.$brline;
          $result = mysql_query($sql);
          if(!$result){
            $returnmsg .= $functionname.mysql_error().$brline;
            $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
            return $objResponse;
          }
          
        } /* item_row */
      } /* if != empty*/
      
    } elseif ( $action == 'del' ){
      $sql = 'delete 
              from '.$branch_tablename.'
              where 
                '.$branch_fieldname_rootid.'='.$root_id.'
              and
                '.$branch_fieldname_childid.'='.$child_id. ' limit 1';
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.mysql_error().$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        return $objResponse;
      }
    } elseif ( $action == 'update' ){
      // 如果是更新，那這裡就會直接帶過
    } else {
      // 如果都不是我所定義的指令，就直接離開
      exit;
    }
    
    // 不管是新增還是刪除，都會在更新一次table
    $sql = 'select 
              p.*,
              y.'.$child_fieldname_displayname.'
            from '.$branch_tablename.' as p
            left join '.$child_tablename.' as y on p.'.$branch_fieldname_childid.'=y.id
            where
              p.'.$branch_fieldname_rootid.'='.$root_id;
              
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.mysql_error().$brline;
      $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
      return $objResponse;
    }
    
    // 如果找不到資料，就回傳無資料
    $total = mysql_num_rows($result);

    if( $total == '0' ){
      $return .= '無資料..';
    }
    
    $row = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $temp =  $row["name"].'&nbsp;';
        $temp .= '<a href="#" onclick="xajax_'.__FUNCTION__.'('.$row[$branch_fieldname_rootid].','.$row[$branch_fieldname_childid].',\'del\')">';
        $temp .= '[del]';
        $temp .= '</a><br>';
        $return .= $temp;        
    }
    
    act_DbDisconnect($result,$link);

    $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
    $objResponse->assign($divname_update_target, 'innerHTML', $return);
    
    return $objResponse;
} /* end ajax_libraryfile_update */

/*
  當使用者選擇了套件的公司以後
  就會去把相對應的套件列出在select裡面
*/
function ajax_update_package_select($id,$name){
        
    $objResponse=new xajaxResponse();
    
    act_DbConnect();
    
    // 先把multi select options的內容給清掉
    $objResponse->Clear('packages_hide_select','innerHTML');
    
    // 如果沒有編號，就不繼續後續的動作
    if( $id == '' ){
      $objResponse->append('debugdiv', 'innerHTML', '使用者選擇了預設的空白項目<br>');
      
      // 這兩種瀏覽器都可以用
      $ret .= "var objOption = new Option('請選擇其它的套件公司','');";
      $ret .= "document.getElementById('packages_hide_select').options.add(objOption);";
      $objResponse->addscript($ret);  
      
      return $objResponse;
    }
    
    $sql = 'select id,name from '._TABLE_PACKAGE.' where package_company_id='.$id;
    $objResponse->append('debugdiv', 'innerHTML', $sql.'<br>');
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $objResponse->append('debugdiv', 'innerHTML', mysql_error().'<br>');
      $objResponse->addAlert('發現內部錯誤，請與管理人員連繫');
      return $objResponse;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    include('pages/debug-db-result.php');
    $companys = $rows;   
    
    // 這兩種瀏覽器都可以用
    $ret .= "var objOption = new Option('請選擇套件','');";
    $ret .= "document.getElementById('packages_hide_select').options.add(objOption);";
    $objResponse->addscript($ret); 
    
    foreach ($companys as $key => $value){        
      // ff3可用，但ie6,ie7不可用
      // $ret = '<option value="">請選擇分店</option>';
      //$ret .= '<option value="'.$value["id"].'">'.$value["name"].'</option>';
      //$objResponse->assign('companys_hide_select', 'innerHTML', $ret);

      // 這兩種瀏覽器都可以用
      $ret = "var objOption = new Option('".$value["name"]."','".$value["id"]."');";
      $ret .= "document.getElementById('packages_hide_select').options.add(objOption);";
      $objResponse->addscript($ret);       
    } /* companys */    
    
    act_DbDisconnect($result,$link);

    return $objResponse;
} /* end ajax_update_package_select */

/*
 * update: 2009-02-11
 * 處理安裝程序與套件的對應表(1對多)
 * 
 * +---------+-------+-------------------------------------------------+
 * |角色     |別名   |相關的描述                                       |
 * +---------+-------+-------------------------------------------------+
 * |主節點   |root   |假設: 1個人                                      |
 * |分支節點 |branch |說明: 存放主節點編號(1)與子節點編號(n)的對應資料 |
 * |子節點   |child  |假設: 可以擁有多支手機                           |
 * +---------+-------+-------------------------------------------------+
 *
 * 用法: 函式名稱(主節點的編號,子節點的編號,動作)
*/
function ajax_package_update($root_id,$child_id,$action=''){

    global $sql_attrs;
    
    // 定義基本運作的變數
    $functionname = '['.__FUNCTION__.'] ';
    $divname_debug = 'debugdiv';
    $returnmsg = '';
    $brline = '<BR>';
    
    // 定義ajax要更新的目標名稱(divname)
    $divname_update_target = 'usepackage';
    
    // 定義分支節點的變數
    $branch_tablename = _TABLE_INSTALLSCRIPT_PACKAGE;
    $branch_fieldname_rootid  = 'installscript_id';
    $branch_fieldname_childid = 'package_id';
    $branch_fieldname_id = 'id';
    
    // 定義子節點的變數
    $child_tablename = _TABLE_PACKAGE;
    $child_fieldname_displayname = 'name';
    $child_fieldname_id = 'id';

        
    $objResponse=new xajaxResponse();
    
    $objResponse->addClear($divname_update_target,'innerHTML');

    act_DbConnect();    
    
    if( $action == 'add' ){
        
      // 如果使用者是選擇預設的第1項，傳來的item_id將會是空白的
      if( $child_id != '' ){
        // 新增資料前，先檢查分支節點中，對應的關係是否存在
        $sql = 'select '.$branch_fieldname_id.'
                from '.$branch_tablename .'
                where 
                  '.$branch_fieldname_rootid.'='.$root_id.'
                and
                  '.$branch_fieldname_childid.'='.$child_id;
                  
        $returnmsg .= $functionname.$sql.$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        $result = mysql_query($sql);
        if(!$result){
          $returnmsg .= $functionname.mysql_error().$brline;
          $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
          return $objResponse;
        }
        $row = array();
        $row = mysql_fetch_array($result,MYSQL_ASSOC);
        $child_row = $row;
        
        // 確定沒有資料才會新增一筆新的
        if( $child_row[$branch_fieldname_id] == '' ){
          
          $sql_values = array();
          $sql_values[$branch_fieldname_childid] = $child_id;
          $sql_values[$branch_fieldname_rootid] = $root_id;
          $sql_table = $branch_tablename;
          $sql = sql_act_parse($sql_table,$sql_values,$sql_attrs[$sql_table],'insert','');
          $returnmsg .= $functionname.$sql.$brline;
          $result = mysql_query($sql);
          if(!$result){
            $returnmsg .= $functionname.mysql_error().$brline;
            $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
            return $objResponse;
          }
          
        } /* item_row */
      } /* if != empty*/
      
    } elseif ( $action == 'del' ){
      $sql = 'delete 
              from '.$branch_tablename.'
              where 
                '.$branch_fieldname_rootid.'='.$root_id.'
              and
                '.$branch_fieldname_childid.'='.$child_id. ' limit 1';
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.mysql_error().$brline;
        $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
        return $objResponse;
      }
    } elseif ( $action == 'update' ){
      // 如果是更新，那這裡就會直接帶過
    } else {
      // 如果都不是我所定義的指令，就直接離開
      exit;
    }
    
    // 不管是新增還是刪除，都會在更新一次table
    $sql = 'select 
              p.*,
              y.'.$child_fieldname_displayname.'
            from '.$branch_tablename.' as p
            left join '.$child_tablename.' as y on p.'.$branch_fieldname_childid.'=y.id
            where
              p.'.$branch_fieldname_rootid.'='.$root_id;
              
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.mysql_error().$brline;
      $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
      return $objResponse;
    }
    
    // 如果找不到資料，就回傳無資料
    $total = mysql_num_rows($result);

    if( $total == '0' ){
      $return .= '無資料..';
    }
    
    $row = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $temp =  $row["name"].'&nbsp;';
        $temp .= '<a href="#" onclick="xajax_'.__FUNCTION__.'('.$row[$branch_fieldname_rootid].','.$row[$branch_fieldname_childid].',\'del\')">';
        $temp .= '[del]';
        $temp .= '</a><br>';
        $return .= $temp;        
    }
    
    act_DbDisconnect($result,$link);

    $objResponse->append($divname_debug, 'innerHTML', $returnmsg);
    $objResponse->assign($divname_update_target, 'innerHTML', $return);
    
    return $objResponse;
} /* end ajax_package_update */

?>