DROP PROCEDURE IF EXISTS %procedure_name%;
DELIMITER //
CREATE PROCEDURE %procedure_name%(
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