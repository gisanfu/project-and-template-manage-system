<?php
// ##########################################  
// # 作者 : Ning  
// # 文章出處 : http://theb1.com  
// # 轉貼請註明出處  
// ##########################################  
  
//set_time_limit(0);  
  
function dos2unix($file) {  
    $f = fopen($file, "r");  
    $body = fread($f, filesize($file));  
    fclose($f);  
    $body = str_replace(chr(13), "", $body);  
    $f = fopen($file, "w");  
    fwrite($f, $body);  
    fclose($f);  
}  
  
function TDIR($dir) {  
    $handle = opendir($dir);  
    while(($file = readdir($handle)) != false) {  
        if(!($file == "." or $file == "..")) {  
            if(is_dir("$dir/$file")) {  
                TDIR("$dir/$file");  
            } else {  
                $ftype = substr(strtolower($file), strrpos($file, "."));  
                if(ereg($ftype, ".php") or ereg($ftype, ".tpl") or ereg($ftype, ".htm") or ereg($ftype, ".html") or ereg($ftype, ".dat")) {  
                    echo "$dir/$file ..\n";  
                    dos2unix("$dir/$file");  
                }  
            }  
        }  
    }  
    closedir($handle);  
}  
  
//TDIR("/www/webs/theb1");  
?>