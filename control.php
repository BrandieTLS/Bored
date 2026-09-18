<?php

// connection
$host = "serverless-eastus.sysp0000.db3.skysql.com";
$username = "dbpbf13797752";
$password = "hi4n^iuoS84OsAi77d.qYC";
$dbname = "spending";
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

    echo json_encode([
        "success" => false,
        "message" => "Database connection failed."
    ]);

    exit;
}



$sql = "SELECT * FROM spending ORDER BY date DESC, name ASC";

$result = $conn->query($sql);

if (!$result) {

    echo json_encode([
        "success" => false,
        "message" => "SQL error: " . $conn->error
    ]);

    exit;
}

$spending = [];

while ($row = $result->fetch_assoc()) {

    $spending[] = $row;

}

echo json_encode([
    "success" => true,
    "data" => $spending
]);


$conn->close();

?>