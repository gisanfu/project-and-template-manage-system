<?php /* Smarty version 2.6.22, created on 2009-02-08 09:08:21
         compiled from search/list.tpl.htm */ ?>
<form id="form1" name="form1" method="post" action="<?php echo $this->_tpl_vars['targetpost']; ?>
">

    在此填入你想要搜尋的程式碼別名關鍵字:<br>
  <input type="text" id="searchcode_fd_input" name="searchcode_fd_input" autocomplete="off" size="30"class="yui-skin-sam"/>
  <div id="searchcode_autocomplete_container" align="left" class="yui-skin-sam"></div>
  
  <br>
  
  以下是搜尋的結果:<br>
  <table cellspacing="0" border="1">
    <tr>
      <td>程式碼別名</td>
      <td><input id="alias" type="text" readonly /></td>
    </tr>
    <tr>
      <td>程式語言</td>
      <td><input id="language_name" type="text" readonly/></td>
    </tr>
    <tr>
      <td>描述</td>
      <td><input id="description" type="text" readonly/></td>
    </tr>
    <tr>
      <td>程式碼內容</td>
      <td><textarea id="codebody" cols="40" rows="30" readonly></textarea></td>
    </tr>
  </table>
</form>
  
<script type="text/javascript">  
YAHOO.example.searchcodes = function() {
        var oDS = new YAHOO.util.XHRDataSource("search-engine.php?hidop=searchcodes");
        oDS.responseType = YAHOO.util.XHRDataSource.TYPE_TEXT;
    
        oDS.responseSchema = {
        recordDelim: "\n",
        fieldDelim: "\t"
    };
        
        var oAC = new YAHOO.widget.AutoComplete("searchcode_fd_input", "searchcode_autocomplete_container", oDS);
    oAC.resultTypeList = false;
    
        oAC.generateRequest = function(sQuery) { 
      return "&query=" + sQuery ; 
    }; 
    
    var myHandler = function(sType, aArgs) {
        var oData = aArgs[2];
        
                //xajax_ajax_searchengine_debug(oData[2]);
        
                xajax_ajax_code_update(oData[1]);
                
    };     
    oAC.itemSelectEvent.subscribe(myHandler);

    return {
        oDS: oDS,
        oAC: oAC
    };
}();
</script>