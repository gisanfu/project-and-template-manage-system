// 
var cursPos; // 窗口全局变量，保存目标 TextBox 的最后一次活动光标位置

// 我自己重寫的
function js_insert_text(arg_areatext_name,arg_inserttext){
    var obj_areatext = document.getElementById(arg_areatext_name);
    if(!cursPos) TraceCursorPosition(obj_areatext); // 获取光标位置
    obj_areatext.value = obj_areatext.value.slice(0, cursPos.start) + arg_inserttext + obj_areatext.value.slice(cursPos.end)
}

// 我自己重寫的，目前用不到
function js_insert_text_byoptions(arg_areatext_name,arg_options_name){
    var obj_areatext = document.getElementById(arg_areatext_name);
    var obj_options = document.getElementById(arg_options_name);
    if(!cursPos) TraceCursorPosition(obj_areatext); // 获取光标位置
    obj_areatext.value = obj_areatext.value.slice(0, cursPos.start) + obj_options.options[obj_options.selectedIndex].text + obj_areatext.value.slice(cursPos.end)
    
    // 把options的選擇改成預設的值
    obj_options.selectedIndex=0;
}

function insertText() {
    var txt1 = document.getElementById("Text1");
    var txt2 = document.getElementById("Text2");
    //debugger;
    if(!cursPos) TraceCursorPosition(txt2); // 获取光标位置
        txt2.value = txt2.value.slice(0, cursPos.start) + txt1.value + txt2.value.slice(cursPos.end)
}

// 跟踪光标位置
function TraceCursorPosition(obj)
{
//debugger;
    cursPos = $CursorPosition(obj);
}

// 返回光标所在位置
/**//*
* source: http://blog.csdn.net/liujin4049/archive/2006/09/19/1244065.aspx
* acknowledges for Marshall
* example:
* var myTextBox = document.getElementById("MyTextBoxID");
* var cursPos = $CursorPosition(myTextBox);
* alert(cursPos.item[0] + " " + cursPos.item[1]);
* // OR
* alert(cursPos.start + " " + cursPos.end);
*/
function $CursorPosition(textBox){
    var start = 0, end = 0;
    //如果是Firefox(1.5)的话，方法很简单
    if(typeof(textBox.selectionStart) == "number"){
        start = textBox.selectionStart;
        end = textBox.selectionEnd;
    }
//下面是IE(6.0)的方法，麻烦得很，还要计算上'\n'
    else if(document.selection) {
        var range = document.selection.createRange();
        if(range.parentElement().id == textBox.id) {
            // create a selection of the whole textarea
            var range_all = document.body.createTextRange();
            range_all.moveToElementText(textBox);
            //两个range，一个是已经选择的text(range)，一个是整个textarea(range_all)
            //range_all.compareEndPoints()比较两个端点，如果range_all比range更往左(further to the left)，则
            //返回小于0的值，则range_all往右移一点，直到两个range的start相同。
            // calculate selection start point by moving beginning of range_all to beginning of range
            for (start=0; range_all.compareEndPoints("StartToStart", range) < 0; start++)
                range_all.moveStart('character', 1);
                // get number of line breaks from textarea start to selection start and add them to start
                // 计算一下\n
                for (var i = 0; i <= start; i ++) {
                if (textBox.value.charAt(i) == '\n')
                    start++;
            }
            // create a selection of the whole textarea
            var range_all = document.body.createTextRange();
            range_all.moveToElementText(textBox);
            // calculate selection end point by moving beginning of range_all to end of range
            for (end = 0; range_all.compareEndPoints('StartToEnd', range) < 0; end ++) {
                range_all.moveStart('character', 1);
            }
            // get number of line breaks from textarea start to selection end and add them to end
            for (var i = 0; i <= end; i ++) {
                if (textBox.value.charAt(i) == '\n')
                    end ++;
            }
        }
    }
    //return [start, end]; // 包括选中区域的起始位置
    // modified to return as Object
    return { "start": start, "end": end, "item": [start, end] };
}