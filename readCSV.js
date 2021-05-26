//https://stackoverflow.com/questions/14446447/how-to-read-a-local-text-file

const contentParagraph = document.getElementById("csvContent");

function readTextFile(file) {
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                var allText = rawFile.responseText;
                allText = allText.replace(/(?:\r\n|\r|\n)/g,'<br>');
                //轉換換行符號為HTML的<br>
                //https://stackoverflow.com/questions/784539/how-do-i-replace-all-line-breaks-in-a-string-with-br-elements
                contentParagraph.innerHTML = allText;
            }
        }
    }
    rawFile.send(null);
}