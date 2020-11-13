<?php
if($_POST)
{
    require "../../init.php";
    include ROOT_DIR."/classes/class_lib.php";
    $query_update="UPDATE `kol_quescats` SET `Status`='3'  WHERE  `ID` = '".$_POST['catid']."';";
    $akins=new akol();
    $akins->insupdata($query_update);
    //Have to reassign the questions to the root categorey
    header("location: ".ROOT_URL."/ques-cat.php?msg=catdeleted");    
}
else
{
    require "../../init.php";
    header("location: ".ROOT_URL."/ques-cat.php?msg=noaccess");
}
