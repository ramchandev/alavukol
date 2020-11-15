<?php
if($_POST)
{
    require "../../init.php";
    include ROOT_DIR."/classes/db-config.php";
    include ROOT_DIR."/classes/class_lib.php";
    $akins=new akol();

     

    $ques_name = mysqli_real_escape_string($conn, $_POST['quesname']);
 
   //Update Base Data for the Question
    $query_insertques="UPDATE `kol_quesbase` SET `QCATID` = '".$_POST['quescat']."' WHERE `ID` = '".$_POST['qbaseid']."';";    
    $qbid=$akins->insupdata($query_insertques);

    //Insert Question Data for the Question
    $query_insertqname="UPDATE `kol_quesname` SET `Qname` = '".$ques_name."' WHERE `ID` = '".$_POST['qnameid']."';";
    $akins->insupdata($query_insertqname);

    header("location: ".ROOT_URL."/question-op.php?qbid=".$_POST['qbaseid']."&msg=quesadded");
    
}
else
{
    require "../../init.php";
    header("location: ".ROOT_URL."/question-op.php?msg=noaccess");
}
