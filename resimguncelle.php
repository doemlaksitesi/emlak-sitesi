<?php
/**
define("_VALID_PHP", true);
require_once("init.php");


$sql = "select * from  t_advert_images ";
$queryList = mysql_query($sql);
while ($rsList = mysql_fetch_array($queryList)) {
    $images = str_replace('.jpg', '' , $rsList['Images']);
    $sql = "update t_advert_images set Images='".$images.".jpg' where ID='" . $rsList['ID'] . "'";
    mysql_query($sql);
    
} 
 * */
?>
   