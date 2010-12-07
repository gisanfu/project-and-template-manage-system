<?php
/*
 * update: 2008-12-23
 * 匯出類似orm的東西出來，方便程式設計師下insert and update的sql語法
 */
 
/*
 * 檢查SQL欄位型態參考檔案是否存在
 * 不存在就會呼叫函式去建立
 */
if( !file_exists(_SQL_ATTR_FILE) and (_SQL_ATTR_FILE != '') ){
  $connect = array( 
               'host' => _DB_HOST,
               'user' => _DB_USER,
               'pass' => _DB_PASS,
               'db'   => _DB_NAME
              );
  create_attr_file($connect,_SQL_ATTR_FILE);
} /* file_exists */
 
// 載入資料庫欄位型態對應檔
include_once(_SQL_ATTR_FILE);

/*
 * 建立讓sql_act_parse函式所使用的SQL欄位型態參考表
 *
 * 輸入引數1  放置資料庫的連線資訊
 *  $connect = array( 
 *               'host' => '111.222.333.444',
 *               'user' => 'mysqluser',
 *               'pass' => 'mysqlpass',
 *               'db'   => 'exampledb'
 *              );
 *
 * 輸入引數2  放置匯出的php檔案路徑
 *  $exportfile = '/home/user/sql-attrs.php';
 */
function create_attr_file($connect, $exportfile){
        
  global $create_attr_file_errmsg;
        
  if( count($connect) != 4 ){
    $create_attr_file_errmsg = '連線資訊元素數量錯誤';
    return false;
  }
        
  $link = mysql_connect( $connect['host'], $connect['user'], $connect['pass']) or $status='error';
  if( $status == 'error' ){
    $create_attr_file_errmsg =  '系統維護中';
    return false;
  }
  
  // 先指定資料庫名稱
  $result = mysql_list_tables($connect['db']);
  
  // 先取得資料表的列表
  $row  = array();
  $rows = array();
  $tmp = 'Tables_in_'.$connect['db'];
  while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
    $rows[] = $row[$tmp];
    //echo $row[$tmp];
  }
  $tables = $rows;
  
  // 在依各資料表去抓欄位資訊
  foreach( $tables as $key => $value ){
    $result = mysql_list_fields($connect['db'],$value);
    $columns = mysql_num_fields($result);
    
    $sql_attrs_creating[$value] = array();
    
    $fields = array();
    for ($i = 0; $i < $columns; $i++) {
      $fieldname = mysql_field_name($result, $i);      
      $fieldtype = mysql_field_type($result, $i);      
      // 轉換型態
      // 只要是需要加上''逗號的，都會被我定義為str
      // 不用加上逗號的，就是int
      switch($fieldtype) {
        case 'int':
          $type = 'int';
          break;
        case 'string':
          $type = 'str';
          break;
        case 'timestamp':
          $type = 'int';
          break;
        case 'datetime':
          $type = 'int';
          break;
        default:
          $type = 'str';
          break;
      } /*switch*/
      $fields[$fieldname] = $type;
    } /*columns*/  
    $sql_attrs_creating[$value] = $fields;
  } /*foreach*/
  
  mysql_close($link);
  
  if( ($file = fopen($exportfile,'w')) == false ){
    $create_attr_file_errmsg =  '檔案寫入錯誤';
    return false;    
  }
  
  fwrite($file,"<?php\r\n");
  set_array_to_file($file,$sql_attrs_creating,'$sql_attrs');
  fwrite($file,"?>");
  fclose($file);

  // 寫入 and 匯出檔案成功
  return true;
        
} /* 函式結束 create_attr_file */

/*
 * 建立讓model_transation_api class所使用的SQL欄位結構參考表
 *
 * 輸入引數1  放置資料庫的連線資訊
 *  $connect = array( 
 *               'host' => '111.222.333.444',
 *               'user' => 'mysqluser',
 *               'pass' => 'mysqlpass',
 *               'db'   => 'exampledb'
 *              );
 *
 * 輸入引數2  放置匯出的php檔案路徑
 *  $exportfile = '/home/user/sql-attrs.php';
 *
 * 輸出的陣列結構
 * tablename = array(fieldname01 => fieldtype01);
 */
function create_schema_file($connect, $exportfile){
        
  global $create_schema_file_errmsg;
        
  if( count($connect) != 4 ){
    $create_schema_file_errmsg = '連線資訊元素數量錯誤';
    return false;
  }
        
  $link = mysql_connect( $connect['host'], $connect['user'], $connect['pass']) or $status='error';
  if( $status == 'error' ){
    $create_schema_file_errmsg =  '系統維護中';
    return false;
  }
  
  // 先指定資料庫名稱
  $result = mysql_list_tables($connect['db']);
  
  // 先取得資料表的列表
  $row  = array();
  $rows = array();
  $tmp = 'Tables_in_'.$connect['db'];
  while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
    $rows[] = $row[$tmp];
    //echo $row[$tmp];
  }
  $tables = $rows;
  
  // 在依各資料表去抓欄位資訊
  foreach( $tables as $key => $value ){
    $result = mysql_list_fields($connect['db'],$value);
    $columns = mysql_num_fields($result);
    
    $sql_schemas_creating[$value] = array();
    
    $fields = array();
    for ($i = 0; $i < $columns; $i++) {
      $fieldname = mysql_field_name($result, $i);      
      $fieldtype = mysql_field_type($result, $i);   
      echo $fieldtype.'<br>';
      $fields[$fieldname] = $fieldtype;
    } /*columns*/  
    $sql_schemas_creating[$value] = $fields;
  } /*foreach*/
  
  //print_r($sql_schemas_creating);
  
  mysql_close($link);
  
  if( ($file = fopen($exportfile,'w')) == false ){
    $create_schema_file_errmsg =  '檔案寫入錯誤';
    return false;    
  }
  
  fwrite($file,"<?php\r\n");
  set_array_to_file($file,$sql_schemas_creating,'$sql_schemas');
  fwrite($file,"?>");
  fclose($file);

  // 寫入 and 匯出檔案成功
  return true;
        
} /* 函式結束 create_schema_file */
 
/*
 * 負責把陣列變數重組成完整的update or insert語法
*/
function sql_act_parse($table, $values, $attrs, $action = 'insert', $parameters = '') {
        
  // $values = Array() 存放的是欄位的內容
  //   '姓名' => '老王'
  //   '編號' => 12
  //   ...
  
  // $attrs = Array() 存放的是欄位的型態, 字串或是整數
  //   '姓名' => 'str'
  //   '編號' => 'int'
  //   ...
      
  // 將陣列的內部指針指向第一個單元
  reset($values);
  //reset($attrs);
  if ($action == 'insert') {
    $query = 'insert into ' . $table . ' (';
    while (list($key,) = each($values)) {
      $query .= $key . ', ';
    }
    $query = substr($query, 0, -2) . ') values (';
    
    // 將陣列的內部指針指向第一個單元
    reset($values);
    //reset($attrs);
    while (list($key,$val) = each($values)) {
      switch ($attrs[$key]) {
        case 'int':
          if( $val != '' ){
            $query .= $val .', ';
          } else {
            $query .= '\'\', ';
          }
          break;
        case 'str':
          $query .= '\'' . mysql_escape_string($val) . '\', ';
          break;
        default:
          $query .= '\'' . mysql_escape_string($val) . '\', ';
          break;
      }
    }
    $query = substr($query, 0, -2) . ')';
  } elseif ($action == 'update') {
    $query = 'update ' . $table . ' set ';
    while (list($key, $val) = each($values)) {
      switch ($attrs[$key]) {
        case 'str':
          $query .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
          break;
        case 'int':
          if( $val != '' ){
            $query .= $key . ' = ' . $val .', ';
          } else {
            $query .= $key . ' = \'\', ';
          }
          break;
        default:
          $query .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
          break;
      }
    } /*while*/
    $query = substr($query, 0, -2);
    if( $parameters != '' ){
      $query .= ' where ' . $parameters;
    } /*parameters*/
  } /*action*/

  return $query;
} /*act_sql_parse*/

/*
 * 跟上面一樣，不過這個是新版的，少了attrs的引數
*/
function php_sql_parse($table, $values, $action, $parameters = '') {
        
  // $values = Array() 存放的是欄位的內容
  //   '姓名' => '老王'
  //   '編號' => 12
  //   ...
  
  // $attrs = Array() 存放的是欄位的型態, 字串或是整數
  //   '姓名' => 'str'
  //   '編號' => 'int'
  //   ...
  
  // 讀取全域陣列變數進來 $sql_attrs
  global $sql_attrs;
  
  if( count($sql_attrs) <= 0 ){
    return 'global array is load fail';
  }
  
  if( $table == '' ){
    return 'arg01 table name is empty';     
  }

  if( $action == '' ){
    return 'arg03 action is empty';
  }
  
  // 取得工作資料表的欄位對應資料
  $attrs = $sql_attrs[$table];
      
  // 將陣列的內部指針指向第一個單元
  reset($values);
  //reset($attrs);
  if ($action == 'insert') {
    $query = 'insert into ' . $table . ' (';
    while (list($key,) = each($values)) {
      $query .= $key . ', ';
    }
    $query = substr($query, 0, -2) . ') values (';
    
    // 將陣列的內部指針指向第一個單元
    reset($values);
    //reset($attrs);
    while (list($key,$val) = each($values)) {
      switch ($attrs[$key]) {
        case 'int':
          if( $val != '' ){
            $query .= $val .', ';
          } else {
            $query .= '\'\', ';
          }
          break;
        case 'str':
          $query .= '\'' . mysql_escape_string($val) . '\', ';
          break;
        default:
          $query .= '\'' . mysql_escape_string($val) . '\', ';
          break;
      }
    }
    $query = substr($query, 0, -2) . ')';
  } elseif ($action == 'update') {
    $query = 'update ' . $table . ' set ';
    while (list($key, $val) = each($values)) {
      switch ($attrs[$key]) {
        case 'str':
          $query .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
          break;
        case 'int':
          if( $val != '' ){
            $query .= $key . ' = ' . $val .', ';
          } else {
            $query .= $key . ' = \'\', ';
          }
          break;
        default:
          $query .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
          break;
      }
    } /*while*/
    $query = substr($query, 0, -2);
    if( $parameters != '' ){
      $query .= ' where ' . $parameters;
    } /*parameters*/
  } /*action*/

  return $query;
} /*act_sql_parse*/

/** 
 * 負責把陣列匯出成檔案的函式
 * http://www.roscripts.com/snippets/show/198
 * Writes an array to a file.  Can be later used by include/require
 * @param resource $file   : A file resource, (as returned from fopen)
 * @param array    $array  : The array tp be written from
 * @param string   $string : The initial variable name of the array,
 *                           as it will appear in the file
 */
function set_array_to_file($file,$array,$string="\$array") {
   fwrite($file,$string."=array();\r\n");
   foreach ($array as $ind => $val) {
      $str=$string."[".quote($ind)."]";
      if (is_array($val)) {
         if (has_no_sub_arrays($val)) {
            fwrite($file,$str."=".compress_array($val).";\r\n");
         } else {
            set_array_to_file($file,$val,$str);
         }
      } else {
         fwrite($file,$str."=".quote($val).";\r\n");
      }
   }
}
/**
 * Checks if an array contains no arrays
 * @param  arary $array : The array to be checked
 * @return boolean      : true if $array contains no sub arrays
 *                        false if it does
 */
function has_no_sub_arrays($array) {
   if (!is_array($array)) {
      return true;
   }
   foreach ($array as $sub) {
      if (is_array($sub)) {
         return false;
      }
   }
   return true;
}
/**
 * Compresses an array into a string:
 * $array=array();
 * $array[0]=0;
 * $array["one"]="one";
 * compress_array($array) will return 'array(0=>0,"one"=>"one")'
 * @param array $array : the array to be compressed
 * @return string      : the "compressed" string representation of $array
 * @note               : works recursively, so $array can contain arrays
 */
function compress_array($array) {
   if (!is_array($array)) {
      return quote($array);
   }
   $strings=array();
   foreach ($array as $ind => $val) {
      $strings[]=quote($ind)."=>".
                 (is_array($val)?compress_array($val):quote($val));
   }
   return "array(".implode(",",$strings).")";
}
/**
 * Adds quotes to $val if its not an integer
 * @param mixed $val : the value to be tested
 */
function quote($val) {
   return is_int($val)?$val:"\"".$val."\"";
}
 
?>
