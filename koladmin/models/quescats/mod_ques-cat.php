<?php
class qcats
{
    public function getcats()
    {
        return "SELECT * FROM `kol_quescats` WHERE `Status`=1 ORDER BY `ID` DESC";

    }
    public function checkchild($pid)
    {
        
        return "SELECT * FROM `kol_quescats` WHERE `ParentID` = ".$pid." AND `Status`=1 ORDER BY `ID` DESC";
        

    }
    public function getdata($cid)
    {
        
        return "SELECT * FROM `kol_quescats` WHERE `ID` = ".$cid." AND `Status`=1";
        

    }

}


