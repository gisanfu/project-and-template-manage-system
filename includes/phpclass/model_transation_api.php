<?php

/*
 * update: 2009-03-27
 * author: gisanfu
 */

/*
 * 檔案命名說明
 * model，指的是MVC裡的M
 * 會寫這個class，主要以交易概念所衍生出來的，所以這樣取名子
 */
 
/*
 * 交易與關聯的關係:
 * 1筆交易，裡頭可以存放一個到多個的關聯
 * 只要其中1個sql語法有問題，或是關聯有問題
 * 整個交易就是算失敗
 */
 
/*
 * 把php_sql_transation_parse()的函式，也寫進來，跟這個class結合
 */
 
class model_transation_api {
        
  // 存放執行過的sql語法，這是debug可能會用到的
  // 存放執行過的sql語法，這是要關聯檢查用的，檢查完成就要清空
  public $is_relation_successed = '0'; // 存放關聯檢查後的狀態

  public $rollback_store = array(); // 存放要rollback的sql語法
  public $sql; // 存放所產生的sql語法
  public $is_sql_parse_successed = '0'; // 存放sql語法產生的狀態  
  // 定義sql欄位型態，哪些在insert、update動作中，是需要加上標點符號('')的，因為不知怎麼形容它
  // 定義所支援的幾個sql動作的名稱(const)

  // 定義MySQL的欄位型態，哪些欄位值是"不"需要加上單引號的
  private $mysql_field_noneed_sqm = array('int'=>'1','timestamp'=>'1','datetime'=>'1');
  
  private $rollback_temp   = array(); // 存放暫存的rollback的sql語法，等到被告知sql語法執行成功的時候，才會附加在rollback_store裡面
  private $relation_source = array(); // 存放關聯的陣列變數
  private $schema_source   = array(); // 存放資料庫結構的變數，結構簡示   tablename01 = array(fieldname01=>fieldtype01)
  
  /*
    定義insert供人取代的字串(%%key%%)名稱
   */
  private $insert_replace_string = array('field'=>'insert_id_fieldname','value'=>'insert_id');
  
  /* 建構式，要求使用者帶己定義好的關聯變數進來 */
  function __construct($arg_schema_source,$arg_relation_source){
    $this->relation_source = $arg_relation_source;
    $this->schema_source   = $arg_schema_source;
  } /* __construct */
  
  function __destruct(){
    // do nothing...
  } /* __destruct */
  
  function create_sql($arg_sql_element,$arg_transation_id,$arg_relation_id){
    // arg_sql_element   陣列變數，裡面存放table,condition,field,action元素
    // arg_transation_id 交易編號
    // arg_relation_id   關聯編號
    
    // 設為預設值的變數
    $this->is_sql_parse_successed = '0';
    $this->is_relation_successed = '0';
    
    // 把insert語法，先建立一部份(key)
    while (list($key,) = each($arg_sql_element['field'])) {
      $insert_keys .= $key . ', ';
    }
    // 去最後的逗點和空白
    $insert_keys = substr($insert_keys, 0, -2);
    
    $field = $arg_sql_element['field'];
    $table = $arg_sql_element['table'];
        
    // 把update和insert語法，先建立一部份
    while (list($key, $val) = each($field)) {
      if($this->mysql_field_noneed_sqm[$this->schema_source[$table][$key]] == '1'){
        if( $val != '' ){
          $insert_fields .= $val .', ';
          $update_fields .= $key . ' = ' . $val .', ';
        } else {
          $insert_fields .= '\'\', ';
          $update_fields .= $key . ' = \'\', ';
        }
      } else {
        $insert_fields .= '\'' . mysql_escape_string($val) . '\', ';
        $update_fields .= $key . ' = \'' . mysql_escape_string($val) . '\', ';
      }
    } /*while*/
    // 去最後的逗點和空白
    $insert_fields = substr($insert_fields, 0, -2);
    $update_fields = substr($update_fields, 0, -2);
    
    // 產出SQL語法的成品，不包含condition，供後續主要的區段程式使用
    $select_finished = 'select * from ' . $arg_sql_element['table'];
    $insert_finished = 'insert into ' . $arg_sql_element['table'] . ' ('. $insert_keys . ') values (' . $insert_fields . ')';
    $update_finished = 'update ' . $arg_sql_element['table'] . ' set '.$update_fields.' ';
    $delete_finished = 'delete from '.$arg_sql_element['table'];
    
    if ($arg_sql_element['action'] == 'insert') {
     
      $this->is_sql_parse_successed = '1';
      $this->sql = $insert_finished;
      //$rollback_temp[$arg_transation_id][] = ''; /* 因為insert不需要回復之前的準備語法 */
      $this->rollback_temp[$arg_transation_id][] = $delete_finished.' where %%'.$this->insert_replace_string['field'].'%%=%%'.$this->insert_replace_string['value'].'%%';
      
    } elseif ($arg_sql_element['action'] == 'update') {
      
      $condition = ' where ' . $arg_sql_element['condition'];
      
      if( $arg_sql_element['condition'] != '' ){
        $update_finished .= $condition;
        $select_finished .= $condition;
      } /*f_sql_parameters*/
      
      $this->is_sql_parse_successed = '1';
      $this->sql = $update_finished;
      $this->rollback_temp[$arg_transation_id][] = $select_finished;
      $this->rollback_temp[$arg_transation_id][] = $update_finished; /* rollback跟sql是一樣的 */
      
    } elseif($arg_sql_element['action'] == 'delete' ){

      $condition = ' where ' . $arg_sql_element['condition'];
      
      if( $f_sql_parameters != '' ){
        $select_finished .= $condition;
        $delete_finished .= $condition;
      } /*f_sql_parameters*/
      
      $this->is_sql_parse_successed = '1';
      $this->sql = $delete_finished;
      $this->rollback_temp[$arg_transation_id][] = $select_finished;
      $this->rollback_temp[$arg_transation_id][] = $insert_finished;
    
    } else {
      $this->is_sql_parse_successed = '0';
      $errormsg = 'action is not support =>'.$f_sql_action;
      $returnarray['error'] = $errormsg;
      exit;
    } /*f_sql_action*/
    
    // 把執行過的sql語法存到rollback_store
    $this->rollback_store[$arg_transation_id]['relation'][$arg_relation_id][] = $arg_sql_element;
    
  } /* create_sql */
  
  /*
   * 告知sql執行成功了，會把rollback語法倒進來
   * 引數要加上欄位，像是insert，要把後續insert_id和insert的primary欄位名稱帶進來
   */
  function sql_exec_successed($arg_transation_id,$arg_field){
    
    // 如果有帶這個引數，就會處理temp最後一筆，做取代的動作
    if($arg_field['fieldname']!=''){
      $count = count($this->rollback_temp[$arg_transation_id]);
      $this->rollback_temp[$arg_transation_id][($count-1)] = str_replace('%%'.$this->insert_replace_string["field"].'%%',$arg_field['fieldname'],$this->rollback_temp[$arg_transation_id][($count-1)]  );
      $this->rollback_temp[$arg_transation_id][($count-1)] = str_replace('%%'.$this->insert_replace_string["value"].'%%',$arg_field['fieldval'],$this->rollback_temp[$arg_transation_id][($count-1)]  );
    }
    
    // 把暫存的rollback，放進正式的rollback
    if(count($this->rollback_store[$arg_transation_id]['rollback'])<=0){
      $source_arr = array();
    } else {
      $source_arr = $this->rollback_store[$arg_transation_id]['rollback'];
    }
    $dest_arr = $this->rollback_temp[$arg_transation_id];
    $this->rollback_store[$arg_transation_id]['rollback'] = array_merge_recursive($source_arr,$dest_arr);
    
    // 在來是把temp給清空，等待下一次的rollback處理
    $this->rollback_temp = array();
    
  } /* sql_exec_successed */

  /* 
   * 檢查關聯
   */
  function check_relation($arg_transation_id,$arg_relation_id){
        
    // 預設值是成功
    $this->is_relation_successed = '1';
        
    $sqls_table = array();
    
    $sqls = $this->rollback_store[$arg_transation_id]['relation'][$arg_relation_id];
    
    // 把sql語法陣列，複製出來，用以下的架構來儲存
    // array( 
    //    tablename => array(
    //                    action => array(
    //                                 table     => XXX,
    //                                 action    => XXX,
    //                                 field     => ...,
    //                                 condition => ...
    //                                   )
    //                      )
    //     )
    if( count($sqls)>0 ){
      foreach($sqls as $sql_key => $sql_val){
        $sqls_table[$sql_val['table']][$sql_val['action']] = $sql_val;
      }
    } else {
      $sqls_table = array();
    }
    
    if( count($sqls)>0 ){
      foreach($sqls as $sql_key => $sql_val){
        $relation_check_source = $this->relation_source[$sql_val['table']];
        if( count($relation_check_source)>0 ){
          foreach($relation_check_source as $relation_key => $relation_val){
            if($sqls_table[$relation_val['table']][$relation_val['action']]['table'] == ''){
              // 只要關聯有缺少1個，整個關聯就算失敗
              $this->is_relation_successed = '0';
            }
          } /* relation_check */
        } /* 檢查relation_check_source是否有東西，有才會執行裡面的東西 */
      } /* sqls */
    } /* sqls陣列要有元素在裡面，才會執行這個迴圈 */
        
  } /* check_relation */
  
} /* model_transation_api */

?>