<?php
if($_POST)
{
    include "../classes/db-config.php";
    include "../classes/class_lib.php";
    require "../init.php";

    $cat_name = mysqli_real_escape_string($conn, $_POST['catname']);
    $cat_desc = mysqli_real_escape_string($conn, $_POST['catdesc']);

    $query_insertcat="INSERT INTO `kol_quescats` (`ID`, `Name`, `Description`, `Image`, `ParentID`, `Status`, `CreatedOn`) VALUES (NULL, '".$cat_name."', '".$cat_desc."', '', '".$_POST['parentcat']."', '1', CURRENT_TIMESTAMP);";

    $akins=new akol();
    $akins->insertdata($query_insertcat);
    header("location: ".ROOT_URL."/ques-cat.php?msg=catadded");
    

}
else
{
    require "../init.php";
    header("location: ".ROOT_URL."/ques-cat.php?msg=noaccess");


}
