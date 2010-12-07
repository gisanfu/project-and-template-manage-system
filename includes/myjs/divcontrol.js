/* 這個function是要顯示div用的
 * 觸發的那邊要加上onclick="ShowDiv(this)"
 * div那邊要先加上style="display:none"
 */
function DivViewControl(divname) 
{ 
    var Layer_choice; 
 
   if (document.getElementById) {
     Layer_choice = eval("document.getElementById('" + divname + "')"); 
   } else {
     Layer_choice = eval("document.all.choice." + divname); 
   } 
   
   if(Layer_choice){
     if(Layer_choice.style.display=="none"){ 
       Layer_choice.style.display=''; 
     } else {
       Layer_choice.style.display="none";
     }
   }
}

function DivCmdControl(divname,cmd) 
{ 
   var Layer_choice; 

   if (document.getElementById) {
     Layer_choice = eval("document.getElementById('" + divname + "')"); 
   } else {
     Layer_choice = eval("document.all.choice." + divname); 
   } 
   
   if(Layer_choice){
     if(cmd=="show"){
       Layer_choice.style.display=''; 
     } else {
       Layer_choice.style.display="none";
     }
   }
}