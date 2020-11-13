<?php
class ques
{
    public function getques()
    {
        return "SELECT * FROM `kol_quesname` WHERE `Status`=1 ORDER BY `ID` DESC";

    }
 
    public function getquesnames($qbid)
    {
        
        return "SELECT * FROM `kol_quesname` WHERE `QBID` = ".$qbid." ";
        

    } 
    public function getquestype($qtid)
    {
        
        return "SELECT * FROM `kol_questypes` WHERE `ID` = ".$qtid." ";
        

    }
    public function getquesbase($qbid)
    {
        
        return "SELECT * FROM `kol_quesbase` WHERE `ID` = ".$qbid." ";
        

    } 
    public function getquescat($qcid)
    {
        
        return "SELECT * FROM `kol_quescats` WHERE `ID` = ".$qcid." ";
        

    }

}


