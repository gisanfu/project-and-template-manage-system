<?php
include('SqlProcParse.class.php');
//sp_productlist_list
//sp_productdetail_get
$sql_array['f_version'] = '2';
//$sql_array['f_product_id'] = '3';
$aaa = new SqlProcParse('sp_productdetail_get',$sql_array);
print_r($aaa->debuglines);
echo $aaa->error."\r\n";
echo $aaa->sql."\r\n";

?>
