<?php
    //session_start();
    include_once('siteroot.php');
    
    $debuglines = array();
    
    // define variable
    $debug = 1;
    
    if( $debug == '1' ){
      //ini_set('display_errors', '1');
      //error_reporting(E_ALL);   
    }

    // mysql
    include_once('sql_connect.php');
    
    // 分頁
    define('_SPLITPAGE_TOTAL_RECORDS', 10); //資料總數
    
    // 寫入或更新資料表內容，所需要參考的檔案，放置的是欄位型態
    include_once('sql_attrs.php');
    
    // 這裡有要用到procedure才需要開啟
    include_once('sql_proc_attrs.php');
    
    // 定義資料表的名稱
    // 如果資料表有更動
    // 只要修改這裡就可以了
    // 這裡的排列順序是依照資料表的英文名稱
    include_once('sql_tablealias.php');
    
    // 把Theme的路徑名稱給載入
    include_once('theme.php');
    
    require('includes/xajax/xajax.inc.php');
    
    // 因為經我測試後，發現後面結尾是不用加斜線的
    if( _THEME_NAME != '' ){
      $template_dir = __SITE_ROOT . '/view/' . _THEME_NAME;
    } else {
      $template_dir = __SITE_ROOT . '/view';
    }
    
    include_once("smarty/libs/Smarty.class.php");
    $smarty = new Smarty();
    $smarty->template_dir = $template_dir;
    $smarty->compile_dir  = __SITE_ROOT . '/temp/templates_c/' . _THEME_NAME . '/';
    $smarty->config_dir   = __SITE_ROOT . '/smarty/configs/';
    $smarty->cache_dir    = __SITE_ROOT . '/smarty/cache/';
    $smarty->left_delimiter  = '<{';
    $smarty->right_delimiter = '}>';
    
?>
