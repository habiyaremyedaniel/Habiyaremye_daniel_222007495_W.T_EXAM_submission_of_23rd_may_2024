<?php
//habiyaremye daniel 222007495 april 2024
                // Database connection parameters
$servername = "localhost";
$username = "Daniel";
$password = "DanielH@2024";//this is empty because I din't set any password
$dbname = "home_automation_control_systems";


                // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM automation_rules";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about automation_rules</title>";
    echo "<h1>The Information about automation_rules</h1>";
    echo "<table border='1'>
            <tr>
                <th>ruleid</th>
                <th>rulename</th>
                <th>trigger_event</th>
               <th>action</th>
               <th>deviceid</th>
                <th>userid</th>

                
            </tr>";

     //habiyaremye daniel 222007495 april 2024

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ruleid"] . "</td>";
        echo "<td>" . $row["rulename"] . "</td>";
        echo "<td>" . $row["trigger_event"] . "</td>";
        echo "<td>" . $row["action"] . "</td>";
        echo "<td>" . $row["deviceid"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//habiyaremye daniel 222007495 april 2024

$conn->close();
?>
