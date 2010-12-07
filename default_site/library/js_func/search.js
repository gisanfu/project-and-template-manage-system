YAHOO.example.search01 = function() {
    <{* 因為yahoo ui預設會送?query引數
      * 所以在php看到的會是$_GET["?query"]，要注意
      *}>
    var oDS = new YAHOO.util.XHRDataSource("search-engine.php?hidop=searchproducts&");
    <{* Set the responseType *}>
    oDS.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
    
    <{* 以tab做為分欄的訊號 *}>
    oDS.responseSchema = {
        recordDelim: "\n",
        fieldDelim: "\t"
    };
    <{* Enable caching *}>
    oDS.maxCacheEntries = 5;

    <{* Instantiate the AutoComplete *}>
    var oAC = new YAHOO.widget.AutoComplete("products_div02_input", "products_div02_container", oDS);
    oAC.resultTypeList = false;
    
    <{* Define an event handler to populate a hidden form field
      * when an item gets selected
      * var myHiddenField = YAHOO.util.Dom.get("products_div02_hidden");
      *}>
    
    var myHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // reference to the selected LI element

        <{* 0是第1欄(名稱),1是第2欄(編號) *}>        
        <{* 我自己寫的，當使用者一選，就會直接把值帶入確認的欄位 *}>
        GetProductDataFromSearch(oData[1],oData[0]);
    };
    oAC.itemSelectEvent.subscribe(myHandler);
    
    return {
        oDS: oDS,
        oAC: oAC
    };
}();

YAHOO.example.search02 = function() {
    var oDS = new YAHOO.util.XHRDataSource("search-engine.php?hidop=searchcompanysgroup&");

    oDS.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
    
    oDS.responseSchema = {
        recordDelim: "\n",
        fieldDelim: "\t"
    };

    oDS.maxCacheEntries = 5;

    var oAC = new YAHOO.widget.AutoComplete("companys_group_div02_input", "companys_group_div02_container", oDS);
    oAC.resultTypeList = false;
    
    var myHandler = function(sType, aArgs) {
        var oData = aArgs[2]; // reference to the selected LI element
        
        GetCompanyDataFromSearch(oData[1],oData[0]);
    };
    oAC.itemSelectEvent.subscribe(myHandler);

    return {
        oDS: oDS,
        oAC: oAC
    };
}();
