--
-- drupaladmin 資料庫
-- Stored Procedure And Trigger
-- 開發的目的: 讓14ch(阿信)可以使用我的drupaladmin資料庫，透過procedure使用
-- 2008-12-25
--

-- 
-- 程序名稱: proc_httpaddress_get
-- 程序說明: 把社區編號和網址抓出來
-- 使用方式:
--   call proc_httpaddress_get(
--     id int(5), 如果有指定社區編號，就會搜尋指定的ID欄位
--   )
-- 使用說明: none

-- 返回結果
-- +-----+--------------------------------+
-- | id  | httpaddress                    |
-- +-----+--------------------------------+
-- | 119 | community0003.readytech.com.tw | 
-- | 123 | community0004.readytech.com.tw | 
-- | 172 | community0002.readytech.com.tw | 
-- | 137 | community0001.readytech.com.tw | 
-- +-----+--------------------------------+
    
DROP PROCEDURE IF EXISTS proc_httpaddress_get;
DELIMITER //
CREATE PROCEDURE proc_httpaddress_get(
    in arg_id int(10)
  ) 
  exit1: BEGIN
    declare statuscode int(1) default 0;
    
    if isnull(arg_id) then
      select 
        c.server_cus_id as id,
        concat(r.domain,'\.',z.domain) as httpaddress
      from community as c
      left join vh as v on c.vh_id = v.id
      left join records as r on v.records_id=r.id
      left join zones as z on r.zone=z.id
      where 
        r.type='A';
    elseif not(isnull(arg_id)) then    
      select 
        c.server_cus_id as id,
        concat(r.domain,'\.',z.domain) as httpaddress
      from community as c
      left join vh as v on c.vh_id = v.id
      left join records as r on v.records_id=r.id
      left join zones as z on r.zone=z.id
      where 
        r.type='A'
      and
        c.server_cus_id=arg_id;
    else
      set statuscode=1;
      select statuscode;
      leave exit1;
    end if;
    
  END
//
DELIMITER ;

-- 測試:
--  show出所有的網址資料
--   call proc_httpaddress_get(null);
--
--  以社區編號來搜尋網址資料
--   call proc_httpaddress_get(136);