<?php
$sql_attrs=array();
$sql_attrs["boblog_blogs"]=array("blogid"=>"int","title"=>"str","pubtime"=>"int","authorid"=>"int","replies"=>"int","tbs"=>"int","views"=>"int","property"=>"int","category"=>"int","tags"=>"str","sticky"=>"int","htmlstat"=>"int","ubbstat"=>"int","emotstat"=>"int","content"=>"str","editorid"=>"int","edittime"=>"int","weather"=>"str","mobile"=>"int","pinged"=>"str","permitgp"=>"str","starred"=>"int","blogpsw"=>"str","frontpage"=>"int");
$sql_attrs["boblog_calendar"]=array("cyearmonth"=>"str","cday"=>"int","cid"=>"int","cevent"=>"str");
$sql_attrs["boblog_categories"]=array("cateid"=>"int","catename"=>"str","catedesc"=>"str","cateproperty"=>"int","cateorder"=>"int","catemode"=>"int","cateicon"=>"str","cateurl"=>"str","empty1"=>"str","empty2"=>"str","empty3"=>"str");
$sql_attrs["boblog_counter"]=array("total"=>"int","max"=>"int","today"=>"int","entries"=>"int","replies"=>"int","tb"=>"int","messages"=>"int","users"=>"int","empty1"=>"int","empty2"=>"int","empty3"=>"int");
$sql_attrs["boblog_forbidden"]=array("banword"=>"str","nosearch"=>"str","keep"=>"str","suspect"=>"str","banip"=>"str","empty1"=>"str","empty2"=>"str","empty3"=>"str");
$sql_attrs["boblog_history"]=array("hisday"=>"int","visit"=>"int");
$sql_attrs["boblog_linkgroup"]=array("linkgpid"=>"int","linkgpname"=>"str","linkgppt"=>"int","linkgporder"=>"int","empty1"=>"str","empty2"=>"str");
$sql_attrs["boblog_links"]=array("linkid"=>"int","linkname"=>"str","linkurl"=>"str","linklogo"=>"str","linkdesc"=>"str","linkgptoid"=>"int","linkorder"=>"int","isdisplay"=>"int","empty1"=>"str","empty2"=>"str");
$sql_attrs["boblog_maxrec"]=array("maxblogid"=>"int","maxuserid"=>"int","maxcateid"=>"int","maxgpid"=>"int","maxrepid"=>"int","maxmessagepid"=>"int","maxtagid"=>"int","maxlinkgpid"=>"int","maxlinkid"=>"int","empty1"=>"int","empty2"=>"int","empty3"=>"int");
$sql_attrs["boblog_messages"]=array("repid"=>"int","reproperty"=>"int","reptime"=>"int","replierid"=>"int","replier"=>"str","repemail"=>"str","repurl"=>"str","repip"=>"str","repcontent"=>"str","html"=>"int","ubb"=>"int","emot"=>"int","adminrepid"=>"int","adminreplier"=>"str","adminreptime"=>"int","adminrepcontent"=>"str","adminrepeditorid"=>"int","adminrepeditor"=>"str","adminrepedittime"=>"int","reppsw"=>"str","empty2"=>"str","empty3"=>"str","empty4"=>"str","empty5"=>"str","empty6"=>"str","empty7"=>"str","empty8"=>"str");
$sql_attrs["boblog_mods"]=array("position"=>"str","name"=>"str","desc"=>"str","active"=>"int","order"=>"int","func"=>"str");
$sql_attrs["boblog_plugins"]=array("plid"=>"int","plname"=>"str","plauthor"=>"str","plintro"=>"str","plversion"=>"str","plauthorurl"=>"str","plblogversion"=>"str","active"=>"int","pladmin"=>"int","plregister"=>"str");
$sql_attrs["boblog_replies"]=array("repid"=>"int","reproperty"=>"int","blogid"=>"int","reptime"=>"int","replierid"=>"int","replier"=>"str","repemail"=>"str","repurl"=>"str","repip"=>"str","repcontent"=>"str","html"=>"int","ubb"=>"int","emot"=>"int","adminrepid"=>"int","adminreplier"=>"str","adminreptime"=>"int","adminrepcontent"=>"str","adminrepeditorid"=>"int","adminrepeditor"=>"str","adminrepedittime"=>"int","reppsw"=>"str","empty2"=>"str","empty3"=>"str","empty4"=>"str","empty5"=>"str","empty6"=>"str","empty7"=>"str","empty8"=>"str");
$sql_attrs["boblog_tags"]=array("tagid"=>"int","tagname"=>"str","tagcounter"=>"int","tagentry"=>"str","tagrelate"=>"str");
$sql_attrs["boblog_user"]=array("userid"=>"int","username"=>"str","userpsw"=>"str","regtime"=>"int","usergroup"=>"int","email"=>"str","homepage"=>"str","qq"=>"int","msn"=>"str","intro"=>"str","gender"=>"int","skype"=>"str","from"=>"str","birthday"=>"int","regip"=>"str","avatar"=>"str","empty2"=>"str","empty3"=>"str","empty4"=>"str","empty5"=>"str","empty6"=>"str","empty7"=>"str","empty8"=>"str");
?>