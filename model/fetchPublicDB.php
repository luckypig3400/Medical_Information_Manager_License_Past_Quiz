<?php

require("./config.php");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_selectCommand = "SELECT * FROM `publicq` ORDER BY `publicq`.`publicID` ASC";
    // Select MySQL as JSON: https://stackoverflow.com/questions/41758870/how-to-convert-result-table-to-json-array-in-mysql
    $sql_selectAsJSONCommand = "SELECT JSON_OBJECT('publicID',publicID,
    'Correct_Answers',Correct_Answers,'Question',Question,'Answer1',Answer1,
    'Answer2',Answer2,'Answer3',Answer3, 'Answer4',Answer4,'Year',Year,
    'Ref_Page',Ref_Page,'Chapter',Chapter,'Detail1',Detail1,'Detail2',Detail2,
    'Detail3',Detail3,'Detail4',Detail4) FROM `publicq`;";

    // Select data from DB with PDO method:
    // https://www.w3schools.com/php/php_mysql_select.asp
    $stmt = $conn->prepare($sql_selectAsJSONCommand);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach ($stmt->fetchAll() as $row) {
        // print_r($row);
        foreach ($row as $columnName => $cellData) {
            // 要使用這種包含索引建的查詢方式，前面setFetchMode(PDO::FETCH_ASSOC)是關鍵
            echo $row[$columnName] . "&#9;";
        }
        echo ",";
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