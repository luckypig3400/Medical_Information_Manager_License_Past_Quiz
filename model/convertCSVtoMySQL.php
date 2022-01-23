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

    // 建立資料庫
    $sqlCommand_createDB = "Drop DATABASE IF EXISTS nahoot; CREATE DATABASE nahoot;";
    //use exec() becuase no results are returned
    $conn->exec($sqlCommand_createDB);
    echo "<h3>成功建立Nahoot資料庫</h3>";

    // 建立公開題庫資料表
    $sqlCommand_createTable = "Use nahoot;
    CREATE TABLE publicQ(
        publicID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Correct_Answers varchar(30),
        Question TEXT,
        Answer1 TEXT,
        Answer2 TEXT,
        Answer3 TEXT,
        Answer4 TEXT,
        Year varchar(9),
        Ref_Page varchar(30),
        Chapter varchar(9),
        Detail1 TEXT,       
        Detail2 TEXT,
        Detail3 TEXT,
        Detail4 TEXT
    );";
    $conn->exec($sqlCommand_createTable);
    echo "<h3>成功建立publicQ資料表</h3>";
} catch (PDOException $e) {
    echo "<b>Error occured while executing SQL:</b>" . $sqlCommand_createDB
        . "<br><b>Error Message:</b>" . $e->getMessage();
}

// ReadCSV:https://www.php.net/manual/en/function.fgetcsv.php
$row = 1;
$filePath = "./../past_exam_questions_csv/merged2007-2020_orderBy_chapter.csv";
if (($csvFile = fopen($filePath, "r")) !== FALSE) {
    while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";

        // 把資料行轉成SQL insert語法
        $sql_insertDataRow =
            "INSERT INTO `publicq`
            (`publicID`, `Correct_Answers`, `Question`, `Answer1`, `Answer2`, `Answer3`, `Answer4`
            , `Year`, `Ref_Page`, `Chapter`,`Detail1`, `Detail2`, `Detail3`, `Detail4`) VALUES 
            (NULL, '$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]'
            , '$data[6]', '$data[7]', '$data[8]', NULL, NULL, NULL, NULL);";
        // echo "<b>Executing insert row SQL:</b>" . $sql_insertDataRow . "<br>";
        if ($row == 1) { //table header
            echo "<b>CSV file title row:</b>";
            for ($c = 0; $c < $num; $c++) {
                echo $data[$c] . "&#9;";
            }
        } else { // data row
            try {
                $conn->exec($sql_insertDataRow);
                echo "<b>line $row inserted !</b>";
            } catch (PDOException $insertError) {
                echo "<h4>Error Message:</h4>" . $insertError->getMessage();
            }
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