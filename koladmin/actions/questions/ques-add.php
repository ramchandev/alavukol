<?php
if($_POST)
{
    require "../../init.php";
    include ROOT_DIR."/classes/db-config.php";
    include ROOT_DIR."/classes/class_lib.php";
    $akins=new akol();

    if($_POST['questype']==1)
    {

    $ques_name = mysqli_real_escape_string($conn, $_POST['quesname']);
 
   //Insert Question Base Data for the Question
    $query_insertques="INSERT INTO `kol_quesbase` (`ID`, `QTID`, `QCATID`, `Qcomp`, `Status`, `CreatedBy`, `CreatedOn`) VALUES (NULL, '".$_POST['questype']."', '".$_POST['quescat']."', '', '1', '1', CURRENT_TIMESTAMP);";    
    $qbid=$akins->insupdata($query_insertques);

    //Insert Question Data for the Question
    $query_insertqname="INSERT INTO `kol_quesname` (`ID`, `QBID`, `Qname`, `Status`, `CreatedOn`) VALUES (NULL, '".$qbid."', '".$ques_name."', '1', CURRENT_TIMESTAMP);
    ";
    $qnid=$akins->insupdata($query_insertqname);

    header("location: ".ROOT_URL."/question-op.php?qbid=".$qbid."&msg=quesadded");
    }
}
else
{
    require "../../init.php";
    header("location: ".ROOT_URL."/question-op.php?msg=noaccess");
}
