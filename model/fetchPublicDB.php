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

    foreach ($stmt->fetchAll() as $row) {
        // print_r($row);

        echo "<p>";
        for ($i = 0; $i < sizeof($row) / 2; $i++) {
            echo $row[$i] . "&#9;";
        }
        // foreach ($row as $columnName => $cellData) {
        //     echo $row[$columnName] . "&#9;";
        // }
        echo "</p>";
    }

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Select MySQL as JSON: https://stackoverflow.com/questions/41758870/how-to-convert-result-table-to-json-array-in-mysql

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