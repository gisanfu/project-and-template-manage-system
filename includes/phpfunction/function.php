<?php

/*
 * update: 2008-12-23
 * 載入函式的控制端
 */

include_once('function-general.php');
include_once('function-createattr.php');
include_once('function-xajax.php');
include_once('function-frame-export.php');
include_once('function-dosunix.php');

/*
 * update: 2008-12-31
 * 這個是給其它專案所使用的範例函式API
 * 配合載入本程式所匯出的兩支檔案
 * 可以讓呼叫資料庫的部分更系統化
 *
 */
function php_callproc($procname,$values){
      
  // 讓呼叫這個函式的來源，可以知道錯誤和debug的訊息是什麼
  global $db_errmsg;
  global $db_debugtxt;
  
  $db_debugtxt = array();
  
  // 存放排序OK的陣列變數
  $value_sequence = array();
  
  // $attrs = Array() 存放的是程序的欄位相關屬性
  // $attrs = 
  //   array(
  //     "procedure名稱" => array(
  //        "argname01" => array(
  //           "name"     => "argname01",
  //           "length"   => "10",
  //           "required" => "1",
  //           "sequence" => "1",
  //           "type"     => "INT"
  //        )
  //     )
  //   );
  global $sql_proc_attrs;
  
  // $procname是要呼叫的mysql procedure 名稱
  
  // 讀取全域陣列變數進來 $sql_proc_attrs
  // $values = Array() 存放的是欄位的內容
  //   '姓名' => '老王'
  //   '編號' => 12
  //   ...  
  
  // 規劃: 連線資料庫區段(這我要自己在寫一次)
  // 規劃: 檢查"必要"的引數
  // 規劃: 檢查長度
  // 規劃: 轉換型態，看要不要加引號
  // 規劃: 建立sql語法，別忘了要套上引數的順序
  // 規劃: 執行sql語法，要加上$result的判斷(如果是1，就不用在fetch_array)
  // 規劃: 把結果做成rows的陣列變數，並return
  
  // 檢查procname名稱是否存在
  if(array_key_exists($procname,$sql_proc_attrs) == false ){
    $message = '['.$procname.'] procedure name is not exist';
    $db_errmsg = $message;
    $db_debugtxt[] = $message;
    return;
  }
  
  // debug
  // echo '<pre>';
  // print_r($sql_proc_attrs[$procname]);
  // echo '</pre>';
  
  if( count($sql_proc_attrs[$procname]) > 0 ){
    foreach($sql_proc_attrs[$procname] as $key => $val ){
      // 檢查必要引數
      if( $val["required"] == '1' ){
        if( $values[$key] == '' ){
          $message = '['.$procname.']'.' '.$key.'  is require field';
          $db_errmsg = $message;
          $db_debugtxt[] = $message;
          return;      
        } /* if values */   
      } /* if required */
      // 準備好待回要排序的陣列變數
      $value_sequence[$key] = $val['sequence'];
    } /* foreach */
  } /* if count*/
  
  // 將陣列排序，以value為主
  asort($value_sequence);
  
  // debug
  // echo '<pre>';
  // print_r($value_sequence);
  // echo '</pre>';
  
  // 把變數值帶進來己排序好的地方
  if(count($values) > 0 ){
    foreach($value_sequence as $key => $val){
      $value_sequence[$key] = $values[$key];
    }/* foreach value_sequence */
  }
  
  // 檢查長度
  // 目前暫時不寫....
  
  // 連線資料庫
  $link = mysqli_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status='error';
  if( $status == 'error' ){
    $message = $link->error;
    $db_errmsg = $message;
    $db_debugtxt[] = $message;
    return;
  }
  mysqli_query($link,'set names utf8');
  mysqli_select_db($link,_DB_NAME);
  
  // 重建sql語法
  $sql = 'call '.$procname.'(';
  if(count($value_sequence) > 0 ){
    foreach( $value_sequence as $fieldname => $fieldval ){
      switch ($sql_proc_attrs[$procname][$fieldname]["type"]) {
        case 'INT':
          if( $val != '' ){
            $sql .= $fieldval .', ';
          } else {
            $sql .= '\'\', ';
          }
          break;
        case 'VARCHAR':
          $sql .= '\'' . mysql_escape_string($fieldval) . '\', ';
          break;
        default:
          $sql .= '\'' . mysql_escape_string($fieldval) . '\', ';
          break;
      } /* switch */
    } /* foreach values */
    // 把最後面的逗點和空白刪掉
    $sql = substr($sql, 0, -2);
  } /* if count */  
  $sql .= ')';  
  $db_debugtxt[] = $sql;
  
  $link->multi_query($sql) or $status = 'error'; 
  if( $status == 'error' ){
    $message = $link->error;
    $db_errmsg = $message;
    $db_debugtxt[] = $message;
    return;
  }
  
  while( $link->more_results() ){
    if ($result = $link->store_result()) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $rows[] = $row;
      }
      $result->close();
    }    
    $link->next_result();
  }
  
  // 資料庫離線
  $link->close();
  
  return $rows;
  
} /* 函式結束 php_callproc */

/*
 * update: 2008-1-5
 * 這個是給其它專案所使用的範例函式API
 * 配合載入本程式所匯出的兩支檔案
 * 可以讓呼叫資料庫的部分更系統化
 *
 * 利用傳進來的引數，產生SQL語法
 *
 */
function php_proc_parse($procname,$values){
      
  // 讓呼叫這個函式的來源，可以知道錯誤和debug的訊息是什麼
  //global $db_errmsg;
  global $db_debugtxt;
  
  //$db_debugtxt = array();
  
  // 存放排序OK的陣列變數
  $value_sequence = array();
  
  // $attrs = Array() 存放的是程序的欄位相關屬性
  // $attrs = 
  //   array(
  //     "procedure名稱" => array(
  //        "argname01" => array(
  //           "name"     => "argname01",
  //           "length"   => "10",
  //           "required" => "1",
  //           "sequence" => "1",
  //           "type"     => "INT"
  //        )
  //     )
  //   );
  global $sql_proc_attrs;
  
  // $procname是要呼叫的mysql procedure 名稱
  
  // 讀取全域陣列變數進來 $sql_proc_attrs
  // $values = Array() 存放的是欄位的內容
  //   '姓名' => '老王'
  //   '編號' => 12
  //   ...  
  
  // 規劃: 連線資料庫區段(這我要自己在寫一次)
  // 規劃: 檢查"必要"的引數
  // 規劃: 檢查長度
  // 規劃: 轉換型態，看要不要加引號
  // 規劃: 建立sql語法，別忘了要套上引數的順序
  // 規劃: 執行sql語法，要加上$result的判斷(如果是1，就不用在fetch_array)
  // 規劃: 把結果做成rows的陣列變數，並return
  
  // 檢查procname名稱是否存在
  if(array_key_exists($procname,$sql_proc_attrs) == false ){
    $message = '['.$procname.'] procedure name is not exist';
    //$db_errmsg = $message;
    $db_debugtxt[] = $message;
    return;
  }
  
  // debug
  // echo '<pre>';
  // print_r($sql_proc_attrs[$procname]);
  // echo '</pre>';
  
  if( count($sql_proc_attrs[$procname]) > 0 ){
    foreach($sql_proc_attrs[$procname] as $key => $val ){
      // 檢查必要引數
      if( $val["required"] == '1' ){
        if( $values[$key] == '' ){
          $message = '['.$procname.']'.' '.$key.'  is require field';
          //$db_errmsg = $message;
          $db_debugtxt[] = $message;
          return;      
        } /* if values */   
      } /* if required */
      // 準備好待回要排序的陣列變數
      $value_sequence[$key] = $val['sequence'];
    } /* foreach */
  } /* if count*/
  
  // 將陣列排序，以value為主
  asort($value_sequence);
  
  // debug
  // echo '<pre>';
  // print_r($value_sequence);
  // echo '</pre>';
  
  // 把變數值帶進來己排序好的地方
  if(count($values) > 0 ){
    foreach($value_sequence as $key => $val){
      $value_sequence[$key] = $values[$key];
    }/* foreach value_sequence */
  }
  
  // 檢查長度
  // 目前暫時不寫....
  
  // 重建sql語法
  $sql = 'call '.$procname.'(';
  if(count($value_sequence) > 0 ){
    foreach( $value_sequence as $fieldname => $fieldval ){
      switch ($sql_proc_attrs[$procname][$fieldname]["type"]) {
        case 'INT':
          if( $val != '' ){
            $sql .= $fieldval .', ';
          } else {
            $sql .= '\'\', ';
          }
          break;
        case 'VARCHAR':
          $sql .= '\'' . mysql_escape_string($fieldval) . '\', ';
          break;
        default:
          $sql .= '\'' . mysql_escape_string($fieldval) . '\', ';
          break;
      } /* switch */
    } /* foreach values */
    // 把最後面的逗點和空白刪掉
    $sql = substr($sql, 0, -2);
  } /* if count */  
  $sql .= ')';  
  
  return $sql;
  
} /* 函式結束 php_proc_parse */

?>
