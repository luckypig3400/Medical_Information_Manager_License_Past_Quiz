<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>High Scores</title>
    <link rel="shortcut icon" type="image/x-icon" href="./../assets/img/ntunhsLogo_200px-National_Taipei_University_of_Nursing_and_Health_Science_logo.jpg">
    <link rel="stylesheet" href="./../assets/css/app.css" />
    <link rel="stylesheet" href="./../assets/css/highscores.css" />
</head>

<body>
    <div class="container">
        <div id="highScores" class="flex-center flex-column">
            <h1 id="finalScore">High Scores</h1>
            <form action="" method="get">
                <h3>是否要打亂題號順序?</h3>
                <input type="checkbox" name="random" id="randomChk" value="true">
                <h3>請選擇題數:</h3>
                <input type="number" name="limit" id="limitInput" maxlength="3" value="10">
                <h3>是否要選擇單一出題章節?</h3>
                <!-- https://www.w3schools.com/tags/tag_select.asp -->
                <select name="chapter" id="chapterSelect">
                    <option value="">預設值全選</option>
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="mercedes">Mercedes</option>
                    <option value="audi">Audi</option>
                </select>
                <input type="submit" value="Start Game">
            </form>
        </div>
    </div>
    <script src="./../assets/js/highscores.js"></script>
</body>

</html>