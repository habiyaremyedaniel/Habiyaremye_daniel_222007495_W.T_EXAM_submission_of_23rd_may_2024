<?php
session_start();
//--Habiyaremye daniel 2220007495--->

// Connect to database (replace dbdevicename   , userdevicename, password with actual credentials)
require_once "databaseconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $devicename = $_POST['devicename'];
    $devicetype = $_POST['devicetype'];
    $location = $_POST['location'];
   $status = $_POST['status'];

    $sql = "INSERT INTO devices (devicename, devicetype,  location,status) values (?,?,?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssss", $devicename   , $devicetype , $location,$status);

    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error adding record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['deviceid'];
    $newdevicename  = $_POST['newdevicename'];
    $newdevicetype = $_POST['newdevicetype'];
   
    $newlocation = $_POST['newlocation'];
   $newstatus = $_POST['newstatus'];
    $sql = "UPDATE devices SET devicename  =?, devicetype=?, location=?  ,status=?WHERE deviceid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssssi", $newdevicename   , $newdevicetype, $newlocation,$status,$id);

    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $id = $_POST['deviceid'];

    $sql = "DELETE FROM devices WHERE deviceid=?";
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
    $id = $_POST['deviceid'];

    // Select user_devices's information from the database
    $sql = "SELECT * FROM devices WHERE deviceid=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch and display user_devices information
        $row = $result->fetch_assoc();
        echo "deviceid: " . $row["deviceid"] . "<br>";
        echo "devicename: " . $row["devicename"] . "<br>";
        echo "devicetype: " . $row["devicetype"] . "<br>";
        echo "location: " . $row["location"] . "<br>";
        
    } else {
        echo "No user found with the provided ID.";
    }
}


?>