<?php

// connection
$host = "serverless-eastus.sysp0000.db3.skysql.com";
$username = "dbpbf13797752";
$password = "hi4n^iuoS84OsAi77d.qYC";
$dbname = "warranty_db";
$port = 4009;

$conn = mysqli_init();

mysqli_ssl_set(
    $conn,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
);

if (!mysqli_real_connect(
    $conn,
    $host,
    $username,
    $password,
    $dbname,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL
)) {
    die("Database connection failed: " . mysqli_connect_error());
}

echo "Database connected successfully!";


echo "Connected!<br>";
echo "Database: " . $conn->query("SELECT DATABASE()")->fetch_row()[0] . "<br>";

// Get information from the form
$name = $_POST["name"];
$category = $_POST["category"];
$amount = $_POST["amount"];
$date = $_POST["date"];
$notes = $_POST["notes"];


// Insert into database

$sql = "INSERT INTO warranties
        (name, category, amount,date,notes)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
  if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
$stmt->bind_param(
    "ssssssss",
    $name,
    $category,
    $amount,
    $date,
    $notes
);


if ($stmt->execute()) {

    echo "Spending added successfully!";

} else {

    echo "Error adding spending.";

}



$stmt->close();
$conn->close();

?>