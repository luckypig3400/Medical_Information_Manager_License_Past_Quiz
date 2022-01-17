<?php
$row = 1;
// ReadCSV:https://www.php.net/manual/en/function.fgetcsv.php
if (($csvFile = fopen("../past_exam_questions_csv/merged2007-2020_orderBy_chapter.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($csvFile, 3000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($csvFile);
}
?>