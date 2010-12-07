<?php

/*
 * 匯出單一的Block區塊資料夾及檔案
 * 匯出前，要確定目的資料夾是不存在的
 * 不然會直接跳過
 */
function php_blockdir_export($block_id,$project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好VIEW的絕對路徑
    $export_blockdir = $project['exportdir'].'/'._PROJECT_VIEW;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_blockdir) ){
      if(!mkdir($export_blockdir, 0777)){
        $returnmsg .= $functionname.'建立VIEW資料夾失敗=>'.$export_blockdir.$brline;
        return $returnmsg;
      }
    }
    
    // 在設定THEME的絕對路徑
    $export_blockdir .= $project['theme_name'].'/';
    
    // 如果THEME這個資料夾不存在，就試著建立它
    if( !file_exists($export_blockdir) ){
      if(!mkdir($export_blockdir, 0777)){
        $returnmsg .= $functionname.'建立THEME資料夾失敗=>'.$export_blockdir.$brline;
        return $returnmsg;
      }
    }
    
    // 取得Block區塊的資料
    $sql = 'select * from '._TABLE_BLOCK.' where id='.$block_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $block = $row;
    
    if( $block['enable'] != '1' ){
      $returnmsg .= $functionname.'本區塊己停用，這次不匯出=>'.$block['name'].$brline;
      return $returnmsg;
    }
    
    // 先指定Block區塊的目的資料夾
    $export_blockdir .= 'BLOCK_' . $block['name'] . '/';
    
    // 如果有存在的話，就回應失敗
    if( file_exists($export_blockdir) ){
      $returnmsg .= $functionname.'資料夾己存在=>'.$export_blockdir.$brline;
      return $returnmsg;
    } else {
      if(!mkdir($export_blockdir, 0777)){
        $returnmsg .= $functionname.'建立資料夾失敗=>'.$export_blockdir.$brline;
        return $returnmsg;
      }
    }
    
    // 如果有指定的話，就讓指定的覆蓋原有的設定
    if( $block['tplname'] == '' ){
      $export_block_tplfile = $export_blockdir.'view.tpl.htm';
    } else {
      $export_block_tplfile = $export_blockdir.$block['tplname'].'.tpl.htm';
    }
    
    // 如果有指定的話，就讓指定的覆蓋原有的設定
    if( $block['headname'] == '' ){
      $export_block_headfile = $export_blockdir.'view.head.htm';
    } else {
      $export_block_headfile = $export_blockdir.$block['headname'].'.head.htm';
    }
    
    // 寫入tpl檔案
    if( ($file = fopen($export_block_tplfile,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 '.$export_block_tplfile.$brline;
      return $returnmsg;
    }        
    fwrite($file,$block['tplbody']);
    fclose($file);
    
    // 寫入head檔案
    if( ($file = fopen($export_block_headfile,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 '.$export_block_headfile.$brline;
      return $returnmsg;
    }        
    fwrite($file,$block['headbody']);
    fclose($file);
    
    act_DbDisconnect($result,$link);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_block_tplfile);
    dos2unix($export_block_headfile);
    
    return $returnmsg;
    
} /* php_blockdir_export() */

/*
 * 匯出單一的Page區塊資料夾及檔案
 * 匯出前，要確定目的資料夾是不存在的
 * 不然會直接跳過
 */
function php_pagedir_export($page_id,$project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好VIEW的絕對路徑
    $export_pagedir = $project['exportdir'].'/'._PROJECT_VIEW;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_pagedir) ){
      if(!mkdir($export_pagedir, 0777)){
        $returnmsg .= $functionname.'建立VIEW資料夾失敗=>'.$export_pagedir.$brline;
        return $returnmsg;
      }
    }
    
    // 在設定THEME的絕對路徑
    $export_pagedir .= $project['theme_name'].'/';
    
    // 如果THEME這個資料夾不存在，就試著建立它
    if( !file_exists($export_pagedir) ){
      if(!mkdir($export_pagedir, 0777)){
        $returnmsg .= $functionname.'建立THEME資料夾失敗=>'.$export_pagedir.$brline;
        return $returnmsg;
      }
    }
    
    // 取得Page區塊的資料
    $sql = 'select * from '._TABLE_PAGE.' where id='.$page_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $page = $row;
    
    if( $page['enable'] != '1' ){
      $returnmsg .= $functionname.'本區塊己停用，這次不匯出=>'.$page['name'].$brline;
      return $returnmsg;
    }
    
    // 先指定Page區塊的目的資料夾
    $export_pagedir .= 'PAGE_' . $page['name'] . '/';
    
    // 如果有存在的話，就回應失敗
    if( file_exists($export_pagedir) ){
      $returnmsg .= $functionname.'資料夾己存在=>'.$export_pagedir.$brline;
      return $returnmsg;
    } else {
      if(!mkdir($export_pagedir, 0777)){
        $returnmsg .= $functionname.'建立資料夾失敗=>'.$export_pagedir.$brline;
        return $returnmsg;
      }
    }
    
    // 如果有指定的話，就讓指定的覆蓋原有的設定
    if( $page['tplname'] == '' ){
      $export_page_tplfile = $export_pagedir.'view.tpl.htm';
    } else {
      $export_page_tplfile = $export_pagedir.$page['tplname'].'.tpl.htm';
    }
    
    // 取得所關連的所有Block區塊名稱的資料
    $sql = 'select
              b.name,
              b.tplname,
              b.headname
            from '._TABLE_BLOCK.' as b
            left join '._TABLE_PAGE_BLOCK.' as pb on b.id=pb.block_id
            where 
              pb.page_id='.$page_id.'
            and
              b.enable=\'1\'
           ';
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    $blocks = $rows;
    
    // 開啟tpl檔案
    if( ($file = fopen($export_page_tplfile,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 '.$export_page_tplfile.$brline;
      return $returnmsg;
    }
    
    // 寫入tplbody
    fwrite($file,$page['tplbody']);
    fwrite($file,$nextline);
    
    // 寫入smarty的include指令，當然，以下都只是註解而以
    fwrite($file,'<{*'.$nextline);

    // 這兩個迴圈，是寫入給製作Page tpl檔案的人參考用的
    // 讓他可以用複製貼上的方式，把Block區塊放置到正確的地方
    foreach($blocks as $key => $val ){
      if( $val['headname'] == '' ){
        fwrite($file,'  <{include file='.$val['name'].'/'.'view.head.htm'.'}>'.$nextline);
      } else {
        fwrite($file,'  <{include file='.$val['name'].'/'.$val['headname'].'.head.htm'.'}>'.$nextline);
      }
    }
    foreach($blocks as $key => $val ){
      if( $val['tplname'] == '' ){
        fwrite($file,'  <{include file='.$val['name'].'/'.'view.tpl.htm'.'}>'.$nextline);
      } else {
        fwrite($file,'  <{include file='.$val['name'].'/'.$val['tplname'].'.tpl.htm'.'}>'.$nextline);
      }
    }
    
    // 結束註解及關閉檔案
    fwrite($file,'*}>');
    fclose($file);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_page_tplfile);
    
    act_DbDisconnect($result,$link);
    
    return $returnmsg;
    
} /* php_pagedir_export() */

/*
 * 匯出單一的Controller區塊的檔案
 * 匯出前，要確定目的檔案是不存在的
 * 不然會直接跳過
 */
function php_controllerfile_export($controller_id,$project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好CONTROLLER的絕對路徑
    $export_controllerdir = $project['exportdir'].'/'._PROJECT_CONTROLLER;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_controllerdir) ){
      if(!mkdir($export_controllerdir, 0777)){
        $returnmsg .= $functionname.'建立CONTROLLER資料夾失敗=>'.$export_controllerdir.$brline;
        return $returnmsg;
      }
    }
    
    // 先取得Controller區塊的資料
    $sql = 'select * from '._TABLE_CONTROLLER.' where id='.$controller_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $controller = $row;
    
    if( $controller['enable'] != '1' ){
      $returnmsg .= $functionname.'本區塊己停用，這次不匯出=>'.$controller['name'].$brline;
      return $returnmsg;
    }
    
    // 先指定Controller的目的檔案
    $export_controllerfile .= $export_controllerdir . $controller['name'] . '.php';
    
    // 如果有存在的話，就回應失敗
    if( file_exists($export_controllerfile) ){
      $returnmsg .= $functionname.'檔案己存在=>'.$export_controllerfile.$brline;
      return $returnmsg;
    }
    
    
    // 從這開始組合php檔案的內容
    $space = '  ';
    $export_phpcontent = '<?php'.$nextline.$nextline;
    $export_phpcontent .= '// Controller Name => '.$controller['name'].$nextline;
    $export_phpcontent .= $controller['phpbody'].$nextline.$nextline;
    
    // 先取得Controller底下的所有Signal區塊
    $sql = 'select 
              s.*
            from '._TABLE_SIGNAL.' as s
            left join '._TABLE_CONTROLLER_SIGNAL.' as cs on s.id=cs.signal_id
            where 
              cs.controller_id='.$controller_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    if(mysql_num_rows($result)<=0){
      $returnmsg .= $functionname.'沒有任何對應的Signal區塊=>'.$controller['name'].$brline;
      return $returnmsg;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    $signals = $rows;
    
    foreach( $signals as $signal_key => $signal_val ){
       
      // 如果是第一筆，就要是if，而不是elseif
      if( $signal_key == '0' ){
        $export_phpcontent .= 'if( $hidop == \''.$signal_val['name'].'\' ){'.$nextline.$nextline;
      } else {
        $export_phpcontent .= '} elseif( $hidop == \''.$signal_val['name'].'\' ){'.$nextline.$nextline; 
      }
      
      $export_phpcontent .= $space.'// Signal Body => '.$signal_val['name'].$nextline;
      $export_phpcontent .= $signal_val['phpbody'].$nextline.$nextline;
        
      // 以page_id去取得所有相關Block的phpbody
      $sql = 'select 
                b.name,
                b.phpbody
              from '._TABLE_PAGE_BLOCK.' as pb
              left join '._TABLE_BLOCK.' as b on pb.block_id=b.id
              where
                pb.page_id='.$signal_val['page_id'];
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
        return $returnmsg;
      }
      $row  = array();
      $rows = array();
      while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $export_phpcontent .= $space.'// Block Name => '.$row['name'].$nextline;
        $export_phpcontent .= $row['phpbody'].$nextline.$nextline;
      }
      
      // 以page_id去取得Page的名稱和phpbody
      $sql = 'select * from '._TABLE_PAGE.' where id='.$signal_val['page_id'];
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
        return $returnmsg;
      }
      $row  = array();
      $row = mysql_fetch_array($result,MYSQL_ASSOC);
      $page = $row;
      $export_phpcontent .= $space.'// Page Name => '.$page['name'].$nextline;
      $export_phpcontent .= $page['phpbody'].$nextline.$nextline;
      
      // 先取得Page的資料夾名稱
      $page_tplname = 'PAGE_'.$page['name'];
      
      // 取得Page的tpl名稱
      if( $page['tplname'] == '' ){
        $page_tplname .= '/view.tpl.htm';
      } else {
        $page_tplname .= '/'.$page['tplname'].'.tpl.htm';
      }
       
      // 把載入Page的部分匯出
      $export_phpcontent .= $space.'$smarty->display(\''.$page_tplname.'\');'.$nextline.$nextline;
      
    } /* foreach signals */
    
    act_DbDisconnect($result,$link);
    
    // 最後，補上hidop判斷式的結尾
    $export_phpcontent .= '} else {'.$nextline;
    $export_phpcontent .= $space.'echo \'miss arg\';'.$nextline;
    $export_phpcontent .= $space.'exit;'.$nextline;
    $export_phpcontent .= '}'.$nextline.$nextline;
    $export_phpcontent .= '?>';
       
    // 開啟php檔案,準備要寫入Controller檔案
    if( ($file = fopen($export_controllerfile,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 '.$export_controllerfile.$brline;
      return $returnmsg;
    }
    
    // 寫入tplbody
    fwrite($file,$export_phpcontent);
    fclose($file);
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_controllerfile);
    
    return $returnmsg;
    
} /* php_controllerfile_export() */

/*
 * 匯出程序參照檔
 */
function php_proc_attr_export($project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
        
    /*
     * 第1支檔案:
     * 1.取得資料表別名與實際名稱的對應列表
     * 2.取得程序的列表
     * 3.匯出所有的procedure成sql檔案(目前只能用replace的方式去覆蓋原有的procedure)
     *
     * 第2支檔案:
     * 1.取得欄位列表
     * 2.取得欄位屬性的列表
     * 3.匯出procedure的屬性名稱及值的對應表
     */
     
    // 取得專案的基本資料   
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 指定要寫入的完整路徑及檔名
    $export_attr_file = $project["exportdir"].'/'._PROJECT_CONFIG;
    
    // 如果CONFIG這個資料夾不存在，就試著建立它
    if( !file_exists($export_attr_file) ){
      if(!mkdir($export_attr_file, 0777)){
        $returnmsg .= $functionname.'建立CONFIG資料夾失敗=>'.$export_attr_file.$brline;
        return $returnmsg;
      }
    }
    
    $export_attr_file .= 'sql_proc_attrs.php';
    
    // 取得程序的列表    
    $sql = 'select * from '._TABLE_PROCEDURE.' where enable=\'1\' and project_id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    $procedures = $rows;
    
    // 如果沒有建立任何的procedure,就離開
    if( count($procedures) <= 0 ){
      $returnmsg .= $functionname.'沒有任何程序可供匯出'.$brline;
      return $returnmsg;
    }
    
    // 這個變數是要存放要寫入proc屬性用的
    $sql_proc_attrs_creating = array();

    foreach( $procedures as $key => $val ){
        
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
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
        return $returnmsg;
      }
      $row  = array();
      $rows = array();
      while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
        $rows[$row["name"]] = $row;
      }
      $sql_proc_attrs_creating[$val["name"]] = $rows;
            
    } /* foreach */
    
    act_DbDisconnect($result,$link);
    
    // 寫入procedure PHP屬性檔
    // 這個比較特別，可以直接覆蓋
    if( ($file = fopen($export_attr_file,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 '.$export_attr_file.$brline;
      return $returnmsg;
    }        
    fwrite($file,"<?php\r\n");
    set_array_to_file($file,$sql_proc_attrs_creating,'$sql_proc_attrs');
    fwrite($file,"?>");
    fclose($file);        
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_attr_file);
    
    return $returnmsg;
    
} /* php_proc_attr_export() */

/*
 * 匯出資料庫帳號密碼的設定檔
 */
function php_sql_connect_export($db_id,$project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好CONTROLLER的絕對路徑
    $export_configdir = $project['exportdir'].'/'._PROJECT_CONFIG;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_configdir) ){
      if(!mkdir($export_configdir, 0777)){
        $returnmsg .= $functionname.'建立CONFIG資料夾失敗=>'.$export_configdir.$brline;
        return $returnmsg;
      }
    }
    
    // 設定要匯出的檔案名稱
    $export_sql_connect_file = $export_configdir . 'sql_connect.php';
    
    // 取得db的相關資料
    $sql = 'select * from '._TABLE_PROJECT_DB.' where id='.$db_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project_db = $row;
    
    act_DbDisconnect($result,$link);
    
    // 寫入procedure PHP屬性檔
    // 這個比較特別，可以直接覆蓋
    if( ($file = fopen($export_sql_connect_file,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_sql_connect_file.$brline;
      return $returnmsg;
    }        
    fwrite($file,'<?php'.$nextline);
    fwrite($file,'define(\'_DB_NAME\', \''.$project_db['dbname'].'\');'.$nextline);
    fwrite($file,'define(\'_DB_HOST\', \''.$project_db['host'].'\');'.$nextline);
    fwrite($file,'define(\'_DB_PORT\', \''.$project_db['port'].'\');'.$nextline);
    fwrite($file,'define(\'_DB_USER\', \''.$project_db['user'].'\');'.$nextline);
    fwrite($file,'define(\'_DB_PASS\', \''.$project_db['pass'].'\');'.$nextline);
    fwrite($file,'?>');
    fclose($file);        
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_attr_file);
    
    return $returnmsg;
        
} /* php_sql_connect_export() */

/*
 * 匯出SiteRoot的路徑檔案到Config資料夾內
 */
function php_siterootfile_export($project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
        
    // 取得專案的基本資料   
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    act_DbDisconnect($result,$link);
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 指定要寫入的完整路徑及檔名
    $export_dir = $project["exportdir"].'/'._PROJECT_CONFIG;
    
    // 如果CONFIG這個資料夾不存在，就試著建立它
    if( !file_exists($export_dir) ){
      if(!mkdir($export_dir, 0777)){
        $returnmsg .= $functionname.'建立CONFIG資料夾失敗=>'.$export_dir.$brline;
        return $returnmsg;
      }
    }
    
    $export_siterootfile .= $export_dir.'siteroot.php';

    $space = '  ';
    
    // 寫入procedure PHP屬性檔
    // 這個比較特別，可以直接覆蓋
    if( ($file = fopen($export_siterootfile,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_siterootfile.$brline;
      return $returnmsg;
    }        
    fwrite($file,'<?php'.$nextline);
    fwrite($file,$space.'define(\'__SITE_ROOT\', \''.$project['exportdir'].'\');'.$nextline);
    fwrite($file,'?>');
    fclose($file);        
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_attr_file);
    
    return $returnmsg;
        
} /* php_siterootfile_export() */

/*
 * 建立目錄結構
 * 會把default_site這個資料夾複製到專案的資料夾
 * 當然！如果資料夾己存在，就會略過
 * 如果資料夾己存在，而複蓋上去，那還得了
 */
function php_createrootdir($project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';    
    $returnmsg = '';
        
    act_DbConnect();
        
    // 取得專案的基本資料   
    $sql = 'select 
              p.*,
              t.name as theme_name
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    act_DbDisconnect($result,$link);
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 指定要寫入的完整路徑及檔名
    $export_dir = $project["exportdir"];
    
    // 如果專案路徑有存在，就直接離開
    if( file_exists($export_dir) ){
      $returnmsg .= $functionname.'建立專案資料夾失敗=>'.$export_dir.$brline;
      return $returnmsg;
    }
    
    $export_defaultsite .= __SITE_ROOT.'/default_site'; 
    
    // 如果專案資料來源的路徑不存在，就直接離開
    if( !file_exists($export_defaultsite) ){
      $returnmsg .= $functionname.'專案來源資料夾路徑不存在=>'.$export_defaultsite.$brline;
      return $returnmsg;
    }
    
    $cmd = 'cp -r '.$export_defaultsite.' '.$export_dir;
    $returnmsg .= $functionname.$cmd.$brline;
    
    exec($cmd,$output);

    foreach( $output as $key => $val ){
      $returnmsg .= $val.$brline; 
    }
    
    return $returnmsg;
        
}/* php_createrootdir() */

/*
 * 產生風格的設定檔，只是匯出一個檔案，裡面只有Define這一行而以
 */
function php_themefile_export($project_id){
        
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.exportdir,
              t.name 
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好CONTROLLER的絕對路徑
    $export_configdir = $project['exportdir'].'/'._PROJECT_CONFIG;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_configdir) ){
      if(!mkdir($export_configdir, 0777)){
        $returnmsg .= $functionname.'建立CONFIG資料夾失敗=>'.$export_configdir.$brline;
        return $returnmsg;
      }
    }
    
    // 設定要匯出的檔案名稱
    $export_theme_file = $export_configdir . 'theme.php';
    
    $returnmsg .= $functionname.'export file=>'.$export_theme_file.$brline;
    
    act_DbDisconnect($result,$link);
    
    // 寫入Theme PHP設定檔
    // 這個可以直接覆蓋
    if( ($file = fopen($export_theme_file,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_theme_file.$brline;
      return $returnmsg;
    }        
    fwrite($file,'<?php'.$nextline);
    fwrite($file,'  define(\'_THEME_NAME\', \''.$project['name'].'\');'.$nextline);
    fwrite($file,'?>');
    fclose($file);        
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_theme_file);
    
    return $returnmsg;
        
} /* php_themefile_export() */

/*
 * 匯出函式所有檔案
 */
function php_exportlibraryfiles($project_id){
    
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';
    $returnmsg = '';
        
    act_DbConnect();
    
    // 取得專案的資料
    $sql = 'select 
              p.exportdir,
              t.name 
            from '._TABLE_PROJECT.' as p
            left join '._TABLE_THEME.' as t on p.theme_id=t.id
            where p.id='.$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $project = $row;
    
    if( $project["exportdir"] == '' ){
      $returnmsg .= $functionname.'請先指定專案的匯出路徑'.$brline;
      return $returnmsg;
    }
    
    // 先設定好LIBRARY的絕對路徑
    $export_libdir = $project['exportdir'].'/'._PROJECT_LIBRARY;
    
    // 如果VIEW這個資料夾不存在，就試著建立它
    if( !file_exists($export_libdir) ){
      if(!mkdir($export_libdir, 0777)){
        $returnmsg .= $functionname.'建立LIBRARY資料夾失敗=>'.$export_libdir.$brline;
        return $returnmsg;
      }
    }
    
    // 取得函式檔案的列表
    $sql = "select 
              y.id,
              y.name as filename,
              g.fileexten,
              s.name as subdir,
              g.alias as language_name
            from "._TABLE_PROJECT_FILE." as p
            left join "._TABLE_LIBRARY_FILE." as y on p.libraryfile_id=y.id
            left join "._TABLE_LANGUAGE." as g on y.language_id=g.id
            left join "._TABLE_LIBRARY_SUBDIR." as s on y.librarydir_id=s.id
            where p.project_id=".$project_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $rows = array();
    while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
      $rows[] = $row;
    }
    $files = $rows;
    
    foreach( $files as $file_key => $file_val ){
        
      // 檢查Library次資料夾是否有建立
      // 如果有建立的話，就直接使用
      // 之前如果檔案有存在的話，就直接覆蓋
      $export_libsubdir = $export_libdir.$file_val['subdir'].'/';
      
      // 如果次資料夾不存在，就試著建立它
      if( !file_exists($export_libsubdir) ){
        if(!mkdir($export_libsubdir, 0777)){
          $returnmsg .= $functionname.'建立LIBRARY次資料夾失敗=>'.$export_libsubdir.$brline;
          return $returnmsg;
        }
      }
        
      // 取得函式的列表
      // 不用Match程式語言的編號了，因為己經先處理好連結的關係
      $sql = 'select 
                b.*
              from '._TABLE_LIBRARY_FILE_ITEM.' as m
              left join '._TABLE_LIBRARY_ITEM.' as b on m.libraryitem_id=b.id
              where m.libraryfile_id='.$file_val['id'];
      $returnmsg .= $functionname.$sql.$brline;
      $result = mysql_query($sql);
      if(!$result){
        $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
        return $returnmsg;
      }
      $row  = array();
      $rows = array();
      $writebody = '';
      while($row = mysql_fetch_array($result,MYSQL_ASSOC)){
        $writebody .= $row['synopsis'].$nextline;
        $writebody .= $row['bodytext'].$nextline.$nextline;
      }
      
      // 如果是php類的，就在body前後加上php的字眼
      if($file_val['language_name'] == 'php'){
        $writebody = '<?php'.$nextline.$nextline.$writebody.$nextline.'?>';
      }
      
      // 指定要寫入的檔案
      $filename = '';
      if( $file_val['filename'] == '' ){
        $filename = '';
      } else {
        $filename .= $file_val['filename'];
        if( $file_val['fileexten'] != '' ){
          $filename .= '.'.$file_val['fileexten'];
        }
      }
      
      if( $filename == '' ){
        $returnmsg .= $functionname.'檔名為空白'.$brline;
        continue;
      }
      
      $export_function_file = $export_libsubdir . $filename;

      if( ($file = fopen($export_function_file,'w')) == false ){
        $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_function_file.$brline;
        return $returnmsg;
      }        
      fwrite($file,$writebody);
      fclose($file);        
    
      // 因為匯出的是dos格式，把它轉成unix格式
      dos2unix($export_function_file);
      
    } // foreach
    
    return $returnmsg;

} /* php_exportlibraryfiles() */

/*
 * 匯出函式所有檔案
 */
function php_export_install_script($installscript_id){
    
    $functionname = '['.__FUNCTION__.'] ';    
    $nextline = "\r\n";
    $brline = '<BR>';
    $returnmsg = '';
    
    // 動作說明
    // 1.取得所有套件的資料
    // 2.讀取txtbody的內容
    // 3.關鍵字替換、以及註解拿掉
    // 4.匯出檔案
    
    act_DbConnect();
    
    // 取得安裝程序的資料
    $sql = 'select * from '._TABLE_INSTALL_SCRIPT.' where id='.$installscript_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $row = mysql_fetch_array($result,MYSQL_ASSOC);
    $installscript = $row;
    
    $export_installscript_dir = $installscript['path'];
    
    // 如果資料夾不存在，就試著建立它
    if( !file_exists($export_installscript_dir) ){
      if(!mkdir($export_installscript_dir, 0777)){
        $returnmsg .= $functionname.'建立安裝程序的資料夾失敗=>'.$export_installscript_dir.$brline;
        return $returnmsg;
      }
    }
    
    // 取得相依套件
    $sql = 'select 
              p.alias,
              p.name,
              p.unzip,
              p.downloadlink
            from '._TABLE_INSTALLSCRIPT_PACKAGE.' as s
            left join '._TABLE_PACKAGE.' as p on s.package_id=p.id
            where s.installscript_id='.$installscript_id;
    $returnmsg .= $functionname.$sql.$brline;
    $result = mysql_query($sql);
    if(!$result){
      $returnmsg .= $functionname.'Query失敗=>'.mysql_error().$brline;
      return $returnmsg;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;
    }
    $packages = $rows;
    
    // 把txtbody內的套件別名更換成正式的套件名稱，並附加上去
    $txtbody = $installscript["txtbody"];
    if( count($packages) > 0 ){
      foreach( $packages as $package_key => $package_val ){
        $txtbody = str_replace('%'.$package_val["alias"].'_package%',$package_val["name"],$txtbody);
        $txtbody = str_replace('%'.$package_val["alias"].'_unzipdir%',$package_val["unzip"],$txtbody);
      } /* foreach */
    } /* if */
    
    $writelines = split ("\r\n", $txtbody);
    
    // 把空白、comment過濾掉
    $writebody = '';
    foreach( $writelines as $writeline_key => $writeline_val ){
      if( preg_match("/^#!/",$writeline_val) ){
        $writebody .= $writeline_val.$nextline;
      } elseif( preg_match("/^#/",$writeline_val) ){
        // do nothing
      } elseif( $writeline_val == '' ){
        // do nothing
      } else {
        $writebody .= $writeline_val.$nextline;
      }
    }
    
    $export_installscript_file = $export_installscript_dir . '/install.sh';
    $export_wget_file = $export_installscript_dir . '/wget.sh';
    
    if( ($file = fopen($export_installscript_file,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_installscript_file.$brline;
      return $returnmsg;
    }        
    fwrite($file,$writebody);
    fclose($file);      
    
    if( ($file = fopen($export_wget_file,'w')) == false ){
      $returnmsg .= $functionname.'檔案開啟錯誤 => '.$export_wget_file.$brline;
      return $returnmsg;
    }
    fwrite($file,'#!/bin/sh'.$nextline);
    foreach( $packages as $package_key => $package_val ){
      fwrite($file,'wget --tries=1 '.$package_val['downloadlink'].$nextline);
    }    
    fclose($file);  
    
    // 因為匯出的是dos格式，把它轉成unix格式
    dos2unix($export_installscript_file);
    dos2unix($export_wget_file);
        
    return $returnmsg;

} /* php_exportlibraryfiles() */

?>