<?php
// Test connection with detailed error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Testing AWS RDS Connection</h2>";

$db_host = 'bloodbankdb.ci1c600sa0bh.us-east-1.rds.amazonaws.com';
$db_username = 'admin';
$db_password = 'K21academy.com';
$db_name = 'bloodbankdb';

echo "<p><strong>Connection Details:</strong></p>";
echo "<ul>";
echo "<li>Host: $db_host</li>";
echo "<li>Username: $db_username</li>";
echo "<li>Database: $db_name</li>";
echo "<li>Port: 3306 (default)</li>";
echo "</ul>";

echo "<p><strong>Testing connection...</strong></p>";

// Test 1: Basic connection without database name
echo "<h3>Test 1: Basic connection (without database)</h3>";
$conn1 = @mysqli_connect($db_host, $db_username, $db_password);
if($conn1) {
    echo "✅ Basic connection successful<br>";
    mysqli_close($conn1);
} else {
    echo "❌ Basic connection failed: " . mysqli_connect_error() . "<br>";
}

// Test 2: Connection with database name
echo "<h3>Test 2: Connection with database</h3>";
$conn2 = @mysqli_connect($db_host, $db_username, $db_password, $db_name);
if($conn2) {
    echo "✅ Full connection successful<br>";
    
    // Test 3: Simple query
    echo "<h3>Test 3: Simple query test</h3>";
    $result = mysqli_query($conn2, "SELECT 1 as test");
    if($result) {
        $row = mysqli_fetch_assoc($result);
        echo "✅ Query successful: " . $row['test'] . "<br>";
    } else {
        echo "❌ Query failed: " . mysqli_error($conn2) . "<br>";
    }
    
    mysqli_close($conn2);
} else {
    echo "❌ Full connection failed: " . mysqli_connect_error() . "<br>";
}

// Test 4: Check if we can reach the host
echo "<h3>Test 4: Network connectivity test</h3>";
$host = $db_host;
$port = 3306;

$connection = @fsockopen($host, $port, $errno, $errstr, 10);
if($connection) {
    echo "✅ Network connection to $host:$port successful<br>";
    fclose($connection);
} else {
    echo "❌ Network connection failed: $errstr ($errno)<br>";
    echo "<p><strong>This suggests a network/firewall issue. Possible solutions:</strong></p>";
    echo "<ul>";
    echo "<li>Check AWS RDS Security Group allows your IP on port 3306</li>";
    echo "<li>Verify RDS instance is in a public subnet</li>";
    echo "<li>Check your local firewall settings</li>";
    echo "<li>Try connecting from a different network</li>";
    echo "</ul>";
}

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Check AWS RDS Security Group settings</li>";
echo "<li>Verify your current IP address</li>";
echo "<li>Ensure RDS instance is publicly accessible</li>";
echo "<li>Check if you're behind a corporate firewall</li>";
echo "</ol>";

echo "<p><strong>Your current IP address:</strong> " . $_SERVER['REMOTE_ADDR'] . "</p>";
?> 