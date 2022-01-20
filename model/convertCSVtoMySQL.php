<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>convertCSVtoMySQL</title>
</head>

<?php
//Create DB with PDO method:https://www.w3schools.com/php/php_mysql_create.asp
require("./config.php");
try {
    $conn = new PDO("mysql:host=$servername", $username, $password);

    //set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqlCommand_createDB = "Drop DATABASE IF EXISTS nahoot; CREATE DATABASE nahoot;";

    //use exec() becuase no results are returned
    $conn->exec($sqlCommand_createDB);
    echo "<h3>成功建立Nahoot資料庫</h3>";
} catch (PDOException $e) {
    echo "<b>Error occured while executing SQL:</b>" . $sqlCommand_createDB
        . "<br><b>Error Message:</b>" . $e->getMessage();
}

// ReadCSV:https://www.php.net/manual/en/function.fgetcsv.php
$row = 1;
$filePath = "../past_exam_questions_csv/merged2007-2020_orderBy_chapter.csv";
if (($csvFile = fopen($filePath, "r")) !== FALSE) {
    while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        for ($c = 0; $c < $num; $c++) {
            if ($row <= 3) echo $data[$c] . ",&#9;"; //table header
        }
        $row++;
    }
    fclose($csvFile);
}

$conn = null; //close SQL connection
?>

<body>

</body>

</html>