<?php
//habiyaremye daniel 222007495 april 2024
// Database connection parameters
$servername = "localhost";
$username = "Daniel";
$password = "DanielH@2024";
$dbname = "home_automation_control_systems";
  // Create database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check database connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

$sql = "SELECT * FROM logs";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<title>The Information about logs</title>";
    echo "<h1>The Information about logs</h1>";
    echo "<table border='1'>
            <tr>
                <th>logid</th>
                <th>userid</th>
                <th>deviceid</th>
               <th>action</th>
                
            </tr>";

     //habiyaremye daniel 222007495 april 2024

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["logid"] . "</td>";
        echo "<td>" . $row["userid"] . "</td>";
        echo "<td>" . $row["deviceid"] . "</td>";
        echo "<td>" . $row["action"] . "</td>";
        
       
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "no information found";
}

//habiyaremye daniel 222007495 april 2024

$conn->close();
?>
