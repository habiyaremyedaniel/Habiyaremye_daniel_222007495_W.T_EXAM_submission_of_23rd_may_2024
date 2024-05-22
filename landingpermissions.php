<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbuserid, useruserid, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    
    $userid = $_POST['userid'];
    $deviceid  = $_POST['deviceid'];
   $permissiontype  = $_POST['permissiontype'];

    $sql = "INSERT INTO permissions ( userid,  deviceid,permissiontype ) VALUES (?,?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sss",$userid, $deviceid,$permissiontype );

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['permissionid'];
   
    $newuserid = $_POST['newuserid'];
   
    $newdeviceid  = $_POST['newdeviceid '];
    $newpermissiontype  = $_POST['newpermissiontype '];
    $sql = "UPDATE permissions SET  userid=?, deviceid =?  WHERE permissionid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $newuserid, $newdeviceid ,$permissiontype,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['permissionid'];

    $sql = "DELETE FROM permissions WHERE permissionid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['read'])) {
    // Assuming the session contains permissionid
    $id = $_POST['permissionid'];

    // Select user_permissions's information from the database
    $sql = "SELECT * FROM permissions WHERE permissionid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_permissions information
        $row = $result->fetch_assoc();
        echo "permissionid: " . $row["permissionid"] . "<br>";
        echo "userid: " . $row["userid"] . "<br>";
        echo "deviceid : " . $row["deviceid "] . "<br>";
        echo "permissiontype: " . $row["permissiontype "] . "<br>";
    } else {
        echo "No user found with the provided ID.";
    }
}


?>