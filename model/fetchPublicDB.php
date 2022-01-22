<?php

use function PHPSTORM_META\type;

require("./config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_selectCommand = "SELECT * FROM `publicq` ORDER BY `publicq`.`publicID` ASC";

    // Select data from DB with PDO method:
    // https://www.w3schools.com/php/php_mysql_select.asp
    $stmt = $conn->prepare($sql_selectCommand);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $row) {
        // print_r($row);
        echo "<p>";
        foreach ($row as $columnName => $cellData) {
            // 要使用這種包含索引建的查詢方式，前面setFetchMode(PDO::FETCH_ASSOC)是關鍵
            echo "<b>$columnName:</b>".$row[$columnName] . "&#9;";
        }
        echo "</p>";
    }
} catch (PDOException $e) {
    echo "<b>Error:</b>" . $e->getMessage();
}

$conn = null;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>publicQapi</title>
</head>

<body>

</body>

</html>