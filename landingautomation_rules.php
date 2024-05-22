<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbrulename   , userrulename, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $rulename = $_POST['rulename'];
    $trigger_event = $_POST['trigger_event'];
    $action= $_POST['action'];
   $deviceid = $_POST['deviceid'];
   $userid = $_POST['userid'];
    $sql = "INSERT INTO automation_rules (rulename, trigger_event,location,deviceid,userid) values (?,?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssss", $rulename, $trigger_event , $location,$deviceid,$userid);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['ruleid'];
    $newrulename  = $_POST['newrulename'];
    $newtrigger_event = $_POST['newtrigger_event'];
   
    $newaction= $_POST['newaction'];
   $newdeviceid = $_POST['newdeviceid'];
    $newuserid = $_POST['newuserid'];
    $sql = "UPDATE automation_rules SET rulename  =?, trigger_event=?, location=?  ,deviceid=?,userid=?WHERE deviceid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssssi", $newrulename   , $newtrigger_event, $newlocation,$deviceid,$userid,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['deviceid'];

    $sql = "DELETE FROM automation_rules WHERE deviceid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains deviceid
    $id = $_POST['ruleid'];

    // Select user_automation_rules's information from the database
    $sql = "SELECT * FROM automation_rules WHERE ruleid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_automation_rules information
        $row = $result->fetch_assoc();
        echo "ruleid: " . $row["ruleid"] . "<br>";
        echo "rulename: " . $row["rulename"] . "<br>";
        echo "trigger_event: " . $row["trigger_event"] . "<br>";
        echo "action: " . $row["action"] . "<br>";
        echo "deviceid: " . $row["deviceid"] . "<br>";
        echo "userid: " . $row["userid"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>