<?php
class SplitPage {
  var $records_per_page;  // 顯示筆數
  var $page;              // 目前所在頁數 
  var $total_records;     // 資料總數
  var $total_pages;       // 總分頁數
  var $started_record;
  var $listPage;
  var $startPage;
  var $endPage;
  var $viewlist;

  function SplitPage($page, $total_records, $records_per_page, $listPage) { //物件建構
    $this->records_per_page = $records_per_page;
    $this->page                      = $page;
    $this->total_records         = $total_records;
    $this->listPage                 = $listPage;
    $this->setALL();
  }

  function setALL() {  //設定類別參數
    $this->total_pages      = ceil($this->total_records / $this->records_per_page);
    $this->started_record = $this->records_per_page * ($this->page-1);
    if($this->listPage < $this->total_pages) {
      if($this->page % $this->listPage == 0)
        $this->startPage = $this->page - $this->listPage + 1;
      else
        $this->startPage = $this->page - $this->page % $this->listPage + 1;

      if(($this->startPage + $this->listPage) > $this->total_pages)
        $this->endPage = $this->total_pages;
      else
        $this->endPage = ($this->startPage + $this->listPage - 1);
    }
    else {
      $this->startPage = 1;
      $this->endPage = $this->total_pages;
    }
  }

  function setViewList($url, $target = false) {  //產生導覽列
    if($target) $temp_target = " target='{$target}'";
    $this->viewlist = '';
    if($this->total_pages > 1) {
      if(($this->page - 1) != 0) {
        $this->viewlist .= "<a href='{$url}page=" . ($this->page - 1) ."'{$target}>prev</a> ";
        if($this->total_pages > $this->listPage)
          if(($this->startPage - $this->listPage) >= 1 and $this->page > $this->listPage) {
            $this->viewlist .= "<a href='{$url}page=1'{$target}>&lt;&lt;</a> ";
            $this->viewlist .= "<a href='{$url}page=" . ($this->startPage - $this->listPage) . "'{$target}>&lt;..</a> ";
          }
      }

      for($i = $this->startPage; $i <= $this->endPage; $i++)
        if($i != $this->page)
          $this->viewlist .= "<a href='{$url}page={$i}'{$target}>{$i}</a> ";
        else
          $this->viewlist .= "<b>{$i}</b> ";

      if(($this->page + 1) <= $this->total_pages) {
        if(($this->total_pages > $this->listPage) and ($this->endPage != $this->total_pages)){
          $this->viewlist .= "<a href='{$url}page=" . ($this->endPage + 1) . "'{$target}>..&gt;</a> ";
          $this->viewlist .= "<a href='{$url}page={$this->total_pages}'{$target}>&gt;&gt;</a> ";
        }
        $this->viewlist .= "<a href='{$url}page=" . ($this->page + 1) . "'{$target}>next</a>";
      }
    }
  }
}
