<?php
$sql_proc_attrs=array();
$sql_proc_attrs["sp_productlist_list"]=array();
$sql_proc_attrs["sp_productlist_list"]["f_version"]=array("name"=>"f_version","length"=>"20","required"=>"","sequence"=>"1","type"=>"VARCHAR");
$sql_proc_attrs["sp_productdetail_get"]=array();
$sql_proc_attrs["sp_productdetail_get"]["f_version"]=array("name"=>"f_version","length"=>"20","required"=>"","sequence"=>"1","type"=>"VARCHAR");
$sql_proc_attrs["sp_productdetail_get"]["f_product_id"]=array("name"=>"f_product_id","length"=>"5","required"=>"1","sequence"=>"2","type"=>"INT");
$sql_proc_attrs["sp_ordersuccess_insertorder"]=array();
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_version"]=array("name"=>"f_version","length"=>"20","required"=>"","sequence"=>"1","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_email"]=array("name"=>"f_email","length"=>"50","required"=>"1","sequence"=>"10","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_mobile"]=array("name"=>"f_mobile","length"=>"30","required"=>"1","sequence"=>"11","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_receiptstatus"]=array("name"=>"f_receiptstatus","length"=>"5","required"=>"0","sequence"=>"12","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_hn"]=array("name"=>"f_hn","length"=>"8","required"=>"1","sequence"=>"2","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_name"]=array("name"=>"f_name","length"=>"255","required"=>"1","sequence"=>"3","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_phone"]=array("name"=>"f_phone","length"=>"20","required"=>"1","sequence"=>"4","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_address"]=array("name"=>"f_address","length"=>"255","required"=>"1","sequence"=>"5","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_receipttype"]=array("name"=>"f_receipttype","length"=>"2","required"=>"1","sequence"=>"6","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_receiptname"]=array("name"=>"f_receiptname","length"=>"50","required"=>"0","sequence"=>"7","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_receipttaxid"]=array("name"=>"f_receipttaxid","length"=>"20","required"=>"0","sequence"=>"8","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorder"]["f_sex"]=array("name"=>"f_sex","length"=>"2","required"=>"0","sequence"=>"9","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorderitem"]=array();
$sql_proc_attrs["sp_ordersuccess_insertorderitem"]["f_version"]=array("name"=>"f_version","length"=>"20","required"=>"","sequence"=>"1","type"=>"VARCHAR");
$sql_proc_attrs["sp_ordersuccess_insertorderitem"]["f_order_id "]=array("name"=>"f_order_id ","length"=>"5","required"=>"1","sequence"=>"2","type"=>"INT");
$sql_proc_attrs["sp_ordersuccess_insertorderitem"]["f_product_id "]=array("name"=>"f_product_id ","length"=>"5","required"=>"1","sequence"=>"3","type"=>"INT");
$sql_proc_attrs["sp_ordersuccess_insertorderitem"]["f_quantity"]=array("name"=>"f_quantity","length"=>"5","required"=>"1","sequence"=>"4","type"=>"INT");
?>