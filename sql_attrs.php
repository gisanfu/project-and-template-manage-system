<?php
$sql_attrs=array();
$sql_attrs["t_argument"]=array("id"=>"int","project_id"=>"int","procedure_id"=>"int","name"=>"str","description"=>"str","type_id"=>"int","length"=>"str","required"=>"str","sequence"=>"str","enable"=>"str");
$sql_attrs["t_argument_type"]=array("id"=>"int","name"=>"str");
$sql_attrs["t_block"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","tplbody"=>"str","headbody"=>"str","tplname"=>"str","headname"=>"str","enable"=>"str");
$sql_attrs["t_block_example"]=array("id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","tplbody"=>"str","headbody"=>"str","tplname"=>"str","headname"=>"str","enable"=>"str");
$sql_attrs["t_code"]=array("id"=>"int","language_id"=>"int","alias"=>"str","codebody"=>"str","description"=>"str");
$sql_attrs["t_controller"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","enable"=>"str");
$sql_attrs["t_controller_example"]=array("id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","enable"=>"str");
$sql_attrs["t_controller_signal"]=array("id"=>"int","controller_id"=>"int","signal_id"=>"int");
$sql_attrs["t_install_script"]=array("id"=>"int","path"=>"str","description"=>"str","txtbody"=>"str","update"=>"int");
$sql_attrs["t_language"]=array("id"=>"int","alias"=>"str","name"=>"str","fileexten"=>"str");
$sql_attrs["t_librarycategory"]=array("id"=>"int","name"=>"str");
$sql_attrs["t_librarydir"]=array("id"=>"int","name"=>"str");
$sql_attrs["t_libraryfile"]=array("id"=>"int","language_id"=>"int","librarycategory_id"=>"int","librarydir_id"=>"int","name"=>"str","description"=>"str");
$sql_attrs["t_libraryfile_item"]=array("id"=>"int","libraryfile_id"=>"int","libraryitem_id"=>"int");
$sql_attrs["t_libraryitem"]=array("id"=>"int","language_id"=>"int","name"=>"str","bodytext"=>"str","description"=>"str","synopsis"=>"str");
$sql_attrs["t_package"]=array("id"=>"int","package_company_id"=>"int","alias"=>"str","name"=>"str","unzip"=>"str","downloadlink"=>"str");
$sql_attrs["t_package_company"]=array("id"=>"int","name"=>"str","homepage"=>"str");
$sql_attrs["t_page"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","tplbody"=>"str","tplname"=>"str","enable"=>"str");
$sql_attrs["t_page_block"]=array("id"=>"int","page_id"=>"int","block_id"=>"int");
$sql_attrs["t_page_example"]=array("id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","tplbody"=>"str","tplname"=>"str","enable"=>"str");
$sql_attrs["t_procedure"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str","beginbody"=>"str","version"=>"str","enable"=>"str");
$sql_attrs["t_procedure_example"]=array("id"=>"int","name"=>"str","description"=>"str","beginbody"=>"str","enable"=>"str");
$sql_attrs["t_project"]=array("id"=>"int","theme_id"=>"int","name"=>"str","exportdir"=>"str","httpaddress"=>"str","description"=>"str");
$sql_attrs["t_project_db"]=array("id"=>"int","project_id"=>"int","alias"=>"str","host"=>"str","port"=>"str","user"=>"str","pass"=>"str","dbname"=>"str");
$sql_attrs["t_project_libraryfile"]=array("id"=>"int","project_id"=>"int","libraryfile_id"=>"int");
$sql_attrs["t_signal"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","page_id"=>"str","enable"=>"str");
$sql_attrs["t_signal_example"]=array("id"=>"int","name"=>"str","description"=>"str","phpbody"=>"str","enable"=>"str");
$sql_attrs["t_tablename"]=array("id"=>"int","project_id"=>"int","alias"=>"str","name"=>"str");
$sql_attrs["t_theme"]=array("id"=>"int","project_id"=>"int","name"=>"str","description"=>"str");
?>