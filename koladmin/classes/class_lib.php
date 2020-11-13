<?php
class akol
{

    public function getallinfo($sql) //get all info
    {

        include "db-config.php";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $st[$i] = $row;
                $i++;
            }
        } else {
            $st = '';
        }
        return $st;
        $conn->close();
    }

    public function getsingleinfo($sql) //get single info
    {
        include "db-config.php";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $st = $row;
            }
        } else {
            $st = '';
        }
        return $st;
        $conn->close();
    }

    function insupdata($sql) //Insert data
    {
        include "db-config.php";
        if ($conn->query($sql) === true) {
        } else {
            echo 'Error: ' . $sql . '<br>' . $conn->error;
            exit;
        }
        return  mysqli_insert_id($conn);         
        $conn->close();
    }
}