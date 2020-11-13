<?php
if($_POST)
{
    include "../classes/db-config.php";
    include "../classes/class_lib.php";
    require "../init.php";

    $cat_name = mysqli_real_escape_string($conn, $_POST['catname']);
    $cat_desc = mysqli_real_escape_string($conn, $_POST['catdesc']);

    $query_update="UPDATE `kol_quescats` SET `Name` = '".$cat_name."', `Description`='". $cat_desc."' , `ParentID`='".$_POST['parentcat']."'  WHERE  `ID` = '".$_POST['catid']."';";

    $akins=new akol();
    $akins->insupdata($query_update);
    header("location: ".ROOT_URL."/ques-cat.php?msg=catupdated");
    

}
else
{
    require "../init.php";
    header("location: ".ROOT_URL."/ques-cat.php?msg=noaccess");


}
