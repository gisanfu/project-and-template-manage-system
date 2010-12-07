<?php

/*
 * update: 2009-01-16
 */
function php_mysql_disconnect($result,$link){
        
    // 一般有select的狀況下是$result = Resource id #30
    // 如果是delete或是update，$result = 1
    if( strlen($result) > 1 ){       
        mysql_free_result($result);
    }

    // 一般如果$link有值，都會是Resource id #30
    // 如果沒有link的話，就是null
    if( !is_null($link) ){
      mysql_close($link);
    }
} /* 函式 act_DbDisconnect */


/*
 * update: 2009-01-16
 * 連線資料庫
*/
function php_mysql_connect(){

    global $db_errmsg;
    global $db_debugtxt;

    ini_set('display_errors', '0');
    //error_reporting(E_ALL);

    $link = mysql_connect( _DB_HOST.(_DB_PORT=='')? ':3306':':'._DB_PORT
                         , _DB_USER
                         , _DB_PASS
                         ) or $status='error';
    if( $status == 'error' ){
      echo '系統維護中<br>';
      exit;
    }

    mysql_query("set names utf8");

    //return $link;

    mysql_select_db( _DB_NAME, $link);

} /* php_mysql_connect */

/*
 * update: 2009-01-16
 */
function php_mysqli_connect(){
    global $db_errmsg;
    //global $db_debugtxt;
    
    ini_set('display_errors', '0');
    //error_reporting(E_ALL);
    
    $link = mysqli_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status='error';
    if( $status == 'error' ){
      $db_errmsg =  'mysqli connect fail';
      exit;
    }
    mysqli_query($link,"set names utf8");
    mysqli_select_db($link,_DB_NAME);    
    return $link;    
} /* php_mysqli_connect */

/*
 * update: 2009-01-16
 */
function php_mysqli_disconnect($link){
  $link->close;
} /* php_mysqli_disconnect */

/*
 * update: 2008-1-21
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
  //echo '<pre>';
  //print_r($value_sequence);
  //echo '</pre>';
  
  // 把變數值帶進來己排序好的陣列裡面
  if(count($values) > 0 ){
    foreach($value_sequence as $key => $val){
      $value_sequence[$key] = $values[$key];
    }/* foreach value_sequence */
  } else {
    // 當呼叫此程序，沒有帶引數的情況，就會跑到這裡
    foreach($value_sequence as $key => $val){
      $value_sequence[$key] = '';
    }/* foreach value_sequence */      
  } /* count */
  
  // 檢查長度
  // 目前暫時不寫....
  
  // 重建sql語法
  $sql = 'call '.$procname.'(';
  if(count($value_sequence) > 0 ){
    foreach( $value_sequence as $fieldname => $fieldval ){
      switch ($sql_proc_attrs[$procname][$fieldname]["type"]) {
        case 'INT':
          if( $fieldval != '' ){
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

/*
  取得資料表的所有資料
  只做單純的select * from table而以
  然後return陣列
  這個函式只單純做這件事情而以
  
  IDEA:
  這些idea，未來可以寫新的函式，不要在改這個函式了
  因為很多地方會需要一起改
  1.加上引數id，讓他可以搜尋單一編號的欄位
  2.加上引數，抓幾筆(limit)
  3.加上引數，抓哪一筆(where id=)
  4.加上引數，抓數量
*/
function php_getrowstable($tablename){
        
    global $db_errmsg;
    global $db_debugtxt;
    
    $db_debugtxt = array();
        
    act_DbConnect();
    
    $sql = 'select * from '.$tablename;
    $db_debugtxt[] = $sql;
    $result = mysql_query($sql) or $status = 'error';
    if( $status == 'error' ){
      $errmsg = mysql_error(); 
      return;
    }
    $row  = array();
    $rows = array();
    while( $row = mysql_fetch_array($result,MYSQL_ASSOC) ){
      $rows[] = $row;   
    }
    if( (count($rows) > 0) and is_array($rows) ){
      foreach($rows as $key => $val){
        $db_debugtxt[] = $key.' =>'.$val;
      }
    }
    
    act_DbDisconnect($result,$link);
    
    return $rows;   
    
} /*db_getrowstable*/


?>