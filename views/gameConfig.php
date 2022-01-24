<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>題庫設定</title>
    <link rel="shortcut icon" type="image/x-icon" href="./../assets/img/ntunhsLogo_200px-National_Taipei_University_of_Nursing_and_Health_Science_logo.jpg">
    <link rel="stylesheet" href="./../assets/css/app.css" />
    <link rel="stylesheet" href="./../assets/css/highscores.css" />
</head>

<body>
    <div class="container">
        <div id="highScores" class="flex-center flex-column">
            <h1 id="finalScore">Quiz Config</h1>
            <form action="./../model/fetchPublicDB.php" method="get">
                <h3>是否要打亂題號順序?</h3>
                <input type="checkbox" name="random" id="randomChk" value="true">
                <h3>請選擇題數:</h3>
                <input type="text" name="limit" id="limitInput" maxlength="2" value="3">

                <h3>是否要選擇單一出題章節?</h3>

                <!-- https://www.w3schools.com/tags/tag_select.asp -->
                <select name="chapter" id="chapterSelect">
                    <option value="">預設值全選</option>

                    <?php
                    $optionsJSON = file_get_contents("http://localhost/Medical_Information_Manager_License_Past_Quiz/model/fetchPublicDB.php?getChapterOptions=true");
                    $optionsArray = json_decode($optionsJSON, true);
                    // https://www.w3schools.com/php/func_json_decode.asp

                    foreach ($optionsArray["results"] as $option) {
                        if (strlen($option["Chapter"]) <= 2) //正常的章節為2位數以內的數字(字串)
                            echo "<option value=\"" . $option["Chapter"] . "\">" . $option["Chapter"] . "</option>";
                    }
                    echo "<option value=\"常用醫護術語\">常用醫護術語</option>"
                    ?>
                </select>

                <h3>是否要選擇單一年份的試卷?</h3>

                <!-- https://www.w3schools.com/tags/tag_select.asp -->
                <select name="year" id="yearSelect">
                    <option value="">預設值全選</option>
                    <?php
                    $optionsJSON = file_get_contents("http://localhost/Medical_Information_Manager_License_Past_Quiz/model/fetchPublicDB.php?getYearOptions=true");
                    $optionsArray = json_decode($optionsJSON, true);

                    foreach ($optionsArray["results"] as $option) {
                        echo "<option value=\"" . $option["Year"] . "\">" . $option["Year"] . "</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Start Game">
            </form>
        </div>
    </div>
    <script src="./../assets/js/highscores.js"></script>
</body>

</html>