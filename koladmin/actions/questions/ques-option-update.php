<?php
if ($_POST) {
    require "../../init.php";
    include ROOT_DIR . "/classes/db-config.php";
    include ROOT_DIR . "/classes/class_lib.php";
    $akins = new akol();
    $opt_name = mysqli_real_escape_string($conn, $_POST['qoption']);
    if (isset($_POST['isans'])) {
        $ans = '1';
        $query_ansupdate = "UPDATE `kol_quesoptions` SET `IsAnswer` = '0' WHERE  `QNID` = " . $_POST['qnid'] . ";";
        $akins->insupdata($query_ansupdate);
    } else {
        $ans = '0';
    }
    //Insert Option for a question
    $query_insertques = "UPDATE `kol_quesoptions` SET `Optiontext` = '".$opt_name."', `IsAnswer` = '".$ans."' WHERE  `ID` = " .$_POST['opid'] . ";";
    $akins->insupdata($query_insertques);
    header("location: " . ROOT_URL . "/question-op.php?qbid=" . $_POST['qbid'] . "&msg=optupdated");
} else {
    require "../../init.php";
    header("location: " . ROOT_URL . "/question-op.php?msg=noaccess");
}
