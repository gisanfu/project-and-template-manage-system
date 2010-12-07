#!/usr/bin/php
<?php
//echo '123';
require('model_transation_api.php');
require('sql_schemas.php');

$relation_var = array(
                  'weights' => array( array(
                                           'foreign' => 'xxx',      // 本資料表的欄位
                                           'primary' => 'xxx',      // 對應到目標資料表的欄位
                                           'table'   => 'capacitys',// 目標資料表的名稱
                                           'action'  => 'insert'    // 做了什麼sql的動作
                                           )
                                     )
                     );
                     
//print_r($relation_var);

$ss = new model_transation_api($sql_schemas,$relation_var);

// SQL語法01
$aa = array();
$aa['table'] = 'weights';
$aa['action'] = 'update';
$aa['condition'] = 'aa=3 and bb=4';
$aa['field'] = array('id'=>'123','name'=>'456');
$ss->create_sql($aa,'ggg','aaa');

if($ss->is_sql_parse_successed == '1'){
  echo $ss->sql."\n";
}
$insert_success = array();
$ss->sql_exec_successed('ggg',$insert_success);

// SQL語法02
$aa = array();
$aa['table'] = 'capacitys';
$aa['action'] = 'insert';
$aa['condition'] = '';
$aa['field'] = array('id'=>'123','name'=>'456');
$ss->create_sql($aa,'ggg','aaa');

if($ss->is_sql_parse_successed == '1'){
  echo $ss->sql."\n";
}
$insert_success = array('fieldname'=>'id','fieldval'=>'3');
$ss->sql_exec_successed('ggg',$insert_success);

//print_r($ss->rollback_store['ggg']);

$ss->check_relation('ggg','aaa');
echo 'relation check=>'.$ss->is_relation_successed."\n";

print_r($ss->rollback_store['ggg']['rollback']);

?>
