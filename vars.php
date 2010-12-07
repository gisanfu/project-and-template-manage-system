<?php
    //session_start();
    //define('__SITE_ROOT', 'D:/project/gisanfu/web/develop_platform'); //$_SERVER['DOCUMENT_ROOT']);
    define('__SITE_ROOT', '/home/gisanfu/project/2009/gisanfu/web/develop_platform'); //$_SERVER['DOCUMENT_ROOT']);
    
    $debuglines = array();
    
    // define variable
    $debug = 0;
    
    if($debug == '1'){
      ini_set('display_errors', '1');
      error_reporting(E_ALL);   
    }

    // mysql
    define('_DB_TYPE', 'mysql');
    define('_DB_NAME', 'develop_platform');
    define('_DB_HOST', 'localhost');
    define('_DB_USER', 'root');
    define('_DB_PASS', 'your_password');
    
    // 分頁
    define('_SPLITPAGE_TOTAL_RECORDS', 10); //資料總數
    
    // 寫入或更新資料表內容，所需要參考的檔案，放置的是欄位型態
    define('_SQL_ATTR_FILE', 'sql_attrs.php');
    
    // 使用model_transation_api class 所需要的檔案
    define('_SQL_SCHEMA_FILE', 'sql_schemas.php');
    
    // 定義資料表的名稱
    // 如果資料表有更動
    // 只要修改這裡就可以了
    // 這裡的排列順序是依照資料表的英文名稱
    define('_TABLE_PROJECT','t_project');
    define('_TABLE_PROJECT_DB','t_project_db');
    define('_TABLE_PROCEDURE','t_procedure');
    define('_TABLE_ARGUMENT','t_argument');
    define('_TABLE_ARGUMENT_TYPE','t_argument_type');
    define('_TABLE_TABLENAME','t_tablename');
    define('_TABLE_CODE','t_code');
    define('_TABLE_LANGUAGE','t_language');    
    define('_TABLE_BLOCK','t_block');
    define('_TABLE_PAGE','t_page');
    define('_TABLE_PAGE_BLOCK','t_page_block');
    define('_TABLE_SIGNAL','t_signal');
    define('_TABLE_CONTROLLER','t_controller');
    define('_TABLE_CONTROLLER_SIGNAL','t_controller_signal');
    define('_TABLE_THEME','t_theme');
    define('_TABLE_PROCEDURE_EXAMPLE','t_procedure_example');
    define('_TABLE_BLOCK_EXAMPLE','t_block_example');
    define('_TABLE_PAGE_EXAMPLE','t_page_example');
    define('_TABLE_SIGNAL_EXAMPLE','t_signal_example');
    define('_TABLE_CONTROLLER_EXAMPLE','t_controller_example');
    
    define('_TABLE_LIBRARY_CATEGORY','t_librarycategory');
    define('_TABLE_LIBRARY_SUBDIR','t_librarydir');
    define('_TABLE_LIBRARY_FILE','t_libraryfile');
    define('_TABLE_LIBRARY_FILE_ITEM','t_libraryfile_item');
    define('_TABLE_LIBRARY_ITEM','t_libraryitem');
    define('_TABLE_PROJECT_FILE','t_project_libraryfile');
    
    define('_TABLE_INSTALL_SCRIPT','t_install_script');
    define('_TABLE_PACKAGE_COMPANY','t_package_company');
    define('_TABLE_PACKAGE','t_package');
    define('_TABLE_INSTALLSCRIPT_PACKAGE','t_installscript_package');
    
    // 定義專案內，網頁的各個資料夾的常數
    define('_PROJECT_IMAGE','image/');
    define('_PROJECT_TEMP','temp/');
    define('_PROJECT_CONFIG','config/');
    define('_PROJECT_CONTROLLER','controller/');
    define('_PROJECT_LIBRARY','library/');
    define('_PROJECT_VIEW','view/');
    define('_PROJECT_SMARTY','smarty/');
    //define('_PROJECT_THEME','theme/');
    define('_PROJECT_DEVEL','_devel/');
    
    require('includes/xajax/xajax.inc.php');
    
    include_once("smarty/libs/Smarty.class.php");
    $smarty = new Smarty();
    //echo __SITE_ROOT.'<br>';
    $siteroot = __SITE_ROOT;
    $smarty->template_dir = $siteroot . "/view";
    $smarty->compile_dir  = $siteroot . "/temp/templates_c/";
    $smarty->cache_dir    = $siteroot . "/temp/cache/";
    $smarty->config_dir   = $siteroot . "/smarty/configs/";    
    $smarty->left_delimiter  = '<{';
    $smarty->right_delimiter = '}>';
    
?>
