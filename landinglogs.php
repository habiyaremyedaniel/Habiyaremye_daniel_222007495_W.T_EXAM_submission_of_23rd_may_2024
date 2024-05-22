<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbuserid, useruserid, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $deviceid = $_POST['userid'];
    $deviceid = $_POST['deviceid'];
    $action = $_POST['action'];
   

    $sql = "INSERT INTO logs ( userid,deviceid,  action) VALUES (?,?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss",$userid,$deviceid, $action);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['logid'];
   $newuserid = $_POST['newuserid'];
    $newdeviceid = $_POST['newdeviceid'];
   
    $newaction = $_POST['newaction'];
   
    $sql = "UPDATE logs SET  deviceid=?, action=?  WHERE logid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $newdeviceid, $newaction,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['logid'];

    $sql = "DELETE FROM logs WHERE logid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains logid
    $id = $_POST['logid'];

    // Select user_logs's information from the database
    $sql = "SELECT * FROM logs WHERE logid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_logs information
        $row = $result->fetch_assoc();
        echo "logid: " . $row["logid"] . "<br>";
        echo "userid: " . $row["userid"] . "<br>";
        echo "deviceid: " . $row["deviceid"] . "<br>";
        echo "action: " . $row["action"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>