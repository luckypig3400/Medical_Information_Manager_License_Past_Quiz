//https://stackoverflow.com/questions/14446447/how-to-read-a-local-text-file

const contentParagraph = document.getElementById("csvContent");

function readTextFile(file) {
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                var allText = rawFile.responseText;
                contentParagraph.innerHTML = allText;
            }
        }
    }
    rawFile.send(null);
}