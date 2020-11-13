<?php
if($_POST)
{
    require "../../init.php";
    include ROOT_DIR."/classes/db-config.php";
    include ROOT_DIR."/classes/class_lib.php";
    $cat_name = mysqli_real_escape_string($conn, $_POST['catname']);
    $cat_desc = mysqli_real_escape_string($conn, $_POST['catdesc']);
    $query_insertcat="INSERT INTO `kol_quescats` (`ID`, `Name`, `Description`, `Image`, `ParentID`, `Status`, `CreatedOn`) VALUES (NULL, '".$cat_name."', '".$cat_desc."', '', '".$_POST['parentcat']."', '1', CURRENT_TIMESTAMP);";
    $akins=new akol();
    $akins->insupdata($query_insertcat);
    header("location: ".ROOT_URL."/ques-cat.php?msg=catadded");
}
else
{
    require "../../init.php";
    header("location: ".ROOT_URL."/ques-cat.php?msg=noaccess");
}
