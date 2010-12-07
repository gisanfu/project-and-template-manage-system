/*
  update: 2008-12-05
  這裡是用在商品的特價細項頁面
  指定特價日期的form要如何動作
*/
YAHOO.util.Event.onDOMReady(function(){

    var dialog1, calendar1;
    var dialog2, calendar2;

    calendar1 = new YAHOO.widget.Calendar("cal01", {
        iframe:false,          // Turn iframe off, since container has iframe support.
        hide_blank_weeks:true  // Enable, to demonstrate how we handle changing height, using changeContent
    });
    
    calendar2 = new YAHOO.widget.Calendar("cal02", {
        iframe:false,          // Turn iframe off, since container has iframe support.
        hide_blank_weeks:true  // Enable, to demonstrate how we handle changing height, using changeContent
    });

    function okHandler1() {
        if (calendar1.getSelectedDates().length > 0) {

            var selDate = calendar1.getSelectedDates()[0];

            var dStr = selDate.getDate();
            var mStr = selDate.getMonth() + 1;
            var yStr = selDate.getFullYear();

            // example: 2008-10-18
            YAHOO.util.Dom.get("date1").value = yStr + "-" + mStr + "-" + dStr;
        } else {
            YAHOO.util.Dom.get("date1").value = "";
        }
        this.hide();
    }
    
    function okHandler2() {
        if (calendar2.getSelectedDates().length > 0) {

            var selDate = calendar2.getSelectedDates()[0];

            var dStr = selDate.getDate();
            var mStr = selDate.getMonth() + 1;
            var yStr = selDate.getFullYear();

            // example: 2008-10-18
            YAHOO.util.Dom.get("date2").value = yStr + "-" + mStr + "-" + dStr;
        } else {
            YAHOO.util.Dom.get("date2").value = "";
        }
        this.hide();
    }
    
    function cancelHandler1() {
        this.hide();
    }
    
    function cancelHandler2() {
        this.hide();
    }
    
    dialog1 = new YAHOO.widget.Dialog("container1", {
        context:["show", "tl", "bl"],
        buttons:[ {text:"選擇", isDefault:true, handler: okHandler1}, 
                  {text:"取消", handler: cancelHandler1}],
        width:"16em",  // Sam Skin dialog needs to have a width defined (7*2em + 2*1em = 16em).
        draggable:true,
        close:true
    });
    
    dialog2 = new YAHOO.widget.Dialog("container2", {
        context:["show", "tl", "bl"],
        buttons:[ {text:"選擇", isDefault:true, handler: okHandler2}, 
                  {text:"取消", handler: cancelHandler2}],
        width:"16em",  // Sam Skin dialog needs to have a width defined (7*2em + 2*1em = 16em).
        draggable:true,
        close:true
    });
    
    calendar1.render();
    dialog1.render();
    
    calendar2.render();
    dialog2.render();

    // Using dialog.hide() instead of visible:false is a workaround for an IE6/7 container known issue with border-collapse:collapse.
    dialog1.hide();
    dialog2.hide();

    calendar1.renderEvent.subscribe(function() {
        // Tell Dialog it's contents have changed, Currently used by container for IE6/Safari2 to sync underlay size
        dialog1.fireEvent("changeContent");
    });
    
    calendar2.renderEvent.subscribe(function() {
        // Tell Dialog it's contents have changed, Currently used by container for IE6/Safari2 to sync underlay size
        dialog2.fireEvent("changeContent");
    });

   YAHOO.util.Event.on("show1", "click", function() {
	dialog1.show();
	if (YAHOO.env.ua.opera && document.documentElement) {
		// Opera needs to force a repaint
		document.documentElement.className += "";
	} 
});

       YAHOO.util.Event.on("show2", "click", function() {
	dialog2.show();
	if (YAHOO.env.ua.opera && document.documentElement) {
		// Opera needs to force a repaint
		document.documentElement.className += "";
	} 
});

   });