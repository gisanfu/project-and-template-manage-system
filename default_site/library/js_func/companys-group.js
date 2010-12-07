/*
  update: 2008-12-05
  這裡是商品原價和特價所共用的總公司和分店function
*/


/*
  總公司用的
*/
function GetCompanyData(cid,cname){
  // 當使用者選擇了總公司以後，就會關閉該下拉式的Div
  DivViewControl('companys_group_div01');  
  // 當總公司欄位確定了以後，連帶的會一起更新分公司的下拉式選單
  xajax_Update_Companys_Select(cid,cname);
} // end function GetCategoryData

function GetCompanyDataFromSearch(cid,cname){
  // 把所選擇的資料帶進來
  var companys_group_name = document.getElementById("companys_group_name");
  var companys_group_id = document.getElementById("companys_group_id");
  companys_group_name.value = cname;
  companys_group_id.value = cid;   
  // 當使用者選擇了總公司以後，就會關閉該下拉式的Div
  DivViewControl('companys_group_div02');
  // 當總公司欄位確定了以後，連帶的會一起更新分公司的下拉式選單
  xajax_Update_Companys_Select(cid,cname);
} // end function GetCategoryData

/*
  分店用的
*/
function SyncCompanyData(cid,cname){
  // 把所選擇的資料帶進來
  var companys_name = document.getElementById("companys_name");
  var companys_id = document.getElementById("companys_id");
  companys_name.value = cname;
  companys_id.value = cid;
 // 當使用者選擇了分店以後，就會關閉即時搜尋的Div
  DivViewControl('companys_div01');
}

function SyncCompanyDataFromSearch(cid,cname){
  // 把所選擇的資料帶進來
  var companys_name = document.getElementById("companys_name");
  var companys_id = document.getElementById("companys_id");
  companys_name.value = cname;
  companys_id.value = cid;
 // 當使用者選擇了分店以後，就會關閉即時搜尋的Div
  DivViewControl('companys_div02');
}