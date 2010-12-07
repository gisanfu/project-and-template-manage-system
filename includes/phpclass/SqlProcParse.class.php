<?php

/*
 * 使用方式
 * include('SqlProcParse.class.php');
 * $sql_array['f_version'] = '2';
 * $sql_array['f_product_id'] = '3';
 * $aaa = new SqlProcParse('sp_productdetail_get',$sql_array);
 * print_r($aaa->debuglines);
 * echo $aaa->error."\r\n";
 * echo $aaa->sql."\r\n";
 */

/*
 * update: 2009-01-22
 * 把引數轉換成完整procedure的API
 */
class SqlProcParse {
        
  // 設定Public存取控制的變數
  public $debuglines;
  public $errmsg;
  public $procname;
  public $values;
  public $sql;
  public $value_sequence;
        
  function __construct($procname, $values){
    
    $this->debuglines = array();
    $this->error = $errmsg;
    $this->sql = $sql;
    
    /*
      $attrs = Array() 存放的是程序的欄位相關屬性
      $attrs = 
        array(
          "procedure名稱" => array(
             "argname01" => array(
                "name"     => "argname01",
                "length"   => "10",
                "required" => "1",
                "sequence" => "1",
                "type"     => "INT"
             )
          )
        );
    */
    require_once('sql_proc_attrs.php');
    
    // 檢查procname名稱是否存在
    if(array_key_exists($procname,$sql_proc_attrs) == false ){
      $this->error = '['.$procname.'] procedure name is not exist';
    } else {
      array_push($this->debuglines,'procedure name check is pass');
    }
    
    if( count($sql_proc_attrs[$procname]) > 0 ){
      foreach($sql_proc_attrs[$procname] as $key => $val ){
        // 檢查必要引數
        if( $val["required"] == '1' ){
          if( $values[$key] == '' ){
            $this->error = '['.$procname.']'.' '.$key.'  is require field';
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
    
    $this->sql = $sql;
    
  } /* __construct */
  
  function __destruct(){
    // do nothing...
  } /* __destruct */
} /* SqlProcParse */

?>