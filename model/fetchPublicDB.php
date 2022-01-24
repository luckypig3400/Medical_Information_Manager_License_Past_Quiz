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
    'Detail3',Detail3,'Detail4',Detail4) FROM `publicq` ";

    $sql_FinalExecuteCommand = parseUrlGetParams($sql_selectAsJSONCommand);

    // Select data from DB with PDO method:
    // https://www.w3schools.com/php/php_mysql_select.asp
    $stmt = $conn->prepare($sql_FinalExecuteCommand);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $queryResult = $stmt->fetchAll();
    $totalRow = count($queryResult);
    $currentRow = 1;
    echo "{\"totalRow\":\"$totalRow\",\"results\":[";
    foreach ($queryResult as $row) {
        // print_r($row);
        foreach ($row as $columnName => $cellData) {
            // 要使用這種包含索引建的查詢方式，前面setFetchMode(PDO::FETCH_ASSOC)是關鍵
            echo $row[$columnName];
        }
        if ($currentRow < $totalRow) echo ",";
        $currentRow++;
    }
    echo "]}";
} catch (PDOException $e) {
    echo "<b>Error:</b>" . $e->getMessage();
}

$conn = null;

// PHP Parse Get Params:https://stackoverflow.com/questions/5884807/get-url-parameter-in-php
// 傳遞多個GET參數:https://stackoverflow.com/questions/10943635/how-do-i-pass-multiple-parameter-in-url/10943694
function parseUrlGetParams($in_sql_command)
{
    $newSQL = $in_sql_command;

    isset($_GET['random']) ? $random = $_GET['random'] : $random = "";
    isset($_GET['limit']) ? $limit = $_GET['limit'] : $limit = "";
    isset($_GET['chapter']) ? $chapter = $_GET['chapter'] : $chapter = "";
    isset($_GET['year']) ? $year = $_GET['year'] : $year = "";
    isset($_GET['getChapterOptions']) ? $getChapterOptions = $_GET['getChapterOptions'] : $getChapterOptions = "";
    isset($_GET['getYearOptions']) ? $getYearOptions = $_GET['getYearOptions'] : $getYearOptions = "";

    // Get chapter parameter
    $chapter = cleanString($chapter);
    if (strpos($chapter, "常用醫護術語") !== false) {
        $newSQL .= " WHERE Chapter Like '%常用醫護術語%'";
    } else if ($chapter != "") {
        $newSQL .= " WHERE Chapter = $chapter";
    }

    // Get year parameter
    if (cleanString($year) != "") {
        $year = cleanString($year);
        // 根據是否收到章節參數來下SQL指令
        if ($chapter = "") {
            $newSQL .= " WHERE Year = $year";
        } else {
            $newSQL .= " AND Year = $year";
        }
    }

    // Get random parameter
    if ($random == 'true') {
        $newSQL .= " ORDER BY rand()";
        // Random Select:https://stackoverflow.com/questions/19412/how-to-request-a-random-row-in-sql
    }

    // Get limit parameter
    if ($limit != "") { //limit not empty
        // Convert to integer for further check
        $limit = (int)$limit;
        // echo gettype($limit);
        if ($limit <= 0) {
            $newSQL .= " limit 0";
        } else {
            $newSQL .= " limit $limit";
        }
    }

    // GET chapterOptions
    if ($getChapterOptions == "true") {
        $newSQL = "SELECT JSON_OBJECT('Chapter', Chapter) FROM `publicq` GROUP BY Chapter ORDER BY ABS(Chapter) ASC;";
    }

    // GET yearOptions
    if ($getYearOptions == "true") {
        $newSQL = "SELECT JSON_OBJECT('Year', Year) FROM `publicq` GROUP BY Year DESC;";
    }

    return $newSQL;
}

// 處理特殊字元以防SQL Injection:https://stackoverflow.com/questions/14114411/remove-all-special-characters-from-a-string
function cleanString($string)
{
    $string = str_replace(' ', '', $string); // Replaces all spaces with empty.
    $string = str_replace('/', '', $string);
    $string = str_replace('\'', '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace('\\', '', $string);
    $string = str_replace(';', '', $string);
    return $string;
}
