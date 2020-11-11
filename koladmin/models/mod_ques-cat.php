<?php
class qcats
{
    public function getcats()
    {
        return "SELECT * FROM `kol_quescats` ORDER BY `ID` DESC";

    }
    public function checkchild($pid)
    {
        
        return "SELECT * FROM `kol_quescats` WHERE `ParentID` = ".$pid." ORDER BY `ID` DESC";
        

    }
    public function getdata($cid)
    {
        
        return "SELECT * FROM `kol_quescats` WHERE `ID` = ".$cid." ";
        

    }

}


