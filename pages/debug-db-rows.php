<?php

  /*
   * update: 2008-12-17
   * 這支程式負責把資料庫搜尋後的結果給print出來
   * 並支援smarty,xajax的方式
   */
   
  // 因為xajax是函式，所以需要這一行來取得debug的變數
  if( $debugtype == 'xajax' ) global $debug;

  if( $debug == '1' ){
        
    $debugvar = array();
        
    // 看看要debug哪一個變數
    if( count($rows) <= 0 ){
      $debugvar = $row;
    } else {
      $debugvar = $rows;
    }/*count rows*/
    
    // Smarty
    if( ($debugtype == 'smarty') or ($debugtype == '') ){
      // Debug 把所select到這一筆資料給列出來   
      $debuglines[] = '';
      if( (count($debugvar) > 0) and is_array($debugvar) ){
        foreach($debugvar as $key => $val ){
          $debuglines[] = $key . ' => ' . $val;
        }
        $debuglines[] = '';
      }/*is_array*/
      
    // XAJAX
    } elseif( $debugtype == 'xajax' ){
      if( (count($debugvar) > 0) and is_array($debugvar) ){
        foreach($debugvar as $key => $val ){
          $debugret .= $key.' => '.$val.'<br>';
        }
      } else {
        $debugret = 'no debug line<br>';
      }/*count debugvar*/
      $objResponse->append('debugdiv', 'innerHTML', $debugret);
    }/*debugtype*/
  }/*debug*/
?>