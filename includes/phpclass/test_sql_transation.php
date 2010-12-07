<?php
function php_sql_transation_parse($f_field_values, $f_sql_action, $f_sql_table, $f_sql_parameters = '') {

  /* 目前這個函式，支援update,insert,delete的資料庫動作，及支援交易所需要的參數 */
  
  // 除錯會用到的變數
  $functionname = '['.__FUNCTION__.'] ';
  $nextline = "\n";
  
  /* 
  這裡是要定義這三種SQL語法對於交易的動作關連
  
    +-------+----------------+--------+
    |動作   |回復前的準備動作|回復動作|
    +-------+----------------+--------+
    |update | select         | update |
    |delete | select         | insert |
    |insert | 無             | delete |
    +-------+----------------+--------+
   */
  
  /*
    $f_field_values = Array() 存放的是欄位的內容
      '姓名' => '老王'
      '編號' => 12
      ...
    
    $attrs = Array() 存放的是欄位的型態, 字串或是整數
      '姓名' => 'str'
      '編號' => 'int'
      ...
  */
  
  // 讀取全域陣列變數進來 $sql_attrs
  global $sql_attrs;
  
  /* 定義裡面所使用到的變數 */

  /* 
    存放return的變數
    正常的情況
    array(
          "debug"          => "偵錯訊息，以\n代表跳行",
          "insert_id"      => "1", // 代表要用insert後的編號，去把2個字串取代掉(%%insert_id_fieldname%%,%%insert_id%%)
          "sql"            => "所要執行的SQL語法",       // $query 
          "rollback_ready" => "回應前所要執行的SQL語法", // $rollback_ready
          "rollback"       => "回復所要執行SQL語法"      // $rollback
         )
    
    失敗的情況
    array(
          "error" => "錯誤訊息"
          "debug" => "偵錯訊息，以\n代表跳行",
         );
   */
  $returnarray = array();
  
  /*
    定義insert供人取代的字串(%%key%%)名稱
   */
  $insert_replace_string["field"] = 'insert_id_fieldname';
  $insert_replace_string["value"] = 'insert_id';
  
  // 建立除錯用的元素
  $returnarray['debug'] .= $functionname.'table=>'.$f_sql_table.$nextline;
  $returnarray['debug'] .= $functionname.'action=>'.$f_sql_action.$nextline;
  $returnarray['debug'] .= $functionname.'parameter=>'.$f_sql_parameters.$nextline;
  
  /*
    檢查各個引數
   */
  if( count($sql_attrs) <= 0 ){
    $errormsg = 'global array is load fail';
    $returnarray['error'] = $errormsg;
    return $returnarray;
  } else {
    $debugmsg = 'sql_attrs count is > 0';
    $returnarray['debug'] = $debugmsg;
  }
  
  if( $f_sql_table == '' ){
    $errormsg = 'table name is empty';
    $returnarray['error'] = $errormsg;
    return $returnarray;
   } else {
    $debugmsg = 'table name is '.$f_sql_table;
    $returnarray['debug'] = $debugmsg;
  }

  if( $f_sql_action == '' ){
    $errormsg = 'action is empty';
    $returnarray['error'] = $errormsg;
    return $returnarray;
  } else {
    $debugmsg = 'action is '.$f_sql_action;
    $returnarray['debug'] = $debugmsg;
  }
  
  // 取得工作資料表的欄位對應資料
  $attrs = $sql_attrs[$f_sql_table];
      
  // 將陣列的內部指針指向第一個單元
  reset($f_field_values);
  //reset($attrs);
  
  // 把insert語法，先建立一部份(key)
  while (list($key,) = each($f_field_values)) {
    $insert_keys .= $key . ', ';
  }
  // 去最後的逗點和空白
  $insert_keys = substr($insert_keys, 0, -2);
  
  // 將陣列的內部指針指向第一個單元
  reset($f_field_values);
  
  // 把update和insert語法，先建立一部份
  while (list($key, $val) = each($f_field_values)) {
    switch ($attrs[$key]) {
      case 'int':
        if( $val != '' ){
          $insert_fields .= $val .', ';
          $update_fields .= $key . ' = ' . $val .', ';
        } else {
          $insert_fields .= '\'\', ';
          $update_fields .= $key . ' = \'\', ';
        }
        break;
      case 'str':
        $insert_fields .= '\'' . mysql_escape_string($val) . '\', ';
        $update_fields .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
        break;
      default:
        $insert_fields .= '\'' . mysql_escape_string($val) . '\', ';
        $update_fields .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
        break;
    }
  } /*while*/
  // 去最後的逗點和空白
  $insert_fields = substr($insert_fields, 0, -2);
  $update_fields = substr($update_fields, 0, -2);
  
  // 產出SQL語法的成品，不包含condition，供後續主要的區段程式使用
  $select_finished = 'select * from ' . $f_sql_table;
  $insert_finished = 'insert into ' . $f_sql_table . ' ('. $insert_keys . ') values (' . $insert_fields . ')';
  $update_finished = 'update ' . $f_sql_table . ' set '.$update_fields.' ';
  $delete_finished = 'delete from '.$f_sql_table;
  
  if ($f_sql_action == 'insert') {
   
    $returnarray['sql'] = $insert_finished;
    $returnarray['rollback_ready'] = ''; /* 因為insert不需要回復之前的準備語法 */
    $returnarray['rollback'] = $delete_finished.' where '.$insert_replace_string['field'].'='.$insert_replace_string['value'];
    
  } elseif ($f_sql_action == 'update') {
    
    $condition = ' where ' . $f_sql_parameters;
    
    if( $f_sql_parameters != '' ){
      $update_finished .= $condition;
      $select_finished .= $condition;
    } /*f_sql_parameters*/
    
    $returnarray['sql'] = $update_finished;
    $returnarray['rollback_ready'] = $select_finished;
    $returnarray['rollback'] = $update_finished; /* rollback跟sql是一樣的 */
    
  } elseif( $f_sql_action == 'delete' ){
				
    $condition = ' where ' . $f_sql_parameters;
    
    if( $f_sql_parameters != '' ){
		  $select_finished .= $condition;
		  $delete_finished .= $condition;
    } /*f_sql_parameters*/
    
    $returnarray['sql'] = $delete_finished;
    $returnarray['rollback_ready'] = $select_finished;
    $returnarray['rollback'] = $insert_finished;
  
  } else {
    $errormsg = 'action is not support =>'.$f_sql_action;
    $returnarray['error'] = $errormsg;
  } /*f_sql_action*/

  return $query;
} /*php_sql_transation_parse*/


?>