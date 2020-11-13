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
    $query_insertques = "INSERT INTO `kol_quesoptions` (`ID`, `QBID`, `QNID`, `Optiontext`, `IsAnswer`, `CreatedOn`) VALUES (NULL, '" . $_POST['qbid'] . "', '" . $_POST['qnid'] . "', '" . $opt_name . "', '" . $ans . "', CURRENT_TIMESTAMP);";
    $akins->insupdata($query_insertques);
    header("location: " . ROOT_URL . "/question-op.php?qbid=" . $_POST['qbid'] . "&msg=optadded");
} else {
    require "../../init.php";
    header("location: " . ROOT_URL . "/question-op.php?msg=noaccess");
}
