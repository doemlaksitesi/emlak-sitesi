
<?php
  
  define("_VALID_PHP", true);
  require_once("init.php");
 
 
 $sql = "Select * from users where  userType!='5'";
    $q   = mysql_query($sql);
    while($uye = mysql_fetch_array($q)){    	
    	mysql_query("update users set subdomain='".seflink($uye['firmaadi'],"")."' where id='".$uye['id']."' ");
    	}
?>
