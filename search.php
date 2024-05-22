<?php
session_start();

// Connect to database (replace dbname, username, password with actual credentials)
require_once "databaseconnection.php";

if (isset($_GET['query'])) {
    $searchTerm = $_GET['query'];
    $output = "";

    $queries = [
        'users' => "SELECT userid,username, password, firstname, lastname, role, email FROM users WHERE userid LIKE '%$searchTerm%'",
        'automation_rules' => "SELECT ruleid,rulename, trigger_event,action,deviceid,userid FROM automation_rules WHERE ruleid LIKE '%$searchTerm%'",
        'devices' => "SELECT deviceid,devicename, devicetype,location,status FROM devices WHERE deviceid LIKE '%$searchTerm%'",
        'events' => "SELECT eventid,eventtype, description FROM events WHERE eventid LIKE '%$searchTerm%'",
        'logs' => "SELECT logid,userid,deviceid,action FROM logs WHERE logid LIKE '%$searchTerm%'",
        'notifications' => "SELECT notificationid, message, userid FROM notifications WHERE notificationid LIKE '%$searchTerm%'",
        'permissions' => "SELECT permissionid,userid,  deviceid,permissiontype FROM permissions WHERE permissionid  LIKE '%$searchTerm%'",
        'scenes' => "SELECT sceneid,scenename, description,  active FROM scenes WHERE sceneid LIKE '%$searchTerm%'",
        'settings' => "SELECT settingid,settingname,  value FROM settings WHERE settingid LIKE '%$searchTerm%'",
        'rooms' => "SELECT roomid,roomname, description FROM rooms WHERE roomid LIKE '%$searchTerm%'"
    ];

    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        $output .= "<h3>Table of $table:</h3>";
        
        if ($result) {
            if ($result->num_rows > 0) {
                $output .= "<ul>";
                while ($row = $result->fetch_assoc()) {
                    $output .= "<li>";
                    foreach ($row as $key => $value) {
                        $output .= "$key: $value, ";
                    }
                    $output .= "</li>";
                }
                $output .= "</ul>";
            } else {
                $output .= "<p>No results found in $table matching the search term: '$searchTerm'</p>";
            }
        } else {
            $output .= "<p>Error executing query: " . $connection->error . "</p>";
        }
    }

    echo $output;

    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
