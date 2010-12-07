function GetProductData(cid,cname){

  var products_name = document.getElementById("products_name");
  var products_id = document.getElementById("products_id");
  products_name.value = cname;
  products_id.value = cid;

  DivViewControl('products_div01');
}

function GetProductDataFromSearch(cid,cname){

  var products_name = document.getElementById("products_name");
  var products_id = document.getElementById("products_id");
  products_name.value = cname;
  products_id.value = cid;   
  // 當使用者選擇了商品以後，就會關閉該即時搜尋的Div
  DivViewControl('products_div02');
}


