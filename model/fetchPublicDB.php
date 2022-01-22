<?php
require("./config.php");

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



// Select MySQL as JSON: https://stackoverflow.com/questions/41758870/how-to-convert-result-table-to-json-array-in-mysql

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