<?php

include_once('config.php');
include_once('exportdir/test44/sql_proc_attrs.php');

$sql_values['pass']='testpass';
$sql_values['name']='testname';
$sql_values['enable']='testenable';

$rows = php_callproc('sp_testccc',$sql_values);
foreach( $db_debugtxt as $key => $val ){
  echo $val.'<br>';
}

?>