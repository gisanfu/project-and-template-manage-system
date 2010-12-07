<?php
  // Debug 把所select到這一筆資料給列出來
  if( $debug == '1' ){
    $debuglines[] = '';
    if( count($rows) > 0 ){
      foreach($rows as $key => $val ){
        $debuglines[] = $key . ' => ' . $val;
      }
    } /*count*/
    $debuglines[] = '';
  }    
?>