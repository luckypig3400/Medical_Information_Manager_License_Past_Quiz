//https://stackoverflow.com/questions/14446447/how-to-read-a-local-text-file

const contentParagraph = document.getElementById("csvContent");

function readTextFile(file) {
    var rawFile = new XMLHttpRequest();
    rawFile.open("GET", file, false);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4) {
            if (rawFile.status === 200 || rawFile.status == 0) {
                var allText = rawFile.responseText;
                allText = allText.replace(/(?:\r\n|\r|\n)/g, '<br>');
                //轉換換行符號為HTML的<br>
                //https://stackoverflow.com/questions/784539/how-do-i-replace-all-line-breaks-in-a-string-with-br-elements
                contentParagraph.innerHTML = allText;
            }
        }
    }
    rawFile.send(null);
}

//Method 2 select file then read
//https://stackoverflow.com/questions/29393064/reading-in-a-local-csv-file-in-javascript
var fileInput = document.getElementById("csv"),
    readFile = function () {
        var reader = new FileReader();
        reader.onload = function () {
            document.getElementById('out').innerHTML = reader.result;
        }
        // start reading the file. When it is done, calls the onload event defined above.
        reader.readAsText(fileInput.files[0],'UTF-8');
    }
fileInput.addEventListener('change', readFile);