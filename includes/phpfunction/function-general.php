<?php

//
// Update: 2008-03-11
// FileName: mainfile.php
// 這個檔案主要是要include function或class用的，function可以用分類的方式散佈在各個php檔案
//

/*
+------------+---------------------------------------+
|functionName|act_DbConnect                          |
+------------+---------------------------------------+
|description |connect database                       |
+------------+---------------------------------------+
*/
function act_DbConnect(){
        
    global $db_errmsg;
    global $db_debugtxt;
    
    ini_set('display_errors', '0');
    //error_reporting(E_ALL);
    
    $link = mysql_connect( _DB_HOST, _DB_USER, _DB_PASS) or $status='error';
    if( $status == 'error' ){
      echo '資料庫連線錯誤<br>';
      exit;
    }

    mysql_query("set names utf8");
    
    //return $link;

    mysql_select_db( _DB_NAME, $link);
}/*act_DbConnect*/

/*
+------------+---------------------------------------+
|functionName|act_DbDisconnect                       |
+------------+---------------------------------------+
|description |disconnect database                    |
+------------+---------------------------------------+
*/
function act_DbDisconnect(){
    //mysql_free_result($result); 
    //mysql_close($link);
}/*act_DbDisconnect*/

//逐字轉換utf8字串為big5
function utf8_2_big5($utf8_str) {
      $i=0;
      $len = strlen($utf8_str);
      $big5_str="";
      for ($i=0;$i<$len;$i++) {
            $sbit = ord(substr($utf8_str,$i,1));
            if ($sbit < 128) {
                $big5_str.=substr($utf8_str,$i,1);
            } else if($sbit > 191 && $sbit < 224) {
                $new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,2));
                $big5_str.=($new_word=="")?"■":$new_word;
                $i++;
            } else if($sbit > 223 && $sbit < 240) {
                $new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,3));
                $big5_str.=($new_word=="")?"■":$new_word;
                $i+=2;
            } else if($sbit > 239 && $sbit < 248) {
                $new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,4));
                $big5_str.=($new_word=="")?"■":$new_word;
                $i+=3;
            }
      }
      return $big5_str;
} /*utf8_2_big5*/

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
function db_getrowstable($tablename){
        
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
